jQuery(document).ready(function() {

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
		        url : dahsbaordajax.ajaxurl,
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
		    	success: function(response) {
		    		console.log(response)
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




	/******************Partners submit********************/
	var relsts = jQuery('input[name="relationship_status"]:checked').val();
	//alert(relsts);
	if(relsts=='married' || relsts=='defacto'  ){
		jQuery('.married_addtional').show(); 
	} else {
		jQuery('.married_addtional').hide();
	}


	jQuery(document).on('click', '#parnter_submit', function(e) {
		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		var wf_relates_status = jQuery('input[name=relationship_status]:checked').val();
		var wf_partner_name = jQuery('input[name=partner_name]').val();
		var isChecked = jQuery('.relationship_status').prop('checked');
		if( wf_relates_status ==''){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.martital_status_options').find('.wf_error_mesg').show();

			return false;
		}  else {
			jQuery(this).prop('disabled',false);
			jQuery(this).removeAttr('style');
			jQuery.ajax({
				type : "post",
		        url : dahsbaordajax.ajaxurl,
		        data : { 
		    		'action': 'partner_dashboard',
		    		'wf_userid':wf_userid,
		    		'wf_relates_status':wf_relates_status,
				},
		    	success: function(response) {
		    		console.log(response)
		    		if(response == "partner_updated"){
		    			var base_url = window.location.origin;
						nextpageurl = base_url+'/wfdashboard/?'+'will=children';
		    			window.location.replace(nextpageurl);
		    		}
		        }
			});
		}
	});

	jQuery('.relationship_status').change(function(){
		var selected_value = jQuery("input[name='relationship_status']:checked").val(); 
		if(selected_value.length!=''){
	   		jQuery('.martital_status_options').find('.wf_error_mesg').hide();	   		
	   		jQuery('#parnter_submit').prop('disabled',false);
			jQuery('#parnter_submit').removeAttr('style');
		} else{
			jQuery('#parnter_submit').prop('disabled',true);
			jQuery('#parnter_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.martital_status_options').find('.wf_error_mesg').show();
		}
    });


	jQuery('.relationship_status').change(function(){
		var relsts = jQuery('input[name="relationship_status"]:checked').val();
		if(relsts=='married' || relsts=='defacto'  ){
			jQuery('.married_addtional').show(); 
		} else {
			jQuery('.married_addtional').hide();
		}
	});

	jQuery('.add_additional_partner').click(function(){
		jQuery('.sidenav_add_partner').show(); 
	});
	jQuery('.add_additional_gift').click(function(){
		jQuery('.sidenav_add_partner').show(); 
	});
	jQuery('.close_add_partner').click(function(){
		jQuery('.sidenav_add_partner ').css('display','none');
	}); 

	//partners save 
	jQuery('#partner_save_btn').click(function(){
		var marid_defactioval = jQuery('input[name="relationship_status"]:checked').val();
		var partnername = jQuery('#add_partner_input').val();
		var relationship_status = jQuery('input[name="relationship_status"]:checked').val();
		var add_partner_userid = jQuery('#add_partner_userid').val();
		var partnerhtml = '<input type="hidden" value="'+partnername+'" name="add_partner_name[]"><p class="parnterlist">'+partnername+'</p>';
		jQuery('.multiple_partners_area').append(partnerhtml);
		jQuery('#add_partner_input').val('');
		var indexval = '';
		jQuery.ajax({
			type : "post",
	        url : dahsbaordajax.ajaxurl,
	        data : { 'action': 'save_partners', 'partnername':partnername, 'userid':add_partner_userid,'relationship_status':relationship_status},
	        success:function(response3){
	        	location.reload(true);
	        	//location.replace(document.URL); 	
        		indexval = '0';
	        	console.log(response3);	   
        		if(response3 == 'patner_added'){
		        	var partner_addedhtml ='<input type="text" name="partner_name" id="partner_name" class="partner_name" value="'+partnername+'" ><span data-attr="'+indexval+'" data-value="'+partnername+'" data-id="'+add_partner_userid+'" id="update_partner_name">Edit</span>';
		        	//jQuery('.partner_added').html(partner_addedhtml);
		       	} else {

		       		var partner_addedhtml ='<input type="text" name="partner_name" id="partner_name" class="partner_name" value="'+partnername+'" ><span data-attr="'+response3+'" data-value="'+partnername+'" data-id="'+add_partner_userid+'" id="update_partner_name">Edit</span>';
		        	//jQuery('.partner_added').html(partner_addedhtml);

		       	}
	        }
	    });	
	}); 

	//editor in popup
	jQuery('body').on('click','#partner_name', function(){
		var data_id = jQuery(this).attr('data-id');
		var data_partner = jQuery(this).attr('data-value');
		var data_index = jQuery(this).attr('data-attr');
		var popuphtml = '<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"> <h3>Full legal name</h3><form action="" method="post"><input type="hidden" name="index" value="'+ data_index +'" id="user_index"><input type="hidden" name="user_id" value="'+data_id+'" id="user_id"><input type="text" data-val="'+data_partner+'" name="update_partner_name" id="upd_partner_name" class="upd_partner_name" value="'+data_partner+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editpartner" name="upd_action" id="save_editpartner">Save</button></form></div></div></div></div>';
		 	jQuery('#edit_partner_name_modal').html(popuphtml);
            jQuery("#basicModal").modal('show');
	});

	//save updated partner name
	jQuery('body').on('click','#save_editpartner', function(e) {
		e.preventDefault();
		var upd_partnername = jQuery('#partner_name').val();
		if( upd_partnername ==''){
			jQuery('#edit_partner_name_modal').find('.wf_error_mesg').show();
			return false;
		}
		var item_index = jQuery('#user_index').val();
		var partner_userid = jQuery('#user_id').val();
		jQuery.ajax({
			type : "post",
	        url : dahsbaordajax.ajaxurl,
	        data : { 'action': 'upd_partners', 'upd_partnername':upd_partnername, 'partner_userid':partner_userid, 'item_index':item_index},
	        success:function(response4){	        	
	        	//console.log(response4);
	        	if(response4 == 'edit_partner_upd'){
	        		location.reload(true);
	        	}
	        }
	    });	
	});

	//edit partner name on popup
	jQuery('body').on('keyup', '#upd_partner_name',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal.length>0){ 	
			jQuery('#edit_partner_name_modal').find('.wf_error_mesg').hide();
		} else {
			jQuery('#edit_partner_name_modal').find('.wf_error_mesg').show();	
			return false;   
		}
		jQuery('#partner_name').val(upd_partVal);
	});

	jQuery('.p-items-list').each(function(){
		jQuery(this).click(function(){
			var usrID = jQuery(this).attr('data-attr');
			var partnrname = jQuery(this).attr('data-value');
			var index_num = jQuery(this).attr('data-id');
			console.log(usrID + partnrname +index_num );
			jQuery('body').find('#partner_name').attr('value', partnrname);
			jQuery('body').find('#partner_name').attr('data-value', partnrname);
			jQuery('body').find('#partner_name').attr('data-attr', index_num);
			jQuery('body').find('#partner_name').attr('data-id', usrID);			
		})
	});


}); //document end