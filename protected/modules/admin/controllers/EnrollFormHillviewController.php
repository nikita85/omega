<?php

class EnrollFormHillviewController extends AdminController {

    public $layout = '/layouts/column1';

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'EnrollFormHillview'),
        ));
    }

    public function actionCreate() {
        $model = new EnrollFormHillview;

        if (isset($_POST['EnrollFormHillview'])) {

            $model->setAttributes($_POST['EnrollFormHillview']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('//admin'));
            }


        }

        $seminar = Seminar::model()->findAllByAttributes(array("title"=>'hillview'))[0];

        foreach ($seminar->grades as $grade)
        {
            $seminarGrades[$grade->title] = $grade->title;
        }


        $this->render('create', array( 'model' => $model, "seminarGrades"=>$seminarGrades));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'EnrollFormHillview');


        if (isset($_POST['EnrollFormHillview'])) {
            $model->setAttributes($_POST['EnrollFormHillview']);

            if ($model->save()) {
//				$this->redirect(array('view', 'id' => $model->enroll_form_id));
                $this->redirect(array('//admin'));
            }
        }

        $seminar = Seminar::model()->findAllByAttributes(array("title"=>'hillview'))[0];

        foreach ($seminar->grades as $grade)
        {
            $seminarGrades[$grade->title] = $grade->title;
        }

        $this->render('update', array(
            'model' => $model,
            'seminarGrades'=>$seminarGrades
        ));
    }

    public function actionChangePaymentStatus($orderId, $status)
    {
        $order = Orders::model()->findByPk($orderId);
        $order->payment_status = $status;

        if($order->save()){
            Yii::app()->user->setFlash('success', 'Saved Successfully');
            $hillviewFormId = $order->enrollFormHillviews->enroll_form_id;
            $this->redirect(['enrollFormHillview/update', 'id' => $hillviewFormId]);
        } else {
            echo CActiveForm::validate($order);
        }
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'EnrollFormHillview')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('EnrollFormHillview');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new EnrollFormHillview('search');
        $model->unsetAttributes();

        if (isset($_GET['EnrollFormHillview']))
            $model->setAttributes($_GET['EnrollFormHillview']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}