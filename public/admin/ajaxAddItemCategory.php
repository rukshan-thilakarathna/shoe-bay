<?php
include "ADM_SESS.php";
$MainCategoryId = $_GET['mainCategoryId'] ?? false ;

if ($MainCategoryId){


    $sc = $db->prepare("SELECT `cid`, `cn` FROM `categories` WHERE `scid`=?");
    $sc->execute([$MainCategoryId]);
    $cat = $sc->fetchAll();
    $arr_cat = array();
    foreach($cat as $rc){
        $arr_cat[$rc['cid']]=$rc['cn'];
    }

    print_r($arr_cat);
}else{
    print_r('Id not found');
}




