<?php 
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
//require '../phpmailer/src/SMTP.php';
require 'phpmailer/src/PHPMailer.php';
include "INC_SESS.php";	
$RESET = FALSE;
$ermsg = "";

if (isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LfG0NAUAAAAAMe4I9NRO-tM-eQrytt1Y3gYyrPo';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    if($recaptcha->score >= 0.5) {
       $q = $db->prepare("SELECT `fn`,`ez` FROM `users` WHERE `ez`=?");
			$q->execute(array($_POST['zyez']));
			if($q->rowCount()>0){
				$r = $q->fetch();
				
				// to delete previous request from database with this email
				$db->prepare("DELETE FROM `resetpassword` WHERE `ez`=?")->execute(array($_POST['zyez']));		
				
				//insert to db
				$key = date('Ymdhis').rand(1,999);
				$keyhash = password_hash($key,PASSWORD_DEFAULT);
				
				$ok = $db->prepare("INSERT INTO `resetpassword` (`kz`,`ez`) VALUES (?,?)")->execute(array($key,$_POST['zyez']));
				if($ok) {		
					/// email start
		       $mail = new PHPMailer(true);
			    try{
			    	 //Server settings
				   /*
				    $mail->SMTPDebug = SMTP::DEBUG_SERVER;  
				    $mail->isSMTP(); 
				    $mail->Host       = 'sv420.basdns.com'; 
				    $mail->SMTPAuth   = true;  
				    $mail->Username   = 'noreply@cellerswine.com'; 
				    $mail->Password   = 'pVrlAtpTR]rh'; 
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				    $mail->Port       = 587;
				    */
				    
			       // Recipients
				    $mail->setFrom('noreply@cellerswine.com', 'Cellerswine');
				    $mail->addAddress($r['ez'], $r['fn']); 
				    $mail->addReplyTo('cellers.wine@gmail.com', 'Cellerswine');
				    
			       $emailText = '<style type="text/css">body{background:#7b7b7b;font-family: "Nunito Sans", sans-serif;} @media screen and (max-width:680px){ #zt_wdg{width: 98% !important; }.za_wdg{display:block !important; margin-bottom:8px !important;}.zs_wdg{display:none !important;}}
@font-face {  font-family: "Nunito Sans";  font-style: normal;  font-weight: 400;  font-display: swap;  src: local("Nunito Sans Regular"), local("NunitoSans-Regular"), url(https://fonts.gstatic.com/s/nunitosans/v5/pe0qMImSLYBIv1o4X1M8cceyI9tScg.woff2) format("woff2");  unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;}@font-face {  font-family: "Nunito Sans";  font-style: normal;  font-weight: 400;  font-display: swap;  src: local("Nunito Sans Regular"), local("NunitoSans-Regular"), url(https://fonts.gstatic.com/s/nunitosans/v5/pe0qMImSLYBIv1o4X1M8ccezI9tScg.woff2) format("woff2");  unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;}@font-face {  font-family: "Nunito Sans";  font-style: normal;  font-weight: 400;  font-display: swap;  src: local("Nunito Sans Regular"), local("NunitoSans-Regular"), url(https://fonts.gstatic.com/s/nunitosans/v5/pe0qMImSLYBIv1o4X1M8cce9I9s.woff2) format("woff2");  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;}
</style><table id="zt_wdg" style="width:680px; margin: 10px auto; border-collapse: collapse; "><tr><td style="background:#252926; padding:10px; border-radius: 10px 10px 0 0"><img src="https://cellerswine.com/img/cellerswine-logo.svg" height="50" alt="WDG"><div style="float: right; font-family: \'Nunito Sans\'; color:#ffffff; font-weight:bold; padding:0 10px 0 10px; text-align:right; margin-top:16px;"><span style="color:#ccc; font-size:14px;">Reset Login Password</span></div></td></tr><tr><td style="text-align:center;background:#f1f1f1; font-family: \'Nunito Sans\';"><h1 style="margin:20px 0 0; color:#ff2a2a;">Hello '.ucwords($r['fn']).'</h1></td></tr><tr><td style="background:#f1f1f1; text-align:center;"><div style="text-align:left; padding:0 10px"><p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px;">This email is sent to you because you have requested to reset your account login password.</p><p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px;">Reset your password by clicking this button</p><a style="display:block; width:260px; margin:20px auto; text-align:center;background: #e07020;padding: 20px;border-radius: 5px;color: #fff;font-family: \'Nunito Sans\'; font-size:18px;text-decoration:none;text-transform:uppercase;" href="https://cellerswine.com/reset-password.php?key='.$keyhash.'&usr='.$r['ez'].'">Reset Password</a><p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px; font-size:15px;"><i>Note : If you did not make any password reset request and If you think someone else has entered your email in the password reset form, then ignore this email.</i></p><p style="font-family: \'Nunito Sans\';color:#444444; padding:0 10px; text-align:center; line-height:22px; margin-bottom:20px;">If you do not reset your password within 24 hours, this link will be expired.<br>Thank you for being with Cellerswine. <br>Have a great day</p></div></td></tr><tr><td style="background:#252926; padding:10px; border-radius:0 0 10px 10px"><p style="font-family: \'Nunito Sans\'; color:#f1f1f1;text-align:center;" >Contact Us</p><p style="font-family: \'Nunito Sans\'; color:#968f93; font-size:15px;text-align:center;">Email : <a href="mailto:cellers.wine@gmail.com" target="_blank" style="color:#ff2a2a;text-decoration:none" class="za_wdg">cellers.wine@gmail.com</a><span class="zs_wdg"> | </span>Facebook : <a href="https://www.facebook.com/cellerswines" target="_blank" style="color:#ff2a2a;text-decoration:none" class="za_wdg">cellerswines</a> <span class="zs_wdg"><br></span>Web : <a href="https://cellerswine.com/" target="_blank" style="color:#ff2a2a;text-decoration:none" class="za_wdg">cellerswine.com</a></p></td></tr></table>';
				    // Content
				    $mail->isHTML(true);
				    $mail->Subject = 'Cellerswine - Reset Login Password';
				    $mail->Body = $emailText;
				
				    $mail->send();
				} catch (Exception $e) {
				    $ermsg.= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}

		        /// email end
					header("Location:reset-password.php?ok=1");
				}
				
			}else $ermsg = "The email address you entered does not have an account";
    }else {
        // Not verified - show form error
    }

}elseif(isset($_GET['key']) && isset($_GET['usr'])){
	// link validation
		if(!empty($_GET['key']) && !empty($_GET['usr'])){
			$s1 = $db->prepare("SELECT `kz`,`dt` FROM `resetpassword` WHERE `ez`=?");
			$s1->execute(array($_GET['usr']));
				if($r = $s1->fetch()) {
					if(password_verify($r['kz'],$_GET['key'])){
						
						if(date('Y-m-d H:i:s',strtotime($r['dt']. ' + 1 day'))<date('Y-m-d H:i:s'))
							$ermsg = "Password reset link you used is expired";
						else{
							$RESET = TRUE;
							$_SESSION['tmp'] = $_GET['usr'];
							//remove from db
							$ok = $db->prepare("DELETE FROM `resetpassword` WHERE `ez`=?")->execute(array($_GET['usr']));
						}
					}else $ermsg = "Password reset link you used is invalid";
				}else $ermsg = "Password reset link you used is invalid or already used";
		}else $ermsg = "Password reset link you used is invalid";
	
}elseif(isset($_POST['zysent'])){
	$RESET = TRUE;
	if(empty($_POST['zyp1']) || empty($_POST['zyp2'])) $ermsg="Password cannot be empty";
	elseif($_POST['zyp1']!=$_POST['zyp2']) $ermsg="Passwords do not match";
	else{
		$ok = $db->prepare("UPDATE `users` SET `pw`= ? WHERE `ez`=?")->execute(array(password_hash($_POST['zyp1'],PASSWORD_DEFAULT),$_SESSION['tmp']));
		if($ok){
			unset($_SESSION['tmp']);
			header("Location:reset-password.php?ok=pw-reset");			
		}
	}
}
include "INC_HEAD.php"; 
?>
<link href="css/x2-item.css" rel="stylesheet">
<link href="css/x3-forms.css" rel="stylesheet">
<title>Reset Password</title>
<style>
.zf{width: 450px;}
@media screen and (max-width:750px){
	h1{text-align: center;margin: 30px 0 20px;}
	p{text-align: center;}
}

@media screen and (max-width:500px){
	.x3f{width: 80%;}

}
</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
<?php
	if(!empty($ermsg)) echo "<p class='x3ko'>",$ermsg,"</p>"; 
	if(isset($_GET['ok']) && $_GET['ok']==1) echo "<p class='x3ok'>We sent you a password reset link, Please check your mail inbox</p>";
	if(isset($_GET['ok']) && $_GET['ok']=='pw-reset') echo "<p class='x3ok'>Your password has been reset successfully.</p>";
?>
	<h1>Reset Password</h1>
	<p>Here You can reset your account password if you forget it. You will need to enter the Login email to get your password reset link</p>
	<?php if(!$RESET){ ?>
	<form class="x3f" autocomplete="off" method="post" action="reset-password.php">
		<label class="x3lb">
			<span class="x3s">Email</span>
			<div class="x3d">
				<input type="email" class="x3in" name="zyez" id="zyez" value="<?php echo $_POST['zyez'] ?? ''; ?>">
				<span class="x3s1" id="zyez0"></span>
			</div>	
		</label>
		<div class="x3lb">
			<div class="x3d">
				<input type="submit" class="x3in2" value="Reset Password">
				<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
			</div>				
		</div>
	</form>
	<?php }else{ ?>
	<form class="x3f" autocomplete="off" method="post" action="reset-password.php">
		<label class="x3lb">
			<span class="x3s">Enter New password</span>
			<div class="x3d">
				<input type="password" class="x3in" name="zyp1" id="zyp1" value="<?php echo $_POST['zyp1'] ?? ''; ?>">
				<span class="x3s1" id="zyp10"></span>
			</div>	
		</label>
		<label class="x3lb">
			<span class="x3s">Retype the New password</span>
			<div class="x3d">
				<input type="password" class="x3in" name="zyp2" id="zyp2" value="<?php echo $_POST['zyp2'] ?? ''; ?>">
				<span class="x3s1" id="zyp20"></span>
			</div>	
		</label>
		<div class="x3lb">
			<div class="x3d">
				<input type="submit" class="x3in2" value="Reset Password" name="zysent">
			</div>				
		</div>
	</form>
	<?php } ?>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=6LfG0NAUAAAAACHsNJd_ymy7cl4JVQEs4sMC8-NA"></script>
<script>
  grecaptcha.ready(function() {
	   grecaptcha.execute('6LfG0NAUAAAAACHsNJd_ymy7cl4JVQEs4sMC8-NA', { action: 'passwordReset' }).then(function (token){
	       var recaptchaResponse = document.getElementById('recaptchaResponse');
	       recaptchaResponse.value = token;
	   });
  });
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
<?php include "INC_FOOT.php"; 
?>