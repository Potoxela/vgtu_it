<?php
	
	/*
		PHP Orienté Objet !!
		Il faut caster les valeurs récupérées par le biai de l'objet.
		Sinon, le type est "SimpleXMLElement Object".
	*/
	
	$catalogue = simplexml_load_file("xml/produits.xml");
	
	for ($i = 0 ; $i < 3 ; $i++) // Chaque catégorie
	{
		$cat = $catalogue->categorie[$i];
		
		foreach ($cat->produit as $p) // Chaque produit de la catégorie
		{
			$id = (string) $p->id;
			$_SESSION["catalogue"][$id] = array();
			
			foreach ($p as $key => $data) // Chaque caractéristique du produit
			{
				$_SESSION["catalogue"][$id][$key] = (string) $data;
			}
		}
	}
	
?>
