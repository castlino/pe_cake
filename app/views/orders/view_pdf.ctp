<?php

    App::import('Vendor','tcpdf/tcpdf');
                    $tcpdf = new TCPDF();
                    $textfont = 'helvetica';

                    $tcpdf->SetAuthor("pricesengine.com");
                    $tcpdf->SetAutoPageBreak(true);

                    $tcpdf->setPrintHeader(false);
                    $tcpdf->setPrintFooter(false);

                    $tcpdf->SetTextColor(0, 0, 0);
                    $tcpdf->SetFont($textfont,'',9);

                    $tcpdf->AddPage();

                    //$tcpdf->setJPEGQuality(75);
                    $tcpdf->Image('img/pricesenginelogo.png', 10, 5, 50, 18, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);

                    $tcpdf->SetFont('times', 'B', 20);
                    //$tcpdf->Write(0, 'Tax Invoice', '', 0, 'C', 1, 0, false, false, 0);
                    $tcpdf->MultiCell(80, 5, 'Tax Invoice', 0, 'C', 0, 0, 70, '', true);

                    $tcpdf->SetFont('times', 'BI', 15);
                    $tcpdf->MultiCell(50, 5, 'Number: '.$OrderToPDF['Order']['invoice_number'], 0, 'R', 0, 0, 150, '', true);

                    $tcpdf->SetFont('times', 'BI', 10);
                    $tcpdf->MultiCell(80, 5, 'http://www.pricesengine.com', 0, 'L', 0, 1, 10, 22, true);

                    $tcpdf->SetFont('times', '', 10);
                    $tcpdf->MultiCell(55, 5, "\n"."\n"."\n"."\n"."Invoice Date: 01/02/2010"."\n".'ABN 66 128 917 680'
                                        , 0, 'L', 0, 0, '', '', true);

                    $tcpdf->SetFont('times', '', 10);
                    $tcpdf->MultiCell('', 30, "IDEAM PTY LTD"."\n"."Unit 207"."\n"."354 Eastern Valley Way,"."\n"."Chatswood, 2067"."\n"."Phone: 02 8090-7700"."\n"."sales@pricesengine.com.au"
                                        , 0, 'R', 0, 0, '', '', true);


                    $tcpdf->Line(10, 57, 200, 57);

                    $yPos = 60;
                    $xPos = 10;

                    $tcpdf->SetFillColor(255, 255, 127);
                    $tcpdf->SetFont('times', 'B', 12);
                    $tcpdf->MultiCell(94, 10, "BILL TO"."\n"."\n", 'LTR', 'L', 1, 0, $xPos, $yPos, true);
                    $tcpdf->SetFont('times', '', 12);
                    $tcpdf->MultiCell(94, 40, $OrderToPDF['Order']['paypal_firstname']." ".$OrderToPDF['Order']['paypal_lastname']."\n".
                                              "\n"."\n"."\n"."\n".
                                              //"Killara 2071"."\n".
                                              //"New South Wales, Australia"."\n"."\n".
                                              //""."\n".
                                              "email:   ".$OrderToPDF['Order']['shipping_email']
                                        , 'LRB', 'L', 1, 0, $xPos, $yPos+10, true);

                    $tcpdf->SetFont('times', 'B', 12);
                    $tcpdf->MultiCell(94, 10, "SHIP TO"."\n"."\n", 'LTR', 'L', 1, 0, $xPos+96, $yPos, true);
                    $tcpdf->SetFont('times', '', 12);
                    $tcpdf->MultiCell(94, 40, $OrderToPDF['Order']['shipping_name']."\n".
                                              $OrderToPDF['Order']['shipping_street_address1']." ".$OrderToPDF['Order']['shipping_street_address2']."\n".
                                              $OrderToPDF['Order']['shipping_suburb']." ".$OrderToPDF['Order']['shipping_postcode']."\n".
                                              $OrderToPDF['Order']['shipping_state']."\n"."\n".
                                              "email:   ".$OrderToPDF['Order']['shipping_email']
                                        , 'LRB', 'L', 1, 0, $xPos+96, $yPos+10, true);



                    //Allocation of spaces for purchase details
                    $xPos = 10;
                    $prodCode_xPos = 10;                        //w=40
                    $prodDesc_xPos = $xPos + 40;                //w=80
                    $prodQnty_xPos = $prodDesc_xPos + 80;       //w=20
                    $prodPrice_xPos = $prodQnty_xPos + 20;      //w=20
                    $prodTotal_xPos = $prodPrice_xPos + 20;     //w=40

                    // Product/Item details...
                    $yPos = 115;
                    $tcpdf->SetFillColor(204, 204, 204);
                    $tcpdf->SetFont('times', 'B', 10);
                    $tcpdf->MultiCell(40, 20, 'Product', 0, 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 20, 'Description/Name', 0, 'L', 1, 0, $prodDesc_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 20, 'Qty', 0, 'C', 1, 0, $prodQnty_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 20, 'Item Price', 0, 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 20, 'Subtotal', 0, 'R', 1, 0, $prodTotal_xPos, $yPos, true);

                    $tcpdf->SetFillColor(204, 255, 255);
                    $yPos = $yPos + 7;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(40, 20, $OrderToPDF['Product'][0]['model'], 'B', 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 20,
                                              //'27" Samsung TV Series 8, '."\n".
                                              //'Ports: hdmi vga dvi,'."\n".
                                              strip_tags($OrderToPDF['Product'][0]['name']), 'B', 'L', 1, 0, $prodDesc_xPos, $yPos, true);

                    $ProdPrice = $OrderToPDF['Product'][0]['price'];
                    $ProdQty = $Ord_Prod['OrdersProduct']['quantity'];
                    $TotProdQtyPrice = $ProdQty * $ProdPrice;
                    $tcpdf->MultiCell(20, 20, $ProdQty, 'B', 'C', 1, 0, $prodQnty_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 20, number_format($ProdPrice, 2), 'B', 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 20, number_format($TotProdQtyPrice, 2), 'B', 'R', 1, 0, $prodTotal_xPos, $yPos, true);


                    // Shipping details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(40, 10, 'Shipping', 'B', 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 10, 'Shipping Rate', 'B', 'L', 1, 0, $prodDesc_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 10, $ProdQty, 'B', 'C', 1, 0, $prodQnty_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 10, number_format($OrderToPDF['Order']['shipping_charge'], 2), 'B', 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 10, number_format($OrderToPDF['Order']['shipping_charge'], 2), 'B', 'R', 1, 0, $prodTotal_xPos, $yPos, true);

                    // Paypal details...
                    $yPos = $yPos + 10;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(40, 10, 'Service', 'B', 'L', 1, 1, $prodCode_xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 10, 'Paypal Surcharge', 'B', 'L', 1, 0, $prodDesc_xPos, $yPos, true);
                    $tcpdf->MultiCell(20, 10, '1', 'B', 'C', 1, 0, $prodQnty_xPos, $yPos, true);                    //Always 1...
                    $tcpdf->MultiCell(20, 10, number_format($OrderToPDF['Order']['paypal_surcharge'], 2), 'B', 'R', 1, 0, $prodPrice_xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 10, number_format($OrderToPDF['Order']['paypal_surcharge'], 2), 'B', 'R', 1, 0, $prodTotal_xPos, $yPos, true);

                    // Payment details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', 'B', 10);
                    $tcpdf->MultiCell(40, 10, 'Payment details', '0', 'L', 0, 1, $prodCode_xPos, $yPos, true);
                    $yPos = $yPos + 5;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->MultiCell(20, 10, 'Paypal', '0', 'L', 0, 1, $xPos, $yPos, true);
                    $tcpdf->MultiCell(30, 10, '01/04/2010', '0', 'L', 0, 1, $xPos+20, $yPos, true);
                    $tcpdf->MultiCell(50, 10, 'Order ID: O-'.$OrderToPDF['Order']['lightspeed_orderid'], '0', 'L', 0, 1, $xPos+50, $yPos, true);

                    // Shipping details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', 'B', 10);
                    $tcpdf->MultiCell(40, 10, 'Shipping details', '0', 'L', 0, 1, $prodCode_xPos, $yPos, true);
                    $yPos = $yPos + 5;
                    $tcpdf->SetFont('courier', '', 10);
                    $tcpdf->SetFont('courier', '', 10);
                    
                    $rawTrackingCode = $OrderToPDF['Order']['tracking_code'];
                    if(strlen($rawTrackingCode)>18){
                              $courierCompany = "eParcel";
                              $courierWebsite = "http://auspost.com.au/";
                              $realTrackingCode = substr($rawTrackingCode, 8, 16);
                    }else if(strlen($rawTrackingCode)>13){
                              $courierCompany = "eParcel";
                              $courierWebsite = "http://auspost.com.au/";
                              $realTrackingCode = substr($rawTrackingCode, 6);
                    }else{
                              $courierCompany = "fastWay";
                              $courierWebsite = "http://fastway.com.au/";
                              $realTrackingCode = substr($rawTrackingCode, 0, 12);
                    }
                    $tcpdf->MultiCell(30, 10, $courierCompany, '0', 'L', 0, 1, $xPos, $yPos, true);
                    $tcpdf->MultiCell(80, 10, 'Tracking Number: '.$realTrackingCode."\n".$courierWebsite, '0', 'L', 0, 1, $xPos+35, $yPos, true);


                    // Total details...
                    $yPos = $yPos + 20;
                    $tcpdf->SetFont('courier', 'B', 10);
                    $tcpdf->MultiCell(40, 6, 'Total:', 'B', 'R', 0, 1, $prodTotal_xPos-40, $yPos, true);

                    $shippingCharge = $OrderToPDF['Order']['paypal_surcharge'];
                    $paypalCharge = $OrderToPDF['Order']['shipping_charge'];
                    $totalAmountDue = $TotProdQtyPrice + $shippingCharge + $paypalCharge;
                    $tcpdf->MultiCell(30, 6, number_format($totalAmountDue, 2), 'B', 'R', 0, 0, $prodTotal_xPos, $yPos, true);
                    $yPos = $yPos + 10;
                    $tcpdf->MultiCell(40, 6, 'Payment:', 'B', 'R', 0, 1, $prodTotal_xPos-40, $yPos, true);
                    $tcpdf->MultiCell(30, 6, number_format($OrderToPDF['Order']['amount_paid'], 2), 'B', 'R', 0, 0, $prodTotal_xPos, $yPos, true);

                // create some HTML content
                /*
                    $htmlcontent =
                        "
                            <table>
                                <tr>
                                    <td>".$html->image("pricesenginelogo.png", array("width"=>"100px"))."</td>
                                    <td><span style='font-size: 17px;'>Tax Invoice</span></td>
                                    <td>Invoice Number:".$invNum."</td>
                                </tr>
                            </table>
                        ";
                    // output the HTML content
                    //$tcpdf->writeHTML($htmlcontent, true, 0, true, 0);
                */
                    $tcpdf->Output('filename.pdf', 'D');
                    //$tcpdf->Output("pdfinv/invoice_".$OrderToPDF['Order']['invoice_number'].".pdf", "F");
?>