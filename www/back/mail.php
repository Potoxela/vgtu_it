<?php
	
	session_start();
	
	/*
		Ne pas utiliser substr() mais plutôt mb_substr().
			-> substr("éric", 0, 2) : "é" (accents comptés en 2 caractères)
			-> mb_substr("éric", 0, 2) : "ér" (accents comptés en 1 caractère)
	*/
	
	function fullMaj($str)
	{
		$search  = array("à", "á", "â", "ã", "ä", "å", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "ý", "ÿ");
		$replace = array("À", "Á", "Â", "Ã", "Ä", "Å", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ò", "Ó", "Ô", "Õ", "Ö", "Ù", "Ú", "Û", "Ü", "Ý", "Y");
		return strtoupper(str_replace($search, $replace, $str));
	}
	
	function firstMaj($str)
	{
		$maj = array("À", "Á", "Â", "Ã", "Ä", "Å", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ò", "Ó", "Ô", "Õ", "Ö", "Ù", "Ú", "Û", "Ü", "Ý", "Y");
		$min = array("à", "á", "â", "ã", "ä", "å", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ò", "ó", "ô", "õ", "ö", "ù", "ú", "û", "ü", "ý", "ÿ");
		
		$tete = fullMaj(mb_substr($str, 0, 1)); // La première en majuscule...
		$reste = strtolower(str_replace($maj, $min, mb_substr($str, 1))); // ... et le reste en minuscule
		return ($tete . $reste);
	}
	
	
	
	$e = true;
	
	if (isset($_GET["reset"]))
	{
		$_SESSION["form_nom"] = NULL;
		$_SESSION["form_prenom"] = NULL;
		$_SESSION["form_email"] = NULL;
		$_SESSION["form_genre"] = NULL;
		$_SESSION["form_date_n"] = NULL;
		$_SESSION["form_metier"] = NULL;
		$_SESSION["form_sujet"] = NULL;
		$_SESSION["form_msg"] = NULL;
		
		header("Location: ../contact.php");
		exit;
	}
	
	if (isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["genre"], $_POST["date_n"], $_POST["metier"], $_POST["sujet"], $_POST["msg"]))
	{
		// Mise en forme (bonus)
		$_POST["nom"] = fullMaj($_POST["nom"]);
		$_POST["prenom"] = firstMaj($_POST["prenom"]);
		
		// Pour préremplir le formulaire en cas d'erreur
		$_SESSION["form_nom"] = $_POST["nom"];
		$_SESSION["form_prenom"] = $_POST["prenom"];
		$_SESSION["form_email"] = $_POST["email"];
		$_SESSION["form_genre"] = $_POST["genre"];
		$_SESSION["form_date_n"] = $_POST["date_n"];
		$_SESSION["form_metier"] = $_POST["metier"];
		$_SESSION["form_sujet"] = $_POST["sujet"];
		$_SESSION["form_msg"] = $_POST["msg"];
		
		if (preg_match("#^[A-Za-zÀ-ÿ-]+$#", $_POST["nom"]))
		{
			if (preg_match("#^[A-Za-zÀ-ÿ-]+$#", $_POST["prenom"]))
			{
				if (preg_match("#^[a-z][a-z0-9]*@[a-z]{2,}\.[a-z]{2,4}$#", $_POST["email"]))
				{
					if ($_POST["genre"] == 1 OR $_POST["genre"] == 2) // 1 => Homme ; 2 => Femme
					{
						if (preg_match("#^(19[0-9]{2}|20[0-9]{2})-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$#", $_POST["date_n"])) // AAAA-MM-JJ
						{
							if (in_array($_POST["metier"], array("agriculteur", "artisant", "cadre", "inter", "employe", "ouvier", "retraite", "autre")))
							{
								if (preg_match("#^.{3,}$#", $_POST["sujet"]))
								{
									if (preg_match("#^.{10,}$#", $_POST["msg"]))
									{
										$mail = "sauvanalex@cy-tech.fr"; // Déclaration de l'adresse de destination.
										
										if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
											$passage_ligne = "\r\n";
										else
											$passage_ligne = "\n";
										
										// Déclaration des messages au format texte et au format HTML.
										$message_txt = "Surname: " . $_POST["nom"] . "\n";
										$message_txt .= "Name: " . $_POST["prenom"] . "\n";
										$message_txt .= "E-mail: " . $_POST["email"] . "\n";
										$message_txt .= "Sex: " . (($_POST["genre"] == 1) ? "Man" : "Woman") . "\n";
										$message_txt .= "Date of birth: " . $_POST["date_n"] . "\n";
										$message_txt .= "Profession: " . $_POST["metier"] . "\n";
										$message_txt .= "Subject: " . $_POST["sujet"] . "\n";
										$message_txt .= "Message: " . $_POST["msg"] . "\n";
										
										$message_html = "
										<html lang=\"fr\">
											<head></head>
											<body>
												<h1>Customer data</h1>
												<p>Information entered via the contact form.</p>
												<ul>
													<li><strong>Surname</strong>: " . $_POST["nom"] . "</li>
													<li><strong>Name</strong>: " . $_POST["prenom"] . "</li>
													<li><strong>E-mail</strong>: " . $_POST["email"] . "</li>
													<li><strong>Sex</strong>: " . (($_POST["genre"] == 1) ? "Man" : "Woman") . "</li>
													<li><strong>Date of birth</strong>: " . $_POST["date_n"] . "</li>
													<li><strong>Profession</strong>: " . $_POST["metier"] . "</li>
													<li><strong>Subject</strong>: " . $_POST["sujet"] . "</li>
													<li><strong>Message</strong>: " . $_POST["msg"] . "</li>
												</ul>
											</body>
										</html>";
										
										// Création de la boundary
										$boundary = "-----=".md5(rand());
										
										// Définition du sujet.
										$sujet = "Contact client";
										
										// Création du header de l'e-mail.
										$header = "From: \"WeaponsB\"<weaponsb@mail.fr>".$passage_ligne;
										$header.= "Reply-to: \"WeaponsB\" <weaponsb@mail.fr>".$passage_ligne;
										$header.= "MIME-Version: 1.0".$passage_ligne;
										$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
										
										// Création du message.
										$message = $passage_ligne."--".$boundary.$passage_ligne;
										
										// Ajout du message au format texte.
										$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
										$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
										$message.= $passage_ligne.$message_txt.$passage_ligne;
										
										$message.= $passage_ligne."--".$boundary.$passage_ligne;
										
										// Ajout du message au format HTML
										$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
										$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
										$message.= $passage_ligne.$message_html.$passage_ligne;
										
										$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
										$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
										
										// Envoi de l'e-mail.
										$e = !mail($mail, $sujet, $message, $header);
										
										if (!$e) // Si pas d'erreur, vidons le formulaire
										{
											$_SESSION["form_nom"] = NULL;
											$_SESSION["form_prenom"] = NULL;
											$_SESSION["form_email"] = NULL;
											$_SESSION["form_genre"] = NULL;
											$_SESSION["form_date_n"] = NULL;
											$_SESSION["form_metier"] = NULL;
											$_SESSION["form_sujet"] = NULL;
											$_SESSION["form_msg"] = NULL;
										}
									}
									
									else
										$champ = "msg";
								}
								
								else
									$champ = "sujet";
							}
							
							else
								$champ = "metier";
						}
						
						else
							$champ = "date_n";
					}
					
					else
						$champ = "genre";
				}
				
				else
					$champ = "email";
			}
			
			else
				$champ = "prenom";
		}
		
		else
			$champ = "nom";
	}
	
	header("Location: ../contact.php?error=" . ($e) . ((isset($champ)) ? "&champ=" . $champ : ""));
	
?>
