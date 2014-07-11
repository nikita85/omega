<?php
/**
 * Class IndexController
 */
class IndexController extends AdminController
{

    public $layout = '/layouts/column1';

    /**
     * Init action
     */
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionOakknoll()
    {
        $this->pushBreadcrumb('Oak Knoll', ['/admin/index/oakknoll']);
        $enrollKnoll = new EnrollFormKnoll();

        $enrollKnoll->unsetAttributes();

        if (isset($_GET['EnrollFormKnoll'])) {
            $enrollKnoll->attributes = $_GET['EnrollFormKnoll'];
        }

        $this->render('oakknoll',[
            "enrollKnoll"   => $enrollKnoll,
        ]);
    }

    public function actionHillview()
    {
        $this->pushBreadcrumb('Hillview', ['/admin/index/hillview']);
        $enrollHillview = new EnrollFormHillview();

        $enrollHillview->unsetAttributes();

        if (isset($_GET['EnrollFormHillview'])) {
            $enrollHillview->attributes = $_GET['EnrollFormHillview'];
        }

        $this->render('hillview',[
            "enrollHillview"=> $enrollHillview,
        ]);
    }

    public function actionSummer()
    {
        $this->pushBreadcrumb('Summer Seminars', ['/admin/index/summer']);
        $enrollSummer   = new EnrollFormSummer('search');
        $enrollSummer->unsetAttributes();

        if (isset($_GET['EnrollFormSummer'])) {
            $enrollSummer->attributes = $_GET['EnrollFormSummer'];
        }

        $this->render('summer',[
            "enrollSummer"  => $enrollSummer
        ]);
    }

    public function actionExportHillview()
    {
        $enrollHillview = new EnrollFormHillview();

        $enrollHillview->unsetAttributes();

        if (isset($_GET['EnrollFormHillview'])) {
            $enrollHillview->attributes = $_GET['EnrollFormHillview'];
        }

        Yii::app()->csvExport->send($enrollHillview,
            array(
                'Student Name' => 'student_name',
                'Grade' => 'grade',
                'Class Day' => 'class_day',
                'Parent Name' => 'parent_name',
                'Parent Email' => 'parent_email',
                'Parent Phone' => 'parent_phone',
                'Address' => 'address',
                'City' => 'city',
                'Food Allergies' => 'food_alergies',
                'Payment Status' => 'order.payment_status',
                'Submit Date' => 'created',
            ),
            "HillView_Report"
        );

        Yii::app()->end();
    }

    public function actionExportOakknoll()
    {
        $enrollKnoll = new EnrollFormKnoll();

        $enrollKnoll->unsetAttributes();

        if (isset($_GET['EnrollFormKnoll'])) {
            $enrollKnoll->attributes = $_GET['EnrollFormKnoll'];
        }

        Yii::app()->csvExport->send($enrollKnoll,
            array(
                'Student Name' => 'student_name',
                'Grade' => 'grade',
                'Parent Name' => 'parent_name',
                'Parent Email' => 'parent_email',
                'Parent Phone' => 'parent_phone',
                'Address' => 'address',
                'City' => 'city',
                'Food Allergies' => 'food_alergies',
                'Additional Comments' => 'additional_comments',
                'Payment Status' => 'order.payment_status',
                'Submit Date' => 'created',
            ),
            "Oak_Knoll_Report"
        );

        Yii::app()->end();
    }

    public function actionExportSummer()
    {
        $enrollSummer = new EnrollFormSummer('search');

        $enrollSummer->unsetAttributes();

        if (isset($_GET['EnrollFormSummer'])) {
            $enrollSummer->attributes = $_GET['EnrollFormSummer'];
        }

        Yii::app()->csvExport->send($enrollSummer,
            array(
                'Student Name' => 'student_name',
                'Student Cell Phone' => 'student_cell_phone',
                'Studnet Email' => 'student_email',
                'Address' => 'student_address',
                'City' => 'city',
                'Food Allergies' => 'food_alergies',
                'Course Title' => 'order.studentSeminars.seminar.title',
                'Course Grade' => 'order.studentSeminars.grade.title',
                'Course Time' => 'order.studentSeminars.timeSlot',
                'Course Week' => 'order.studentSeminars.datePeriod',
                'Payment Status' => 'order.payment_status',
                'Submit Date' => 'submit_date',
            ),
            "Summer_Seminars_Report"
        );

        Yii::app()->end();
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->getReturnUrl(['/admin/index/index']));
            }
        }

        $this->render('login', ['model' => $model]);
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);

        $this->redirect(Yii::app()->user->loginUrl);
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {

            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];

            } else {
                $this->render('error', $error);
            }

        }
    }
}