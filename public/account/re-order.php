<?php 
include "../INC_SESS.php"; 
if(empty($_SESSION['uid'])) header("Location:index.php");
date_default_timezone_set("Europe/London");

include "../INC_HEAD.php"; 
if(isset($_GET['oid'])){
	$p = $db->prepare("SELECT * FROM `orderitems` WHERE `oid`=?");
	$p->execute([$_GET['oid']]);
	$res = $p->fetchAll();
	if(count($res)>0){
		if(!isset($_SESSION['cart']) || isset($_POST['delall'])){
			$_SESSION['cart'] = array();		
		}
		foreach($res as $r){
			$p2 = $db->prepare("SELECT `iz` FROM `items` WHERE `idz`=?");
			$p2->execute([$r['iid']]);
			$s = $p2->fetch();
			$iz = $s['iz'];
			$_SESSION['cart'][$r['iid']] = array(
			 'item_id' => $r['iid'],
			 'item_name' => $r['ina'],
			 'item_price' => $r['ipr'],
			 'item_img' => $iz,
			 'item_qty' => $r['iqt']
			);
		}
		header("Location:".URL."shopping");
	} else echo '<p style="text-align:center">Invalid request</p>';
}else echo '<p style="text-align:center">Invalid request</p>';
?>