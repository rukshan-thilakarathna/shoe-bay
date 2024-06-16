<?php 
include "../INC_SESS.php"; 
if(empty($_SESSION['uid'])) header("Location:index.php");
date_default_timezone_set("Europe/London");
$err = array(FALSE, FALSE, FALSE, FALSE);
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

if(isset($_POST['zysent'])){
	/*
		/*
		0 - empty first name 
		1 - invalid email
		2 - email is already exists
		3 - empty last name
	*/
	$err[0] = empty($_POST['zyfn']) ? TRUE : FALSE;
	$err[3] = empty($_POST['zyln']) ? TRUE : FALSE;
	
	// invalid login emailA
	$_POST['zyem'] = strtolower($_POST['zyem']);
	$_POST['zyem'] = filter_var($_POST['zyem'], FILTER_SANITIZE_EMAIL);
	if(empty($_POST['zyem']) || !filter_var($_POST['zyem'],FILTER_VALIDATE_EMAIL)) $err[1]=TRUE;
	 
	//check whether user exist or not
	if(!in_array(TRUE, $err)){
		$usrExist = $db->prepare("SELECT `uid` FROM `users` WHERE `ez`=? AND `uid`<>?");
		$usrExist->execute(array($_POST['zyem'],$_SESSION['uid']));
		if($usrExist->rowCount()>0) $err[2] = TRUE;
		else{
			$ok = $db->prepare("UPDATE `users` SET `fn`=?, `ln`=?, `pz`=?, `ez`=?, `zp`=?, `ct`=?, `st`=?, `ad1`=?, `ad2`=?, `ad3`=? WHERE `uid`=?")->execute([$_POST['zyfn'], $_POST['zyln'], $_POST['zypz'], $_POST['zyem'], $_POST['zyzp'], $_POST['zyct'], $_POST['zyst'], $_POST['zyad1'], $_POST['zyad2'], $_POST['zyad3'],$_SESSION['uid']]);
			$_SESSION['ufn']=$_POST['zyfn'];
			header("Location:information.php?done=1");
		}
	}
}
include "../INC_HEAD.php";
?>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x5-accounts.css" rel="stylesheet">
<title>Profile Information</title>
<style>
 #x5a3{color: #fff; text-decoration: none;  background:#e31f1f;}
 #zd{margin:30px auto; width: 500px;}
 .x3ok{text-align: center;}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<?php include "INC_ACCMENU.php"; 
	 if(isset($_GET['done'])) echo '<div class="x3ok">Profile is updated successfully.</div>';	
	?>
	<h1 class="e1">Profile Information</h1>
	<p class="e1">Here you will update your profile information.</p>
	<div id="zd">
		<?php
			$q = $db->prepare("SELECT `fn`,`ln`,`ez`,`ad1`,`ad2`,`ad3`,`pz`,`zp`,`ct`,`st` FROM `users` WHERE `uid`=?");
			$q->execute([$_SESSION['uid']]);

			if($r = $q->fetch()) {
				if(!empty($_POST['zyst'])) $zyst = $_POST['zyst'];
				else $zyst = $r['st'];
		?>
			<form class="zf" autocomplete="off" method="post" action="account/information.php">
				<label class="x3lb">
					<span class="x3s">First Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyfn" id="zyfn" value="<?php echo $_POST['zyfn'] ?? $r['fn']; ?>">
						<span class="x3s1" id="zyfn0"></span>
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Last Name</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyln" id="zyln" value="<?php echo $_POST['zyln'] ?? $r['ln']; ?>">
						<span class="x3s1" id="zyln0"></span>
					</div>
				</label>
				<label class="x3lb">
					<span class="x3s">Phone Number</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zypz" id="zypz" value="<?php echo $_POST['zypz'] ?? $r['pz']; ?>">
						<span class="x3s1" id="zypz0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Email address</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyem" id="zyem" value="<?php echo $_POST['zyem'] ?? $r['ez']; ?>">
						<span class="x3s1" id="zyem0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 1</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyad1" id="zyad1" value="<?php echo $_POST['zyad1'] ?? $r['ad1']; ?>">
						<span class="x3s1" id="zyad0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 2</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyad2" id="zyad2" value="<?php echo $_POST['zyad2'] ?? $r['ad2']; ?>">
						<span class="x3s1" id="zyad0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Address Line 3</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyad3" id="zyad3" value="<?php echo $_POST['zyad3'] ?? $r['ad3']; ?>">
						<span class="x3s1" id="zyad0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">City</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyct" id="zyct" value="<?php echo $_POST['zyct'] ?? $r['ct']; ?>">
						<span class="x3s1" id="zyct0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">State</span>
					<div class="x3d">
						<select  class="x3in" name="zyst" id="zyst">
							<?php echo SE_optionsGen($arr_state, $zyst); ?>
						</select>
						<span class="x3s1" id="zyst0"></span>
					</div>	
				</label>
				<label class="x3lb">
					<span class="x3s">Zip/Postal Code</span>
					<div class="x3d">
						<input type="text" class="x3in" name="zyzp" id="zyzp" value="<?php echo $_POST['zyzp'] ?? $r['zp']; ?>">
						<span class="x3s1" id="zyzp0"></span>
					</div>	
				</label>
				<div class="x3lb">
					<div class="x3d">
						<input type="submit" class="x3in2" value="Update" name="zysent">
					</div>
				</div>
			</form>
			<?php
				if(!empty($_POST['zyst'])) echo "<script>_('zyst').value=",$_POST['zyst'],";</script>";
				else echo "<script>_('zyst').value=",$r['st'],";</script>";
			}else echo 'Something is wrong. Please report to site admin. Error code 1478';
		?>
		</div>
	
</div>
<?php include "../INC_ERRMSG.php"; ?>
<script>
// configurations
var SE_modal = {
	err:{
		"e0":['zyfn','First Name is empty'],
		"e3":['zyln','Last Name is empty'],
		"e1":['zyem','Invalid Email Address'],
		"e2":['zyem','The email has been taken by another account']
	}
}
</script>
<script src="js/x-ermsg.js"></script>
<?php include "../INC_FOOT.php"; ?> 