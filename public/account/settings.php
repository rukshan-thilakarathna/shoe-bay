<?php 
include "../INC_SESS.php"; 
if(empty($_SESSION['uid'])) header("Location:index.php");
date_default_timezone_set("Europe/London");
$err = array(FALSE, FALSE, FALSE, FALSE);
if(isset($_POST['zysent'])){
	/*
		/*
		0 - incorrect old password
		1 - p1 is empty
		2 - p2 is empty
		3 - passwords do not match
	*/
	$err[1] = empty($_POST['zyp1']) ? TRUE : FALSE;
	$err[2] = empty($_POST['zyp2']) ? TRUE : FALSE;
	
	//passwords do not match
	if(!empty($_POST['zyp1']) && !empty($_POST['zyp2'])){
		if($_POST['zyp1']!=$_POST['zyp2']) $err[3]=TRUE;
	}
	 
	//check whether user exist or not
	if(!in_array(TRUE, $err)){
		$usrExist = $db->prepare("SELECT `pw` FROM `users` WHERE `uid`=?");
		$usrExist->execute(array($_SESSION['uid']));
		$r = $usrExist->fetch();
		if(password_verify($_POST['zyp0'],$r['pw'])){
			$ok = $db->prepare("UPDATE `users` SET `pw`=? WHERE `uid`=?")->execute([password_hash($_POST['zyp1'], PASSWORD_DEFAULT),$_SESSION['uid']]);
			header("Location:settings.php?done=1");
		}else $err[0] = TRUE;
	}
}
include "../INC_HEAD.php"; 
?>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x5-accounts.css" rel="stylesheet">
<title>Account Settings</title>
<style>
 #x5a4{color: #fff; text-decoration: none;  background:#e31f1f;}
  #zd{margin:30px auto; width: 500px;}
 .x3ok{text-align: center;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<?php include "INC_ACCMENU.php"; 
	 if(isset($_GET['done'])) echo '<div class="x3ok">Login password is updated successfully.</div>';	
	?>
	<h1 class="e1">Account Settings</h1>
	<p class="e1">Here you will update your login information.</p>
	<div id="zd">
			<form class="zf" autocomplete="off" method="post" action="account/settings.php">
				<label class="x3lb">
					<span class="x3s">Old Password</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zyp0" id="zyp0" value="<?php echo $_POST['zyp0'] ?? ''; ?>">
						<span class="x3s1" id="zyp00"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">New Password</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zyp1" id="zyp1" value="<?php echo $_POST['zyp1'] ?? ''; ?>">
						<span class="x3s1" id="zyp10"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Re-Enter Password</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zyp2" id="zyp2" value="<?php echo $_POST['zyp2'] ?? ''; ?>">
						<span class="x3s1" id="zyp20"></span>
					</div>	
				</label>
				<div class="x3lb">
					<div class="x3d">
						<input type="submit" class="x3in2" value="Update" name="zysent">
					</div>				
				</div>
			</form>	
		</div>
</div>
<?php  
$msgno = "";
if(in_array(TRUE, $err)){
	$arrlen = count($err);
	for($i=0;$i<$arrlen;$i++){
		if($err[$i]) $msgno.=" ".$i;
	}
}
?>
<script>
function _e(e,t="",o=null,c=null) {
	var el = document.createElement(e);
	if(t!=="") el.textContent=t;
	if(o!=null) for (var i in Object.keys(o)) el.setAttribute(Object.keys(o)[i],Object.values(o)[i]);
	if(c!=null) for (var i in Object.keys(c)) el.appendChild(Object.values(c)[i]);
	return el;
}
function onError(str) {
	if(str!=""){
		str = str.trim();
		var a = str.split(" ");
			var zy1 = _('zy1');
			function f(n,i){
				if(n=='0'){
					_('zyp0').classList.toggle('x3e',1);
					_('zyp00').appendChild(_e('div','Old password is incorrect',{"class":"x3s2"}));
				} 
				if(n=='1'){
					_('zyp1').classList.toggle('x3e',1);
					_('zyp10').appendChild(_e('div','This is cannot be empty',{"class":"x3s2"}));
				} 
				if(n=='2'){
				 	_('zyp2').classList.toggle('x3e',1);
					_('zyp20').appendChild(_e('div','This is cannot be empty',{"class":"x3s2"}));
				}
				if(n=='3'){
				 	_('zyp1').classList.toggle('x3e',1);
				 	_('zyp2').classList.toggle('x3e',1);
					_('zyp10').appendChild(_e('div','Passwords do not match',{"class":"x3s2"}));
					_('zyp20').appendChild(_e('div','Passwords do not match',{"class":"x3s2"}));
				}
			}
			a.forEach(f);
	}
}
function onfocusUndo(arr) {
	function f(n,i){
		_(n).onfocus=function () {
			this.classList.toggle('x3e',0);
			_(n+'0').getElementsByClassName('x3s2')[0].remove();
		}
	}
	arr.forEach(f);
}
onError("<?php echo $msgno; ?>");
onfocusUndo(['zyp0', 'zyp1', 'zyp2']);
</script>
<?php include "../INC_FOOT.php"; ?> 