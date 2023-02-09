<?php 
//Add charity data
add_action('wp_ajax_charityname_data_save','charityname_data_save');
add_action('wp_ajax_nopriv_charityname_data_save','charityname_data_save');
if ( ! function_exists( 'charityname_data_save' ) ) {
    function charityname_data_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $pcharity_names = $_POST['charity_names'];
            //print_r($pcharity_names);
            if(!empty($pcharity_names)){
                $prim_exec_na = $pcharity_names;
            } else {
                $prim_exec_na = array();
            }

            $prim_exec_ndata =  array(
                'charity_name'=>$prim_exec_na,
                'charity_status'=> 1
            );
            //print_r($prim_exec_ndata);
            update_user_meta( $wf_userid, 'devide_estate_charity_name_submitted_data', $prim_exec_ndata );
            echo json_encode(array('msg'=>'charityname_data_saved'));
        }
        die(); 
    }
}

//Add New charity (partner)
add_action('wp_ajax_add_new_charitry_name','add_new_charitry_name');
add_action('wp_ajax_nopriv_add_new_charitry_name','add_new_charitry_name');
if ( ! function_exists( 'add_new_charitry_name' ) ) {
    function add_new_charitry_name(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $getCharityName = $_POST['charity_name'];
            //willed partne name save
            if(!empty($getCharityName)){
                $charityNName = $getCharityName;
            } 
            $willdePartners = get_user_meta($userid, 'willed_partners',true);
            if(!empty($willdePartners)){
                array_push($willdePartners,$charityNName);
                update_user_meta( $userid, 'willed_partners', $willdePartners );
                end($willdePartners);
                $key = key($willdePartners); 
                $lastindex =  $key;
                echo json_encode(array('msg'=>'charityNme_update','retrunCharity_name'=> $getCharityName));
            } else {
                update_user_meta( $userid, 'willed_partners', array($charityNName) );
                echo json_encode(array('msg'=>'charityNme_added','retrunCharity_name'=> $getCharityName ));
            }
            die();
        }
    }
}



//save updated chairty name popup
add_action('wp_ajax_upda_charity_nme_name','upda_charity_nme_name');
add_action('wp_ajax_nopriv_upda_charity_nme_name','upda_charity_nme_name');
if ( ! function_exists( 'upda_charity_nme_name' ) ) {
    function upda_charity_nme_name(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $editInputvalof_charity_exec = $_POST['charityExe_val'];
            $chairytExe_old_name = $_POST['charityExe_old_name'];
            
            //updated in willed partner
            $get_allchairyt_executorsData =  get_user_meta( $userid, 'willed_partners', true );
            $Key_of_valuetbeUpdat =  array_search($chairytExe_old_name, $get_allchairyt_executorsData);
           
            foreach($get_allchairyt_executorsData as $key => $value){
                if($key == $Key_of_valuetbeUpdat){
                    $get_allchairyt_executorsData[$Key_of_valuetbeUpdat] = $editInputvalof_charity_exec;
                }else{
                    
                }
            }
            $all_charity_execDatatobeSaved = $get_allchairyt_executorsData;
           
            //updated in child_subt_date for name
            $get_charity_exesubtData =  get_user_meta( $userid, 'devide_estate_charity_name_submitted_data', true );
            $get_allchiarty_execname = $get_charity_exesubtData['charity_name'];
            $Key_of_name_valueeUpdat =  array_search($chairytExe_old_name, $get_allchiarty_execname);      
            foreach($get_allchiarty_execname as $key => $value){
                $get_allchiarty_execname[$Key_of_name_valueeUpdat] = $editInputvalof_charity_exec;
            }

            $all_get_all_chaurt_execTobeSaved = $get_allchiarty_execname;
            //print_r($all_get_all_chaurt_execTobeSaved);
            $get_chairtyData = $get_charity_exesubtData;
            $get_chairtyData_status = $get_chairtyData['charity_status'];
            $upd_after_edit_primar_exec =  array(
                'charity_name'=>$all_get_all_chaurt_execTobeSaved,
                'charity_status'=> $get_chairtyData_status
            );

            update_user_meta( $userid, 'willed_partners', $all_charity_execDatatobeSaved );
            update_user_meta( $userid, 'devide_estate_charity_name_submitted_data',$upd_after_edit_primar_exec );
            echo json_encode(array('msg'=>'charity_popupDataSave', 'charity_exec_name'=>$editInputvalof_charity_exec));
        die();
        }
    }
}



//Add devide estate data
add_action('wp_ajax_devide_estate_data_save','devide_estate_data_save');
add_action('wp_ajax_nopriv_devide_estate_data_save','devide_estate_data_save');
if ( ! function_exists( 'devide_estate_data_save' ) ) {
    function devide_estate_data_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['userid'];
            $input_number_val = $_POST['single_input_num_val'];
            $input_val_name = $_POST['single_input_name_val'];
            $getinput_totld_div = $_POST['totldevide_div'];
            $input_totld_div = $getinput_totld_div-1; 
            foreach ($input_number_val  as $key => $valuedd) {
                $valueddArr[] = $valuedd;
            }
            foreach ($input_val_name  as $key => $valueff) {
                $valueffArr[] = $valueff;
            }
            $alldata=[]; 
            $i='';
            for($i=0;$i<=$input_totld_div;$i++){
               $alldata[] = array(
                    'divide_estate_name'=>$valueffArr[$i],
                    'divide_estate_number'=>$valueddArr[$i]
                );      
            }
            $divide_estate_data =  array(
                'divide_estate_data'=>$alldata,
                'divide_estate_status'=> 1,
            );
            update_user_meta( $wf_userid, 'devide_estate_calculator_submitted_data', $divide_estate_data );
            echo json_encode(array('msg'=>'devideestate_data_saved'));
        }
        die(); 
    }
}



?>