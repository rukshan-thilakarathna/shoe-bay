<?php 
include "INC_SESS.php";
if(!isset($_GET['c']) || empty($_GET['c'])) {
	header("Location:index.php");
	exit();
}
	$sc = $db->prepare("SELECT `cid`, `cn` FROM `categories` WHERE `az`=?");
	$sc->execute([1]);
	$cat = $sc->fetchAll();
	$arr_cat = array();
	foreach($cat as $rc){
		$arr_cat[$rc['cid']]=$rc['cn'];
	}
	
	$arr_status = array('N/A','Available','Out of stock');
	
	$q = $db->prepare("SELECT * FROM `items` WHERE `uz`=? AND `az`>?");
	$q->execute(array($_GET['c'],0));
	if($s = $q->fetch()){
		
include "INC_HEAD.php"; ?>
<link href="css/x2-item.css?sfs" rel="stylesheet">
<title><?php echo $s['mt']; ?></title>
<meta name="description" content="<?php echo $s['md']; ?>">
<style>
        /* section 01 */
        #z1se1{margin-top: 50px;}
        #z1d1{display: flex;justify-content: space-between;flex-wrap: wrap;}
        #z1d2{/*background: url(img/pm.jpg) no-repeat;background-size: cover;background-position: center;overflow: hidden;*/height: 500px;width: 48%;border-radius: 0 12px 12px 12px;}
        .z1d55 {cursor: pointer;position: relative;height: 500px;width: 100%;overflow: hidden;border: 1px solid #ddd;    border-radius: 0 12px 0 0;}
        .z1d55 img {width: 100%;height: 100%;transition: transform 0.2s ease;}
        .zoom1 {position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-repeat: no-repeat;pointer-events: none;transform: scale(1);transition: transform 0.2s ease, background 0.2s ease;}
        #z1d3{width: 50%;}
        .z1s1{font-size: 10px;margin-left: 8px;font-family: var(--font-2);color: var(--color-13);}
        #z1d3{display: flex;flex-direction: column;}
        .z1a1{color: var(--color-13);text-transform: uppercase;font-family: var(--font-2);font-size: 13.6px;}
        .z1a1,#z1a3{color: var(--color-13);text-transform: uppercase;font-family: var(--font-2);font-size: 13.6px;}
        #z1a3{color: var(--color-14);font-weight: 700;}
        .z1a1:hover{color: var(--color-14);transition: 0.3s;}
        #z1u1{display: flex;list-style: none;gap: 8px;margin-bottom: 20px;}
        .z1i1{width: 40px;height: 18px;}
        .z1p1{display: flex;align-items: center;}
        .z1p2{color: var(--color-15);font-family: var(--font-2);font-size: 16px;font-weight: 700;text-transform: capitalize;margin-bottom:  25px;}
        #z1h1{text-transform: capitalize;font-size: 27px;font-family: var(--font-3);font-weight: normal;margin-bottom: 8px;}
        .z1s2{font-family: var(--font-2);font-size: 19px;color: #000;font-weight: 700;}
        #z1p1,#z1s3{color: var(--color-15);font-family: var(--font-2);font-size: 13px;margin-top: 5px;}
        #z1s3{color: #000;font-weight: 700;margin-top: 5px;}
        
        #z1s6{background-color: var(--color-16);}
        .z1d8{background-color: #fff;width: 36px;height: 36px;padding: 3px;display: flex;justify-content: center;align-items: center;border: 1px solid var(--color-17);;border-radius: 3px;position: relative;}
        #z1d6{display: flex;gap: 8px}
        .z1s4{width: 100%;height: 100%;border-radius: 3px;}
        .active1{border-color: var(--color-18);border-width: 2px;}
        /* .disable1{border-color: red;border-width: 2px;} */
        #z1d5{margin-top: 35px;display: flex;flex-direction: column;}
        .z1d9{min-width: 42px;background-color: var(--color-14);top: -35px;left: -9px;border-radius: 3px;position: absolute;text-align: center;padding: 2px 5px;color: #fff;font-family: var(--font-1);font-size: 12px;display: flex;align-items: center;z-index: 0;opacity: 0;display: none;transition: 0.3s;}
        .z1d10{position: absolute;top: 7px;left: 30%;width: 20px;height: 20px;background-color: var(--color-14);transform: rotate(45deg);z-index: -1;}
        .z1d8:hover .z1d9{top: -40px;opacity: 1;display: initial;transition: 0.3s;}
        #z1d12{display: flex;justify-content: space-between;align-items: center;}
        #z1a15{display: flex;gap: 5px;align-items: center;}
        #z1d11{margin-top: 20px;}
        #z1i15{width:20px;height: 25px;}
        #z1s15{font-size: 15px;font-family: var(--font-2);color: #000;text-transform: capitalize;font-weight: 700;}
        .z1d15{border: 1px solid var(--color-19);padding: 7px 15px;display: flex;justify-content: center;align-items: center;width: fit-content;border-radius: 3px;font-family: var(--font-2);font-size: 14px;color: var(--color-19);}
        #z1d14{display: flex;gap: 5px;position: relative;}
        .active2{border: 2px solid var(--color-14);color: var(--color-14);font-weight: 700;}
        .z1i16{width: 16px;height: 16px;margin-right: 8px;}
        .z1a16{font-family: var(--font-2);font-size: 15.4px;color: #000;text-transform: uppercase;font-weight: 700;color: var(--color-4);padding: 8px 16px;border-radius: 5px;border: 1px solid var(--color-4);transition: 0.3s;}
        #z1a18{background: var(--color-20);color: #fff;padding: 8.5px 35px;border: 0px;}
        #z1d18{margin-top: 35px;display: flex;align-items: center;gap: 12px;flex-wrap: wrap;}
        #z1a17:hover{background: var(--color-4);color: #fff;transition: 0.3s;}
        #z1a18:hover{opacity: 0.9;}
        #z1i18{width: 70px;height: 73px;}
        #z1d20{display: flex;gap: 15px;margin-top: 35px;border-bottom: 1px solid var(--color-21);}
        #z1s11{font-weight: normal;font-family: var(--font-3);font-size: 20px;margin-bottom: 12px;display: block;}
        .z1p15{color: var(--color-15);font-family: var(--font-2);font-size: 16px;}
        #z1d22{padding: 20px 0px 35px;display: flex;flex-wrap: wrap;justify-content: space-between;border-bottom: 1px solid var(--color-21);}
        .z1d23{display: flex;flex-direction: column;align-items: center;gap: 3px;width: 30%;}
        .z1i22{width: 32px;height: 32px;margin-bottom: 8px;}
        .z1p17{color: var(--color-15);font-family: var(--font-2);font-size: 12.8px;border-bottom: 1px solid var(--color-21);padding: 6px 0px;}
        .z1a20{color: #000;font-family: var(--font-2);font-size: 12.8px;}
        #z1p18{border: 0px;}
        .z1a20:hover{color: var(--color-12);transition: 0.3s;}
        .z1a23{font-size: 13px;font-family: var(--font-2);color: #000;}
        .z1s12{font-size: 15px;font-family: var(--font-3);color: #000;font-weight: normal;text-transform: capitalize;}
        .z1a23:hover{color: var(--color-12);transition: 0.3s;}
        .sv1{width: 18px;height: 18px;fill: var(--color-22);transition: fill 0.3s ease;}
        .sv1:hover {fill: #fff; }
        .z1a25{background: #fff;padding: 8px;border: 1px solid var(--color-22);border-radius: 5px;display: flex;justify-content: center;align-items: center;width: fit-content;}
        .z1a26:hover{background: var(--color-23);transition: 0.3s;border: 1px solid var(--color-23);}
        .z1a28:hover{background: #000;transition: 0.3s;border: 1px solid #000;}
        .z1a27:hover{background: var(--color-24);transition: 0.3s;border: 1px solid var(--color-24);}
        #z1d24{display: flex;gap: 8px;margin-top: 15px;}
        .z1d15{position: relative;}
        .z1d15:hover .z1d16{top: -40px;opacity: 1;display: initial;transition: 0.3s;}
        .z1d17{position: absolute;top: 7px;left: 29%;width: 20px;height: 20px;background-color: var(--color-14);transform: rotate(45deg);z-index: -1;}
        .z1d16{min-width: 42px;background-color: var(--color-14);top: -35px;left: -4px;border-radius: 3px;position: absolute;text-align: center;padding: 2px 5px;color: #fff;font-family: var(--font-1);font-size: 12px;display: flex;align-items: center;z-index: 0;opacity: 0;display: none;transition: 0.3s;}
        .z1d57{position: absolute;background: var(--color-8);color: #fff;left: 0;top: 0;padding: 3px 8px;text-transform: capitalize;font-family: var(--font-2);font-size: 14.8px;}
        /* section 01 end */

        /* section 02 */
        #z2se2{margin-top: 35px;}
        .z2d5{display: flex;background-color: #fff;flex-direction: column;}
        .z2d8{display: flex;justify-content: space-between;align-items: center;cursor: pointer;}
        .z2d6{background:#fff;transition: 0.3s;}
        .sv2{width: 25px;height: 25px;fill:var(--color-15);transform: rotate(0deg);opacity: 0.7;}
        #z2d1{display: flex;flex-direction: column;}
        .z2d5{padding: 10px 0;border-top: 1px solid var(--color-25);border-bottom: 1px solid var(--color-25);}
        .z2s1{font-size: 18px;font-family: var(--font-1);color: var(--color-15);}
        #z2d10{width: 30%;}
        #z2d11{width: 35%;}
        #z2d11{width: 35%;}
        #z2d17{flex-wrap: wrap;justify-content: space-between;padding: 15px 0;}
        .z2s3{font-size: 20px;font-family: var(--font-3);font-weight: normal;color: #000;text-transform: uppercase;margin-bottom: 15px;display: block;}
        .z2hr1{height: 3px;background: var(--color-21);width: 30px;border: 0px;margin-bottom: 15px;}
        #z2p2,#z2a1{font-family: var(--font-3);font-size: 20px;font-weight: normal;color: #000;margin-bottom: 12px;}
        #z2a1{font-weight: 600;}
        #z2a1:hover {color: var(--color-12);}
        .z2u1{padding-left: 20px;display: flex;flex-direction: column;gap: 15px;}
        .z2l1,.z2p1{color: var(--color-15);font-size: 16px;font-family: var(--font-2);text-transform: capitalize;}
        .z2p1{line-height: 1.4;text-transform: initial;}
        #z2d13{margin-bottom: 20px;}
        #z2d14{margin-bottom: 75px;}
        #z2s4{text-transform: initial;}
        #z2a2{font-size: 16px;font-family: var(--font-2);color: #000;}
        #z2a2:hover {color: var(--color-12);}
        .z2s1:hover {color: var(--color-12);}
        .z2s2 {opacity: 0.5;}
        .z2s2:hover {opacity: 1;transition: 0.3s;}
        #z2d16{flex-direction: column;padding: 15px 0;}
        #z2d15{border: 2px solid #000;padding: 40px 35px;margin-top: 50px;}
        .z2s4{text-transform: initial;}
        .show{display: flex;}
        .hide{display: none;}
        /* .z2d6{display: none;} */
        /* section 02 end */

        /* section 03 */
        #z3se1{margin-top: 50px;}
        #z3d1{display: flex;flex-direction: column;}
        #z3d3{margin-top: 35px;display: flex;flex-wrap: wrap;justify-content: space-between;}
        .z3d4{width: 24%;height: 410px;margin-bottom: 35px;display: flex;flex-direction: column;gap: 12px;}
        .z3d5{height: 350px;overflow: hidden;border-radius:12px 12px 12px 12px;cursor: pointer;}
        .z3i1{width: 100%;height: 100%;transition: 0.5s;}
        .z3d6{display: flex;flex-direction: column;text-align: center;gap: 2px;}
        .z3s1{font-size: 10.8px;font-family: var(--font-2);color: var(--color-6);text-transform: uppercase;}
        .z3p1{font-size: 14.4px;font-family: var(--font-2);color: #000;text-transform: capitalize;}
        .z3s2{font-size: 14.4px;font-family: var(--font-2);color: var(--color-7);font-weight: 700;}
        .z3d5:hover .z3i1{transform: scale(1.2);transition: 0.5s;}
        .z3p1:hover{color: var(--color-9);transition: 0.2s;}
        #z3h1{font-family: var(--font-3);font-size: 20px;color: #000;font-weight: normal;}
        .z3p2{color: var(--color-12);padding: 8px 0 0;font-size: 18px;}
        .z3p3{height: 35px;}
        /* section 03 end */

        /* media screen  */
        @media screen and (max-width:850px) {
            /* section 01  */
            #z1d2{width: 100%;}
            #z1d3{width: 100%;}
            #z1d1{gap: 35px;justify-content: center;}
            /* section 02  */
            #z2d14{margin-bottom: 20px;}
            #z2d10,#z2d11,#z2d12{width: 45%;}
        }
        @media screen and (max-width:680px) {
            /* section 03  */
            .z3d5{height: 180px;}
        }
        @media screen and (max-width:500px) {
            /* section 01  */
            #z1d2{height: 500px;width: 98%;}
            #z1d3{width: 98%;}
            .z1d55{height: 500px;}
            #z1se1{margin-top: 0px;}
            .z1a16,.z1d23{width: 100%;}
            #z1d22{justify-content: center;gap: 20px;}
            #z1d14{gap: 3px;}
            /* section 02  */
            #z2d10,#z2d11,#z2d12{width: 100%;margin-bottom: 20px;}
            #z2d2,#z2d7{width: 100%;}
            #z2d1{align-items: center;}
            /* section 03  */
            .z3d5{height: 250px;}
            .z3d4{width: 49%;margin-bottom: 0px;}
        }
        /* media screen end*/ 
    </style>
<?php include "INC_NAVI.php"; ?>

 <!-- section 01  -->
 <section id="z1se1">
        <div id="z1d1" class="w">
            <div id="z1d2">
                <div class="z1d55" id="z1d56">
                    <img src="items/<?php echo $s['iz']; ?>" alt="Product Image">
                    <div class="zoom1" id="zoom"></div>
                </div>
            </div>
            <div id="z1d3">
                <form action="shopping/index.php" method="post"><input type="hidden" name="item" value="<?php echo $s['idz']; ?>"><!--<button class="x1bt" id="x1bt2" type="submit">Buy</button>-->
               
                <div id="z1d4">
                    <h1 id="z1h1"><?php echo $s['na']; ?></h1>
                    <span class="z1s2" style="font-size: 12px;margin-bottom: 8px;display: block;">Product Code : <?php echo $s['cd']; ?></span><br>
                    <span class="z1s2">Rs. <?php echo $s['pr']; ?></span>
                </div>
                <?php
                    if($s['colour'] != null){
                ?>
                <div id="z1d5">
                    <p class="z1p2" style="margin-bottom: 5px;">Color :</p>
                    <div id="z1d6">
                    <?php
                        foreach(explode(', ', $s['colour']) as $key => $color){
                    ?>
                        <div class="z1d8">
                            <label style="background-color: <?php echo $color; ?>;" class="z1s4"><input type="radio" value="<?php echo $color; ?>" name="color" id=""></label>
                        </div>
                    <?php
                       }
                    ?>
                    </div>
                </div>
                <?php
                    }
                    if($s['size'] != null){
                ?>
                <div id="z1d5">
                    <p class="z1p2" style="margin-bottom: 5px;">Size :</p>
                    <div id="z1d6">
                    <?php
                        foreach(explode(', ', $s['size']) as $key => $size){
                    ?>
                        <div class="z1d8" style="width: max-content;">
                            <label style="display: flex;align-items: center;width: 47px;justify-content: space-between;border: 1px solid #e9d7d7;color: #5e5c5c;padding: 0 5px;cursor: pointer;" class="z1s4"><input type="radio" name="size" value="<?php echo $size ; ?>" id=""> <?php echo $size ; ?></label>
                        </div>
                    <?php
                       }
                    ?>
                    </div>
                </div>
                <?php
                   
                }
            ?>
                <div id="z1d18">
                   <ul>
					<li class="x2li">
							<input style="width: 50px;" type="number" class="x2sl" placeholder="quantity" name="qty" value="1" id="zin" min="1" step="1">
							<button class="z1a16" style="cursor: pointer" type="submit">Add to Cart</button>
						</li>
				   </ul>
                </div>
                
            </form>
            </div>
        </div>
     </section>
    <!-- section 01 end -->
    <section id="z2se2">
        <div id="z2d1" class="w">
           <p><?php echo $s['desr']; ?></p>
        </div>
    </section>
   
<script>
function openNav() {
  document.getElementById("n1").style.width = "250px";
  document.getElementById("n1").style.display="block";
}

function closeNav() {
  document.getElementById("n1").style.width = "0";
}
</script>
<script>
        // tab js 
        function down(tabNumber) {
            var contents = document.querySelectorAll('.z2d6');
            var element = document.getElementById("z2d1" + tabNumber);
    
            contents.forEach(function(content) {
                if (content !== element) {
                    content.classList.add('hide');
                    content.classList.remove('show');
                }
            });
    
            if (element.classList.contains("hide")) {
                element.classList.add("show");
                element.classList.remove("hide");
            } else {
                element.classList.add("hide");
                element.classList.remove("show");
            }
        }
        // tab js end
    
        // img js 
        const container = document.getElementById('z1d56');
        const zoom = document.getElementById('zoom');
        const img = container.querySelector('img');
    
        container.addEventListener('mousemove', (e) => {
            const { offsetX, offsetY } = e;
            const { offsetWidth, offsetHeight } = container;
    
            const xPercent = (offsetX / offsetWidth) * 100;
            const yPercent = (offsetY / offsetHeight) * 100;
    
            zoom.style.backgroundImage = `url(${img.src})`;
            zoom.style.backgroundSize = `${img.width * 1.5}px ${img.height * 1.5}px`; // Increased the zoom factor
            zoom.style.backgroundPosition = `${xPercent}% ${yPercent}%`;
            zoom.style.transform = 'scale(1.1)';
        });
    
        container.addEventListener('mouseleave', () => {
            zoom.style.transform = 'scale(1)';
            zoom.style.backgroundImage = 'none';
        });
        // img js end
        
        // menu js 
        let menu = document.getElementById("a50");
        let nav1 = document.getElementById("d35");
        let display = 1 

        function menuclick(){
            if(display==1){
                // nav1.style.display = "initial";
                // nav1.style.transition = "left 0.4s ease;";
                menu.style.rotate = "90deg"
                nav1.style.left = "0px";
                display=0
            }
            else{
                // nav1.style.display = "none";
                // nav1.style.transition = "left 0.4s ease;";
                menu.style.rotate = "0deg"
                nav1.style.left = "-300px";
                display=1
            }
        }
        // menu js end
     </script>
<?php include "INC_FOOT.php"; 
	}else{
		echo "Page Not Found 404";
	}
?>