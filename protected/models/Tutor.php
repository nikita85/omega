<?php

Yii::import('application.models._base.BaseTutor');

class Tutor extends BaseTutor
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    protected function afterSave(){
        parent::afterSave();

        foreach($this->tutorsDaysTimes as $time) {
            $time->tutors_id = $this->id;
            $time->save();
        }

    }
}