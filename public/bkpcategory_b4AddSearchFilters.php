<?php 
include "INC_SESS.php";
include "INC_HEAD.php";
if(!isset($_GET['c']) || empty($_GET['c'])) {
	header("Location:index.php");
	exit();
}

	$q = $db->prepare("SELECT * FROM `categories` WHERE `uz`=? AND `az`=?");
	$q->execute(array($_GET['c'],1));
	if($s = $q->fetch()){
 ?>
<title><?php echo !empty($s['mt']) ? $s['mt'] : $s['cn']; ?></title>
<meta name="description" content="<?php echo $s['md']; ?>">
<link href="css/x1-cards.css" rel="stylesheet">
<style>
#<?php echo $s['uz']; ?>{color: #f14428;  background:#222;}
.c321{width: auto;}
</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
	<h1><?php echo $s['cn']; ?></h1>
	<p class="zp"><?php echo $s['cd']; ?></p>
	
	<div id="x1d">
		<div id="x1d1">
			<button class="bt" id="x1bt"></button>
			<nav id="x1n">
				<span class="x1s0">All Categories</span>
				<?php
					$q3 = $db->prepare("SELECT * FROM `categories` WHERE `az`>?");
					$q3->execute(array(0));
					$catmenu = $q3->fetchAll();
					if(count($catmenu)>0){
						foreach($catmenu as $m){
							echo '<a href="category/',$m['uz'],'" class="x1a">',$m['cn'],'</a>';
						}
					}
				?>
				
				<!--<a href="" class="x1a">Italy</a>
				<a href="" class="x1a">Spain</a>
				<span class="x1s0">Sort By </span>
				<a href="" class="x1a">Price</a>
				<a href="" class="x1a">Name</a>
				<a href="" class="x1a">Type</a>-->
			</nav>
		</div>	
		<div id="x1d2">
			<div class="r">
				<?php
					$q2 = $db->prepare("SELECT * FROM `items` WHERE `ca`=? AND `az`=?");
					$q2->execute(array($s['cid'],1));
					$row = $q2->fetchAll();
					if(count($row)>0){
						foreach($row as $r){
						
					
				?>
				<div class="c321 x1d">
					<span class="x1s"><?php echo $r['na']; ?></span>
					<a class="a2" href="item/<?php echo $r['uz']; ?>"><img src="items/<?php echo $r['iz']; ?>" alt="<?php echo $r['na']; ?>" class="x1i"></a>
					<span class="x1s3">
						<span class="x1s4">£<?php echo $r['pr']; ?></span>
						<a class="a2" href="item/<?php echo $r['uz']; ?>"><button class="x1bt" id="x1bt1">View</button></a>
						<form action="shopping/index.php" method="post"><input type="hidden" name="item" value="<?php echo $r['idz']; ?>"><button class="x1bt" id="x1bt2" type="submit">Buy</button></form>
					</span>
				</div>
				<?php
						}
					}else{
						echo "No Items Found";						
					}					
				?>
			</div>
		</div>	
	</div>
</div>

<script>
function _(e) {return document.getElementById(e)}
_('x1bt').onclick=function() {
	var n = _('x1n').style.display;
	if(_('x1n').style.width=='0px'){
		_('x1n').style.width='228px';
		_('x1n').style.opacity='1';
		_('x1bt').style.backgroundPosition='-124px 0px';
	}else{
		_('x1n').style.width='0px';
		_('x1n').style.opacity='0';
		_('x1bt').style.backgroundPosition='-124px -22px';
	}
}
</script>
<?php  
	}else{
		echo "Page Not Found 404";
	}
include "INC_FOOT.php";	
?>