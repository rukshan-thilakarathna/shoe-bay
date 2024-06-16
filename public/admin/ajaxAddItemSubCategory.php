<?php
include "ADM_SESS.php";
$MainCategoryId = $_GET['mainCategoryId'] ?? false ;

if ($MainCategoryId){


    $sc = $db->prepare("SELECT `cid`, `cn` FROM `categories` WHERE `ssid`=? AND `az`=?");
    $sc->execute([$MainCategoryId,1]);
    $cat = $sc->fetchAll();
//    $arr_cat = array();
//    foreach($cat as $rc){
//        $arr_cat[$rc['cid']]=$rc['cn'];
//    }



    print_r(json_encode($cat));
}else{
    print_r('Id not found');
}




