<?php

Yii::import('application.models._base.BaseSeminar');

class Seminar extends BaseSeminar
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}