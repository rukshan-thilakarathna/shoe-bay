<?php 
include "../INC_SESS.php"; 
if(isset($_SESSION['uid'])) header("Location:dashboard.php");
$err = array(FALSE,FALSE,FALSE,FALSE,FALSE,FALSE);
//$ermsg = "";
date_default_timezone_set("Europe/London");

	if(isset($_POST['zysent'])){
/*
	Errors
	=======================
	0 - Empty username
	1 - Empty password
	2 - There is no account associated with this username
	3 - Password is incorrect
	4 - something is wrong with the connection
	5 - your account has been blocked
*/		
		$img = "";
		
		$err[0] = empty($_POST['zyun']) ? TRUE : FALSE;		
		$err[1] = empty($_POST['zypw']) ? TRUE : FALSE;		
		if(!in_array(TRUE, $err)){
			if(!in_array(TRUE, $err)){
				//check whether username is exist or not
				$p = $db->prepare("SELECT `uid`,`pw`,`ez`,`fn`,`az` FROM `users` WHERE `ez`=?");
				$p->execute([$_POST['zyun']]);
					//email exists
					if($r = $p->fetch()) {
						if($r['az']){
							$PASSWD = password_verify($_POST['zypw'],$r['pw']) ? TRUE : FALSE;
							if($PASSWD){
								$_SESSION['uid']=$r['uid'];
								$_SESSION['ufn']=$r['fn'];
								header("Location:dashboard.php");
							}else $err[3]=TRUE;
						}else $err[5]=TRUE;
					} else $err[2]=TRUE;
			}
		}
	}

include "../INC_HEAD.php"; 
?>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<style>
#bt4{background-position: -48px 0px;}
 .zh1{margin-top: 100px;}
 
 @media screen and (max-width:500px){
		.zh1{margin-top:0;}
		.x3f{width: 80%;}
	

}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<h1 class="e1 zh1">Login</h1>
	<form class="x3f" autocomplete="off" method="post" action="account/index.php">
		<label class="x3lb">
			<span class="x3s">Username</span>
			<div class="x3d">		
				<input type="text" class="x3in" name="zyun" id="zyun" value="<?php echo $_POST['zyun'] ?? ''; ?>">
				<span class="x3s1" id="zyun0"></span>
			</div>
		</label>
		<label class="x3lb">
			<span class="x3s">Password</span>
			<div class="x3d">
				<input type="password" class="x3in" name="zypw" id="zypw" value="<?php echo $_POST['zypw'] ?? ''; ?>">
				<span class="x3s1" id="zypw0"></span>
			</div>
		</label>
		<div class="x3lb">
			<input type="submit" class="x3in2" name="zysent">		
		</div>
	</form>
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
				if(n=='0' || n=='2'){
					_('zyun').classList.toggle('x3e',1);
					_('zyun0').appendChild(_e('div','Invalid User Name',{"class":"x3s2"}));
				} 
				if(n=='1'){
				 	_('zypw').classList.toggle('x3e',1);
					_('zypw0').appendChild(_e('div','Password is empty',{"class":"x3s2"}));
				}
				if(n=='3'){
					_('zypw').classList.toggle('x3e',1);
					_('zypw0').appendChild(_e('div','Password is incorrect',{"class":"x3s2"}));
				}
				if(n=='5'){
					_('zyun').classList.toggle('x3e',1);
					_('zyun0').appendChild(_e('div','Your account has been blocked. Please Contact us',{"class":"x3s2"}));
				} 
				if(n=='4'){
					zy1.insertBefore(_e('div','Something is Wrong with the database connection',{"class":"x3ko"}),zy1.firstChild);
				} 
			}
			a.forEach(f);
			//zy1.insertBefore(_e('div','Something is Wrong, Please check the fields you filled bellow',{"class":"x3ko"}),zy1.firstChild);
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
onfocusUndo(['zyun', 'zypw']);
</script>
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