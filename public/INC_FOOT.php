<footer id="ft">
	<div class="w">
		<span class="s3" id="ys3"><span id="s3"></span>Page Top</span>
		<div class="r">
			<div class="c31 d01" style="display: flex;width: 100%;">
				<?php
					$q3 = $db->prepare("SELECT * FROM `categories` WHERE `az`>? AND `scid` = ? ");
					$q3->execute(array(0,0));
					$catmenu = $q3->fetchAll();
					$counter = 0;
					if(count($catmenu)>0){
						foreach($catmenu as $m){
                            $sc = $db->prepare("SELECT * FROM `categories` WHERE `az`=? AND `scid`=? ORDER BY `od`");
                            $sc->execute([1,$m['cid']]);
                            $cat = $sc->fetchAll();
                ?>
                        <div class="c31 d01">
                            <span style="display: block;color: #ffffff;font-size: 19px;text-decoration: underline;margin-bottom: 7px;"><?php echo $m['cn']; ?></span>

                            <?php
                            foreach($cat as $key => $c){
                                ?>

                                <a href="category.php?c=<?php echo $c['uz'] ?>" class="a3"><?php echo $c['cn']; ?></a>

                                <?php
                            }
                            ?>

                        </div>

                <?php
                        }
                    }
                ?>
			</div>
			<div class="c31 d01" style="width: 100%;display: flex;justify-content: space-between;margin-bottom: 76px;">
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