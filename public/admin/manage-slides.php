<?php 
include "ADM_SESS.php";
include "ADM_HEAD.php"; 

	$q="SELECT * FROM `slides-new` WHERE 1";
	$a = array();

	$s = $db->prepare($q);
	$s->execute($a);
	$c = $s->rowCount();
	$l = 25;
	isset($_GET['p']) && $_GET['p']>0 ? $p = $_GET['p'] : $p = 0;

	$r1=0;$r2=0;
	if($c>$l){
		$i = $p*$l;
		$r1 = $i;
		$q.="ORDER BY `od` DESC LIMIT ?,?";
		array_push($a,$i);
		array_push($a,$l);
		$s = $db->prepare($q);
		$s->execute($a);
	}

	($r1+$l)<=$c ? $r2 = $r1+$l : $r2 = $c;
	
	$row = $s->fetchAll();

?>
<title>Manage Slides</title>
<link href="<?php echo BASE; ?>admin/adm-x3-forms.css" rel="stylesheet">
<link href="<?php echo BASE; ?>admin/adm-x5-table.css" rel="stylesheet">
<link href="<?php echo BASE; ?>admin/adm-x9-modalbox.css" rel="stylesheet">
<style>
.zi{width: 50px; display: block; margin:0 auto;transition:1s all;}
.zc{background:rgba(255,255,255,.2);
    width: 260px;
    padding: 20px;
    text-align: center;
    bcustomer-radius: 5px;}
.za{text-decoration: none; margin:20px;}
.za:hover .zi{transform:scale(1.5);}
#a9{color: #f14428; background:#f88408;}
#zp{width: 500px;}
.x5c{vertical-align: top; padding:10px;}
</style>
<?php include "ADM_NAVI.php"; ?>
<div id="x9d">
	<div class="x9d">
	<img src="admin/img/cancel.svg" id="x9i">
		<div id="x9d0"><img src="css/loading.gif" width="40" height="40" alt="Please Wait.."></div>
	</div>
</div>
<div class="w" id="zy1">
	<h1>Manage Slides</h1>
	<p class="zp">Manage Banner Images of Slides</p>
	<div id="x1d">
		
		<div id="x1d2">

<?php

	if($c>0){
?>		
	<div class="x5t">
		<div class="x5r">
			<div class="x5c x5e">Banner Image</div>
			<div class="x5c x5e">Action</div>
		</div>
		
		<?php
			foreach($row as $r){
				echo '<div class="x5r x5e1">';
					echo '<div class="x5c"><img src="slides/';
						echo $r['image'];
					echo '" class="x5i" alt=""></div>';
					echo '<div class="x5c">';
						echo '<form class="x5ys" id="x5ys',$r['id'],'"><img src="admin/img/edit.svg" class="x5i1"><input type="hidden" name="zyid" value="',$r['id'],'"></form>';
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
			echo '<p id="zp">No Slides Found</p>';	
		}

?>	
		</div>	
	</div>
</div>
<script>
// configurations
var SE_modal = {
	edit:'_edit-slide',
	err:{
		"e0":["zyhd","Heading is empty"],
		"e1":["zyp1","Paragraph 1 is empty"],
		"e2":["zyiz","Something is wrong in image uploading"],
		"e3":["zyiz","Uploaded image width or height is too small"],
		"e4":["zyiz","Uploaded image file size is too large"],
		"e5":["zyiz","Invalid extension, Allowed extensions are : jpg,jpeg,gif and png"]
	}
}
</script>
<script src="admin/adm-x9-modal.js"></script>
<?php include "ADM_FOOT.php"; ?>