window.onload = function()
{
	// Affichage de la colonne des stocks
	let b = document.getElementById("affiche_stock");
	
	b.onclick = function()
	{
		let e = document.getElementsByClassName("stock"); // Tableau car plusieurs Class
		
		for (let i = 0 ; i < e.length ; i++)
		{
			if(e[i].style.display == "table-cell")
				e[i].style.display = "none";
			else
				e[i].style.display = "table-cell";
		}
	}
	
	
	
	const queryString = window.location.search; // URL de la page
	const urlParams = new URLSearchParams(queryString); // Paramètres de l'URL
	const c = urlParams.get("cat"); // Valeur du paramètre "cat" (c, f, e)
	const n = document.getElementsByClassName("stock").length - 1; // Nombre de guitares (1er cellule avec class="stock" est le header)
	
	for (let g = 1 ; g <= n ; g++) // Pour chaque guitare
	{
		let id = c + ((g < 10) ? "0" : "") + g;
		
		// Gestion de la quantité commandée
		let m = document.getElementById("moins_" + id);
		let p = document.getElementById("plus_" + id);
		let e = document.getElementById("qte_" + id);
		
		let a = document.getElementById("ajout_pannier_" + id); // Element <button> "Ajouter au pannier"
		let attr = a.getAttribute("onclick"); // Valeur de l'attribut "onclick" de l'élément <button> "Ajouter au pannier"
		
		m.onclick = function()
		{
			e.innerHTML = e.innerHTML - 1;
			p.removeAttribute("disabled");
			
			if (e.innerHTML - 1 < 0) // Peut-on continuer ?
				m.setAttribute("disabled", "disabled");
			
			// Modifions la quantité dans le lien "Ajouter au pannier"
			attr = attr.replace(/quantite=[0-9]+/, "quantite=" + e.innerHTML); // Changer la quantité
			a.setAttribute("onclick", attr); // Mettre à jour dans le HTML
			
		}
		
		p.onclick = function()
		{
			let max = document.getElementById("s_" + id);
			
			e.innerHTML = e.innerHTML - 1 + 2;
			m.removeAttribute("disabled");
			
			if (e.innerHTML - 1 + 2 > max.innerHTML) // Peut-on continuer ?
				p.setAttribute("disabled", "disabled");
			
			// Modifions la quantité dans le lien "Ajouter au pannier"
			attr = attr.replace(/quantite=[0-9]+/, "quantite=" + e.innerHTML); // Changer la quantité
			a.setAttribute("onclick", attr); // Mettre à jour dans le HTML
		}
	}
}
