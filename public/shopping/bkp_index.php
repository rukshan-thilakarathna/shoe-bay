<?php 
include "../INC_SESS.php"; 
include "../INC_HEAD.php"; 
	if(!isset($_SESSION['item_id']) || isset($_POST['delall'])){
		$_SESSION['item_name'] = array();	
		$_SESSION['item_qty'] = array();	
		$_SESSION['item_price'] = array();	
		$_SESSION['item_id'] = array();	
		$_SESSION['item_img'] = array();	
	}
	if(isset($_POST['item'])){
		$q = $db->prepare("SELECT `idz`, `na`, `pr`, `iz` FROM `items` WHERE `idz`=?");
		$q->execute([$_POST['item']]);
		if($r = $q->fetch()) {
			$qty = $_POST['qty'] ?? 1;
			array_push($_SESSION['item_id'],$r['idz']);
			array_push($_SESSION['item_name'],$r['na']);
			array_push($_SESSION['item_price'],$r['pr']);
			array_push($_SESSION['item_img'],$r['iz']);
			array_push($_SESSION['item_qty'],$qty);
		}
		header("Location:".URL."shopping");
	}
	if(isset($_POST['upid'])){
		$key = array_search($_POST['upid'],$_SESSION['item_id']);
		if(FALSE !== $key){
			$_SESSION['item_qty'][$key] = $_POST['qty'];	
		}
		header("Location:".URL."shopping");
	}
	if(isset($_POST['delid'])){
		$key = array_search($_POST['delid'],$_SESSION['item_id']);
		if(FALSE !== $key){
			$_SESSION['item_name'][$key] = "";
			$_SESSION['item_qty'][$key] = "";
			$_SESSION['item_price'][$key] = "";
			$_SESSION['item_id'][$key] = "";
			$_SESSION['item_img'][$key] = "";
		}
		header("Location:".URL."shopping");
	}
?>
<title>Shopping Cart</title>
<link href="css/x3-forms.css" rel="stylesheet">
<link href="css/x4-shopping.css" rel="stylesheet">
<style>
#bt2{background-position: -100px 0px;}
#zd{display: table; width: 100%;}
.zr{display: table-row;}
.zr > div{display: table-cell; vertical-align: middle; padding:10px 20px;font-family: 'Cuprum', sans-serif; color:#ccc; font-size:18px;background:rgba(255,255,255,.2);}
.zi{width: 120px;}
.zc3{text-align: right; border-right:1px solid rgba(0,0,0,.2); }
.ze{background:rgba(255,255,255,.2);}
.zsl{background:#333; padding:5px; border:0; color: #ccc;font-family: 'Cuprum', sans-serif; font-size:16px; height:24px; margin-right:10px;}
.zbt{width: auto; margin-right: 0}
.zc1,.zc2,.zc3{ border-bottom:1px solid rgba(0,0,0,.2); }
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<div id="x4d">
		<a class="x4a x4e" href="shopping/">Shopping Cart</a>
		<a class="x4a" href="<?php echo !empty($_SESSION['ez']) ? 'shopping/user.php' : 'javascript:;'; ?>">User Information</a>
		<a class="x4a" href="<?php echo !empty($_SESSION['bem']) ? 'shopping/billing.php' : 'javascript:;'; ?>">Billing / Shipping Details</a>
		<a class="x4a" href="<?php echo !empty($_SESSION['bem']) ? 'shopping/payment.php' : 'javascript:;'; ?>">Payments</a>
	</div>
	<h1>Shopping Cart</h1>
	<?php
		$itemCount = count($_SESSION['item_id']);
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
			for($i=0;$i<$itemCount;$i++){
				if(empty($_SESSION['item_id'][$i])) continue;
				$totalPrice = $_SESSION['item_price'][$i]*$_SESSION['item_qty'][$i];
				$allQty += $_SESSION['item_qty'][$i]; 
				$allPrice += $totalPrice; 
		?>
		<div class="zr">
			<div class="zc1">CW<?php echo $_SESSION['item_id'][$i]; ?></div>
			<div class="zc1">
				<img src="items/<?php echo $_SESSION['item_img'][$i]; ?>" alt="" class="zi">
			</div>
			<div class="zc2"><?php echo $_SESSION['item_name'][$i]; ?></div>
			<div class="zc3">
			<form method="post" action="shopping/index.php">
				<input type="number" name="qty" class="zsl" value="<?php echo $_SESSION['item_qty'][$i]; ?>">
				<input type="hidden" name="upid" class="zsl" value="<?php echo $_SESSION['item_id'][$i]; ?>">
				<input class="a0 zbt" type="submit" value="Update">
			</form>
			</div>
			<div class="zc3">£<?php echo $_SESSION['item_price'][$i]; ?></div>
			<div class="zc3">£<?php echo $totalPrice; ?></div>
			<div class="zc3">
				<form method="post" action="shopping/index.php">
					<input type="hidden" name="delid" class="zsl" value="<?php echo $_SESSION['item_id'][$i]; ?>">
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
			<div class="zc3"><?php echo $allPrice; ?></div>
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


<?php include "../INC_FOOT.php"; ?> 