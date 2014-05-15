<?php

Yii::import('application.models._base.BaseOrders');

class Orders extends BaseOrders
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        protected function beforeValidate()
        {
            if($this->isNewRecord)
            {
                $this->created = date("Y-m-d H:i:s");
            }
            
            $this->last_update = date("Y-m-d H:i:s");
            
            return true;
        }
}