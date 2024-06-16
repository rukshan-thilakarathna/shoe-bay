</head>
<body>
<header id="hd">
	<div class="w">
		<div class="rikd1">
			<div class="e1"><a href="" class="a2"><img src="img/logo.png" alt="Sukee_Fashion_Hub" id="i1"></a></div>
            <div class="rikd2">
                <nav id="n1">
                    <ul class="rikul0">
                        <li class="rikli0"><a href="" class="rika1">Home</a></li>
                        <li class="rikli0"><a href="http://localhost/cloths/public/" class="rika1">About Us</a></li>
                        <li class="rikli0">
                            <a href="http://localhost/cloths/public/" class="rika1">Products</a>
                            <ul class="rikul1">

                                <?php
                                    $sc = $db->prepare("SELECT * FROM `categories` WHERE `az`=? AND `scid`=? ORDER BY `od`");
                                    $sc->execute([1,0]);
                                    $cat = $sc->fetchAll();
                                    foreach($cat as $key => $c){
                                ?>
                                        <li class="rikli1">
                                            <a href="category.php?c=<?php echo $c['uz'] ?>" class="rika1"><?php echo $c['cn'] ?></a>
                                            <ul class="rikul3">
                                                <?php
                                                    $sc = $db->prepare("SELECT * FROM `categories` WHERE `az`=? AND `scid`=? ORDER BY `od`");
                                                    $sc->execute([1,$c['cid']]);
                                                    $cat = $sc->fetchAll();
                                                    foreach($cat as $key => $c){
                                                ?>
                                                    <li class="rikli3">
                                                        <a href="category.php?c=<?php echo $c['uz'] ?>" class="rika1"><?php echo $c['cn'] ?></a>
                                                        <ul class="rikul4">
                                                            <?php
                                                            $sc = $db->prepare("SELECT * FROM `categories` WHERE `az`=? AND `scid`=? ORDER BY `od`");
                                                            $sc->execute([1,$c['cid']]);
                                                            $cat = $sc->fetchAll();
                                                            foreach($cat as $key => $c){
                                                                ?>
                                                                    <li class="rikli4">
                                                                        <a href="category.php?c=<?php echo $c['uz'] ?>" class="rika1"><?php echo $c['cn'] ?></a>
                                                                    </li>
                                                                <?php
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>
                                                <?php
                                                    }
                                                ?>
                                            </ul>
                                        </li>
                                <?php

                                    }
                                ?>
                            </ul>
                        </li>
                        <li class="rikli0"> <a href="http://localhost/cloths/public/" class="rika1">Contact Us</a></li>
                    </ul>
                    <a href="javascript:void(0)" class="closebtn a1" onclick="closeNav()" >&times;</a>






                </nav>
                <div class="rikd2">
                    <nav id="n2">
                        <a href="shopping" class="a4"><button class="bt" id="bt2"></button>
                            <?php
                            if(!empty($_SESSION['cart'])){
                                echo '<span id="s0">',count($_SESSION['cart']),'</span>';
                            }
                            ?>
                        </a>
                        <a href="account" class="a4"><button class="bt" id="bt4"></button></a>
                        <a href="" class="a4"><button class="bt" id="bt5"></button></a>
                    </nav>
                </div>
            </div>
		</div>
	</div>
</header>
