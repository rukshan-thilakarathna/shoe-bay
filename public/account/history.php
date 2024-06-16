<?php 
include "../INC_SESS.php"; 
if(empty($_SESSION['uid'])) header("Location:index.php");
date_default_timezone_set("Europe/London");

include "../INC_HEAD.php"; 
?>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x5-accounts.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x6-table.css" rel="stylesheet">
<title>Order History</title>
<style>
 #x5a2{color: #fff; text-decoration: none;  background:#e31f1f;}
.zs{float: right;}
.a0{width: auto; margin-left: 20px; border-radius: 4px;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<?php include "INC_ACCMENU.php"; ?>
	<h1 class="e1">Order History</h1>
	<p class="e1">Here you will see all your previous orders.</p>
	<?php
		$p = $db->prepare("SELECT `oid`, `tpr`, `dt`, `tz` FROM `orders` WHERE `uid`=?");
		$p->execute([$_SESSION['uid']]);
		$res = $p->fetchAll();
		if(count($res)>0){
			foreach($res as $r){
				?>
			
			<h2>Order #<?php echo $r['oid'],'<span class="zs">',$r['dt'],' ',$r['tz'],'</span>'; ?> <a href="account/re-order.php?oid=<?php echo $r['oid']; ?>"  class="a0 e2">Re-Order</a></h2>
			<div class="x6d">
				<div class="x6r x6e">
					<div class="x6c1">Item ID</div>
					<div class="x6c2">Item Name</div>
					<div class="x6c2">Item Price</div>
					<div class="x6c3">Quantity</div>
					<div class="x6c3">Total</div>
				</div>
				<?php
				$p2 = $db->prepare("SELECT * FROM `orderitems` WHERE `oid`=?");
				$p2->execute([$r['oid']]);
				$res2 = $p2->fetchAll();
				
				if(count($res2)>0){
					foreach($res2 as $s){
				?>
				<div class="x6r">
					<div class="x6c1">CW<?php echo $s['iid']; ?></div>
					<div class="x6c2"><?php echo $s['ina']; ?></div>
					<div class="x6c3">£ <?php echo $s['ipr']; ?></div>
					<div class="x6c3"><?php echo $s['iqt']; ?></div>
					<div class="x6c3">£ <?php echo $s['ipr']*$s['iqt']; ?></div>
				</div>	
				<?php 
					}
				}
			?>
				<div class="x6r x6e1">
					<div class="x6c1"></div>
					<div class="x6c2"></div>
					<div class="x6c2"></div>
					<div class="x6c3"></div>
					<div class="x6c3">£ <?php echo $r['tpr']; ?></div>
				</div>
			</div>
			<?php	
			}
		}
	?>
		
</div>
<?php include "../INC_FOOT.php"; ?> 