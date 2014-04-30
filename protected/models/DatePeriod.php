<?php

Yii::import('application.models._base.BaseDatePeriod');

class DatePeriod extends BaseDatePeriod
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}