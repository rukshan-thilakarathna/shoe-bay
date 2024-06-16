<?php 
require_once('../worldpay-lib-php/init.php');
use \Worldpay\Worldpay;

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../phpmailer/src/Exception.php';
//require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/PHPMailer.php';

include "../INC_SESS.php"; 
$ermsg = "";
$table = "";
$arr_state = array('','Avon', 'Bedfordshire', 'Berkshire', 'Bristol, City of', 'Buckinghamshire', 'Cambridgeshire', 'Cheshire', 'Cleveland', 'Cornwall', 'Cumbria', 'Derbyshire', 'Devon', 'Dorset', 'Durham', 'East Sussex', 'Essex', 'Gloucestershire', 'Greater London', 'Greater Manchester', 'Hampshire (County of Southampton)', 'Hereford and Worcester', 'Herefordshire', 'Hertfordshire', 'Isle of Wight', 'Kent', 'Lancashire', 'Leicestershire', 'Lincolnshire', 'London', 'Merseyside', 'Middlesex', 'Norfolk', 'Northamptonshire', 'Northumberland', 'North Humberside', 'North Yorkshire', 'Nottinghamshire', 'Oxfordshire', 'Rutland', 'Shropshire', 'Somerset', 'South Humberside', 'South Yorkshire', 'Staffordshire', 'Suffolk', 'Surrey', 'Tyne and Wear', 'Warwickshire', 'West Midlands', 'West Sussex', 'West Yorkshire', 'Wiltshire', 'Worcestershire', 'Antrim', 'Armagh', 'Belfast, City of', 'Down', 'Fermanagh', 'Londonderry', 'Derry, City of', 'Tyrone', 'Aberdeen, City of', 'Aberdeenshire', 'Angus (Forfarshire)', 'Argyll', 'Ayrshire', 'Banffshire', 'Berwickshire', 'Bute', 'Caithness', 'Clackmannanshire', 'Cromartyshire', 'Dumfriesshire', 'Dunbartonshire (Dumbarton)', 'Dundee, City of', 'East Lothian (Haddingtonshire)', 'Edinburgh, City of', 'Fife', 'Glasgow, City of', 'Inverness-shire', 'Kincardineshire', 'Kinross-shire', 'Kirkcudbrightshire', 'Lanarkshire', 'Midlothian (County of Edinburgh)', 'Moray (Elginshire)', 'Nairnshire', 'Orkney', 'Peeblesshire', 'Perthshire', 'Renfrewshire', 'Ross and Cromarty', 'Ross-shire', 'Roxburghshire', 'Selkirkshire', 'Shetland (Zetland)', 'Stirlingshire', 'Sutherland', 'West Lothian (Linlithgowshire)', 'Wigtownshire', 'Clwyd', 'Dyfed', 'Gwent', 'Gwynedd', 'Mid Glamorgan', 'Powys', 'South Glamorgan', 'West Glamorgan');
date_default_timezone_set("Europe/London");
if(empty($_SESSION['cart'])) header("Location:index.php");

if(!isset($_SESSION['tpr'])) $_SESSION['tpr']=0; 
if(isset($_POST['name'])){
	$p = $db->prepare("SELECT `uid` FROM `users` WHERE `ez`=?");
	$p->execute(array($_SESSION['ez']));
	if($r1 = $p->fetch()) {
		$uid = $r1['uid'];
		$date = date('H:i:s');
		$db->prepare("INSERT INTO `orders` (`uid`, `bfn`, `bln`, `bad1`, `bad2`, `bad3`, `bpz`, `bzp`, `bct`, `bst`, `bem`, `sfn`, `sln`, `sad1`, `sad2`, `sad3`, `spz`, `szp`, `sct`, `sst`, `sem`, `dt`, `tz`, `tpr`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")->execute(array($uid, $_SESSION['bfn'], $_SESSION['bln'], $_SESSION['bad1'], $_SESSION['bad2'], $_SESSION['bad3'], $_SESSION['bpz'], $_SESSION['bzp'], $_SESSION['bct'], $_SESSION['bst'], $_SESSION['bem'], $_SESSION['sfn'], $_SESSION['sln'], $_SESSION['sad1'], $_SESSION['sad2'], $_SESSION['sad3'], $_SESSION['spz'], $_SESSION['szp'], $_SESSION['sct'], $_SESSION['sst'], $_SESSION['sem'], date('Y-m-d'), $date, $_SESSION['tpr']));
		$oid = $db->lastInsertId();
		if($oid){
			// billing details
			$table.="<h2 style=\"font-family: \'Nunito Sans\';color:#444444; padding:10px; text-align:center; font-size:18px;\">Billing Details</h2><table border=\"1\" rules=\"all\">";
			$table.="<tr><td>First Name</td><td>".$_SESSION['bfn']."</td></tr>";
			$table.="<tr><td>Last Name</td><td>".$_SESSION['bln']."</td></tr>";
			$table.="<tr><td valign=\"top\">Address</td><td>".$_SESSION['bad1']."<br>".$_SESSION['bad2']."<br>".$_SESSION['bad3']."</td></tr>";
			$table.="<tr><td>City</td><td>".$_SESSION['bct']."</td></tr>";
			$table.="<tr><td>State</td><td>".$arr_state[$_SESSION['bst']]."</td></tr>";
			$table.="<tr><td>ZIP Code</td><td>".$_SESSION['bzp']."</td></tr>";
			$table.="<tr><td>Phone Number</td><td>".$_SESSION['bpz']."</td></tr>";
			$table.="<tr><td>Email Address</td><td>".$_SESSION['bem']."</td></tr>";
			$table.="</table>";
			
			// shipping details
			$table.="<h2 style=\"font-family: \'Nunito Sans\';color:#444444; padding:10px; text-align:center; font-size:18px;\">Shipping Details</h2><table border=\"1\" rules=\"all\">";
			$table.="<tr><td>First Name</td><td>".$_SESSION['sfn']."</td></tr>";
			$table.="<tr><td>Last Name</td><td>".$_SESSION['sln']."</td></tr>";
			$table.="<tr><td valign=\"top\">Address</td><td>".$_SESSION['sad1']."<br>".$_SESSION['sad2']."<br>".$_SESSION['sad3']."</td></tr>";
			$table.="<tr><td>City</td><td>".$_SESSION['sct']."</td></tr>";
			$table.="<tr><td>State</td><td>".$arr_state[$_SESSION['sst']]."</td></tr>";
			$table.="<tr><td>ZIP Code</td><td>".$_SESSION['szp']."</td></tr>";
			$table.="<tr><td>Phone Number</td><td>".$_SESSION['spz']."</td></tr>";
			$table.="<tr><td>Email Address</td><td>".$_SESSION['sem']."</td></tr>";
			$table.="</table>";
			
			$table.="<h2 style=\"font-family: \'Nunito Sans\';color:#444444; padding:10px; text-align:center; font-size:18px;\">Items</h2><table border=\"1\" rules=\"all\"><tr><td>Item ID</td><td>Name</td><td>Price</td><td>Qty</td><td>Total</td></tr>";
			foreach($_SESSION['cart'] as $cart){
				$db->prepare("INSERT INTO `orderitems` (`oid`, `iid`, `ina`, `ipr`, `iqt`) VALUES (?,?,?,?,?)")->execute(array($oid, $cart['item_id'], $cart['item_name'], $cart['item_price'], $cart['item_qty']));
				$table.="<tr><td>".$cart['item_id']."</td><td>".$cart['item_name']."</td><td>".$cart['item_price']."</td><td>".$cart['item_qty']."</td><td>".($cart['item_price']*$cart['item_qty'])."</td></tr>";
			}
			$table.="<tr><td></td><td></td><td></td><td></td><td>".$_SESSION['tpr']."</td></tr></table>";
			
		/// payments

		$worldpay = new Worldpay('T_S_aed4cebd-8f7d-48e7-ae54-f932343b4996');
		
		$billing_address = array(
		    "address1" => $_SESSION['bad1'],
		    "address2" => $_SESSION['bad2'],
		    "address3" => $_SESSION['bad3'],
		    "postalCode" => $_SESSION['bzp'],
		    "city"=> $_SESSION['bct'],
		    "state"=> $_SESSION['bst'],
		    "countryCode"=> 'GB'
		);
		
		try {
		    $response = $worldpay->createOrder(array(
		        'token' => $_POST['token'],
		        'amount' => $_SESSION['tpr'],
		        'currencyCode' => 'GBP',
		        'name' => $_SESSION['bfn'].' '.$_SESSION['bln'],
		        'billingAddress' => $billing_address,
		        'orderDescription' => $date,
		        'customerOrderCode' => $oid
		    ));
		    if ($response['paymentStatus'] === 'SUCCESS') {
		        $worldpayOrderCode = $response['orderCode'];
		        ///payment successful
		        $ok = $db->prepare("UPDATE `orders` SET `pay`=?, `code`=? WHERE `oid`=?")->execute([1,$worldpayOrderCode, $oid]);
		        
		      /// email start
		       $mail = new PHPMailer(true);
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
				    $mail->addAddress('effsilent@gmail.com'); 
				    $mail->addReplyTo('cellers.wine@gmail.com', 'Cellerswine');
				    
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
		    } else {
		        throw new WorldpayException(print_r($response, true));
		    }
		} catch (WorldpayException $e) {
		    $ermsg .= 'Error code: ' .$e->getCustomCode() .'
		    HTTP status code:' . $e->getHttpStatusCode() . '
		    Error description: ' . $e->getDescription()  . '
		    Error message: ' . $e->getMessage();
		} catch (Exception $e) {
		    $ermsg.= 'Error message: '. $e->getMessage();
		}	
		/// payments	
		}
	}else header("Location:user.php");
}
include "../INC_HEAD.php"; 
?>
<title>Payment - Cellerswine</title>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x4-shopping.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x6-table.css" rel="stylesheet">
<script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
<style>
#zd{width:100%; box-sizing:border-box; display:flex;flex-wrap:wrap;justify-content:space-between;}
.zd1{width: 45%;box-sizing:border-box; margin:20px 30px; }
.zd1{float: left;}
.zf{display: block; width: 80%; margin:0 auto;}
h2{border-bottom:1px solid rgba(255,255,255,.2); padding-bottom: 20px; margin-bottom: 40px;}
.zd3{ float: right;}
.a0{margin-right: 0;}
.zin{width: 45%; float: left;}
#zs{display: inline-block;
    margin: 0 3.9%;
    float: left;
    color: #fff;
    font-size: 20px;
    margin-top: 8px;}
#zbt{width: 100%;}
#paymentErrors{display: block;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<div id="x4d">
		<a class="x4a x4e" href="shopping/">Shopping Cart</a>
		<a class="x4a x4e" href="shopping/user.php">User Information</a>
		<a class="x4a x4e" href="shopping/billing.php">Billing / Shipping Details</a>
		<a class="x4a x4e" href="shopping/payment.php">Payments</a>
	</div>
	<h1>Payment Method</h1>
	<p>Your credit card information is secure, and your card is not charged until after you've confirmed your order</p>
	<div id="zd">
		<div class="zd1">
			<form class="zf" action="shopping/payment.php" id="paymentForm" method="post">
			<?php
				if(!empty($ermsg)) echo '<p class="x3s2">',$ermsg,'</p>';
			?>
			<span id="paymentErrors" class="x3s2"></span>
			<h2>Secure Card Payment</h2>
				<label class="x3lb">
					<span class="x3s">Payment method</span>
					<div class="x3d">
						<select class="x3in" name="order-type">
							<option value="ECOM">Credit Card</option>
							<option value="APM">PayPal</option>
						</select>
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Name on Card</span>
					<div class="x3d">
						<input type="text" class="x3in" name="name" data-worldpay="name">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Card Number</span>
					<div class="x3d">
						<input type="text" class="x3in" data-worldpay="number" size="20">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Expiration (MM/YYYY)</span>
					<div class="x3d">
						<input type="text" class="x3in zin" data-worldpay="exp-month" size="2" placeholder="MM">
						<span id="zs">/</span>
						<input type="text" class="x3in zin" data-worldpay="exp-year" size="4" placeholder="YYYY">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">CVC</span>
					<div class="x3d">
						<input type="text" class="x3in" data-worldpay="cvc" size="4">
					</div>	
				</label>
				<div class="x3lb">
					<div class="x3d">
						<button type="submit" class="x4e x4bt2" id="zbt">Pay Now</button>					
					</div>				
				</div>
			</form>
			 <script type="text/javascript">
	         var form = document.getElementById('paymentForm');
	         Worldpay.useOwnForm({
	           'clientKey': 'T_C_a357865d-a3bb-44fe-b5b3-7a9c50ba5cd8',
	           'form': form,
	           'reusable': false,
	           'callback': function(status, response) {
	             document.getElementById('paymentErrors').innerHTML = '';
	             if (response.error) {
	             	Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error); 
	             } else {
	               var token = response.token;
	               Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
	               form.submit();
	             }
	           }
	         });
      	</script>
		</div>
		<div class="zd1">
			<h2>Your Order</h2>
			<?php
		$itemCount = count($_SESSION['cart']);
		if($itemCount>0){
			$allQty = 0;
			$_SESSION['tpr'] = 0;
	?>
			<div class="x6d">
				<div class="x6r x6e">
					<div class="x6c1">Item ID</div>
					<div class="x6c2">Item Name</div>
					<div class="x6c3">Quantity</div>
					<div class="x6c3">Total</div>
				</div>
				<?php
					foreach($_SESSION['cart'] as $cart){
						$totalPrice = $cart['item_price']*$cart['item_qty'];
						$allQty += $cart['item_qty']; 
						$_SESSION['tpr'] += $totalPrice; 
				?>
				<div class="x6r">
					<div class="x6c1">CW<?php echo $cart['item_id']; ?></div>
					<div class="x6c2"><?php echo $cart['item_name']; ?></div>
					<div class="x6c3"><?php echo $cart['item_qty']; ?></div>
					<div class="x6c3">£ <?php echo $totalPrice; ?></div>
				</div>	
				<?php 
					}
				?>
				<div class="x6r x6e">
					<div class="x6c1"></div>
					<div class="x6c2"></div>
					<div class="x6c3"><?php echo $allQty; ?></div>
					<div class="x6c3">£ <?php echo $_SESSION['tpr']; ?></div>
				</div>
			</div>
	<?php
		}else echo '<p>Cart is empty</p>';
	?>
		</div>
	</div>
</div>

<?php include "../INC_FOOT.php"; ?> 