<?php 
   $funeral_wishes_status='';
   $funeral_wishes_textarea=''; 
if(isset($_GET['will'])){
   $queryurlval = $_GET['will'];
   if(!empty($queryurlval) && $queryurlval!=''){
      //echo $queryurlval;
   } 
   $funeral_submitted_data = get_user_meta($user_id, 'funeral_submitted_data', true);
   if($funeral_submitted_data){
      $funeral_wishes_status = $funeral_submitted_data['funeral_wishes_status'];
      $funeral_wishes_textarea = $funeral_submitted_data['funeral_wishes_textarea'];
   }

   if(!empty($funeral_wishes_textarea)){
      $funeral_wishes_textarea = $funeral_wishes_textarea;
   }
}
?>

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
         <h3>Tell us about your funeral wishes</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">
      <div class="col-md-7 col-12 ">
         <form id="partner_form" class="partner_form content_box_sections" action="" method="post" novalidate="novalidate">
            <a href="<?php echo $gotoEditulr.'?will=gifts'; ?>"><span class="p-chip">Gifts</span></a>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Funeral wishes</h4>
            <p class="mt-3">Let your executors know how you would like your body to be treated after you have passed.</p>
            <p><strong>Note:</strong> Funeral wishes are non-binding. Whilst your executor(s) may consider your wishes, they will ultimately have the right to decide how your body shall be treated after you have passed.</p>
            <h3><strong>How would you like your body to be treated after you have passed?</strong></h3>
            <?php 
            if(isset($_GET['will'])){
               $queryurlval = $_GET['will'];
               if(!empty($queryurlval) && $queryurlval =='funeralWishes'){
                  $relstatusarr = get_user_meta( $user_id, 'funeral_submitted_data', true );

                  $relstatus = $relstatusarr['funeral_wishes_status'];
                  $funeral_name = $relstatusarr['funeral_wishes_textarea'];
                  $checked = 'checked="checked" ';
               }
            }
            ?>
            <div class="funeral_wishes_options">
               <label class="label <?php if($relstatus=='burial'){echo'relation_active';} ?>">
                  <div class="funeral_wishes">
                     <!-- <i class="fa fa-user" aria-hidden="true"></i> -->
                     <input class="funeral_wishes_status" type="radio" name="funeral_wishes_status" value="burial" <?php if($relstatus=='burial'){echo $checked;} ?>>  
                     <span>Burial</span>
                  </div>
               </label>

               <label class="label <?php if($relstatus=='cremated'){echo'relation_active';} ?>">
                  <div class="funeral_wishes">
                    <!--  <i class="fa fa-users" aria-hidden="true"></i> -->
                     <input class="funeral_wishes_status" type="radio" name="funeral_wishes_status" id="cremated"  value="cremated"  <?php if($relstatus=='cremated'){echo $checked;} ?>>  
                     <span>Cremated</span>
                  </div>
               </label>
                <label class="label <?php if($relstatus=='donatetosci'){echo 'relation_active';} ?>">
                  <div class="funeral_wishes">
                    <!--  <i class="fa fa-users" aria-hidden="true"></i> -->
                     <input class="funeral_wishes_status" type="radio" name="funeral_wishes_status" id="donatetosci" value="Donate to science" <?php if($relstatus=='donatetosci'){echo $checked;} ?>>   
                     <span>Donate to science</span>
                  </div>
               </label>
               <span style="display: none;" class="wf_error_mesg">Required field</span>
            </div>

            <h3>
               <strong>Further instructions</strong>
            </h3>
            <p>Let your Executor know about your burial or funeral arrangement. For example, "scatter my ashes in the ocean" or "I want to be buried next to my parents and I want a Catholic funeral service".</p>
            <textarea id="funeral_wishes_textarea" name="funeral_wishes_textarea" class="funeral_wishes_textarea" value="<?php echo $funeral_wishes_textarea; ?>" rows="4" cols="50"><?php echo $funeral_wishes_textarea; ?></textarea>
            <!--  -->
            <?php  
               //$willdePartners = get_user_meta($user_id, 'willed_partners',true);
               ?>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="funeral_wishes_submit">Next</button>
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