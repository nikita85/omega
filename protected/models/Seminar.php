<?php

Yii::import('application.models._base.BaseSeminar');

class Seminar extends BaseSeminar
{
    const TYPE_SUMMER = 'summer';
    const TYPE_TRIMESTER = 'trimester';
    
    
    public static function model($className=__CLASS__) {
            return parent::model($className);
    }
        
        
    public static function getTypes()
    {
        return [self::TYPE_SUMMER => 'summer', self::TYPE_TRIMESTER => 'trimester'];
    }
    
    public function getGradesIDs()
    {

        return array_map(function ($item) {

            return $item->id;
        }, ($this->grades ?: []));
    }

    protected function afterSave(){
        parent::afterSave();

        foreach($this->times as $time) {
            $time->seminar_id = $this->id;
            $time->save();
        }

        foreach($this->datePeriods as $datePeriod) {

            $datePeriod->seminar_id = $this->id;
            $datePeriod->save();
        }
    }
}