<?php  
include "ADM_SESS.php";
//$ermsg = "";
date_default_timezone_set("Europe/London");
$OK = FALSE;

	$p = $db->prepare("SELECT `fn`,`ln` FROM `users` WHERE `uid`=?");
	$p->execute([$_POST['zyid']]);
	if($r = $p->fetch()){
		if(isset($_POST['post'])){
			$OK = $db->prepare("DELETE FROM `users` WHERE `uid`=?")->execute([$_POST['zyid']]);
		}
	}else echo "No records found";

?>
	<div id="zy1">
		<?php if($OK) echo '<div class="x3ok">The customer has been deleted</div>'; ?>
		<h1>Delete Customer</h1>
		<p>Are you sure you want to delete the customer <?php echo $r['fn'],' ',$r['ln']; ?>?</p>
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