<?php 
if(isset($_GET['will'])){
	$queryurlval = $_GET['will'];
	if(!empty($queryurlval) && $queryurlval!=''){
	}
}
$primaryExedata = get_user_meta($user_id, 'primary_executor_submitted_data',true);
$backupExedata = get_user_meta($user_id, 'backup_executor_submitted_data',true);
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
         <h3>Who will administer your estate?</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">
      <div class="col-md-7 col-12 ">
        <form id="executor_step1_form" class="executor1_form content_box_sections" action="" method="post" novalidate="novalidate">
            <a href="<?php echo $gotoEditulr.'?will=pets'; ?>"><span class="p-chip">Pets </span></a>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Executors</h4>
            <p class="mt-3">
               An executor is a person or professional service provider appointed under the Will to administer your estate after your death.<br><br>

               <strong>What are the duties of an Executor?</strong><br>
               An executor is responsible for collecting and protecting estate assets, paying estate liabilities and distributing the assets of the estate to the beneficiaries in accordance with the Will.<br><br>
               The Willed platform allows you to pick up to 3 primary executors. You also have the option to choose up to 3 backup options if you wish.<br>
            </p>
            <p>
               <strong>Note:</strong> Whilst you may appoint an executor who resides outside of Australia, logistical challenges may flow from such appointment. Therefore, it is generally recommended to appoint an executor residing within Australia.
            </p>
            <p>Click <strong>Continue</strong> to select your executors.</p>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="executor_continue_btn">Continue</button>
            </div>
         </form>

          <!----------Primary executors Add form -------->
         <form id="executor_step2_form" class="executor2_form content_box_sections add_form_primary" action="" method="post" novalidate="novalidate" style="display:none;">
            <span href="" class="back_to_main_executor"><span class="p-chip">Back </span></span>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Primary executors</h4>      
            <div class="age_under_yes primary_executor_main_name_addtional">        
               <ul>
                  <li>Select 1 to 3 people as primary executor</li>
                  <li>Choose people who are 18 years or older</li>
               </ul>
               <div id="gurdian_addtional" class="primary_exector_addtional married_addtional err_active">
                  <span id="hiddenPrimarExeName" class=""></span>
                  <div class="gardian_added">
                     <?php 
                     $primaryDAta = get_user_meta( $user_id,'identify_executor_submitted_data',true);
                     if($primaryDAta){
                        foreach ($primaryDAta['primary_executor_data'] as $key => $prmvalue) {?>
                           <div id="gudraianNameCont" class="primary_exec_names_div guardian_names_dv gudraianNameCont"><input data-index="<?php echo $key;?>" name="primary_executors[]" type="text" class="parent_exec_nm_val child_gurdian_names" id="petgudrianname" disabled value="<?php echo $prmvalue['executor_name']; ?>" data-address="<?php echo $prmvalue['executor_address']; ?>"><span class="edit_primary_exe_name" id="edit_primary_exe_name"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="del_primary_exe_name" class="delete_pet del_primary_exe_name"><i class="fa fa-times" aria-hidden="true"></i></span></div>
                        <?php 
                        }
                     }
                     ?> 
                  </div>                     
                  <div style="" class="add_additional_partner " id="add_primary_executor" >Add a Executor</div>
                  <span style="display: none;" class="wf_error_mesg">Required field</span>
               </div>
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="primary_exec_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>

         <!---------- Backup executors add form-------------->
         <form id="executor_step3_form" class="executor3_form content_box_sections add_form_backup" action="" method="post" novalidate="novalidate" style="display:none;">
            <span href="" class="back_to_primary_executors"><span class="p-chip">Back </span></span>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Backup executors</h4>  
            <p>In case your primary executor predeceases you or is otherwise unable to act, a backup executor is a person appointed under the Will to administer your estate after your death. We recommend appointing backup executors.</p>   
            <div class="age_under_yes primary_executor_main_name_addtional_bkp">        
               <ul>
                  <li>Backup executors are optional</li>
                  <li>Maximum of 3 selections</li>
                  <li>Choose people who are 18 years or older</li>
                  <li>Select in order of priority</li>
               </ul>
               <div id="gurdian_addtional" class="primary_exector_addtional_bkp married_addtional err_active" >
                  <div class="gardian_added_on_backupExe">
                     <?php 
                     $backupDAta = get_user_meta( $user_id,'identify_executor_submitted_data',true);
                     if($backupDAta ){
                        foreach ($backupDAta['backup_executor_data'] as $key => $bkpvalue) {?>
                           <div id="gudraianNameCont" class="primary_exec_names_div_bkp guardian_names_dv gudraianNameCont"><input data-index="<?php echo $key;?>"  name="primary_executors_bkp[]" type="text" class="backup_exec_nm_val child_gurdian_names" id="petgudrianname" disabled value="<?php echo $bkpvalue['executor_name']; ?>" data-address="<?php if(!empty($bkpvalue['executor_address'])) { echo $bkpvalue['executor_address'];} else {echo '';} ?>"><span class="edit_pet edit_primary_exe_name_bkp" id="edit_primary_exe_name_bkp"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="del_primary_exe_name_bkp" class="delete_pet del_primary_exe_name_bkp"><i class="fa fa-times" aria-hidden="true"></i></span></div>
                        <?php 
                        }
                     }
                     ?>
                  </div>
                  <div style="" class="add_additional_partner " id="add_primary_executor_bkp" >Add a Executor</div>
                  <span style="display: none;" class="wf_error_mesg">Required field</span>
               </div>
            </div>

            <input type="hidden" id="hold_allPrimaryExecutors" name="">
            
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="backup_exec_submit">Save</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>  

         <!---------- Identify executors add form-------------->
         <form id="executor_step4_form" class="executor4_form content_box_sections add_form_identifiers" action="" method="post" novalidate="novalidate" style="display:none;">
            <span class="back_to_backup_executors"><span class="p-chip">Back </span></span>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Identify Executors</h4>
            <p>It is important that the people you nominated as your Executors are correctly identified. By providing their current addresses you will be able to avoid any confusion later on.</p>
            <p>If you are not sure of an address you can leave it blank for now and enter it later.</p>
            <strong>Addresses</strong>
            <div class="gardian_added_indetiyf">
            </div>
            <input type="hidden" id="hold_allBackupExecutors" name="">

            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="indentify_exec_submit">Next</button>
               <span id="loader_imagedv_idendtify_execr_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form> 
      </div>

      <div class="col-md-4 offset-md-1 col-12">
         <div class="dashbaord_sidebar_section">
         <?php include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-sidebar-menu.php');  ?>
         <!--col-md-4 offset-md-1 col-12   end  -->
      </div>
   </div>

   <!-- Primary executors -->
      <nav class="sidenavbar" id="sidenav_add_primary_executor" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_primary_executor"><i class="fa fa-close"></i></span>
            <h3>Select partner</h3>
         </div>
         <hr class="divider">   
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist primaryExecutr_itemList">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="primar_exe_items_list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <!-- <form novalidate="novalidate" class=""> -->
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_prm_execText_input" name="add_partner_name" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input value="<?php echo $user_id; ?>" id="add_prm_exe_userid" name="" type="hidden">
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="" id="primary_exe_new_save_btn" style="" >Save</button><span id="loader_imagedv_partner_popup" class="loader_imagedv_primary_exe_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>

         <!-- </form>       -->
      </nav>
      <div id="primary_executor_name_modal"></div>


      <!-- Backup executors -->
      <nav class="sidenavbar" id="sidenav_add_primary_executor_bkp" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_primary_executor"><i class="fa fa-close"></i></span>
            <h3>Select partner</h3>
         </div>
         <hr class="divider">   
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist primaryExecutr_itemList">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="primar_exe_items_list_bkp" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <!-- <form novalidate="novalidate" class=""> -->
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_prm_execText_input_bkp" name="add_partner_name" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input value="<?php echo $user_id; ?>" id="add_prm_exe_userid_bkp" name="" type="hidden">
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="" id="primary_exe_new_save_btn_bkp" style="" >Save</button><span id="loader_imagedv_partner_popup" class="loader_imagedv_bakcupExe_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>

         <!-- </form>       -->
      </nav>
      <div id="primary_executor_name_modal_bkp"></div>

      <div id="identify_executor_name_modal"></div>