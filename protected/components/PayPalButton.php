<?php

/* 
 * doc http://paypal.github.io/JavaScriptButtons/
 */

class PayPalButton extends CApplicationComponent
{
    public $merchantId  = "nik_1492@yahoo.com"; // paypal merchant email or id
    public $callBackUrl = "http://ec2-204-236-149-253.us-west-1.compute.amazonaws.com/payment/callback"; 
    public $srcUrl      = "https://www.paypalobjects.com/js/external/paypal-button.min.js"; 
    public $sandBoxMode = true; 
 
    public function getButtonData( $orderId, $format='array' ) 
    {
        
        $order = Orders::model()->findByPk($orderId);
        
        if( empty($order) )
        {
            return false;
        }
        
        $buttonData = array();
        
        $buttonData["data-callback"] = $this->callBackUrl . "?orderId=$orderId";
        $buttonData["data-tax"]      = 0;
        $buttonData["data-shipping"] = 0;
        $buttonData["data-currency"] = "USD";
        $buttonData["data-amount"]   = $order->amount;
        $buttonData["data-quantity"] = 1;
        $buttonData["data-name"]     = $order->details;
        $buttonData["data-button"]   = "buynow";
        $buttonData["src"]           = $this->srcUrl . "?merchant=" . $this->merchantId;
        
        if( $this->sandBoxMode )
        {
            $buttonData["data-env"] = "sandbox";
        }
        
        if( $format == 'array' )
        {
            return $buttonData;
        }
        else
        {
            return $this->arrayToString($buttonData);
        }
        
        
        
    }
    
    protected function arrayToString( $array ) 
    {
        $string = "";
        
        foreach ($array as $key => $value) 
        {
            $string .= sprintf('%s="%s" ', $key, $value);
        }
        
        return $string;
    }

}