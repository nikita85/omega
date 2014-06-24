<?php

//echo 321; exit;

class EnrollController extends Controller
{

    public $layout = '//layouts/default';

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->render('index');
	}

        public function actionOakknoll()
        {
            $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Creative Writing at Oak Knoll');
            $this->pageTitle = 'Oak Knoll registration';
            
            $model = new EnrollFormKnoll();
             
            if(isset($_POST['EnrollFormKnoll']))
            {
                $model->attributes=$_POST['EnrollFormKnoll'];
                
                if($model->save())
                    $this->redirect(array('/payment/checkout', "orderId"=>$model->order_id));
            }
            
            $seminar = Seminar::model()->findAllByAttributes(array("title"=>'knoll'))[0];
            
            foreach ($seminar->grades as $grade) 
            {
                $seminarGrades[$grade->title] = $grade->title;
            }

            $this->render("knoll_registration_form",array('model'=>$model, 'seminarGrades'=> $seminarGrades));
            
        }
        
        public function actionHillview()
        {
            $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Writing Workouts at Hillview');
            $this->pageTitle = 'Hillview registration';
            
            $model = new EnrollFormHillview();
             
            if(isset($_POST['EnrollFormHillview']))
            {
                $model->attributes=$_POST['EnrollFormHillview'];
                
                if($model->save())
                    $this->redirect(array('/payment/checkout', "orderId"=>$model->order_id));
            }
            
            $seminar = Seminar::model()->findAllByAttributes(array("title"=>'hillview'))[0];
            
            foreach ($seminar->grades as $grade) 
            {
                $seminarGrades[$grade->title] = $grade->title;
            }
            
            $this->render("hillview_registration_form", array('model'=>$model, 'seminarGrades'=> $seminarGrades));
        }

        public function actionSummer()
        {
            $this->breadcrumbs = BreadCrumbs::getBreadCrumbs('Classes/Summer Seminars');
            $this->pageTitle = 'Summer Classes registration';

            $model = new EnrollFormSummer();
            
            if( !empty($_POST["selected_seminars"]) ) 
            {
                $selectedSeminars  = json_decode($_POST["selected_seminars"], true);
                
                $yourSeminars = $this->parseSelectedSemimars($selectedSeminars);
                
                if( !empty($_POST["EnrollFormSummer"]))
                {
                    $model->attributes=$_POST['EnrollFormSummer'];

                    if($model->save( $selectedSeminars ))
                        $this->redirect(array('/payment/checkout', "orderId"=>$model->order_id));
                   
                }
//                
                $data = array('model'             => $model , 
                              'selected_seminars' => htmlspecialchars($_POST["selected_seminars"]), 
                              'yourSeminars'      => $yourSeminars
                        );
                
                $this->render("summer_classes_registration_form",  $data);
            }
            else 
            {
                $this->redirect(array('/classes/summer'));
            }
           
        }
        
        private function parseSelectedSemimars( $selectedSeminars ) 
        {
            $seminars = array();
            
            foreach($selectedSeminars as $seminarId => $seminarOptions)
            {
                $seminar    = Seminar::model()->findByPk( $seminarId );
                $grade      = Grade::model()->findByPk( $seminarOptions["gradeID"] );
                $datePeriod = DatePeriods::model()->findByPk( $seminarOptions["datePeriodID"] );
                $timeSlot   = TimeSlot::model()->findByPk( $seminarOptions["timeSlotID"] );
                
                $startDate = DateTime::createFromFormat('Y-m-d', $datePeriod->start_date);
                $endDate   = DateTime::createFromFormat('Y-m-d', $datePeriod->end_date);
//            echo $date->format('Y-m-d');
                
                $seminars[] = array(
                                "description" => $seminar->description,
                                "grade"       => $grade->title,
                                "date_period" => $startDate->format('M d') .  ' - ' . $endDate->format('M d') ,
                                "time_slot"   => substr($timeSlot->start_time, 0, 5) .  ' - ' . substr($timeSlot->end_time, 0, 5),
                            );
            }
            
            return $seminars;
        }
       
}
