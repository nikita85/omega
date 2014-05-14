<?php

Yii::import('application.models._base.BaseTimeSlot');

class TimeSlot extends BaseTimeSlot
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}