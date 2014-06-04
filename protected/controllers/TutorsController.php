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