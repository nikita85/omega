<?php

Yii::import('application.models._base.BaseTutorStudent');

class TutorStudent extends BaseTutorStudent
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}