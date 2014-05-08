<?php

Yii::import('application.models._base.BaseEnrollFormKnoll');

class EnrollFormKnoll extends BaseEnrollFormKnoll
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        protected function beforeValidate()
        {
            if($this->isNewRecord)
            {
                $from = Forms::model()->model()->findByAttributes(array('table'=>$this->tableName()));

                $enrollForm = new EnrollForms();

                $enrollForm->form_id = $from->id;

                if( !$enrollForm->save() )
                {
                    return false;
                }
            
                $this->enroll_form_id = $enrollForm->id;
            }
            
            return true;
        }

        protected function beforeSave() 
        {
            if(parent::beforeSave())
            {
                if($this->isNewRecord)
                {
                    // fill student, student_seminar, orders
                    
                    $seminar = Seminar::model()->findAllByAttributes(array('title'=>'knoll'))[0];
                    
                    foreach ($seminar->grades as $availableGrade) 
                    {
                        if( $availableGrade->title == $this->grade )
                        {
                            $grade = $availableGrade;
                            break;
                        }
                    }
                    
                    $student = new Student();
                    
                    $student->name = $this->student_name;
                    
                    if(!$student->save())
                    {
                        return false;
                    }
                    
                    $order   = new Orders();
                    
                    $order->amount         = $seminar->price;
                    $order->details        = 'Oak Knoll seminar payment';
                    $order->payment_status = 'pending';
                    
                    if(!$order->save())
                    {
                        return false;
                    }
                    
                    $this->order_id = $order->id;
                    
                    $studentSeminar = new StudentSeminars();
                    
                    $studentSeminar->student_id     = $student->id;
                    $studentSeminar->seminar_id     = $seminar->id;
                    $studentSeminar->grade_id       = $grade->id;
                    $studentSeminar->enroll_form_id = $this->enroll_form_id;
                    $studentSeminar->order_id       = $order->id;
                    
                    if(!$studentSeminar->save())
                    {
                        return false;
                    }
                    
                    return true;
                    
                }
                else
                {
                    return true;
                }    
            }
            else
            {
                return false;
            }
        
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