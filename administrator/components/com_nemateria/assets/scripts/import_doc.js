jQuery.noConflict();

jQuery(document).ready(function() {
    if(jQuery('#jform_id_notice').val()){
            var id_notice = jQuery('#jform_id_notice').val();
        }
  jQuery('#file_upload').uploadify({
    'uploader'  : 'components/com_nemateria/helpers/uploadify/uploadify.swf',
    'script'    : 'components/com_nemateria/helpers/uploadify/uploadify.php',
    'cancelImg' : 'components/com_nemateria/assets/images/cancel.png',
    'folder'    : '../images/nemateria/medias/'+jQuery('#jform_id_notice').val(),
    'auto'      : true,
    'onComplete' : function(event,ID,fileObj,data) {
      var my_doc = '';
      if(jQuery('#jform_id_notice').val()){
            var id_notice = jQuery('#jform_id_notice').val();
        }
      if(fileObj.type == '.jpg' || fileObj.type == '.png'){
          my_doc = '<a href="images/nemateria/medias/'+id_notice+'/'+fileObj.name+'" rel="shadowbox['+'galery_'+id_notice+']" title="'+fileObj.name+'">'+fileObj.name+'</a>';
      }
      if(fileObj.type == '.pdf'){
          my_doc = '<a href="http://docs.google.com/gview?embedded=true&url=images/nemateria/medias/'+id_notice+'/'+fileObj.name+'" rel="shadowbox['+'galery_'+id_notice+']" title="'+fileObj.name+'">'+fileObj.name+'</a>';
      }
      if(fileObj.type == '.mp4' || fileObj.type == '.flv' || fileObj.type == '.swf'|| fileObj.type == '.mp3'){
          my_doc = '<a href="images/nemateria/medias/'+id_notice+'/'+fileObj.name+'" rel="shadowbox['+'galery_'+id_notice+'];height=800;width=600" title="'+fileObj.name+'">'+fileObj.name+'</a>';
      }
      
      var my_docs = jQuery('#jform_local_link').val()+my_doc;
      jQuery('#jform_local_link').val(my_docs);
    }
  });
});