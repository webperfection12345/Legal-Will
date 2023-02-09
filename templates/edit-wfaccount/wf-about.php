<?php 
 $getfirstname='';
   $getlastname=''; 
   $e_getmiddle_name='';
   $e_getdob_day='';
   $e_getdob_month='';
   $e_getdob_year='';
   $e_getgoogle_address='';
   $e_getphone='';
if(isset($_GET['will'])){
	$queryurlval = $_GET['will'];
	if(!empty($queryurlval) && $queryurlval!=''){
		//echo $queryurlval;
	} 
  

   $firstname = get_user_meta($user_id, 'first_name', true);
   $last_name = get_user_meta($user_id, 'last_name', true);
   if(!empty($firstname)){
      $getfirstname = $firstname;
   }
   if(!empty($last_name)){
      $getlastname = $last_name;
   }

   $about_submitted_data = get_user_meta($user_id, 'about_submitted_data', true);
   if($about_submitted_data){
      $getmiddle_name = $about_submitted_data['middle_name'];
      $getdob_day = $about_submitted_data['dob_day'];
      $getdob_month = $about_submitted_data['dob_month'];
      $getdob_year = $about_submitted_data['dob_year'];
      $getgoogle_address = $about_submitted_data['google_address'];
      $getphone = $about_submitted_data['phone'];
      $getstatus = $about_submitted_data['status'];
   }

   if(!empty($getmiddle_name)){
      $e_getmiddle_name = $getmiddle_name;
   }
   if(!empty($getdob_day)){
      $e_getdob_day = $getdob_day;
   }
   if(!empty($getdob_month)){
      $e_getdob_month = $getdob_month;
   }
   if(!empty($getdob_year)){
      $e_getdob_year = $getdob_year;
   }
   if(!empty($getgoogle_address)){
      $e_getgoogle_address = $getgoogle_address;
   }
    if(!empty($getphone)){
      $e_getphone = $getphone;
   }

}
?>
      <div class="row mob_repons">
            <div class="col-lg-6">
               <div class="image">
                  <a href="https://hlblawyers.com.au"><img src="https://hlblawyers.com.au/wp-content/uploads/2021/08/logo.jpg"></a>
               </div>
            </div>
            <div class="col-lg-6">
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
         <div class="col-lg-7 offset-lg-0 col-12">
            <h3 class="et-page-title">Tell us about yourself</h3>
         </div>
         <div class="col-lg-4 offset-lg-1 col-12">
            <h3></h3>
         </div>               
      </div>
      <div class="row">
         <div class="col-lg-7 col-12">
            <form id="about_form" class="content_box_sections" action="" method="post" novalidate="novalidate">
               <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
               <h4> Your details </h4>
               <div class="about_sections">
                  <h5>Name</h5>
                  <p>Enter your full legal name.</p>
                  <div class="et_from_tell_about">
                     <label for="wf_first_name">First Name</label>
                     <input id="wf_first_name" class="form-control"  type="text" name="wf_first_name" value="<?php echo $getfirstname; ?>">
                     <span style="display: none;" class="wf_error_mesg dashboard_input_error">Required field</span>
                  </div>

                  <div class="et_from_tell_about">
                     <label for="wf_middle_name">Middle Name</label>
                     <input id="wf_middle_name" type="text" name="wf_middle_name" value="<?php echo $e_getmiddle_name; ?>">
                  </div>
                  <div class="et_from_tell_about">
                     <label for="wf_last_name">Last Name</label>
                     <input id="wf_last_name" type="text" name="wf_last_name" value="<?php echo $getlastname; ?>">
                     <span style="display: none;" class="wf_error_mesg dashboard_input_error">Required field</span>
                  </div>
               </div>

               <div class="about_sections">
                  <div class="date_day_year">
                     <h5 style="display: inline-block;width: 100%;margin: 0;"> Date of birth</h5><br>
                     <p>You must be over 18 years old to make a will.</p>
   			         <div class="day_month_year_et">
                        <div class="day_et">
                           <label for="wf_dob_day">Day</label>
                           <input placeholder="DD" maxlength="2" id="wf_dob_day" type="text" name="wf_dob_day" value="<?php echo $e_getdob_day; ?>">
                           <span style="display: none;" class="wf_error_mesg dashboard_input_error">Required field</span>
                        </div>
                        <div class="day_et">
                           <label for="wf_dob_month" class="">Month</label>
                           <input placeholder="MM" maxlength="2" id="wf_dob_month" type="text" name="wf_dob_month" value="<?php echo $e_getdob_month; ?>">
                           <span style="display: none;" class="wf_error_mesg dashboard_input_error">Required field</span>
                        </div>
                        <div class="year_et">
                           <label for="wf_dob_year">Year</label>
                           <input placeholder="YYYY" maxlength="4" id="wf_dob_year" type="text" name="wf_dob_year" value="<?php echo $e_getdob_year; ?>"> 
                           <span style="display: none;" class="wf_error_mesg dashboard_input_error">Required field</span>
                        </div>
                     </div>
   			      </div>
               </div>

               <div class="about_sections">
                  <div class="et_from_tell_about">
                     <h5>Address</h5>
                     <p> Your current residential address. You must live in Australia to make a will with Willed.</p>
                     <input autocomplete="none" id="wf_google_address" placeholder="eg. 123 Main Street, Melbourne Victoria, Australia 3000" type="text" name="wf_google_address" value="<?php echo $e_getgoogle_address; ?>">
                     <span style="display: none;" class="wf_error_mesg dashboard_input_error">Required field</span>
                  </div>
               </div>

               <div class="about_sections">
                  <div class="et_from_tell_about">
                     <h5>Phone number (optional)</h5>
                     <input id="wf_phone" placeholder="eg. 0400123456" type="text" name="wf_phone" value="<?php echo $e_getphone; ?>">
                  </div>
               </div>
               
               <div class="next_et_btn fieldset_btns_group">
                  <div class="secion_sv_div" style="position: relative;">
                     <button type="button" class="section_next_btn wf_btn" id="about_submit" class="" style="">Next</button>
                     <span id="loader_imagedv" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
                  </div>
               </div>
            </form>
        
        
         </div>
         <div class="col-lg-4 offset-lg-1 col-12 cst-mt-5">
            <div class="dashbaord_sidebar_section">
               <?php include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-sidebar-menu.php');  ?>
            
         </div>
         <!--col-lg-4 offset-lg-1 col-12 cst-mt-5   end  -->
      </div>