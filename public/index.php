<?php 
    include "INC_SESS.php"; 
    if(isset($_POST['age'])){
        $_SESSION['ageVerified'] = TRUE;
    }
    include "INC_HEAD.php"; 
?>
<title>Home page</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="<?php echo BASE; ?>css/x1-cards.css?version=<?php echo time(); ?>" rel="stylesheet">
<style>
    .carousel-indicators li.active{background:var(--color-3);}
    .carousel-indicators li{ border-radius: 20px; width: 20px;  height: 0;background:rgba(255,255,255,.2);}
    #zh1{font-weight: bold;font-size: 50px;font-family: var(--font1); text-transform: uppercase;color: var(--color-2);margin: 10px 0;border-bottom: 1px solid #ccc;display: inline-block;}
    .zs1{color: var(--color-3);}
    #zp10{font-size: 18px; margin:0;font-family: var(--font1)}
    .rikzd51 {text-align: left;margin-left: 80px;}
    .rikzd50 {display: flex;justify-content: start;margin:  100px 0;}
    img.riki50 {width: 500px;}
    a.rika50 {background: var(--color-2);padding: 5px 20px;margin-top: 24px;display: block;width: max-content;color: white;}

    @keyframes anm1 {
        0%,10%{left: 0%;}
        20%,30%{left: -100%;}
        40%,50%{left: -200%;}
        60%,70%{left: -300%;}
        80%,90%{left: -400%;}
    }

    @media screen and (max-width:600px){  #zp10{text-align: center;}  }
    @media screen and (max-width:380px){  #zp10{font-size: 15px;}  }
</style>

<?php include "INC_NAVI.php"; ?>
    <section id="z1se1">
        <div id="z1d5">
            <div id="z1d7" class="z1d1">
                <div class="z1d3">
                    <div class="z1d4">
                        <h1 class="z1h1">-flora-</h1>
                        <h2 class="z1h2">the spring collection</h2>
                        <a href="#" class="z1a1">shop now  &#10093;</a>
                    </div>
                </div>
            </div>
            <div id="z1d8" class="z1d1">
                <div class="z1d3">
                    <div class="z1d4">
                        <h1 class="z1h1">-flora-</h1>
                        <h2 class="z1h2">the spring collection</h2>
                        <a href="#" class="z1a1">shop now  &#10093;</a>
                    </div>
                </div>
            </div>
            <div id="z1d9" class="z1d1">
                <div class="z1d3">
                    <div class="z1d4">
                        <h1 class="z1h1">-flora-</h1>
                        <h2 class="z1h2">the spring collection</h2>
                        <a href="#" class="z1a1">shop now  &#10093;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="w">
        <div class="rikzd50">
            <img src="img/web/web-1.jpg" class="riki50">
            <div class="rikzd51">
                <h1 id="zh1"><span class="zs1">Welcome to </span> Shoe Bay</h1>
                <p id="zp10" >Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa voluptatem, odio mollitia, qui reiciendis error labore cum, molestias quod atque neque dicta accusantium? Quaerat accusamus qui vitae architecto nam officia nulla corporis quidem placeat laborum reiciendis possimus suscipit, ducimus similique distinctio vel eius eaque laudantium iure nobis? Voluptates a adipisci consequuntur molestiae laboriosam atque, praesentium dolorem commodi .</p>
                <a href="#" class="rika50">Show More</a>
            </div>
        </div>
    </div>


    <section id="z2se1">
        <div id="z2d1" class="w">
            <div class="zd1fe">
                <h1 class="zh1fe">shop by category</h1>
                <hr class="zhr1">
            </div>
            <div id="z2d3">
                <?php
                    $p = $db->prepare("SELECT * FROM `categories` WHERE `iz`<>? ORDER BY `cid` ASC ");
                    $p->execute(['']);
                    $res = $p->fetchAll();
                    if(count($res)>0){
                        foreach($res as $r){
                ?>
                    <div class="z2d4">
                        <div class="z2d5" style="background-image: url('img/categories/<?php echo $r['iz']; ?>');    background-size: cover;width: 100%;height: 100%;background-position: center;"></div>
                        <div class="z2d6"><span class="z2s1"><?php echo $r['cn']; ?></span></div>
                    </div>
                <?php 
                        }
                    }
                ?>
                
            </div>    
        </div>
     </section>




<?php
    $p = $db->prepare("SELECT * FROM `categories` WHERE `iz`<>? ORDER BY `cid` ASC ");
    $p->execute(['']);
    $res = $p->fetchAll();
    if(count($res)>0){
        foreach($res as $rr){
            $q2 = $db->prepare("SELECT * FROM `items` WHERE `az`=? AND `ca`=? ORDER BY RAND() DESC LIMIT ?");
            $q2->execute(array(1,$rr['cid'],8));
            $row = $q2->fetchAll();
            if(count($row)>0){
?>
    <!-- section 03 -->
<section id="z3se1">
    <div id="z3d1" class="w">
        <div class="zd1fe">
            <h1 class="zh1fe"><?php echo $rr['cn']; ?></h1>
            <hr class="zhr1">
        </div>
        <div id="z3d3">

            <?php
                $q2 = $db->prepare("SELECT * FROM `items` WHERE `az`=? AND `ca`=? ORDER BY RAND() DESC LIMIT ?");
                $q2->execute(array(1,$rr['cid'],8));
                $row = $q2->fetchAll();
                if(count($row)>0){
                    foreach($row as $r){
            ?>

                <div class="z3d4">
                    <div class="z3d5"><img src="items/<?php echo $r['iz']; ?>" alt="<?php echo $r['na']; ?>" class="z3i1"></div>
                    <div class="z3d6">
                        <span class="z3s1"><?php echo $rr['cn']; ?></span>
                        <p class="z3p1"><?php echo $r['na']; ?></p>
                        <span class="z3s2">Rs.<?php echo $r['pr']; ?></span>
                        <span class="x1s4">
                            <a class="a2" href="item.php?c=<?php echo $r['uz']; ?>"><button class="x1bt x1bt1"><img src="css/view.svg" class="x1i100" alt=""></button></a>
                        </span>
                    </div>
                </div>

            <?php
                    }
                }else{
                    echo "No Items Found";
                }
            ?>
        </div>

        <a href="category.php?c=<?php echo $rr['uz']; ?>" id="z3a2">view all product &#9825;</a>
    </div>
</section>

<?php
        }}
    }
?>



<script>
function openNav() {
  document.getElementById("n1").style.width = "250px";
  document.getElementById("n1").style.display="block";
}

function closeNav() {
  document.getElementById("n1").style.width = "0";
}
</script>
<?php include "INC_FOOT.php"; ?>