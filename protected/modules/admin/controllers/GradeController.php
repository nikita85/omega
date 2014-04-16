<?php

class GradeController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Grade', ['/admin/grade']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $grade = new Grade();

        $this->initListActions($grade);

        $this->actionTitle = 'Grade';

        $this->render('index', ['model' => $grade]);
    }

    /**
     * Create time
     */
    public function actionCreate()
    {
        $grade = new Grade();

        $this->layout = '/layouts/column1';
        $this->actionTitle = 'New Grade';
        $this->pushBreadcrumb('Grade', ['/admin/grade/index']);
        $this->pushBreadcrumb('New Grade', ['/admin/grade/create']);

        $this->handleForm($grade);
    }

    /**
     * @param Grade $model
     */
    protected function handleForm(Grade $grade)
    {
        $this->initEntityActions($grade);

        if (isset($_POST['Grade'])) {


            $grade->attributes = $_POST['Grade'];

            if ($grade->save()) {
                $this->redirect(['index']);
            }

        }

        $this->render('form', [
            'grade' => $grade,
        ]);
    }

    /**
     * Update dayOff information
     * @param integer $id
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id, 'Grade');

        $this->layout = '/layouts/column2';
        $this->actionTitle = 'Edit Grade';
        $this->pushBreadcrumb('Grade', ['/admin/grade/index']);
        $this->pushBreadcrumb('Edit Grade', ['/admin/grade/create']);

        $this->handleForm($model);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $grade = Grade::model()->findByPk($id);
        if (!empty($grade)) {

            $grade->delete();
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