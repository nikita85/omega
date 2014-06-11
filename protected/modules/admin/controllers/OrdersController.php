<?php


class OrdersController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Order', ['/admin/orders']);
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
     * @param Orders $model
     */
    protected function handleForm(Orders $order)
    {
        $order->attachBehavior('ManyToManyBehavior', new ManyToManyBehavior);
        //var_dump($seminarModel->grades);die;
        $this->initEntityActions($order);

        if (isset($_POST['Seminar'])) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                $params = $_POST['Seminar'];

                if (!empty($_POST['TimeSlot'])) {

                    $timeSlots = [];

                    foreach ($_POST['TimeSlot'] as $id => $attributes) {
                        $timeSlot = preg_match('/^new\-.+/', $id) ? new TimeSlot() : TimeSlot::model()->findByPk($id);

                        $timeSlot->start_time =  date('H:i:s', strtotime($attributes['start_time']));
                        $timeSlot->end_time   =  date('H:i:s', strtotime($attributes['end_time']));

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

                if (!empty($_POST['DatePeriods'])) {

                    $datePeriods = [];
                    //var_dump($_POST['DatePeriod']);die;
                    foreach ($_POST['DatePeriods'] as $id => $attributes) {

                        $datePeriod = preg_match('/^new\-.+/', $id) ? new DatePeriods() : DatePeriods::model()->findByPk($id);

                        $datePeriod->start_date  = $attributes['start_date'];
                        $datePeriod->end_date    = $attributes['end_date'];
                        $datePeriod->description = $attributes['description'];

                        $datePeriods[$id] = $datePeriod;
                    }

                    foreach($seminarModel->datePeriods as $datePeriod) {
                        if(!array_key_exists($datePeriod->id, $datePeriods)) {
                            $datePeriod->delete();
                        }
                    }

                    $seminarModel->datePeriods = $datePeriods;

                } else {
                    foreach($seminarModel->datePeriods as $datePeriod) {
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
            'order' => $order,
        ]);
    }


    /**
     * Update order information
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Orders');

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