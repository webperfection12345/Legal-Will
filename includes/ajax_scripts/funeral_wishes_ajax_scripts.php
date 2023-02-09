<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('.funeral_wishes_options label').on('click', function(){
		    jQuery('.funeral_wishes_options label.relation_active').removeClass('relation_active');
		    jQuery(this).addClass('relation_active');
		});
	});

// On Funeral Submit button
jQuery(document).ready(function() {
	var funeraldahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';
	/******************Funeral Wishes Submit********************/
	// 	var relsts = jQuery('input[name="funeral_wishes_status"]:checked').val();
	// console.log(relsts); 
	// if(relsts=='cremated' || relsts=='donatetosci'  ){
	// 	jQuery('.married_addtional').show(); 
	// } else {
	// 	jQuery('.married_addtional').hide();
	// }
		jQuery(document).on('click', '#funeral_wishes_submit', function(e) {

		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		var wf_funeral_val = jQuery('input[name=funeral_wishes_status]:checked').val();
		var funeral_wishes_textarea = jQuery('#funeral_wishes_textarea').val();
		//var wf_partner_name_hiden = jQuery('#partner_name_hiden').val();
		var isChecked = jQuery('.funeral_wishes_status').prop('checked');
		if(! jQuery('input[name=funeral_wishes_status]:checked').val() ){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.funeral_wishes_options').find('.wf_error_mesg').show();
			return false;
		} 
		 else {
			jQuery(this).prop('disabled',false);
			jQuery(this).removeAttr('style');
			jQuery.ajax({
				type : "post",
		        url : funeraldahsbaordajax,
		        data : { 
		    		'action': 'funeral_dashboard',
		    		'wf_userid':wf_userid,
		    		'wf_funeral_status':wf_funeral_val,
		    		'funeral_wishes_textarea':funeral_wishes_textarea 
				},
				beforeSend: function(){
				    jQuery("#loader_imagedv").show();
				    jQuery('#about_submit').addClass('submit_disable');
				},
		    	success: function(response) {
		    		//console.log(response.msg)
		    		 var myArray = JSON.parse(response);
		    		jQuery("#loader_imagedv").hide();
				    jQuery('#about_submit').removeClass('submit_disable');
		    		if(myArray.msg == "funeral_updated"){
		    			var base_url = window.location.origin;
						nextpageurl = base_url+'/wfdashboard/';
		    			window.location.replace(nextpageurl);
		    		}
		        }
			});
		}
	});

	jQuery('.funeral_wishes_status').change(function(){
		var selected_value = jQuery("input[name='funeral_wishes_status']:checked").val(); 
		if(selected_value.length!=''){
	   		jQuery('.funeral_wishes_options').find('.wf_error_mesg').hide();	   		
	   		jQuery('#funeral_wishes_submit').prop('disabled',false);
			jQuery('#funeral_wishes_submit').removeAttr('style');
		} else{
			jQuery('#funeral_wishes_submit').prop('disabled',true);
			jQuery('#funeral_wishes_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.funeral_wishes_options').find('.wf_error_mesg').show();
		}
    });
  });


</script>

