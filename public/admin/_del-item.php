<?php  
include "ADM_SESS.php";
//$ermsg = "";
date_default_timezone_set("Europe/London");
$OK = FALSE;

	$p = $db->prepare("SELECT * FROM `items` WHERE `idz`=?");
	$p->execute([$_POST['zyid']]);
	if($r = $p->fetch()){

		if(isset($_POST['post'])){
			$OK = $db->prepare("DELETE FROM `items` WHERE `idz`=?")->execute([$_POST['zyid']]);
			if(!empty($r['iz'])) unlink('../items/'.$r['iz']);	
		}
	}else echo "No records found";

 ?>


	<div id="zy1">
		<?php if($OK) echo '<div class="x3ok">The item has been deleted</div>'; ?>
		<h1>Delete Item</h1>
		<p>Are you sure you want to delete the item <?php echo $r['na']; ?>?</p>
		<form action="" method="post" enctype="multipart/form-data" id="zf1">
		<fieldset class="x3fs">
			<div class="x3lb">
				<input type="button" value="Delete" class="x3in x3in2" id="zysentDel">
				<input type="hidden" value="1" name="post">
				<input type="hidden" id="zyid" name="zyid" value="<?php echo $_POST['zyid']; ?>">
			</div>
		</fieldset>	
	</form>
	</div>