<script type="text/javascript">
jQuery(document).ready(function() {
	var divide_state_dahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';

	jQuery('.back_to_select_beneficiaries').click(function(){
		jQuery('#divide_estate_select_beneficiaries').show();
		jQuery('#divide_estate_Divide_estate').hide();
	});

	//add charity name with image
	jQuery('body').on('click','.chrityeachdiv', function() {
		var charitname = jQuery(this).find('.charitryname').text();
		var charitryHtml = '<div class="charity_name_image" style="position:relative"><span class="added_chritryName">'+charitname+'</span><p class="type_charity">Charity</p><span id="del_charitydiv" class="delete_pet del_charitydiv"><i class="fa fa-times" aria-hidden="true"></i></span><input type="hidden" name="charitynameImg[]" class="charitynameImg" value="'+charitname+'"></div>';
		jQuery(".charity_additional_div").removeClass("errorAct");
		jQuery("#divide_estate_submit").prop('disabled',false);
		jQuery("#divide_estate_submit").removeAttr('style');
		jQuery("#divide_estate_submit").removeAttr('disabled');
		jQuery('.wf_error_charity_name_hidden').hide();
		jQuery('.devide_partner_added_area').append(charitryHtml);
	});

	//dlete charity 
	jQuery('body').on('click','.del_charitydiv',function(){
		if(!confirm("Do you want to delete?")){
			return false;
		} else {
			jQuery(this).parent().remove();
		}
	});

	//select charity partner
	jQuery(document).find('.charity-items-list').each(function(){
		jQuery(this).click(function(){
			var charityExecName = jQuery(this).text();
			var appnedcharityhtml = '<div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont charity_name_dv"><input name="charitynameImg[]" type="text" class="child_gurdian_names charity_slect_names" id="" disabled value="'+charityExecName+'"><span class="edit_guardian edit_primary_exe_name edit_charity_name_popup" id="edit_primary_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span><span class="delete_pet del_charitydiv"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			jQuery(document).find(".charity_additional_div").removeClass("err_active");
			jQuery("#divide_estate_submit").prop('disabled',false);
			jQuery("#divide_estate_submit").removeAttr('style');
			jQuery("#divide_estate_submit").removeAttr('disabled');
			jQuery('.wf_error_charity_name_hidden').hide();
			jQuery('body').find('.devide_partner_added_area').append(appnedcharityhtml);
			setTimeout(function() {
				jQuery('#sidenav_add_charity').hide();
			},300);
		});
	});

	//open sidenavbar
	jQuery('body').on('click','.add_charitynamewithSideNav', function() {
		jQuery('#sidenav_add_charity').show();
	});

	//close sidenavbar
	jQuery('body').on('click','#sidenav_add_charity .close_add_partner', function() {
		jQuery('#sidenav_add_charity').hide();
	});
	
	//Add new Charity name(partner) in list 
	jQuery('#new_charity_save_btn').click(function(e){
		e.preventDefault();
		if(jQuery('#add_charityname_input').val()==''){
			jQuery('#add_charityname_input').parent().find('.wf_error_mesg').show();
			jQuery("#new_charity_save_btn").prop('disabled',true);
			return false;
		} else{
			jQuery('#add_charityname_input').parent().find('.wf_error_mesg').hide();
			jQuery("#new_charity_save_btn").prop('disabled',false);	
			var charity_name = jQuery('#add_charityname_input').val()		
			var add_charity_userid = jQuery('#add_charityname_userid').val();
			jQuery('.wf_error_guardian_name_hidden').hide();
			jQuery.ajax({
				type : "post",
		        url : divide_state_dahsbaordajax,
		        data : { 'action': 'add_new_charitry_name', 'charity_name':charity_name, 'userid':add_charity_userid},
		        beforeSend: function(){
				    jQuery(document).find("#loader_imagedv_chairtrynane_popup").show();
				    jQuery('#new_charity_save_btn').addClass('submit_disable');
				},
		        success:function(response18){
	        	 	jQuery(document).find("#loader_imagedv_chairtrynane_popup").hide();
				    jQuery('#new_charity_save_btn').removeClass('submit_disable');
	        	 	var resArray = JSON.parse(response18);
	        		if(resArray.msg == 'charityNme_update' || resArray.msg == 'charityNme_added'){
	        			var rtCharityName = resArray.retrunCharity_name;
						var rtappnedCharityhtml = '<div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont charity_name_dv"><input name="charitynameImg[]" type="text" class="child_gurdian_names charity_slect_names" id="" disabled value="'+rtCharityName+'"><span class="edit_guardian edit_primary_exe_name" id="edit_primary_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span><span class="delete_pet del_charitydiv"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						jQuery(".charity_additional_div").removeClass("errorAct");
						jQuery("#divide_estate_submit").prop('disabled',false);
						jQuery("#divide_estate_submit").removeAttr('style');
						jQuery("#divide_estate_submit").removeAttr('disabled');
						jQuery('.wf_error_charity_name_hidden').hide();
						jQuery('body').find('.devide_partner_added_area').append(rtappnedCharityhtml);
						setTimeout(function() {
							jQuery('#add_charityname_input').val('');
							jQuery('#sidenav_add_charity').hide();
						},300);
			       	} 
		        }
		    });
		}
	});

	//validation on key on new add chairty name
	jQuery('body').on('keyup', '#add_charityname_input',function(e){
		if(jQuery('#add_charityname_input').val()==''){
			jQuery('#add_charityname_input').parent().find('.wf_error_mesg').show();
			jQuery("#new_charity_save_btn").prop('disabled',true);
			jQuery("#new_charity_save_btn").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_charityname_input').parent().find('.wf_error_mesg').hide();	
			jQuery("#new_charity_save_btn").prop('disabled',false);
			jQuery("#new_charity_save_btn").removeAttr('style');
			return true		
		}
	}); 


	//Edit charity name on popup
	jQuery("body").on("click", ".edit_charity_name_popup", function(){
	//jQuery('.edit_primary_exe_name').each(function(){
		//jQuery(this).click(function(){
			//jQuery(this).click(function(){
			var editInputval = jQuery(this).parent().find('input').val();
			var editInputIndex = jQuery(this).parent().find('input').attr('data-attr');
			var wf_userid = jQuery('#userid').val();
			var popuphtml = '<div class="modal fade" id="basicModa4" tabindex="-1" role="dialog" aria-labelledby="basicModa4" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index_prm_exec" class="user_index_prm_exec"><input type="hidden" name="user_id" value="'+wf_userid+'" id="user_id"><input type="hidden" name="petguardian_old_name" value="'+editInputval+'" id="charityname_old_name"><input type="text" data-val="'+editInputval+'" name="update_partner_name" id="upd_chirityNameval" class="upd_chirityNameval" value="'+editInputval+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editchaitynameExe" name="upd_action" id="save_editchaitynameExe">Save</button><span id="loader_imagedv_partner_popupdced" class="loader_imagedv_executor_popup" style="display: none;"><img class="image_loader partner_save_loading" src="https://hlblawyers.com.au/wp-content/plugins/willed/assets/images/loader_img.jpg"></span></div></div></div></form></div>';
		 	jQuery('#edit_charity_name_modal').html(popuphtml);
	        jQuery("#basicModa4").modal('show');
			//});
		//});
	});

	//save updated charity name popup
	jQuery('body').on('click','#save_editchaitynameExe', function(e) {
		e.preventDefault();
		var editInputvalcharityExe = jQuery(this).parent().parent().find('#upd_chirityNameval').val();
		var charityname_old_name = jQuery(this).parent().parent().find('#charityname_old_name').val();
		var row_indexid = jQuery(this).parent().parent().find('#user_index_prm_exec').val();
		var wf_userid = jQuery(this).parent().parent().find('#user_id').val();
		if(editInputvalcharityExe.length>0){ 	
			jQuery('#save_editchaitynameExe').removeAttr('style');
			jQuery('#save_editchaitynameExe').prop('disabled',false);
			jQuery('body').find('#edit_charity_name_modal').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : divide_state_dahsbaordajax,
		        data : { 'action': 'upda_charity_nme_name', 'charityExe_val':editInputvalcharityExe, 'userid':wf_userid,'charityExe_old_name':charityname_old_name},
		        beforeSend: function(){
				    jQuery('body').find('#save_editchaitynameExe').parent().find("#loader_imagedv_partner_popupdced").show();
				    jQuery(this).addClass('submit_disable');
				},
		       	success:function(res){	
		       		jQuery(this).parent().find("#loader_imagedv_partner_popupdced").hide();
				    jQuery(this).removeClass('submit_disable');
		        	var resArray = JSON.parse(res);
		        	if(resArray.msg == 'charity_popupDataSave'){
		        	 	jQuery.each(jQuery('.charity_name'), function (index, item) {
	        		 		if(index==row_indexid){
	        		 			jQuery(item).attr('value', resArray.charity_exec_name);
	        		 		} else{
	        		 			jQuery('.charity_slect_names').attr('value', resArray.charity_exec_name);
	        		 			
	        		 		}
					    });
	        			jQuery('#basicModa4').modal('hide');
		        	}
		        }
		    });	
		} else {
			jQuery('document').find('#edit_charity_name_modal').find('.wf_error_mesg').show();	
			jQuery('#save_editchaitynameExe').prop('disabled',true);
			jQuery('#save_editchaitynameExe').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			//jQuery('#wf_edit_pet_type').parent().find('.wf_error_mesg').show();
			return false;   
		}
	});

	//Validation on charity name on popup
	jQuery('body').on('keyup', '.upd_chirityNameval',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal.length>0){ 	
			jQuery('#edit_charity_name_modal').find('.wf_error_mesg').hide();
			jQuery('#save_editchaitynameExe').prop('disabled',false);
			jQuery('#save_editchaitynameExe').removeAttr('style');
		} else {
			jQuery('#edit_charity_name_modal').find('.wf_error_mesg').show();
			jQuery('#save_editchaitynameExe').prop('disabled',true);
			jQuery('#save_editchaitynameExe').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');	
			return false;   
		}
	});



	//save charity name data 
	jQuery(document).on('click', '#divide_estate_submit', function(e) {
		e.preventDefault();
		// jQuery('body').find('.inputnameClass_calculator').each(function() {
  //      		sum += parseFloat(jQuery(this).val()); 
		// });
		// jQuery('body').find('.totalResult').text(sum);


		var wf_userid = jQuery('#userid').val();
	 	if( jQuery(".charity_additional_div").hasClass("err_active") ){
			jQuery('#divide_estate_submit').prop('disabled',true);
			jQuery('#divide_estate_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find('.wf_error_charity_name_hidden').show();
			return false;
		} else {
			var charityname_values = jQuery("input[name='charitynameImg[]']").map(function(){return $(this).val();}).get();
			jQuery.ajax({
				type : "post",
		        url : divide_state_dahsbaordajax,
		        data : { 
		    		'action': 'charityname_data_save',
		    		'wf_userid':wf_userid,
		    		'charity_names':charityname_values
				},
				beforeSend: function(){
				    jQuery('#divide_estate_submit').parent().find("#loader_imagedv_partner_popup").show();
				    jQuery('#divide_estate_submit').addClass('submit_disable');
				},
		    	success: function(response12) {
		    		var myArray = JSON.parse(response12);
		    		jQuery('#divide_estate_submit').parent().find("#loader_imagedv_partner_popup").hide();
				    jQuery('#divide_estate_submit').removeClass('submit_disable');
		    		if(myArray.msg == "charityname_data_saved"){
		    			jQuery('#divide_estate_select_beneficiaries').hide();
						jQuery('#divide_estate_Divide_estate').show();
						//jQuery('#divide_estate_Select_backups').show();
						
						//jQuery('#divide_estate_Divide_estate').load(document.URL +  ' #divide_estate_Divide_estate');
		    		}
		        }
			});
		}
	});

	//Calculator
	//onload
	var sum = 0;
	jQuery('body').find('.add_inputs').keyup(function() {
        sum = 0;
		jQuery('body').find('.inputnameClass_calculator').each(function() {
			jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, '') );
            if(jQuery(this).val() !=''){
               	sum += parseFloat(jQuery(this).val()); 
               	jQuery('#divide_estate_next_submit').prop('disabled',false);
				jQuery('#divide_estate_next_submit').removeAttr('style');
				jQuery(this).parent().parent().find('.wf_error_input_calculator_error').hide();
				jQuery(this).parent().parent().find('.wf_error_total_error').hide();
				//jQuery(this).parent().parent().find('.wf_error_total100_error').hide();
           	} else{
               	jQuery('#divide_estate_next_submit').prop('disabled',true);
				jQuery('#divide_estate_next_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
				jQuery(this).parent().parent().find('.wf_error_total_error').show();
           	}
		});
		jQuery('body').find('.totalResult').text(sum);
		if(sum!=100){
			jQuery('body').find('#divide_estate_next_submit').prop('disabled',true);
			jQuery('body').find('#divide_estate_next_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			//jQuery('body').find('.wf_error_charity_name_hidden').show();
		} else {
			jQuery('body').find('#divide_estate_next_submit').prop('disabled',false);
			jQuery('body').find('#divide_estate_next_submit').removeAttr('style');
		}
	});
 	
	//save divide estate data
	jQuery(document).on('click', '#divide_estate_next_submit', function(e) {
		e.preventDefault();
		var calc_userid = jQuery('#calc_userid').val();
		jQuery('body').find('.inputnameClass_calculator').each(function() {
            if(jQuery(this).val()==''){
               	jQuery('#divide_estate_next_submit').prop('disabled',true);
				jQuery('#divide_estate_next_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
				jQuery(this).parent().parent().find('.wf_error_input_calculator_error').show();
           	} else {
           		jQuery('#divide_estate_next_submit').prop('disabled',false);
				jQuery('#divide_estate_next_submit').removeAttr('style');
				jQuery(this).parent().parent().find('.wf_error_input_calculator_error').hide();
				jQuery(this).parent().parent().find('.wf_error_total_error').hide();
				var single_inputvalue = jQuery("input[name='inputname_calculator[]']").map(function(){return jQuery(this).val();}).get();
				var devide_estate_values = jQuery("input[name='devide_estate_values[]']").map(function(){return jQuery(this).val();}).get();
				var totldevide_div = jQuery('body').find('.calcualtions_div').length; 
				jQuery.ajax({
					type : "post",
			        url : divide_state_dahsbaordajax,
			        data : { 
			    		'action':'devide_estate_data_save',
			    		'userid':calc_userid,
			    		'single_input_num_val':single_inputvalue,
			    		'single_input_name_val':devide_estate_values,
			    		'totldevide_div':totldevide_div,
					},
					beforeSend: function(){
					    jQuery('#divide_estate_next_submit').parent().find("#loader_imagedv_partner_popup").show();
					    jQuery('#divide_estate_next_submit').addClass('submit_disable');
					},
			    	success: function(response19) {
			    		var myArray = JSON.parse(response19);
			    		jQuery('#divide_estate_next_submit').parent().find("#loader_imagedv_partner_popup").hide();
					    jQuery('#divide_estate_next_submit').removeClass('submit_disable');
			    		if(myArray.msg == "devideestate_data_saved"){
			    			jQuery('#divide_estate_Divide_estate').hide();
							jQuery('body').find('#divide_estate_Select_backups').show();
			    			//jQuery('#executor_step2_form').hide();
			    			//jQuery('#executor_step3_form').show();
			    		}
			        }
				});
           	}
		});
	});

	jQuery(document).on('click', '#divide_estate_select_backups_submit', function(e) {
		e.preventDefault();
	  	
	 	if(!$('input[name=select_backup]').is(':checked') ) {
	 		jQuery('.select_option_divs').find('.wf_error_mesg').show();
	 		jQuery('#divide_estate_select_backups_submit').prop('disabled',true);
			jQuery('#divide_estate_select_backups_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
	 	} else {
	 		setTimeout(function() {
	  			jQuery('#divide_estate_select_backups_submit').parent().find("#loader_imagedv_partner_popup").show();
	    		jQuery('#divide_estate_select_backups_submit').addClass('submit_disable');

 	 		}, 200);			
			var base_url = window.location.origin;
			nextpageurl = base_url+'/wfdashboard/?'+'will=gifts';
			window.location.replace(nextpageurl);
		}
	});

	jQuery('.select_bkp_option').change(function(){
		jQuery('body').find('.select_option_inner ').removeClass('actioveRadio');
		jQuery(this).parent().parent().addClass('actioveRadio');

		var selected_bkp_value = jQuery("input[name='select_backup']:checked").val(); 
		if(selected_bkp_value.length!=''){
	   		jQuery('.select_option_divs').find('.wf_error_mesg').hide();	   		
	   		jQuery('#divide_estate_select_backups_submit').prop('disabled',false);
			jQuery('#divide_estate_select_backups_submit').removeAttr('style');
		} else{
			jQuery('#divide_estate_select_backups_submit').prop('disabled',true);
			jQuery('#divide_estate_select_backups_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.select_option_divs').find('.wf_error_mesg').show();
		}
    });



}); //document end
</script>