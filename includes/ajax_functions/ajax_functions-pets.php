<?php
add_action('wp_ajax_pets_dashboard','pets_dashboard');
add_action('wp_ajax_nopriv_pets_dashboard','pets_dashboard');

/*****************pet-dashaboard submit function******************/
if ( ! function_exists( 'pets_dashboard' ) ) {
    function pets_dashboard(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $getDefaultData = get_user_meta( $wf_userid, 'pet_submitted_data', true );

            //print_r($getDefaultData);

            if(!empty($getDefaultData)){
                $petsdata = $getDefaultData;
            } else {
                $petsdata =  array(
                    'pet_name'=>'',
                    'pet_type'=>'',
                    'guardian_name'=>'',
                    'gift_maintenance'=>'',
                    'pet_status'=> 1
                );
            }
            update_user_meta( $wf_userid, 'pet_submitted_data', $petsdata );
            echo json_encode(array('msg'=>'pets_updated'));
        }
        die();
    }
}


//Add pet data
add_action('wp_ajax_pet_data_save','pet_data_save');
add_action('wp_ajax_nopriv_pet_data_save','pet_data_save');
if ( ! function_exists( 'pet_data_save' ) ) {
    function pet_data_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_pet_name = $_POST['wf_pet_name'];
            $wf_pet_type = $_POST['wf_pet_type'];
            $wf_guardian_name = $_POST['wf_guardian_name'];
            $wf_gift_maintenance = $_POST['wf_gift_maintenance'];
            $wf_pet_status = $_POST['wf_pet_status'];
            $petsdatatoSave =  array(
                'pet_name'=>$wf_pet_name,
                'pet_type'=>$wf_pet_type,
                'guardian_name'=>$wf_guardian_name,
                'gift_maintenance'=>$wf_gift_maintenance,
                'pet_status'=> $wf_pet_status
            );
            $pet_data_get = get_user_meta($wf_userid, 'pet_submitted_data',true);
            $nullpetdata = $pet_data_get['pet_name'];
            $nullpetdataIndex = $pet_data_get[0]['pet_name'];
            if(!empty($nullpetdata) || !empty($nullpetdataIndex)  ){
                array_push($pet_data_get,$petsdatatoSave );  
            } else { 
                $pet_data_get  = array($petsdatatoSave);
            }
            update_user_meta( $wf_userid, 'pet_submitted_data', $pet_data_get );
            echo json_encode(array('msg'=>'pet_data_saved'));
        }
        die(); 
    }
}


//Update pet data
add_action('wp_ajax_pet_upatedata_save','pet_upatedata_save');
add_action('wp_ajax_nopriv_pet_upatedata_save','pet_upatedata_save');
if ( ! function_exists( 'pet_upatedata_save' ) ) {
    function pet_upatedata_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_pet_name = $_POST['wf_pet_name'];
            $wf_pet_type = $_POST['wf_pet_type'];
            $wf_guardian_name = $_POST['wf_guardian_name'];
            $wf_gift_maintenance = $_POST['wf_gift_maintenance'];
            $wf_pet_status = $_POST['wf_pet_status'];
            $wf_pet_index = $_POST['wf_row_index'];
            $get_petData =  get_user_meta( $wf_userid, 'pet_submitted_data', true );
            foreach ($get_petData  as $key => $get_petData_value) {
                if($key == $wf_pet_index){
                    $indexdata  = array(
                        'pet_name' => $wf_pet_name,
                        'pet_type' => $wf_pet_type,
                        'guardian_name' => $wf_guardian_name,
                        'gift_maintenance' => $wf_gift_maintenance,
                        'pet_status' =>  $wf_pet_status ,
                    );
                    $get_petData[$wf_pet_index] = $indexdata;
                }
            }
            update_user_meta( $wf_userid, 'pet_submitted_data', $get_petData );
            echo json_encode(array('msg'=>'pet_data_updated'));
        }
        die(); 
    }
}

//delete pet data
add_action('wp_ajax_delete_pet','delete_pet');
add_action('wp_ajax_nopriv_delete_pet','delete_pet');
if ( ! function_exists( 'delete_pet' ) ) {
    function delete_pet(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['wf_userid'];
            $deleteInputIndex = $_POST['wf_pet_index'];
            $get_petData =  get_user_meta( $userid, 'pet_submitted_data', true );
            foreach ($get_petData  as $key => $get_petData_value) {
                if($key == $deleteInputIndex){
                    unset($get_petData[$deleteInputIndex]);
                }
            }
            $get_petDataarange = array_values($get_petData);
            $all_petDatatobeSaveds = $get_petDataarange;
            $get_childrData_name = $get_childrData['child_name'];
            $get_childrData_age = $get_childrData['mature_age'];
            $get_childrData_status = $get_childrData['children_status'];
            $upd_after_del_gudrdian =  array(
                'child_name'=> $get_childrData_name,
                'mature_age'=>$get_childrData_age,
                'guardian_name'=>$reset_guradianNames,
                'children_status'=> $get_childrData_status
            );
            update_user_meta( $userid, 'pet_submitted_data', $all_petDatatobeSaveds );
            echo json_encode(array('msg'=>'pet_deleted'));
        die();
        }
    }
}


//Add Pet Guardian 
add_action('wp_ajax_add_petguardians','add_petguardians');
add_action('wp_ajax_nopriv_add_petguardians','add_petguardians');
if ( ! function_exists( 'add_petguardians' ) ) {
    function add_petguardians(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $getpartnername = $_POST['petguardian_name'];
            
            $defulatGurdians = get_user_meta( $userid, 'pet_submitted_data',true);
            if(!empty($defulatGurdians)){
                $pushgurdian = $defulatGurdians['guardian_name'];
                $totlalpushgurdian = count($pushgurdian);
                if($totlalpushgurdian == 1 ){
                    array_push($pushgurdian,$getpartnername ); 
                    $dopusharr = array($pushgurdian);
                    $dopush = $dopusharr[0];
                } else {
                    $dopush = array($getpartnername);
                }
            } 
            //children_submited_data
            $child_name_value = $_POST['child_name_value'];
            $age_under = $_POST['age_under'];
            $childrendata =  array(
                'child_name'=> $child_name_value,
                'mature_age'=>$age_under,
                'guardian_name'=>$dopush,
                'children_status'=> 1
            );

            //willed partne name save
            if(!empty($getpartnername)){
                $partnername = $getpartnername;
            } 
            $willdePartners = get_user_meta($userid, 'willed_partners',true);
            if(!empty($willdePartners)){
                array_push($willdePartners,$partnername);
                update_user_meta( $userid, 'willed_partners', $willdePartners );
                //update_user_meta( $userid, 'children_submitted_data', $childrendata );
                end($willdePartners);
                $key = key($willdePartners); 
                $lastindex =  $key;
                echo json_encode(array('msg'=>'petguardian_added' ,'guardnamechangeto'=> $partnername));
            } else {
                //update_user_meta( $userid, 'children_submitted_data', $childrendata );
                update_user_meta( $userid, 'willed_partners', array($partnername) );
                echo json_encode(array('msg'=>'petguardian_added','guardnamechangeto'=> $partnername ));
            }
            die();
        }
    }
}



//save updated pet partner name popup
add_action('wp_ajax_edit_petguardians_name','edit_petguardians_name');
add_action('wp_ajax_nopriv_edit_petguardians_name','edit_petguardians_name');
if ( ! function_exists( 'edit_petguardians_name' ) ) {
    function edit_petguardians_name(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $editInputval = $_POST['upd_gurdaina_name'];
            $guardian_old_name = $_POST['guardian_old_name'];
            $get_allguradianData =  get_user_meta( $userid, 'willed_partners', true );
            $Key_of_valuetobeUpdat =  array_search($guardian_old_name, $get_allguradianData);
            foreach($get_allguradianData as $key => $value){
                $get_allguradianData[$Key_of_valuetobeUpdat] = $editInputval;
            }
            $all_guradianDatatobeSaved = $get_allguradianData;
            update_user_meta( $userid, 'willed_partners', $all_guradianDatatobeSaved );
            echo json_encode(array('msg'=>'pet_popupDataSave', 'gurdina_name'=>$editInputval));
        die();
        }
    }
}

//Get child data when edit
add_action('wp_ajax_pets_data_edit','pets_data_edit');
add_action('wp_ajax_nopriv_pets_data_edit','pets_data_edit');
if ( ! function_exists( 'pets_data_edit' ) ) {
    function pets_data_edit(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_indexNumbrtoUpd = $_POST['indexNumbrtoUpd'];
            $ridi = get_user_meta( $wf_userid, 'pet_submitted_data', true );
            $get_allchildanData = $ridi; 
            foreach($get_allchildanData as $key => $singlevalue){
                if($key==$wf_indexNumbrtoUpd){
                    $rtnPetname = $singlevalue['pet_name'];
                    $rtnPetType = $singlevalue['pet_type'];
                    $rtnPetGurdian = $singlevalue['guardian_name'];
                    $rtnPetgiftpric = $singlevalue['gift_maintenance'];
                }
            }
            $editdata = array(
                'msg'=>'single_child_data',
                'rtnPetname'=>$rtnPetname,
                'rtnPetType'=>$rtnPetType,
                'rtnPetGurdian'=>$rtnPetGurdian,   
                'rtnPetgiftpric'=>$rtnPetgiftpric,
                'rtnPetrowIndex'=>$wf_indexNumbrtoUpd,
                
            );
            echo json_encode( $editdata);
        }
        die(); 
    }
}
