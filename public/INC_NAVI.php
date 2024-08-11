</head>
<body>
    <!-- header -->
    <header id="hd">
        <div id="d1">
            <div id="d4" class="w">
                <!-- <ul id="u1">
                    <li class="l1">
                        <a href="#" class="a1">
                            <img src="img/icon/view.png" alt="" class="i1">
                        </a>
                        <div class="d2">
                            Follow On Facebook
                            <div class="d3"></div>
                        </div>
                    </li>
                    <li class="l1">
                        <a href="#" class="a1">
                            <img src="img/icon/view.png" alt="" class="i1">
                        </a>
                        <div class="d2">
                            Follow On Facebook
                            <div class="d3"></div>
                        </div>
                    </li>
                    <li class="l1">
                        <a href="#" class="a1">
                            <img src="img/icon/view.png" alt="" class="i1">
                        </a>
                        <div class="d2">
                            Follow On Facebook
                            <div class="d3"></div>
                        </div>
                    </li>
                    <li class="l1">
                        <a href="#" class="a1">
                            <img src="img/icon/view.png" alt="" class="i1">
                        </a>
                        <div class="d2">
                            Follow On Facebook
                            <div class="d3"></div>
                        </div>
                    </li>
                    <li class="l1">
                        <a href="#" class="a1">
                            <img src="img/icon/view.png" alt="" class="i1">
                        </a>
                        <div class="d2">
                            Follow On Facebook
                            <div class="d3"></div>
                        </div>
                    </li>
                    <li class="l1">
                        <a href="#" class="a1">
                            <img src="img/icon/view.png" alt="" class="i1">
                        </a>
                        <div class="d2">
                            Follow On Facebook
                            <div class="d3"></div>
                        </div>
                    </li>
                </ul> -->
                <span id="s1">Click me to get 10% off everything + Free Shipping!</span>
                <span id="s1">Mail: Thilakarathnarukshan9@gmail.com</span>
                <span id="s1">tel: 0762005399</span>
            </div>
        </div>
        <div id="d5">
            <div id="d6" class="w">
                <div id="d51">
                    <a href="#" id="a50"><img src="img/icon/menu.png" alt="menu" id="i6"></a>
                    <a href="#" id="a3"><img src="img/icon/search.png" alt="search" id="i2"></a>
                </div>
                <a href="#" id="a4"><img src="img/logo.png" alt="logo" id="i3"></a>
                <div id="d7">
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
        <div id="d9">
            <div id="d10" class="w">
                <ul id="u3">
                    <?php
                        $sc = $db->prepare("SELECT * FROM `categories` WHERE `az`=? AND `scid`=? ORDER BY `od`");
                        $sc->execute([1,0]);
                        $cat = $sc->fetchAll();
                        foreach($cat as $key => $c){
                    ?>
                    <li class="l3">
                        <a href="category.php?c=<?php echo $c['uz'] ?>" class="a7"><?php echo $c['cn'] ?></a>
                        <ul class="u4">
                            <div class="d50"></div>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                            <li class="l4"><a href="#" class="a9">platforms</a></li>
                        </ul>
                    </li>
                   <?php } ?>
                </ul>
            </div>
        </div>
    </header>