<?php

class TutorController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Tutor', ['/admin/tutor']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $tutor = new Tutor();

        $this->initListActions($tutor);

        $this->actionTitle = 'Tutor';

        $this->render('index', ['model' => $tutor]);
    }

    /**
     * Create time
     */
    public function actionCreate()
    {
        $tutor = new Tutor();

        $this->layout = '/layouts/column1';
        $this->actionTitle = 'New Tutor';
        $this->pushBreadcrumb('Tutor', ['/admin/tutor/index']);
        $this->pushBreadcrumb('New Tutor', ['/admin/tutor/create']);

        $this->handleForm($tutor);
    }

    /**
     * @param Seminar $model
     */
    protected function handleForm(Tutor $tutor)
    {
        $this->initEntityActions($tutor);
        $weekDays = Yii::app()->params['weekDays'];
        $tutorsImgFolder = '/uploads/tutors_img/';

        if (isset($_POST['Tutor'])) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                $params = $_POST['Tutor'];

                if (!empty($_POST['TutorDayTime'])) {

                    $timeSlots = [];

                    foreach ($_POST['TutorDayTime'] as $id => $attributes) {
                        $timeSlot = preg_match('/^new\-.+/', $id) ? new TutorDayTime() : TutorDayTime::model()->findByPk($id);

                        $timeSlot->start_time =  date('H:i:s', strtotime($attributes['start_time']));
                        $timeSlot->end_time   =  date('H:i:s', strtotime($attributes['end_time']));
                        $timeSlot->weekday   =  $attributes['weekday'];

                        $timeSlots[$id] = $timeSlot;
                    }

                    foreach($tutor->tutorsDaysTimes as $timeSlot) {
                        if(!array_key_exists($timeSlot->id, $timeSlots)) {
                            $timeSlot->delete();
                        }
                    }

                    $tutor->tutorsDaysTimes = $timeSlots;
                } else {
                    foreach($tutor->tutorsDaysTimes as $timeSlot) {
                        $timeSlot->delete();
                    }
                }

                $tutor->attributes = $params;

                $imgFiles = $_FILES['Tutor'];
                if(!empty($imgFiles)) {
                    (empty($imgFiles['name']['big_image']))?:$tutor->big_image=CUploadedFile::getInstance($tutor,'big_image');
                    (empty($imgFiles['name']['small_image']))?:$tutor->small_image=CUploadedFile::getInstance($tutor,'small_image');
                }


                if (!$tutor->save()) {
                    throw new Exception;
                }

                $transaction->commit();

                Yii::app()->user->setFlash('success', 'Saved Successfully');
                $this->redirect(['index']);

            } catch (Exception $e) {
                //echo "<pre>";var_dump($e); echo "</pre>";
                //Yii::app()->user->setFlash('error', 'Error occurred');
                $transaction->rollback();
            }


        }

        $this->render('form', [
            'tutor' => $tutor,
            'weekDays' => $weekDays,
            'tutorsImgFolder' => $tutorsImgFolder,
        ]);
    }


    /**
     * Update seminar information
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Tutor');

        $this->layout = '/layouts/column2';
        $this->actionTitle = 'Edit Tutor';
        $this->pushBreadcrumb('Tutor', ['/admin/tutor/index']);
        $this->pushBreadcrumb('Edit Tutor', ['/admin/tutor/create']);

        $this->handleForm($model);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $tutor = Tutor::model()->findByPk($id);
        if (!empty($tutor)) {

            $tutor->delete();
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        return $this->redirect(['update', 'id' => $id]);
    }

}