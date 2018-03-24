
function getStore() {
	
        var url;
        var conf;
        url = jQuery('#jform_url').val();
        conf = jQuery('#jform_config').val();
        jQuery.ajax({
            type : 'GET', // envoi des données en GET ou POST
//            url : 'index.php?option=com_l21oai25&controller=import&task=start&tmpl=component' , // url du fichier de traitement
            url : "index.php?option=com_nemateria&task=store.start&tmpl=component",
            data : 'url='+url+'&config='+conf ,
            dataType : 'json',
            success : function(data){
                jQuery('#jform_granularity').val(data[0].granularity);
                jQuery('#jform_title').val(data[0].repositoryName);
                jQuery('#jform_mail').val(data[0].adminEmail);
                jQuery('#jform_description').val(data[0].description[0]);
                jQuery('#jform_identifier').val(data[0].relation[0]);
                jQuery('#jform_earliestDatestamp').val(data[0].earliestDatestamp);
            }});
}
