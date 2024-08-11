<?php

function password_generate($chars)
{
    $data = '1234567890123456789012345678901234567890123456789012345678901234567890';
    return substr(str_shuffle($data), 0, $chars);
}

$order_id = "52_".time()."_".password_generate(6);
$merchant_secret = 'MTAyNDg0MDQ1MzEzNzA1NDExNzczMDA0MjM5ODIzNTUxNDgyNzg2';


$hash = '1221531';
$hash .= $order_id;
$hash .= number_format($_SESSION['tpr'], 2, '.', '');
$hash .= 'LKR';
$hash .= strtoupper(md5($merchant_secret));
$hash = strtoupper(md5($hash));



?>