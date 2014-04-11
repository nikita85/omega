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
        $this->initEntityActions($seminarModel);
        $timeModel = new Time();

        if (isset($_POST['Seminar'])) {

            $transaction = Yii::app()->db->beginTransaction();

            try {
                $seminarModel->attributes = $_POST['Seminar'];


                if (!empty($_POST['Time'])) {

                    $times = [];

                    foreach ($_POST['Time'] as $id => $attributes) {
                        $time = preg_match('/^new\-.+/', $id) ? new Time() : Time::model()->findByPk($id);

                        $time->attributes = $attributes;

                        $times[] = $time;
                    }

                    $seminarModel->times = $times;

                }

                if (!$seminarModel->save()) {
                    throw new Exception;
                }

                $transaction->commit();

                Yii::app()->user->setFlash('success', 'Saved Successfully');
                //$this->redirect(['index']);
                $this->redirect(['index']);

            } catch (Exception $e) {
                Yii::app()->user->setFlash('error', 'Error occurred');
                $transaction->rollback();
            }

            $seminarModel->attributes = $_POST['Seminar'];


/*            if (!empty($_POST['Time'])) {

                $times = [];

                foreach ($_POST['Time'] as $id => $attributes) {
                    $time = preg_match('/^new\-.+/', $id) ? new Time() : Time::model()->findByPk($id);

                    $time->attributes = $attributes;

                    $times[] = $time;
                }

                $seminarModel->times = $times;

            }*/


//            if ($seminarModel->save()) {
//
//                $this->redirect(['view', 'id' => $seminarModel->id]);
//            }

        }

        $this->render('form', [
            'seminarModel' => $seminarModel,
            'timeModel' => $timeModel,
        ]);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $educationVideo = EducationVideo::model()->findByPk($id);
        if (!empty($educationVideo)) {

            $educationVideo->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        return $this->redirect(['update', 'id' => $id]);
    }

}