<?php 
if(isset($_GET['will'])){
	$queryurlval = $_GET['will'];
	if(!empty($queryurlval) && $queryurlval!=''){
		echo $queryurlval;
	}
}
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
         <h3>What is your relationship status?</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">
      <div class="col-md-7 col-12 ">
         <form id="partner_form" class="partner_form content_box_sections" action="" method="post" novalidate="novalidate">
            <a href="<?php echo $gotoEditulr.'?will=about'; ?>"><span class="p-chip">About you </span></a>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">What is your current relationship status?</h4>
            <p class="mt-3">
               <strong>Single:</strong> If you are single, separated, divorced or widowed.<br>
               <strong>Married:</strong> If you are married or engaged.<br>
               <strong>De facto:</strong> If you are living as a couple on a genuine domestic basis at the time of your death (irrespective of gender).
            </p>
            <p>
               <strong>Important:</strong> If your relationship status changes in the future, you should consider updating your Will. For example, marriage can automatically invalidate your Will.   
            </p>
            <?php 
            if(isset($_GET['will'])){
               $queryurlval = $_GET['will'];
               if(!empty($queryurlval) && $queryurlval =='partner'){
                  $relstatusarr = get_user_meta( $user_id, 'partner_submitted_data', true );
                  $relstatus = $relstatusarr['relatives_status'];
                  $partner_name = $relstatusarr['partner_name'];
                  $checked = 'checked="checked" ';
               }
            }
            ?>
            <div class="martital_status_options">
               <label class="label <?php if($relstatus=='single'){echo'relation_active';} ?>">
                  <div class="maritalstatus_icon">
                     <i class="fa fa-user" aria-hidden="true"></i>
                     <input class="relationship_status" type="radio" name="relationship_status" value="single" <?php if($relstatus=='single'){echo $checked;} ?>>  
                     <span>Single</span>
                  </div>
               </label>

               <label class="label <?php if($relstatus=='married'){echo'relation_active';} ?>">
                  <div class="maritalstatus_icon">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <input class="relationship_status" type="radio" name="relationship_status" id="married"  value="married"  <?php if($relstatus=='married'){echo $checked;} ?>>  
                     <span>Married</span>
                  </div>
               </label>
                <label class="label <?php if($relstatus=='defacto'){echo 'relation_active';} ?>">
                  <div class="maritalstatus_icon">
                     <i class="fa fa-users" aria-hidden="true"></i>
                     <input class="relationship_status" type="radio" name="relationship_status" id="defacto" value="defacto" <?php if($relstatus=='defacto'){echo $checked;} ?>>   
                     <span>Defacto</span>
                  </div>
               </label>
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>
            <!--  -->
            <?php  
               $willdePartners = get_user_meta($user_id, 'willed_partners',true);
               ?>
            <div class="married_addtional <?php if(empty($willdePartners)){echo 'err_active';} ?>" style="display: none;" >
               
               <h4>Your partner</h4>
               <?php if(empty($willdePartners)){ ?>
                  <div class="add_additional_partner" >Add partner</div>
                   <span style="display: none;" class="wf_error_mesg wf_error_partnername_hidden">Required field</span>
               <?php
               } 
                     
                  if(!empty($willdePartners)){
                      end($willdePartners);
                      $key = key($willdePartners); 
                      $lastindex =  $key;
                      $lastpartnr_name =  end($willdePartners);
                      ?>
                     <div class="partner_added">
                        <input type="text" data-attr="<?php echo  $lastindex; ?>" data-value="<?php echo $lastpartnr_name; ?>" data-id="<?php echo $user_id?>" name="partner_name" id="partner_name" class="partner_name" value="<?php echo $lastpartnr_name; ?>" disabled><span class="edit_guardian" id="edit_partnerName_modl"><i class="fa fa-pencil" aria-hidden="true"></i></span>
                     </div>
                     <div class="add_additional_partner" >Change partner</div>
                  <?php    
                  } 
                  ?>

               <div class="black--text" bis_skin_checked="1">
                  <p>Get 50% off your partner's will</p>
                  <p> When you are ready to purchase your Will you can also purchase your partner’s Will for half price. </p>
                  <p> After paying for both Wills, you will receive a link so that your partner can open a Willed account and create their Will at their convenience. </p>
               </div>
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="parnter_submit">Next</button>
               <span id="loader_imagedv" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>
      </div>

      <div class="col-md-4 offset-md-1 col-12">
         <div class="dashbaord_sidebar_section">
         <?php include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-sidebar-menu.php');  ?>
         <!--col-md-4 offset-md-1 col-12   end  -->
      </div>
   </div>

   <!-- <div id="addpartnerModal" class="modal fade right sidenav_add_partner"> -->
      <nav class="sidenavbar" id="sidenav_add_partner" style="display: none;">
         <div class="sidenav_close-btn">
            <span class="close_add_partner"><i class="fa fa-close"></i></span>
            <h3>Select partner</h3>
         </div>
         <hr class="divider">   
         <?php 
         $partners_data = get_user_meta($user_id, 'willed_partners', true);
         if(!empty($partners_data)){
            echo '<div class="partner_itemslist">';
            foreach($partners_data as $key => $partners_d){
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="p-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <!-- <form novalidate="novalidate" class=""> -->
         <div class="partners_popup_area">   
            <div class="multiple_partners_area"></div>
            <h3>Add person</h3>
            <p>Full legal name</p>
            <input id="add_partner_input" name="add_partner_name[]" placeholder="" type="text">
            <span style="display: none;" class="wf_error_mesg">Required field</span>
            <input value="<?php echo $user_id; ?>" id="add_partner_userid" name="" type="hidden">
            <div class="secion_sv_div section_sv_sidepanel" style="position: relative;">
               <button type="button" class="section_next_btn side_partnersave" id="partner_save_btn" style="" >Save</button><span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader partner_save_loading" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
            <hr class="divider">
         </div>

         <!-- </form>       -->
      </nav>
   <div id="edit_partner_name_modal"></div>