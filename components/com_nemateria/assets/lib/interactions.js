// sauvegarder les valeurs des positions des séquences
var seq = [];

function change_class(c, s) {
		// Ajouter une fonction qui liste les morceaux et qui change le fond. Dans la fonction il faut un argument a
		// setClass(c);
	// Renvoyer le player à l'instant choisi
		jwplayer().seek(s);
	}
// Modifier une classe lors d'un clic ou de la lecture
function setClass(c)
	{
		jQuery('#'+c).addClass("playing");
	}
// CHANGER LA PLAYLISTE EN SUIVANT LA LECTURE
function change_playliste(t){
	var i = 0;
	var h = 0;
	var i;
	var actu;
		jQuery('.sequence').each(function( index ) {
			var tmp_class = jQuery(this).attr('class'); // Récupérer la classe de la balise en cours
			//  Test sur la lecture du player si la position de lecture est supérieure à une valeur de balise
			var tmp_val = parseInt(jQuery( this ).attr('value'));
			var tmp_precedent = jQuery( '.sequence' ).get(index+1);
			
			var tmp_val_precedent = parseInt(jQuery(tmp_precedent).attr('value'));
			// var tmp_valplus = parseInt(jQuery( ".sequence" )[index+1].attr("value"));
			
			// Sauvegarder les positions initiales
			if(seq.length<1){
				seq.push(jQuery(this).position().top);
			}
			
			h += jQuery(this);
			// Détecter si on entre dans une nouvelle séquence
			if(t >= tmp_val && (t < tmp_val_precedent || isNaN(tmp_val_precedent))){
				
				// Ajouter une classe si elle n'y est pas
				if(tmp_class.indexOf('played') == -1){
					
					// Test pour voir si on est inférieur à la valeur de la séquence suivante
					jQuery(this).addClass('played');
					if(actu!=this){actu=this;};
					i=index;
					
					if(jQuery(this).text().indexOf("http://") != -1){
						synchroPDF(jQuery(this).find('.sequencetitre').text());
						// window.open(jQuery(this).text(), '_blank');
					}
				}
			}else{
				if(tmp_class.indexOf('played') != -1){
					jQuery(this).removeClass('played');
				}
			}
		});
	// Scroller vers la liste
	if(jQuery(actu).position().top){
		/*jQuery('#sequences').scrollTop(jQuery(actu).position().top - jQuery('#sequences').position().top);*/
			jQuery('#sequences').animate({
					scrollTop: jQuery(actu).position().top - jQuery('#sequences').position().top
			}, 800);
		console.log(jQuery(actu).offset().top, jQuery('#sequences').position().top);
		}
	// jQuery('#sequences').scrollTop(jQuery(this).position().top);
	
}
// CREER UNE LISTE DEROULANTE AVEC DES DONNEES RECUES
function cree_options(str, liste)
	{
		var tmp = str.split(',');
		jQuery.each(tmp, function (index, value) {
			if(value.length > 1 && value.indexOf('=') == -1){
				jQuery(liste).append(jQuery('<option/>', { 
					value: value,
					text : value 
				}));
				console.log(value);
			}
		});
	}
// CREER UNE LISTE DE BOUTONS AVEC DES DONNEES RECUES
function cree_options_boutons(str, form, serie_actu)
	{
		var tmp = str.split(',');
		var actu = '';
		jQuery.each(tmp, function (index, value) {
			if(value.length > 1 && value.indexOf('=') == -1){
				// Si série actuelle trouvée, on lui indique une classe pour la mettre en surbrillance
				if(value == serie_actu){
					actu = 'vert';
				}else{
					actu='rose';
				}
				// Afficher la classe correspondant à la première lettre de la série
				/*tmp_bout = value.substring(0,3).match(/[a-zA-Z]+/);
				if(tmp_bout != null){
					jQuery(form).append("<input type='submit' id='btn_"+index+"' name='liste_series' class='"+tmp_bout+" "+actu+"' value='"+jQuery.trim(value)+"' />");
				}else{*/
					// jQuery(form).append("<input type='submit' id='btn_"+index+"' name='liste_series' class='"+actu+"' value='"+jQuery.trim(value)+"' />");
				jQuery(form).append('<input type="submit" id="btn_'+index+'" name="liste_series" class="'+actu+'" value="'+jQuery.trim(value)+'" />');
				// }
			}
		});
	}
//
function affiche_etiquette(){
		
}

// Fonction pour récupérer une adresse avec la page PDF à afficher
function affichePDF(url){
	console.log(url);
	var params = document.location.href.split("/");
	jQuery('#zonetexte').append("<object data='"+url+"#"+params[params.length-1]+"' type='application/pdf' ><p>Il semble que vous n'ayez pas de plugin de lecture de PDF, merci de télécharger le fichier en cliquant sur ce lien <a href='https://acrobat.adobe.com/fr/fr/acrobat/pdf-reader.html'>TELECHARGER LE FICHIER</a></p></object>");
}

// Cree PDF
function synchroPDF(adr){
	console.log("Adresse iframe", adr);
	jQuery('#synchro').html("<iframe src='"+adr+"' width='100%' height='600px'></iframe>");
}