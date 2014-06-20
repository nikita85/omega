<?php

class TutorsController extends Controller
{

    public $layout = '//layouts/default';

    public function actionIndex()
    {

        $cs=Yii::app()->getClientScript();
        $cs->registerCoreScript('yiiactiveform');
        $cs->registerScriptFile($this->assetsPath . DS . 'js' . DS . 'tutors.js');


        $tutors = Tutor::model()->findAllByAttributes(['active' => true]);
        $tutorsImgFolder = '/uploads/tutors_img/';
        $weekDays = Yii::app()->params['weekDays'];

        $this->render('tutors', [
            'tutors' => $tutors,
            'tutorsImgFolder' => $tutorsImgFolder,
            'weekDays' => $weekDays,
        ]);
    }

    public function actionForm()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }

        $tutorStudent = new TutorStudent();
        if(isset($_POST['tutor_id'])){
            $tutor = Tutor::model()->findByPk($_POST['tutor_id']);
            $tutorStudent->tutors = $tutor;
        }

        if(isset($_POST['ajax']) && $_POST['ajax']==='tutorStudent-form')
        {
            echo CActiveForm::validate($tutorStudent);
            Yii::app()->end();
        }

        if(isset($_POST['TutorStudent']))
        {
            $tutorStudent->attributes=$_POST['TutorStudent'];
            $valid = $tutorStudent->validate();
            if($valid)
            {
                $tutorStudent->save();

                try {
                    $message = new YiiMailMessage;

                    $message->subject = 'New tutor request - Omega Teaching';

                    $to = Yii::app()->params['adminEmail'];
                    array_push($to, $tutorStudent->tutors->email);
                    $message->setTo($to);
                    $message->from = 'noreply@omegateaching.com';
                    $message->setBody("Dear ". $tutorStudent->tutors->name. ",<br/>".
                                        "You've got a new request for tutoring from Omega Teaching student. Please see below for details.<br/><br/>
                                         Student's first name: " . $tutorStudent->first_name . "<br />
                                         Student's second name: " . $tutorStudent->second_name . "<br />
                                         Student's phone number: " . $tutorStudent->phone . "<br />
                                         Student's e-mail: " . $tutorStudent->email . "<br /><br />
                                         Teacher's name: " . $tutorStudent->tutors->name . "<br />
                                         Desired time: " . $tutorStudent->tutorDayTime . "<br />
                                         Alternative time: " . $tutorStudent->alternative_time . "<br />
                                         Other requests: " . $tutorStudent->other_requests . "<br />
                                         Sent date: " . date("Y-m-d H:i:s"). "<br /><br />
                                         Thank you,<br />
                                         The Omega Teaching team", 'text/html');

                    Yii::app()->mail->send($message);
                } catch (Exception $e) {
                }

                echo CJSON::encode(array(
                    'status'=>'success'
                ));
            } else
            {
                $error = CActiveForm::validate($tutorStudent);
                if($error!='[]')
                    echo $error;
            }
            Yii::app()->end();
        }

        Yii::app()->clientScript->corePackages = array();
        echo CJSON::encode([
            'popup_content'=>$this->renderPartial('form', [
                    'tutorStudent' => $tutorStudent,
                ], true, true)
        ]);
    }

}