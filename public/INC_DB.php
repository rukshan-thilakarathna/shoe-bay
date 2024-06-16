<?php
	$db = new PDO('mysql:host=localhost;port=3306;dbname=ecom','root','rukshan');
	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>