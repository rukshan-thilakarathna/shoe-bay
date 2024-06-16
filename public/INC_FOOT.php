<footer id="ft">
	<div class="w">
		<span class="s3" id="ys3"><span id="s3"></span>Page Top</span>
		<div class="r">
			<div class="c31 d01">
				<?php
					$q3 = $db->prepare("SELECT * FROM `categories` WHERE `az`>?");
					$q3->execute(array(0));
					$catmenu = $q3->fetchAll();
					$counter = 0;
					if(count($catmenu)>0){
						foreach($catmenu as $m){
							$counter++;
							echo '<a href="category/',$m['uz'],'" class="a3">',$m['cn'],'</a>	';
							if($counter==7) echo '</div><div class="c31 d01">';
						}
					}
				?>
			</div>
			<div class="c31 d01">
				<a href="search.php" class="a3">Search</a>
				<a href="shopping" class="a3">Shopping</a>	
				<a href="account" class="a3">Sign In</a>	
				<a href="reset-password.php" class="a3">Reset Password</a>	
				<a href="terms-and-conditions.php" class="a3">Terms &amp; Conditions</a>	
				<a href="privacy-policy.php" class="a3">Privacy Policy</a>
				<a href="about-us.php" class="a3">About Us</a>	
				<a href="contact-us.php" class="a3">Contact Us</a>
				<a href="https://www.facebook.com/cellerswines" class="a3" target="_blank">Facebook</a>
			</div>		
		</div>
		<p id="p0">All rights Reserved &copy; 2023 Sukee Fashion</p>
		<img src="img/payment-methods.png" alt="Payment Methods" id="i0">
	</div>
<script>
function scrollToTop(k){var t;if(k>0){k-=20;window.scrollTo(0,k);t=setTimeout(function(){scrollToTop(k-=20);},10);}else clearTimeout(t);}
_('ys3').onclick=function(){scrollToTop(document.documentElement.scrollHeight);}
</script>	
</footer>
</body>
</html>
<?php
/*}catch(PDOException $e){
	//echo $e->getMessage();
	echo "Something is Wrong. Please report to the site admin";
}*/
?>