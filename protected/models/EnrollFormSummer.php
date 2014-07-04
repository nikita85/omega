<?php

Yii::import('application.models._base.BaseEnrollFormSummer');

class EnrollFormSummer extends BaseEnrollFormSummer
{



	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function save( $selectedSeminars ){
            
            if($this->isNewRecord)
            {
                $form = Forms::model()->model()->findByAttributes(array('table'=>$this->tableName()));

                $enrollForm = new EnrollForms();

                $enrollForm->form_id = $form->id;

                if( !$enrollForm->save() )
                {
                    return false;
                }
            
                $this->enroll_form_id = $enrollForm->id;
                
                $this->submit_date    = date("Y-m-d");
                
                // fill student, student_seminar, orders
                $student = new Student();

                $student->name = $this->student_name;

                if(!$student->save())
                {
                    return false;
                }

                $order   = new Orders();

                $order->amount   = 0;

                foreach($selectedSeminars as $seminarId => $seminarOptions )
                {
                    $seminar = Seminar::model()->findByPk( $seminarId );

                    $order->amount   += $seminar->price;
                }

                $order->details        = "Summer siminars payment";

                $order->payment_status = 'pending';

                if(!$order->save())
                {
                    return false;
                }


                $this->order_id = $order->id;

                
                foreach($selectedSeminars as $seminarId => $seminarOptions )
                {
                    $studentSeminar = new StudentSeminars();

                    $studentSeminar->student_id      = $student->id;
                    $studentSeminar->seminar_id      = $seminarId;
                    $studentSeminar->grade_id        = $seminarOptions["gradeID"];
                    $studentSeminar->time_slot_id    = $seminarOptions["timeSlotID"];
                    $studentSeminar->date_period_id  = $seminarOptions["datePeriodID"];
                    $studentSeminar->enroll_form_id  = $this->enroll_form_id;
                    $studentSeminar->order_id        = $order->id;

                    if(!$studentSeminar->save())
                    {
                        return false;
                    }
                }
                

                return parent::save();

            }
   
            return parent::save();
            
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