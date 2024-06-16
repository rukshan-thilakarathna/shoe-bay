<?php 
include "ADM_SESS.php";
include "ADM_HEAD.php"; 
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
$arr_status = array("N/A","Active","Out of Stock");

	date_default_timezone_set("Europe/London");
	
	$sc = $db->prepare("SELECT `cid`, `cn` FROM `categories` WHERE `az`=?");
	$sc->execute([1]);
	$cat = $sc->fetchAll();
	$arr_cat = array();
	foreach($cat as $rc){
		$arr_cat[$rc['cid']]=$rc['cn'];
	}

	$q="SELECT * FROM `items` WHERE 1 ";
	$a = array();
	//search start
	$zysid = "";
	$zysna = "";
	$zysst = 0;
	$zysty = 0;
	$zysca = 0;
	$zysaz = -1;
	if(isset($_GET['zysearch'])){
		if(!empty($_GET['zysid'])){
			$q.=" AND `idz`=? ";
			array_push($a,$_GET['zysid']);
			$zysid = $_GET['zysid'];
		}	
		if(!empty($_GET['zysna'])){
			$q.=" AND `na`=? ";
			array_push($a,$_GET['zysna']);
			$zysna = $_GET['zysna'];
		}	
		if(!empty($_GET['zysca'])){
			$q.=" AND `ca`=? ";
			array_push($a,$_GET['zysca']);
			$zysca = $_GET['zysca'];
		}
		if($_GET['zysaz']!=""){
			$q.=" AND `az`=? ";
			array_push($a,$_GET['zysaz']);
			$zysaz = $_GET['zysaz'];
		}
	}
	//search end
	$s = $db->prepare($q);
	$s->execute($a);
	$c = $s->rowCount();
	$l = 15;
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

?>
<title>Manage Items</title>
<link href="<?php echo BASE; ?>admin/adm-x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>admin/adm-x5-table.css" rel="stylesheet">
<link href="<?php echo BASE; ?>admin/adm-x9-modalbox.css" rel="stylesheet">
<style>
.zi{width: 50px; display: block; margin:0 auto;transition:1s all;}
.zc{background:rgba(255,255,255,.2);
    width: 260px;
    padding: 20px;
    text-align: center;
    border-radius: 5px;}
.za{text-decoration: none; margin:20px;}
.za:hover .zi{transform:scale(1.5);}
.x5i{width: 40px;}
#a3{color: #f14428; background:#f88408;}
#zp{width: 500px;}
</style>
<?php include "ADM_NAVI.php"; ?>
<div id="x9d">
	<div class="x9d">
	<img src="admin/img/cancel.svg" id="x9i">
		<div id="x9d0"><img src="css/loading.gif" width="40" height="40" alt="Please Wait.."></div>
	</div>
</div>
<div class="w" id="zy1">
	<h1>Manage Items</h1>
	<p class="zp">Manage All Items - Add, Edit & Delete Items</p>
	<button id="x5bt"><span id="x5s">Add New</span> <img src="admin/img/add.svg" alt="Add New" id="x5i"></button>
	<div id="x1d">
		<div id="x1d1">
			<button class="bt" id="x1bt" style="background-position: -124px 0px;"></button>
			<nav id="x1n" style="width: 228px; opacity: 1;">
				<form id="x5f0" method="get" action="">
					<fieldset class="x3fs">
						<label class="x3lb">
							<span class="x3s">Item ID</span>
							<div class="x3d">
								<input type="text" class="x3in" name="zysid" value="<?php echo $zysid; ?>">
							</div>
						</label>
						<label class="x3lb">
							<span class="x3s">Item Name</span>
							<div class="x3d">
								<input type="text" class="x3in" name="zysna" value="<?php echo $zysna; ?>">
							</div>
						</label>
						<label class="x3lb">
							<span class="x3s">Category</span>
							<div class="x3d">
								<select class="x3in" name="zysca">
									<option value=""></option>
									<?php 
										foreach($arr_cat as $k => $v){
											echo '<option value="',$k,'">',$v,'</option>';										
										}
									?>
								</select>
							</div>
						</label>
						<label class="x3lb">
							<span class="x3s">Item Status</span>
							<div class="x3d">
								<select class="x3in" name="zysaz">
								<option value=""></option>
								<?php echo SE_optionsGen($arr_status, $zysaz); ?>
								</select>
							</div>
						</label>
						<div class="x3lb">
							<div class="x3d">
							<input type="submit" value="Search" class="x3in x3in2" name="zysearch">
							<a href="admin/manage-items.php" class="x3a"><input type="button" value="View All" class="x3in x3in2"></a>
							</div>
						</div>
					</fieldset>	
				</form>	
			</nav>
		</div>
		<div id="x1d2">

<?php	
	
	if($c>0){
?>		
	<div class="x5t">
		<div class="x5r">
			<div class="x5c x5e">ID</div>
			<div class="x5c x5e">Picture</div>
			<div class="x5c x5e">Name</div>
			<div class="x5c x5e">Code</div>
			<div class="x5c x5e">Category</div>
			<div class="x5c x5e">Price</div>
			<div class="x5c x5e">Added On</div>
			<div class="x5c x5e">Status</div>
			<div class="x5c x5e">Action</div>
		</div>
		
		<?php
			foreach($row as $r){
				echo '<div class="x5r x5e',$r['az'],'">';
					echo '<div class="x5c">',$r['idz'],'</div>';
					echo '<div class="x5c"><img src="items/';
						echo !empty($r['iz']) ? $r['iz'] : 'no-img.jpg';
					echo '" class="x5i" alt=""></div>';
					echo '<div class="x5c">',$r['na'],'</div>';
					echo '<div class="x5c">',$r['cd'],'</div>';
					echo '<div class="x5c">',$arr_cat[$r['ca']],'</div>';
					echo '<div class="x5c">',$r['pr'],'</div>';
					echo '<div class="x5c">',$r['dt'],'</div>';
					echo '<div class="x5c">',$arr_status[$r['az']],'</div>';
					echo '<div class="x5c">';
						echo '<a href="item/',$r['uz'],'" target="_blank"><img src="admin/img/view.svg" class="x5i1"></a>';
						echo '<form class="x5ys" id="x5ys',$r['idz'],'"><img src="admin/img/edit.svg" class="x5i1"><input type="hidden" name="zyid" value="',$r['idz'],'"></form>';
						echo '<form class="x5ys1" id="zydel',$r['idz'],'"><img src="admin/img/delete.svg" class="x5i1"><input type="hidden" name="zyid" value="',$r['idz'],'"></form>';
					echo '</div>';
				echo '</div>';			
			}
		?>
		</div>
		<nav id="x5n">
			<?php	
			if($c>$l){
				$l = ($c/$l);
				$prev = 0; 
				$post = 0; 
				for($i=0; $i<$l; $i++){
					if($prev==1){echo '<a href="#" class="x5a1 x5a3">&nbsp;...&nbsp;</a>'; $prev++;}
					if($post==1){echo '<a href="#" class="x5a1 x5a3">&nbsp;...&nbsp;</a>'; $post++;}
					if($l>11 && $i>4 && $i<$l-5 ){
						if($i<$p-5) { $prev++; continue;}
						if($i>$p+5) { $post++; continue;}
					}
					echo '<a href="'.preg_replace("/&p=(.*)/","",$_SERVER['REQUEST_URI']).(strpos($_SERVER['REQUEST_URI'],'?')>0 ?'&amp;' :'?').'p='.$i.'"';
					echo $p==$i ? ' class="x5a1 x5a2" ' : ' class="x5a1" ';
					echo '>'.($i+1).'</a>';
				} 
			}
			?>
		</nav>
		
<?php
		}else{
			echo '<p id="zp">No items Found</p>';	
		}

?>	
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
// configurations
var SE_modal = {
	edit:'_edit-item',
	add:'_add-item',
	del:'_del-item',
	err:{
		"e0":["zyna","Item name is required"],
		"e1":["zypr","Item price is required"],
		"e2":["zyca","Invalid Category"],
		"e3":["zyiz","Image Uploading Error, Please report to site admin"],
		"e4":["zyiz","Uploaded image width or height is too small"],
		"e5":["zyiz","Uploaded image file size is too large"],
		"e6":["zyiz","Invalid extension"],
		"e7":["zyuz","Page name is required"],
		"e8":["zyuz","Page name is invalid"]
	}
}
</script>
<script src="admin/adm-x9-modal.js"></script>
<?php include "ADM_FOOT.php"; ?>