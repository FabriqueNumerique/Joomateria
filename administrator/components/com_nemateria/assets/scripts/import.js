jQuery.noConflict();

jQuery(document).ready(function () {
    jQuery("#input_start").datepicker();
    jQuery("#input_end").datepicker();
	console.log(jQuery("#start_btn"));
    jQuery("#start_btn").click(function () { getXML()});
});

function getXML() {
	console.log("Start cliqué");
        //Vérification des checkbox
        if(jQuery("input:checked", window.parent.document).val() == undefined){
            var mess_no = "Vous devez cocher une collection à importer.";
            jQuery('.import_progress_container:last').html(mess_no);
            return; 
        }
        if((jQuery("input:checked", window.parent.document).length) >= 2){
            var mess_much = "Vous devez cocher une seule collection à la fois.";
            jQuery('.import_progress_container:last').html(mess_much);
            return; 
        }
        var id = jQuery("input:checked", window.parent.document).val();
        
        if(jQuery('.last_rt').last().val() && jQuery('.last_rt').last().val() != 'end'){
            var rT = jQuery('.last_rt').last().val();
            id = id+'&t='+rT;
        }
        if(jQuery('#input_start').val()){
            var input_start = jQuery('#input_start').val();
            id = id+'&start='+input_start;
        }
        if(jQuery('#input_end').val()){
            var input_end = jQuery('#input_end').val();
            id = id+'&end='+input_end;
        }
        if(jQuery('input:checked').length > 0){
            var input_force = "checked";
            id = id+'&force='+input_force;
        }
        

        jQuery.ajax({
            type : 'POST', // envoi des données en GET ou POST
//            url : 'index.php?option=com_nemateria&controller=import&task=start&tmpl=component' , // url du fichier de traitement
            url : 'index.php?option=com_nemateria&task=import.start&tmpl=component' , // url du fichier de traitement
            data : 'q='+id , // données à envoyer en  GET ou POST
            beforeSend : function() { // traitements JS à faire AVANT l'envoi
                jQuery('#load').html('<img src="components/com_nemateria/assets/images/ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
            },
            success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
                jQuery('.import_progress_container:last').html(data); // affichage des résultats dans le bloc
                jQuery('.import_progress_container:last').after('<div class="import_progress_container" style="float:left; width:100%;"></div>');
                if(jQuery('.last_rt').last().val() != null && jQuery('.last_rt').last().val() != 'end'){
                    getXML()
                }
                else{
                    jQuery('#ajax-loader').remove();
                    var i = 0;
                    var getrapport = 0;//nombre total de notice
                    jQuery(".xml_rapport").each(function(){
                        getrapport = getrapport + 1;
                        i++;
                        jQuery(this).text('Rapport page : '+i);
                      });

                    var gettotal = 0;//nombre total de notice
                    jQuery(".total").each(function(){
                        gettotal = gettotal + parseInt(jQuery(this).val());
                      });
                    var getnew = 0;//nombre de balises des notices importées
                    jQuery(".new").each(function(){
                        getnew = getnew + parseInt(jQuery(this).val());
                      });
                    var getmaj = 0;//nombre de balises des notices maj
                    jQuery(".maj").each(function(){
                        getmaj = getmaj + parseInt(jQuery(this).val());
                      });
                    var getnotmaj = 0;//nombre de balises des notices pas maj
                    jQuery(".notmaj").each(function(){
                        getnotmaj = getnotmaj + parseInt(jQuery(this).val());
                      });
                    var getlocked = 0;//nombre de balises des notices importées
                    jQuery(".locked").each(function(){
                        getlocked = getlocked + parseInt(jQuery(this).val());
                      });
                    var message = ('<p>Les opérations suivantes ont été effectués:<br/>'
                        +getrapport+' pages ont été parcourut,<br/>'
                        +gettotal+' notices ont été importés,<br/>'
                        +getnew+' nouvelles notices,<br/>'
                        +getmaj+' notices mises à jour,<br/>'
                        +getnotmaj+' notices était à jour<br/>'
                        +getlocked+' locked.</p>');
                    jQuery('#load').html(message) // affichage des infos a la place du loader
                    return;
                }
            }
         });
}