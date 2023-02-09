<script type="text/javascript">
jQuery(document).ready(function() {

	var pets_dahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';
	/***************************Pets submit*****************************/
	//Add only pet status
	jQuery(document).on('click', '#pet_submit', function(e) {
		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		jQuery.ajax({
			type : "post",
	        url : pets_dahsbaordajax,
	        data : { 
	    		'action': 'pets_dashboard',
	    		'wf_userid':wf_userid,
			},
			beforeSend: function(){
			    jQuery("#loader_imagedv_partner_popup").show();
			    jQuery('#pet_submit').addClass('submit_disable');
			},
	    	success: function(response) {
	    		var myArray = JSON.parse(response);
	    		jQuery("#loader_imagedv_partner_popup").hide();
			    jQuery('#pet_submit').removeClass('submit_disable');
	    		if(myArray.msg == "pets_updated"){
	    			var base_url = window.location.origin;
					nextpageurl = base_url+'/wfdashboard/?'+'will=executors';
	    			window.location.replace(nextpageurl);
	    		} 
	        }
		});
	});

	//Add pet data
	jQuery(document).on('click', '#pet_name_submit', function(e) {
		e.preventDefault();
		petname_validate();
		pettypes_validate();
		var petgudrianname = jQuery('#petgudrianname').val();
		if( jQuery("#hiddenGuardinaName").hasClass("errorAct")  ){
			jQuery('.wf_error_pet_name_hidden').show();
			return false;
		}
		if(petname_validate() === true && pettypes_validate() === true ){
			var wf_userid = jQuery('#userid').val();
			var wf_pet_name = jQuery('#wf_pet_name').val();
			var wf_pet_type = jQuery("#wf_pet_type").val(); 		
			var wf_giftsPrice = jQuery("#wf_giftsPrice").val(); 
			var wf_petgurdian = jQuery("#petgudrianname").val(); 
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : { 
		    		'action': 'pet_data_save',
		    		'wf_userid':wf_userid,
		    		'wf_pet_name':wf_pet_name,
		    		'wf_pet_type':wf_pet_type,
		    		'wf_guardian_name':petgudrianname,
		    		'wf_gift_maintenance':wf_giftsPrice,
		    		'wf_pet_status':1
				},
				beforeSend: function(){
				    jQuery('#pet_name_submit').parent().find("#loader_imagedv_partner_popup").show();
				    jQuery('#pet_name_submit').addClass('submit_disable');
				},
		    	success: function(response12) {
		    		var myArray = JSON.parse(response12);
		    		jQuery('#pet_name_submit').parent().find("#loader_imagedv_partner_popup").hide();
				    jQuery('#pet_name_submit').removeClass('submit_disable');
		    		if(myArray.msg == "pet_data_saved"){
		    			location.reload(true);
		    		}
		        }
			});
		}
	});

	jQuery('body').on('keyup', '#wf_pet_name',function(){
		petname_validate();
	});
	jQuery('body').on('keyup', '#wf_pet_type',function(){
		pettypes_validate();
	});
	jQuery('body').on('keyup', '#wf_edit_pet_name',function(){
		edit_petname_validate();
	});
	jQuery('body').on('keyup', '#wf_edit_pet_type',function(){
		edt_pettype_validate();
	});

	//pet name validation
	function petname_validate(){
		var pet_name_value = jQuery("#wf_pet_name").val(); 
		if(pet_name_value.length ==''){
			jQuery('#pet_name_submit').prop('disabled',true);
			jQuery('#pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_pet_name').parent().find('.wf_error_mesg').show();
			return false;
		} else {
			jQuery('#wf_pet_name').parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#pet_name_submit').prop('disabled',false);
			jQuery('#pet_name_submit').removeAttr('style');
			return true;
		}
	}

	// pet type validation
	function pettypes_validate(){
		var pet_name_value = jQuery("#wf_pet_type").val(); 
		if(pet_name_value.length ==''){
			jQuery('#pet_name_submit').prop('disabled',true);
			jQuery('#pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_pet_type').parent().find('.wf_error_mesg').show();
			return false
		} else {
			jQuery('#wf_pet_type').parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#pet_name_submit').prop('disabled',false);
			jQuery('#pet_name_submit').removeAttr('style');
			return true;
		}
	}

	//populate data when edit
	jQuery('body').on('keyup', 'input#wf_edit_pet_name',function(){
		jQuery('input#wf_edit_pet_name').attr('value',jQuery(this).val());
	});
	jQuery('body').on('keyup', 'input#wf_edit_pet_type',function(){
		jQuery('input#wf_edit_pet_type').attr('value',jQuery(this).val());
	});
	jQuery('body').on('keyup', 'input#wf_editgiftsPrice',function(){
		jQuery('input#wf_editgiftsPrice').attr('value',jQuery(this).val());
	});

	//Add Pet Guardian 
	jQuery('#pet_guardian_save_btn').click(function(e){
		e.preventDefault();
		if(jQuery('#add_petguardians_input').val()==''){
			jQuery('#add_petguardians_input').parent().find('.wf_error_mesg').show();
			jQuery('#pet_guardian_save_btn').prop('disabled',true);
			jQuery('#pet_guardian_save_btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_petguardians_input').parent().find('.wf_error_mesg').hide();			
			var add_partner_userid = jQuery('#add_petpartner_userid').val();
			var petguardian_name = jQuery("#add_petguardians_input").val(); 
			var age_under = jQuery('input[name="age_under_18"]:checked').val();
			var partnername = jQuery('#add_petguardians_input').val();
			jQuery('.wf_error_guardian_name_hidden').hide();
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : {'action':'add_petguardians','petguardian_name':petguardian_name,'userid':add_partner_userid},
		        beforeSend: function(){
				   	jQuery('body').find("#sidenav_add_petguradian #loader_imagedv_partner_popup").show();
				},
		        success:function(response){
		        	jQuery('body').find("#sidenav_add_guradian").hide();
				   	jQuery('body').find("#sidenav_add_petguradian #loader_imagedv_partner_popup").show();
	        	 	var resArray = JSON.parse(response);
		        	jQuery("#sidenav_add_petguradian #loader_imagedv_partner_popup").hide();
				    if(resArray.msg == 'petguardian_added'){
			    		var appnedGuradnhtml = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names  " id="petgudrianname" disabled value="'+resArray.guardnamechangeto+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner chane_petguardians_name" id="edit_petguardians">Edit Guardian</div>';
						jQuery("#hiddenGuardinaName").removeClass("errorAct");
						jQuery('#add_petguardians_input').val('');
						jQuery('#hiddenGuardinaName').html(appnedGuradnhtml);
						jQuery('.wf_error_pet_name_hidden').hide();
						jQuery('#add_petguardians').hide();
						jQuery('#sidenav_add_petguradian').hide();
				    }
		        }
		    });
		}
	}); 

	jQuery('body').on('keyup', '#add_petguardians_input',function(){
		if(jQuery('#add_petguardians_input').val()==''){
			jQuery('#add_petguardians_input').parent().find('.wf_error_mesg').show();
			jQuery('#pet_guardian_save_btn').prop('disabled',true);
			jQuery('#pet_guardian_save_btn').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_petguardians_input').parent().find('.wf_error_mesg').hide();	
			jQuery('#pet_guardian_save_btn').prop('disabled',false);
			jQuery('#pet_guardian_save_btn').removeAttr('style');

		}
	});

	//select pet guardian
	jQuery('.partner_itemslist').find('.petgurdian-items-list').each(function(){
		jQuery(this).click(function(){
			var petGudrdainName = jQuery(this).text();
			var appnedGuradnhtml = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names  " id="petgudrianname" disabled value="'+petGudrdainName+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner chane_petguardians_name" id="edit_petguardians">Edit Guardian</div>';
			jQuery("#hiddenGuardinaName").removeClass("errorAct");
			jQuery('body').find('#hiddenGuardinaName').html(appnedGuradnhtml);
			jQuery('.wf_error_pet_name_hidden').hide();
			jQuery('#add_petguardians').hide();
			setTimeout(function() {
				jQuery('#sidenav_add_petguradian').hide();
			},500);
		});
	})
	
	//open sidebar partners
	jQuery('#add_petguardians').click(function(){
		jQuery('#sidenav_add_petguradian').show(); 
		jQuery('#sidenav_add_petguradian').addClass('checkScroll'); 
	});
	jQuery('.close_add_gurardian').click(function(){
		jQuery('#sidenav_add_petguradian').removeClass('checkScroll'); 
		jQuery('#sidenav_add_petguradian ').css('display','none');
	}); 
	jQuery('body').on('click','#edit_petEachguardians', function(){
		jQuery('#sidenav_add_petguradian').show(); 
	});
	jQuery('body').on('click','.chane_petguardians_name', function(){
		jQuery('#sidenav_add_petguradian').show(); 
		jQuery('#sidenav_add_petguradian').addClass('checkScroll'); 
	});
	jQuery('.close_add_gurardian').click(function(){
		jQuery('#sidenav_add_petguradian').removeClass('checkScroll'); 
		jQuery('#sidenav_add_petguradian ').css('display','none');
	}); 

	jQuery('body').find('.sidenavbar').on('click','.petgurdian-items-list',function(){
		jQuery('.child_gurdian_names').val(jQuery(this).text());
	});

	//delete Each pet data 
	jQuery('.eachPetItem .delete_pet').each(function(){
		jQuery(this).click(function(e){
			e.preventDefault();
			if (!confirm("Do you want to delete")){
      			return false;
    		} else {
    			jQuery(this).parent('.eachPetItem').css({'background-color':'#ccc','opacity':' 0.2'});
			   	setTimeout(function() {
    				jQuery(this).parent('.eachPetItem').hide('slow');
		  		}, 300);
				var row_petname = jQuery(this).parent().find('input').attr('data-val');
				var row_pettype = jQuery(this).parent().find('input').attr('data-type');
				var row_index = jQuery(this).parent().find('input').attr('data-attr');
				var row_userid = jQuery(this).parent().find('input').attr('data-id');
				var row_giftVal = jQuery(this).parent().find('input').attr('data-row');
				jQuery.ajax({
					type : "post",
			        url : pets_dahsbaordajax,
			        data : { 
			    		'action': 'delete_pet',
			    		'wf_userid':row_userid,
			    		'wf_pet_index':row_index,
					},
			    	success: function(response22) {
			    		var myArray = JSON.parse(response22);
			    		if(myArray.msg == "pet_deleted"){
			    			location.reload(true);
			    		}
			        }
				});
			}
		});
	});


	//Edit gurdian in popup
	jQuery('body').on('click','.edit_pet_gurdianNAmeonPopup',function(){
		var editInputval = jQuery(this).parent().find('input').val();
		var editInputIndex = jQuery(this).parent().find('input').attr('data-attr');
		var wf_userid = jQuery('#userid').val();
		var popuphtml = '<div class="modal fade" id="basicModal2" tabindex="-1" role="dialog" aria-labelledby="basicModal2" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index"><input type="hidden" name="user_id" value="'+wf_userid+'" id="user_id"><input type="hidden" name="petguardian_old_name" value="'+editInputval+'" id="petguardian_old_name"><input type="text" data-val="'+editInputval+'" name="update_partner_name" id="upd_petguardian_name" class="upd_petguardian_name" value="'+editInputval+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editpetguardian" name="upd_action" id="save_editpetguardian">Save</button><span id="loader_imagedv_partner_popupddddd" style="display: none;"><img class="image_loader partner_save_loading" src="https://hlblawyers.com.au/wp-content/plugins/willed/assets/images/loader_img.jpg"></span></div></div></div></form></div>';
	 	jQuery('#edit_petguradina_name_modal').html(popuphtml);
        jQuery("#basicModal2").modal('show');
		//});
	});


	//save updated pet partner name popup
	jQuery('body').on('click','#save_editpetguardian', function(e) {
		e.preventDefault();
		var editInputval = jQuery(this).parent().parent().find('#upd_petguardian_name').val();
		var guardian_old_name = jQuery(this).parent().parent().find('#petguardian_old_name').val();
		var wf_userid = jQuery(this).parent().parent().find('#user_id').val();
		if(editInputval==''){ 
			jQuery('document').find('#edit_petguradina_name_modal').find('.wf_error_mesg').show();	
			jQuery('#save_editpetguardian').prop('disabled',true);
			jQuery('#save_editpetguardian').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_edit_pet_type').parent().find('.wf_error_mesg').show();
			return false;   
		} else {	
			jQuery('#save_editpetguardian').removeAttr('style');
			jQuery('#save_editpetguardian').prop('disabled',false);
			jQuery('body').find('#edit_petguradina_name_modal').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : { 'action': 'edit_petguardians_name', 'upd_gurdaina_name':editInputval, 'userid':wf_userid,'guardian_old_name':guardian_old_name},
	        	beforeSend: function(){
				    jQuery('#save_editpetguardian').parent().find("#loader_imagedv_partner_popupddddd").show();
				    jQuery('#save_editpetguardian').addClass('submit_disable');
				},
		        success:function(res){	
		        	console.log(res);
		        	var resArray = JSON.parse(res);
		        	if(resArray.msg == 'pet_popupDataSave'){
		        		var appnedGuradnhtmlonADd = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names  " id="petgudrianname" disabled value="'+resArray.gurdina_name+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner chane_petguardians_name" id="edit_petguardians">Edit Guardian</div>';
						jQuery('body').find('.add_pet_form #hiddenGuardinaName').html(appnedGuradnhtmlonADd);
		        		jQuery('#basicModal2').modal('hide');
		        	}
		        }
		    });	

		}
	});

	//edit gudrdian name on popup
	jQuery('body').on('keyup', '.upd_petguardian_name',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal.length>0){ 	
			jQuery('#edit_petguradina_name_modal').find('.wf_error_mesg').hide();
			jQuery('#save_editpetguardian').prop('disabled',false);
			jQuery('#save_editpetguardian').removeAttr('style');
		} else {
			jQuery('#edit_petguradina_name_modal').find('.wf_error_mesg').show();
			jQuery('#save_editpetguardian').prop('disabled',true);
			jQuery('#save_editpetguardian').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');	
			return false;   
		}
	});

	jQuery('body').on('keyup','#wf_giftsPrice', function(event) {
		this.value = this.value.replace(/[^0-9]/g, '');
		var dbdaylength = this.value.length;
	   	if(dbdaylength > 7 ){
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#pet_name_submit').prop('disabled',true);
			jQuery('#pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;	
		} else{
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#pet_name_submit').prop('disabled',false);
			jQuery('#pet_name_submit').removeAttr('style');
		}
	}); 

	//Next add pet information box  
	jQuery('#add_pet').click(function(){
		jQuery('#pets_form').hide();
		jQuery('.add_pet_form').show();
	});
	jQuery('.backto_pets_form').click(function(){
		jQuery('.add_pet_form').hide();
		jQuery('.edit_pet_section').hide();
		jQuery('#pets_form').show();
	});











	/**********************************EDIT SECTION**********************************/
	/****************************/////************/////**********************************/
	/////////////////////////////////////////////////////////////////////////////////////

	jQuery('body').on('click','.edit_change_petguardians', function(){
		jQuery('#edit_sidenav_petguradian').show(); 
	});
	jQuery('#edit_sidenav_petguradian .close_add_gurardian').click(function(){
		jQuery('#edit_sidenav_petguradian ').css('display','none');
	}); 

	//Edit Each pet data 
	jQuery('.eachPetItem .edit_pet').each(function(){
		jQuery(this).click(function(e){
			e.preventDefault();
			var userID = jQuery(this).parent().find('input').attr('data-id');
			var indexNumbrtoUpdc = jQuery(this).parent().find('input').attr('data-attr');
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : { 
		    		'action': 'pets_data_edit',
		    		'wf_userid':userID,
		    		'indexNumbrtoUpd':indexNumbrtoUpdc
				},
		    	success: function(response33) {
		    		var myArray = JSON.parse(response33);
		    		var petName = myArray.rtnPetname;
		    		var petType = myArray.rtnPetType;
		    		var petGudrdainName = myArray.rtnPetGurdian;
		    		var giftprice = myArray.rtnPetgiftpric;
		    		var petRowIndex= myArray.rtnPetrowIndex;
		    		jQuery('body').find('#pets_form').hide();
		    		jQuery('body').find('.edit_pet_section').show();
		    		jQuery('body').find('.edit_pet_section #wf_edit_pet_name').attr('value',petName);
		    		jQuery('body').find('.edit_pet_section #wf_edit_pet_type').attr('value',petType);
		    		jQuery('body').find('.edit_pet_section #wf_editgiftsPrice').attr('value',giftprice);
		    		jQuery('body').find('.edit_pet_section #row_index').attr('value',petRowIndex);	 
		    		var editgurdiaNamehtml = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names" id="petgudrianname" disabled value="'+petGudrdainName+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup_onEdit" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner edit_change_petguardians " id="edit_petguardians">Edit Guardian</div> ';   
		    		jQuery('body').find('.edit_pet_section #hiddenGuardinaName').html(editgurdiaNamehtml);
		        }
			});
		});
	}) ;


	//select pet guardian
	jQuery('#edit_sidenav_petguradian').find('.petgurdian-items-list').each(function(){
		jQuery(this).click(function(){
			var petGudrdainNamedt = jQuery(this).text();
			var appnedGuradnhtml_edit = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names" id="petgudrianname" disabled value="'+petGudrdainNamedt+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup_onEdit" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner edit_change_petguardians " id="edit_petguardians">Edit Guardian</div> ';
			jQuery('body').find(".edit_pet_section #hiddenGuardinaName").removeClass("errorAct");
			jQuery('body').find('.edit_pet_section #hiddenGuardinaName').html(appnedGuradnhtml_edit);
			setTimeout(function() {
				jQuery('#edit_sidenav_petguradian').hide();
			},100);
		});
	})

	//Add Pet Guardian 
	jQuery('body').find('#pet_guardian_add_onEdit').click(function(e){
		e.preventDefault();
		if(jQuery('#add_petguardians_inputonEdit').val()==''){
			jQuery('#add_petguardians_inputonEdit').parent().find('.wf_error_mesg').show();
			jQuery('#pet_guardian_add_onEdit').prop('disabled',true);
			jQuery('#pet_guardian_add_onEdit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_petguardians_inputonEdit').parent().find('.wf_error_mesg').hide();			
			var add_partner_userid = jQuery('#add_petpartner_userid').val();
			var petguardian_name = jQuery("#add_petguardians_inputonEdit").val(); 
			var partnername = jQuery('#add_petguardians_inputonEdit').val();
			jQuery('.wf_error_guardian_name_hidden').hide();
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : { 'action': 'add_petguardians', 'petguardian_name':petguardian_name, 'userid':add_partner_userid},
		        beforeSend: function(){
				   	jQuery('body').find("#edit_sidenav_petguradian #loader_imagedv_partner_popup").show();
				},
		        success:function(response){
				   	jQuery('body').find("#edit_sidenav_petguradian #loader_imagedv_partner_popup").hide();
		        	jQuery("#sidenav_add_guradian").hide('slow');
	        	 	var resArray = JSON.parse(response);
				    if(resArray.msg == 'petguardian_added'){
			    		var appnedGuradnhtml = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names  " id="petgudrianname" disabled value="'+resArray.guardnamechangeto+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup_onEdit" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner chane_petguardians_name" id="edit_petguardians">Edit Guardian</div>';
						jQuery('body').find('.edit_pet_section #hiddenGuardinaName').removeClass("errorAct");
						jQuery('#add_petguardians_inputonEdit').val('');
						jQuery('body').find('.edit_pet_section #hiddenGuardinaName').html(appnedGuradnhtml);
						jQuery('.wf_error_pet_name_hidden').hide();
						jQuery('#add_petguardians').hide();
						jQuery('#edit_sidenav_petguradian').hide();
				    }
		        }
		    });
		}
	}); 

	//validation keyup
	jQuery('body').on('keyup', '#add_petguardians_inputonEdit',function(){
		if(jQuery('#add_petguardians_inputonEdit').val()==''){
			jQuery('#add_petguardians_inputonEdit').parent().find('.wf_error_mesg').show();
			jQuery('#pet_guardian_add_onEdit').prop('disabled',true);
			jQuery('#pet_guardian_add_onEdit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#add_petguardians_inputonEdit').parent().find('.wf_error_mesg').hide();	
			jQuery('#pet_guardian_add_onEdit').prop('disabled',false);
			jQuery('#pet_guardian_add_onEdit').removeAttr('style');

		}
	});

	//Edit pet name validation
	function edit_petname_validate(){
		var pet_name_value = jQuery("#wf_edit_pet_name").val(); 
		if(pet_name_value.length ==''){
			jQuery('#update_pet_name_submit').prop('disabled',true);
			jQuery('#update_pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_edit_pet_name').parent().find('.wf_error_mesg').show();
			return false;
		} else {
			jQuery('#wf_edit_pet_name').parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#update_pet_name_submit').prop('disabled',false);
			jQuery('#update_pet_name_submit').removeAttr('style');
			return true;
		}
	}

	// Edit pet type validation
	function edt_pettype_validate(){
		var pet_name_value = jQuery("#wf_edit_pet_type").val(); 
		if(pet_name_value.length ==''){
			jQuery('#update_pet_name_submit').prop('disabled',true);
			jQuery('#update_pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_edit_pet_type').parent().find('.wf_error_mesg').show();
			return false
		} else {
			jQuery('#wf_edit_pet_type').parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#update_pet_name_submit').prop('disabled',false);
			jQuery('#update_pet_name_submit').removeAttr('style');
			return true;
		}
	}

	jQuery('body').on('keyup','.edit_pet_section #wf_editgiftsPrice', function(event) {
		this.value = this.value.replace(/[^0-9]/g, '');
		var dbdaylength = this.value.length;
	   	if(dbdaylength > 7 ){
	   		//jQuery(this).addClass('wf_error_mesg');
	   		jQuery(this).parent().find('.wf_error_mesg').show();
	   		jQuery('#update_pet_name_submit').prop('disabled',true);
			jQuery('#update_pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;	
		} else{
	   		jQuery(this).parent().find('.wf_error_mesg').hide();	   		
	   		jQuery('#update_pet_name_submit').prop('disabled',false);
			jQuery('#update_pet_name_submit').removeAttr('style');
		}
	});


	//edit gudrdian name on popup
	jQuery('body').on('keyup', '#petguradina_name_for_edit .upd_petguardian_name_edit',function(){
		var upd_partVal = jQuery(this).val();
		if(upd_partVal.length>0){ 	
			jQuery('#petguradina_name_for_edit').find('.wf_error_mesg').hide();
			jQuery('#petguradina_name_for_edit #save_editpetguardian').prop('disabled',false);
			jQuery('#petguradina_name_for_edit #save_editpetguardian').removeAttr('style');
		} else {
			jQuery('#petguradina_name_for_edit').find('.wf_error_mesg').show();
			jQuery('#petguradina_name_for_edit #save_editpetguardian').prop('disabled',true);
			jQuery('#petguradina_name_for_edit #save_editpetguardian').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');	
			return false;   
		}
	});


	//update pet data
	jQuery(document).on('click','.update_pet_data_submit', function () {
		var wf_userid = jQuery('#edit_pet_section #userid').attr('value');
		var edit_petname = jQuery('#edit_pet_section input#wf_edit_pet_name').attr('value');
		var edit_pettype = jQuery('#edit_pet_section input#wf_edit_pet_type').attr('value');
		var wf_giftsPrice = jQuery('#edit_pet_section #wf_editgiftsPrice').attr('value');
		var wf_petgurdian = jQuery('#edit_pet_section #petgudrianname').attr('value');
		var row_index = jQuery('#edit_pet_section #row_index').attr('value');
		if(edit_petname =='' ){
			jQuery('#update_pet_name_submit').prop('disabled',true);
			jQuery('#update_pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_edit_pet_type').parent().find('.wf_error_mesg').show();
			return false;
		} else if(edit_pettype ==''){
			jQuery('#update_pet_name_submit').prop('disabled',true);
			jQuery('#update_pet_name_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_edit_pet_name').parent().find('.wf_error_mesg').show();
			return false;
		} else {			
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : { 
		    		'action': 'pet_upatedata_save',
		    		'wf_userid':wf_userid,
		    		'wf_pet_name':edit_petname,
		    		'wf_pet_type':edit_pettype,
		    		'wf_guardian_name':wf_petgurdian,
		    		'wf_gift_maintenance':wf_giftsPrice,
		    		'wf_row_index':row_index,
		    		'wf_pet_status':1
				},
				beforeSend: function(){
				    jQuery('#update_pet_name_submit').parent().find("#loader_imagedv_partner_popup").show();
				    jQuery('#update_pet_name_submit').addClass('submit_disable');
				},
		    	success: function(response16) {
		    		var myArray = JSON.parse(response16);
		    		jQuery('#update_pet_name_submit').parent().find("#loader_imagedv_partner_popup").hide();
				    jQuery('#update_pet_name_submit').removeClass('submit_disable');
		    		if(myArray.msg == "pet_data_updated"){
		    			location.reload(true);
		    		}
		        }
			});
		} 
	});


	//Edit gurdian in popup
	jQuery('body').on('click','.edit_pet_gurdianNAmeonPopup_onEdit',function(){
		var editInputval = jQuery(this).parent().find('input').val();
		var editInputIndex = jQuery(this).parent().find('input').attr('data-attr');
		var wf_userid = jQuery('#userid').val();
		var popuphtml = '<div class="modal fade" id="basicModa14" tabindex="-1" role="dialog" aria-labelledby="basicModa14" aria-hidden="true"><div class="modal-dialog">  <div class="modal-content">  <div class="modal-header"><h4 class="modal-title" id="myModalLabel">Edit Person</h4> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><form action="" method="post"><div class="modal-body"> <h3>Full legal name</h3><input type="hidden" name="index" value="'+ editInputIndex +'" id="user_index"><input type="hidden" name="user_id" value="'+wf_userid+'" id="user_id_edit"><input type="hidden" name="petguardian_old_name_edit" value="'+editInputval+'" id="petguardian_old_name"><input type="text" data-val="'+editInputval+'" name="update_partner_name" id="upd_petguardian_name_edit" class="upd_petguardian_name_edit" value="'+editInputval+'"><span style="display: none;" class="wf_error_mesg">Required field</span></div> <div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="submit" class="btn btn-primary save_editpetguardian" name="upd_action" id="save_editpetguardian">Save</button><span id="loader_imagedv_partner_popupddddd" style="display: none;"><img class="image_loader partner_save_loading" src="https://hlblawyers.com.au/wp-content/plugins/willed/assets/images/loader_img.jpg"></span></div></div></div></form></div>';
	 	jQuery('#petguradina_name_for_edit').html(popuphtml);
        jQuery("#basicModa14").modal('show');
	});

	//save updated pet partner name popup
	jQuery('body').on('click','#petguradina_name_for_edit #save_editpetguardian', function(e) {
		e.preventDefault();
		var editInputval = jQuery(this).parent().parent().find('#upd_petguardian_name_edit').val();
		var guardian_old_name = jQuery(this).parent().parent().find('#petguardian_old_name_edit').val();
		var wf_userid = jQuery(this).parent().parent().find('#user_id_edit').val();
		if(editInputval==''){
			jQuery('document').find('#edit_petguradina_name_modal').find('.wf_error_mesg').show();	
			jQuery('#petguradina_name_for_edit #save_editpetguardian').prop('disabled',true);
			jQuery('#petguradina_name_for_edit #save_editpetguardian').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('#wf_edit_pet_type').parent().find('.wf_error_mesg').show();
			return false;   
		} else  {	
			jQuery('#petguradina_name_for_edit #save_editpetguardian').removeAttr('style');
			jQuery('#petguradina_name_for_edit #save_editpetguardian').prop('disabled',false);
			jQuery('body').find('#edit_petguradina_name_modal').find('.wf_error_mesg').hide();
			jQuery.ajax({
				type : "post",
		        url : pets_dahsbaordajax,
		        data : { 'action': 'edit_petguardians_name', 'upd_gurdaina_name':editInputval, 'userid':wf_userid,'guardian_old_name':guardian_old_name},
	        	beforeSend: function(){
				    jQuery('#petguradina_name_for_edit #save_editpetguardian').parent().find("#loader_imagedv_partner_popupddddd").show();
				    jQuery('#petguradina_name_for_edit #save_editpetguardian').addClass('submit_disable');
				},
		        success:function(response34){	
		        	console.log(response34);
		        	var resArray = JSON.parse(response34);
		        	if(resArray.msg == 'pet_popupDataSave'){
		        		var appnedGuradnhtmlonADds = '<div id="gudraianNameCont" class="guardian_names_dv gudraianNameCont"><input type="text" class="child_gurdian_names  " id="petgudrianname" disabled value="'+resArray.gurdina_name+'"><span class="edit_pet edit_pet_gurdianNAmeonPopup" id="edit_petgurdian"><i class="fa fa-pencil" aria-hidden="true"></i></span></div><div class="add_additional_partner chane_petguardians_name" id="edit_petguardians">Edit Guardian</div>';
						jQuery('body').find('.edit_pet_section #hiddenGuardinaName').html(appnedGuradnhtmlonADds);
		        		jQuery('#basicModa14').modal('hide');
		        	}
		        }
		    });	
		} 
	});
	
}); //document end
</script>