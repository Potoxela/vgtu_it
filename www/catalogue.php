<?php
	include("include/forall.php");
	include("back/varSession.inc.php");
	$type = array("c" => "classique", "f" => "folk", "e" => "électrique");
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		
		<meta charset="utf-8" />
		<title>Catalog - Guitar sales</title>
		<link rel="stylesheet" href="css/style.css" />
		<meta name="viewport" content="width=device-width" />
		<link rel="icon" href="vg.ico" />
		<script src="js/catalogue.js"></script>
		
	</head>
	
	<body>
		
		<?php include("include/header.php"); ?>
		
		<section>
			<p class="msg_alert">OFFER: for the purchase of a guitar from our catalog, we'll give you a free score of over 30 famous pieces!</p>
			
			<h2>Catalog</h2>
			
			<nav>
				<h3>Guitar types</h3>
				<p>To access the catalog, select a guitar type:</p>
				<ul>
					<li><a href="?cat=c">Classic</a></li>
					<li><a href="?cat=f">Folk</a></li>
					<li><a href="?cat=e">Electric</a></li>
				</ul>
			</nav>
			
			<?php
				if (isset($_GET["cat"]) AND preg_match("#c|f|e#", $_GET["cat"])) // Si la catégorie est cohérente
				{
					?>
					<section>
						<h3>Guitares <?= $type[$_GET["cat"]] . (($_GET["cat"] == "f") ? "" : "s") ?></h3>
						
						<table id="catalogue">
							<tr>
								<th>Reference</th>
								<th>Designation</th>
								<th>Photo</th>
								<th>Price</th>
								<th class="stock">Stock</th>
								<th>Quantity ordered</th>
							</tr>
							<?php
								foreach ($_SESSION["catalogue"] as $id => $guitare)
								{
									if (preg_match("#^" . $_GET["cat"] . "#", $id)) // Commence par la lettre de la catégorie (cXX, fXX ou eXX)
									{
										?>
										<tr>
											<td><?= $id ?></td>
											<td><?= $guitare["nom"] ?></td>
											<td><a href="img/<?= $id ?>.webp" title="Zoom" target="_blank"><img src="img/<?= $id ?>.webp" alt="Guitare" /></a></td>
											<td><?= number_format($guitare["prix"], 2, ",", " ") ?>&nbsp;€</td>
											<td class="stock" id="s_<?= $id ?>"><?= $guitare["stock"] ?></td>
											<td>
												<span id="qte_<?= $id ?>">0</span><br />
												<button id="moins_<?= $id ?>" disabled>-</button> <button id="plus_<?= $id ?>">+</button><br />
												<button id="ajout_pannier_<?= $id ?>" onclick="document.location.href='back/pannier.php?id_produit=<?= $id ?>&quantite=0'">Ajouter au pannier</button>
											</td>
										</tr>
										<?php
									}
								}
							?>
						</table>
						
						<p><button id="affiche_stock">Display stocks</button></p>
					</section>
					<?php
				}
			?>
			
			<p>For more information, <a href="contact.php">contact us</a>!</p>
		</section>
		
		
		<?php include("include/footer.php"); ?>
		
		
		<?php include("include/script.php"); ?>
		
	</body>
	
</html>
