<?php
	
	session_start();
	
	if (isset($_SESSION["login"])) // L'utilisateur doit être connecté pour gérer son pannier
	{
		if (isset($_GET["suppr"]))
		{
			$_SESSION["pannier"][$_GET["suppr"]] = 0;
			header("Location: ../compte.php");
			exit;
		}
		
		if (isset($_GET["id_produit"], $_GET["quantite"], $_SESSION["catalogue"][$_GET["id_produit"]]) AND $_GET["quantite"] <= $_SESSION["catalogue"][$_GET["id_produit"]]["stock"])
		{
			$_SESSION["pannier"][$_GET["id_produit"]] = $_GET["quantite"];
		}
		
		header("Location: ../catalogue.php");
		exit;
	}
	
	header("Location: ../compte.php");
	
?>
