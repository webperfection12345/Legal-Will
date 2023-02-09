<?php 
$user_id = get_current_user_id();
$user_data = wp_get_current_user();

if(isset($_GET['will'])){
	$queryurlval = $_GET['will'];
	if(!empty($queryurlval) && $queryurlval!=''){
		echo $queryurlval;
	}
}
$childrendata = get_user_meta($user_id, 'children_submitted_data',true);
$gtchildname = $childrendata['child_name'];
$gtmatureage = $childrendata['mature_age'];
$gtchildstatus = $childrendata['children_status'];

$willdePartners = get_user_meta($user_id, 'willed_partners',true);
?> 
   <div class="row">
         <div class="col-md-6">
            <div class="image">
               <a href="https://hlblawyers.com.au"><img src="https://hlblawyers.com.au/wp-content/uploads/2021/08/logo.jpg"></a>
            </div>
         </div>
         <div class="col-md-6">
            <div class="et_extitdash">
               <button type="button" class="" >
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
         <h3>Do you have any children?</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">
      <div class="col-md-7 col-12 ">
         <form id="children_form" class="children_form content_box_sections" action="" method="post" novalidate="novalidate">
            <a href="<?php echo $gotoEditulr.'?will=partner'; ?>"><span class="p-chip">Partner</span></a>
            <h4> Children </h4>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
               <div class="v-alert__wrapper">
                  <div class="v-alert__content mt_20">
                     <div class="w-label mb-2">Instructions</div>
                     <ul>
                        <li>Add your children, including adult and legally adopted children</li>
                        <li>Do not include step children if you have not legally adopted them</li>
                        <li>Any children under 18 years old will require you to nominate guardians</li>
                        <li>If you don't have children, skip this section by clicking Next</li>
                     </ul>
                  </div>
               </div>
               <div class="all_childDatfromDb">
                  <?php 
                  $Getall_childDatfromDb = get_user_meta($user_id, 'children_submitted_data',true);
                  if($Getall_childDatfromDb){
                     foreach ($Getall_childDatfromDb['child_data'] as $key => $Getall_childVal) {
                        $childnameList = $Getall_childVal['child_name'];
                        $childguardlistc = $Getall_childVal['guardian_name'];
                        ?>
                        <div class="eachPetItem eachchildItem" data-index="0">
                           <div class="PetitemContent">
                              <div class="petname petandpettype"><?php echo $childnameList; ?></div>
                              <?php 
                              if(!empty($childguardlistc)){ 
                              if($childguardlistc){
                           $ff = implode(',', $childguardlistc);
                           $childguardlist = $ff;

                        }
                          ?>
                              <div class="petname petandgardian"><strong>Guardians:</strong> <?php echo $childguardlist; ?></div>
                              <?php } ?>

                           </div>
                           <span class="edit_pet edit_childDt"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                           <span class="delete_pet deleteEachChild"><i class="fa fa-times" aria-hidden="true"></i></span>
                           <input type="hidden" name="serialise_petcontent" class="serialise_childcontent" data-id="<?php echo $user_id; ?>" data-row="<?php echo $key; ?>" data-val="<?php echo $childnameList; ?>">
                        </div>
                      <?php 
                     }
                  }
                  ?>
                     
               </div>
               
               <div class="add_additional_partner" id="add_child">Add Child</div>
               <div class="secion_sv_div" style="position: relative;">
                  <button type="button" class="section_next_btn" id="children_submit">Next</button>
                  <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
               </div>
         </form>

         <!-- Add Child form -->
         <div class="add_child_form content_box_sections" style="display:none;">
            <div id="backto_chilren_form"> Back</div>
            <h4> Add child</h4>
            <div class="form-row child_name_sectio">
               <label for="wf_child_name">Enter your full legal name</label>
               <input id="wf_child_name" class="form-control" type="text" name="wf_child_name" value="<?php if(!empty($gtchildname)){echo $gtchildname;}?>">
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <div class="form-row matureage_about">
               <p>Is this person under 18?</p>
               <label class="cst-input border_input_radio input_mature_ageact" for="">
                  <input class="age_under_18" type="radio" name="age_under_18" value="yes" <?php if($gtmatureage=='yes'){ echo 'checked="checked"';}?>>YES
               </label>
               <label class="cst-input border_input_radio2 input_mature_ageact" for="">
                  <input class="age_under_18" type="radio" name="age_under_18" value="no" <?php if($gtmatureage=='no'){ echo 'checked="checked"';}?>>NO
               </label>
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>

            <div class="age_under_yes" style="display:none;">
               <h4>Guardians</h4>
               <p>A guardian is an adult appointed by you in your Will to look after your minor children if you die and the other parent of the children dies. We recommend appointing trusted individuals who share your values as the guardians of your children (eg sibling or family friend).</p>
               <ul>
                  <li>Add 1 guardian or 2 joint guardians</li>
                  <li>Choose people who are 18 years or older</li>
                  <li>Do not nominate the other parent of this child</li>
               </ul>
               <div id="gurdian_addtional" class="married_addtional err_active" >
                  <div class="gardian_added" id="gardian_added_partner">
                        
                  </div>                 
                  <div style="" class="add_additional_partner add_additional_partner_disable" id="add_guardians" >Add a Guardian</div>
                  <span style="display: none;" class="wf_error_mesg wf_error_guardian_name_hidden">Required field</span>
               </div>
            </div>

            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="child_name_submit">Save</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </div>

         <!-- Edit Child form -->
         <div class="edit_child_form content_box_sections" style="display:none;">
            <div id="back_edit_chilren_form" ><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</div>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4> Edit child</h4>
            <div class="form-row child_name_sectio">
               <label for="wf_child_name">Enter your full legal name</label>
               <input id="wf_child_name" class="form-control edit_childname_val" type="text" name="wf_child_name" value="">
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <div class="form-row matureage_about">
               <p>Is this person under 18?</p>
               <label class="cst-input border_input_radio input_mature_ageact" for="">
                  <input class="age_under_18" type="radio" name="age_under_18" id="age_under_18_yes" value="yes">YES
               </label>
               <label class="cst-input border_input_radio2 input_mature_ageact" for="">
                  <input class="age_under_18" type="radio" name="age_under_18" id="age_under_18_no" value="no">NO
               </label>
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>

            <div class="age_under_yes" style="display:none;">
               <h4>Guardians</h4>
               <p>A guardian is an adult appointed by you in your Will to look after your minor children if you die and the other parent of the children dies. We recommend appointing trusted individuals who share your values as the guardians of your children (eg sibling or family friend).</p>
               <ul>
                  <li>Add 1 guardian or 2 joint guardians</li>
                  <li>Choose people who are 18 years or older</li>
                  <li>Do not nominate the other parent of this child</li>
               </ul>
               <div id="gurdian_addtional" class="married_addtional" >
                  <div class="gardian_added" id="gardian_added_partner">
                        
                  </div>                 
                  <div style="" class="add_additional_partner add_additional_partner_disable" id="add_guardians" >Add a Guardian</div>
                  <span style="display: none;" class="wf_error_mesg wf_error_guardian_name_hidden">Required field</span>
               </div>
            </div>
            <input type="hidden" name="" id="valindex_to_update">

            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="child_upd_submit">Save</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </div>

      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <div class="dashbaord_sidebar_section">
         <?php include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-sidebar-menu.php');  ?>
      </div>
      <!--col-md-4 offset-md-1 col-12   end  -->
   </div>

      <!-- <div id="addpartnerModal" class="modal fade right sidenav_add_guradian"> -->
      <nav class="sidenavbar" id="sidenav_add_guradian" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_add_gurardian"><i class="fa fa-close"></i></span>
            <h3>Add a Guardian</h3>

         </div>
         <p>Do not choose the other parent of this child. Choose who you would like to be the guardians if you and the other parent both passed away.</p>
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="gurdian-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_guardians_input" name="add_partner_name[]" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input value="<?php echo $user_id; ?>" id="add_partner_userid" name="" type="hidden">
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="" id="guardian_save_btn" style="" >Save</button><span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>     
      </nav>
      <!-- </div> -->
      <div id="edit_guradina_name_modal"></div>

      <!-- Sidebar for Edit Form -->
      <nav class="sidenavbar" id="edit_sidenav_add_guradian" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_add_gurardian"><i class="fa fa-close"></i></span>
            <h3>Add a Guardian</h3>
         </div>
         <p>Do not choose the other parent of this child. Choose who you would like to be the guardians if you and the other parent both passed away.</p>
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="gurdian-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_guardians_input_edit" name="add_partner_name[]" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input value="<?php echo $user_id; ?>" id="add_partner_userid_edit" name="" type="hidden">
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="" id="guardian_save_btn_edit" style="" >Save</button><span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>     
      </nav>   
      <div id="guardian_name_modal_edit"></div>