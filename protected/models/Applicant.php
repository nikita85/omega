<?php

Yii::import('application.models._base.BaseApplicant');

class Applicant extends BaseApplicant
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}