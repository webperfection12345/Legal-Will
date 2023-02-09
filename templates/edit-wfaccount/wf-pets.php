<?php 
$user_id = get_current_user_id();
$user_data = wp_get_current_user();

if(isset($_GET['will'])){
	$queryurlval = $_GET['will'];
	if(!empty($queryurlval) && $queryurlval!=''){
	}
}
$petsdata = get_user_meta($user_id, 'pet_submitted_data',true);
$gtchildname = $petsdata['child_name'];
$gtmatureage = $petsdata['mature_age'];
$gtchildstatus = $petsdata['children_status'];
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
         <h3>Do you have any pets?</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">
      <div class="col-md-7 col-12">
         <form id="pets_form" class="pets_form content_box_sections" action="" method="post" novalidate="novalidate">
            <a href="<?php echo $gotoEditulr.'?will=children'; ?>"><span class="p-chip">Children</span></a>
            <h4> Pets </h4>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
               <div class="v-alert__wrapper">
                  <div class="v-alert__content mt_20">
                     <div class="w-label mb-2">Instructions</div>
                     <ul>
                        <li>Add your pets, and who you would like to take care of them</li>
                        <li>If you don't have any pets click Next to continue making your Will</li>
                     </ul>
                  </div>
               </div>
               <div class="AllpetsContainer" id="allpetsContainer">
                  <?php  
                  $Allpet_data_get = get_user_meta($user_id, 'pet_submitted_data',true);
                  $nullpetdataIndex = $Allpet_data_get[0]['pet_name'];  
                  if(!empty($Allpet_data_get) && !empty($nullpetdataIndex ) ){
                     foreach($Allpet_data_get as  $key=>$Allpet_data_gt){
                        $petIndex = $key;
                        $petName = $Allpet_data_gt['pet_name'];
                        $petType = $Allpet_data_gt['pet_type'];
                        $guardianName = $Allpet_data_gt['guardian_name'];
                        $gift_maintenance = $Allpet_data_gt['gift_maintenance'];
                        ?>
                        <div class="eachPetItem" data-index="<?php echo $petIndex; ?>">
                           <div class=PetitemContent>
                              <div class="petname petandpettype"><?php echo $petName;?> (<?php echo $petType; ?>) </div>
                              <div class="petname petandgardian">Leave to: <?php echo $guardianName; ?></div>
                           </div>
                           <span class="edit_pet"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                           <span class="delete_pet"><i class="fa fa-times" aria-hidden="true"></i></span>
                           <input type="hidden" name="serialise_petcontent" class="serialise_petcontent" data-id= "<?php echo $user_id; ?>" data-type="<?php echo $petType; ?>" data-attr="<?php echo $petIndex; ?>" data-row="<?php echo $gift_maintenance; ?>" data-val="<?php echo $petName; ?>"  data-name="<?php echo $guardianName; ?>">
                        </div>
                     <?php 
                     }
                  }  else{}
                  ?>

               </div>
               <div class="add_additional_partner" id="add_pet">Add Pet</div>
               <div class="secion_sv_div" style="position: relative;">
                  <button type="button" class="section_next_btn" id="pet_submit">Next</button>
                  <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
               </div>
         </form>
         <!-- add pet -->
         <div class="add_pet_form content_box_sections" style="display:none;">
            <div id="backto_pets_form" class="backto_pets_form"> Back</div>
            <h4> Add pet</h4>
            <div class="form-row child_name_sectio pet_name_sectio">
               <label for="wf_pet_name">Pet's name</label>
               <input id="wf_pet_name" class="form-control" type="text" name="wf_pet_name" value="">
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <div class="form-row child_name_sectio pet_name_sectio">
               <label for="wf_pet_type">Pet type</label>
               <input id="wf_pet_type" class="form-control" placeholder="eg. Dog, Cat, Iguana, etc" type="text" name="wf_pet_type" value="">
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <div id="gurdian_addtional" class="married_addtional " >
               <h4>Guardians</h4>
               <p>Select the person you would like to leave your pet to.</p>
               <span id="hiddenGuardinaName" class="errorAct"></span>
               <div class="add_additional_partner" id="add_petguardians" >Add a Guardian</div>
               <span style="display: none;" class="wf_error_mesg wf_error_pet_name_hidden">Required field</span>
            </div>

            <div class="form-row child_name_sectio pet_name_sectio">
               <h4>Gift for the maintenance of your pet</h4>
               <p>If you would like to leave a legacy to the person nominated to care for your pet, on the condition that that person does indeed care for your pet, enter the dollar amount below.</p>
               <input id="wf_giftsPrice" class="form-control" type="text" placeholder="0" name="wf_giftsPrice" value="">
               <span style="display: none;" class="wf_error_mesg">Maximum of 7 digits exceeded</span>
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="pet_name_submit">Save</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </div>

         <!-------------- Edit pet ----------------->
         <div class="edit_pet_section content_box_sections" id="edit_pet_section" style="display:none;">
            <div id="backto_pets_form" class="backto_pets_form"> Back</div>
            <h4> Edit pet</h4>
            <div class="form-row child_name_sectio pet_name_sectio">
               <label for="wf_edit_pet_name">Pet's name</label>
               <input id="wf_edit_pet_name" class="form-control" type="text" name="wf_edit_pet_name" value="">
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <div class="form-row child_name_sectio pet_name_sectio">
               <label for="wf_edit_pet_type">Pet type</label>
               <input id="wf_edit_pet_type" class="form-control" placeholder="eg. Dog, Cat, Iguana, etc" type="text" name="wf_edit_pet_type" value="">
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <div id="gurdian_addtional" class="married_addtional " >
               <h4>Guardians</h4>
               <p>Select the person you would like to leave your pet to.</p>
               <div id="hiddenGuardinaName"> 
                  
               </div>         
            </div>

            <div class="form-row child_name_sectio pet_name_sectio">
               <h4>Gift for the maintenance of your pet</h4>
               <p>If you would like to leave a legacy to the person nominated to care for your pet, on the condition that that person does indeed care for your pet, enter the dollar amount below.</p>
               <span style="display: none;" class="wf_error_mesg">Maximum of 7 digits exceeded</span>
               <input id="wf_editgiftsPrice" class="form-control" type="text" name="wf_giftsPrice" value="">
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <input type="hidden" id="row_index" name="">
               <input type="hidden" id="userid" name="" value="<?php echo $user_id; ?>"> 
               <button type="button" class="section_next_btn update_pet_data_submit" id="update_pet_name_submit">Save</button>
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
      <nav class="sidenavbar" id="sidenav_add_petguradian" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_add_gurardian"><i class="fa fa-close"></i></span>
            <h3>Add a Guardian</h3>
         </div>
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="petgurdian-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_petguardians_input" name="add_partner_name[]" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input class="add_petpartner_userid" value="<?php echo $user_id; ?>" id="add_petpartner_userid" name="" type="hidden">
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="" id="pet_guardian_save_btn" style="" >Save</button><span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>     
      </nav>
   <!-- </div> -->
   <div id="edit_petguradina_name_modal"></div>


   <!-- Edit section-->
   <nav class="sidenavbar" id="edit_sidenav_petguradian" style="display: none;">
      <div class="sidenav_close-btn">
         <span class="close_add_gurardian"><i class="fa fa-close"></i></span>
         <h3>Add a Guardian</h3>
      </div>
      <?php 
      $partners_data = get_user_meta($user_id, 'willed_partners', true);
      if(!empty($partners_data)){
         echo '<div class="partner_itemslist">';
         foreach($partners_data as $key => $partners_d){
            echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="petgurdian-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
         }
         echo '</div>';
      }
      ?>
      <div class="partners_popup_area">   
         <div class="multiple_partners_area"></div>
         <h3>Add person</h3>
         <p>Full legal name</p>
         <input id="add_petguardians_inputonEdit" name="add_partner_name[]" placeholder="" type="text">
         <span style="display: none;" class="wf_error_mesg">Required field</span>
         <input class="add_petpartner_userid" value="<?php echo $user_id; ?>" id="add_petpartner_userid" name="" type="hidden">
         <div class="secion_sv_div" style="position: relative;">
            <button type="button" class="" id="pet_guardian_add_onEdit" style="" >Save</button><span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
         </div>
         <hr class="divider">
      </div>     
   </nav>
   <!-- </div> -->
   <div id="petguradina_name_for_edit"></div>