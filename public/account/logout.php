<?php
	session_start();
	unset($_SESSION['uid']);
	unset($_SESSION['ufn']);
	unset($_SESSION['ez']);
	header("Location:index.php");
?>
