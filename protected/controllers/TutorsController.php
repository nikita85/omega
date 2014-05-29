<?php

class TutorsController extends Controller
{

    public $layout = '//layouts/default';

    public function actionIndex()
    {
        Yii::app()->clientScript->registerScriptFile($this->assetsPath . DS . 'js' . DS . 'tutors.js');

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
        $tutorStudent = new TutorStudent();
        $tutor = Tutor::model()->findByPk(7);

        $tutorStudent->tutors = $tutor;
        $weekDays = Yii::app()->params['weekDays'];




        $this->render('form', [
            'tutor' => $tutor,
            'tutorStudent' => $tutorStudent,
            'weekDays' => $weekDays,
        ]);
    }

}