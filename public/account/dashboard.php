<?php 
include "../INC_SESS.php"; 
if(empty($_SESSION['uid'])) header("Location:index.php");
date_default_timezone_set("Europe/London");

include "../INC_HEAD.php"; 
?>
<link href="<?php echo BASE; ?>css/x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>css/x5-accounts.css" rel="stylesheet">
<title>User Account Dashboard</title>
<style>
 #x5a1{color: #fff; text-decoration: none;  background:#e31f1f;}
 .zi{width: 50px; display: block; margin:0 auto;transition:1s all;}
.zc{background:rgba(255,255,255,.2);
    width: 260px;
    padding: 20px;
    text-align: center;
    border-radius: 5px;}
.za{text-decoration: none; margin:20px;}
.za:hover .zi{transform:scale(1.5);}
</style>
<?php include "../INC_NAVI.php"; ?>
<div class="w">
	<?php include "INC_ACCMENU.php"; ?>
	<h1 class="e1 zh1">Dashboard</h1>
	<p class="e1">Hi, <?php echo $_SESSION['ufn']; ?><br>This is the dashboard where you see your order history and update your profile information.</p>
	<div class="r">
		<a href="account/history.php" class="za">
			<div class="c zc">
				<img src="img/categories.svg" alt="History" class="zi">
				<h2>Order History</h2>
				<p>See your order history</p>
			</div>
		</a>
		<a href="account/information.php" class="za">
			<div class="c zc">
				<img src="img/orders.svg" alt="Information" class="zi">
				<h2>Update Information</h2>
				<p>Manage your default details</p>
			</div>
		</a>
		<a href="account/settings.php" class="za">
			<div class="c zc">
				<img src="img/settings.svg" alt="Settings" class="zi">
				<h2>Settings</h2>
				<p>Update login details</p>
			</div>
		</a>
	</div>
</div>
<?php include "../INC_FOOT.php"; ?> 