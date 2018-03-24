//Permet de rendre accessible la recherche par temps quand on clic sur la case à cocher correspondante
jQuery.noConflict();
jQuery(document).ready(function () {
    jQuery("#validSearchDate").click(function () {
        if(jQuery("#minDate").attr("disabled") == "disabled" && jQuery("#maxDate").attr("disabled") == "disabled"){
            jQuery("#minDate").removeAttr("disabled");
            jQuery("#maxDate").removeAttr("disabled");
        }
        else{
            jQuery("#minDate").attr("disabled", "disabled");
            jQuery("#maxDate").attr("disabled", "disabled");
        }
    });
});