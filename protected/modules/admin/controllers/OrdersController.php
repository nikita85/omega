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

    public function actionGetSeminarDetails()
    {
        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }

        $seminarId = $_POST['seminarId'];
        $seminar = Seminar::model()->findByPk($seminarId);

        $data= [];

        $data['grades'] = $seminar->grades;
        $data['timeSlots'] = [];
        foreach($seminar->timeSlots as $timeSlot){
            $formattedTimeSlot['id'] = $timeSlot->id;
            $formattedTimeSlot['title'] = $timeSlot->__toString();

            array_push($data['timeSlots'], $formattedTimeSlot);
        }

        $data['datePeriods'] = [];
        foreach($seminar->datePeriods as $datePeriod){
            $formattedDatePeriod['id'] = $datePeriod->id;
            $formattedDatePeriod['title'] = $datePeriod->__toString();

            array_push($data['datePeriods'], $formattedDatePeriod);
        }

        echo CJSON::encode([
            'success' => true,
            'details' => $data
        ]);
    }

    public function actionChangePaymentStatus($orderId, $status)
    {
        $order = Orders::model()->findByPk($orderId);
        $order->payment_status = $status;

        if($order->save()){
            Yii::app()->user->setFlash('success', 'Saved Successfully');
            $this->redirect(['orders/update', 'id' => $orderId]);
        } else {
            echo CActiveForm::validate($order);
        }
    }

    /**
     * @param Orders $model
     */
    protected function handleForm(Orders $order)
    {

        $order->attachBehavior('ManyToManyBehavior', new ManyToManyBehavior);

        //$this->initEntityActions($order);

        if (!empty($_POST)) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                $params = $_POST;

                if (!empty($_POST['StudentSeminars'])) {

                    $studentSeminars = [];

                    foreach ($_POST['StudentSeminars'] as $id => $attributes) {
                        $studentSeminar = StudentSeminars::model()->findByPk($id);
                       // echo '<pre>';var_dump($studentSeminar);echo'</pre>';
                       // $studentSeminar->seminar_id =  $attributes['seminar'];
                        $studentSeminar->grade_id   =   $attributes['grade'];
                        $studentSeminar->time_slot_id   =   $attributes['timeSlot'];
                        $studentSeminar->date_period_id  =   $attributes['datePeriod'];
                      //  echo '<pre>';var_dump($studentSeminar);echo'</pre>';die;

                        $studentSeminar->save();

                        $studentSeminars[$id] = $studentSeminar;
                    }


                    $order->studentSeminars = $studentSeminars;
                }

                $order->attributes = $params;
                $order->enrollFormSummers->attributes = $_POST['EnrollFormSummer'];
                $order->enrollFormSummers->save(null);

                if (!$order->save()) {
                    throw new Exception;
                }
                //echo '<pre>';var_dump($order->enrollFormSummers);echo'</pre>';die;
                $transaction->commit();

                Yii::app()->user->setFlash('success', 'Saved Successfully');


            } catch (Exception $e) {
                //  Yii::app()->user->setFlash('error', 'Error occurred');
                echo '<pre>';var_dump($e);echo'</pre>';die;
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
        $this->actionTitle = 'Edit Order';
        $this->pushBreadcrumb('Order', ['/admin/seminar/index']);
        $this->pushBreadcrumb('Edit Order', ['/admin/ordrs/create']);

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