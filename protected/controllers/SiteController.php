<?php

class SiteController extends Controller
{

    public $layout = '//layouts/default';
    public $monthPuzzle = null;
    public $monthPuzzleParticipant = null;

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->monthPuzzle = MonthPuzzle::model()->findByAttributes(['active' => 1]);
        $this->monthPuzzleParticipant = new MonthPuzzleParticipant();
        $this->render('index', []);
    }

    public function actionMonthPuzzleForm()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }

        $monthPuzzleParticipant = new MonthPuzzleParticipant();

        if(isset($_POST['ajax']) && $_POST['ajax']==='monthPuzzleParticipant-form')
        {
            echo CActiveForm::validate($monthPuzzleParticipant);
            Yii::app()->end();
        }

        if(isset($_POST['MonthPuzzleParticipant']))
        {
            $monthPuzzleParticipant->attributes=$_POST['MonthPuzzleParticipant'];
            $valid = $monthPuzzleParticipant->validate();
            if($valid)
            {
                $monthPuzzleParticipant->save();

                $monthPuzzle = MonthPuzzle::model()->findByAttributes(['active' => 1]);

                try {
                    $message = new YiiMailMessage;

                    $message->subject = 'Month Puzzle';

                    $message->setTo($monthPuzzleParticipant->email);
                    $message->from = 'noreply@maximumtest.ru';
                    $message->setBody($monthPuzzle->answer, 'text/html');
                    Yii::app()->mail->send($message);
                } catch (Exception $e) {
                }

                echo CJSON::encode(array(
                    'status'=>'success'
                ));
            } else
            {
                $error = CActiveForm::validate($monthPuzzleParticipant);
                if($error!='[]')
                    echo $error;
            }
            Yii::app()->end();
        }

    }

    public function actionJobs()
    {
        $applicant = new Applicant();

        if(isset($_POST['ajax']) && $_POST['ajax']==='applicant-form')
        {
            echo CActiveForm::validate($applicant);
            Yii::app()->end();
        }

        if(isset($_POST['Applicant']))
        {
            $applicant->attributes=$_POST['Applicant'];
            $valid=$applicant->validate();
            if($valid)
            {
                $applicant->save();

                $tempFolder = Yii::getPathOfAlias('webroot') . '/uploads/temp_cv/';
                $cvSaveFolder = Yii::getPathOfAlias('webroot') . '/uploads/saved_cv/';

                rename($tempFolder.$applicant->cv, $cvSaveFolder.$applicant->cv);

                echo CJSON::encode(array(
                    'status'=>'success'
                ));
            } else
            {
                $error = CActiveForm::validate($applicant);
                if($error!='[]')
                    echo $error;
            }
            Yii::app()->end();
        }

        $this->render('jobs', [
            'applicant' => $applicant
        ]);
    }

//    public function actionLiteraryAnalysis()
//    {
//        $this->render('literary_analysis');
//    }
//
//    public function actionTestPrepBootCamp()
//    {
//        $this->render('test_prep_boot_camp');
//    }
//
//    public function actionEssayStatement()
//    {
//        $this->render('essay_statement');
//    }
//
//    public function actionMythsAndMonsters()
//    {
//        $this->render('myths_and_monsters');
//    }
//
//    public function actionTheDogs()
//    {
//        $this->render('the_dogs');
//    }
//
//    public function actionMakeemLaugh()
//    {
//        $this->render('make‘em_laugh');
//    }
//
//    public function actionPowerOfStory()
//    {
//        $this->render('power_of_story');
//    }
//
//    public function actionMainClasses()
//    {
//        $this->render('main_classes');
//    }
//
//    public function actionSummerClassesRegistrationForm()
//    {
//        $this->render('summer_classes_registration_form');
//    }
//
//    public function actionknollregistrationform()
//    {
//        $this->render('knoll_registration_form');
//    }
//
//    public function actionhillviewregistrationform()
//    {
//        $this->render('hillview_registration_form');
//    }

    public function actionOurMarket()
    {
        $this->render('our_market');
    }

    public function actionUploadCv()
    {
        Yii::import("ext.EAjaxUpload.qqFileUploader");

        // folder for uploaded files
        $folder = Yii::getPathOfAlias('webroot') . '/uploads/temp_cv/';

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
//
//    public function actionknoll()
//    {
//        $this->render('knoll');
//    }
//
//    public function actionhillview()
//    {
//        $this->render('hillview');
//    }

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
