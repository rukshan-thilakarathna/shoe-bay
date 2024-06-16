<?php 
include "../INC_SESS.php"; 
include "../INC_HEAD.php"; ?>
<link href="css/x3-forms.css" rel="stylesheet">
<script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
<title>Order is not completed</title>
<style>
#zd{text-align: center;}
#zi{width: 200px; margin:30px;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w" id="zd">
	<h1>Your Order is 
		<?php
			if(isset($_GET['pending'])) echo 'Pending';
			if(isset($_GET['failed'])) echo 'Failed';
			if(isset($_GET['canceled'])) echo 'Canceled';
		?>	
	</h1>
	<p>Your payment is <?php
			if(isset($_GET['pending'])) echo 'Pending';
			if(isset($_GET['failed'])) echo 'Failed';
			if(isset($_GET['canceled'])) echo 'Canceled';
		?>	</p>
	<!--<img src="img/thanks.svg" alt="Thank You" id="zi">-->
</div>

<?php include "../INC_FOOT.php"; ?> 