jQuery.noConflict();

jQuery(document).ready(function () {
    jQuery("#start_btn").click(function () { getIMG()});   
     });

function getIMG() {
        
        if(jQuery('.last_rt').last().val() && jQuery('.last_rt').last().val() != 'end'){
            var rT = jQuery('.last_rt').last().val();
            id = rT;
        }
        else{
            id = 0;
        }
        

        jQuery.ajax({
            type : 'POST', // envoi des données en GET ou POST
            url : 'index.php?option=com_nemateria&task=import_img.start&tmpl=component' , // url du fichier de traitement
            data : 'q='+id , // données à envoyer en  GET ou POST
            beforeSend : function() { // traitements JS à faire AVANT l'envoi
                jQuery('#load').html('<img src="components/com_nemateria/assets/images/ajax-loader.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
            },
            success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
                jQuery('.import_progress_container:last').html(data); // affichage des résultats dans le bloc
                jQuery('.import_progress_container:last').after('<div class="import_progress_container" style="float:left; width:100%;"></div>');
                if(jQuery('.last_rt').last().val() != null && jQuery('.last_rt').last().val() != 'end'){
                    getIMG()
                }
                else{
                    jQuery('#ajax-loader').remove();
                    var gettotal = 0;//nombre total de notice
                    jQuery(".tot_img").each(function(){
                        gettotal = gettotal + parseInt(jQuery(this).val());
                      });
                    var geterror = 0;//nombre total de notice
                    jQuery(".tot_error").each(function(){
                        geterror = geterror + parseInt(jQuery(this).val());
                      });
                    var message = ('<p>Les opérations suivantes ont été effectués:<br/>'
                        +gettotal+' images traitées,<br/>'
                        +geterror+' imports n\'ont pas abouties.');
                    jQuery('#load').html(message) // affichage des infos a la place du loader
                    return;
                }
            }
         });
}