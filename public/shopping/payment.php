<?php 


include "../INC_SESS.php"; 

include "INC_PG.php";

include "../INC_HEAD.php";

?>
<title>Payment - SukeeFashion</title>
<link href="<?php echo BASE; ?>css/x3-forms.css?jk" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x4-shopping.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x6-table.css?ASad" rel="stylesheet">
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
							<option value="ECOM">PayHere</option>
							<option value="APM">Koko Payment</option>
						</select>
					</div>
				</div>
			</div>
			<form class="zf" action="https://sandbox.payhere.lk/pay/checkout" id="paymentForm" method="post">

                <input type="hidden" name="merchant_id" value="1221531">
                <input type="hidden" name="return_url" value="https://riverston.com/payment.php">
                <input type="hidden" name="cancel_url" value="https://riverston.com/payment.php">
                <input type="hidden" name="notify_url" value="https://riverston.com/notify.php">

                <span id="paymentErrors" class="x3s2"></span>
				<label class="x3lb">
					<span class="x3s">Frist Name</span>
					<div class="x3d">
						<input type="text" readonly class="x3in" name="first_name" data-worldpay="name" value="<?php echo $_SESSION['sfn'];?>">
					</div>	
				</label>

                <label class="x3lb">
                    <span class="x3s">Last Name</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="last_name" data-worldpay="name" value="<?php echo $_SESSION['bln'];?>">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">Address</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="address" data-worldpay="name" value="<?php echo $_SESSION['bad1']." ,".$_SESSION['bad2']." ,".$_SESSION['bad3'];?>">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">City</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="city" data-worldpay="name" value="<?php echo $_SESSION['bct'];?>">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">Email Address</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="email" data-worldpay="name" value="<?php echo $_SESSION['bem'];?>">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">Phone Number</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="phone" data-worldpay="name" value="<?php echo $_SESSION['bpz'];?>">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">Amount</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="amount" data-worldpay="name" value="<?php echo $_SESSION['tpr'];?>">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">Currency</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="currency" data-worldpay="name" value="LKR">
                    </div>
                </label>

                <label class="x3lb">
                    <span class="x3s">Country</span>
                    <div class="x3d">
                        <input type="text" readonly class="x3in" name="country" data-worldpay="name" value="Srilanka">
                        <input class="zin1" type="hidden" name="hash" value="<?php echo  $hash ?? ""; ?>">
                        <input class="zin1" type="hidden" name="order_id" value="<?php echo  $order_id; ?>">
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
					<div class="x6c1"><?php echo $cart['item_id']; ?></div>
					<div class="x6c2"><?php echo $cart['item_name']; ?></div>
					<div class="x6c3"><?php echo $cart['item_qty']; ?></div>
					<div class="x6c3">LKR <?php echo $totalPrice; ?></div>
				</div>

				<?php 
					}
				?>

				<div class="x6r x6e">
					<div class="x6c1"></div>
					<div class="x6c2"></div>
					<div class="x6c3"><?php echo $allQty; ?></div>
					<div class="x6c3">LKR <?php echo $_SESSION['tpr']; ?></div>
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