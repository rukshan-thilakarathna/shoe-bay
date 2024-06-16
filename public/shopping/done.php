<?php 
include "../INC_SESS.php"; 
	//cart
	unset($_SESSION['cart']);
	unset($_SESSION['tpr']);
	//billing
	unset($_SESSION['bfn']);
	unset($_SESSION['bln']);
	unset($_SESSION['bad1']);
	unset($_SESSION['bad2']);
	unset($_SESSION['bad3']);
	unset($_SESSION['bct']);
	unset($_SESSION['bst']);
	unset($_SESSION['bzp']);
	unset($_SESSION['bpz']);
	unset($_SESSION['bem']);
	//shipping
	unset($_SESSION['sfn']);
	unset($_SESSION['sln']);
	unset($_SESSION['sad1']);
	unset($_SESSION['sad2']);
	unset($_SESSION['sad3']);
	unset($_SESSION['sct']);
	unset($_SESSION['sst']);
	unset($_SESSION['szp']);
	unset($_SESSION['spz']);
	unset($_SESSION['sem']);
	//user
	unset($_SESSION['ez']);
include "../INC_HEAD.php"; ?>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
<title>Order is completed</title>
<style>
#zd{text-align: center;}
#zi{width: 200px; margin:30px;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w" id="zd">
	<h1>Your Order is completed</h1>
	<p>Your payment is successfully submitted. All the details of your order have been sent to your email. <br>Thank you for being with cellerswine.com</p>
	<img src="img/thanks.svg" alt="Thank You" id="zi">
</div>

<?php include "../INC_FOOT.php"; ?> 