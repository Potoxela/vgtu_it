<?php include("include/forall.php"); ?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<meta charset="utf-8" />
		<title>Contact - Guitar sales</title>
		<link rel="stylesheet" href="css/style.css" />
		<meta name="viewport" content="width=device-width" />
		<link rel="icon" href="vg.ico" />
		<script src="js/mail.js"></script>
		
	</head>
	
	<body>
		
		<?php include("include/header.php"); ?>
		
		<section>
			<h2>Contact us</h2>
			
			<p>If you have any questions, suggestions, or need assistance, feel free to contact us using the form below. We'll get back to you as soon as possible.</p>
			
			<form method="post" action="back/mail.php" name="contactForm" onsubmit="return !erreurForm()">
				<?php
					if (isset($_GET["error"]) AND empty($_GET["error"]))
						print("<p class=\"mail_yes\">Mail sent successfully.</p>");
				?>
				
				<p><label for="nom">Surname</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "nom")
						print("<p class=\"mail_no\">The name must contain only letters or hyphens.</p>");
				?>
				<p><input type="text" name="nom" id="nom" placeholder="Surname" value="<?= (isset($_SESSION["form_nom"])) ? $_SESSION["form_nom"] : "" ?>" /></p>
				
				<p><label for="prenom">First name</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "prenom")
						print("<p class=\"mail_no\">The first name must contain only letters or hyphens.</p>");
				?>
				<p><input type="text" name="prenom" id="prenom" placeholder="First name" value="<?= (isset($_SESSION["form_prenom"])) ? $_SESSION["form_prenom"] : "" ?>" /></p>
				
				<p><label for="email">E-mail address</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "email")
						print("<p class=\"mail_no\">This e-mail address is incorrect.</p>");
				?>
				<p><input type="email" name="email" id="email" placeholder="E-mail" value="<?= (isset($_SESSION["form_email"])) ? $_SESSION["form_email"] : "" ?>" /></p>
				
				<p><label>Sex</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "genre")
						print("<p class=\"mail_no\">Select one of the two genres (yes, there are only two).</p>");
				?>
				<p>
					<input type="radio" name="genre" id="h" value="1" <?= (isset($_SESSION["form_genre"]) AND $_SESSION["form_genre"] == 1) ? "checked " : " " ?> /><label for="h">Man</label>
					<input type="radio" name="genre" id="f" value="2" <?= (isset($_SESSION["form_genre"]) AND $_SESSION["form_genre"] == 2) ? "checked " : " " ?>/><label for="f">Woman</label>
				</p>
				
				<p><label for="date_n">Date of birth</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "date_n")
						print("<p class=\"mail_no\">Are you really " . (date("Y") - date_parse($_SESSION["form_date_n"])["year"]) . " years old? Please be serious.</p>");
				?>
				<p><input type="date" name="date_n" id="date_n" value="<?= (isset($_SESSION["form_date_n"])) ? $_SESSION["form_date_n"] : "" ?>" /></p>
				
				<p><label for="metier">Socioprofessional category</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "metier")
						print("<p class=\"mail_no\">Select a valid value from the list.</p>");
				?>
				<p>
					<select name="metier" id="metier">
						<option value="" <?= (!isset($_SESSION["form_metier"])) ? "selected" : "" ?> disabled>-- Choix --</option>
						<option value="agriculteur" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "agriculteur") ? "selected" : "" ?>>Farmer-operator</option>
						<option value="artisant" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "artisant") ? "selected" : "" ?>>Craftsman, shopkeeper, company manager</option>
						<option value="cadre" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "cadre") ? "selected" : "" ?>>Executives and higher intellectual professions</option>
						<option value="inter" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "inter") ? "selected" : "" ?>>Intermediate occupation</option>
						<option value="employe" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "employe") ? "selected" : "" ?>>Employee</option>
						<option value="ouvier" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "ouvier") ? "selected" : "" ?>>Worker</option>
						<option value="retraite" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "retraite") ? "selected" : "" ?>>Retired</option>
						<option value="autre" <?= (isset($_SESSION["form_metier"]) AND $_SESSION["form_metier"] == "autre") ? "selected" : "" ?>>Other non-working person</option>
					</select>
				</p>
				
				<p><label for="sujet">Subject</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "sujet")
						print("<p class=\"mail_no\">The subject must be at least 3 characters long.</p>");
				?>
				<p><input type="text" name="sujet" id="sujet" placeholder="Object" value="<?= (isset($_SESSION["form_sujet"])) ? $_SESSION["form_sujet"] : "" ?>" /></p>
				
				<p><label for="msg">Message</label></p>
				<?php
					if (isset($_GET["champ"]) AND $_GET["champ"] == "msg")
						print("<p class=\"mail_no\">Your message must be at least 10 characters long.</p>");
				?>
				<p><textarea name="msg" id="msg" rows="10" placeholder="Your message..."><?= (isset($_SESSION["form_msg"])) ? $_SESSION["form_msg"] : "" ?></textarea></p>
				
				<p>IP address</p>
				<p><input type="text" name="ip" value="<?= $_SERVER["REMOTE_ADDR"] ?>" readonly /></p>
				
				<p>Data is stored in session variables. You are free to <a href="back/mail.php?reset">delete</a> them.</p>
				<p><input type="submit" value="Send" /></p>
			</form>
		</section>
		
		<?php include("include/footer.php"); ?>
		
		<?php include("include/script.php"); ?>
	</body>
	
</html>
