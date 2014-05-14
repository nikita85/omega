<?php

//echo 321; exit;

class PaymentController extends Controller
{

    public $layout = '//layouts/default';

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
    public function actionIndex()
    {
            $this->render('index');
    }
    
    public function actionCheckout( $orderId )
    {
        $this->pageTitle = 'Payment checkout';
        
        $payPalData = Yii::app()->paypalButton->getButtonData( $orderId, 'string' );
        
        $order = Orders::model()->findByPk($orderId);
        
        $viewData = array(
            "payPalData"       => $payPalData,
            "price"            => $order->amount,
            "grade"            => $order->studentSeminars[0]->grade->title,
            "orderDescription" => $order->details,
        ); 
        
        $this->render('checkout', $viewData);
    }
    
    public function actionCallback( $orderId )
    {
        // proceed paypal callback request
        $postdata = file_get_contents("php://input");
        
        
        Yii::log($postdata,'warning', 'application'); // temporary for debuging 
        Yii::log(print_r($_REQUEST, true),'warning', 'application'); // temporary for debuging 
//        Yii::trace("PaymentController");
    }

}
