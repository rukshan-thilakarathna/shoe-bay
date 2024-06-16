<?php 
include "../INC_SESS.php"; 
$err = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);
date_default_timezone_set("Europe/London");
if(empty($_SESSION['cart'])) header("Location:index.php");
elseif(!empty($_SESSION['ez'])) header("Location:billing.php");
if(isset($_POST['reg'])){
	/*
		/*
		0 - empty first name 
		1 - invalid email
		2 - email is already exists
		3 - password do not match
		11 - password do not match
		4 - password 1 is  empty
		8 - empty last name
		9 - password 2 is empty
	*/
	$err[0] = empty($_POST['zyfn']) ? TRUE : FALSE;
	$err[8] = empty($_POST['zyln']) ? TRUE : FALSE;
	
	// invalid login emailA
	$_POST['zyem'] = strtolower($_POST['zyem']);
	$_POST['zyem'] = filter_var($_POST['zyem'], FILTER_SANITIZE_EMAIL);
	if(empty($_POST['zyem']) || !filter_var($_POST['zyem'],FILTER_VALIDATE_EMAIL)) $err[1]=TRUE;
	
	//passwords do not match
	 $err[3] = $_POST['zyp1']!=$_POST['zyp2'] ? TRUE : FALSE;
	 $err[11] = $_POST['zyp1']!=$_POST['zyp2'] ? TRUE : FALSE;
	 $err[4] = empty($_POST['zyp1']) ? TRUE : FALSE;
	 $err[9] = empty($_POST['zyp2']) ? TRUE : FALSE;
	 
	//check whether user exist or not
	if(!in_array(TRUE, $err)){
		$usrExist = $db->prepare("SELECT `uid` FROM `users` WHERE `ez`=?");
		$usrExist->execute(array($_POST['zyem']));
		if($usrExist->rowCount()>0) $err[2] = TRUE;
		else{
			$ok = $db->prepare("INSERT INTO `users` (`fn`,`ln`,`pz`,`ez`,`pw`,`dt`) VALUES (?,?,?,?,?,?)")->execute([$_POST['zyfn'], $_POST['zyln'], $_POST['zypz'], $_POST['zyem'], password_hash($_POST['zyp1'], PASSWORD_DEFAULT), date('Y-m-d')]);
			//to use get user in payment section
			$_SESSION['ez']=$_POST['zyem'];
			//to use in billing section
			$_SESSION['bfn']=$_POST['zyfn'];
			$_SESSION['bln']=$_POST['zyln'];
			$_SESSION['bpz']=$_POST['zypz'];
			$_SESSION['bem']=$_POST['zyem'];
			if($ok) header("Location:billing.php");
		}
	}
}

if(isset($_POST['log'])){
	/*
		5 - invalid email
		6 - email doesn't exist
		7 - incorrect username or password 
		10 - incorrect login password
	*/
	
	// invalid login emailA
	$_POST['zyez'] = strtolower($_POST['zyez']);
	$_POST['zyez'] = filter_var($_POST['zyez'], FILTER_SANITIZE_EMAIL);
	if(empty($_POST['zyez']) || !filter_var($_POST['zyez'],FILTER_VALIDATE_EMAIL)) $err[5]=TRUE;
	
	//check whether user exist or not
	if(!in_array(TRUE, $err)){
		$usrExist = $db->prepare("SELECT * FROM `users` WHERE `ez`=?");
		$usrExist->execute(array($_POST['zyez']));
		if($r = $usrExist->fetch()) {
			if(password_verify($_POST['zypw'],$r['pw'])){
				//to use to accessing in account section
				$_SESSION['uid']=$r['uid'];
				$_SESSION['ufn']=$r['fn'];
				//to use get user in payment section
				$_SESSION['ez']=$r['ez'];
				//to use in billing section
				$_SESSION['bfn']=$r['fn'];
				$_SESSION['bln']=$r['ln'];
				$_SESSION['bad1']=$r['ad1'];
				$_SESSION['bad2']=$r['ad2'];
				$_SESSION['bad3']=$r['ad3'];
				$_SESSION['bct']=$r['ct'];
				$_SESSION['bst']=$r['st'];
				$_SESSION['bzp']=$r['zp'];
				$_SESSION['bpz']=$r['pz'];
				$_SESSION['bem']=$r['ez'];
				header("Location:billing.php");
			}else{
				$err[7] = TRUE;
				$err[10] = TRUE;
			} 
		}else{
			$err[6] = TRUE;
		}
	}
}
if(!empty($_SESSION['uid'])){
	$usrExist = $db->prepare("SELECT * FROM `users` WHERE `uid`=?");
	$usrExist->execute(array($_SESSION['uid']));
	if($r = $usrExist->fetch()) {
		$_SESSION['ez']=$r['ez'];
		//to use in billing section
		$_SESSION['bfn']=$r['fn'];
		$_SESSION['bln']=$r['ln'];
		$_SESSION['bad1']=$r['ad1'];
		$_SESSION['bad2']=$r['ad2'];
		$_SESSION['bad3']=$r['ad3'];
		$_SESSION['bct']=$r['ct'];
		$_SESSION['bst']=$r['st'];
		$_SESSION['bzp']=$r['zp'];
		$_SESSION['bpz']=$r['pz'];
		$_SESSION['bem']=$r['ez'];
		header("Location:billing.php");
	}
}
include "../INC_HEAD.php"; ?>
<title>Customer Information</title>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x4-shopping.css" rel="stylesheet">
<style>
#zd{width:100%; box-sizing:border-box; display:flex;flex-wrap:wrap;justify-content:space-between;}
.zd1,.zd2{width: 45%;box-sizing:border-box; margin:20px 30px; }
.zd1{float: left; border-right:1px solid rgba(255,255,255,.2);}
.zd2{float: right;}
.zf{display: block; width: 80%; margin:20px auto;}
h2{border-bottom:1px solid rgba(255,255,255,.2); padding-bottom: 20px; margin-bottom: 40px;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w" id="zy1">
	<div id="x4d">
		<a class="x4a x4e" href="shopping/">Shopping Cart</a>
		<a class="x4a x4e" href="shopping/user.php">User Information</a>
		<a class="x4a" href="<?php echo !empty($_SESSION['bem']) ? 'shopping/billing.php' : 'javascript:;'; ?>">Billing / Shipping Details</a>
		<a class="x4a" href="<?php echo !empty($_SESSION['bem']) ? 'shopping/payment.php' : 'javascript:;'; ?>">Payments</a>
	</div>
	<h1>Customer Login / Registration</h1>
	<p>If you have an account here, please log in with your email address and password. If you are a new customer, create a new account</p>
	<div id="zd">
		<div class="zd1">
			<form class="zf" autocomplete="off" method="post" action="shopping/user.php">
			<h2>Login</h2>
				<label class="x3lb">
					<span class="x3s">Email</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyez" id="zyez" value="<?php echo $_POST['zyez'] ?? '';?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Password</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zypw" id="zypw" value="<?php echo $_POST['zypw'] ?? '';?>">
					</div>
				</label>
				<div class="x3lb">
					<input type="submit" value="Login" class="x3in2" name="log">
				</div>
			</form>
		</div>
		<div class="zd2">
			<form class="zf" autocomplete="off" method="post" action="shopping/user.php">
			<h2>Create a New account</h2>
				<label class="x3lb">
					<span class="x3s">First Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyfn" id="zyfn" value="<?php echo $_POST['zyfn'] ?? '';?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Last Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyln" id="zyln" value="<?php echo $_POST['zyln'] ?? '';?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Phone No</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zypz" id="zypz" value="<?php echo $_POST['zypz'] ?? '';?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Email</span>
					<div class="x3d">
						<input type="email" class="x3in" name="zyem" id="zyem" value="<?php echo $_POST['zyem'] ?? '';?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Password</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zyp1" id="zyp1" value="<?php echo $_POST['zyp1'] ?? '';?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Confirm Password</span>
					<div class="x3d">
						<input type="password" class="x3in" name="zyp2" id="zyp2" value="<?php echo $_POST['zyp2'] ?? '';?>">
					</div>
				</label>
				<div class="x3lb">
					<input type="submit" value="Register" class="x3in2" name="reg">	
				</div>
			</form>
		</div>
	</div>
</div>
<?php include "../INC_ERRMSG.php"; ?>
<script>
var SE_modal = {
	err:{
		"e0":['zyfn','First Name is empty'],
		"e4":['zyp1','Password cannot be empty'],
		"e9":['zyp2','Password cannot be empty'],
		"e8":['zyln','Last Name is empty'],
		"e1":['zyem','Invalid Email Address'],
		"e2":['zyem','An account with this email already exists'],
		"e5":['zyez','Invalid Email Address'],
		"e6":['zyez','There is no account associated with this email'],
		"e7":['zyez','Invalid Email or Password'],
		"e10":['zypw','Invalid Email or Password'],
		"e3":['zyp1','Passwords do not match'],
		"e11":['zyp2','Passwords do not match']
	}
}
</script>
<script src="js/x-ermsg.js"></script>
<?php include "../INC_FOOT.php"; ?> 