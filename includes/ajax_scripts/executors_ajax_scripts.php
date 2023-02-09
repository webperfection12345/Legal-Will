<script type="text/javascript">
jQuery(document).ready(function() {
	//var searchInputvvv = jQuery(document).find('#identify_exec_addresst');
	var executor_dahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';
	/***************************Pets submit*****************************/


	/****************End primary executors******************/
	//next sections
	jQuery('#executor_continue_btn').click(function(){
		jQuery('#executor_step2_form').show();
		jQuery('#executor_step1_form').hide();
	});
	//previous section 
	jQuery('.back_to_main_executor').click(function(){
		jQuery('#executor_step1_form').show();
		jQuery('#executor_step2_form').hide();
	});
	jQuery('.back_to_primary_executors').click(function(){
		jQuery('#executor_step2_form').show();
		jQuery('#executor_step3_form').hide();
	});

	jQuery('.back_to_backup_executors').click(function(){
		jQuery('#executor_step3_form').show();
		jQuery('#executor_step4_form').hide();
		jQuery('body').find('.gardian_added_indetiyf').html('');
	});



	//==============================================================================//
	/**********************************PRIMARY EXECUTORS***************************/
	//==============================================================================//
	var prmexistDivlength = jQuery('body').find('.add_form_primary .primary_exec_names_div').length;
	var bkpexistDivlength = jQuery('body').find('.add_form_backup .primary_exec_names_div_bkp').length;
	if(prmexistDivlength>2){
		jQuery(".add_form_primary .add_additional_partner").addClass("primary_exec_disabled");
	}
	if(bkpexistDivlength>2){
		jQuery(".add_form_backup #add_primary_executor_bkp").addClass("primary_exec_disabled");
	}

	jQuery('body').on('click','#add_primary_executor', function(){
		jQuery('#sidenav_add_primary_executor').show(); 
	});
	jQuery('.close_primary_executor').click(function(){
		jQuery('#sidenav_add_primary_executor ').css('display','none');
	}); 

	//Add primary executor data
	jQuery(document).on('click', '#primary_exec_submit', function(e) {
		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		var existDivlength = jQuery('body').find('.add_form_primary .primary_exec_names_div').length;
		if(existDivlength>0){
			jQuery(".primary_exector_addtional").removeClass("err_active");
		}
	 	if( jQuery(".primary_exector_addtional").hasClass("err_active") ){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find('.add_form_primary .wf_error_mesg').show();
			return false;
		} else {
			var primary_execus_values = jQuery('body').find(".add_form_primary input[name='primary_executors[]']").map(function(){return $(this).val();}).get();
			jQuery('body').find('.add_form_primary').hide();
			jQuery('body').find('.add_form_backup').show();
			jQuery('body').find('.add_form_backup #hold_allPrimaryExecutors').val(primary_execus_values);
		}
	});

	//select primary Executor
	jQuery(document).find('.primar_exe_items_list').each(function(){
		jQuery(this).click(function(){
			var countprimaryExec = jQuery('body').find(".primary_executor_main_name_addtional").find(".primary_exec_names_div").length;
			var increaseIndexofDivs = jQuery(".gardian_added .primary_exec_names_div ").last().find('input').attr('data-index');
			var increaseIndexofDiv = parseInt(increaseIndexofDivs) + 1;
			jQuery('body').find(".primary_exector_addtional").removeClass("err_active");
			jQuery('body').find('.add_form_primary .wf_error_mesg').hide();
		 	jQuery("#primary_exec_submit").prop('disabled',false);
		 	jQuery("#primary_exec_submit").removeAttr('style');
		 	jQuery('body').find('.add_form_primary .wf_error_executor_name_hidden').hide();
			if(countprimaryExec>0){
				jQuery('body').find(".primary_exector_addtional").removeClass("err_active");
				jQuery("#primary_exec_submit").prop('disabled',false);
				jQuery("#primary_exec_submit").removeAttr('style');
				jQuery('body').find('.add_form_primary #add_primary_executor .wf_error_executor_name_hidden').hide();
			}
			if(countprimaryExec>=2){
				jQuery('.primary_executor_main_name_addtional').find('#add_primary_executor').addClass('primary_exec_disabled');
				jQuery(document).find('.primary_executor_main_name_addtional').removeClass('err_active');
			} 
			var primarExecName = jQuery(this).text();
			var appnedGuradnhtml = '<div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont"><input name="primary_executors[]" data-index="'+increaseIndexofDiv+'" type="text" class="parent_exec_nm_val child_gurdian_names" id="petgudrianname" disabled value="'+primarExecName+'"><span class="edit_primary_exe_name" id="edit_primary_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="del_primary_exe_name" class="delete_pet del_primary_exe_name"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			jQuery(".primary_executor_main_name_addtional").removeClass("errorAct");
			jQuery('body').find('.gardian_added').append(appnedGuradnhtml);
			setTimeout(function() {
				jQuery('#sidenav_add_primary_executor').hide();
			},30);
		});
	});

	//Add new Executor(partner) in list 
	jQuery('#primary_exe_new_save_btn').click(function(e){
		e.preventDefault();
		if(jQuery('#add_prm_execText_input').val()==''){
			jQuery('#add_prm_execText_input').parent().find('.wf_error_mesg').show();
			jQuery("#primary_exe_new_save_btn").prop('disabled',true);
			jQuery("#primary_exe_new_save_btn").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_prm_execText_input').parent().find('.wf_error_mesg').hide();	
			var partnernameexe = jQuery('#add_prm_execText_input').val()		
			var add_partner_userid = jQuery('#add_prm_exe_userid').val();
			jQuery('.wf_error_guardian_name_hidden').hide();
			jQuery.ajax({
				type : "post",
		        url : executor_dahsbaordajax,
		        data : { 'action': 'add_new_prm_exec', 'partnername':partnernameexe, 'userid':add_partner_userid},
		        beforeSend: function(){
				    jQuery('#primary_exe_new_save_btn').parent().find(".loader_imagedv_primary_exe_popup").show();
				    jQuery('#primary_exe_new_save_btn').addClass('submit_disable');
				},
		        success:function(response16){
	        	 	jQuery('#primary_exe_new_save_btn').parent().find(".loader_imagedv_primary_exe_popup").hide();
				    jQuery('#primary_exe_new_save_btn').removeClass('submit_disable');
	        	 	var resArray = JSON.parse(response16);
	        		if(resArray.msg == 'prm_exec_update' || resArray.msg == 'prm_exec_update'){
	        			var rtprimarExecName = resArray.retrunPrm_exec_name;
	        			var rtcountprimaryExec = jQuery(document).find(".primary_executor_main_name_addtional").find(".primary_exec_names_div").length;
						if(rtcountprimaryExec==0){
							jQuery("#primary_exec_submit").prop('disabled',false);
							jQuery("#primary_exec_submit").removeAttr('style');
							jQuery("#primary_exec_submit").removeAttr('disabled');
							jQuery('body').find('.add_form_primary .wf_error_mesg').hide();
						} else if(rtcountprimaryExec>=2){
							jQuery('.primary_executor_main_name_addtional').find('#add_primary_executor').addClass('primary_exec_disabled');
							jQuery('body').find(".primary_exector_addtional").removeClass("err_active");
						} 
						var increaseIndexofDivs = jQuery(".gardian_added .primary_exec_names_div ").last().find('input').attr('data-index');
						var increaseIndexofDiv = parseInt(increaseIndexofDivs) + 1;
						var rtappnedGuradnhtml = '<div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont"><input name="primary_executors[]" type="text" data-index="'+increaseIndexofDiv+'" class="parent_exec_nm_val child_gurdian_names" id="petgudrianname" disabled value="'+rtprimarExecName+'"><span class="edit_primary_exe_name" id="edit_primary_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="del_primary_exe_name" class="delete_pet del_primary_exe_name"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						jQuery(".primary_executor_main_name_addtional").removeClass("errorAct");
						jQuery('body').find('.gardian_added').append(rtappnedGuradnhtml);
						setTimeout(function() {
							jQuery('#add_prm_execText_input').val('');
							jQuery('#sidenav_add_primary_executor').hide();
						},300);
			       	} 
		        }
		    });
		}
	}); 

	//validation on primarry form
	jQuery('body').on('keyup', '#add_prm_execText_input',function(e){
		if(jQuery('#add_prm_execText_input').val()==''){
			jQuery('#add_prm_execText_input').parent().find('.wf_error_mesg').show();
			jQuery("#primary_exe_new_save_btn").prop('disabled',true);
			jQuery("#primary_exe_new_save_btn").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_prm_execText_input').parent().find('.wf_error_mesg').hide();	
			jQuery("#primary_exe_new_save_btn").prop('disabled',false);
			jQuery("#primary_exe_new_save_btn").removeAttr('style');
			return true		
		}
	});

	//Edit Primary executor
	jQuery("body").on("click", ".edit_primary_exe_name", function(){
		var editInputval = jQuery(this).parent().find('input').val();
		var editInputIndex = jQuery(this).parent().find('input').attr('data-index');
		var wf_userid = jQuery('#userid').val();
		var popuphtml = '<div class="modal fade" id="basicModa8" tabindex="-1" role="dialog" aria-labelledby="basicModa8" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index_prm_exec" class="user_index_prm_exec"><input type="hidden" name="user_id" value="'+wf_userid+'" id="user_id"><input type="hidden" name="petguardian_old_name" value="'+editInputval+'" id="prime_exec_old_name"><input type="text" data-val="'+editInputval+'" name="update_partner_name" id="upd_primary_exec_name" class="upd_primary_exec_name" value="'+editInputval+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editpetguardian" name="upd_action" id="save_editprimaryExe">Save</button><span id="loader_imagedv_partner_popup" class="loader_imagedv_executor_popup" style="display: none;"><img class="image_loader partner_save_loading" src="https://hlblawyers.com.au/wp-content/plugins/willed/assets/images/loader_img.jpg"></span></div></div></div></form></div>';
	 	jQuery('#primary_executor_name_modal').html(popuphtml);
        jQuery("#basicModa8").modal('show');
	});

	//save updated prime executor name popup
	jQuery('body').on('click','#save_editprimaryExe', function(e) {
		e.preventDefault();
		var editInputvalprmExe = jQuery(this).parent().parent().find('#upd_primary_exec_name').val();
		var prime_exec_old_name = jQuery(this).parent().parent().find('#prime_exec_old_name').val();
		var row_indexid = jQuery(this).parent().parent().find('#user_index_prm_exec').val();
		var wf_userid = jQuery(this).parent().parent().find('#user_id').val();
		if(editInputvalprmExe.length>0){ 	
			jQuery('#save_editprimaryExe').removeAttr('style');
			jQuery('#save_editprimaryExe').prop('disabled',false);
			jQuery('body').find('#primary_executor_name_modal').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : executor_dahsbaordajax,
		        data : { 'action': 'upda_prm_executor_name', 'primaryExe_val':editInputvalprmExe, 'userid':wf_userid,'primaryExe_old_name':prime_exec_old_name},
		        beforeSend: function(){
				    jQuery(document).find(".loader_imagedv_executor_popup").show();
				    jQuery(this).addClass('submit_disable');
				},
		       	success:function(res){	
		       		jQuery(document).find(".loader_imagedv_executor_popup").hide();
				    jQuery(this).removeClass('submit_disable');
		        	var resArray = JSON.parse(res);
		        	if(resArray.msg == 'prmExec_popupDataSave'){
		        	 	jQuery.each(jQuery('.parent_exec_nm_val'), function (index, item) {
	        		 		if(index==row_indexid){
	        		 			jQuery(item).attr('value', resArray.primary_exec_name);
	        		 		}
					    });
	        			jQuery('#basicModa8').modal('hide');
		        	}
		        }
		    });	
		} else {
			jQuery('document').find('#primary_executor_name_modal').find('.wf_error_mesg').show();	
			jQuery('#save_editprimaryExe').prop('disabled',true);
			jQuery('#save_editprimaryExe').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;   
		}
	});

	//edit gudrdian name on popup
	jQuery('body').on('keyup', '.upd_primary_exec_name',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal.length>0){ 	
			jQuery('#primary_executor_name_modal').find('.wf_error_mesg').hide();
			jQuery('#save_editprimaryExe').prop('disabled',false);
			jQuery('#save_editprimaryExe').removeAttr('style');
		} else {
			jQuery('#primary_executor_name_modal').find('.wf_error_mesg').show();
			jQuery('#save_editprimaryExe').prop('disabled',true);
			jQuery('#save_editprimaryExe').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');	
			return false;   
		}
	});


	//delte div of primary executor name
	jQuery(document).on('click', '.del_primary_exe_name', function(){
	 	if (!confirm("Do you want to delete")){
      		return false;
	    } else {
			if(jQuery(this).parent().remove()){
				var countprimaryonDel = jQuery(".primary_executor_main_name_addtional").find(".primary_exec_names_div").length;
				jQuery.each(jQuery('body').find('input.parent_exec_nm_val '), function (index, item) {
		 			jQuery(item).attr('data-index', index);
			    });
				if(countprimaryonDel<3){
					jQuery("#primary_exec_submit").prop('disabled',true);
					jQuery("#primary_exec_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
					jQuery('.add_guardian_disabled').css('display', 'none');
					jQuery('.primary_executor_main_name_addtional').find('#add_primary_executor').css('display', 'block');
					jQuery(document).find('.primary_executor_main_name_addtional').addClass('err_active');
					jQuery('.primary_executor_main_name_addtional').find('#add_primary_executor').removeClass('primary_exec_disabled');
				} 
				if(countprimaryonDel>=1) {	
					jQuery("#primary_exec_submit").prop('disabled',false);
					jQuery("#primary_exec_submit").removeAttr('style');
					jQuery(document).find('.primary_executor_main_name_addtional').removeClass('err_active');
				}
			}
		}
	});
	//==============================================================================//
	/**********************************END PRIMARY EXECUTORS***************************/
	//==============================================================================//





	//==============================================================================//
	/**********************************BACKUP EXECUTORS***************************/
	//==============================================================================//

	//Add Backup executor data
	jQuery(document).on('click', '#backup_exec_submit', function(e) {
		e.preventDefault();
		var BkpexistDivlength = jQuery('body').find('.add_form_backup .primary_exec_names_div_bkp').length;
		if(BkpexistDivlength>0){
			jQuery(".primary_exector_addtional_bkp").removeClass("err_active");
		}
		var wf_userid_bkp = jQuery('#userid').val();
	 	if( jQuery(".primary_exector_addtional_bkp").hasClass("err_active") ){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find('.add_form_backup .wf_error_mesg').show();
			return false;
		} else {
			var primary_executors_values_bkp = 
			jQuery(document).find('body').find(".primary_exector_addtional_bkp").find("input[name='primary_executors_bkp[]']").map(function(){
				return jQuery(this).val();
			}).get();
			jQuery('body').find('.add_form_primary').hide();
			jQuery('body').find('.add_form_backup').hide();
			jQuery('body').find('.add_form_identifiers').show();
			jQuery('body').find('.add_form_identifiers #hold_allBackupExecutors').val(primary_executors_values_bkp);
			var allPrimarExehtml='';
			jQuery('body').find(".add_form_primary .parent_exec_nm_val ").each(function(index){
				var prminput_address = jQuery(this).attr('data-address');
				if (prminput_address == null){
		   			prminput_address = '';
		   		}
				var arraysPrimary = jQuery(this).val();
				allPrimarExehtml += '<div class="guardian_names_dv identify_exec_names_div not_empty_indenfy"><input type="text" data-attr="'+index+'" data-value="" data-id="" name="primary_executors_name[]" id="" class="child_gurdian_names indentify_executors_name" value="'+arraysPrimary+'" disabled><span class="append_address">'+prminput_address+'</span><input value="'+prminput_address+'" class="inputappend_address" type="hidden" name="primary_exec_address[]"><span class="edit_pet edit_indentify_exe_name" id="edit_indentify_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';   
			});
			jQuery('body').find('.gardian_added_indetiyf').append(allPrimarExehtml);
			var allPrimarExehtmls='';
		   	jQuery('body').find(".add_form_backup .backup_exec_nm_val ").each(function(index){
		   		var bkpinput_address = jQuery(this).attr('data-address');
		   		if (bkpinput_address == null){
		   			bkpinput_address = '';
		   		}
				var arraysBackup = jQuery(this).val();
			    allPrimarExehtmls += '<div class="guardian_names_dv identify_exec_names_div not_empty_indenfy"><input type="text" data-attr="'+index+'" data-value="" data-id="" name="backup_executors_name[]" id="" class="child_gurdian_names indentify_executors_name" value="'+arraysBackup+'" disabled><span class="append_address">'+bkpinput_address+'</span><input class="inputappend_address" type="hidden" value="'+bkpinput_address+'" name="backup_exec_address[]"><span class="edit_pet edit_indentify_exe_name" id="edit_indentify_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
			});
			jQuery('body').find('.gardian_added_indetiyf').append(allPrimarExehtmls);
		}	
		setTimeout(function() {
			var totlen = jQuery('body').find('.gardian_added_indetiyf .identify_exec_names_div').length;
			jQuery.each(jQuery('body').find('input.indentify_executors_name'), function (index, item) {
	 			jQuery(item).attr('data-id', index);
		    });
		});

	});

	jQuery('#add_primary_executor_bkp').click(function(){
		jQuery('#sidenav_add_primary_executor_bkp').show(); 
	});
	jQuery('.close_primary_executor').click(function(){
		jQuery('#sidenav_add_primary_executor_bkp ').css('display','none');
	}); 

	//select Backup Executor
	jQuery('body').find('.primar_exe_items_list_bkp').each(function(){
		jQuery(this).click(function(){
			var countprimaryExec = jQuery('body').find(".primary_executor_main_name_addtional_bkp").find(".primary_exec_names_div_bkp").length;
			if(countprimaryExec==0){
				//alert('yes');
				jQuery('body').find(".add_form_backup #backup_exec_submit").prop('disabled',false);
				jQuery('body').find(".add_form_backup #backup_exec_submit").removeAttr('style');
				jQuery('body').find('.add_form_backup .wf_error_mesg').hide();
				jQuery('body').find('.primary_exector_addtional_bkp ').removeClass('err_active');
			}
			if(countprimaryExec>=2){
				jQuery('.primary_executor_main_name_addtional_bkp').find('#add_primary_executor_bkp').addClass('primary_exec_disabled');
				jQuery('body').find('.primary_exector_addtional_bkp ').removeClass('err_active');
			} 
			var increaseIndexofDivsbkp = jQuery(".gardian_added_on_backupExe .primary_exec_names_div_bkp").last().find('input').attr('data-index');
            var increaseIndexofDivbkp = parseInt(increaseIndexofDivsbkp) + 1;
			var primarExecName = jQuery(this).text();
			var appnedGuradnhtml = '<div id="gudraianNameCont" class="primary_exec_names_div_bkp guardian_names_dv gudraianNameCont"><input data-index="'+increaseIndexofDivbkp+'" name="primary_executors_bkp[]" type="text" class="child_gurdian_names backup_exec_nm_val" id="petgudrianname" disabled value="'+primarExecName+'"><span class="edit_pet edit_primary_exe_name_bkp" id="edit_primary_exe_name_bkp"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="del_primary_exe_name_bkp" class="delete_pet del_primary_exe_name_bkp"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
			jQuery(".primary_executor_main_name_addtional_bkp").removeClass("errorAct");
			jQuery('body').find('.gardian_added_on_backupExe').append(appnedGuradnhtml);
			setTimeout(function() {
				jQuery('#sidenav_add_primary_executor_bkp').hide();
			},20);
		});
	});


	//Add new Backup exec(partner) in list 
	jQuery('#primary_exe_new_save_btn_bkp').click(function(e){
		e.preventDefault();
		if(jQuery('#add_prm_execText_input_bkp').val()==''){
			jQuery('#add_prm_execText_input_bkp').parent().find('.wf_error_mesg').show();
			jQuery('#primary_exe_new_save_btn_bkp').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find("#primary_exe_new_save_btn_bkp").prop('disabled',true);
			jQuery('body').find('#sidenav_add_primary_executor_bkp .wf_error_mesg').show();
			return false;
		} else{
			jQuery('#add_prm_execText_input_bkp').parent().find('.wf_error_mesg').hide();	
			var partnernamebkp = jQuery('#add_prm_execText_input_bkp').val()		
			var add_partner_userid = jQuery('#add_prm_exe_userid_bkp').val();
			jQuery('.wf_error_guardian_name_hidden').hide();
			jQuery.ajax({
				type : "post",
		        url : executor_dahsbaordajax,
		        data : { 'action': 'add_new_bkp_exec', 'bkp_exector_name':partnernamebkp, 'userid':add_partner_userid},
		        beforeSend: function(){
				    jQuery('#primary_exe_new_save_btn_bkp').parent().find(".loader_imagedv_bakcupExe_popup").show();
				    jQuery('#primary_exe_new_save_btn_bkp').addClass('submit_disable');
				},
		        success:function(response16){
	        	 	jQuery('#primary_exe_new_save_btn_bkp').parent().find(".loader_imagedv_bakcupExe_popup").hide();
				    jQuery('#primary_exe_new_save_btn_bkp').removeClass('submit_disable');
	        	 	var resArray = JSON.parse(response16);
	        		if(resArray.msg == 'bkp_exec_added' || resArray.msg == 'bkp_exec_update'){
	        			var rtbackupExecName = resArray.retrunbkp_exec_name;

	        			var increaseIndexofDivsbkp = jQuery(".gardian_added .primary_exec_names_div ").last().find('input').attr('data-index');
						var increaseIndexofDivBks = parseInt(increaseIndexofDivsbkp) + 1;
						var rtappnedBkpExechtml = '<div id="gudraianNameCont" class="primary_exec_names_div_bkp guardian_names_dv gudraianNameCont"><input data-index="'+increaseIndexofDivBks+'" name="primary_executors_bkp[]" type="text" class="child_gurdian_names backup_exec_nm_val" id="petgudrianname" disabled value="'+rtbackupExecName+'"><span class="edit_pet edit_primary_exe_name_bkp" id="edit_primary_exe_name_bkp"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="del_primary_exe_name_bkp" class="delete_pet del_primary_exe_name_bkp"><i class="fa fa-times" aria-hidden="true"></i></span></div>';
						jQuery(".primary_exector_addtional_bkp").removeClass("errorAct");
						jQuery('body').find('.gardian_added_on_backupExe').append(rtappnedBkpExechtml);
						setTimeout(function() {
							jQuery('#add_prm_execText_input_bkp').val('');
							jQuery('#sidenav_add_primary_executor_bkp').hide();
						},300);

						var rtcountBackupExec = jQuery('body').find(".primary_executor_main_name_addtional_bkp").find(".primary_exec_names_div_bkp").length;
						if(rtcountBackupExec>0){
							jQuery('body').find(".add_form_backup #backup_exec_submit").prop('disabled',false);
							jQuery('body').find(".add_form_backup #backup_exec_submit").removeAttr('style');
							jQuery('body').find('.add_form_backup .wf_error_mesg').hide();
							jQuery('body').find('.primary_exector_addtional_bkp ').removeClass('err_active');
						}
						if(rtcountBackupExec>2){
							jQuery('.primary_executor_main_name_addtional_bkp').find('#add_primary_executor_bkp').addClass('primary_exec_disabled');
							jQuery('body').find('.primary_exector_addtional_bkp').removeClass('err_active');
						} 
			       	} 
		        }
		    });
		}
	}); 
	jQuery('body').on('keyup', '#add_prm_execText_input_bkp',function(e){
		if(jQuery('#add_prm_execText_input_bkp').val()==''){
			jQuery('#add_prm_execText_input_bkp').parent().find('.wf_error_mesg').show();
			jQuery("#primary_exe_new_save_btn_bkp").prop('disabled',true);
			jQuery("#primary_exe_new_save_btn_bkp").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_prm_execText_input_bkp').parent().find('.wf_error_mesg').hide();	
			jQuery("#primary_exe_new_save_btn_bkp").prop('disabled',false);
			jQuery("#primary_exe_new_save_btn_bkp").removeAttr('style');
			return true		
		}
	});

	//Edit Backup executor
	jQuery("body").on("click", ".edit_primary_exe_name_bkp", function(){
		var editInputval = jQuery(this).parent().find('input').val();
		var editInputIndex = jQuery(this).parent().find('input').attr('data-index');
		var wf_userid = jQuery('#userid').val();
		var popuphtml = '<div class="modal fade" id="basicModa7" tabindex="-1" role="dialog" aria-labelledby="basicModa7" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index_prm_exec" class="user_index_prm_exec"><input type="hidden" name="user_id" value="'+wf_userid+'" id="user_id"><input type="hidden" name="petguardian_old_name" value="'+editInputval+'" id="bakup_exec_old_name"><input type="text" data-val="'+editInputval+'" name="update_partner_name" id="upd_primary_exec_name_bkp" class="upd_primary_exec_name_bkp" value="'+editInputval+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editpetguardian" name="upd_action" id="save_editbkpExe">Save</button><span id="loader_imagedv_partner_popup" class="loader_imagedv_executor_popup" style="display: none;"><img class="image_loader partner_save_loading" src="https://hlblawyers.com.au/wp-content/plugins/willed/assets/images/loader_img.jpg"></span></div></div></div></form></div>';
	 	jQuery(document).find('#primary_executor_name_modal_bkp').html(popuphtml);
        jQuery("#basicModa7").modal('show');
		
	});

	//save updated Backup executor name popup
	jQuery('body').on('click','#save_editbkpExe', function(e) {
		e.preventDefault();
		var editInputvalbkpExe = jQuery(this).parent().parent().find('#upd_primary_exec_name_bkp').val();
		var bakup_exec_old_name = jQuery(this).parent().parent().find('#bakup_exec_old_name').val();
		var bkprow_indexid = jQuery(this).parent().parent().find('#user_index_prm_exec').val();
		var wf_userid_bkp = jQuery(this).parent().parent().find('#user_id').val();
		if(editInputvalbkpExe.length>0){ 	
			jQuery('#save_editbkpExe').removeAttr('style');
			jQuery('#save_editbkpExe').prop('disabled',false);
			jQuery('body').find('#primary_executor_name_modal_bkp').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : executor_dahsbaordajax,
		        data : { 'action': 'upda_bkp_executor_name', 'backupExe_val':editInputvalbkpExe, 'userid':wf_userid_bkp,'backupExe_old_name':bakup_exec_old_name},
		        beforeSend: function(){
				    jQuery(document).find(".loader_imagedv_executor_popup").show();
				    jQuery(this).addClass('submit_disable');
				},
		       	success:function(response17){	
		       		jQuery(document).find(".loader_imagedv_executor_popup").hide();
				    jQuery(this).removeClass('submit_disable');
		        	var resArray = JSON.parse(response17);
		        	if(resArray.msg == 'bkpExec_popupDataSave'){
		        	 	jQuery.each(jQuery('.backup_exec_nm_val'), function (index, item) {
	        		 		if(index==bkprow_indexid){
	        		 			jQuery(item).attr('value', resArray.backup_exec_name);
	        		 		}
					    });
	        			jQuery('#basicModa7').modal('hide');
		        	}
		        }
		    });	
		} else {
			jQuery('document').find('#primary_executor_name_modal_bkp').find('.wf_error_mesg').show();	
			jQuery('#save_editbkpExe').prop('disabled',true);
			jQuery('#save_editbkpExe').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;   
		}
	});

	//edit Backup executor name on popup
	jQuery('body').on('keyup', '.upd_primary_exec_name_bkp',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal.length>0){ 	
			jQuery('#primary_executor_name_modal_bkp').find('.wf_error_mesg').hide();
			jQuery('#save_editbkpExe').prop('disabled',false);
			jQuery('#save_editbkpExe').removeAttr('style');
		} else {
			jQuery('#primary_executor_name_modal_bkp').find('.wf_error_mesg').show();
			jQuery('#save_editbkpExe').prop('disabled',true);
			jQuery('#save_editbkpExe').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');	
			return false;   
		}
	});

	//delte div of Backup executor name
	jQuery('body').on('click', '.del_primary_exe_name_bkp', function(){
	 	if (!confirm("Do you want to delete")){
      		return false;
	    } else {
			if(jQuery(this).parent().remove()){
				jQuery.each(jQuery('body').find('input.backup_exec_nm_val'), function (index, item) {
		 			jQuery(item).attr('data-index', index);
			    });
				var countprimaryonDel = jQuery(".primary_executor_main_name_addtional_bkp").find(".primary_exec_names_div_bkp").length;
				if(countprimaryonDel<3){
					jQuery("#primary_exec_submit_bkp").prop('disabled',true);
					jQuery("#primary_exec_submit_bkp").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
					jQuery('.add_guardian_disabled_bkp').css('display', 'none');
					jQuery('.primary_executor_main_name_addtional_bkp').find('#add_primary_executor_bkp').css('display', 'block');
					jQuery(document).find('.primary_exector_addtional_bkp').addClass('err_active');
					jQuery('.primary_executor_main_name_addtional_bkp').find('#add_primary_executor_bkp').removeClass('primary_exec_disabled');
				} 
				if(countprimaryonDel>=1) {	
					jQuery("#primary_exec_submit_bkp").prop('disabled',false);
					jQuery("#primary_exec_submit_bkp").removeAttr('style');
					jQuery(document).find('.primary_exector_addtional_bkp').removeClass('err_active');
				}
			}
		}
	});


	/***************************Identify executor for address************************/
	//Edit Identify executor poup
	jQuery("body").on("click", ".edit_indentify_exe_name", function(){
		var editInputvalIdenty = jQuery(this).parent().find('input').val();
		var editInputIndex = jQuery(this).parent().find('input').attr('data-attr');
		var identifyName = jQuery(this).parent().find('input').attr('data-attr');
		var indexToShowAddress = jQuery(this).parent().find('input').attr('data-id');
		var identify_exec_locationas =jQuery(this).parent().find('.append_address').text(); 
		if(identify_exec_locationas !=''){
			identify_exec_location = identify_exec_locationas
		} else {
			identify_exec_location = '';
		}
		var wf_userid = jQuery('#userid').val();
		var popuphtml = '<div class="modal fade" id="basicModa9" tabindex="-1" role="dialog" aria-labelledby="basicModa9" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Save Address</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Address</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index_indentify_exec" class="user_index_indentify_exec"><input type="hidden" name="identifyName" value="'+ editInputvalIdenty +'" id="identifyName" class="identifyName"><input type="hidden" name="user_id" value="'+wf_userid+'" id="user_id"><input type="text" class="identify_exec_address" id="identify_exec_address" value="'+identify_exec_location+'"><input type="hidden" class="indexToMatchWithRow" id="indexToMatchWithRow" value="'+indexToShowAddress+'"></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_indentify_address" name="upd_action" id="save_indentify_address">Save</button><span id="loader_imagedv_partner_popup" class="loader_imagedv_executor_popup" style="display: none;"><img class="image_loader partner_save_loading" src="https://hlblawyers.com.au/wp-content/plugins/willed/assets/images/loader_img.jpg"></span></div></div></div></form></div>';
	 	jQuery(document).find('#identify_executor_name_modal').html(popuphtml);
        jQuery("#basicModa9").modal('show');
	});

	//save address in identify executor popup
	jQuery('body').on('click','#save_indentify_address', function(e) {
		e.preventDefault();
		var identify_address_val = jQuery(this).parent().parent().find('.identify_exec_address').val();
		var identifyrow_nameVal = jQuery(this).parent().parent().find('#identifyName').val();
		var identifyrow_indexid = jQuery(this).parent().parent().find('#user_index_indentify_exec').val();
		var wf_userid_indentyf = jQuery(this).parent().parent().find('#user_id').val();
		var indexToMatchWithRow = jQuery(this).parent().parent().find('#indexToMatchWithRow').val();
		jQuery.each(jQuery('.indentify_executors_name'), function (index, item) {
	 		if(index==indexToMatchWithRow){
	 			jQuery(item).next().text(identify_address_val);
	 			jQuery(item).next().next().val(identify_address_val);
	 			jQuery('#basicModa9').modal('hide');
	 		}
	    });
	});

	jQuery(document).on('click', '#indentify_exec_submit', function(e) {
		e.preventDefault();
		var totalAdddivs = jQuery('.identify_exec_names_div').length;
		var wf_userid_indetify = jQuery('#userid').val();

		//primary exec
		var primary_executors_name = jQuery(document).find('body').find(".gardian_added_indetiyf").find("input[name='primary_executors_name[]']").map(function(){return jQuery(this).val();}).get();
		var primary_exec_address = jQuery(document).find('body').find(".gardian_added_indetiyf").find("input[name='primary_exec_address[]']").map(function(){return jQuery(this).val();}).get();
		
		//backup exec
		var backup_executors_name = jQuery(document).find('body').find(".gardian_added_indetiyf").find("input[name='backup_executors_name[]']").map(function(){return jQuery(this).val();}).get();
		var backup_exec_address = jQuery(document).find('body').find(".gardian_added_indetiyf").find("input[name='backup_exec_address[]']").map(function(){return jQuery(this).val();}).get();
		jQuery.ajax({
			type : "post",
	        url : executor_dahsbaordajax,
	        data : { 
	    		'action': 'indentify_executor_data_save',
	    		'wf_userid':wf_userid_indetify,
	    		'total_Addres_row':totalAdddivs,
	    		'primary_exe_names':primary_executors_name,
	    		'primary_exe_address':primary_exec_address,	
	    		'backup_exe_names':backup_executors_name,
	    		'backup_exe_address':backup_exec_address,	
			},
			beforeSend: function(){
			    jQuery('#indentify_exec_submit').parent().find("#loader_imagedv_idendtify_execr_popup").show();
			    jQuery('#indentify_exec_submit').addClass('submit_disable');
			},
	    	success: function(response18) {
	    		var myArray = JSON.parse(response18);
	    		jQuery('#indentify_exec_submit').parent().find("#loader_imagedv_idendtify_execr_popup").hide();
			    jQuery('#indentify_exec_submit').removeClass('submit_disable');
	    		if(myArray.msg == "IdentifyExec_popupDataSave"){
	    			var base_url = window.location.origin;
					nextpageurl = base_url+'/wfdashboard/?'+'will=divideEstate';
	    			window.location.replace(nextpageurl);
	    		}
	        }
		});
	});


	//Get google location address
	jQuery(document).on('keyup', '.identify_exec_address', function(){
		initlocMap();		 
	});
	function initlocMap(){
		//jQuery(document).find('.pac-container').css('z-index','999!important');
		var searchInputvvv = document.getElementById("identify_exec_address");
	    var autocomplete;
	    autocomplete = new google.maps.places.Autocomplete( searchInputvvv , {
	        types: ['geocode'],
	    });	
	}
	
}); //document end
</script>