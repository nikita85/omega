<?php

Yii::import('application.models._base.BaseOrders');

class Orders extends BaseOrders
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}