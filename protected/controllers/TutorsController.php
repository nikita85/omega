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

}