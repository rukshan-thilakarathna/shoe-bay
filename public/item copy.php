<?php 
include "INC_SESS.php";
if(!isset($_GET['c']) || empty($_GET['c'])) {
	header("Location:index.php");
	exit();
}
	$sc = $db->prepare("SELECT `cid`, `cn` FROM `categories` WHERE `az`=?");
	$sc->execute([1]);
	$cat = $sc->fetchAll();
	$arr_cat = array();
	foreach($cat as $rc){
		$arr_cat[$rc['cid']]=$rc['cn'];
	}
	
	$arr_status = array('N/A','Available','Out of stock');
	
	$q = $db->prepare("SELECT * FROM `items` WHERE `uz`=? AND `az`>?");
	$q->execute(array($_GET['c'],0));
	if($s = $q->fetch()){
		
include "INC_HEAD.php"; ?>
<link href="css/x2-item.css?sfs" rel="stylesheet">
<title><?php echo $s['mt']; ?></title>
<meta name="description" content="<?php echo $s['md']; ?>">
<style>
#<?php echo $s['uz']; ?>{color: #f14428;  background:#222;}
#zin{height:24px; width: 40px; text-align: center;}

@media screen and (max-width:1000px){
	.x2s1{width: 40%;}

}

@media screen and (max-width:800px){
	.x2s1{width: 50%;}
	h1{text-align: center;}

}

@media screen and (max-width:700px){
	#x2d{
		display: flex;
		flex-wrap:wrap;
		justify-content:center;	
	}
	#x2d1{
		border:none;	
	}

}

@media screen and (max-width:380px){
	#x2i{width: 250px;}
	#x2d1{padding: 20px 20px;}

}

</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
	
	
	<div id="x2d">
		<div id="x2d1">
			<img src="items/<?php echo $s['iz']; ?>" alt="<?php echo $s['na']; ?>" id="x2i">
		</div>	
		<div id="x2d2">
			<h1><?php echo $s['na']; ?></h1>
			<p class="zp"><?php echo $s['ab']; ?></p>
			<ul class="x2ul">
				<?php 
					if(!empty($s['co'])) echo '<li class="x2li"><span class="x2s1">Specialty</span><span class="x2s2">',$s['co'],'</span></li>	';
					if(!empty($s['cd'])) echo '<li class="x2li"><span class="x2s1">Code</span><span class="x2s2">',$s['cd'],'</span></li>	';
					if(!empty($s['br'])) echo '<li class="x2li"><span class="x2s1">Brand</span><span class="x2s2">',$s['br'],'</span></li>	'; 
					if(!empty($s['vo'])) echo '<li class="x2li"><span class="x2s1">Volume</span><span class="x2s2">',$s['vo'],'</span></li>	'; 
					if(!empty($s['pe'])) echo '<li class="x2li"><span class="x2s1">Percentage</span><span class="x2s2">',$s['pe'],'</span></li>	'; 
					if(!empty($s['ca'])) echo '<li class="x2li"><span class="x2s1">Category</span><span class="x2s2">',$arr_cat[$s['ca']],'</span></li>	'; 
					if(!empty($s['pr'])) echo '<li class="x2li"><span class="x2s1">Price</span><span class="x2s2">£',$s['pr'],'</span></li>	'; 
					echo '<li class="x2li"><span class="x2s1">Status</span><span class="x2s2">',$arr_status[$s['az']],'</span></li>	'; 
				?>
				<li class="x2li">
					<form action="shopping/index.php" method="post"><input type="hidden" name="item" value="<?php echo $s['idz']; ?>"><!--<button class="x1bt" id="x1bt2" type="submit">Buy</button>-->
					<input type="number" class="x2sl" placeholder="quantity" name="qty" value="1" id="zin" min="1" step="1">
					<button class="a0 e2" type="submit">Add to Cart</button>
					</form>
				</li>
			</ul>
		</div>	
	</div>
	<!--<div id="x2d3">
		<h2>You may also like</h2>
		<p>Purus, nunc snim cum nisi. Purus, nunc sed augue metus, a, aliquet litora, fusce, et dis. Eros vulputate id, neque nam odio nec</p>
		<div class="r">
				<div class="c421 x2d">
					<a href="item.php" class="x2a">
						<span class="x2s3">Natoque Sollicidudin</span>
							<img src="img/item-01.jpg" alt="" class="x2i">
							<span class="x2s4">
								<span class="x2s5">70cl / 45%</span>
								<span class="x2s6">£69.64</span>
						</span>					
					</a>
				</div>
				<div class="c421 x2d">
					<a href="item.php" class="x2a">
						<span class="x2s3">Natoque Sollicidudin</span>
							<img src="img/item-01.jpg" alt="" class="x2i">
							<span class="x2s4">
								<span class="x2s5">70cl / 45%</span>
								<span class="x2s6">£69.64</span>
						</span>					
					</a>
				</div>
				<div class="c421 x2d">
					<a href="item.php" class="x2a">
						<span class="x2s3">Natoque Sollicidudin</span>
							<img src="img/item-01.jpg" alt="" class="x2i">
							<span class="x2s4">
								<span class="x2s5">70cl / 45%</span>
								<span class="x2s6">£69.64</span>
						</span>					
					</a>
				</div>
				<div class="c421 x2d">
					<a href="item.php" class="x2a">
						<span class="x2s3">Natoque Sollicidudin</span>
							<img src="img/item-01.jpg" alt="" class="x2i">
							<span class="x2s4">
								<span class="x2s5">70cl / 45%</span>
								<span class="x2s6">£69.64</span>
						</span>					
					</a>
				</div>
		</div>
	</div>-->
</div>
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
	}else{
		echo "Page Not Found 404";
	}
?>