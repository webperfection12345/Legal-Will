<script type="text/javascript">
jQuery(document).ready(function() {
	var dahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';
	/******************About submit********************/
	jQuery(document).on('click', '#about_submit', function(e) {
		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		var wf_first_name = jQuery('#wf_first_name').val();
		var wf_middle_name = jQuery('#wf_middle_name').val();
		var wf_last_name = jQuery('#wf_last_name').val();
		var wf_dob_day = jQuery('#wf_dob_day').val();
		var wf_dob_month = jQuery('#wf_dob_month').val();
		var wf_dob_year = jQuery('#wf_dob_year').val();
		var wf_google_address = jQuery('#wf_google_address').val();
		var wf_phone = jQuery('#wf_phone').val();
		if(wf_first_name ==''){
			jQuery('#wf_first_name').addClass('wf_error');
			jQuery('#wf_first_name').parent().find('.wf_error_mesg').show();
		}

		if(wf_last_name ==''){
			jQuery('#wf_last_name').addClass('wf_error');
			jQuery('#wf_last_name').parent().find('.wf_error_mesg').show();
		}

		if(wf_dob_day ==''){
			jQuery('#wf_dob_day').addClass('wf_error');
			jQuery('#wf_dob_day').parent().find('.wf_error_mesg').show();
		}

		if(wf_dob_month ==''){
			jQuery('#wf_dob_month').addClass('wf_error');
			jQuery('#wf_dob_month').parent().find('.wf_error_mesg').show();
		}

		if(wf_dob_year ==''){
			jQuery('#wf_dob_year').addClass('wf_error');
			jQuery('#wf_dob_year').parent().find('.wf_error_mesg').show();
		}

		if(wf_google_address ==''){
			jQuery('#wf_google_address').addClass('wf_error');
			jQuery('#wf_google_address').parent().find('.wf_error_mesg').show();
		}


		if(wf_first_name =='' || wf_last_name =='' || wf_dob_day =='' || wf_dob_month =='' || wf_dob_year =='' || wf_google_address =='' ){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else {
			jQuery(this).prop('disabled',false);
			jQuery(this).removeAttr('style');

			jQuery.ajax({
				type : "post",
		        url : dahsbaordajax,
		        data : { 
		    		'action': 'about_dashboard',
		    		'wf_userid':wf_userid,
		    		'wf_first_name':wf_first_name,
		    		'wf_middle_name':wf_middle_name,
		    		'wf_last_name':wf_last_name,
		    		'wf_dob_day':wf_dob_day,
		    		'wf_dob_month':wf_dob_month,
		    		'wf_dob_year':wf_dob_year,
		    		'wf_google_address':wf_google_address,
		    		'wf_phone':wf_phone,
				},
				beforeSend: function(){
				    jQuery("#loader_imagedv").show();
				    jQuery('#about_submit').addClass('submit_disable');
				},
		    	success: function(response) {
		    		jQuery("#loader_imagedv").hide();
				    jQuery('#about_submit').removeClass('submit_disable');
		    		if(response == "about_updated"){
		    			var base_url = window.location.origin;
						nextpageurl = base_url+'/wfdashboard/?'+'will=partner';
		    			window.location.replace(nextpageurl);
		    		}
		        }
			});
		}
	});

	var style = 'border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;';
	jQuery('body').on('keyup','#wf_first_name', function() {
		var fnamelength = this.value.length;
	   	if(fnamelength > 0){
	   		jQuery(this).removeClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').hide();
	   		jQuery('#about_submit').prop('disabled',false);
			jQuery('#about_submit').removeAttr('style');

		} else{
			jQuery(this).addClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#about_submit').prop('disabled',true);
			jQuery('#about_submit').attr('style',style);
		}
	}); 

	jQuery('body').on('keyup','#wf_last_name', function() {
		var lnamelength = this.value.length;
	   	if(lnamelength > 0){
	   		jQuery(this).removeClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#about_submit').prop('disabled',false);
			jQuery('#about_submit').removeAttr('style');
		} else{
			jQuery(this).addClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#about_submit').prop('disabled',true);
			jQuery('#about_submit').attr('style',style);
		}
	}); 

	jQuery('body').on('keyup','#wf_dob_day', function(event) {
		this.value = this.value.replace(/[^0-9]/g, '');
		var dbdaylength = this.value.length;
	   	if(dbdaylength > 0){
	   		jQuery(this).removeClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#about_submit').prop('disabled',false);
			jQuery('#about_submit').removeAttr('style');
		} else{
			jQuery(this).addClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#about_submit').prop('disabled',true);
			jQuery('#about_submit').attr('style',style);
		}
	}); 

	jQuery('body').on('keyup','#wf_dob_month', function(event) {
		this.value = this.value.replace(/[^0-9]/g, '');
		var dbmonthlength = this.value.length;
	   	if(dbmonthlength > 0){
	   		jQuery(this).removeClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#about_submit').prop('disabled',false);
			jQuery('#about_submit').removeAttr('style');
		} else{
			jQuery(this).addClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#about_submit').prop('disabled',true);
			jQuery('#about_submit').attr('style',style);
		}
	}); 

	jQuery('body').on('keyup','#wf_dob_year', function(event) {
		this.value = this.value.replace(/[^0-9]/g, '');
		var dbyearlength = this.value.length;
	   	if(dbyearlength > 0){
	   		jQuery(this).removeClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#about_submit').prop('disabled',false);
			jQuery('#about_submit').removeAttr('style');
		} else{
			jQuery(this).addClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#about_submit').prop('disabled',true);
			jQuery('#about_submit').attr('style',style);
		}
	}); 

	jQuery('body').on('keyup','#wf_google_address', function() {
		var addresslength = this.value.length;
	   	if(addresslength > 0){
	   		jQuery(this).removeClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#about_submit').prop('disabled',false);
			jQuery('#about_submit').removeAttr('style');
		} else{
			jQuery(this).addClass('wf_error');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#about_submit').prop('disabled',true);
			jQuery('#about_submit').attr('style',style);
		}
	}); 

	var searchInput = 'wf_google_address';
 	var autocomplete;
	autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
		types: ['geocode'],
	});



}); //document end
</script>