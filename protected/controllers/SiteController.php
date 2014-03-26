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
        $model = new Applicant();

        if(isset($_POST['ajax']) && $_POST['ajax']==='subscribe-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['Applicant']))
        {
            $model->attributes=$_POST['Applicant'];
            $valid=$model->validate();
            if($valid)
            {
                //Здесь обрабатываем данные формы (сохранение, обновление ...)
            } else {

            }
            Yii::app()->end();
        }

        $this->render('jobs', [
            'model' => $model
        ]);
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

    public function actionMakeemLaugh()
    {
        $this->render('make‘em_laugh');
    }

    public function actionPowerOfStory()
    {
        $this->render('power_of_story');
    }

    public function actionMainClasses()
    {
        $this->render('main_classes');
    }

    public function actionTutors()
    {
        $this->render('tutors');
    }

    public function actionSummerClassesRegistrationForm()
    {
        $this->render('summer_classes_registration_form');
    }

    public function actionOurMarket()
    {
        $this->render('our_market');
    }

    public function actionUploadCv()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        // folder for uploaded files
        $folder = Yii::getPathOfAlias('webroot') . '/uploads/';

        //array("jpg","jpeg","gif","exe","mov" and etc...
        $allowedExtensions = array("docx", "doc", "pdf", "rtf", "odt");

        // maximum file size in bytes
        $sizeLimit = 20 * 1024 * 1024;

        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);

        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);

        // it's array
        echo $return;

        Yii::app()->end();
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
