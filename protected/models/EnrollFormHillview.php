<?php

Yii::import('application.models._base.BaseEnrollFormHillview');

class EnrollFormHillview extends BaseEnrollFormHillview
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
        
        public function selectAll()
        {
            $criteria = new CDbCriteria();

            $criteria->select = "*";

            $dataProvider = new CActiveDataProvider($this, [
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => 50
                ]
            ]);

            return $dataProvider;
        }
}