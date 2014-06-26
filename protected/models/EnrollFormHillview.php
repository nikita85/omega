<?php

Yii::import('application.models._base.BaseEnrollFormHillview');

class EnrollFormHillview extends BaseEnrollFormHillview
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
                    
                    $seminar = Seminar::model()->findAllByAttributes(array('title'=>'hillview'))[0];
                    
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
                    $order->details        = 'Hillview seminar payment';
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
            
//            $criteria->with = array( 'order' );
//
//            $criteria->compare( 'order.id', $this->order_id, true );
//            
//            $criteria->alias = 'form';
//            
//            $criteria->join= 'JOIN orders ON (form.order_id != orders.id)';

            $dataProvider = new CActiveDataProvider($this, [
                'criteria' => $criteria,
                'pagination' => [
                    'pageSize' => 50
                ]
            ]);

            return $dataProvider;
        }

        public static function getClassDays()
        {
            return ['monday' => 'monday','tuesday' => 'tuesday','wednesday' => 'wednesday','thursday' => 'thursday','friday' =>'friday','saturday' => 'saturday','sunday' => 'sunday'];
        }
}