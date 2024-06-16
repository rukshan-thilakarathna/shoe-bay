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
$arr_status = array("Not Completed","Paid","Cancel");

	date_default_timezone_set("Europe/London");

	$q="SELECT * FROM `orders` WHERE 1 ";
	$a = array();
	//search start
	$zysid = "";
	$zysna = "";
	$zysaz = -1;
	if(isset($_GET['zysearch'])){
		if(!empty($_GET['zysid'])){
			$q.=" AND `oid`=? ";
			array_push($a,$_GET['zysid']);
			$zysid = $_GET['zysid'];
		}	
		if(!empty($_GET['zysna'])){
			$q.=" AND `dt`=? ";
			array_push($a,$_GET['zysna']);
			$zysna = $_GET['zysna'];
		}	
		if($_GET['zysaz']!=-1){
			$q.=" AND `pay`=? ";
			array_push($a,$_GET['zysaz']);
			$zysaz = $_GET['zysaz'];
		}
	}
	//search end
	$s = $db->prepare($q);
	$s->execute($a);
	$c = $s->rowCount();
	$l = 10;
	isset($_GET['p']) && $_GET['p']>0 ? $p = $_GET['p'] : $p = 0;
	
	$r1=0;$r2=0;
	if($c>$l){
		$i = $p*$l;
		$r1 = $i;
		$q.=" ORDER BY `dt` DESC LIMIT ?,?";
		array_push($a,$i);
		array_push($a,$l);
		$s = $db->prepare($q);
		$s->execute($a);
	}else{
		$q.=" ORDER BY `oid` DESC";
		$s = $db->prepare($q);
		$s->execute($a);
	}
	
	($r1+$l)<=$c ? $r2 = $r1+$l : $r2 = $c;
	
	$row = $s->fetchAll();

?>
<title>Manage Orders</title>
<link href="<?php echo BASE; ?>admin/adm-x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>admin/adm-x5-table.css" rel="stylesheet">
<link href="<?php echo BASE; ?>admin/adm-x9-modalbox.css" rel="stylesheet">
<style>
.zi{width: 18px;}
#a5{color: #f14428; background:#f88408;}
#zp{width: 500px;}
.x5c{padding:10px;}
.x5i1{ margin-top:0;}
.x5yv,.x5ys{float: right;}
.za1{padding:0 10px; color: #ff2a2a;}
</style>
<?php include "ADM_NAVI.php"; ?>
<div id="x9d">
	<div class="x9d">
	<img src="admin/img/cancel.svg" id="x9i">
		<div id="x9d0"><img src="css/loading.gif" width="40" height="40" alt="Please Wait.."></div>
	</div>
</div>
<div class="w" id="zy1">
	<h1>Manage Orders</h1>
	<p class="zp">Manage All Orders - Search, View Orders</p>
<!--	<button id="x5bt"><span id="x5s">Add New</span> <img src="admin/img/add.svg" alt="Add New" id="x5i"></button>-->
	<div id="x1d">
		<div id="x1d1">
			<button class="bt" id="x1bt" style="background-position: -124px 0px;"></button>
			<nav id="x1n" style="width: 228px; opacity: 1;">
				<form id="x5f0" method="get" action="">
					<fieldset class="x3fs">
						<label class="x3lb">
							<span class="x3s">Order ID</span>
							<div class="x3d">
								<input type="text" class="x3in" name="zysid" value="<?php echo $zysid; ?>">
							</div>
						</label>
						<label class="x3lb">
							<span class="x3s">Order Date (mm/dd/yyyy)</span>
							<div class="x3d">
								<input type="date" class="x3in" name="zysna" value="<?php echo $zysna; ?>">
							</div>
						</label>
						<label class="x3lb">
							<span class="x3s">Order Status</span>
							<div class="x3d">
								<select class="x3in" name="zysaz">
								<option value="-1"></option>
								<?php echo SE_optionsGen($arr_status, $zysaz); ?>
								</select>
							</div>
						</label>
						<div class="x3lb">
							<div class="x3d">
							<input type="submit" value="Search" class="x3in x3in2" name="zysearch">
							<a href="admin/manage-orders.php" class="x3a"><input type="button" value="View All" class="x3in x3in2"></a>
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
		<?php
			foreach($row as $r){
				echo '<div class="x5r x5e">';
					echo '<div class="x5c">Order ID : ',$r['oid'],'<form class="x5ys" id="x5ys',$r['oid'],'"><img src="admin/img/edit.svg" class="x5i1"><input type="hidden" name="zyid" value="',$r['oid'],'"></form><form class="x5yv" id="x5yv',$r['oid'],'"><img src="admin/img/file.svg" class="x5i1"><input type="hidden" name="zyid" value="',$r['oid'],'"></form></div>';
					echo '<div class="x5c">Cust. ID : <a href="admin/manage-customers.php?zysid=',$r['uid'],'&zysearch=Search" class="za1">',$r['uid'],'</a></div>';
					echo '<div class="x5c">Date/Time : ',$r['dt'],' ',$r['tz'],'</div>';
					echo '<div class="x5c">Amount : £',$r['tpr'],'</div>';
					echo '<div class="x5c">Status : ',$arr_status[$r['pay']],'</div>';
					//echo '<div class="x5c"><span class="x5ys" id="x5ys',$r['oid'],'"><img src="admin/img/edit.svg" class="x5i1"></span></div>';
				echo '</div>';		
				
				$p1 = $db->prepare("SELECT * FROM `orderitems` WHERE `oid`=?");
				$p1->execute([$r['oid']]);
				$res = $p1->fetchAll();
				if(count($res)>0){
					?>
					<div class="x5r">
						<div class="x5c x5e1"></div>
						<div class="x5c x5e">Item ID</div>
						<div class="x5c x5e">Item Name</div>
						<div class="x5c x5e">Price x Qty</div>
						<div class="x5c x5e">Price</div>
						<!--<div class="x5c x5e">Action</div>-->
					</div>
					<?php
					foreach($res as $s){
						echo '<div class="x5r x5e',$r['pay'],'">';
							echo '<div class="x5c"></div>';
							echo '<div class="x5c">',$s['iid'],'</div>';
							echo '<div class="x5c">',$s['ina'],'</div>';
							echo '<div class="x5c">£',$s['ipr'],' X ',$s['iqt'],'</div>';
							echo '<div class="x5c">£',$s['ipr']*$s['iqt'],'</div>';
							//echo '<div class="x5c"><span class="x5ys" id="x5ys',$s['id'],'"><img src="admin/img/edit.svg" class="x5i1 zi"></span></div>';
						echo '</div>';
					}
				}	
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
			echo '<p id="zp">No Orders Found</p>';	
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
	edit:'_edit-order',
	view:'_view-order'
}
</script>
<script src="admin/adm-x9-modal.js"></script>
<?php include "ADM_FOOT.php"; 
?>