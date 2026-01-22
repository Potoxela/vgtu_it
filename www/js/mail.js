function msgError(msg)
{
	p = document.createElement("p");
	p.setAttribute("class", "mail_no");
	txt_error = document.createTextNode(msg);
	p.appendChild(txt_error);
	return p;
}

function addTextError(bef, textError)
{
	form = document.getElementsByTagName("form")[0];
	// Ajout du <p> d'erreur
	p_error = msgError(textError);
	form.insertBefore(p_error, bef);
}

function textError(name)
{
	dictMsg = {
		"nom" : "The name must contain only letters or hyphens.",
		"prenom" : "The first name must contain only letters or hyphens.",
		"email" : "This e-mail address is incorrect.",
		"genre" : "Select one of the two genres (yes, there are only two).",
		"date_n" : "Your age is necessary",
		"metier" : "Select a valid value from the list.",
		"sujet" : "The subject must be at least 3 characters long.",
		"msg" : "Your message must be at least 10 characters long."
	};
	
	return dictMsg[name];
}

function addMsgError(champ)
{
	console.log("ADD : " + champ);
	if (champ.parentNode.previousElementSibling.className == null || champ.parentNode.previousElementSibling.className != "mail_no")
	{
		txt = textError(champ.name);
		addTextError(champ.parentNode, txt);
	}
}

function removeMsgError(champ)
{
	console.log("REM : " + champ);
	if (champ.parentNode.previousElementSibling.className != null && champ.parentNode.previousElementSibling.className == "mail_no")
	{
		p = champ.parentNode.previousElementSibling;
		p.remove();
	}
}

function verify(champ)
{
	if (champ.type != "radio")
	{
		if (champ.value == "")
		{
			addMsgError(champ);
			return false; // Au moins une erreur
		}
		
		else
		{
			removeMsgError(champ);
			return true;
		}
	}
	
	else if (document.querySelector("input[name=genre]:checked") == null) // Rien de coché
	{
		addMsgError(champ);
		return false;
	}
	
	else // C'est coché !
	{
		removeMsgError(champ);
		return true;
	}
}

function erreurForm()
{
	e = false; // Pas d'erreur
	
	for (let i = 0; i < document.contactForm.length-1; i++) // Le dernier est <input type="submit"> (pas un champ)
	{
		isValide = verify(document.contactForm[i]);
		e = (e || !isValide);
	}
	
	return e;
}
