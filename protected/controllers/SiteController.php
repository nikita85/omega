<?php

class SiteController extends Controller
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

    public function actionClasses()
    {
        $this->render('classes');
    }

    public function actionJobs()
    {
        $this->render('jobs');
    }

    public function actionLiteraryAnalysis()
    {
        $this->render('literary_analysis');
    }

    public function actionTestPrepBootCamp()
    {
        $this->render('test_prep_boot_camp');
    }

    public function actionEssayStatement()
    {
        $this->render('essay_statement');
    }

    public function actionMythsAndMonsters()
    {
        $this->render('myths_and_monsters');
    }

    public function actionTheDogs()
    {
        $this->render('the_dogs');
    }

    public function actionMainClasses()
    {
        $this->render('main_classes');
    }

    public function actionTutors()
    {
        $this->render('tutors');
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}
