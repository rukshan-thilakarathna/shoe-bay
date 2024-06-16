<?php  
include "ADM_SESS.php";
$err = array(FALSE, FALSE, FALSE, FALSE, FALSE, FALSE, FALSE);
//$ermsg = "";
date_default_timezone_set("Europe/London");
$OK = FALSE;
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

function imgz( $x,$w,$h, $l ) {
    /*if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }*/
	    switch ($x) {
	        case 'jpeg':
	        case 'jpg':
	            $newimg = imagecreatefromjpeg($l);
	            $newimg = imagescale($newimg,$w,$h);
	            //watermark
 					//	$textcolor = imagecolorallocate($newimg, 0, 0, 0);
 					//	imagestring($newimg, 5, ($w-170), ($h-40), 'ozusedguns.com.au', $textcolor);
	            imagejpeg($newimg,$l);
	            imagedestroy($newimg);
	        break;
	
	        case 'png':
	            //$newimg = imagecreatefrompng($l);
					$newimg = imagecreatefrompng($l);
	            $newimg = imagescale($newimg,$w,$h);
					$bg = imagecreatetruecolor($w, $h);
					imagealphablending($bg, false);
 						imagesavealpha($bg, true);
					imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
					imagecopy($bg, $newimg, 0, 0, 0, 0, $w, $h);
					imagedestroy($newimg);
					//watermark
 					//	$textcolor = imagecolorallocate($bg, 0, 0, 0);
 					//	imagestring($bg, 5, ($w-170), ($h-40), 'ozusedguns.com.au', $textcolor);   
	            imagepng($bg,$l);
	            imagedestroy($bg);
	        break;
	
	        case 'gif':
	            $newimg = imagecreatefromgif($l);
	            $newimg = imagescale($newimg,$w,$h);
	            //watermark
 					//	$textcolor = imagecolorallocate($newimg, 0, 0, 0);
 					//	imagestring($newimg, 5, ($w-170), ($h-40), 'ozusedguns.com.au', $textcolor);
	            imagegif($newimg,$l);
	            imagedestroy($newimg);
	        break;
	
	        default:
	            //throw new InvalidArgumentException('File "'.$x.'" is not valid jpg, png or gif image.');
	        break;
	    }
	}
function imgUp($imgArr,&$e1,&$e2,&$e3,&$e4,&$e5,$fileName="") {
	$img="";
	/*
	e1 = uploading error
	e2 = image is too small
	e3 = image size is more than 2MB
	e4 = image file extension is invalid
	e5 = move uploaded file failed
	*/
	if($imgArr["error"]!=0) $e1=TRUE;
	$ext = pathinfo($imgArr['name'], PATHINFO_EXTENSION);
	$ext = strtolower($ext);
	
	if(in_array($ext,array("jpg","jpeg","png","gif"))){

		$imd = getimagesize($imgArr["tmp_name"]);
		// too small image
		if($imd[0]<575 || $imd[1]<250) $e2=TRUE;
		elseif($imgArr["size"] > 5242880) $e3=TRUE;
		else{
			if($ext=='jpeg') $ext = 'jpg';
			if(empty($fileName)) $img = date('Ymdhis').mt_rand().".".$ext;
			else $img = $fileName.".".$ext;
			$l = "../img/categories/".$img;
			$ok = move_uploaded_file($imgArr["tmp_name"],$l);
			if($ok){
				$h = round((575*$imd[1])/$imd[0]);
				$h = $h>250 ? 250 : $h;
				imgz($ext,575,$h,$l);
			}else $e5=TRUE;
			//if($ok) header("Location:upload-picture.php?ok=1");
		}	
	// invalid type of image
	}else $e4=TRUE;
	return $img;
}


	if(isset($_POST['post'])){
		$iz = "";

/*
	Errors
	=======================
	
	0 - Empty Cat name
	1 - Empty page name
	2 - Page name already exist
	3 - IMG 1 - Something is wrong with image uploading report to admin
	4 - IMG 1 - Uploaded image width or height is too small
	5 - IMG 1 - Uploaded image file size is too large 
	6 - IMG 1 - Invalid extension 

*/
		$err[0] = empty($_POST['zycn']) ? TRUE : FALSE;
		$err[1] = empty($_POST['zyuz']) ? TRUE : FALSE;

		//-- generated by robotcoding3_SEYOL --//
		$zycn = $_POST['zycn'];
		$zycd = $_POST['zycd'];
		$zyod = $_POST['zyod']=="" ? 0 : $_POST['zyod'];
		$zymn = $_POST['zymn'];
		$zyuz = strtolower($_POST['zyuz']);
		$zyaz = $_POST['zyaz'];
		$zymt = $_POST['zymt'];
		$zymd = $_POST['zymd'];


		
		$zyuz = trim($zyuz);
		$zyuz = str_replace(' ','-',$zyuz);
		$zyuz = str_replace('.','-',$zyuz);
		$zyuz = str_replace(',','-',$zyuz);
		$zyuz = str_replace('|','-',$zyuz);
		$zyuz = str_replace('_','-',$zyuz);


		
		if(isset($_FILES["zyiz"]) && !empty($_FILES["zyiz"]['name'])){
				$iz = imgUp($_FILES["zyiz"],$err[3],$err[4],$err[5],$err[6],$err[3]);
		}
		
		if(!in_array(TRUE, $err)){
			$p2 = $db->prepare("SELECT `cid` FROM `categories` WHERE `uz`=?");
			$p2->execute(array($zyuz));
			if($s = $p2->fetch()) $err[2] = TRUE;
		}

		if(!in_array(TRUE, $err)){
			$OK = $db->prepare("INSERT INTO `categories` (`scid`,`ssid`,`cn`, `cd`, `od`, `mn`, `uz`, `az`, `mt`, `md`, `iz`) VALUES (?,?,?,?,?,?,?,?,?,?,?)")->execute(['-1',$_POST['MainId'],$zycn, $zycd, $zyod, $zymn, $zyuz, $zyaz, $zymt, $zymd, $iz]);
		}
	}else{
			//-- generated by robotcoding1_SEYOL --//
			$zycn = "";
			$zycd = "";
			$zyod = "";
			$zymn = "";
			$zyuz = "";
			$zyaz = "";
			$zymt = "";
			$zymd = "";
		}

 ?>
	<div id="zy1">
		<?php if($OK) echo '<div class="x3ok">The Category has been added successfully.</div>'; ?>
		<h1>Add a New Sub Category</h1>
		<form action="admin/_add-sub-category.php?mainId=8" method="post" enctype="multipart/form-data" id="zf1">
		<fieldset class="x3fs">
			<label class="x3lb">
				<span class="x3s">Category Name *</span>
				<div class="x3d">
					<input type="text" class="x3in" name="zycn" value="<?php echo $zycn; ?>" id="zycn">
				</div>
			</label>
			<label class="x3lb">
				<span class="x3s">Category Description</span>
				<div class="x3d">
					<textarea name="zycd" id="zycd" class="x3in"><?php echo $zycd; ?></textarea>
				</div>
			</label>
			<label class="x3lb">
				<span class="x3s">Position</span>
				<div class="x3d">
					<input type="number" class="x3in" name="zyod" value="<?php echo $zyod; ?>" id="zyod">
				</div>
			</label>
			<label class="x3lb">
				<span class="x3s">Visibility On Menu</span>
				<div class="x3d">
					<select class="x3in" name="zymn" id="zymn">
						<?php echo SE_optionsGen(["No","Yes"], $zymn); ?>
					</select>
				</div>
			</label>
			<label class="x3lb">
				<span class="x3s">Image (WxH : 575x250)</span>
				<div class="x3d">
					<input type="file" class="x3in" name="zyiz" id="zyiz">
				</div>
			</label>
			<div class="x3lb">
				<span class="x3s">Page Name (url) *</span>
				<div class="x3d">
					<input type="text" class="x3in" name="zyuz" id="zyuz" value="<?php echo $zyuz; ?>" >
				</div>
			</div>
			<label class="x3lb">
				<span class="x3s">SEO Title</span>
				<div class="x3d">
					<input type="text" class="x3in" name="zymt" value="<?php echo $zymt; ?>" id="zymt">
				</div>
			</label>
			<label class="x3lb">
				<span class="x3s">SEO Description</span>
				<div class="x3d">
					<textarea class="x3in" name="zymd" id="zymd"><?php echo $zymd; ?></textarea>
				</div>
			</label>
			<label class="x3lb">
				<span class="x3s">Category Status</span>
				<div class="x3d">
					<select class="x3in" name="zyaz" id="zyaz">
					<?php echo SE_optionsGen(["N/A","Active"], $zyaz); ?>
					</select>
				</div>
			</label>
			<div class="x3lb">
				<span class="x3s">&nbsp;</span>
				<div class="x3d x9e">
				<input type="button" value="Add" class="x3in x3in2" name="zysent" id="zysentAdd">
				<input type="hidden" name="post" value="1">
                    <input type="hidden" name="MainId" value="<?php echo $_GET['mainId']; ?>">
				</div>
			</div>
		</fieldset>	
	</form>
	</div>
<?php  
$msgno = "";
if(in_array(TRUE, $err)){
	$arrlen = count($err);
	for($i=0;$i<$arrlen;$i++){
		if($err[$i]) $msgno.=" e".$i;
	}
}
?>
<input type="hidden" id="msgno" value="<?php echo $msgno; ?>">