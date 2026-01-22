<?php
	
	session_start();
	
	if (isset($_GET["verif"]))
		$_SESSION["lvl"] = true;
	
	if (!isset($_SESSION["lvl"]) OR !$_SESSION["lvl"])
		header("Location: verif.php");
	
?>
