<?php
class InfosController extends AppController {

	var $name = 'Infos';
	var $uses = null;
	
	function beforeFilter(){
		parent::beforeFilter(); 
		$this->Auth->allowedActions = array('*');
	}

	function aboutUs() {
                $this->layout = 'default_no_countdown';
		//$this->set('aboutus', "pricesEngine.com is simply an online store that does it all quickly....");
                $this->set('aboutus', "
                                If everything you care about is the price, then you have come to the right place.<br />
                                pricesengine.com provides the cheapest possible prices in the market.<br />
                                Forget the hassles of providing a long list of your personal information, account registration and email verification that you usually do in a typical online store.<br />
                                With us, there are only 3 steps to complete your purchase:<br /><br />

                                1. Input quantity into the provided shopping cart quantity box.<br />

                                2. Click Paypal Checkout button to login to your Paypal account.<br />

                                3. Confirm your shipping and order information back here at pricesengine.<br /><br />

                                Then you're done!<br />
                                It's the most convenient way of shopping without wasting your time on the usual account sign-in which allows you more time perhaps for product specs verification. This is how we are serving our customers.<br />
                                Your online visit is important to us, The more frequent you check us out means the cheaper our prices get. So what are you waiting for? Get all of your mates at pricesengine.com and together we'll beat the lowest prices everyday.<br />
                        ");
	}

	function termsAndConditions() {
                $this->layout = 'default_no_countdown';
		//$this->set('termsConditions', "pricesEngine's terms and conditions is still being finalized, please come back later....");
                $this->set('termsConditions',"
                                Customer service is important for us!<br />
                                We want your shopping experience to be the fastest, friendliest and most importantly secure. The terms and conditions of Pricesengine are shown below. By visiting Pricesengine.com.au, you are accepting our privacy policy and are bound by our terms of use policy.  However, we reserve the right to make changes to this agreement from time to time at our sole discretion. By continuing to use the website, you agree to be bound by the changes. We are not obliged to notify you of any changes but we will endeavour to alert you to any significant changes. Nevertheless, you should check our published agreement and policies from time to time to acquaint yourself with the current version.<br /><br />


                                1.	Registration & Customer Information:<br />
                                • Customers DO NOT need to register with us for purchasing any products on Pricesengine.<br />
                                • We only collect customer information needed for shipping form Paypal and we do not share this information to third party without your permission.<br />
                                • Pricesengine is committed to reducing the amount of fraud it faces. Our policy is that we will prosecute any cases of fraud that we identify. As a first time customer, you may receive email requesting more information/proof to confirm the details that you have supplied to us. If any of the information you supply is found to be false or misleading, we will, if we deem it appropriate, report this to the appropriate authorities for them to prosecute.<br />
                                • When you submit feedback or questions via e-mail for information about our Website, we will request your name and e-mail address. We use this information solely to respond to your inquiries.<br />
                                • When you enter a contest or other promotional feature, we may ask for your name, address, and e-mail address so that we can administer the contest and notify winners. We may ask for other information to enable us to improve our site or to send you special offers.<br />
                                • Online payments are handled by Paypal external third party service providers. We do not see or store your credit card or banking details. Please check the paypal.com.au websites for details of their privacy policies and security measures.<br /><br />


                                2.	Website Information:<br />
                                • Information about products (i.e. goods and services) on the website is based on material provided by suppliers and product manufacturers.<br />
                                • You understand and agree that we cannot be held responsible for inaccuracies or errors caused by incorrect information supplied to us or by manufacturers or suppliers changing product specifications without noticing to us.<br />
                                • Customer agrees to make your own enquiries to verify information provided and to assess the suitability of products before you purchase.<br /><br />

                                3.	Orders:<br />
                                • Products displayed on the website do not constitute an offer to sell. It is an invitation to treat only.<br />
                                • Orders placed by customers are offers to purchase particular product under the terms and conditions in this agreement at the price specified (including delivery and other charges).<br />
                                • Pricesengine reserves the right to accept or reject your order for any reason including, but not limited to the unavailability of any product, an error in the price or product description, an error in your order or a payer status in your PayPal account is marked as unverified. For your PayPal status is unverified, we will wait three days for your PayPal account verification done since you place the order. After three days, pricesengine has the right to cancel the order if your Paypal status is still unverified. In the event that we cancel your order, we will provide a full refund of any payment received.<br />
                                • Pricesengine DO NOT accepts any return or refund once the order has been confirmed.<br /><br />

                                4.	Backorders:<br />
                                • Backorder occurs is when we don't have the product in stock and will need to order it from our suppliers. This procedure generally takes up to 14 days for the stock to arrive at our warehouse. Usually when backorders occurs we will notify you the estimated time of arrival (ETA) by email.<br /><br />

                                5.	Price:<br />
                                • The prices of products, delivery and other charges shown are in Australian dollars and include GST where applicable.<br />
                                • Prices are current at time of display but are subject to change.<br />
                                • There is a surcharge of 3%.<br /><br />

                                6.	Shipping:<br />
                                • For insurance purposes, Pricesengine does not deliver to overseas address.<br />
                                • Pricesengine aims to get parcels posted out within a day or two after ordering; however, certain issues can make it take anywhere up to 5 business days to dispatch. Once it leaves our hands, Australia Post or the courier company involved can take anywhere up to 7 business days (depending on location) to deliver. In the unlikely event that an order has not surfaced after that time, please contact us immediately and we are more than happy to chase it up with the warehouse or Australia Post for you. Therefore, we are not responsible for any delay arising during the shipment.<br />
                                Please note:<br />
                                -	Customer is responsible to have someone at the delivery address to sign and accept the delivery.<br />
                                -	Customer is responsible for all freight charges for re-deliveries; incorrect delivery details and these are added to the invoice total.<br />
                                -	Risk in goods, such as loss or damage, passes to customer upon delivery to the carrier.<br />
                                -	Pricesengine owns the title of any extra goods shipped with your order that have been dispatched in error.<br /><br />

                                7.	Payments:<br />
                                • Pricesengine accepts ONLY PayPal payment method.<br />
                                • All payments must be received in full prior to dispatch.<br />
                                • PayPal Account:  payment@pricesengine.com<br />
                                Please note:<br />
                                Pricesengine can process your order in a timely way after PayPal verified your account status. We DO NOT accept any payment from PayPal if account status is marked as unverified.<br /><br />
                                8.	Refund, Return and Warranty:<br />
                                Refund:<br />
                                • Customers’ satisfaction is our number one priority however, please choose carefully as Pricesengine DOES NOT refund or exchange because of any reasons below.<br />
                                -	Simply changes their mind or no longer wants the goods or service<br /><br />

                                -	Realizes they can’t afford the goods or service<br /><br />

                                -	Found the same item or service at a cheaper price elsewhere<br />
                                -	Chose the wrong size, colour or type of service<br />
                                -	Knew about the particular fault before buying it<br /><br />

                                -	Was responsible for causing a fault or damage after purchase<br /><br />

                                -	Insisted on the service being done despite warnings it may not meet their needs<br />
                                -	Does not offer proof of purchase, such as receipt, a witness to the purchase or a purchase shown on a bank statement<br />
                                       (Reference from Consumer Fair-Trading: http://www.fairtrading.qld.gov.au)<br />
                                • Pricesengine only refunds, repairs or replaces if the product you receive doesn’t match the sample or description, doesn't do what it is supposed to do or is not of merchantable quality.<br /><br />

                                Return:<br />
                                • Pricesengine will refund, repair or replace if the product you receive - doesn't match the sample or description, doesn't do what it is supposed to do or is not of merchantable quality (e.g. defecti<br />ve or dead-on-arrival).
                                • Pricesengine keeps the rights to reject the refund, return or warranty claims if consumers: change their mind about a product. This includes when a consumer has found a cheaper product elsewhere, has bought a gift that is unsuitable, or their circumstances have changed and they no longer require the goods<br />
                                • Please contact us and obtain a RA (Return Authorization) number prior to returning anything. Products must be shipped within 3 working days after the RA number is issued. Please understand we need to receive the goods in a timely fashion for us to return to the suppliers or to resell. Please refer to the warranty section for refund procedures regarding Dead On Arrival goods.<br /><br />

                                Warranty:<br />
                                • All products sold by Pricesengine comes with a standard one-year back to base manufacturer warranty; it can only be SHORTEN if a special note is mentioned about an item. Computer systems built by Pricesengine carry a standard one-year parts warranty. This warranty is not transferable. The system warranty only covers the system unit; it does not extend to any peripheral components such as monitors, keyboard etc. All the peripheral components are covered by standard manufacturer warranty.<br />
                                • Pricesenigne is NOT responsible for any shipping cost in sending the warranty claim goods back to us. Also, Pricesengine is not responsible for any parcel missing in transit, on its return back to Pricesengine.<br />
                                • Product under warranty cover will be replaced or repaired by the manufacturers. No refund or replacement can be provided under any circumstances.<br />
                                • Pricesengine is responsible for the handling of most products' warranty processes. The manufacturers, not Pricesengine, provide warrantees of individual parts that we sold.<br />
                                • Warranty only covers the item(s) sold by Pricesengine. Warranty does not cover any other equipment used in conjunction with the item(s) sold by Pricesenigne.<br />
                                • Pricesengine does not handle warranty claim for those goods where the manufacturer accepts direct warranty claims from customers. Most of the monitors, printers, notebooks etc are covered by direct manufacturer warranty.<br />
                                • DOA (Dead on arrival) items are eligible for refund or an instant replacement from our stock. DOA items must be reported within 7 days from the time you receive your goods. Failure to report a DOA item within 7 days will result in you not being able to claim the item as a DOA. This is particularly important for printers, monitors etc where the manufacturers have strict guidelines. Please contact us and obtain a RA (Return Authorization) number prior to returning anything. Goods must be shipped within 3 working days after the RA number is issued. Please understand we need to receive the goods in a timely fashion for us to return to the suppliers.<br />
                                • Customers must request a RA (Return Authorization) number prior to returning any merchandise to Pricesengine. RA number is deemed effective for only 7 days including the day of issue. RA number can be obtained by E-mailing our support, or by phone call. RA number is only issued when we consider the item is in fact faulty from the descriptions provided by the customer.<br />
                                • A large percentage of returned goods are found to be, not faulty. If the returned goods are determined by Pricesengine to not be faulty, then all returning shipping fees will be worn by the customer. We will seek the permission from the customer to charge this cost to the customer's credit card where possible. Failing this, the goods will be sent back by Australia Post COD freight collected. Pricesengine reserves the right to charge the labour cost for examining these goods where no fault was found.<br />
                                • All warrantees are voided if returned product is found in any way to be mishandled, misinstalled, modified, tampered, abused, physically damaged or used under wrong voltage etc.<br />
                                • Pricesenigne is not responsible for data contents or the security of the data contents contained in any returned goods. Our workshop works under strict guidelines, not to intercept with any customer data. Despite this customers should back up any data prior to sending the goods back to us; data can be destroyed during our testing. It is also beyond the scope of our control once the device is sent to our supplier. We do not provide data recovery service.<br />
                                • Please attach a copy of the original invoice or provide the original invoice number. A detailed fault description sheet must be sent together with all the returning warranty goods.<br />
                                • Customer is responsible for proper packaging of RA returns. All warranties will be void on items that are insufficiently or inaccurately packaged. If any item(s) returned for warranty claim is determined to be physically damaged, the item(s) will be returned to the customer as is.<br />
                                • Product(s) discontinued by manufacturer(s) shall be upgraded to a similar product or a credit will be given at the current market value or the purchase price whichever is lower.<br /><br />

                                Warranty turnaround time:<br />
                                • Turnaround time for warranty claims largely depends on the suppliers or the distributors. We will try our best to speed up the process. Please understand the time involved for a warranty claim will include: our time to test the item, shipping back to the supplier, supplier & distributor's own test and replacement/repair, and the shipping back to us.<br />
                                • We do not provide advance replacement under any circumstances. Please keep this in mind when you place your order. Pricesengine will not be responsible for any losses resulting from the time it takes to have the faulty item replaced or repaired.<br />
                                • If you will be using the item(s) for mission critical tasks, be it running a business, using it to prepare an examination, using it for a pre-organized game party etc, you should consider purchasing it from a provider that offers instant replacement.<br /><br />

                                Disclaimer<br />
                                • Due to changing market forces and other extenuating circumstances that affect product availability, and price stability we reserve the right to withdraw any product we advertise and change prices without notice.<br />
                                • Information contained throughout the web pages and in our database is believed to be accurate and reliable at the time of publishing. There may be misprints, human errors, and omissions. We reserve the right to make changes and corrections in prices, products, and specifications without notice.<br />
                                • Images displayed on this web site should be regarded as illustrative and informational purpose only. The actual products are often not identical to the images.<br />
                                • Hyperlinks (URL) provided throughout our product pages can only be used as references only. The products we carry are often not identical as the contents contained in the links. If unsure, please contact our sales team.<br />
                    ");
	}
	
	function contactUs() {
                $this->layout = 'default_no_countdown';
		//$this->set('contactUs', "Unit 207, 354 Eastern Valley Way, Chatswood 2067 NSW Australia");
                $this->set('contactUs', "
                                Unfortunately we don’t provide pick up service at this stage.<br />
                                So we only have email contact or online chat available.<br /><br />
                                service@pricesengine.com<br /><br />
                                Skype.<br />
                                pricesengine.com<br /><br />
                                For warranty issues. Please email to warranty@pricesengine.com<br />
                                Please email with your invoice number and the problem description.<br /><br />
                                Sorry for any inconvenience.<br />"
                        );
	}

        function underConstruction() {
                $this->layout = 'empty';
                $this->set('underCons', "Site under construction. Coming online soon....");
        }
        
        function facebookFan(){
                $this->layout = 'default_no_countdown';
                $this->set('facebookFan', '

                                    <div style="margin-left: 0px; position: relative; width: 200px; z-index: 5; " id="body_layer">
                                      <div style="height: 0px; line-height: 0px; " class="bumper"> </div>
                                      <div style="height: 239px; width: 199px;  height: 239px; left: -55px; position: absolute; top: 35px; width: 199px; z-index: 1; " class="tinyText style_SkipStroke stroke_0">
                                        <img src="/img/handofcash.jpg" alt="" style="border: none; height: 239px; width: 200px; " />
                                      </div>



                                      <div id="id1" style="height: 36px; left: 170px; position: absolute; top: 50px; width: 463px; z-index: 1; " class="style_SkipStroke_1 shape-with-text">

                                        <div class="text-content graphic_textbox_layout_style_default_External_463_36" style="padding: 0px; ">
                                          <div class="graphic_textbox_layout_style_default">
                                            <p style="padding-bottom: 0pt; padding-top: 0pt; " class="paragraph_style">Become our facebook fans to <span class="style">WIN $1000</span></p>
                                          </div>
                                        </div>
                                      </div>



                                      <div id="id2" style="height: 228px; left: 170px; position: absolute; top: 90px; width: 463px; z-index: 1; " class="style_SkipStroke_1 shape-with-text">
                                        <div class="text-content graphic_textbox_layout_style_default_External_463_228" style="padding: 0px; ">

                                          <div class="graphic_textbox_layout_style_default">
                                            <p style="padding-top: 0pt; " class="paragraph_style_1">The condition is simple, if you have 20 friends on your facebook. Then you will automatically enrol to PricesEngine facebook fans lucky drawer.<br /></p>
                                            <p class="paragraph_style_1">We will start to run lucky drawer once our fans number are reaching 2000 people.<br /></p>
                                            <p class="paragraph_style_1"><br /></p>
                                            <p class="paragraph_style_1">Don\'t miss your chance to become PricesEngine lucky drawer winner, Join us on facebook and invite your friends to become our first 2000 lucky fans NOW!<br /></p>
                                            <p class="paragraph_style_1"><br /></p>
                                            <p style="padding-bottom: 0pt; " class="paragraph_style_1">For more information. Please email to <a title="mailto:Service@pricesengine.com" href="mailto:Service@pricesengine.com">Service@pricesengine.com</a></p>

                                          </div>
                                        </div>
                                      </div>
                                    </div>
   

               ');
        }

        function siteUnderMaintenance(){
                $this->layout = 'default_no_countdown';
                $this->set('siteUnderMaintenance', '

                                    <div style="margin-left: 0px; position: relative; width: 200px; z-index: 5; " id="body_layer">
                                          <div style="height: 0px; line-height: 0px; " class="bumper"> </div>
                                          <div style="height: 247px; width: 246px; left: -55px; position: absolute; top: 35px; z-index: 1; " class="tinyText style_SkipStroke stroke_0">
                                            <img src="/img/undermaintenance.jpg" alt="" style="border: none; height: 247px; width: 246px; " />
                                          </div>



                                          <div id="id1" style="height: 36px; left: 170px; position: absolute; top: 50px; width: 463px; z-index: 1; " class="style_SkipStroke_1 shape-with-text">

                                            <div class="text-content graphic_textbox_layout_style_default_External_463_36" style="padding: 0px; ">
                                              <div class="graphic_textbox_layout_style_default">
                                                <p style="padding-bottom: 0pt; padding-top: 0pt; " class="paragraph_style">Sorry, due to server maintenance, pricesengine will be back at <span class="style">3pm</span> today. SeE yah aLL LAteR...</p>
                                              </div>
                                            </div>
                                          </div>
                                    </div>


               ');
        }
}
?>
