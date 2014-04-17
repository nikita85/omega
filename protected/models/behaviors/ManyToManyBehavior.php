<?php
/**
 * 
 *
 * @author Oleg Subbotin <oleg.subotin@gmail.com> 
 * @date 3/19/13
 */
class ManyToManyBehavior extends CActiveRecordBehavior
{
    /**
     * @var array
     */
    public $ignoreRelations = [];

    /**
     * @param $relationName
     *
     * @return array
     * @throws CException
     */
    public function getIdList($relationName)
    {
        if (!in_array($relationName, array_keys($this->owner->relations())) || $this->owner->relations()[$relationName][0] != CActiveRecord::MANY_MANY) {

            throw new CException('ManyToMany Relation "' . $relationName . '" does not exist');

        }

        $IDs = [];

        foreach ($this->owner->{$relationName} as $relation) {

            if (is_object($relation)) {
                $IDs[] = $relation->{$relation->tableSchema->primaryKey};

            } else {
                $IDs[] = $relation;
            }
        }

        return $IDs;
    }


    /**
     * @param CModelEvent $event
     *
     * @return bool|void
     * @throws CException
     */
    public function afterSave($event)
    {
        if (!is_array($this->ignoreRelations)) {
            throw new CException('ignoreRelations of ManyToManyBehavior needs to be an array');
        }

        $this->updateManyManyRelations();

        parent::afterSave($event);

        return true;
    }

    /**
     *
     */
    protected function updateManyManyRelations()
    {
        foreach ($this->getRelations() as $relation) {
            $this->initCurrentIDs($relation);
            $this->cleanRelation($relation);
            $this->writeRelation($relation);
        }
    }

    protected function initCurrentIDs(&$relation)
    {
        $relation['currentIDs'] = array_map(function($item) use($relation) {
            return $item[$relation['foreignField']];
        }, Yii::app()->db->createCommand(
            "SELECT {$relation['foreignField']}
             FROM {$relation['table']}
             WHERE {$relation['ownerField']} = {$this->owner->{$this->owner->tableSchema->primaryKey}}"
        )->queryAll());

        $collection = $relation['name'];

        // Only an object or primary key id is given
        if (!is_array($this->owner->$collection)) {
            $this->owner->$collection = [$this->owner->$collection];
        }

        $relation['deleteIDs'] = array_diff($relation['currentIDs'], array_map(function ($item) use ($relation) {

                if (is_object($item) && get_class($item) == $relation['foreignModel']) {

                    return $item->{$item->tableSchema->primaryKey};

                } elseif (is_numeric($item)) {

                    return $item;

                }

            }, $this->owner->$collection)
        );

        $relation['newIDs'] = array_diff(array_map(function ($item) use ($relation) {

            if (is_object($item) && get_class($item) == $relation['foreignModel']) {

                return $item->{$item->tableSchema->primaryKey};

            } elseif (is_numeric($item)) {

                return $item;

            }

        }, $this->owner->$collection), $relation['currentIDs']);

    }

    /**
     * @return array
     */
    protected function getRelations()
    {
        static $relations = [];

        $ownerClass = get_class($this->owner);

        if (!in_array($ownerClass, $relations)) {

            $relations[$ownerClass] = [];

            foreach ($this->owner->relations() as $relationName => $relation) {

                if ($relation[0] == CActiveRecord::MANY_MANY && !in_array($relationName, $this->ignoreRelations) &&  $this->owner->$relationName != -1) {
                    $info = [];
                    $info['name'] = $relationName;
                    $info['foreignModel'] = $relation[1];

                    $matches = [];

                    if (preg_match('/^(?P<table>.+)\((?P<owner_field>.+)\s*,\s*(?P<foreign_field>.+)\)$/s', $relation[2], $matches)) {
                        $info['table'] = $matches['table'];
                        $info['ownerField'] = $matches['owner_field'];
                        $info['foreignField'] = $matches['foreign_field'];

                    } else {
                        $info['table'] = $relation[2];
                        $info['ownerField'] = $this->owner->tableSchema->primaryKey;
                        $info['foreignField'] = CActiveRecord::model($relation[1])->tableSchema->primaryKey;
                    }

                    $relations[$ownerClass][$relationName] = $info;
                }

            }

        }



        return $relations[$ownerClass];
    }

    /**
     * @param $relation
     */
    protected function writeRelation($relation)
    {
        if (!empty($relation['newIDs'])) {
            $this->execute($this->insertCommand($relation));
        }
    }

    /* before saving our relation data, we need to clean up exsting relations so
     * they are synchronized */
    protected function cleanRelation($relation)
    {
        if (!empty($relation['deleteIDs'])) {
            $this->execute($this->deleteCommand($relation));
        }
    }

    // A wrapper function for execution of SQL queries
    public function execute($query)
    {
        return Yii::app()->db->createCommand($query)->execute();
    }

    /**
     * @param $relation
     * @param $value
     *
     * @return string
     */
    public function insertCommand($relation)
    {
        $values = [];

        foreach ($relation['newIDs'] as $id) {
            $values[] = "({$this->owner->{$this->owner->tableSchema->primaryKey}}, {$id})";
        }

        return sprintf("INSERT INTO %s (%s, %s) VALUES %s",
            $relation['table'],
            $relation['ownerField'],
            $relation['foreignField'],
            implode(',', $values)
        );
    }

    /**
     * @param $relation
     *
     * @return string
     */
    public function deleteCommand($relation)
    {
        return sprintf("DELETE FROM %s WHERE %s = '%s' AND %s IN (%s)",
            $relation['table'],
            $relation['ownerField'],
            $this->owner->{$this->owner->tableSchema->primaryKey},
            $relation['foreignField'],
            implode(',', $relation['deleteIDs'])
        );
    }


}