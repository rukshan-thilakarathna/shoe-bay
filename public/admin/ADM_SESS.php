<?php
session_cache_limiter('nocache');
session_start();
$ADM = isset($_SESSION['adm']) && !empty($_SESSION['adm']) ? TRUE : FALSE;
if(!$ADM) header("Location:index.php");
//try{
	include "../INC_DB.php";
	define('BASE', 'https://dev.revoise.com/cloths/public/');
?>
