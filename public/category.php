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
		
		// specialty array
		$q4 = $db->prepare("SELECT DISTINCT `co` FROM `items` WHERE `az`>? AND `co`<>? AND `ca`=? ORDER BY `co`");
		$q4->execute(array(0,'',$s['cid']));
		$countries = $q4->fetchAll(PDO::FETCH_COLUMN);
 ?>
<title><?php echo !empty($s['mt']) ? $s['mt'] : $s['cn']; ?></title>
<meta name="description" content="<?php echo $s['md']; ?>">
<link href="css/x1-cards.css" rel="stylesheet">
<link href="css/x3-forms.css" rel="stylesheet">
<style>
<?php echo $s['uz']; ?>{color: #f14428; text-decoration: none;background: var(--color-3);}

#zp{text-align: center; width:500px;}
/* pagination */
.za1{    padding: 5px 8px;
    margin: 2px;
    background: #222;
    color: #ccc;
    text-decoration: none;}
.za3{background:transparent;}    
.za2{color: #444;}
#zn{margin:20px auto;}

@media screen and (max-width:1000px){
	h1{text-align: center;}
	.zp{text-align: center;}
}

@media screen and (max-width:560px){
	#x1d{position: relative;}	
	#x1d1{position: absolute;background: #111;z-index: 30;}
	#zn{text-align: center;}
}
</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
	<h1><?php echo $s['cn']; ?></h1>
	<p class="zp"><?php echo $s['cd']; ?></p>

    <div id="x1d2" style="width: 100%;display: flex;flex-direction: column;margin-top: 50px;">
			<div class="r">
				<?php
					
					$q0 = "SELECT * FROM `items` WHERE `ca`=? AND `az`=?";
					$a = array($s['cid'],1);
					// search start
						if(!empty($_GET['co'])){
							$q0.=" AND `co`=? ";
							array_push($a,$_GET['co']);
						}	

					// search end
					$ss = $db->prepare($q0);
					$ss->execute($a);
					$c = $ss->rowCount();
					$l = 24;
					isset($_GET['p']) && $_GET['p']>0 ? $p = $_GET['p'] : $p = 0;
					
					$r1=0;$r2=0;
					if($c>$l){
						$i = $p*$l;
						$r1 = $i;
						$q0.="ORDER BY `idz` DESC LIMIT ?,?";
						array_push($a,$i);
						array_push($a,$l);
						$ss = $db->prepare($q0);
						$ss->execute($a);
					}
					
					($r1+$l)<=$c ? $r2 = $r1+$l : $r2 = $c;
					
					$row = $ss->fetchAll();
					if(count($row)>0){
						foreach($row as $r){
						
					
				?>
                    <div class="z3d4">
                        <div class="z3d5"><img src="items/<?php echo $r['iz']; ?>" alt="<?php echo $r['na']; ?>" class="z3i1"></div>
                        <div class="z3d6">
                            <p class="z3p1"><?php echo $r['na']; ?></p>
                            <span class="z3s2">Rs.<?php echo $r['pr']; ?></span>
                            <span class="x1s4">
                                <a class="a2" href="item.php?c=<?php echo $r['uz']; ?>"><button class="x1bt x1bt1"><img src="css/view.svg" class="x1i100" alt=""></button></a>
                            </span>
                        </div>
                    </div>
				<?php
						}
					}else{
						echo "<p id='zp'>No Items Found</p>";					
					}					
				?>
			</div>
			<nav id="zn">
			<?php	
			if($c>$l){
				$l = ($c/$l);
				$prev = 0; 
				$post = 0; 
				for($i=0; $i<$l; $i++){
					if($prev==1){echo '<a href="#" class="za1 za3">&nbsp;...&nbsp;</a>'; $prev++;}
					if($post==1){echo '<a href="#" class="za1 za3">&nbsp;...&nbsp;</a>'; $post++;}
					if($l>11 && $i>4 && $i<$l-5 ){
						if($i<$p-5) { $prev++; continue;}
						if($i>$p+5) { $post++; continue;}
					}
					echo '<a href="'.preg_replace("/&p=(.*)/","",$_SERVER['REQUEST_URI']).(strpos($_SERVER['REQUEST_URI'],'?')>0 ?'&amp;' :'?').'p='.$i.'"';
					echo $p==$i ? ' class="za1 za2" ' : ' class="za1" ';
					echo '>'.($i+1).'</a>';
				} 
			}
			?>
		</nav>
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
_('zyco').onchange=function () {
	var v = this.value;
	var all = document.getElementsByClassName("x1d");
	var selected = document.querySelectorAll('[data-co="'+v+'"]');
	if(v=="All"){
		for (var e of all){
			e.style.display="block";		
		} 
	}else{
		for (var e of all){
			e.style.display="none";
		} 
		for (var e of selected){
			e.style.display="block";
		} 
	}
		
}
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

<?php  
	}else{
		echo "Page Not Found 404";
	}
include "INC_FOOT.php";	
?>