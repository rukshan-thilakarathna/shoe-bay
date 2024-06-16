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
			// Initialise Worldpay class with your SERVICE KEY
			$worldpay = new Worldpay('L_S_265202d1-59b0-4e7b-94fe-2aa97285728a');
			// mail sending class
			$mail = new PHPMailer(true);
		include "INC_PG.php";
		/// payments	
		}
	}else header("Location:user.php");
}
include "../INC_HEAD.php"; 
?>
<title>Payment - SukeeFashion</title>
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
.zbt{width: 100%;}
#paymentErrors,#paymentErrors2{display: block;}
#paymentForm2{display: none;}
#zi0{margin:10px auto;}
#zd0{text-align: center;}
#zp{margin:0; padding:0; font-size: 15px;}
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
			<?php
				if(!empty($ermsg)) echo '<p class="x3s2">',$ermsg,'</p>';
			?>
			<h2>Secure Card Payment</h2>
			<div class="zf">
				<div class="x3lb">
					<span class="x3s">Payment method</span>
					<div class="x3d">
						<select class="x3in" id="zyot">
							<option value="ECOM">Credit Card</option>
							<option value="APM">PayPal</option>
						</select>
					</div>
				</div>
			</div>
			<form class="zf" action="shopping/payment.php" id="paymentForm" method="post">
			<span id="paymentErrors" class="x3s2"></span>
				<label class="x3lb">
					<span class="x3s">Name on Card</span>
					<div class="x3d">
						<input type="text" class="x3in" name="name" data-worldpay="name">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Card Number</span>
					<div class="x3d">
						<input type="text" class="x3in" data-worldpay="number" size="20" name="card">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Expiration (MM/YYYY)</span>
					<div class="x3d">
						<input type="text" class="x3in zin" data-worldpay="exp-month" size="2" placeholder="MM" name="expiration-month">
						<span id="zs">/</span>
						<input type="text" class="x3in zin" data-worldpay="exp-year" size="4" placeholder="YYYY" name="expiration-year">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">CVC</span>
					<div class="x3d">
						<input type="text" class="x3in" data-worldpay="cvc" size="4" name="cvc">
					</div>	
				</label>
				<div class="x3lb">
					<div class="x3d">
						<button type="submit" class="x4e x4bt2 zbt">Pay Now</button>
						<input type="hidden" name="order-type" value="ECOM">
					</div>				
				</div>
			</form>
			<form class="zf" action="shopping/payment.php" id="paymentForm2" method="post">
         <span id="paymentErrors2" class="x3s2"></span>
         <div class="x3lb">
				<div class="x3d">
					<input id="apm-name" type="hidden" data-worldpay="apm-name" value="paypal">
					<input type="hidden" id="country-code" name="countryCode" data-worldpay="country-code" value="GB">
		         <input type="hidden" name="order-type" value="APM">
		         <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/buy-logo-medium.png" alt="Pay Now">	
				</div>				
			</div>
      </form>
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
	<div id="zd0">
		<p id="zp">We Accept</p>
   	<img src="img/payment-methods.png" alt="Payment Methods" id="zi0">      
   </div>
</div>
<script>
	_('zyot').onchange=function () {
		if(this.value=="APM"){
			_("paymentForm").style.display="none";
			_("paymentForm2").style.display="block";
			Worldpay.tokenType = 'apm';
		}else{
			_("paymentForm").style.display="block";
			_("paymentForm2").style.display="none";
			Worldpay.tokenType = 'ecom';
		}
	}
	// paypal
			 var form2 = _('paymentForm2');
	         //Worldpay.tokenType = 'apm';
	         Worldpay.setClientKey("L_C_fe93a439-fb20-4831-a82a-0d08fac2ebc5");
	         Worldpay.useForm(form2, function (status, response) {
	             if (response.error) {
	                 Worldpay.handleError(form2, _('paymentErrors2'), response.error);
	             } else {
	                 var token = response.token;
	                 Worldpay.formBuilder(form2, 'input', 'hidden', 'token', token);
	                 form2.submit();
	             }
	         });
	// card
			var form = _('paymentForm');
         Worldpay.useOwnForm({
           'clientKey': 'L_C_fe93a439-fb20-4831-a82a-0d08fac2ebc5',
           'form': form,
           'reusable': false,
           'callback': function(status, response) {
             _('paymentErrors').innerHTML = '';
             if (response.error) {
             	Worldpay.handleError(form, _('paymentErrors'), response.error); 
             } else {
               var token = response.token;
               Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
               form.submit();
             }
           }
         });         
</script>
<?php include "../INC_FOOT.php"; ?> 