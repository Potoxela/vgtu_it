<?php include("include/forall.php"); ?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<meta charset="utf-8" />
		<title>My account - Guitar sales</title>
		<link rel="stylesheet" href="css/style.css" />
		<meta name="viewport" content="width=device-width" />
		<link rel="icon" href="vg.ico" />
		
	</head>
	
	<body>
		
		<?php include("include/header.php"); ?>
		
		<section>
			<?php
				if (!isset($_SESSION["login"]))
				{
					if (isset($_GET["new_account"]))
					{
						?>
						<h2>Sign up</h2>
						<form method="post" action="back/inscription.php">
							<fieldset>
								<legend>New account</legend>
								<?php
									if (isset($_GET["error"]))
									{
										switch ($_GET["error"])
										{
											case "json":
												echo "<p class=\"mail_no\">Unable to connect to server.</p>";
											break;
											
											case "login":
												echo "<p class=\"mail_no\">This identifier is already taken. Choose another one.</p>";
											break;
											
											case "pass":
												echo "<p class=\"mail_no\">The two passwords are not identical.</p>";
											break;
												
										}
									}
								?>
								<p><label for="login">Identifier</label></p>
								<p><input type="text" name="login" id="login" placeholder="Identifier" required /></p>
								
								<p><label for="pass">Password</label></p>
								<p><input type="password" name="pass" id="pass" placeholder="Password" required /></p>
								
								<p><label for="pass_conf">Confirmation</label></p>
								<p><input type="password" name="pass_conf" id="pass_conf" placeholder="Password" required /></p>
								
								<p><input type="submit" value="Create" /></p>
							</fieldset>
						</form>
						<p>Already have an account? <a href="?">Sign in now!</a></p>
						<?php
					}
					
					else
					{
						?>
						<h2>Sign in</h2>
						<form method="post" action="back/connexion.php">
							<fieldset>
								<legend>Existant account</legend>
								<?php
									if (isset($_GET["error"]))
									{
										switch ($_GET["error"])
										{
											case "json":
												echo "<p class=\"mail_no\">Unable to connect to server.</p>";
											break;
											
											case "login":
												echo "<p class=\"mail_no\">Login not found.</p>";
											break;
											
											case "pass":
												echo "<p class=\"mail_no\">Wrong password.</p>";
											break;
												
										}
									}
								?>
								<p><label for="login">Identifier</label></p>
								<p><input type="text" name="login" id="login" placeholder="Identifier" required /></p>
								
								<p><label for="pass">Password</label></p>
								<p><input type="password" name="pass" id="pass" placeholder="Password" required /></p>
								
								<p><input type="submit" value="Log in" /></p>
							</fieldset>
						</form>
						<p>Don't have an account? <a href="?new_account">Register now!</a></p>
						<?php
					}
				}
				
				else
				{
					?>
					<p>Connected as <mark><?= $_SESSION["login"] ?></mark>.</p>
					
					<h2>My basket</h2>
					
					<table>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>UP</th>
							<th>Total</th>
							<th>Operation</th>
						</tr>
						<?php
							$tot = 0;
							$qte = 0;
							foreach ($_SESSION["pannier"] as $id => $quantite)
							{
								if ($quantite > 0) // Sinon, il a été retiré !
								{
									?>
									<tr>
										<td><?= $id ?></td>
										<td><?= $_SESSION["catalogue"][$id]["nom"] ?></td>
										<td><?= $quantite ?></td>
										<td class="compta"><?= number_format($_SESSION["catalogue"][$id]["prix"], 2, ",", " ") ?> €</td>
										<td class="compta"><?= number_format($_SESSION["catalogue"][$id]["prix"]*$quantite, 2, ",", " ") ?> €</td>
										<td><a href="back/pannier.php?suppr=<?= $id ?>">X</a></td>
									</tr>
									<?php
									$tot += $_SESSION["catalogue"][$id]["prix"]*$quantite;
									$qte += $quantite;
								}
							}
							
							if ($qte > 0)
							{
								?>
								<tr class="offre_gratuite">
									<td>p01</td>
									<td>Guitar sheet music</td>
									<td><?= $qte ?></td>
									<td class="compta">FREE</td>
									<td class="compta">0 €</td>
									<td></td>
								</tr>
								<?php
							}
						?>
						<tr>
							<td colspan="4">Final total</td>
							<td class="compta"><strong><?= number_format($tot, 2, ",", " ") ?> €</strong></td>
							<td><a href="#">Pay</a></td>
						</tr>
					</table>
					
					<?php
						if ($_SESSION["login"] == "admin")
						{
							?>
							<h2>Administrator area</h2>
							<p>You are logged in as administrator.</p>
							<p>JSON user database :</p>
							<pre style="background: darkslategray;"><?php print_r(json_decode(file_get_contents("json/users.json"), true)); ?></pre>
							<?php
						}
					?>
					
					<p><a href="back/connexion.php?deco">Log out</a></p>
					<?php
				}
			?>
		</section>
		
		<?php include("include/footer.php"); ?>
		
		<?php include("include/script.php"); ?>
	</body>
	
</html>
