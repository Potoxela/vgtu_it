<?php
	function file_page()
	{
		return end(explode("/", $_SERVER["PHP_SELF"]));
	}
?>

<header>
	<h1>Guitar <span id="g">sales</span></h1>
	<nav>
		<ul>
			<li><a href="index.php" <?php echo (file_page() == "index.php") ? "id=\"here\"" : ""; ?>>Home</a></li>
			<li><a href="catalogue.php" <?php echo (file_page() == "catalogue.php") ? "id=\"here\"" : ""; ?>>Categories</a></li>
			<li><a href="compte.php" <?php echo (file_page() == "compte.php") ? "id=\"here\"" : ""; ?>>My account</a></li>
			<li><a href="contact.php" <?php echo (file_page() == "contact.php") ? "id=\"here\"" : ""; ?>>Contact</a></li>
		</ul>
	</nav>
</header>
