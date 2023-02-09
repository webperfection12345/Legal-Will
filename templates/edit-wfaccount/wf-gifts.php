<?php 
if(isset($_GET['will'])){
   $queryurlval = $_GET['will'];
   if(!empty($queryurlval) && $queryurlval!=''){
      echo $queryurlval;
   }
}

$charitynameData = get_user_meta($user_id, 'devide_estate_charity_name_submitted_data',true);
?> 
<style>.black--text ul li {display: list-item;color: #000;}.black--text{background-color: aliceblue;padding: 20px;border-radius: 6px;margin-bottom: 40px;}</style>

   <div class="row">
         <div class="col-md-6">
            <div class="image">
               <a href="https://hlblawyers.com.au"><img src="https://hlblawyers.com.au/wp-content/uploads/2021/08/logo.jpg"></a>
            </div>
         </div>
         <div class="col-md-6">
            <div class="et_extitdash">
               <button type="button" class="exit_dashbord" >
                  <?php 
                  if (is_user_logged_in()) : ?>
                  <a href="<?php echo $gotoEditulr; ?>">Exit to Dashboard</a>
                  <?php 
                  endif;?>            
               </button>
            </div>   
         </div>
         <div class="spacer"></div>
   </div>

   <div class="row title-row">
      <div class="col-md-7 offset-md-0 col-12">
         <h3>Would you like to leave any gifts?</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">

      <?php 
      $GettAllGfitforEdit = get_user_meta( $user_id, 'gift_submitted_data', true );
     // if(!empty($GettAllGfitforEdit)){
      ?>
         <!---------------------- Edit Gift section  ------------------->
         <div class="col-md-7 col-12 edit_gift">
            <!-- Gift-->
            <form id="giftSecionFirst" class="giftSecionFirst content_box_sections"  method="post" novalidate="novalidate">
               <a href="<?php echo $gotoEditulr.'?will=divideEstate'; ?>"><span class="p-chip">Divide Estate </span></a>
               <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
               <h4 class="mt_20">Gifts</h4>
               <p class="mt-3">
                  You can leave specific gifts to a loved one or to a charity. Items that are commonly gifted to a person or charity include money, motor vehicles, shares, collectables, jewellery or art. Would you like to leave any gifts to a particular person?
               </p>
               <div class="black--text" bis_skin_checked="1">
                  <div class="w-label mb-2">Instructions</div>
                  <ul>
                     <li>Leave gifts of money or assets to family, friends or charities.</li>
                     <li>Gifts are deducted from your estate before it is divided amongst the beneficiaries you nominated in the Divide Estate section.</li>
                     <li>If you don't wish to leave any gifts, click the 'Next' button to continue.</li>
                  </ul>
               </div>
               <?php 
               foreach($GettAllGfitforEdit['gift_data'] as  $rowindex=>$Allgift_data_gt){
                  // echo '<pre>';
                  // print_r($Allgift_data_gt);
                  // echo '</pre>';
                  
                  $gift_person_name = $Allgift_data_gt['gift_person_name'];
                  $gift_type = $Allgift_data_gt['gift_type'];
                  $gift_type_value = $Allgift_data_gt['gift_type_value'];
                  $gift_roindex = $rowindex ;
                  ?>
                  <div class="eachPetItem eachGiftItem" data-index="<?php echo $gift_roindex; ?>">
                     <div class=PetitemContent>
                        <div class="petname petandpettype"><?php if(is_numeric($gift_type_value)){echo '$';} echo $gift_type_value;?></div>
                        <div class="petname petandgardian">Recipient: <?php echo $gift_person_name; ?></div>
                     </div>
                     <span class="edit_pet edit_eachgift"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                     <span class="delete_pet del_eachgift"><i class="fa fa-times" aria-hidden="true"></i></span>
                     <input type="hidden" name="serialise_petcontent" class="serialise_petcontent" data-id= "<?php echo $user_id; ?>" data-type="<?php echo $gift_type; ?>" data-row="<?php echo $gift_roindex; ?>" data-val="<?php echo $gift_type_value;?>" value="<?php echo $gift_person_name; ?>">
                  </div>
               <?php 
               }?>
               <div class="add_additional_partner next_to_gift_beneficaries" >Add a gift</div>
               <div class="secion_sv_div" style="position: relative;">
                  <button type="button" class="section_next_btn" id="gift_submit">Next</button>
                  <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
               </div>
            </form>

            <!-- edit Gift Recipient -->
            <form id="giftSecionSecondedit" class="giftSecionSecond content_box_sections" method="post" novalidate="novalidate" style="display:none">
               <input type="hidden" name="" id="gift_person_name_bkp">
               <input type="hidden" name="" id="gift_type_bkp">
               <input type="hidden" name="" id="gift_type_val_bkp">
               <input type="hidden" name="" id="gift_typerow_index">

               <span class="back_to_main_gift"><span class="p-chip">Back </span></span>
               <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
               <h4 class="mt_20">Gift Recipient</h4>
               <h3>Who would you like to leave this gift to?</h3>
               <p class="mt-3">You can select a person or a charity to give a gift to.</p>
               <div class="married_addtional gift_no_addperson_div">
                  <div class="partner_added devide_partner_added_area"></div>
                  <div class="add_additional_partner add_giftwithSideNav" >Add person</div>
                  <span style="display: none;" class="wf_error_mesg wf_error_charity_name_hidden">Required field</span>
                  <div class="add_additional_chairty">
                     <div class="all_charity_list">
                        <h3>Add Charity</h3>
                        <div class="row">
                           <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                              <div class="chrityeachdiv_inner">
                                 <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                                 <div class="imag_container">
                                    <p class="charitryname">Plan International Australia</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                              <div class="chrityeachdiv_inner">
                              <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid ">
                              <div class="imag_container">
                              <p class="charitryname">World Wide Fund For Nature Australia</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                               </div>
                           </div>
                           <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                              <div class="chrityeachdiv_inner">
                              <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                              <div class="imag_container">
                              <p class="charitryname">National Breast Cancer Foundation</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                               </div>
                           </div>
                           <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                              <div class="chrityeachdiv_inner">
                              <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                              <div class="imag_container">
                              <p class="charitryname">St John WA</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                               </div>
                           </div>
                           <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                              <div class="chrityeachdiv_inner">
                                 <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                                 <div class="imag_container">
                                    <p class="charitryname">Beyond Blue</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                 
               </div>
               <div class="gift_added_person_div">
                    <div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont charity_name_dv"><input name="" type="text" class="child_gurdian_names gift_person_name" id="gift_person_name" disabled value="<?php echo $gift_person_name; ?>"></div><div class="add_additional_partner change_personfor_gift" >Change Recipient</div>
               </div>
               
               <div class="secion_sv_div" style="position: relative;">
                  <button type="button" class="section_next_btn" id="Edit_gift_recipient_submit">Next</button>
                  <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
               </div>
            </form>

            <!-- Edit Enter Gift -->
            <form id="giftSecionThirdedit" class="giftSecionThird content_box_sections"  method="post" novalidate="novalidate" style="display:none;">
               <input type="hidden" name="" id="gift_person_name_bkp_amt">
               <input type="hidden" name="" id="gift_type_bkp_amt">
               <input type="hidden" name="" id="gift_type_val_bkp_amt">
               <input type="hidden" name="" id="gift_typerow_index_amt">

               <span href="" class="back_to_gift_recepient"><span class="p-chip">Back </span></span>
               <input type="hidden" id="gift_userid" name="userid" value="<?php echo $user_id; ?>">
               <h4 class="mt_20">Enter Gift</h4>
               <h3>What type of gift would you like to leave them?</h3>
               <p class="mt-3">Select one of the options below.</p>
               <div class="gift_wrap_cont">
                  <div class="gift_options_cont">
                     <div class="Gift_div radio-toolbar Gift_radio_container "> 
                        <div class="Gift_div Gift_div_inner">
                           <div class="radio_icon">
                              <input type="radio" id="money_gift" class="gift_type" name="gift_type" value="money">
                           </div>
                           <div class="radio_content">
                              <label for="radio1">Money</label>
                              <p>Leave a set dollar amount (eg. $1000)</p>
                           </div>
                        </div>
                     </div>
                     <div class="Gift_div radio-toolbar Gift_radio_container ">   
                        <div class="Gift_div Gift_div_inner">   
                           <div class="radio_icon">
                              <input type="radio" class="gift_type" id="asset_gift" name="gift_type" value="asset">
                           </div>
                           <div class="radio_content">
                              <label for="radio1">Asset or Personal Item</label>
                              <p>Leave an asset or item (eg. property, vehicle, furniture, jewellery)</p>
                           </div>
                        </div>
                     </div>
                     <span style="display: none;" class="wf_error_mesg wf_error_gift_recip_hidden">Required field</span>
                  </div>
                  <div id="money_gift_section" class="enter_gift_options money_gift_section" style="display: none;">
                     <div class="form-row et_from_tell_about">
                        <label for="wf_giftamount"><strong>Enter Amount (AUD)</strong></label>
                        <input id="wf_giftamount" class="wf_giftamount" type="text" name="wf_giftamount" value="">
                         <span style="display: none;" class="wf_error_mesg wf_error_mesg_number">Can't leave zero dollars</span>
                         <span style="display: none;" class="wf_error_mesg">Required field</span>
                     </div>
                  </div>
                  <div id="asset_gift_section" class="enter_gift_options asset_gift_section" style="display: none;">
                     <div class="form-row et_from_tell_about">
                        <label for="wf_giftasset"><strong>I would like to leave my...</strong></label>
                        <input id="wf_giftasset" class="wf_giftasset" type="text" name="wf_giftasset" />
                        <span style="display: none;" class="wf_error_mesg">Required field</span>
                     </div>
                     <p><strong>Note:</strong> The description of the item being gifted should be limited to the item itself and not include any extra information or messages.</p>
                  </div>
               </div>
               <div class="secion_sv_div" style="position: relative;">
                  <button type="button" class="section_next_btn" id="upd_gift_enter_submit">Next</button>
                  <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
               </div>
            </form>
         <!-- </div> -->
         <!----------------------End Edit Gift section  ------------------->
      <?php 
      //} else {
      ?>
      <!----------------------Add Gift section  ------------------->
      <!-- <div class="col-md-7 col-12 "> -->
         <!-- Gift-->
<!--          <form id="giftSecionFirst" class="giftSecionFirst content_box_sections"  method="post" novalidate="novalidate">
            <a href="<?php //echo $gotoEditulr.'?will=divideEstate'; ?>"><span class="p-chip">Divide Estate </span></a>
            <input type="hidden" id="userid" name="userid" value="<?php //echo $user_id; ?>">
            <h4 class="mt_20">Gifts</h4>
            <p class="mt-3">
               You can leave specific gifts to a loved one or to a charity. Items that are commonly gifted to a person or charity include money, motor vehicles, shares, collectables, jewellery or art. Would you like to leave any gifts to a particular person?
            </p>
            <div class="black--text" bis_skin_checked="1">
               <div class="w-label mb-2">Instructions</div>
               <ul>
                  <li>Leave gifts of money or assets to family, friends or charities.</li>
                  <li>Gifts are deducted from your estate before it is divided amongst the beneficiaries you nominated in the Divide Estate section.</li>
                  <li>If you don't wish to leave any gifts, click the 'Next' button to continue.</li>
               </ul>
            </div>
            <div class="add_additional_partner next_to_gift_beneficaries" >Add a gift</div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="gift_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php //echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form> -->

         <!-- Gift Recipient -->
         <form id="giftSecionSecond" class="giftSecionSecond content_box_sections" method="post" novalidate="novalidate" style="display:none">
            <span class="back_to_main_gift"><span class="p-chip">Back </span></span>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Gift Recipient</h4>
            <h3>Who would you like to leave this gift to?</h3>
            <p class="mt-3">You can select a person or a charity to give a gift to.</p>
            <div class="married_addtional gift_no_addperson_div err_active">
               <div class="partner_added devide_partner_added_area"></div>
               <div class="add_additional_partner add_giftwithSideNav" >Add person</div>
               <span style="display: none;" class="wf_error_mesg wf_error_charity_name_hidden">Required field</span>
               <div class="add_additional_chairty">
                  <div class="all_charity_list">
                     <h3>Add Charity</h3>
                     <div class="row">
                        <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                           <div class="chrityeachdiv_inner">
                              <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                              <div class="imag_container">
                                 <p class="charitryname">Plan International Australia</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                           <div class="chrityeachdiv_inner">
                           <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid ">
                           <div class="imag_container">
                           <p class="charitryname">World Wide Fund For Nature Australia</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                           </div>
                            </div>
                        </div>
                        <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                           <div class="chrityeachdiv_inner">
                           <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                           <div class="imag_container">
                           <p class="charitryname">National Breast Cancer Foundation</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                           </div>
                            </div>
                        </div>
                        <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                           <div class="chrityeachdiv_inner">
                           <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                           <div class="imag_container">
                           <p class="charitryname">St John WA</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                           </div>
                            </div>
                        </div>
                        <div class="col-md-6 chrityeachdiv chrityEachdivGift" style="">
                           <div class="chrityeachdiv_inner">
                              <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                              <div class="imag_container">
                                 <p class="charitryname">Beyond Blue</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <span style="display: none;" class="wf_error_mesg wf_error_gift_recip_hidden">Required field</span>
            </div>
            <div class="gift_added_person_div"></div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="gift_recipient_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>

         <!-- Enter Gift -->
         <form id="giftSecionThird" class="giftSecionThird content_box_sections"  method="post" novalidate="novalidate" style="display:none;">
            <span href="" class="back_to_gift_recepient"><span class="p-chip">Back </span></span>
            <input type="hidden" id="gift_userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Enter Gift</h4>
            <h3>What type of gift would you like to leave them?</h3>
            <p class="mt-3">Select one of the options below.</p>
            <div class="gift_wrap_cont">
               <div class="gift_options_cont">
                  <div class="Gift_div radio-toolbar Gift_radio_container "> 
                     <div class="Gift_div Gift_div_inner">
                        <div class="radio_icon">
                           <input type="radio" id="money_gift" class="gift_type" name="gift_type" value="money">
                        </div>
                        <div class="radio_content">
                           <label for="radio1">Money</label>
                           <p>Leave a set dollar amount (eg. $1000)</p>
                        </div>
                     </div>
                  </div>
                  <div class="Gift_div radio-toolbar Gift_radio_container ">   
                     <div class="Gift_div Gift_div_inner">   
                        <div class="radio_icon">
                           <input type="radio" class="gift_type" id="asset_gift" name="gift_type" value="asset">
                        </div>
                        <div class="radio_content">
                           <label for="radio1">Asset or Personal Item</label>
                           <p>Leave an asset or item (eg. property, vehicle, furniture, jewellery)</p>
                        </div>
                     </div>
                  </div>
                  <span style="display: none;" class="wf_error_mesg wf_error_gift_recip_hidden">Required field</span>
               </div>
               <div id="money_gift_section" class="enter_gift_options money_gift_section" style="display: none;">
                  <div class="form-row et_from_tell_about">
                     <label for="wf_giftamount"><strong>Enter Amount (AUD)</strong></label>
                     <input id="wf_giftamount" class="wf_giftamount" type="text" name="wf_giftamount" value="">
                      <span style="display: none;" class="wf_error_mesg wf_error_mesg_number">Can't leave zero dollars</span>
                      <span style="display: none;" class="wf_error_mesg">Required field</span>
                  </div>
               </div>
               <div id="asset_gift_section" class="enter_gift_options asset_gift_section" style="display: none;">
                  <div class="form-row et_from_tell_about">
                     <label for="wf_giftasset"><strong>I would like to leave my...</strong></label>
                     <input id="wf_giftasset" class="wf_giftasset" type="text" name="wf_giftasset" />
                     <span style="display: none;" class="wf_error_mesg">Required field</span>
                  </div>
                  <p><strong>Note:</strong> The description of the item being gifted should be limited to the item itself and not include any extra information or messages.</p>
               </div>
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="gift_enter_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>
      </div>
      <!----------------------End Add Gift section  ------------------->
   <?php// } ?>


      <div class="col-md-4 offset-md-1 col-12">
         <div class="dashbaord_sidebar_section">
         <?php include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-sidebar-menu.php');  ?>
         <!--col-md-4 offset-md-1 col-12   end  -->
      </div>
   </div>

      <nav class="sidenavbar" id="sidenav_add_gift" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_add_partner"><i class="fa fa-close"></i></span>
            <h3>Select recipient</h3>
         </div>
         <hr class="divider">   
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="gift-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_charityname_input" name="add_partner_name[]" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input value="<?php echo $user_id; ?>" id="add_charityname_userid" name="" type="hidden">
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="" id="new_charity_save_btn" style="" >Save</button><span id="loader_imagedv_chairtrynane_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>
      </nav>

   <div id="edit_charity_name_modal"></div>
