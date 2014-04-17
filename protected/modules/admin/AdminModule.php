<?php
/**
 * Class AdminModule
 */
class AdminModule extends CWebModule
{
    /**
     * @var array
     */
    public $menu = [];


    public $assetsPath;

    /**
     * @var string
     */
    public $defaultController = 'index';

    /**
     * @var string
     */
    public $homeUrl = '/admin/index/login';

    /**
     * @return string
     */
    public function getName()
    {
        return 'Main';
    }

    /**
     *
     */
    public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport([
			'admin.models.*',
            'admin.components.*',
		]);

        Yii::app()->setComponents([
            'user' => [
                'class'          => 'WebUser',
                'allowAutoLogin' => true,
                'loginUrl'       => Yii::app()->createUrl('/admin/index/login'),
            ],
            'bootstrap' => [
                'class' => 'application.extensions.bootstrap'
            ],
            'errorHandler' => [
                'errorAction' => '/error/index',
            ],
        ]);

        $this->menu = require Yii::getPathOfAlias('admin.config') . DIRECTORY_SEPARATOR . 'menu.php';

        $this->assetsPath = Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.admin.assets'));

	}

    /**
     * @param CController $controller
     * @param CAction $action
     * @return bool
     */
    public function beforeControllerAction($controller, $action)
	{
		if (parent::beforeControllerAction($controller, $action)) {
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;

		} else {
            return false;
        }
	}

    /**
     * @param       $category
     * @param       $message
     * @param array $params
     * @param null  $source
     * @param null  $language
     *
     * @return string
     */
    static function t($category, $message, $params = [], $source = null, $language = null)
    {
        return Yii::t('AdminModule.' . $category, $message, $params, $source, $language);
    }

}
