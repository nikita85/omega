<?php

Yii::import('application.models._base.BaseTime');

class Time extends BaseTime
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}