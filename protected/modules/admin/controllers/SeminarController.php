<?php
/**
 * @author Oleg Subbotin <oleg.subotin@gmail.com>
 * @date   7/5/13
 */

class SeminarController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Seminar', ['/admin/seminar']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $seminar = new Seminar();

        $this->initListActions($seminar);

        $this->actionTitle = 'Seminar';

        $this->render('index', ['model' => $seminar]);
    }

    /**
     * Create time
     */
    public function actionCreate()
    {
        $seminarModel = new Seminar();

        $this->layout = '/layouts/column1';
        $this->actionTitle = 'New Seminar';
        $this->pushBreadcrumb('Seminar', ['/admin/seminar/index']);
        $this->pushBreadcrumb('New Seminar', ['/admin/seminar/create']);

        $this->handleForm($seminarModel);
    }

    /**
     * @param Seminar $model
     */
    protected function handleForm(Seminar $seminarModel)
    {
        $seminarModel->attachBehavior('ManyToManyBehavior', new ManyToManyBehavior);
        //var_dump($seminarModel->grades);die;
        $this->initEntityActions($seminarModel);

        if (isset($_POST['Seminar'])) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                $params = $_POST['Seminar'];

                if (!empty($_POST['Time'])) {

                    $timeSlots = [];

                    foreach ($_POST['Time'] as $id => $attributes) {
                        $timeSlot = preg_match('/^new\-.+/', $id) ? new TimeSlot() : TimeSlot::model()->findByPk($id);

                        $timeSlot->start_time =  date('H:i:s', strtotime($attributes['start_time']));
                        $timeSlot->end_time =  date('H:i:s', strtotime($attributes['end_time']));

                        $timeSlots[$id] = $timeSlot;
                    }

                    foreach($seminarModel->timeSlots as $timeSlot) {
                        if(!array_key_exists($timeSlot->id, $timeSlots)) {
                            $timeSlot->delete();
                        }
                    }

                    $seminarModel->timeSlots = $timeSlots;
                } else {
                    foreach($seminarModel->timeSlots as $timeSlot) {
                        $timeSlot->delete();
                    }
                }

                if (!empty($_POST['DatePeriod'])) {

                    $datePeriods = [];
                    //var_dump($_POST['DatePeriod']);die;
                    foreach ($_POST['DatePeriod'] as $id => $attributes) {

                        $datePeriod = preg_match('/^new\-.+/', $id) ? new DatePeriod() : DatePeriod::model()->findByPk($id);

                        $datePeriod->start_date  = $attributes['start_date'];
                        $datePeriod->end_date    = $attributes['end_date'];
                        $datePeriod->description = $attributes['description'];

                        $datePeriods[$id] = $datePeriod;
                    }

                    foreach($seminarModel->date_periods as $datePeriod) {
                        if(!array_key_exists($datePeriod->id, $datePeriods)) {
                            $datePeriod->delete();
                        }
                    }

                    $seminarModel->date_periods = $datePeriods;

                } else {
                    foreach($seminarModel->date_periods as $datePeriod) {
                        $datePeriod->delete();
                    }
                }

                if (array_key_exists('gradesIDs', $params)) {
                    $seminarModel->grades = $params['gradesIDs'];
                }

                $seminarModel->attributes = $params;

                if (!$seminarModel->save()) {
                    throw new Exception;
                }

                $transaction->commit();

                Yii::app()->user->setFlash('success', 'Saved Successfully');

                $this->redirect(['index']);

            } catch (Exception $e) {
                //Yii::app()->user->setFlash('error', 'Error occurred');
                $transaction->rollback();
            }


        }

        $this->render('form', [
            'seminarModel' => $seminarModel,
        ]);
    }


    /**
     * Update seminar information
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Seminar');

        $this->layout = '/layouts/column2';
        $this->actionTitle = 'Edit Seminar';
        $this->pushBreadcrumb('Seminar', ['/admin/seminar/index']);
        $this->pushBreadcrumb('Edit Seminar', ['/admin/seminar/create']);

        $this->handleForm($model);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $seminar = Seminar::model()->findByPk($id);
        if (!empty($seminar)) {

            $seminar->delete();
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