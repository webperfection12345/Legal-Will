<script type="text/javascript">
jQuery(document).ready(function() {
	var gift_dahsbaordajax = '<?php echo admin_url('admin-ajax.php');?>';
	
	/***************************Gift submit*****************************/
	jQuery(document).on('click', '#gift_submit', function(e) {
		e.preventDefault();
		var wf_userid = jQuery('#userid').val();
		jQuery.ajax({
			type : "post",
	        url : gift_dahsbaordajax,
	        data : { 
	    		'action': 'gift_dashboard',
	    		'wf_userid':wf_userid,
			},
			beforeSend: function(){
			    jQuery('body').find("#loader_imagedv_partner_popup").show();
			    jQuery('#gift_submit').addClass('submit_disable');
			},
	    	success: function(response20) {
	    		//console.log(response20.msg)
	    		var myArray = JSON.parse(response20);
	    		jQuery('body').find("#loader_imagedv_partner_popup").hide();
			    jQuery('#gift_submit').removeClass('submit_disable');
	    		if(myArray.msg == "gift_submited"){
	    			//location.reload(true);
	    			//alert('updates');
	    			var base_url = window.location.origin;
					nextpageurl = base_url+'/wfdashboard/?'+'will=funeralWishes';
	    			window.location.replace(nextpageurl);
	    		}
	        }
		});
	});
	
	jQuery('.next_to_gift_beneficaries').click(function(){
		jQuery('#giftSecionFirst').hide();
		jQuery('body').find('#giftSecionSecondedit').hide();
		jQuery('#giftSecionSecond').show();
	});



	jQuery('.back_to_main_gift').click(function(){
		jQuery('#giftSecionFirst').show();
		jQuery('#giftSecionSecond').hide();
	});

	

	jQuery('#giftSecionSecondedit .back_to_main_gift').click(function(){
		jQuery('#giftSecionFirst').show();
		jQuery('#giftSecionSecond').hide();
	});

	jQuery('.back_to_gift_recepient').click(function(){
		jQuery('#giftSecionFirst').hide();
		jQuery('#giftSecionThird').hide();
		jQuery('#giftSecionSecond').show();
	});
	


	//show right sidenav(partner) 
	jQuery('.add_giftwithSideNav').click(function(){
		jQuery('#sidenav_add_gift').show(); 
	});
	jQuery('body').on('click','.close_add_partner', function(){
		jQuery('#sidenav_add_gift').hide();
	}); 


	//select charity partner
	jQuery(document).find('.gift-items-list').each(function(){
		jQuery(this).click(function(){
			var charityExecName = jQuery(this).text();
			var appnedcharityhtml = '<div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont charity_name_dv"><input name="charitynameImg[]" type="text" class="child_gurdian_names gift_person_name" id="gift_person_name" disabled value="'+charityExecName+'"></div><div class="add_additional_partner change_personfor_gift" >Change Recipient</div>';
			jQuery(document).find(".gift_no_addperson_div").removeClass("err_active");
			jQuery("#gift_recipient_submit").prop('disabled',false);
			jQuery("#gift_recipient_submit").removeAttr('style');
			jQuery("#gift_recipient_submit").removeAttr('disabled');
			jQuery('.wf_error_gift_recip_hidden').hide();
			jQuery('.gift_no_addperson_div').hide();
			jQuery('body').find('.gift_added_person_div').html(appnedcharityhtml);
			jQuery('.gift_added_person_div').attr('style','display:block');
			setTimeout(function() {
				jQuery('#sidenav_add_gift').hide();
			},100);
		});
	});

	//add charity name in gift (image)
	jQuery('body').on('click','.chrityEachdivGift', function() {
		var charitname = jQuery(this).find('.charitryname').text();
		var appnedcharityhtml = '<div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont charity_name_dv"><input name="" type="text" class="child_gurdian_names gift_person_name" id="gift_person_name" disabled value="'+charitname+'"></div><div class="add_additional_partner change_personfor_gift" >Change Recipient</div>';
			jQuery(document).find(".gift_no_addperson_div").removeClass("err_active");
			jQuery("#gift_recipient_submit").prop('disabled',false);
			jQuery("#gift_recipient_submit").removeAttr('style');
			jQuery("#gift_recipient_submit").removeAttr('disabled');
			jQuery('.wf_error_gift_recip_hidden').hide();
			jQuery('.gift_no_addperson_div').hide();
			jQuery('body').find('.gift_added_person_div').html(appnedcharityhtml);
			jQuery('.gift_added_person_div').attr('style','display:block');
	});

	//change Gift person 
	jQuery('body').on('click','.change_personfor_gift',function(){
		jQuery('.gift_no_addperson_div').show();
		jQuery(document).find(".gift_no_addperson_div").addClass("err_active");
		jQuery('body').find('.gift_added_person_div').hide();
		jQuery('body').find('.gift_added_person_div').html('');
	});


	//goto_Enter_Gift_section
	//var gift_person_nameVal;
	jQuery('body').on('click','#gift_recipient_submit', function() {
		if( jQuery(".gift_no_addperson_div").hasClass("err_active") ){
			jQuery('#gift_recipient_submit').prop('disabled',true);
			jQuery('#gift_recipient_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('body').find('.wf_error_charity_name_hidden').show();
			return false;
		}
		jQuery('#giftSecionFirst').hide();
		jQuery('#giftSecionSecond').hide();
		jQuery('#giftSecionThird').show();
	});

	jQuery('body').on('click','#giftSecionThird #gift_enter_submit', function() {
		var giftValfsts = jQuery('#giftSecionThird input[name="gift_type"]:checked').val();
		//alert(giftValfsts);
		if(! jQuery('#giftSecionThird input[name=gift_type]:checked').val() ){
			jQuery('#giftSecionThird #gift_enter_submit').prop('disabled',true);
			jQuery('#giftSecionThird #gift_enter_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.gift_options_cont').find('.wf_error_mesg').show();
			return false;
		} 
		if( giftValfsts=='money' && jQuery('#giftSecionThird #wf_giftamount').val() !=''){
			//alert('moneywithval');
			jQuery('#giftSecionThird #wf_giftasset').parent().find('.wf_error_mesg').hide();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',false);
			jQuery("#giftSecionThird #gift_enter_submit").removeAttr('style');
			//return true;
			gift_ajaxsbt();
		} 
		if( giftValfsts=='money' && jQuery('#giftSecionThird #wf_giftamount').val() ==''){
			//alert('moneywithoutval');
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg').show();
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg_number').hide();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',true);
			jQuery("#giftSecionThird #gift_enter_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} 
		if( giftValfsts=='asset' && jQuery('#giftSecionThird #wf_giftasset').val() !=''){
			//alert('assetwithval');
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg').hide();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',false);
			jQuery("#giftSecionThird #gift_enter_submit").removeAttr('style');
			//return true;
			gift_ajaxsbt();
		} 
		 if( giftValfsts=='asset' && jQuery('#giftSecionThird #wf_giftasset').val() ==''){
			//alert('assetwithoutval');
			jQuery('#giftSecionThird #wf_giftasset').parent().find('.wf_error_mesg').show();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',true);
			jQuery("#giftSecionThird #gift_enter_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} 
	});

	//gift data save
	function gift_ajaxsbt(){
		var gift_person_nameVal =jQuery('body').find('.gift_added_person_div #gift_person_name').val();
		var wf_userid = jQuery('#gift_userid').val();
		var wf_giftamount = jQuery('body').find('#giftSecionThird #wf_giftamount').val();
		var wf_giftAsset = jQuery('body').find('#giftSecionThird #wf_giftasset').val();
		var wf_giftTypeValue = jQuery('#giftSecionThird input[name="gift_type"]:checked').val();
		jQuery.ajax({
			type : "post",
	        url : gift_dahsbaordajax,
	        data : { 
	    		'action': 'gift_dataSave',
	    		'wf_userid':wf_userid,
	    		'wf_giftamount':wf_giftamount,
	    		'wf_giftAsset':wf_giftAsset,
	    		'wf_giftTypeValue':wf_giftTypeValue,
	    		'wf_giftPersonName':gift_person_nameVal
			},
			beforeSend: function(){
			    jQuery('#giftSecionThird #gift_enter_submit').parent().find("#loader_imagedv_partner_popup").show();
			    jQuery('#giftSecionThird #gift_recipient_submit').addClass('submit_disable');
			},
	    	success: function(response20) {
	    		//console.log(response20.msg)
	    		var myArray = JSON.parse(response20);
	    		jQuery('body').find("#loader_imagedv_partner_popup").hide();
			    jQuery('#gift_recipient_submit').removeClass('submit_disable');
	    		if(myArray.msg == "gift_data_saved"){
	    			//alert('gift_recipient_submit');
	    			location.reload(true);
	    			//alert('updates');
	    			//var base_url = window.location.origin;
					//nextpageurl = base_url+'/wfdashboard/?'+'will=funeralWishes';
	    			//window.location.replace(nextpageurl);
	    		}
	        }
		});
	}

	jQuery('body').on('change','#giftSecionThird .gift_type', function(){
		var giftValsts = jQuery('input[name="gift_type"]:checked').val();
		//alert(giftValsts);
		if(giftValsts.length!=''){
			jQuery('#giftSecionThird #gift_enter_submit').prop('disabled',false);
			jQuery('#giftSecionThird #gift_enter_submit').removeAttr('style');
			jQuery('.gift_options_cont').find('.wf_error_mesg').hide();
			if(giftValsts=='money' ){
				setTimeout(function() {
					jQuery('#giftSecionThird #wf_giftasset').parent().find('.wf_error_mesg').hide();
					jQuery('#giftSecionThird #asset_gift_section').hide(); 
					jQuery('#giftSecionThird #money_gift_section').show(); 
				 }, 380);
			} else if(giftValsts=='asset' ){
				setTimeout(function() {
					jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg').hide();
					jQuery('#giftSecionThird #asset_gift_section').show(); 
					jQuery('#giftSecionThird #money_gift_section').hide(); 
			 	}, 380);
			}
		}
	});
	
	//validation on gift ammount
	jQuery('body').on('keyup', '#giftSecionThird #wf_giftamount',function(e){
		jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, '') );
		if(jQuery('#giftSecionThird #wf_giftamount').val()==''){
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg').hide();
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg_number').show();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',true);
			jQuery("#giftSecionThird #gift_enter_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg').hide();
			jQuery('#giftSecionThird #wf_giftamount').parent().find('.wf_error_mesg_number').hide();	
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',false);
			jQuery("#giftSecionThird #gift_enter_submit").removeAttr('style');
			return true		
		}
	}); 

	//validation on gift assest
	jQuery('body').on('keyup', '#giftSecionThird #wf_giftasset',function(e){
		if(jQuery('#giftSecionThird #wf_giftasset').val()==''){
			jQuery('#giftSecionThird #wf_giftasset').parent().find('.wf_error_mesg').show();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',true);
			jQuery("#giftSecionThird #gift_enter_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} else{
			jQuery('#giftSecionThird #wf_giftasset').parent().find('.wf_error_mesg').hide();
			jQuery("#giftSecionThird #gift_enter_submit").prop('disabled',false);
			jQuery("#giftSecionThird #gift_enter_submit").removeAttr('style');
			return true		
		}
	}); 


	/*************Edit/Update gift section**********/
	//delete Each gift data 
	jQuery('.eachGiftItem .del_eachgift').each(function(){
		jQuery(this).click(function(e){
			e.preventDefault();
			if (!confirm("Do you want to delete")){
      			return false;
    		} else {
    			jQuery(this).parent('.eachGiftItem').css({'background-color':'#ccc','opacity':' 0.2'});
			   	setTimeout(function() {
    				jQuery(this).parent('.eachGiftItem').hide('slow');
		  		}, 300);
				var row_giftpersonName = jQuery(this).parent().find('input').attr('value');
				var row_giftType = jQuery(this).parent().find('input').attr('data-type');
				var row_gifttype_value = jQuery(this).parent().find('input').attr('data-val');
				var row_giftUserid = jQuery(this).parent().find('input').attr('data-id');
				var row_giftRowIndex = jQuery(this).parent().find('input').attr('data-row');
				jQuery.ajax({
					type : "post",
			        url : gift_dahsbaordajax,
			        data : { 
			    		'action': 'delete_gift',
			    		'wf_userid':row_giftUserid,
			    		'wf_row_index':row_giftRowIndex,
					},
			    	success: function(response23) {
			    		var myArray = JSON.parse(response23);
			    		if(myArray.msg == "gift_deleted"){
			    			location.reload(true);
			    		}
			        }
				});
			}
		});
	});

	jQuery('.edit_gift .edit_eachgift').click(function(){
		jQuery('#giftSecionFirst').hide();
		jQuery('.edit_gift #giftSecionFirstedit').hide();
		jQuery('.edit_gift #giftSecionSecondedit').show();
		jQuery('.edit_gift .gift_no_addperson_div').hide();
		var row_giftpersonName = jQuery(this).parent().find('input').attr('value');
		var row_giftType = jQuery(this).parent().find('input').attr('data-type');
		var row_gifttype_value = jQuery(this).parent().find('input').attr('data-val');
		var row_giftUserid = jQuery(this).parent().find('input').attr('data-id');
		var row_giftRowIndex = jQuery(this).parent().find('input').attr('data-row');
		
		jQuery('.edit_gift #gift_person_name').val(row_giftpersonName); 
		jQuery('.edit_gift #gift_person_name_bkp').val(row_giftpersonName); 
		jQuery('.edit_gift #gift_type_bkp').val(row_giftType); 
		jQuery('.edit_gift #gift_type_val_bkp').val(row_gifttype_value); 
		jQuery('.edit_gift #gift_typerow_index').val(row_giftRowIndex); 
	
	});

	//change Gift person 
	jQuery('body').on('click','.edit_gift .change_personfor_gift',function(){
		jQuery('.gift_no_addperson_div').show();
		jQuery(document).find(".edit_gift .gift_no_addperson_div").addClass("err_active");
		jQuery('body').find('.edit_gift .gift_added_person_div').hide();
		jQuery('body').find('.edit_gift .gift_added_person_div').html('');
	});

	jQuery('body').on('click','.edit_gift #Edit_gift_recipient_submit', function() {
		var gift_person_name_bkp_amt = jQuery('body').find('.edit_gift #gift_person_name').val(); 
		var gift_type_bkp_amt = jQuery('body').find('.edit_gift #gift_type_bkp').val(); 
		var gift_type_val_bkp_amt = jQuery('body').find('.edit_gift #gift_type_val_bkp').val(); 
		var gift_typerow_index_amt = jQuery('body').find('.edit_gift #gift_typerow_index').val(); 

		jQuery('body').find('.edit_gift #gift_person_name_bkp_amt').val(gift_person_name_bkp_amt); 
		jQuery('body').find('.edit_gift #gift_type_bkp_amt').val(gift_type_bkp_amt); 
		jQuery('body').find('.edit_gift #gift_type_val_bkp_amt').val(gift_type_val_bkp_amt);
		jQuery('body').find('.edit_gift #gift_typerow_index_amt').val(gift_typerow_index_amt);

		setTimeout(function() {
			var giftype = jQuery('body').find('#gift_type_bkp_amt').val();
			var gift_ed_type_val = jQuery('body').find('.edit_gift #gift_type_val_bkp_amt').val();
			//alert(giftype);
			if(giftype=='money'){
				jQuery('body').find('#giftSecionThirdedit #money_gift').prop('checked',true);
				jQuery('body').find('#giftSecionThirdedit #money_gift_section').show();
				jQuery('body').find('#giftSecionThirdedit #asset_gift_section').hide();
				jQuery('body').find('#giftSecionThirdedit #wf_giftamount').val(gift_ed_type_val);
			}
			if(giftype=='asset'){
				jQuery('body').find('#giftSecionThirdedit #asset_gift').prop('checked',true);
				jQuery('body').find('#giftSecionThirdedit #asset_gift_section').show();
				jQuery('body').find('#giftSecionThirdedit #money_gift_section').hide();
				jQuery('body').find('#giftSecionThirdedit #wf_giftasset').val(gift_ed_type_val);
			}
			jQuery('body').find('#giftSecionSecondedit').hide();
			jQuery('body').find('#giftSecionThirdedit').show();
		},200);
	});

	//update btn
	jQuery('body').on('click','#upd_gift_enter_submit', function() {
		var edt_giftValfsts = jQuery('#giftSecionThirdedit input[name="gift_type"]:checked').val();
		if(! jQuery('#giftSecionThirdedit input[name=gift_type]:checked').val() ){
			jQuery('#upd_gift_enter_submit').prop('disabled',true);
			jQuery('#upd_gift_enter_submit').attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			jQuery('.gift_options_cont').find('.wf_error_mesg').show();
			return false;
		} 
		if( edt_giftValfsts=='money' && jQuery('#giftSecionThirdedit #wf_giftamount').val() !=''){
			//alert('moneywithval');
			jQuery('#giftSecionThirdedit #wf_giftasset').parent().find('.wf_error_mesg').hide();
			jQuery("#upd_gift_enter_submit").prop('disabled',false);
			jQuery("#upd_gift_enter_submit").removeAttr('style');
			//return true;
			giftUpd_ajaxsbt();
		} 
		if( edt_giftValfsts=='money' && jQuery('#giftSecionThirdedit #wf_giftamount').val() ==''){
			//alert('moneywithoutval');
			jQuery('#giftSecionThirdedit #wf_giftamount').parent().find('.wf_error_mesg').show();
			jQuery('#giftSecionThirdedit #wf_giftamount').parent().find('.wf_error_mesg_number').hide();
			jQuery("#upd_gift_enter_submit").prop('disabled',true);
			jQuery("#upd_gift_enter_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} 
		if( edt_giftValfsts=='asset' && jQuery('#giftSecionThirdedit #wf_giftasset').val() !=''){
			//alert('assetwithval');
			jQuery('#giftSecionThirdedit #wf_giftamount').parent().find('.wf_error_mesg').hide();
			jQuery("#upd_gift_enter_submit").prop('disabled',false);
			jQuery("#upd_gift_enter_submit").removeAttr('style');
			//return true;
			giftUpd_ajaxsbt();
		} 
		 if( edt_giftValfsts=='asset' && jQuery('#giftSecionThirdedit #wf_giftasset').val() ==''){
			//alert('assetwithoutval');
			jQuery('#giftSecionThirdedit #wf_giftasset').parent().find('.wf_error_mesg').show();
			jQuery("#upd_gift_enter_submit").prop('disabled',true);
			jQuery("#upd_gift_enter_submit").attr('style','border-color: #ccc;background-color: #c1c6d0!important;color: #fff!important;');
			return false;
		} 
	});

/*	jQuery('body').on('change','#giftSecionThirdedit .gift_type', function(){
		var giftValsts = jQuery('#giftSecionThirdedit input[name="gift_type"]:checked').val();
		if(giftValsts.length!=''){
			jQuery('#gift_enter_submit').prop('disabled',false);
			jQuery('#gift_enter_submit').removeAttr('style');
			jQuery('.gift_options_cont').find('.wf_error_mesg').hide();
			if(giftValsts=='money' ){
				setTimeout(function() {
					jQuery('#giftSecionThirdedit #wf_giftasset').parent().find('.wf_error_mesg').hide();
					jQuery('#giftSecionThirdedit #asset_gift_section').hide(); 
					jQuery('#giftSecionThirdedit #money_gift_section').show(); 
				 }, 380);
			} else if(giftValsts=='asset' ){
				setTimeout(function() {
					jQuery('#giftSecionThirdedit #wf_giftamount').parent().find('.wf_error_mesg').hide();
					jQuery('#giftSecionThirdedit #asset_gift_section').show(); 
					jQuery('#giftSecionThirdedit #money_gift_section').hide(); 
			 	}, 380);
			}
		}
	});
*/
	//gift data save
	function giftUpd_ajaxsbt(){
		var ed_gift_person_nameVal =jQuery('body').find('#giftSecionThirdedit #gift_person_name_bkp_amt').val();
		var ed_wf_userid = jQuery('body').find('#giftSecionThirdedit #gift_userid').val();
		var ed_wf_giftamount = jQuery('body').find('#giftSecionThirdedit #wf_giftamount').val();
		var ed_wf_giftAsset = jQuery('body').find('#giftSecionThirdedit #wf_giftasset').val();
		var ed_wf_giftTypeValue = jQuery('body').find('#giftSecionThirdedit input[name="gift_type"]:checked').val();
		var ed_wf_giftIndex = jQuery('body').find('#giftSecionThirdedit #gift_typerow_index_amt').val();
		jQuery.ajax({
			type : "post",
	        url : gift_dahsbaordajax,
	        data : { 
	    		'action': 'gift_dataUpd',
	    		'ed_wf_userid':ed_wf_userid,
	    		'ed_wf_giftamount':ed_wf_giftamount,
	    		'ed_wf_giftAsset':ed_wf_giftAsset,
	    		'ed_wf_giftType':ed_wf_giftTypeValue,
	    		'ed_wf_giftPersonName':ed_gift_person_nameVal,
	    		'ed_wf_giftIndexVal':ed_wf_giftIndex,
			},
			beforeSend: function(){
			    jQuery('#upd_gift_enter_submit').parent().find("#loader_imagedv_partner_popup").show();
			    jQuery('#upd_gift_enter_submit').addClass('submit_disable');
			},
	    	success: function(response21) {
	    		//console.log(response20.msg)
	    		var myArray = JSON.parse(response21);
	    		jQuery('body').find("#loader_imagedv_partner_popup").hide();
			    jQuery('#upd_gift_enter_submit').removeClass('submit_disable');
	    		if(myArray.msg == "gift_data_updated"){
	    			location.reload(true);
	    		}
	        }
		});
	}

	//edit keup gift type
	jQuery('body').on('change','#giftSecionThirdedit .gift_type', function(){
		var giftValsts = jQuery('input[name="gift_type"]:checked').val();
		alert(giftValsts);
		if(giftValsts.length!=''){
			jQuery('#giftSecionThirdedit #gift_enter_submit').prop('disabled',false);
			jQuery('#giftSecionThirdedit #gift_enter_submit').removeAttr('style');
			jQuery('.gift_options_cont').find('.wf_error_mesg').hide();
			if(giftValsts=='money' ){
				setTimeout(function() {
					jQuery('#giftSecionThirdedit #wf_giftasset').parent().find('.wf_error_mesg').hide();
					jQuery('#giftSecionThirdedit #asset_gift_section').hide(); 
					jQuery('#giftSecionThirdedit #money_gift_section').show(); 
				 }, 380);
			} else if(giftValsts=='asset' ){
				setTimeout(function() {
					jQuery('#giftSecionThirdedit #wf_giftamount').parent().find('.wf_error_mesg').hide();
					jQuery('#giftSecionThirdedit #asset_gift_section').show(); 
					jQuery('#giftSecionThirdedit #money_gift_section').hide(); 
			 	}, 380);
			}
		}
	});
	

	jQuery('.edit_gift .back_to_main_gift').click(function(){
		jQuery('.edit_gift #giftSecionFirstedit').show();
		jQuery('.edit_gift #giftSecionSecondedit').hide();
	});
	jQuery('#giftSecionThirdedit .back_to_gift_recepient').click(function(){
		//jQuery('.edit_gift #giftSecionFirstedit').hide();
		jQuery('#giftSecionSecondedit').show();
		jQuery('#giftSecionThirdedit').hide();
	});



}); //document end
</script>