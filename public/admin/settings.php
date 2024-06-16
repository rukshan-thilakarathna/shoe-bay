<?php 
include "ADM_SESS.php";
date_default_timezone_set("Europe/London");
$err = array(FALSE, FALSE, FALSE, FALSE,FALSE,FALSE);
$p = $db->prepare("SELECT `pw`,`emails` FROM `admins` WHERE `idz`=?");
$p->execute(array($_SESSION['adm']));
if($s = $p->fetch()){
		
	/*
		/*
		0 - incorrect old password
		1 - p1 is empty
		2 - p2 is empty
		3 - passwords do not match
		4 - emails cannot be empty
		5 - one of email addresses are incorrect
	*/
	
if(isset($_POST['zysent'])){
	
	$err[1] = empty($_POST['zyp1']) ? TRUE : FALSE;
	$err[2] = empty($_POST['zyp2']) ? TRUE : FALSE;
	
	//passwords do not match
	if(!empty($_POST['zyp1']) && !empty($_POST['zyp2'])){
		if($_POST['zyp1']!=$_POST['zyp2']) $err[3]=TRUE;
	}
	 
	//check whether user exist or not
	if(!in_array(TRUE, $err)){
		if(password_verify($_POST['zyp0'],$s['pw'])){
			$ok = $db->prepare("UPDATE `admins` SET `pw`=? WHERE `idz`=?")->execute([password_hash($_POST['zyp1'], PASSWORD_DEFAULT),$_SESSION['adm']]);
			header("Location:settings.php?done=1");
		}else $err[0] = TRUE;
	}
}
if(isset($_POST['zysent2'])){
	$_POST['zyem'] = trim($_POST['zyem']);
	$_POST['zyem'] = strtolower($_POST['zyem']);
	$err[4] = empty($_POST['zyem']) ? TRUE : FALSE;
	
	if(strpos($_POST['zyem'],',')){
		$arr = explode(',',$_POST['zyem']);
		foreach($arr as $a){
			$a = filter_var($a, FILTER_SANITIZE_EMAIL);
			if(empty($a) || !filter_var($a,FILTER_VALIDATE_EMAIL)) $err[5]=TRUE;		
		}
	}
	
	if(!in_array(TRUE, $err)){
			$ok = $db->prepare("UPDATE `admins` SET `emails`=? WHERE `idz`=?")->execute([$_POST['zyem'],$_SESSION['adm']]);
			header("Location:settings.php?done=1");
	}
}
include "ADM_HEAD.php"; ?>
<title>Settings</title>
<link href="<?php echo BASE; ?>admin/adm-x3-forms.css" rel="stylesheet">
<style>
/*.zi{width: 50px; display: block; margin:0 auto;transition:1s all;}
.zc{background:rgba(255,255,255,.2);
    width: 260px;
    padding: 20px;
    text-align: center;
    border-radius: 5px;}
.za{text-decoration: none; margin:20px;}
.za:hover .zi{transform:scale(1.5);}*/
#a7{color: #f14428; background:#f88408;}
.zd{margin:30px auto; width: 500px;}
.zs{font-size: 14px;}
</style>
<?php include "ADM_NAVI.php"; ?>
<div class="w">
<?php
	if(isset($_GET['done'])) echo '<div class="x3ok">Login password is updated successfully.</div>';
?>
	<h1>Settings</h1>
	<p class="e1">Here you will update admin login password.</p>
	<div class="zd">
		<form class="zf" autocomplete="off" method="post" action="admin/settings.php">
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
		<p class="e1">Admin emails to get copies of orders. <span class="zs"> (Add emails separated by commas)</span></p>
		<div class="zd">
			<form class="zf" autocomplete="off" method="post" action="admin/settings.php">
				<label class="x3lb">
					<span class="x3s">Admin Emails</span>
					<div class="x3d">
						<textarea name="zyem" class="x3in" id="zyem" placeholder="add emails separated by commas"><?php echo $_POST['zyem'] ?? $s['emails']; ?></textarea>
						<span class="x3s1" id="zyem0"></span>
					</div>	
				</label>
				<div class="x3lb">
					<div class="x3d">
						<input type="submit" class="x3in2" value="Update" name="zysent2">
					</div>				
				</div>
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
				if(n=='4'){
					_('zyem').classList.toggle('x3e',1);
					_('zyem0').appendChild(_e('div','This is cannot be empty',{"class":"x3s2"}));
				} 
				if(n=='5'){
				 	_('zyem').classList.toggle('x3e',1);
					_('zyem0').appendChild(_e('div','One of email addresses are incorrect',{"class":"x3s2"}));
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
<?php include "ADM_FOOT.php"; 
}else echo 'Your session is expired. Please re-login.';
?>