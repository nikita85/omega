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
        
        $payPalData = Yii::app()->paypal->getButtonData( $orderId, 'string' );
        
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
        
        if( Yii::app()->paypal->verificateRequest( $postdata ) )
        {
            header("HTTP/1.1 200 OK");
            
            $order = Orders::model()->findByPk( (int)$orderId );
            
            if( !empty($order) )
            {
                $statusMapping = array("Completed" => "completed",
                                       "Pending"   => "pending" 
                                    );
                
                if( $order->payment_status == 'pending' )
                {
                    $order->payment_status = !empty($statusMapping[$_POST["payment_status"]]) ? $statusMapping[$_POST["payment_status"]] : "failed";
                    $order->payer_email    = !empty($_POST["payer_email"]) ? $_POST["payer_email"] : NULL;
                    $order->transaction_id = !empty($_POST["txn_id"])      ? $_POST["txn_id"] : NULL;
                    
                    $order->save();
                }
            }
        }
        else
        {
            header("HTTP/1.1 400 Bad Request");
            exit;
        }
        
        
        Yii::log($postdata,'warning', 'application'); // temporary for debuging 
        Yii::log(print_r($_REQUEST, true),'warning', 'application'); // temporary for debuging 
//        Yii::trace("PaymentController");
    }

}
