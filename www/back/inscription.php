<?php
	
	session_start();
	
	$e = true;
	
	$f = "../json/users.json";
	
	if (file_exists($f))
	{
		$users_json = file_get_contents($f);
		$users_php = json_decode($users_json, true);
		
		$nb_users = count($users_php);
		
		$i = 0;
		while ($i < $nb_users AND $users_php[$i]["login"] != $_POST["login"]) // Suppose que "login" est unique !
			$i++;
		
		if ($i == $nb_users) // Ca veut dire que le login n'existe pas déjà !
		{
			if ($_POST["pass"] == $_POST["pass_conf"])
			{
				// Ajouter à la base JSON...
				$users_php[] = array("login" => $_POST["login"], "pass_hash" => password_hash($_POST["pass"], PASSWORD_DEFAULT), "date_inscription" => date("Y-m-d h:i:s"));
				$users_json = json_encode($users_php);
				file_put_contents($f, $users_json);
				
				header("Location: connexion.php?login=" . $_POST["login"] . "&pass=" . $_POST["pass"]);
				exit;
			}
			
			else
				$e = "pass";
		}
		
		else
			$e = "login";
	}
	
	header("Location: ../compte.php?new_account&error=" . $e);
	
?>
