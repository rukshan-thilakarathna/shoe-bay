<?php 
include "../INC_SESS.php"; 
include "../INC_HEAD.php"; 
	if(!isset($_SESSION['cart']) || isset($_POST['delall'])){
		$_SESSION['cart'] = array();		
	}
	if(isset($_POST['item'])){
		$q = $db->prepare("SELECT `idz`, `na`, `pr`, `iz` FROM `items` WHERE `idz`=?");
		$q->execute([$_POST['item']]);
		if($r = $q->fetch()) {
			$qty = $_POST['qty'] ?? 1;
			$_SESSION['cart'][$r['idz']] = array(
			 'item_id' => $r['idz'],
			 'item_name' => $r['na'],
			 'item_price' => $r['pr'],
			 'item_img' => $r['iz'],
			 'item_qty' => $qty
			);
		}
		header("Location:".URL."shopping");
	}
	if(isset($_POST['upid'])){
		if(isset($_SESSION['cart'][$_POST['upid']])){
			$_SESSION['cart'][$_POST['upid']]['item_qty'] = $_POST['qty'];	
		}
		header("Location:".URL."shopping");
	}
	if(isset($_POST['delid'])){
		if(isset($_SESSION['cart'][$_POST['delid']])){
			unset($_SESSION['cart'][$_POST['delid']]);	
		}
		header("Location:".URL."shopping");
	}
?>
<title>Shopping Cart</title>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x4-shopping.css" rel="stylesheet">
<style>
#bt2{background-position: -100px 0px;}
#zd{display: table; width: 100%;}
.zr{display: table-row;}
.zr > div{display: table-cell; vertical-align: middle; padding:10px 20px;font-family: 'Cuprum', sans-serif; color:#ccc; font-size:18px;background:rgba(255,255,255,.2);}
.zi{width: 120px;}
.zc3{text-align: right; border-right:1px solid rgba(0,0,0,.2); }
.ze{background:rgba(255,255,255,.2);}
.zsl{background:#333; padding:5px; border:0; color: #ccc;font-family: 'Cuprum', sans-serif; font-size:16px; height:24px; margin-right:10px; width:40px;}
.zbt{width: auto; margin-right: 0}
.zc1,.zc2,.zc3{ border-bottom:1px solid rgba(0,0,0,.2); }

@media screen and (max-width:1000px){
	#x4a1{display: block;}
	#x4a2{display: none;}
	#x4a3{display: none;}
	#x4a4{display: none;}

}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<div id="x4d">
		<a class="x4a x4e" id="x4a1" href="shopping/">Shopping Cart</a>
		<a class="x4a" id="x4a2"href="<?php echo !empty($_SESSION['ez']) ? 'shopping/user.php' : 'javascript:;'; ?>">User Information</a>
		<a class="x4a" id="x4a3"href="<?php echo !empty($_SESSION['bem']) ? 'shopping/billing.php' : 'javascript:;'; ?>">Billing / Shipping Details</a>
		<a class="x4a" id="x4a4"href="<?php echo !empty($_SESSION['bem']) ? 'shopping/payment.php' : 'javascript:;'; ?>">Payments</a>
	</div>
	<h1>Shopping Cart</h1>
	<?php
		$itemCount = count($_SESSION['cart']);
		if($itemCount>0){
			$allQty = 0;
			$allPrice = 0;
	?>
	<div id="zd">
		<div class="zr ze">
			<div class="zc1">Item ID</div>
			<div class="zc1">Image</div>
			<div class="zc2">Item Name</div>
			<div class="zc3">Quantity</div>
			<div class="zc3">Item Price</div>
			<div class="zc3">Total</div>
			<div class="zc3">Action</div>
		</div>
		<?php
			foreach($_SESSION['cart'] as $cart){
				$totalPrice = $cart['item_price']*$cart['item_qty'];
				$allQty += $cart['item_qty']; 
				$allPrice += $totalPrice; 
		?>
		<div class="zr">
			<div class="zc1">CW<?php echo $cart['item_id']; ?></div>
			<div class="zc1">
				<img src="items/<?php echo $cart['item_img']; ?>" alt="" class="zi">
			</div>
			<div class="zc2"><?php echo $cart['item_name']; ?></div>
			<div class="zc3">
			<form method="post" action="shopping/index.php">
				<input type="number" name="qty" class="zsl" min="1" step="1" value="<?php echo $cart['item_qty']; ?>">
				<input type="hidden" name="upid" value="<?php echo $cart['item_id']; ?>">
				<input class="a0 zbt" type="submit" value="Update">
			</form>
			</div>
			<div class="zc3">£ <?php echo $cart['item_price']; ?></div>
			<div class="zc3">£ <?php echo $totalPrice; ?></div>
			<div class="zc3">
				<form method="post" action="shopping/index.php">
					<input type="hidden" name="delid" value="<?php echo $cart['item_id']; ?>">
					<input class="a0 zbt e2" type="submit" value="Delete">
				</form>
			</div>
		</div>	
		<?php 
			}
		?>
		<div class="zr ze">
			<div class="zc1"></div>
			<div class="zc1"></div>
			<div class="zc2"></div>
			<div class="zc3"><?php echo $allQty; ?></div>
			<div class="zc3"></div>
			<div class="zc3">£ <?php echo $allPrice; ?></div>
			<div class="zc3">
				<form method="post" action="shopping/index.php">
					<input type="submit" name="delall" class="a0" value="Clear All">
				</form>	
			</div>
		</div>
	</div>
	<div>
		<a class="a2" href="shopping/user.php"><button class="x4e x4bt2">Continue</button></a>
	</div>
	<p>When you are done here, Please press the Continue button to fill billing and shopping address</p>
	<?php
		}else echo '<p>Cart is empty</p>';
	?>
</div>
<script>
function openNav() {
  document.getElementById("n1").style.width = "250px";
  document.getElementById("n1").style.display="block";
}

function closeNav() {
  document.getElementById("n1").style.width = "0";
}
</script>

<?php include "../INC_FOOT.php"; ?> 