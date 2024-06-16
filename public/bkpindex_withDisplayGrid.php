<?php 
include "INC_SESS.php"; 
include "INC_HEAD.php"; 
?>
<title>Sukee fashion</title>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>-->
<link href="css/x1-cards.css" rel="stylesheet">
<style>
#a1{color: #f14428; text-decoration: none;  background:#222;}
#bt5{background-position: -24px 0px;}
.x1s{height: 33px;}
/* boostrap issues */
#in1{line-height: 1}
body{background:linear-gradient(90deg,transparent,#000),url('img/home-bg.jpg') no-repeat center top #181817;background-size: 100%;margin:0;}
/* boostrap issues */
/*body{background:url('img/home-bg.jpg') no-repeat center top #181817;background-size: 100%;margin:0;}
#zse1{width: 100%; min-height: 500px; background:linear-gradient(90deg,transparent,#000);}*/
#zse2{width: 100%; min-height: 300px; background:rgba(255,255,255,0.2); box-sizing:border-box; padding: 70px 0; text-align: center;}
#zse3{padding:50px 0;}
.zh2{font-size: 35px; font-weight: bold; color: #fff; text-transform: uppercase;}
#zh2{margin: 60px auto 40px;}
.zs2{color: #d40000;}
.zd1{float: left; padding-top: 30px;}
.zd2{float: right; padding-top: 50px;}
.zd1,.zd2{box-sizing:border-box; width: 50%;}
.zh1{color: #fff; font-size: 40px; text-transform: uppercase; margin-bottom: 30px;}
.zp{color: #ccc; font-size: 19px;}
.carousel-indicators li.active{background:#f14428;}
.carousel-indicators li{ border-radius: 20px; width: 20px;  height: 0;background:rgba(255,255,255,.2);}
#zh1{font-size: 50px; text-transform: uppercase; text-align: center; color: #eee; margin:10px 0; border-bottom:1px solid #ccc; display: inline-block; padding:0 20px;}
.zs1{color: #111;}
.zp1{color: #ccc; font-size: 19px; margin-top: 20px;}
.zr{display: grid; grid-gap:50px;justify-content: center; grid-template-areas:
'g1 g1 g2 g2'
'g1 g1 g3 g3'
'g4 g5 g6 g7';
/*background:#222;*/
grid-gap:15px;
padding:10px;
grid-template-columns:1fr 1fr 1fr 1fr;
grid-template-rows:250px 250px 250px;
}
.zc1{grid-area:g1; background-image: url('img/wine.jpg');}
.zc2{grid-area:g2; background-image: url('img/champagne.jpg');}
.zc3{grid-area:g3; background-image: url('img/beer.jpg');}
.zc4{grid-area:g4; background-image: url('img/spirits.jpg');}
.zc5{grid-area:g5; background-image: url('img/miniatures.jpg');}
.zc6{grid-area:g6; background-image: url('img/craft-beer.jpg');}
.zc7{grid-area:g7; background-image: url('img/liquor.jpg');}
.zr > div{
	background-position: center center;
	background-size: cover;
	background-repeat: no-repeat;
	border-radius: 5px;
}
.zc0{width: 50%; height: 100%; background:rgba(0,0,0,0.7); transition:1s all; display: flex; align-items: center; justify-content:center; border-radius: 5px; box-sizing:border-box; padding:20px;}
.ze1{width: 75%;}
.zh3{font-size: 35px; font-weight: bold; color: #fff; text-transform: uppercase;}
.zc0:hover{width: 100%;}
/*.zr{text-align: center; overflow: hidden; margin: 20px auto;}
.zc{}
.zc1{}*/
</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
	<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
	  <ol class="carousel-indicators">
	    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
	    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
	  </ol>
	  <div class="carousel-inner">
<?php
	$p = $db->prepare("SELECT * FROM `slides` WHERE 1 ORDER BY `od`");
	$p->execute([]);
	$res = $p->fetchAll();
	$counter = 0;
	if(count($res)>0){
		foreach($res as $r){
?>
<div class="carousel-item <?php if($counter==0) echo 'active'; ?>">
 	<div class="zd1">
 		<img src="slides/<?php echo $r['iz']; ?>" alt="" class="zi1">
 	</div>
 	<div class="zd2">
		<h1 class="zh1"><?php echo $r['hd']; ?></h1>
		<p class="zp"><?php echo $r['p1']; ?></p>	
		<p class="zp"><?php echo $r['p2']; ?></p>
		<?php
			if(!empty($r['btxt']) && !empty($r['burl'])){
				echo '<a href="',$r['burl'],'" class="a0 e2">',$r['btxt'],'</a>';			
			}
		?>
 	</div>
 </div>
<?php			
		$counter++;
		}
	}
?>	  

	  </div>
	  <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	    <span class="sr-only">Previous</span>
	  </a>
	  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
	    <span class="sr-only">Next</span>
	  </a>-->
	</div>
</div>
<section id="zse2">
	<div class="w">
		<h1 id="zh1"><span class="zs1">Welcome to </span> Cellers Wine</h1>
		<p class="zp1">Cellers of Western Road is a friendly, local off-license offering a large selection of beers, wines and spirits. We can source a large variety of alcohol. Cellers of Western Road is a friendly, local off-license offering a large selection of beers, wines and spirits. We can source a large variety of alcohol so please get in touch today & we will be happy to help!</p>
		<h2 class="zh2" id="zh2">All Categories</h2>
		<div class="zr">
			<div class="zc1">
				<div class="zc0">
					<div>
						<h3 class="zh3">Red Wine</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/red-wine" class="a0 e2">All Wine</a>				
					</div>				
				</div>
			</div>
			<div class="zc2">
				<div class="zc0">
					<div>
						<h3 class="zh3">Champagne</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/champagne" class="a0 e2">All Champagne</a>				
					</div>					
				</div>
			</div>
			<div class="zc3">
				<div class="zc0">
					<div>
						<h3 class="zh3">Beer</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/beer" class="a0 e2">All Beer</a>				
					</div>				
				</div>
			</div>
			<div class="zc4">
				<div class="zc0 ze1">
					<div>
						<h3 class="zh3">Spirits</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/spirits" class="a0 e2">All Spirits</a>				
					</div>				
				</div>
			</div>
			<div class="zc5">
				<div class="zc0 ze1">
					<div>
						<h3 class="zh3">Miniatures</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/miniatures" class="a0 e2">All Miniatures</a>				
					</div>				
				</div>
			</div>
			<div class="zc6">
				<div class="zc0 ze1">
					<div>
						<h3 class="zh3">Craft Beer</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/craft-beer" class="a0 e2">All Craft Beer</a>				
					</div>			
				</div>
			</div>
			<div class="zc7">
				<div class="zc0 ze1">
					<div>
						<h3 class="zh3">Liqueurs</h3>
						<p class="zp1">Tempus pede. Ac ipsum ve ligula cras</p>
						<a href="category/liqueurs-mixers" class="a0 e2">All Liqueurs</a>				
					</div>				
				</div>
			</div>
		</div>
	</div>
</section>
<section id="zse3">
<div class="w">
	<h2 class="zh2">Our <span class="zs2">Products</span></h2>
	<p class="zp1">Porem ipsum dolor sit. Natoque sollicitudin ultricies sapien porttitor faucibus. Commodo ornare.  Auctor. Cursus nulla imperdiet ac</p>
	
	<div class="r">
		<?php
			$q2 = $db->prepare("SELECT * FROM `items` WHERE `az`=? ORDER BY RAND() DESC LIMIT ?");
			$q2->execute(array(1,6));
			$row = $q2->fetchAll();
			if(count($row)>0){
				foreach($row as $r){
				?>
				<div class="c321 x1d">
					<span class="x1s"><?php echo $r['na']; ?><span class="x1s2"><?php echo $r['vo']; ?> / <?php echo $r['pe']; ?></span></span>
					<img src="items/<?php echo $r['iz']; ?>" alt="<?php echo $r['na']; ?>" class="x1i">
					<span class="x1s3">
						<span class="x1s4">£<?php echo $r['pr']; ?></span>
						<a class="a2" href="item/<?php echo $r['uz']; ?>"><button class="x1bt" id="x1bt1">View</button></a>
						<a class="a2" href="shopping"><form action="shopping/index.php" method="post"><input type="hidden" name="item" value="<?php echo $r['idz']; ?>"><button class="x1bt" id="x1bt2" type="submit">Buy</button></form></a>
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
</section>
<?php include "INC_FOOT.php"; ?>