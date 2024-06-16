<?php

$getEmails = $db->prepare("SELECT `emails` FROM `admins` WHERE `idz`=?");
$getEmails->execute([1]);
if($emails = $getEmails->fetch()){
	if(strpos($emails['emails'],',')){
		$arr_emails = explode(',',$emails['emails']);
	}else $arr_emails[0] = $emails['emails'];
}else $arr_emails[0] = "cellers.wine@gmail.com";
$directOrder = TRUE;
$token = (isset($_POST['token'])) ? $_POST['token'] : null;
$name = $_POST['name'];
$shopperEmailAddress = $arr_emails[0];

$amount = 0;
if (isset($_SESSION['tpr']) && !empty($_SESSION['tpr'])) {
    $amount = is_numeric($_SESSION['tpr']) ? $_SESSION['tpr']*100 : -1;
}

$orderType = $_POST['order-type'];

$_3ds = FALSE;
$authorizeOnly = FALSE;
$customerIdentifiers = array();

// Try catch
try {
    // Customers billing address
    $billing_address = array(
        "address1" => $_SESSION['bad1'],
		  "address2" => $_SESSION['bad2'],
		  "address3" => $_SESSION['bad3'],
        "postalCode" => $_SESSION['bzp'],
		  "city"=> $_SESSION['bct'],
		  "state"=> $arr_state[$_SESSION['bst']],
		  "countryCode"=> 'GB',
        "telephoneNumber"=> $_SESSION['bpz']
    );

    // Customers delivery address
    $delivery_address = array(
        "firstName" => $_SESSION['sfn'],
        "lastName" => $_SESSION['sln'],
        "address1" => $_SESSION['sad1'],
		  "address2" => $_SESSION['sad2'],
		  "address3" => $_SESSION['sad3'],
        "postalCode" => $_SESSION['szp'],
		  "city"=> $_SESSION['sct'],
		  "state"=> $arr_state[$_SESSION['sst']],
		  "countryCode"=> 'GB',
        "telephoneNumber"=> $_SESSION['spz']
    );

    if ($orderType == 'APM') {

        $obj = array(
            'orderDescription' => 'Paypal Order', // Order description of your choice
            'amount' => $amount, // Amount in pence
            'currencyCode' => 'GBP', // Currency code
            'settlementCurrency' => 'GBP', // Settlement currency code
            'name' => $name, // Customer name
            'shopperEmailAddress' => $shopperEmailAddress, // Shopper email address
            'billingAddress' => $billing_address, // Billing address array
            'deliveryAddress' => $delivery_address, // Delivery address array
            'customerIdentifiers' => (!is_null($customerIdentifiers)) ? $customerIdentifiers : array(), // Custom indentifiers
            'statementNarrative' => '',
            'orderCodePrefix' => '',
            'orderCodeSuffix' => '',
            'customerOrderCode' => isset($oid) ? $oid : '', // Order code of your choice
            'successUrl' => 'https://cellerswine.com/shopping/done.php', //Success redirect url for APM
            'pendingUrl' => 'https://cellerswine.com/shopping/error.php?pending=1', //Pending redirect url for APM
            'failureUrl' => 'https://cellerswine.com/shopping/error.php?failed=1', //Failure redirect url for APM
            'cancelUrl' => 'https://cellerswine.com/shopping/error.php?canceled=1' //Cancel redirect url for APM
        );

        if ($directOrder) {
            $obj['directOrder'] = true;
            $obj['shopperLanguageCode'] = "EN";
            $obj['reusable'] = FALSE;

            $apmFields = array();
            if (isset($_POST['swiftCode'])) {
                $apmFields['swiftCode'] = $_POST['swiftCode'];
            }

            if (isset($_POST['shopperBankCode'])) {
                $apmFields['shopperBankCode'] = $_POST['shopperBankCode'];
            }

            if (empty($apmFields)) {
                $apmFields =  new stdClass();
            }

            $obj['paymentMethod'] = array(
                  "apmName" => "paypal",
                  "shopperCountryCode" => 'GB',
                  "apmFields" => $apmFields
            );
        }
        else {
            $obj['token'] = $token; // The token from WorldpayJS
        }

        $response = $worldpay->createApmOrder($obj);

        if ($response['paymentStatus'] === 'PRE_AUTHORIZED') {
            // Redirect to URL
            $_SESSION['orderCode'] = $response['orderCode'];
            ?>
            <script>
                window.location.replace("<?php echo $response['redirectURL'] ?>");
            </script>
            <?php
        } else {
            // Something went wrong
            $ermsg = $response['paymentStatus'];
            throw new WorldpayException(print_r($response, true));
        }

    }
    else {

        $obj = array(
            'orderDescription' => 'Card Order', // Order description of your choice
            'amount' => $amount, // Amount in pence
            'is3DSOrder' => $_3ds, // 3DS
            'authorizeOnly' => $authorizeOnly,
            'siteCode' => 'Cellerswine',
            'orderType' => $_POST['order-type'], //Order Type: ECOM/MOTO/RECURRING
            'currencyCode' => 'GBP', // Currency code
            'settlementCurrency' => 'GBP', // Settlement currency code
            'name' => ($_3ds && true) ? '3D' : $name, // Customer name
            'shopperEmailAddress' => $shopperEmailAddress, // Shopper email address
            'billingAddress' => $billing_address, // Billing address array
            'deliveryAddress' => $delivery_address, // Delivery address array
            'customerIdentifiers' => (!is_null($customerIdentifiers)) ? $customerIdentifiers : array(), // Custom indentifiers
            'statementNarrative' => '',
            'orderCodePrefix' => '',
            'orderCodeSuffix' => '',
            'customerOrderCode' => isset($oid) ? $oid : '' // Order code of your choice
        );

        if ($directOrder) {
            $obj['directOrder'] = true;
            $obj['shopperLanguageCode'] = isset($_POST['language-code']) ? $_POST['language-code'] : "";
            $obj['reusable'] = (isset($_POST['chkReusable']) && $_POST['chkReusable'] == 'on') ? true : false;
            $obj['paymentMethod'] = array(
                  "name" => $_POST['name'],
                  "expiryMonth" => $_POST['expiration-month'],
                  "expiryYear" => $_POST['expiration-year'],
                  "cardNumber"=>$_POST['card'],
                  "cvc"=>$_POST['cvc']
            );
        }
        else {
            $obj['token'] = $token; // The token from WorldpayJS
        }

        $response = $worldpay->createOrder($obj);

        if ($response['paymentStatus'] === 'SUCCESS' ||  $response['paymentStatus'] === 'AUTHORIZED') {
            // Create order was successful!
            $worldpayOrderCode = $response['orderCode'];
           
            // TODO: Store the order code somewhere..
            $ok = $db->prepare("UPDATE `orders` SET `pay`=?, `code`=? WHERE `oid`=?")->execute([1,$worldpayOrderCode, $oid]);
		        
		      /// email start
		       //$mail = new PHPMailer(true);
			    try{
			    	 //Server settings
				   /*
				    $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
				    $mail->isSMTP(); 
				    $mail->Host       = 'sv420.basdns.com'; 
				    $mail->SMTPAuth   = true;  
				    $mail->Username   = 'noreply@cellerswine.com'; 
				    $mail->Password   = 'pVrlAtpTR]rh'; 
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				    $mail->Port       = 587;
				    */
				    
			       // Recipients
				    $mail->setFrom('noreply@cellerswine.com', 'Cellerswine');
				    $mail->addAddress($_SESSION['bem'], $_SESSION['bfn']);
				    foreach($arr_emails as $em){
					    $mail->addBCC($em); 
				    }
				    $mail->addReplyTo($arr_emails[0], 'Cellerswine');
				    
			       $emailText = '<style type="text/css">body{background:#7b7b7b;font-family: "Nunito Sans", sans-serif;}td{padding:10px;} @media screen and (max-width:680px){ #zt_wdg{width: 98% !important; }.za_wdg{display:block !important; margin-bottom:8px !important;}.zs_wdg{display:none !important;}}
	@font-face {  font-family: "Nunito Sans";  font-style: normal;  font-weight: 400;  font-display: swap;  src: local("Nunito Sans Regular"), local("NunitoSans-Regular"), url(https://fonts.gstatic.com/s/nunitosans/v5/pe0qMImSLYBIv1o4X1M8cceyI9tScg.woff2) format("woff2");  unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;}@font-face {  font-family: "Nunito Sans";  font-style: normal;  font-weight: 400;  font-display: swap;  src: local("Nunito Sans Regular"), local("NunitoSans-Regular"), url(https://fonts.gstatic.com/s/nunitosans/v5/pe0qMImSLYBIv1o4X1M8ccezI9tScg.woff2) format("woff2");  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face {  font-family: "Nunito Sans";  font-style: normal;  font-weight: 400;  font-display: swap;  src: local("Nunito Sans Regular"), local("NunitoSans-Regular"), url(https://fonts.gstatic.com/s/nunitosans/v5/pe0qMImSLYBIv1o4X1M8cce9I9s.woff2) format("woff2");  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
	</style><table id="zt_wdg" style="width:680px; margin: 10px auto; border-collapse: collapse; "><tr><td style="background:#252926; padding:10px; border-radius: 10px 10px 0 0"><img src="https://cellerswine.com/img/cellerswine-logo.svg" height="50" alt="WDG"><div style="float: right; font-family: \'Nunito Sans\'; color:#ffffff; font-weight:bold; padding:0 10px 0 10px; text-align:right; margin-top:16px;"><span style="color:#ccc; font-size:14px;">Your Order</span></div></td></tr><tr><td style="text-align:center;background:#f1f1f1; font-family: \'Nunito Sans\';"><h1 style="margin:20px 0 0; color:#ff2a2a;">Hello '.ucwords($_SESSION['bfn']).'</h1><h2 style="margin-top:0;color:#252926;">Thank you for choosing Cellerswine.</h2></td></tr><tr><td style="background:#f1f1f1; text-align:center;"><div style="text-align:left; padding:0 10px"><p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px; text-align:center; ">Here is a summary of your order.</p>'.$table.'<p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px; font-size:15px;"><i>Note : If you did not create any order with us and If you think someone else has ordered using your email, then please inform us using the information of our <a href="https://cellerswine.com/contact-us.php" target="_blank" style="color:#ff2a2a;text-decoration:none">contact page.</a></i></p><p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px; text-align:center; line-height:22px; margin-bottom:20px;">Thank you for being with Cellerswine. <br>Have a great day</p></div></td></tr><tr><td style="background:#252926; padding:10px; border-radius:0 0 10px 10px"><p style="font-family: \'Nunito Sans\'; color:#f1f1f1;text-align:center;" >Contact Us</p><p style="font-family: \'Nunito Sans\'; color:#968f93; font-size:15px;text-align:center;">Email : <a href="mailto:cellers.wine@gmail.com" target="_blank" style="color:#ff2a2a;text-decoration:none" class="za_wdg">cellers.wine@gmail.com</a><span class="zs_wdg"> | </span>Facebook : <a href="https://www.facebook.com/cellerswines" target="_blank" style="color:#ff2a2a;text-decoration:none" class="za_wdg">cellerswines</a> <span class="zs_wdg"><br></span>Web : <a href="https://cellerswine.com/" target="_blank" style="color:#ff2a2a;text-decoration:none" class="za_wdg">cellerswine.com</a></p></td></tr></table>';
				    // Content
				    $mail->isHTML(true);
				    $mail->Subject = 'Cellerswine - Order #'.$oid;
				    $mail->Body = $emailText;
				
				    $mail->send();
				} catch (Exception $e) {
				    $ermsg.= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}

		        /// email end
				  if($ok) header("Location:done.php");
        } elseif ($response['is3DSOrder']) {
            // Redirect to URL
            // STORE order code in session
            $_SESSION['orderCode'] = $response['orderCode'];
            ?>
            <form id="submitForm" method="post" action="<?php echo $response['redirectURL'] ?>">
                <input type="hidden" name="PaReq" value="<?php echo $response['oneTime3DsToken']; ?>"/>
                <input type="hidden" id="termUrl" name="TermUrl" value="http://localhost/3ds_redirect.php"/>
                <script>
                    document.getElementById('termUrl').value = window.location.href.replace('create_order.php', '3ds_redirect.php');
                    document.getElementById('submitForm').submit();
                </script>
            </form>
            <?php
        } else {
            // Something went wrong
            $ermsg = '<p id="payment-status">' . $response['paymentStatus'] . '</p>';
            throw new WorldpayException(print_r($response, true));
        }
    }
} catch (WorldpayException $e) { // PHP 5.3+
    // Worldpay has thrown an exception
    $ermsg = 'Error code: ' . $e->getCustomCode() . '<br/>
    HTTP status code:' . $e->getHttpStatusCode() . '<br/>
    Error description: ' . $e->getDescription()  . ' <br/>
    Error message: ' . $e->getMessage();
}
