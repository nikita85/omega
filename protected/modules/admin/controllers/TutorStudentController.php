<?php

class TutorStudentController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Tutor Student', ['/admin/tutorStudent']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $tutorStudent = new TutorStudent();

//        $this->initListActions($tutorStudent);

        $this->actionTitle = 'Tutor Student';

        $this->render('index', ['model' => $tutorStudent]);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $tutorStudent = TutorStudent::model()->findByPk($id);
        if (!empty($tutorStudent)) {

            $tutorStudent->delete();
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

}