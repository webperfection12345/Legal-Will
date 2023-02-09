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
         <h3>Who should inherit your estate?</h3>
      </div>
      <div class="col-md-4 offset-md-1 col-12">
         <h3></h3>
      </div>               
   </div>

   <div class="row">
      <div class="col-md-7 col-12 ">
         <!-- Select beneficiaries -->
         <form id="divide_estate_select_beneficiaries" class="divide_estate_select_beneficiaries content_box_sections"  method="post" novalidate="novalidate">
            <a href="<?php echo $gotoEditulr.'?will=executors'; ?>"><span class="p-chip">Executors </span></a>
            <input type="hidden" id="userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Select beneficiaries</h4>
            <p class="mt-3">
               A beneficiary is an individual or entity that you list in your Will as being entitled to receive assets from your estate when you die. Willed allows you to select individuals or charities as your beneficiaries.
            </p>
            <p>
               If you wish to leave specific assets or amounts of money to people, you will be able to do that in the next section, title 'Gifts', after you have completed this section.  
            </p>

             <div class="black--text" bis_skin_checked="1">
                  <div class="w-label mb-2">Instructions</div>
                  <ul>
                     <li>Select 1 or more beneficiaries</li>
                     <li>Beneficiaries can be people and charities</li>
                     <li>Only select your main beneficiaries, you will have the option to select backup beneficiaries later</li>
                     <li>Click Next to specify how to divide your estate between them</li>
               </div>
           
               <?php  
               $willdePartners = get_user_meta($user_id, 'willed_partners',true);
               ?>
               <div class="married_addtional charity_additional_div <?php if(empty($charitynameData )){echo 'err_active';} ?>">
                  <div class="partner_added devide_partner_added_area">
                     <?php 
                     if(!empty($charitynameData)){
                        //print_r($charitynameData);
                        foreach($charitynameData['charity_name'] as $index=>$value){
                           $charittyVal_name = $value;
                        ?>
                           <div class="primary_exec_names_div guardian_names_dv gudraianNameCont charity_name_dv">
                              <input type="text" data-attr="<?php echo  $index; ?>" data-value="<?php echo $charittyVal_name; ?>" data-id="<?php echo $user_id?>" name="charitynameImg[]" id="" class="child_gurdian_names partner_name charity_name" value="<?php echo $charittyVal_name; ?>" disabled><span class="edit_guardian edit_charity_name_popup"><i class="fa fa-pencil" aria-hidden="true"></i></span><span id="" class="delete_pet del_charitydiv"><i class="fa fa-times" aria-hidden="true"></i></span>
                           </div>
                     <?php } 
                     }?>
                  </div>
                  <div class="add_additional_partner add_charitynamewithSideNav" >Add person</div>
                  <span style="display: none;" class="wf_error_mesg wf_error_charity_name_hidden">Required field</span>
                  <div class="add_additional_chairty">
                     <div class="all_charity_list">
                        <h3>Add Charity</h3>
                           <div class="row">
                              <div class="col-md-6 chrityeachdiv" style="">
                                 <div class="chrityeachdiv_inner">
                                    <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                                    <div class="imag_container">
                                       <p class="charitryname">Plan International Australia</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 chrityeachdiv" style="">
                                 <div class="chrityeachdiv_inner">
                                 <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid ">
                                 <div class="imag_container">
                                 <p class="charitryname">World Wide Fund For Nature Australia</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                 </div>
                                  </div>
                              </div>
                              <div class="col-md-6 chrityeachdiv" style="">
                                 <div class="chrityeachdiv_inner">
                                 <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                                 <div class="imag_container">
                                 <p class="charitryname">National Breast Cancer Foundation</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                 </div>
                                  </div>
                              </div>
                              <div class="col-md-6 chrityeachdiv" style="">
                                 <div class="chrityeachdiv_inner">
                                 <img src="<?php echo CD_PLUGIN_URL . 'assets/images/charity_australia.png'; ?>" class="charity_image img-fluid">
                                 <div class="imag_container">
                                 <p class="charitryname">St John WA</p><span class="charity_info"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
                                 </div>
                                  </div>
                              </div>
                              <div class="col-md-6 chrityeachdiv" style="">
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

                   <span style="display: none;" class="wf_error_mesg wf_error_partnername_hidden">Required field</span>
                     <!-- <div class="add_person" id="divide_estate">Add Pet</div> -->
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="divide_estate_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>

         <!-- Divide estate -->
         <form id="divide_estate_Divide_estate" class="divide_estate_Divide_estate content_box_sections"  method="post" novalidate="novalidate" style="display:none;">
            <span href="" class="back_to_select_beneficiaries"><span class="p-chip">Back </span></span>
            <input type="hidden" id="calc_userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Divide estate</h4>
            <p class="mt-3">You can distribute all of your estate (after specific gifts have been allocated and your debts paid) to one or more beneficiaries. If you leave your estate to more than one beneficiary you can divide your estate into equal or unequal shares or portions. This is called your residuary or residual estate. Please nominate a percentage of your residuary estate to be received by each beneficiary. Your residuary estate must add up to 100%.</p>
            <strong>What property compromises your Estate?</strong>
            <p>The property and assets belonging to a deceased estate may include real estate, cash in the bank, shares, motor vehicles, digital assets and personal possessions, such as furniture, paintings and jewellery. Assets held as joint tenants, owned by a family trust and your superannuation do not form part of your Estate. For more information visit our FAQs.</p>
            <div class="black--text" bis_skin_checked="1">
               <div class="w-label mb-2">Instructions</div>
               <ul>
                  <li>Enter the percentage each of your beneficiaries will receive</li>
                  <li>Beneficiaries can be people and charities</li>
                  <li>The total amount must equal exactly 100%</li>
                  <li>To change your beneficiaries click on the Back link above</li>
               </ul>
            </div>
           
               <div class="calcualtions_div_main">

                  <?php 
                  $charitynameDataz = get_user_meta($user_id, 'devide_estate_calculator_submitted_data',true);
                  // echo '<pre>';
                  //  print_r($charitynameDataz);
                  // echo '</pre>';
                  if(!empty($charitynameDataz)){
                     $edtotoal = 0;
                     foreach($charitynameDataz['divide_estate_data'] as $index=>$edtvalues){
                        $charittyVal_namecL = $values;
                        $Ed_divide_estate_name = $edtvalues['divide_estate_name'];
                        $Ed_divide_estate_number = $edtvalues['divide_estate_number'];
                        $edtotoal+= $Ed_divide_estate_number;
                        
                        ?>
                        <div class="calcualtions_div charity_name_dv">
                           <span class="inputclass_calculator"><p class="inpunameCalc"><?php echo $Ed_divide_estate_name; ?></p> <input class="add_inputs inputnameClass_calculator" value="<?php echo $Ed_divide_estate_number; ?>" type="text" name="inputname_calculator[]" ><span class="cal_percentage">%</span></span>
                           <input type="hidden" class="devide_estate_values" value="<?php echo $Ed_divide_estate_name; ?>" name="devide_estate_values[]"><span style="display: none;" class="wf_error_mesg wf_error_input_calculator_error">Required field</span>
                           <span style="display: none;" class="wf_error_mesg wf_error_total_error">Must be greater than zero</span>
                        </div>
                     <?php 
                     } 
                     ?>
                     <div class="total_main_div"><p>Total</p>
                  <div class="totalResult"><?php echo $edtotoal;?></div><span>%</span></div>
                  <?php 
                  }  else {
                  $devide_estateData = get_user_meta($user_id, 'devide_estate_charity_name_submitted_data',true); 
                  //print_r($devide_estateData);

                 // if(!empty($devide_estateData)){
                     foreach($devide_estateData['charity_name'] as $index=>$values_devide_estateData){
                         //$divide_estate_name = $values_devide_estateData['divide_estate_name'];
                         //$divide_estate_number = $values_devide_estateData['divide_estate_number'];
                        ?>
                        <div class="calcualtions_div charity_name_dv ">
                           <span class="inputclass_calculator"><p class="inpunameCalc"><?php echo $values_devide_estateData; ?></p><input class="add_inputs inputnameClass_calculator" type="text" name="inputname_calculator[]" value="" ><span class="cal_percentage">%</span></span>
                           <input type="hidden" class="devide_estate_values" value="<?php echo $values_devide_estateData; ?>" name="devide_estate_values[]"><span style="display: none;" class="wf_error_mesg wf_error_input_calculator_error">Required field</span>
                           <span style="display: none;" class="wf_error_mesg wf_error_total_error">Must be greater than zero</span>
                        </div>
                     <?php 
                     } ?>
                     <div class="total_main_div">
                     <p>Total</p>
                     <div class="totalResult"></div><span>%</span></div> 
                  <?php 
                  } 
                  //else {
                    ?>
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="divide_estate_next_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>

         <!-- Select backups -->
         <form id="divide_estate_Select_backups" class="divide_estate_Select_backups content_box_sections"  method="post" novalidate="novalidate" style="display:none;">
            <span href="" class="back_to_select_beneficiaries"><span class="p-chip">Back </span></span>
            <input type="hidden" id="calc_userid" name="userid" value="<?php echo $user_id; ?>">
            <h4 class="mt_20">Select backups</h4>
            <p class="mt-3">If a beneficiary predeceases you or is otherwise unable to receive an allocation from your estate, we recommend you appoint one or more backup beneficiaries.</p>
            <p>Choose how you wish the inheritance of weafe to be distributed if they are unable to receive an allocation from your estate. Note: any backup beneficiaries will receive the deceased beneficiaries share of your estate in equal proportions.</p>
            <div class="black--text" bis_skin_checked="1">
               <div class="w-label mb-2">Instructions</div>
               <ul>
                  <li>Select one of the options below</li>
               </ul>
            </div>
            <div class="select_option_divs">
               <div class="select_option_inner">
                  <label for="go_directly_to_their_children"> 
                  <input type="radio" id="go_directly_to_their_children" class="select_bkp_option" name="select_backup" value="go_directly_to_their_children"> Go directly to their children
                  </label>
               </div>
               <div class="select_option_inner">
                  <label for="divide_among_my_surviving"> 
                     <input type="radio" name="select_backup" class="select_bkp_option"  value="divide_among_my_surviving">Divide among my surviving beneficiaries              
                  </label>
               </div>
               <span style="display: none;" class="wf_error_mesg input_radiobkp_error">Required field</span>
            </div>
            <div class="secion_sv_div" style="position: relative;">
               <button type="button" class="section_next_btn" id="divide_estate_select_backups_submit">Next</button>
               <span id="loader_imagedv_partner_popup" style="display: none;"><img class="image_loader" src="<?php echo CD_PLUGIN_URL . 'assets/images/loader_img.jpg'; ?>"></span>
            </div>
         </form>
      </div>
      <!-- col-md-7 end -->
      <div class="col-md-4 offset-md-1 col-12">
         <div class="dashbaord_sidebar_section">
         <?php include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-sidebar-menu.php');  ?>
         <!--col-md-4 offset-md-1 col-12   end  -->
      </div>
   </div>

   <!-- <div id="addpartnerModal" class="modal fade right sidenav_add_partner"> -->
      <nav class="sidenavbar" id="sidenav_add_charity" style="display: none;">
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
               echo '<p data-attr="'.$user_id.'"  data-value="'.$partners_d.'" class="charity-items-list" data-id="'.$key.'">'.$partners_d.'</p>';  
            }
            echo '</div>';
         }
         ?>
         <!-- <form novalidate="novalidate" class=""> -->
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

         <!-- </form>       -->
      </nav>
   <div id="edit_charity_name_modal"></div>



