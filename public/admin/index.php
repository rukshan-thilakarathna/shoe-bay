<?php  
include "../INC_SESS.php";
$ADM = isset($_SESSION['adm']) && !empty($_SESSION['adm']) ? TRUE : FALSE;

$err = array(FALSE,FALSE,FALSE,FALSE,FALSE);
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
*/		
		$img = "";
		
		$err[0] = empty($_POST['zyun']) ? TRUE : FALSE;		
		$err[1] = empty($_POST['zypw']) ? TRUE : FALSE;		
		if(!in_array(TRUE, $err)){
			if(!in_array(TRUE, $err)){
				//check whether username is exist or not
				$p = $db->prepare("SELECT `idz`,`pw`,`un` FROM `admins` WHERE `un`=?");
				$p->execute([$_POST['zyun']]);
					//email exists
					if($r = $p->fetch()) {
						$PASSWD = password_verify($_POST['zypw'],$r['pw']) ? TRUE : FALSE;
						if($PASSWD){
							$_SESSION['adm']=$r['idz'];
							header("Location:dashboard.php");
						}else $err[3]=TRUE;
					} else $err[2]=TRUE;
			}
		}
	}

include "ADM_HEAD.php"; ?>
<title>Admin Login</title>
<link href="<?php echo BASE; ?>admin/adm-x3-forms.css" rel="stylesheet">
<style>
#bt4{background-position: -48px 0px;}
 .zh1{margin-top: 100px;}
 #zyd{ min-height:400px;}
</style>
</head>
<body>
<div class="w" id="zyd">
	<h1 class="e1 zh1">Admin Login</h1>
	<form class="x3f" autocomplete="off" method="post" action="">
		<label class="x3lb">
			<span class="x3s">Username</span>
			<div class="x3d">
				<input type="text" class="x3in" name="zyun" id="zyun" value="<?php echo $_POST['zyun'] ?? '' ; ?>">
				<span class="x3s1" id="zyun0"></span>			
			</div>
		</label>
		<label class="x3lb">
			<span class="x3s">Password</span>
			<div class="x3d">
				<input type="password" class="x3in" name="zypw" id="zypw" value="<?php echo $_POST['zypw'] ?? '' ; ?>">
				<span class="x3s1" id="zypw0"></span>
			</div>
		</label>
		<div class="x3lb">
			<input type="submit" class="x3in2" name="zysent" value="Login">		
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
<?php include "ADM_FOOT.php"; ?> 