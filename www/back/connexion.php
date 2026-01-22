<?php
	
	session_start();
	
	$e = true; // Erreur
	
	if (isset($_GET["deco"]))
	{
		session_destroy();
		header("Location: ../compte.php");
		exit;
	}
	
	if (isset($_GET["login"], $_GET["pass"])) // Vient de inscription.php
	{
		$_POST["login"] = $_GET["login"];
		$_POST["pass"] = $_GET["pass"];
	}
	
	if (file_exists("../json/users.json") AND isset($_POST["login"], $_POST["pass"]))
	{
		$users_json = file_get_contents("../json/users.json");
		$users_php = json_decode($users_json, true);
		
		$nb_users = count($users_php);
		
		$i = 0;
		while ($i < $nb_users AND $users_php[$i]["login"] != $_POST["login"]) // Suppose que "login" est unique !
			$i++;
		
		if ($i < $nb_users) // Ca veut dire que le login a été trouvé !
		{
			if (password_verify($_POST["pass"], $users_php[$i]["pass_hash"]))
			{
				$_SESSION["login"] = $_POST["login"];
				$_SESSION["pannier"] = array();
				$e = false;
			}
			
			else
				$e = "pass";
		}
		
		else
			$e = "login";
	}
	
	else
		$e = "json";
	
	header("Location: ../compte.php" . (($e) ? ("?error=" . $e) : ""));
	
?>
