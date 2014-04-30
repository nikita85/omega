<?php

Yii::import('application.models._base.BaseEnrollFormKnoll');

class EnrollFormKnoll extends BaseEnrollFormKnoll
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        protected function beforeValidate()
        {
            $from = Forms::model()->model()->findByAttributes(array('table'=>$this->tableName()));
            
            $enrollForm = new EnrollForms();
            
            $enrollForm->form_id = $from->id;
            
            if( !$enrollForm->save() )
            {
                return false;
            }
            
            $this->enroll_form_id = $enrollForm->id;
            
            return true;
        }
}