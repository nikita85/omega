<?php
/**
 * Class IndexController
 */
class IndexController extends AdminController
{

    public $layout = '/layouts/column1';

    /**
     * Init action
     */
    public function actionIndex()
	{
       // die(var_dump($this->module->menu, 1));
        $this->render('index');
	}

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->getReturnUrl(['/admin/index/index']));
            }
        }

        $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);

        $this->redirect(Yii::app()->user->loginUrl);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {

            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];

            } else {
                $this->render('error', $error);
            }

        }
    }
}