<?php 
include "../INC_SESS.php"; 
$err = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);
date_default_timezone_set("Europe/London");
if(empty($_SESSION['cart'])) header("Location:index.php");
elseif(empty($_SESSION['ez'])) header("Location:user.php");
function SE_optionsGen($array,$selected,$start=0,$end=0) {
	$end = $end==0 ? count($array)-1 : $end;
	$out = "";
	$selected = intval($selected);
	for($i=$start;$i<=$end;$i++){
		$out.= '<option value="'.$i.'"';
		$out.= $selected==$i ? ' selected ' : '' ;
		$out.= '>'.$array[$i].'</option>';
	}
	return $out;
}
	$arr_state = array('','Avon', 'Bedfordshire', 'Berkshire', 'Bristol, City of', 'Buckinghamshire', 'Cambridgeshire', 'Cheshire', 'Cleveland', 'Cornwall', 'Cumbria', 'Derbyshire', 'Devon', 'Dorset', 'Durham', 'East Sussex', 'Essex', 'Gloucestershire', 'Greater London', 'Greater Manchester', 'Hampshire (County of Southampton)', 'Hereford and Worcester', 'Herefordshire', 'Hertfordshire', 'Isle of Wight', 'Kent', 'Lancashire', 'Leicestershire', 'Lincolnshire', 'London', 'Merseyside', 'Middlesex', 'Norfolk', 'Northamptonshire', 'Northumberland', 'North Humberside', 'North Yorkshire', 'Nottinghamshire', 'Oxfordshire', 'Rutland', 'Shropshire', 'Somerset', 'South Humberside', 'South Yorkshire', 'Staffordshire', 'Suffolk', 'Surrey', 'Tyne and Wear', 'Warwickshire', 'West Midlands', 'West Sussex', 'West Yorkshire', 'Wiltshire', 'Worcestershire', 'Antrim', 'Armagh', 'Belfast, City of', 'Down', 'Fermanagh', 'Londonderry', 'Derry, City of', 'Tyrone', 'Aberdeen, City of', 'Aberdeenshire', 'Angus (Forfarshire)', 'Argyll', 'Ayrshire', 'Banffshire', 'Berwickshire', 'Bute', 'Caithness', 'Clackmannanshire', 'Cromartyshire', 'Dumfriesshire', 'Dunbartonshire (Dumbarton)', 'Dundee, City of', 'East Lothian (Haddingtonshire)', 'Edinburgh, City of', 'Fife', 'Glasgow, City of', 'Inverness-shire', 'Kincardineshire', 'Kinross-shire', 'Kirkcudbrightshire', 'Lanarkshire', 'Midlothian (County of Edinburgh)', 'Moray (Elginshire)', 'Nairnshire', 'Orkney', 'Peeblesshire', 'Perthshire', 'Renfrewshire', 'Ross and Cromarty', 'Ross-shire', 'Roxburghshire', 'Selkirkshire', 'Shetland (Zetland)', 'Stirlingshire', 'Sutherland', 'West Lothian (Linlithgowshire)', 'Wigtownshire', 'Clwyd', 'Dyfed', 'Gwent', 'Gwynedd', 'Mid Glamorgan', 'Powys', 'South Glamorgan', 'West Glamorgan');

if(!isset($_SESSION['bfn'])) $_SESSION['bfn']="";
if(!isset($_SESSION['bln'])) $_SESSION['bln']="";
if(!isset($_SESSION['bad1'])) $_SESSION['bad1']="";
if(!isset($_SESSION['bad2'])) $_SESSION['bad2']="";
if(!isset($_SESSION['bad3'])) $_SESSION['bad3']="";
if(!isset($_SESSION['bct'])) $_SESSION['bct']="";
if(!isset($_SESSION['bst'])) $_SESSION['bst']="";
if(!isset($_SESSION['bzp'])) $_SESSION['bzp']="";
if(!isset($_SESSION['bpz'])) $_SESSION['bpz']="";
if(!isset($_SESSION['bem'])) $_SESSION['bem']="";
if(!isset($_SESSION['sfn'])) $_SESSION['sfn']="";
if(!isset($_SESSION['sln'])) $_SESSION['sln']="";
if(!isset($_SESSION['sad1'])) $_SESSION['sad1']="";
if(!isset($_SESSION['sad2'])) $_SESSION['sad2']="";
if(!isset($_SESSION['sad3'])) $_SESSION['sad3']="";
if(!isset($_SESSION['sct'])) $_SESSION['sct']="";
if(!isset($_SESSION['sst'])) $_SESSION['sst']="";
if(!isset($_SESSION['szp'])) $_SESSION['szp']="";
if(!isset($_SESSION['spz'])) $_SESSION['spz']="";
if(!isset($_SESSION['sem'])) $_SESSION['sem']="";

if(isset($_POST['zybfn'])){
	/*
		0 - empty billing first name 
		1 - empty billing last name 
		2 - empty billing address
		3 - empty billing city
		4 - empty billing state
		5 - empty billing zip code
		6 - empty billing phone number
		7 - empty billing email address
		<title>Customer Information</title>

		8 - empty shipping first name 
		9 - empty shipping last name 
		10 - empty shipping address
		11 - empty shipping city
		12 - empty shipping state
		13 - empty shipping zip code
		14 - empty shipping phone number
		15 - empty shipping email address
		
		16 - invalid billing email
		17 - invalid shipping email
	*/
	$err[0] = empty($_POST['zybfn']) ? TRUE : FALSE;
	$err[1] = empty($_POST['zybln']) ? TRUE : FALSE;
	$err[2] = empty($_POST['zybad1']) ? TRUE : FALSE;
	$err[3] = empty($_POST['zybct']) ? TRUE : FALSE;
	$err[4] = empty($_POST['zybst']) ? TRUE : FALSE;
	$err[5] = empty($_POST['zybzp']) ? TRUE : FALSE;
	$err[6] = empty($_POST['zybpz']) ? TRUE : FALSE;
	$err[7] = empty($_POST['zybem']) ? TRUE : FALSE;
	
	$err[8] = empty($_POST['zysfn']) ? TRUE : FALSE;
	$err[9] = empty($_POST['zysln']) ? TRUE : FALSE;
	$err[10] = empty($_POST['zysad1']) ? TRUE : FALSE;
	$err[11] = empty($_POST['zysct']) ? TRUE : FALSE;
	$err[12] = empty($_POST['zysst']) ? TRUE : FALSE;
	$err[13] = empty($_POST['zyszp']) ? TRUE : FALSE;
	$err[14] = empty($_POST['zyspz']) ? TRUE : FALSE;
	$err[15] = empty($_POST['zysem']) ? TRUE : FALSE;
	
	// invalid billing email
	$_POST['zybem'] = strtolower($_POST['zybem']);
	$_POST['zybem'] = filter_var($_POST['zybem'], FILTER_SANITIZE_EMAIL);
	if(empty($_POST['zybem']) || !filter_var($_POST['zybem'],FILTER_VALIDATE_EMAIL)) $err[16]=TRUE;
	
	// invalid shipping email
	$_POST['zysem'] = strtolower($_POST['zysem']);
	$_POST['zysem'] = filter_var($_POST['zysem'], FILTER_SANITIZE_EMAIL);
	if(empty($_POST['zysem']) || !filter_var($_POST['zysem'],FILTER_VALIDATE_EMAIL)) $err[17]=TRUE;
	 
	//check whether user exist or not
	if(!in_array(TRUE, $err)){
		
		$_SESSION['bfn'] = $_POST['zybfn'];
		$_SESSION['bln'] = $_POST['zybln'];
		$_SESSION['bad1'] = $_POST['zybad1'];
		$_SESSION['bad2'] = $_POST['zybad2'];
		$_SESSION['bad3'] = $_POST['zybad3'];
		$_SESSION['bct'] = $_POST['zybct'];
		$_SESSION['bst'] = $_POST['zybst'];
		$_SESSION['bzp'] = $_POST['zybzp'];
		$_SESSION['bpz'] = $_POST['zybpz'];
		$_SESSION['bem'] = $_POST['zybem'];
		$_SESSION['sfn'] = $_POST['zysfn'];
		$_SESSION['sln'] = $_POST['zysln'];
		$_SESSION['sad1'] = $_POST['zysad1'];
		$_SESSION['sad2'] = $_POST['zysad2'];
		$_SESSION['sad3'] = $_POST['zysad3'];
		$_SESSION['sct'] = $_POST['zysct'];
		$_SESSION['sst'] = $_POST['zysst'];
		$_SESSION['szp'] = $_POST['zyszp'];
		$_SESSION['spz'] = $_POST['zyspz'];
		$_SESSION['sem'] = $_POST['zysem'];
		header("Location:payment.php");
	}
}
$zyst = $_SESSION['bst'];
include "../INC_HEAD.php"; ?>
<title>Billing - Shipping details</title>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x4-shopping.css" rel="stylesheet">
<style>
#zd{width:100%; box-sizing:border-box; display:flex;flex-wrap:wrap;}
.zd1,.zd2{width: 45%;box-sizing:border-box; margin:20px 30px; }
.zd1{float: left; border-right:1px solid rgba(255,255,255,.2);}
.zd2{float: right;}
.zf{display: block; width: 80%; margin:20px auto;}
#zp{float: right; margin-top:-85px;}
h2{border-bottom:1px solid rgba(255,255,255,.2); padding-bottom: 20px; margin-bottom: 40px;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w" id="zy1">
	<div id="x4d">
		<a class="x4a x4e" href="shopping/">Shopping Cart</a>
		<a class="x4a x4e" href="shopping/user.php">User Information</a>
		<a class="x4a x4e" href="shopping/billing.php">Billing / Shipping Details</a>
		<a class="x4a" href="<?php echo !empty($_SESSION['bem']) ? 'shopping/payment.php' : 'javascript:;'; ?>">Payments</a>
	</div>
	<h1>Billing/Shipping Information</h1>
	<p>Please update your billing and shipping information</p>
	<div id="zd">
		<div class="zd1">
			<form class="zf" autocomplete="off" method="post" action="shopping/billing.php">
			<h2>Billing Informaton</h2>
				<label class="x3lb">
					<span class="x3s">First Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybfn" id="zybfn" value="<?php echo $_POST['zybfn'] ?? $_SESSION['bfn']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Last Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybln" id="zybln" value="<?php echo $_POST['zybln'] ?? $_SESSION['bln']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 1</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybad1" id="zybad1" value="<?php echo $_POST['zybad1'] ?? $_SESSION['bad1']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 2</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybad2" id="zybad2" value="<?php echo $_POST['zybad2'] ?? $_SESSION['bad2']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 3</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybad3" id="zybad3" value="<?php echo $_POST['zybad3'] ?? $_SESSION['bad3']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">City</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybct" id="zybct" value="<?php echo $_POST['zybct'] ?? $_SESSION['bct']; ?>">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">State</span>
					<div class="x3d">
						<select  class="x3in" name="zybst" id="zybst">
							<?php echo SE_optionsGen($arr_state, $zyst); ?>						
						</select>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Zip/Postal Code</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybzp" id="zybzp" value="<?php echo $_POST['zybzp'] ?? $_SESSION['bzp']; ?>">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Phone Number</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybpz" id="zybpz" value="<?php echo $_POST['zybpz'] ?? $_SESSION['bpz']; ?>">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Email address</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zybem" id="zybem" value="<?php echo $_POST['zybem'] ?? $_SESSION['bem']; ?>">
					</div>	
				</label>
		</div>
		<div class="zd2">
			<h2>Shipping Informaton</h2>
			<p id="zp"><input type="checkbox" id="zycheck"> Same as Billing details.</p>
				<label class="x3lb">
					<span class="x3s">First Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysfn" id="zysfn" value="<?php echo $_POST['zysfn'] ?? $_SESSION['sfn']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Last Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysln" id="zysln" value="<?php echo $_POST['zysln'] ?? $_SESSION['sln']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 1</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysad1" id="zysad1" value="<?php echo $_POST['zysad1'] ?? $_SESSION['sad1']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 2</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysad2" id="zysad2" value="<?php echo $_POST['zysad2'] ?? $_SESSION['sad2']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 3</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysad3" id="zysad3" value="<?php echo $_POST['zysad3'] ?? $_SESSION['sad3']; ?>">
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">City</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysct" id="zysct" value="<?php echo $_POST['zysct'] ?? $_SESSION['sct']; ?>">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">State</span>
					<div class="x3d">
						<select  class="x3in" name="zysst" id="zysst">
							<?php echo SE_optionsGen($arr_state, $zyst); ?>						
						</select>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Zip/Postal Code</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyszp" id="zyszp" value="<?php echo $_POST['zyszp'] ?? $_SESSION['szp']; ?>">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Phone Number</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyspz" id="zyspz" value="<?php echo $_POST['zyspz'] ?? $_SESSION['spz']; ?>">
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Email address</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zysem" id="zysem" value="<?php echo $_POST['zysem'] ?? $_SESSION['sem']; ?>">
					</div>	
				</label>
				<div>
					<button type="submit" class="x4e x4bt2">Continue</button>				
				</div>
			</form>
		</div>
	</div>
</div>
<?php include "../INC_ERRMSG.php"; ?>
<script>
<?php
	if(!empty($_POST['zybst'])) echo "_('zybst').value=",$_POST['zybst'],";";	
	if(!empty($_POST['zysst'])) echo "_('zysst').value=",$_POST['zysst'],";";	
?>
// billing same as shipping
_('zycheck').oninput=function () {
	if(_('zycheck').checked==true){
		_('zysfn').value = _('zybfn').value;
		_('zysln').value = _('zybln').value;
		_('zysad1').value = _('zybad1').value;
		_('zysad2').value = _('zybad2').value;
		_('zysad3').value = _('zybad3').value;
		_('zysct').value = _('zybct').value;
		_('zysst').value = _('zybst').value;
		_('zyszp').value = _('zybzp').value;
		_('zyspz').value = _('zybpz').value;
		_('zysem').value = _('zybem').value;
	}else{
		_('zysfn').value = "";
		_('zysln').value = "";
		_('zysad1').value = "";
		_('zysad2').value = "";
		_('zysad3').value = "";
		_('zysct').value = "";
		_('zysst').value = "";
		_('zyszp').value = "";
		_('zyspz').value = "";
		_('zysem').value = "";
	}
}
// configurations
var SE_modal = {
	err:{
		"e0":['zybfn','First Name is empty'],
		"e1":['zybln','Last Name is empty'],
		"e2":['zybad1','Address is empty'],
		"e3":['zybct','City is empty'],
		"e4":['zybst','State is empty'],
		"e5":['zybzp','Zipcode is empty'],
		"e6":['zybpz','Phone number is empty'],
		"e7":['zybem','Email is empty'],
		"e16":['zybem','Email is invalid'],
		"e8":['zysfn','First Name is empty'],
		"e9":['zysln','Last Name is empty'],
		"e10":['zysad1','Address is empty'],
		"e11":['zysct','City is empty'],
		"e12":['zysst','State is empty'],
		"e13":['zyszp','Zipcode is empty'],
		"e14":['zyspz','Phone number is empty'],
		"e15":['zysem','Email is empty'],
		"e17":['zysem','Email is invalid']
	}
}
</script>
<script src="js/x-ermsg.js"></script>
<?php include "../INC_FOOT.php"; ?> 