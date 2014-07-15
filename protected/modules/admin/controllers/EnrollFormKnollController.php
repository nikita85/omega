<?php

class EnrollFormKnollController extends AdminController {

public $layout = '/layouts/column1';

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EnrollFormKnoll'),
		));
	}

	public function actionCreate() {
		$model = new EnrollFormKnoll;

		if (isset($_POST['EnrollFormKnoll'])) {
                    
			$model->setAttributes($_POST['EnrollFormKnoll']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('//admin'));
			}
                        
                        
		}

                $seminar = Seminar::model()->findAllByAttributes(array("title"=>'knoll'))[0];
            
                foreach ($seminar->grades as $grade) 
                {
                    $seminarGrades[$grade->title] = $grade->title;
                }

                
		$this->render('create', array( 'model' => $model, "seminarGrades"=>$seminarGrades));
	}

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'EnrollFormKnoll');

        if (isset($_POST['EnrollFormKnoll'])) {
            $model->setAttributes($_POST['EnrollFormKnoll']);

            if ($model->save()) {
                $this->redirect(array('//admin'));
            }
        }

        $seminar = Seminar::model()->findAllByAttributes(array("title" => 'knoll'))[0];

        foreach ($seminar->grades as $grade) {
            $seminarGrades[$grade->title] = $grade->title;
        }

        $this->render('update', array(
            'model' => $model,
            'seminarGrades' => $seminarGrades
        ));
    }

    public function actionChangePaymentStatus($orderId, $status)
    {
        $order = Orders::model()->findByPk($orderId);
        $order->payment_status = $status;

        if($order->save()){
            Yii::app()->user->setFlash('success', 'Saved Successfully');
            $knollFormId = $order->enrollFormKnolls->enroll_form_id;
            $this->redirect(['enrollFormKnoll/update', 'id' => $knollFormId]);
        } else {
            echo CActiveForm::validate($order);
        }
    }

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'EnrollFormKnoll')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('EnrollFormKnoll');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new EnrollFormKnoll('search');
		$model->unsetAttributes();

		if (isset($_GET['EnrollFormKnoll']))
			$model->setAttributes($_GET['EnrollFormKnoll']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}