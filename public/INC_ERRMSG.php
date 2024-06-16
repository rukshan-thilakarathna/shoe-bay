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