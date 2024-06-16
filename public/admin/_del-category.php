<?php  
include "ADM_SESS.php";
$err = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);
$OK = FALSE;

	$p0 = $db->prepare("SELECT `idz` FROM `items` WHERE `ca`=?");
	$p0->execute([$_POST['zyid']]);
	$itemCount = $p0->rowCount();

	$p = $db->prepare("SELECT * FROM `categories` WHERE `cid`=?");
	$p->execute([$_POST['zyid']]);
	if($r = $p->fetch()){

		if(isset($_POST['post'])){
		/*
			Errors
			=======================
			0 - Admin Password incorrect
		*/
	
			$p2 = $db->prepare("SELECT `pw` FROM `admins` WHERE `idz`=?");
			$p2->execute([$_SESSION['adm']]);
			if($s = $p2->fetch()) {
				$PASSWD = password_verify($_POST['zypw'],$s['pw']) ? TRUE : FALSE;
				if($PASSWD){
					$OK = $db->prepare("DELETE FROM `categories` WHERE `cid`=?")->execute([$_POST['zyid']]);
					if($itemCount>0) $db->prepare("DELETE FROM `items` WHERE `ca`=?")->execute([$_POST['zyid']]);
					if(!empty($r['iz'])) unlink('../img/categories/'.$r['iz']);	
				}else $err[7]=TRUE;
			}	
		}
	}else echo "No records found";

 ?>


	<div id="zy1">
		<?php if($OK) echo '<div class="x3ok">The Category has been deleted successfully.</div>'; ?>
		<h1>Delete Category</h1>
		<?php 
			if($itemCount>0){
				$pronoun = $itemCount>1 ? 'are' : 'is';
				echo '<p>Please Note : ',$itemCount,' item(s) ',$pronoun,' in the category. When you delete the category, all items belonging to the category will also be deleted.</p>'; 
			} 
		?>
		<p>Admin password is required to delete a category.</p>
		<form action="" method="post" enctype="multipart/form-data" id="zf1">
			<fieldset class="x3fs">
				<label class="x3lb">
					<span class="x3s">Admin Password *</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zypw" value="<?php echo $zypw; ?>" id="zypw">
					</div>
				</label>
				<div class="x3lb">
					<span class="x3s">&nbsp;</span>
					<div class="x3d x9e">
					<input type="button" value="Delete" class="x3in x3in2" id="zysentDel">
					<input type="hidden" id="zyid" name="zyid" value="<?php echo $_POST['zyid']; ?>">
					<input type="hidden" name="post" value="1">
					</div>
				</div>
			</fieldset>
		</form>
	</div>
<?php  
$msgno = "";
if(in_array(TRUE, $err)){
	$arrlen = count($err);
	for($i=0;$i<$arrlen;$i++){
		if($err[$i]) $msgno.=" e".$i;
	}
}
?>
<input type="hidden" id="msgno" value="<?php echo $msgno; ?>">
