<?php

class MonthPuzzleParticipantController extends AdminController
{
    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->pushBreadcrumb('Puzzle Emails', ['/admin/monthPuzzleParticipant']);
    }

    /**
     *
     */
    public function actionIndex()
    {
        $monthPuzzleParticipant = new MonthPuzzleParticipant();

//        $this->initListActions($tutorStudent);

        $this->actionTitle = 'Puzzle Emails';

        $this->render('index', ['model' => $monthPuzzleParticipant]);
    }

    /**
     * @param $id
     */
    public function actionDelete($id)
    {
        $monthPuzzleParticipant = MonthPuzzleParticipant::model()->findByPk($id);
        if (!empty($monthPuzzleParticipant)) {

            $monthPuzzleParticipant->delete();
        }

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
    }

}