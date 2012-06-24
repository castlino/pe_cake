<?php

App::import('Component', 'Email');
class MailerComponent extends EmailComponent
{

    var $fromEmailAddress = "PricesEngine <service@pricesengine.com>";

    function sendOrderReceived($toEmailAdd, $receipeintName, $orderId_asPurchaseId, $isVerified ){
        $this->reset();
        $this->from = $this->fromEmailAddress;
        $this->to = $toEmailAdd;
        $this->subject = "Purchase Order Received by PricesEngine.com";
        if($isVerified != "verified"){
            $this->send("Dear ".$receipeintName.", "."\n"."\n".
                                                           "Thank you for shopping at pricesengine.com."."\n"."\n".
                                                           "Your purchase order is now being receive."."\n"."\n".
                                                           "For your reference, your purchase id is PE2899".sprintf("%04d",$orderId_asPurchaseId)."."."\n"."\n".
                                                           
                                                           "NOTE:"."\n".
                                                           "As stated in the Terms and Conditions of purchase, we do not accept payment with \"UNVERIFIED\" ACCOUNT STATUS in Paypal. ".
                                                           "Some customers have sent email to us said they'll go and do the verification in Paypal account. ".
                                                           "That's the reason we delay the dispatching of the orders."."\n"."\n".

                                                           "You can either do the verification through Paypal OR reply us with the cancellation request. ".
                                                           "We'll process you orders as soon as we get your reply."."\n"."\n".

                                                           "The reason for the delay is first week we received a large number of orders with a \"Unverified\" Paypal account, ".
                                                           "which is against our Terms and Conditions of purchase. Our account department have to contact ALL of them and notify ".
                                                           "them the requirement of the \"Verified\" Paypal account."."\n"."\n".

                                                           "We apologize for our neglect and we'll try our best to provide you a better online shopping experience."."\n"."\n".

                                                           "The verification for your Paypal account does not mean your payment will go through the bank account.".
                                                           "You can still choose to pay by your credit card. PayPal encourages members to become Verified to ".
                                                           "increase trust and safety in our community. Because financial institutions screen their account holders, ".
                                                           "PayPal's Verification process increases security when you pay to parties you do not know. ".
                                                           "Verification gives you more information about the people you transact with through PayPal, so that you ".
                                                           "can make more informed decisions. PayPal encourages members to become Verified to build trust in our community.".
                                                           "After three days, pricesengine has the right to cancel the order if your Paypal account is still unverified. In the event ".
                                                           "that we cancel your order, we will provide a full refund of any payment received."."\n"."\n"."\n".

                                                           "Thank you."."\n"."\n"."\n".

                                                           "Best Regards,"."\n"."\n".
                                                           "The PricesEngine Team"."\n"."\n"."\n".
                                                           "This email address was specified when the order was placed online. If you don't think you placed this order, please contact us ASAP via"."\n".
                                                           "service@pricesengine.com");
        }else{
             $this->send("Dear ".$receipeintName.", "."\n"."\n".
                                                           "Thank you for shopping at pricesengine.com."."\n"."\n".
                                                           "Your purchase order is now being receive."."\n"."\n".
                                                           "For your reference, your purchase id is PE2899".sprintf("%04d",$orderId_asPurchaseId)."."."\n"."\n".

                                                           "Thank you."."\n"."\n"."\n".

                                                           "Best Regards,"."\n"."\n".
                                                           "The PricesEngine Team"."\n"."\n"."\n".
                                                           "This email address was specified when the order was placed online. If you don't think you placed this order, please contact us ASAP via"."\n".
                                                           "service@pricesengine.com");
        }

    }

    function sendOrderProcessed($toEmailAdd, $receipeintName, $lightspeedId_asOrderId ){
        $this->reset();
        $this->from = $this->fromEmailAddress;
        $this->to = $toEmailAdd;
        $this->subject = "Purchase Order Processed by PricesEngine.com";
        $this->send("Dear ".$receipeintName.", "."\n"."\n".
                                                           "This is just a courtesy update regarding your purchase."."\n"."\n".
                                                           "Your purchase order is now being processed."."\n"."\n".
                                                           "For your reference, your order id is O-".$lightspeedId_asOrderId."."."\n"."\n".
                                                           "Thank you."."\n"."\n"."\n".

                                                           "Best Regards,"."\n"."\n".
                                                           "The PricesEngine Team"."\n"."\n"."\n".
                                                           "This email address was specified when the order was placed online. If you don't think you placed this order, please contact us ASAP via"."\n".
                                                           "service@pricesengine.com");

    }

    function sendOrderApproved($toEmailAdd, $receipeintName, $lightspeedId_asOrderId ){
        $this->reset();
        $this->from = $this->fromEmailAddress;
        $this->to = $toEmailAdd;
        $this->subject = "Purchase Order Approved by PricesEngine.com";
        $this->send("Dear ".$receipeintName.", "."\n"."\n".
                                                           "This is just a courtesy update regarding your purchase."."\n"."\n".
                                                           "Your purchase order has already been approved [ O-".$lightspeedId_asOrderId." ]."."\n"."\n".
                                                           "Thank you."."\n"."\n"."\n".

                                                           "Best Regards,"."\n"."\n".
                                                           "The PricesEngine Team"."\n"."\n"."\n".
                                                           "This email address was specified when the order was placed online. If you don't think you placed this order, please contact us ASAP via"."\n".
                                                           "service@pricesengine.com");

    }

    function sendOrderShipped($toEmailAdd, $receipeintName, $lightspeedId_asOrderId, $invoice_number, $trackingNumber, $courier ){
        $this->reset();
        $this->from = $this->fromEmailAddress;
        $this->to = $toEmailAdd;
        $this->subject = "Order Processed by PricesEngine.com";
        $this->attachments = array("pdfinv/invoice_".$invoice_number.".pdf");

        if($courier=="eParcel"){
            $courierWebSite = "http://auspost.com.au/";
        }else{
            $courierWebSite = "http://fastway.com.au/";
        }

        $this->send("Dear ".$receipeintName.", "."\n"."\n".
                                                           "This is just a courtesy update regarding your purchase."."\n"."\n".
                                                           "Your purchased items has already been shipped [ O-".$lightspeedId_asOrderId." ]."."\n"."\n".
                                                           "Your courier's tracking number is: ".$trackingNumber."\n"."\n".
                                                           "You may track your item at ".$courierWebSite."\n"."\n"."\n".
                                                           "Once again, thank you for shopping with us..."."\n"."\n"."\n".

                                                           "Best Regards,"."\n"."\n".
                                                           "The PricesEngine Team"."\n"."\n"."\n".
                                                           "This email address was specified when the order was placed online. If you don't think you placed this order, please contact us ASAP via"."\n".
                                                           "service@pricesengine.com");

    }
}


?>
