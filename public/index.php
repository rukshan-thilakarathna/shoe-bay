<?php 
include "INC_SESS.php"; 
if(isset($_POST['age'])){
	$_SESSION['ageVerified'] = TRUE;
}
include "INC_HEAD.php"; 
?>
<title>Home page</title>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!--<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-theme.min.css" rel="stylesheet">
<script src="js/bootstrap.min.js"></script>-->
<link href="<?php echo BASE; ?>css/x1-cards.css" rel="stylesheet">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Fjalla+One&family=Pacifico&display=swap');

#a1{color: #f14428; text-decoration: none;background: var(--color-3);}
#bt5{background-position: -24px 0px;}
.x1s{height: 33px;}
/* boostrap issues */
#in1{line-height: 1}
body{margin:0;}
/* boostrap issues */
#zse1{width: 100%; min-height: 500px; background:linear-gradient(90deg,transparent,#000);}
#zse2{width: 100%; min-height: 300px; background:rgba(255,255,255,0.2); box-sizing:border-box; padding: 70px 0; text-align: center;}
#zse3{padding:50px 0;}
.zh2{font-size: 35px; font-weight: bold;color: var(--color-1); text-transform: uppercase;}
#zh2{margin: 60px auto 40px;}
.zs2{color: var(--color-3);}
.zd1{float: left; padding-top: 30px;}
.zd2{float: right; padding-top: 50px;}
.zd1,.zd2{box-sizing:border-box; width: 50%;}
.zh1{color: rgb(80, 78, 78); font-size: 40px; text-transform: uppercase; margin-bottom: 30px;}
.zp{font-size: 19px;}
.carousel-indicators li.active{background:var(--color-3);}
.carousel-indicators li{ border-radius: 20px; width: 20px;  height: 0;background:rgba(255,255,255,.2);}
#zh1{    font-weight: bold;
    font-size: 50px;
    font-family: var(--font1) text-transform: uppercase;
    color: var(--color-2);
    margin: 10px 0;
    border-bottom: 1px solid #ccc;
    display: inline-block;
}
.zs1{color: var(--color-3);}
.zp1{color:#fff; font-size: 18px; margin:0;}
#zp10{font-size: 18px; margin:0;font-family: var(--font1)}
.c21{
	background-position: center center;
	background-size: 100%;
	background-repeat: no-repeat;
	border-radius: 5px;
	margin:20px 1%;
	height: 250px;
}
.zc0{width: 50%; height: 100%; background:rgba(0,0,0,0.7); transition:1s all; display: flex; align-items: center; justify-content:center; border-radius: 5px; box-sizing:border-box; padding:20px;}
.zh3{font-size: 35px; font-weight: bold; color: #fff; text-transform: uppercase;}
.zc0:hover{width: 100%;}

#zd{position: fixed; width: 100%; background:rgba(0,0,0,0.9); text-align:center; z-index:1000; top:0; bottom:0; left:0; right:0; padding:20px; display: flex; flex-direction:column; justify-content:center; align-items: center;}
#h1{margin-top:100px;}
#zbt{background:linear-gradient(#00d638,#078c26); font-size: 22px; color: #fff;font-family: 'Cuprum', sans-serif; padding:10px 30px; border:0; width:250px; border-radius:10px; font-weight:bold; margin:30px;}


/*[[[!]]]*/
#rik-zssw {
    overflow: hidden;
    width: 100%;
    height: 600px;
}
.rik-zss {
    height: 600px;
    width: 20%;
    background-size: cover;
    float: left;
}
#rik-zss {
    width: 500%;
    position: relative;
    margin: 0;
    animation: anm1 20s infinite;
}
@keyframes anm1 {
    0%,10%{left: 0%;}
    20%,30%{left: -100%;}
    40%,50%{left: -200%;}
    60%,70%{left: -300%;}
    80%,90%{left: -400%;}
}

    .rikzd51 {
        text-align: left;
        margin-left: 80px;
    }

    .rikzd50 {
        display: flex;
        justify-content: start;
        margin: 50px 0 100px;
    }
    img.riki50 {
        width: 500px;
    }
    a.rika50 {    background: var(--color-2);
        padding: 5px 20px;
        margin-top: 24px;
        display: block;
        width: max-content;
        color: white;
    }

    @media screen and (max-width:650px){
	.zc0{width: 60%;height: 250px;}
}
@media screen and (max-width:600px){
	.zh2{text-align: center;}
	.zp1 , #zp10{text-align: center;}
	#zp10{text-align: center;}
	.zc0{height: 220px;width: 70%;}
}
@media screen and (max-width:380px){
	.zc0{height: 180px;width: 80%;}
	.zh3{font-size: 30px;}
	.zp1 , #zp10{font-size: 15px;}
}
</style>
<?php include "INC_NAVI.php"; ?>

<div id="rik-zssw">
    <figure id="rik-zss">
        <?php
        $p = $db->prepare("SELECT * FROM `slides-new` ORDER BY `id`");
        $p->execute();
        $res = $p->fetchAll();
        $counter = 0;

        foreach ($res as $r) {
            echo '<img src="slides/' . htmlspecialchars($r['image'], ENT_QUOTES, 'UTF-8') . '" alt="" class="rik-zss">';
            $counter++;
        }
        ?>
    </figure>
</div>



<section id="zse2">
	<div class="w">
        <div class="rikzd50">
            <img src="img/web/web-1.jpg" class="riki50">
            <div class="rikzd51">
                <h1 id="zh1"><span class="zs1">Welcome to </span> Shoe Bay</h1>
                <p id="zp10">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium? Quaerat accusamus qui vitae architecto nam officia nulla corporis quidem placeat laborum reiciendis possimus suscipit, ducimus similique distinctio vel eius eaque laudantium iure nobis? Voluptates a adipisci consequuntur molestiae laboriosam atque, praesentium dolorem commodi .</p>
                <a href="#" class="rika50">Show More</a>
            </div>
        </div>
		<h2 class="zh2" id="zh2">All Categories</h2>
		<div class="r">
			<?php
				$p = $db->prepare("SELECT * FROM `categories` WHERE `iz`<>? ORDER BY `cid` ASC ");
				$p->execute(['']);
				$res = $p->fetchAll();
				if(count($res)>0){
					foreach($res as $r){
			?>
			<div class="c21" style="background-image: url('img/categories/<?php echo $r['iz']; ?>');">
				<div class="zc0">
					<div>
						<h3 class="zh3"><?php echo $r['cn']; ?></h3>
						<p class="zp1"><?php echo substr($r['cd'],0,50); ?>..</p>
						<a href="category.php?c=<?php echo $r['uz']; ?>" class="a0 e2">All <?php echo $r['cn']; ?></a>
					</div>				
				</div>
			</div>
			<?php 
					}
				}
			?>
		</div>
	</div>
</section>

<section id="zse3">
<div class="w">
	<h2 class="zh2">Our <span class="zs2">Products</span></h2>
	<p class="zp1">Cellers of Western Road is a friendly, local off-license offering a large selection of beers, wines and spirits. </p>
	
	<div class="r">
		<?php
			$q2 = $db->prepare("SELECT * FROM `items` WHERE `az`=? ORDER BY RAND() DESC LIMIT ?");
			$q2->execute(array(1,8));
			$row = $q2->fetchAll();
			if(count($row)>0){
				foreach($row as $r){
				?>
				<div class="c321 x1d">
					<span class="x1s"><?php echo $r['na']; ?></span>
					<a class="a2" href="item/<?php echo $r['uz']; ?>"><img src="items/<?php echo $r['iz']; ?>" alt="<?php echo $r['na']; ?>" class="x1i"></a>
					<span class="x1s3">
						<span class="x1s4">£<?php echo $r['pr']; ?></span>
						<a class="a2" href="item/<?php echo $r['uz']; ?>"><button class="x1bt x1bt1">View</button></a>
						<a class="a2" href="shopping"><form action="shopping/index.php" method="post"><input type="hidden" name="item" value="<?php echo $r['idz']; ?>"><button class="x1bt x1bt2" type="submit">Buy</button></form></a>
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

<script>
function openNav() {
  document.getElementById("n1").style.width = "250px";
  document.getElementById("n1").style.display="block";
}

function closeNav() {
  document.getElementById("n1").style.width = "0";
}
</script>
<?php include "INC_FOOT.php"; ?>