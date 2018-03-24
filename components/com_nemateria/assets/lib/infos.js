// JavaScript Document
if (typeof jQuery !== 'undefined') {
  // console.log( $(document)+"document loaded "+$( "#zoneinfos" ));
}
// AU CHARGEMENT, LES FENETRES D'INFOS SONT ACTIVEES
$(document).ready(function($) {
	$("#titreinfos").click(function() {
		if( parseInt($("#zoneinfos").css( "right" )) < 0){
			$("#zoneinfos").animate({
				right: 10
			  }, 1000, function() {
				// Animation complete.
			  });
		}else{
			$("#zoneinfos").animate({
				right: -600
			  }, 1000, function() {
				// Animation complete.
			  });
		}
		
	});
	
	// Retour vers une série
	$('.retour_collections').click(function () {
			window.location.href = "http://www.immaterielles.org/index.php/liste-inedites";
			return false;
		});
	// Retour vers une série
	$('.retour_serie').click(function () {
			window.location.href = window.location.href.substring(0, window.location.href.indexOf('/record'));
			return false;
		});
		
	// Retour en arrière
	$('.retour_precedent').click(function () {
			window.history.back();
			return false;
		});
	// Retour en arrière
	$('.retour_precedent_images').click(function () {
			window.history.go(-2);
			return false;
		});
	 // Gérer les onglets des données
	 $('.tabs .tab-links a').on('click', function(e)  {
        var currentAttrValue = $(this).attr('href');
		
        // Show/Hide Tabs
        $('.tabs ' + currentAttrValue).show().siblings().hide();
 
        // Change/remove current tab to active
        $(this).parent('li').addClass('active').siblings().removeClass('active');
 
        e.preventDefault();
    });
	// Afficher la couleur du bouton en fonction de la présence de liens sur les boutons des documents liés
	if($('#docslies').find('a').length){
			$('#docslies').addClass('vert');
		}else{
			$('#docslies').addClass('gris');
		}
	// Gérer la liste des documents liés à une série : afficher une lightbox
	$('#docslies').on('click', function() {
		$(this).find('div').fadeToggle();
	});
});


