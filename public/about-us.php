<?php 
include "INC_SESS.php";		
include "INC_HEAD.php"; 
?>
<link href="css/x2-item.css" rel="stylesheet">
<title>About Us</title>
<meta name="description" content="<?php echo $s['md']; ?>">
<style>
@media screen and (max-width:1000px){
	h1{text-align: center;}
	p{text-align: center;}

}
</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
	<h1>About Us</h1>
	<p>Cellers of Western Road is a friendly, local off-license offering a large selection of beers, wines and spirits. We can source a large variety of alcohol so please get in touch today & we will be happy to help!</p>
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
?>