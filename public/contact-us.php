<?php 
include "INC_SESS.php";		
include "INC_HEAD.php"; 
?>
<title>Contact Us</title>
<style>
	@media screen and (max-width:1000px){
		h1{text-align: center;}
		p{text-align: center;}

}
</style>
<?php include "INC_NAVI.php"; ?>
<div class="w">
	<h1>Contact Us</h1>
	<p>Location : 179 Western Road, Billericay, Essex</p>
	<p>Call : +44 1277 622305</p>
	<p>Email : cellers.wine@gmail.com</p>
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