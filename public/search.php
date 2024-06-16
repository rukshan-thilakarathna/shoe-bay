<?php 
include "INC_SESS.php";
include "INC_HEAD.php";
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

$q3 = $db->prepare("SELECT * FROM `categories` WHERE `az`>?");
$q3->execute(array(0));
$cat = $q3->fetchAll();
$arr_cat = array();
foreach($cat as $rc){
	$arr_cat[$rc['cid']]=$rc['cn'];
}

// specialty array
$q4 = $db->prepare("SELECT DISTINCT `co` FROM `items` WHERE `az`>? AND `co`<>? ORDER BY `co`");
$q4->execute(array(0,''));
$countries = $q4->fetchAll(PDO::FETCH_COLUMN);

?>
<title>Search Items - Cellerswine</title>
<link href="css/x1-cards.css" rel="stylesheet">
<link href="css/x3-forms.css" rel="stylesheet">
<style>
.c321{width: auto;}
.x3s,.x3d{ width: 100%; display: block; float: none; margin:10px 0;}
.x3in2{margin:10px 0;}
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
	<h1>Search Items</h1>
	<div id="x1d">
		<div id="x1d1">
			<button class="bt" id="x1bt"></button>
			<div id="x1n">
				<form autocomplete="off" method="get" action="search.php">
					<label class="x3lb">
						<span class="x3s">Item Name</span>
						<div class="x3d">		
							<input type="text" class="x3in" name="na" value="<?php echo $_GET['na'] ?? ''; ?>">
						</div>
					</label>
					<label class="x3lb">
						<span class="x3s">Category</span>
						<div class="x3d">		
							<select class="x3in" name="ca">
								<option value=""></option>
								<?php 
									foreach($arr_cat as $k => $v){
										echo '<option value="',$k,'" ';
										echo isset($_GET['ca']) && $_GET['ca']==$k ? ' selected ' : '';
										echo '>',$v,'</option>';										
									}
								?>
							</select>
						</div>
					</label>
					<label class="x3lb">
						<span class="x3s">Specialty</span>
						<div class="x3d">		
							<select class="x3in" name="co">
								<option value=""></option>
								<?php 
								$co = $_GET['na'] ?? '';
								foreach($countries as $k){
									echo '<option value="',$k,'" ';
									echo isset($_GET['co']) && $_GET['co']==$k ? ' selected ' : '';
									echo '>',$k,'</option>';										
								}
								?>
							</select>
						</div>
					</label>
					<div class="x3lb">
						<div class="x3d">
						<input type="submit" value="Search" class="x3in x3in2" name="s">
						<a href="search.php" class="x3a"><input type="button" value="View All" class="x3in x3in2"></a>
						</div>
					</div>
				</form>
			</div>
		</div>	
		<div id="x1d2">
			<div class="r">
				<?php
					$q = "SELECT * FROM `items` WHERE `az`=? ";
					$a = array(1);
					// search start
						if(isset($_GET['s'])){
							if(!empty($_GET['na'])){
								$q.=" AND `na` LIKE ? ";
								array_push($a,'%'.$_GET['na'].'%');
							}	
							if(!empty($_GET['ca'])){
								$q.=" AND `ca`=? ";
								array_push($a,$_GET['ca']);
							}
							if(!empty($_GET['co'])){
								$q.=" AND `co`=? ";
								array_push($a,$_GET['co']);
							}
						}
					// search end
					$s = $db->prepare($q);
					$s->execute($a);
					$c = $s->rowCount();
					$l = 24;
					isset($_GET['p']) && $_GET['p']>0 ? $p = $_GET['p'] : $p = 0;
					
					$r1=0;$r2=0;
					if($c>$l){
						$i = $p*$l;
						$r1 = $i;
						$q.="ORDER BY `idz` DESC LIMIT ?,?";
						array_push($a,$i);
						array_push($a,$l);
						$s = $db->prepare($q);
						$s->execute($a);
					}
					
					($r1+$l)<=$c ? $r2 = $r1+$l : $r2 = $c;
					
					$row = $s->fetchAll();
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
include "INC_FOOT.php";	
?>