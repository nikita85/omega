<?php

class DayOffController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Day Off', ['/admin/dayoff']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $dayOff = new DayOff();

        $this->initListActions($dayOff);

        $this->actionTitle = 'Day Off';

        $this->render('index', ['model' => $dayOff]);
    }

    /**
     * Create time
     */
    public function actionCreate()
    {
        $dayOff = new DayOff();

        $this->layout = '/layouts/column1';
        $this->actionTitle = 'New Day Off';
        $this->pushBreadcrumb('Day Off', ['/admin/dayOff/index']);
        $this->pushBreadcrumb('New Day Off', ['/admin/dayOff/create']);

        $this->handleForm($dayOff);
    }

    /**
     * @param DayOff $model
     */
    protected function handleForm(DayOff $dayOff)
    {
        $this->initEntityActions($dayOff);

        if (isset($_POST['DayOff'])) {


            $dayOff->attributes = $_POST['DayOff'];

            if ($dayOff->save()) {
                $this->redirect(['index']);
            }

        }

        $this->render('form', [
            'dayOff' => $dayOff,
        ]);
    }

    /**
     * Update dayOff information
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'DayOff');

        $this->layout = '/layouts/column2';
        $this->actionTitle = 'Edit Day Off';
        $this->pushBreadcrumb('Day Off', ['/admin/dayOff/index']);
        $this->pushBreadcrumb('Edit Day Off', ['/admin/dayOff/create']);

        $this->handleForm($model);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $dayOff = DayOff::model()->findByPk($id);
        if (!empty($dayOff)) {

            $dayOff->delete();
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }

      //  return $this->redirect(['index']);
    }

    /**
     * @param $id
     */
    public function actionView($id)
    {
        return $this->redirect(['update', 'id' => $id]);
    }

}