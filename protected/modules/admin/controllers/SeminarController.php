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
        $model = new Seminar();

        $this->layout = '/layouts/column1';
        $this->actionTitle = 'New Seminar';
        $this->pushBreadcrumb('Seminar', ['/admin/seminar/index']);
        $this->pushBreadcrumb('New Seminar', ['/admin/seminar/create']);

        $this->handleForm($model);
    }

    /**
     * @param Seminar $model
     */
    protected function handleForm(Seminar $model)
    {
        $this->initEntityActions($model);

        if (isset($_POST['Seminar'])) {

            $model->attributes = $_POST['Seminar'];

            if ($model->save()) {

                $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $this->render('form', [
            'model' => $model,
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