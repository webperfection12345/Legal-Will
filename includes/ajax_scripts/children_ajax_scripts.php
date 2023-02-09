<script type="text/javascript">
	jQuery(document).ready(function() {
		var agests = jQuery('input[name="age_under_18"]:checked').val();	
		if(agests=='yes' ){
			jQuery('.age_under_yes').show(); 
		}
		jQuery('body').find(".input_mature_ageact").click(function(){
			jQuery('.input_mature_ageact').removeClass('age_under_active');
			jQuery(this).addClass('age_under_active');
		});

	var children_dahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';

	/***************************Children submit*****************************/
	jQuery(document).on('click', '#children_submit', function(e) {
		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		jQuery.ajax({
			type : "post",
	        url : children_dahsbaordajax,
	        data : { 
	    		'action': 'children_dashboard',
	    		'wf_userid':wf_userid,
			},
			beforeSend: function(){
			    jQuery("#loader_imagedv_partner_popup").show();
			    jQuery('#children_submit').addClass('submit_disable');
			},
	    	success: function(response) {
	    		var myArray = JSON.parse(response);
	    		jQuery("#loader_imagedv_partner_popup").hide();
			    jQuery('#children_submit').removeClass('submit_disable');
	    		if(myArray.msg == "chilren_updated"){
	    			location.reload(true);
	    			var base_url = window.location.origin;
					nextpageurl = base_url+'/wfdashboard/?'+'will=pets';
	    			window.location.replace(nextpageurl);
	    		}
	        }
		});
	});
	
	jQuery('#add_child').click(function(){
		jQuery('#children_form').hide();
		jQuery('.add_child_form').show();
	});

	jQuery('#backto_chilren_form').click(function(){
		jQuery('.add_child_form').hide();
		jQuery('#children_form').show();
		
	});

	//Age 18 yes no
	jQuery('.age_under_18').change(function(){
		var agests = jQuery('input[name="age_under_18"]:checked').val();	
		if(agests=='yes' ){
			jQuery('.age_under_yes').show(); 
		} else {
			jQuery('#child_name_submit').prop('disabled',false);
			jQuery('#child_name_submit').removeAttr('style');
			jQuery('.age_under_yes').hide();
		}
		if ( agests=='no' || agests=='yes' ) {
			jQuery('.matureage_about').find('.wf_error_mesg').hide();	   		
	   		jQuery('#child_name_submit').prop('disabled',false);
			jQuery('#child_name_submit').removeAttr('style');
			//errorFlag = true;
			return true;
		}
	});

	//add section
	jQuery('#add_guardians').click(function(){
		jQuery('#sidenav_add_guradian').show(); 
	});
	jQuery('.close_add_gurardian').click(function(){
		jQuery('#sidenav_add_guradian ').css('display','none');
	});

	//Add child data
	jQuery(document).on('click', '#child_name_submit', function(e) {
		e.preventDefault();
		childname_validate();
		mature_age_validate();
		var wf_userid = jQuery('#userid').val();
		var wf_child_name = jQuery('#wf_child_name').val();
		var agests = jQuery('input[name="age_under_18"]:checked').val();
		if(  wf_child_name=='' ){
			return false;
		}
		if( agests == 'no' && wf_child_name=='' ){
			return false;
		}
		if( agests == 'no' && wf_child_name!='' ){
			call_ajax_func();
		}
	 	if( jQuery("#gurdian_addtional").hasClass("err_active") && wf_child_name!=''){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.wf_error_guardian_name_hidden').show();
			return false;
		} else {
			call_ajax_func();
		}
	});

	//Add child data ajax
	function call_ajax_func(){
		var wf_userid = jQuery('#userid').val();
		var wf_child_name = jQuery('#wf_child_name').val();
		var agests = jQuery('input[name="age_under_18"]:checked').val();
		var gudrian_names = jQuery("input[name='child_gurdian_names[]']").map(function(){return $(this).val();}).get();
		jQuery.ajax({
			type : "post",
	        url : children_dahsbaordajax,
	        data : { 
	    		'action': 'child_data_save',
	    		'wf_userid':wf_userid,
	    		'wf_child_name':wf_child_name,
	    		'age_under':agests,
	    		'gudrian_names':gudrian_names
			},
			beforeSend: function(){
			    jQuery('#child_name_submit').parent().find("#loader_imagedv_partner_popup").show();
			    jQuery('#children_submit').addClass('submit_disable');
			},
	    	success: function(response12) {
	    		var myArray = JSON.parse(response12);
	    		jQuery('#child_name_submit').parent().find("#loader_imagedv_partner_popup").hide();
			    jQuery('#children_submit').removeClass('submit_disable');
	    		if(myArray.msg == "child_data_saved"){
	    			location.reload(true);
	    		}
	        }
		});
	}

	jQuery('body').on('keyup', '#wf_child_name',function(){
		childname_validate();
	});
	function childname_validate(){
		var errorFlag = true;
		var child_name_value = jQuery("#wf_child_name").val(); 
		if(child_name_value.length ==''){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.child_name_sectio').find('.wf_error_mesg').show();
			return false
		} else {
			jQuery('.child_name_sectio').find('.wf_error_mesg').hide();	   		
	   		jQuery(this).prop('disabled',false);
			jQuery(this).removeAttr('style');
			return true;
		}
	}
	function mature_age_validate(){
		var agests = jQuery('input[name="age_under_18"]:checked').val();
		if (typeof agests === "undefined") {
			jQuery('#child_name_submit').prop('disabled',true);
			jQuery('#child_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.matureage_about').find('.wf_error_mesg').show();
			return false
		} else {
			jQuery('.matureage_about').find('.wf_error_mesg').hide();	   		
	   		jQuery('#child_name_submit').prop('disabled',false);
			jQuery('#child_name_submit').removeAttr('style');
			return true;
		}
	}

	//Add Guardian on sidebar submit
	jQuery('#guardian_save_btn').click(function(e){
		e.preventDefault();
		if(jQuery('#add_guardians_input').val()==''){
			jQuery('#add_guardians_input').parent().find('.wf_error_mesg').show();
			jQuery('#guardian_save_btn').prop('disabled',true);
			jQuery('#guardian_save_btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_guardians_input').parent().find('.wf_error_mesg').hide();			
			var add_partner_userid = jQuery('#add_partner_userid').val();
			var child_name_value = jQuery("#wf_child_name").val(); 
			var age_under = jQuery('input[name="age_under_18"]:checked').val();
			var partnername = jQuery('#add_guardians_input').val();

			jQuery.ajax({
				type : "post",
		        url : children_dahsbaordajax,
		        data : { 'action': 'add_guardians', 'partnername':partnername, 'userid':add_partner_userid,'child_name_value':child_name_value, 'age_under':age_under},
		        beforeSend: function(){
		        	jQuery("#sidenav_add_guradian").hide();
				   	jQuery("#loader_imagedv_partner_popup").show();
				    jQuery('#partner_save_btn').addClass('submit_disable');
				},
		        success:function(response14){
	        	 	var resArray = JSON.parse(response14);
		        	jQuery("#loader_imagedv_partner_popup").hide();
				    jQuery('#partner_save_btn').removeClass('submit_disable');
	        		if(resArray.msg == 'guardian_added'){
	        			var incrDvIndex = jQuery('body').find('.guardian_names_dv').length;
	        			var newGuradnhtml = '<div class="guardian_names_dv"><input type="text" data-attr="" data-value="'+incrDvIndex+'" data-id="" name="child_gurdian_names[]" id="" class="child_gurdian_names" value="'+resArray.guadridnName+'" disabled><span class="delete_guardian delete_guardian_ofChild"><i class="fa fa-times" aria-hidden="true"></i></span><span class="edit_guardian edit_guardian_on_add"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
        				jQuery('body').find('#gardian_added_partner').append(newGuradnhtml);
        				jQuery('#add_guardians_input').val('');
        				var grdDivlength = jQuery('body').find('#gardian_added_partner .guardian_names_dv').length;
						if(grdDivlength>1){
							jQuery('body').find('.add_additional_partner_disable').css({'opacity':'0.2', 'pointer-events':'none'});
						}

        				var grdDivlengthd = jQuery('body').find('.add_child_form #gardian_added_partner .guardian_names_dv').length;
						if(grdDivlengthd>0){
							jQuery('body').find('.add_child_form .wf_error_guardian_name_hidden').hide();
							jQuery("#gurdian_addtional").removeClass("err_active");
							jQuery('#child_name_submit').prop('disabled',false);
							jQuery('#child_name_submit').removeAttr('style');
						}

			       	} 
		        }
		    });
		}
	}); 

	//Select Guardian from sidebar list
	jQuery('.gurdian-items-list').each(function(){	
		jQuery(this).click(function(e){			
			e.preventDefault();
			var grdDivlength = jQuery('body').find('#gardian_added_partner .guardian_names_dv').length;
			if(grdDivlength>0){
				jQuery('body').find('.add_additional_partner_disable').css({'opacity':'0.2', 'pointer-events':'none'});
			}
			var slectedGurdainName = jQuery(this).text();
			var select_gurdian_userid = jQuery(this).attr('data-attr');
			var select_gurdianRowindex = jQuery(this).attr('data-id');
			var primarExecName = jQuery(this).text();
			var incrDvIndex = jQuery('body').find('.guardian_names_dv').length;
			var appnedGuradnhtml = '<div class="guardian_names_dv"><input type="text" data-attr="'+select_gurdianRowindex+'" data-value="'+incrDvIndex+'" data-id="'+select_gurdian_userid+'" name="child_gurdian_names[]" id="" class="child_gurdian_names" value="'+slectedGurdainName+'" disabled><span class="delete_guardian delete_guardian_ofChild"><i class="fa fa-times" aria-hidden="true"></i></span><span class="edit_guardian edit_guardian_on_add"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
			jQuery("#gurdian_addtional").removeClass("err_active");
			jQuery('#child_name_submit').prop('disabled',false);
			jQuery('#child_name_submit').removeAttr('style');
			jQuery('.wf_error_guardian_name_hidden').hide();
			setTimeout(function() {
				jQuery('body').find('#gardian_added_partner').append(appnedGuradnhtml);
				jQuery("#sidenav_add_guradian").hide();
			},100);
		});
	});

	jQuery('body').on('keyup', '#add_guardians_input',function(e){
		if(jQuery('#add_guardians_input').val()==''){
			jQuery('body').find('#guardian_save_btn').prop('disabled',true);
			jQuery('body').find('#guardian_save_btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#add_guardians_input').parent().find('.wf_error_mesg').show();
			return false;
		} else{
			jQuery('body').find('#guardian_save_btn').prop('disabled',false);
			jQuery('body').find('#guardian_save_btn').removeAttr('style');
			jQuery('body').find('#add_guardians_input').parent().find('.wf_error_mesg').hide();			
		}
	});
	
	//pop gurdian save
	jQuery('.gurdian-items-list').each(function(){
		jQuery(this).click(function(){
			var usrID = jQuery(this).attr('data-attr');
			var partnrname = jQuery(this).attr('data-value');
			var index_num = jQuery(this).attr('data-id');
			jQuery.ajax({
				type : "post",
		        url : children_dahsbaordajax,
		        data : { 'action': 'select_guardians', 'partnername':partnrname, 'userid':usrID},
		        success:function(res){
		        	jQuery("#loader_imagedv_partner_popup").hide();
				    jQuery('#partner_save_btn').removeClass('submit_disable');
		        }
		    });
		});
	});

	//delete Each child in db 
	jQuery('.eachchildItem .deleteEachChild').each(function(){
		jQuery(this).click(function(e){
			e.preventDefault();
			if (!confirm("Do you want to delete")){
      			return false;
    		} else {
    			jQuery(this).parent('.eachchildItem').css({'background-color':'#ccc','opacity':' 0.2'});
			   	setTimeout(function() {
    				jQuery(this).parent('.eachchildItem').hide('slow');
		  		}, 300);
				var row_userid = jQuery(this).parent().find('input').attr('data-id');
				var row_index = jQuery(this).parent().find('input').attr('data-row');
				jQuery.ajax({
					type : "post",
			        url : children_dahsbaordajax,
			        data : { 
			    		'action': 'deleteChildinDb',
			    		'wf_userid':row_userid,
			    		'wf_childrow_index':row_index,
					},
			    	success: function(response26) {
			    		var myArray = JSON.parse(response26);
			    		if(myArray.msg == "child_deleted"){
			    			location.reload(true);
			    		}
			        }
				});
			}
		});
	});

	//Delete gurdian form appended data
	jQuery('body').on('click','.delete_guardian_ofChild', function(){
	 	if (!confirm("Do you want to delete")){
  			return false;
		} else {
			jQuery(this).parent().remove();
			var grdDilength = jQuery('body').find('#gardian_added_partner .guardian_names_dv').length;
			if(grdDilength==0){
				jQuery("#gurdian_addtional").addClass("err_active");
			}
			if(grdDilength>0){
				jQuery('body').find('.add_additional_partner_disable').css({'opacity':'','pointer-events':''});
			}
		}
	});
	
	//Edit gurdian from poup
	jQuery('body').on('click','.edit_guardian_on_add', function(){
		var editInputval = jQuery(this).parent().find('input').val();
		var editInputuserId = jQuery(this).parent().find('input').attr('data-id');
		var editInputIndex = jQuery(this).parent().find('input').attr('data-attr');
		var data_indexnum = jQuery(this).parent().find('input').attr('data-value');
		var wf_userid = jQuery('#userid').val();
		var popuphtml = '<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index"><input type="hidden" name="dataindex" value="'+ data_indexnum +'" id="user_dataindex"><input type="hidden" name="user_id" value="'+editInputuserId+'" id="user_id"><input type="hidden" name="guardian_old_name" value="'+editInputval+'" id="guardian_old_name"><input type="text" data-val="'+editInputval+'" name="update_partner_name" id="upd_guardian_name" class="upd_guardian_name" value="'+editInputval+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editguardian" name="upd_action" id="save_editguardian">Save</button></div></div></div></form></div>';
	 	jQuery('#edit_guradina_name_modal').html(popuphtml);
        jQuery("#basicModal").modal('show');
	});

	//save updated partner name from sidebar
	jQuery('body').on('click','#save_editguardian', function(e) {
		e.preventDefault();
		var editInputval = jQuery(this).parent().parent().find('#upd_guardian_name').val();
		var guardian_old_name = jQuery(this).parent().parent().find('#guardian_old_name').val();
		var wf_userid = jQuery(this).parent().parent().find('#user_id').val();
		var wf_row_index = jQuery(this).parent().parent().find('#user_index').val();
		var user_dataindex = jQuery(this).parent().parent().find('#user_dataindex').val();
		if(editInputval==''){
			jQuery('#edit_guradina_name_modal').find('.wf_error_mesg').show();
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		} else {
			jQuery(this).prop('disabled',false);
			jQuery(this).removeAttr('style');
			jQuery('#edit_guradina_name_modal').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : children_dahsbaordajax,
		        data : { 'action': 'edit_guardians_name', 'upd_gurdaina_name':editInputval, 'userid':wf_userid,'guardian_old_name':guardian_old_name, 'guardian_keyindex':wf_row_index},
		        success:function(resd){
		        	var resArray = JSON.parse(resd);
		        	if(resArray.msg=='popupChildDataSave'){
		        	 	jQuery.each(jQuery('.child_gurdian_names'), function (index, item) {
	        		 		if(index==user_dataindex){
	        		 			jQuery(item).attr('value', resArray.newGardianName);
	        		 		}
					    });
	        			jQuery('#basicModal').modal('hide');
		        	}
		        }
		    });	
		}
	});

	//Validation edit gudrdian name on popup
	jQuery('body').on('keyup', '#upd_guardian_name',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal==''){ 	
			jQuery('#edit_guradina_name_modal').find('.wf_error_mesg').show();	
			jQuery('#save_editguardian').prop('disabled',true);
			jQuery('#save_editguardian').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;   
		} else {
			jQuery('#edit_guradina_name_modal').find('.wf_error_mesg').hide();
			jQuery('#save_editguardian').prop('disabled',false);
			jQuery('#save_editguardian').removeAttr('style');
		}
	});








/*********//**********************EDIT SECTION START**************//*******************/
//************************************************************************************//

	//edit section
	jQuery('body').on('click','.edit_child_form #add_guardians', function(){
		jQuery('#edit_sidenav_add_guradian').show(); 
	}); 
	jQuery('body').on('click','#edit_sidenav_add_guradian .close_add_gurardian', function(){
		jQuery('#edit_sidenav_add_guradian ').css('display','none');
	});


	//back from edit form
	jQuery('body').on('click','#back_edit_chilren_form', function(){
		jQuery('body').find('.edit_child_form').hide();
		jQuery('body').find('#children_form').show();
	});

	jQuery('body').on('keyup', '#add_guardians_input_edit',function(e){
		if(jQuery('#add_guardians_input_edit').val()==''){
			jQuery('#add_guardians_input_edit').parent().find('.wf_error_mesg').show();
			return false;
		} else{
			jQuery('#add_guardians_input_edit').parent().find('.wf_error_mesg').hide();			
		}
	});

	//Edit section
	//edit form open
	jQuery('.edit_childDt').each(function(){	
	jQuery(this).click(function(e) {
		e.preventDefault();
		var userID = jQuery(this).parent().find('input').attr('data-id');
		var indexNumbrtoUpdc = jQuery(this).parent().find('input').attr('data-row');
		jQuery.ajax({
			type : "post",
	        url : children_dahsbaordajax,
	        data : { 
	    		'action': 'child_data_edit',
	    		'wf_userid':userID,
	    		'indexNumbrtoUpd':indexNumbrtoUpdc
			},
	    	success: function(resp30) {
	    		var myArray = JSON.parse(resp30);
	    		var matureAge = myArray.rtnChildage;
	    		var childs = myArray.rtnChildGurdian;
	    		jQuery('body').find('#children_form').hide();
	    		jQuery('body').find('.edit_child_form').show();
	    		jQuery('body').find('.edit_child_form .edit_childname_val').val(myArray.rtnChildname);
	    		jQuery('body').find('.edit_child_form #valindex_to_update').val(indexNumbrtoUpdc);
	    		jQuery('body').find('.edit_child_form').find('input[name="age_under_18"]:checked').val()
	    		if(matureAge=='yes'){
    				jQuery('body').find('.edit_child_form #age_under_18_yes').prop('checked', true);
    				jQuery('body').find('.edit_child_form .input_mature_ageact').removeClass('age_under_active');
    				jQuery('body').find('.edit_child_form #age_under_18_yes').parent().addClass('age_under_active');
    				jQuery('body').find('.edit_child_form .age_under_yes').show();
	    		} else if(matureAge =='no'){
    				jQuery('body').find('.edit_child_form #age_under_18_no').prop('checked',true);
    				jQuery('body').find('.edit_child_form .input_mature_ageact').removeClass('age_under_active');
    				jQuery('body').find('.edit_child_form #age_under_18_no').parent().addClass('age_under_active');
    				jQuery('body').find('.edit_child_form .age_under_yes').hide();
    			}
				var editnewGuradnhtml = '';
				jQuery.each(jQuery(childs), function (index, item) {
					//index++;
    		 		editnewGuradnhtml += '<div class="guardian_names_dv guardian_names_dv_edit"><input type="text" data-attr="" data-value="'+index+'" data-id="" name="child_gurdian_names[]" id="" class="child_gurdian_names" value="'+item+'" disabled><span class="delete_guardian delete_guardian_ofChild"><i class="fa fa-times" aria-hidden="true"></i></span><span class="edit_guardian edit_guardian_ofChild upd_guardian_ofChild"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
			    });
    			jQuery('body').find('.edit_child_form #gardian_added_partner').html(editnewGuradnhtml);
				var editgrdDivlength = jQuery('body').find('.edit_child_form #gardian_added_partner .guardian_names_dv_edit').length;
				if(editgrdDivlength==2){
					jQuery('body').find('.edit_child_form .add_additional_partner_disable').css({'opacity':'0.2', 'pointer-events':'none'});
				}
	        }
		});
	});	
	});

	//Edit section
	//Update child data
	jQuery(document).on('click', '#child_upd_submit', function(e) {
		e.preventDefault();
		childname_validate_edit();
		mature_age_validate_edit();
		var chkeditgrdDivlength = jQuery('body').find('.edit_child_form #gardian_added_partner .guardian_names_dv_edit').length;

		if(chkeditgrdDivlength>0){
			jQuery(this).prop('disabled',false);
			jQuery(this).removeAttr('style');
			jQuery('body').find('.edit_child_form .wf_error_guardian_name_hidden').hide();
		}
		if(chkeditgrdDivlength==0){
			jQuery('body').find('#child_upd_submit').prop('disabled',true);
			jQuery('body').find('#child_upd_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find('.edit_child_form .wf_error_guardian_name_hidden').show();
			return false;
		}


		var wf_userid = jQuery('body').find('.edit_child_form #userid').val();
		var wf_child_name_edit = jQuery('body').find('.edit_child_form #wf_child_name').val();
		var agests_edit = jQuery('body').find('.edit_child_form input[name="age_under_18"]:checked').val();
		if(  wf_child_name_edit=='' ){
			return false;
		}
		if( agests_edit == 'no' && wf_child_name_edit=='' ){
			return false;
		}
		if( agests_edit == 'no' && wf_child_name_edit!='' ){
			call_ajax_func_edit();
		}
	 	if( jQuery('body').find(".edit_child_form #gurdian_addtional").hasClass("err_active") && wf_child_name_edit!=''){
			jQuery(this).prop('disabled',true);
			jQuery(this).attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.edit_child_form .wf_error_guardian_name_hidden').show();
			return false;
		} else {
			call_ajax_func_edit();
		}
	});

	//edit section
	jQuery('body').on('keyup', '.edit_child_form #wf_child_name',function(){
		childname_validate_edit();
	});
	function childname_validate_edit(){
		var errorFlag = true;
		var child_name_value_edit = jQuery('body').find('.edit_child_form #wf_child_name').val(); 
		if(child_name_value_edit.length ==''){
			jQuery('#child_upd_submit').prop('disabled',true);
			jQuery('#child_upd_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find('.edit_child_form .child_name_sectio').find('.wf_error_mesg').show();
			return false
		} else {
			jQuery('body').find('.edit_child_form .child_name_sectio').find('.wf_error_mesg').hide();
	   		jQuery('#child_upd_submit').prop('disabled',false);
			jQuery('#child_upd_submit').removeAttr('style');
			return true;
		}
	}
	function mature_age_validate_edit(){
		var agests = jQuery('input[name="age_under_18"]:checked').val();
		if (typeof agests === "undefined") {
			jQuery('#child_upd_submit').prop('disabled',true);
			jQuery('#child_upd_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.edit_child_form .matureage_about').find('.wf_error_mesg').show();
			return false
		} else {
			jQuery('.edit_child_form .matureage_about').find('.wf_error_mesg').hide();	   		
	   		jQuery('#child_upd_submit').prop('disabled',false);
			jQuery('#child_upd_submit').removeAttr('style');
			return true;
		}
	}

	//Edit section
	//Update child data ajax
	function call_ajax_func_edit(){
		var wf_userid_ed = jQuery('body').find('.edit_child_form #userid').val();
		var wf_child_name_edit = jQuery('body').find('.edit_child_form #wf_child_name').val();
		var editIndexNum = jQuery('body').find('.edit_child_form #valindex_to_update').val();
		var agests_edit = jQuery('body').find('.edit_child_form input[name="age_under_18"]:checked').val();
		var gudrian_names_edit = jQuery('body').find(".edit_child_form input[name='child_gurdian_names[]']").map(function(){return $(this).val();}).get();
		jQuery.ajax({
			type : "post",
	        url : children_dahsbaordajax,
	        data : { 
	    		'action': 'child_data_update',
	    		'wf_userid_edit':wf_userid_ed,
	    		'wf_child_name_edit':wf_child_name_edit,
	    		'age_under_edit':agests_edit,
	    		'editIndexNum':editIndexNum,
	    		'gudrian_names_edit':gudrian_names_edit
			},
			beforeSend: function(){
			    jQuery('#child_upd_submit').parent().find("#loader_imagedv_partner_popup").show();
			    jQuery('#child_upd_submit').addClass('submit_disable');
			},
	    	success: function(response32) {
	    		var myArray = JSON.parse(response32);
	    		jQuery('#child_upd_submit').parent().find("#loader_imagedv_partner_popup").hide();
			    jQuery('#child_upd_submit').removeClass('submit_disable');
	    		if(myArray.msg=="child_data_updated"){
	    			location.reload(true);
	    		}
	        }
		});
	}

	//edit section
	//Select Guardian from sidebar list
	jQuery('#edit_sidenav_add_guradian .gurdian-items-list').each(function(){	
		jQuery(this).click(function(e){			
			e.preventDefault();
			var edgrdDivlength = jQuery('body').find('.edit_child_form #gardian_added_partner .guardian_names_dv_edit').length;
			if(edgrdDivlength>0){
				jQuery('body').find('.edit_child_form .add_additional_partner_disable').css({'opacity':'0.2', 'pointer-events':'none'});
			}
			var slectedGurdainName_edt = jQuery(this).text();
			var select_gurdian_userid_edt = jQuery(this).attr('data-attr');
			var select_gurdianRowindex_edt = jQuery(this).attr('data-id');
			var primarExecName = jQuery(this).text();
			var incrDvIndex_edt = jQuery('body').find('.edit_child_form .guardian_names_dv_edit').length;
			var appnedGuradnhtml = '<div class="guardian_names_dv guardian_names_dv_edit"><input type="text" data-attr="'+select_gurdianRowindex_edt+'" data-value="'+incrDvIndex_edt+'" data-id="'+select_gurdian_userid_edt+'" name="child_gurdian_names[]" id="" class="child_gurdian_names" value="'+slectedGurdainName_edt+'" disabled><span class="delete_guardian delete_guardian_ofChild"><i class="fa fa-times" aria-hidden="true"></i></span><span class="edit_guardian edit_guardian_ofChild upd_guardian_ofChild"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
			jQuery('body').find(".edit_child_form #gurdian_addtional").removeClass("err_active");
			jQuery('body').find('.edit_child_form #child_upd_submit').prop('disabled',false);
			jQuery('body').find('.edit_child_form #child_upd_submit').removeAttr('style');
			//jQuery('.wf_error_guardian_name_hidden').hide();
			setTimeout(function() {
				jQuery('body').find('.edit_child_form #gardian_added_partner').append(appnedGuradnhtml);
				jQuery("#edit_sidenav_add_guradian").hide();
			},100);
		});
	});

	//Edit section
	//Add Guardian on sidebar submit
	jQuery('#guardian_save_btn_edit').click(function(e){
		e.preventDefault();
		if(jQuery('#add_guardians_input_edit').val()==''){
			jQuery('body').find('#guardian_save_btn_edit').prop('disabled',true);
			jQuery('body').find('#guardian_save_btn_edit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#add_guardians_input_edit').parent().find('.wf_error_mesg').show();
			return false;
		} else{
			jQuery('#add_guardians_input_edit').parent().find('.wf_error_mesg').hide();			
			var add_partner_userid_edit = jQuery('#add_partner_userid_edit').val();
			var partnername_edit = jQuery('#add_guardians_input_edit').val();
			jQuery('.edit_child_form .wf_error_guardian_name_hidden').hide();
			jQuery.ajax({
				type : "post",
		        url : children_dahsbaordajax,
		        data : { 'action': 'add_guardians', 'partnername':partnername_edit, 'userid':add_partner_userid_edit},
		        beforeSend: function(){
		        	jQuery("#edit_sidenav_add_guradian").hide();
				   	jQuery("#loader_imagedv_partner_popup").show();
				    jQuery('#guardian_save_btn_edit').addClass('submit_disable');
				},
		        success:function(response31){
	        	 	var resArray = JSON.parse(response31);
		        	jQuery("#loader_imagedv_partner_popup").hide();
				    jQuery('#guardian_save_btn_edit').removeClass('submit_disable');
				    var edgrdDivlength = jQuery('body').find('.edit_child_form #gardian_added_partner .guardian_names_dv_edit').length;
					if(edgrdDivlength>0){
						jQuery('body').find('.edit_child_form .add_additional_partner_disable').css({'opacity':'0.2', 'pointer-events':'none'});
					}

	        		if(resArray.msg == 'guardian_added'){
	        			var incrDvIndex_edit = jQuery('body').find('.guardian_names_dv_edit').length;
	        			var newGuradnhtml_edit = '<div class="guardian_names_dv guardian_names_dv_edit"><input type="text" data-attr="" data-value="'+incrDvIndex_edit+'" data-id="" name="child_gurdian_names[]" id="" class="child_gurdian_names" value="'+resArray.guadridnName+'" disabled><span class="delete_guardian delete_guardian_ofChild"><i class="fa fa-times" aria-hidden="true"></i></span><span class="edit_guardian edit_guardian_ofChild upd_guardian_ofChild"><i class="fa fa-pencil" aria-hidden="true"></i></span></div>';
        				jQuery('body').find('.edit_child_form #gardian_added_partner').append(newGuradnhtml_edit);
        				jQuery('#add_guardians_input_edit').val('');
			       	} 
		        }
		    });
		}
	}); 


	//Edit gurdian from poup
	jQuery('body').on('click','.upd_guardian_ofChild', function(){
		var editInputval_edit = jQuery(this).parent().find('input').val();
		//var editInputuserId = jQuery(this).parent().find('input').attr('data-id');
		//var editInputIndex = jQuery(this).parent().find('input').attr('data-attr');
		var data_indexnum = jQuery(this).parent().find('input').attr('data-value');
		var editInputuserId = jQuery('#userid').val();
		var popuphtmlff = '<div class="modal fade" id="basicModalupd" tabindex="-1" role="dialog" aria-labelledby="basicModalupd" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="editInputIndex" id="user_index"><input type="hidden" name="dataindex" value="'+data_indexnum+'" id="user_dataindex"><input type="hidden" name="user_id" value="'+editInputuserId+'" id="user_id"><input type="hidden" name="guardian_old_name_edit" value="'+editInputval_edit+'" id="guardian_old_name_edit"><input type="text" data-val="" name="update_partner_name" id="upd_guardian_name_edit" class="upd_guardian_name_edit" value="'+editInputval_edit+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editguardian" name="upd_action" id="update_editguardian_name">Save</button></div></div></div></form></div>';
	 	jQuery('body').find('#guardian_name_modal_edit').html(popuphtmlff);
        jQuery('body').find("#basicModalupd").modal('show');
	});

	//save updated partner name from sidebar
	jQuery('body').on('click','#update_editguardian_name', function(e) {
		e.preventDefault();
		var editInputval_edit = jQuery(this).parent().parent().find('#upd_guardian_name_edit').val();
		var guardian_old_name_edit = jQuery(this).parent().parent().find('#guardian_old_name_edit').val();
		var wf_userid = jQuery(this).parent().parent().find('#user_id').val();
		var user_dataindex = jQuery(this).parent().parent().find('#user_dataindex').val();
		if(editInputval_edit==''){
			//jQuery('#edit_guradina_name_modal').find('.wf_error_mesg').show();
			jQuery('#update_editguardian_name').prop('disabled',true);
			jQuery('#update_editguardian_name').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
		} else {
			jQuery('#update_editguardian_name').prop('disabled',false);
			jQuery('#update_editguardian_name').removeAttr('style');
			//jQuery('#edit_guradina_name_modal').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : children_dahsbaordajax,
		        data : {'action': 'updaet_guardians_name', 'upd_gurdaina_name_edit':editInputval_edit, 'userid':wf_userid,'guardian_old_name_edit':guardian_old_name_edit},
		        success:function(response33){
		        	var resArray = JSON.parse(response33);
		        	if(resArray.msg=='popupGuradinaDataupdated'){
		        	 	jQuery.each(jQuery('.child_gurdian_names'), function (index, item) {
	        		 		if(index==user_dataindex){
	        		 			jQuery(item).attr('value', resArray.newGardianNamepopup);
	        		 		}
					    });
	        			jQuery('#basicModalupd').modal('hide');
		        	}
		        }
		    });	
		}
	});

	//Validation edit gudrdian name on popup
	jQuery('body').on('keyup', '#upd_guardian_name_edit',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal==''){ 	
			jQuery('#guardian_name_modal_edit').find('.wf_error_mesg').show();	
			jQuery('#update_editguardian_name').prop('disabled',true);
			jQuery('#update_editguardian_name').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;   
		} else {
			jQuery('#guardian_name_modal_edit').find('.wf_error_mesg').hide();
			jQuery('#update_editguardian_name').prop('disabled',false);
			jQuery('#update_editguardian_name').removeAttr('style');
		}
	});


	

	jQuery('body').on('keyup', '#add_guardians_input_edit',function(e){
		if(jQuery('#add_guardians_input_edit').val()==''){
			jQuery('body').find('#guardian_save_btn_edit').prop('disabled',true);
			jQuery('body').find('#guardian_save_btn_edit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#add_guardians_input_edit').parent().find('.wf_error_mesg').show();
			return false;
		} else{
			jQuery('body').find('#guardian_save_btn_edit').prop('disabled',false);
			jQuery('body').find('#guardian_save_btn_edit').removeAttr('style');
			jQuery('body').find('#add_guardians_input_edit').parent().find('.wf_error_mesg').hide();			
		}
	});


}); //document end
</script>