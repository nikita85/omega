<?php
/**
 *
 * Controller is the customized base controller class.
 * All controller classes for this module Admin should extend from this base class.
 *
 * @author Kovtunov Vladislav
 * @version $Id$
 */
class AdminController extends Controller
{
    public $assetsPath;

    public $actionTitle;
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '/layouts/column2';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = [];

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = [];

    public function beforeAction($action)
    {
        parent::beforeAction($action);

        //$this->collectLog();

        return true;
    }

/*    public function behaviors()
    {
        return [
            'csvExportBehavior' => ['class' => 'CsvExportBehavior'],
        ];
    }*/

    public function init()
    {
        parent::init();

        if(Yii::app()->user->isGuest) {
            Yii::app()->request->redirect(
                Yii::app()->createAbsoluteUrl('/admin/user/login')
            );
        }

        $this->assetsPath = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.assets'));

        /* JS Scripts */
        $this->registerScriptFile($this->module->assetsPath . '/js/main.js');
        $this->registerScriptFile($this->module->assetsPath . '/jqwidgets/jqxcore.js');
        $this->registerScriptFile($this->module->assetsPath . '/jqwidgets/jqxcalendar.js');
        $this->registerScriptFile($this->module->assetsPath . '/jqwidgets/jqxdatetimeinput.js');
        $this->registerScriptFile($this->module->assetsPath . '/jqwidgets/jqxinput.js');
        $this->registerScriptFile($this->module->assetsPath . '/jqwidgets/globalize.js');

        /* CSS Scripts */
        $this->registerCssFile($this->module->assetsPath . '/jqwidgets/jqx.base.css');
        $this->registerCssFile($this->module->assetsPath . '/css/main.css', 'screen, projection');

    }




    /**
     * Log leads for all systems users
     */
    public function collectLog()
    {
        $stat = new Statistics();

        $stat->path = Yii::app()->controller->route;
        $stat->prev_path = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
        $stat->action = Statistics::$types['lead'];
        $stat->user_id = Yii::app()->user->id;
        $stat->action_time = new CDbExpression('NOW()');

        $stat->save();
    }

    /**
     * @param $label
     * @param $url
     */
    public function pushBreadcrumb($label, $url)
    {
        $this->breadcrumbs[AdminModule::t('ui', $label)] = $url;
    }

    /**
     * @param string $title
     */
    public function setPageTitle($title)
    {
        parent::setPageTitle(Yii::app()->name . ' | ' . $this->module->getName() . ' | ' . $title);
    }

    /**
     * @param integer|string $id
     * @param string $modelClass
     *
     * @return CActiveRecord
     * @throws CHttpException
     */
    public function loadModel($id, $modelClass)
    {
        if (!class_exists($modelClass)) {
            throw new CHttpException(404, 'The requested entity does not exist.');
        }

        $model = CActiveRecord::model($modelClass)->findByPk($id);

        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }


    /**
     *
     */
    public function getActionTitle()
    {
        if (!empty($this->actionTitle)) {
            return $this->actionTitle;
        }

        return $this->id . ' ' . $this->action->id;
    }

    /**
     * @param CActiveRecord $model
     */
    public function initEntityActions(CActiveRecord $model)
    {
        $this->menu = array_merge($this->menu, [
            ($this->action->id == 'update'
                ? ['label' => AdminModule::t('ui', 'View'), 'url' => ['/admin/' . $this->getId() . '/view/id/' . $model->id], 'icon' => 'eye-open']
                : ['label' => AdminModule::t('ui', 'Edit'), 'url' => ['/admin/' . $this->getId() . '/update/id/' . $model->id], 'icon' => 'pencil']
            ),
            ['label' => AdminModule::t('ui', 'Delete'), 'url' => ['/admin/' . $this->getId() . '/delete/id/' . $model->id], 'icon' => 'trash'],
        ]);
    }

    /**
     * @param CActiveRecord $model
     */
    public function initListActions(CActiveRecord $model)
    {
        $this->menu = array_merge($this->menu, [
            ['label' => AdminModule::t('ui', 'Create a new ' . get_class($model)), 'url' => ['/admin/' . $this->getId() . '/create'], 'icon' => 'plus-sign'],
//            ['label' => AdminModule::t('ui', 'Export to .CSV'), 'url' => ['/admin/' . $this->getId() . '/csv'], 'icon' => 'file'],
        ]);
    }

    /**
     * Performs the AJAX validation.
     * @param  $model the model to be validated
     * @param  string $formName
     */
    protected function performAjaxValidation($model, $formName)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === $formName) {

            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Export to CVS users data
     * @param string $tableName table name for export
     */
    public function actionCvs($tableName = 'content')
    {
        $outputFile = Yii::getPathOfAlias('webroot') .DS .'uploads'.DS. 'export.csv';
        file_put_contents($outputFile,'');

        if (file_exists($outputFile)) {

            Yii::import('ext.ECSVExport');

            $cmd = Yii::app()->db->createCommand("SELECT * FROM " . $tableName);
            $csv = new ECSVExport($cmd);
            $csv->toCSV($outputFile);
            $this->sendCsvToBrowser($outputFile,date('Y-m-d'));
        }
    }

    /**
     * @param string $filePath   path to file
     * @param bool   $deleteFile if file don't need to delete set to false
     * @return void
     */
    protected function sendCsvToBrowser($filePath, $fileName = null,$deleteFile = true)
    {
        clearstatcache(null, $filePath);

        header('Content-Description: File Transfer');
        header('Content-Encoding: UTF-8');
        header('Cache-Control: no-store, no-cache');
        header('Expires: 0');
        header('Content-type: text/csv; charset=UTF-8');

        if ($fileName === null){
            header('Content-Disposition: attachment; filename=data' . date('Y-m-d') . '.csv');
        } else {
            header("Content-Disposition: attachment; filename={$fileName }.csv");
        }

        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));


        // UTF BOM
        echo "\xEF\xBB\xBF";
        echo file_get_contents($filePath);
        if ($deleteFile) {
            unlink($deleteFile);
        }
        exit;
    }
}
