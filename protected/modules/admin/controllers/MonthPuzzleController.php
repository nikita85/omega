<?php

class MonthPuzzleController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Month Puzzle', ['/admin/monthPuzzle']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $monthPuzzle = new MonthPuzzle();

        $this->initListActions($monthPuzzle);

        $this->actionTitle = 'Month Puzzle';

        $this->render('index', ['model' => $monthPuzzle]);
    }


    public function actionCreate()
    {
        $monthPuzzle = new MonthPuzzle();

        $this->layout = '/layouts/column1';
        $this->actionTitle = 'New Month Puzzle';
        $this->pushBreadcrumb('Month Puzzle', ['/admin/monthPuzzle/index']);
        $this->pushBreadcrumb('New Month Puzzle', ['/admin/monthPuzzle/create']);

        $this->handleForm($monthPuzzle);
    }

    /**
     * @param MonthPuzzle $model
     */
    protected function handleForm(MonthPuzzle $monthPuzzle)
    {
        $this->initEntityActions($monthPuzzle);

        if (isset($_POST['MonthPuzzle'])) {


            $monthPuzzle->attributes = $_POST['MonthPuzzle'];

            if ($monthPuzzle->save()) {
                $this->redirect(['index']);
            }

        }

        $this->render('form', [
            'monthPuzzle' => $monthPuzzle,
        ]);
    }


    /**
     * Update seminar information
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'MonthPuzzle');

        $this->layout = '/layouts/column2';
        $this->actionTitle = 'Edit Month Puzzle';
        $this->pushBreadcrumb('Month Puzzle', ['/admin/tutor/index']);
        $this->pushBreadcrumb('Edit MonthPuzzle', ['/admin/monthPuzzle/create']);

        $this->handleForm($model);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $monthPuzzle = MonthPuzzle::model()->findByPk($id);

        if (!empty($monthPuzzle)) {

            $monthPuzzle->delete();
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

    public function actionSwitchActivePuzzle()
    {

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }

        $puzzleId = $_POST['puzzleId'];


        $curActivePuzzle = MonthPuzzle::model()->findByAttributes(['active' => 1]);

        if (!empty($curActivePuzzle)) {
            $curActivePuzzle->active = 0;
            $curActivePuzzle->save();
        }

        $newActivePuzzle = MonthPuzzle::model()->findByPk($puzzleId);
        $newActivePuzzle->active = 1;
        if ($newActivePuzzle->save()) {
            echo CJSON::encode([
                'success' => $puzzleId,
            ]);
        }

    }

}