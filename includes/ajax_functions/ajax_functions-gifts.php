<?php 
add_action('wp_ajax_gift_dashboard','gift_dashboard');
add_action('wp_ajax_nopriv_gift_dashboard','gift_dashboard');
if ( ! function_exists( 'gift_dashboard' ) ) {
    function gift_dashboard(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $getDefaultData = get_user_meta( $wf_userid, 'gift_submitted_data', true );
            if(!empty($getDefaultData)){
                $giftdata = $getDefaultData;
            } else {
                $giftdata =  array(
                    'gift_name'=>'',
                    'gift_status'=> 1
                );
            }
            update_user_meta( $wf_userid, 'gift_submitted_data', $giftdata );
            echo json_encode(array('msg'=>'gift_submited'));
        }
        die();
    }
}




//Add gift data
add_action('wp_ajax_gift_dataSave','gift_dataSave');
add_action('wp_ajax_nopriv_gift_dataSave','gift_dataSave');
if ( ! function_exists( 'gift_dataSave' ) ) {
    function gift_dataSave(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_giftPersonName = $_POST['wf_giftPersonName'];
            $wf_giftType = $_POST['wf_giftTypeValue'];
            $wf_giftamount = $_POST['wf_giftamount'];
            $wf_giftAsset = $_POST['wf_giftAsset'];
            
            $gift_type_value;
            if(!empty($wf_giftAsset)){ $gift_type_value = $wf_giftAsset;}
            if(!empty($wf_giftamount)){ $gift_type_value = $wf_giftamount;}
            $giftdatatoSave =  array(
                'gift_person_name'=>$wf_giftPersonName,
                'gift_type'=>$wf_giftType,
                'gift_type_value'=>$gift_type_value,
            );
            $petsdatatoSave =  array(
                'gift_data'=>array($giftdatatoSave),
                'gift_status'=> 1
            );          
            $gift_data_get = get_user_meta($wf_userid, 'gift_submitted_data',true);
            $nullgiftdata = $gift_data_get['gift_data'];
            if(!empty($nullgiftdata)){
                array_push($nullgiftdata,$giftdatatoSave );  
               $nullgiftdata =array( 'gift_data'=>$nullgiftdata,
                'gift_status'=> 1);
            } else { 
                $nullgiftdata  = $petsdatatoSave;
            }
            //print_r($nullgiftdata);
            update_user_meta( $wf_userid, 'gift_submitted_data', $nullgiftdata );
            echo json_encode(array('msg'=>'gift_data_saved'));
        }
        die(); 
    }
}



//Update gift data
add_action('wp_ajax_gift_dataUpd','gift_dataUpd');
add_action('wp_ajax_nopriv_gift_dataUpd','gift_dataUpd');
if ( ! function_exists( 'gift_dataUpd' ) ) {
    function gift_dataUpd(){
        if( isset( $_POST['action'] ) ){
            $ed_wf_userid = $_POST['ed_wf_userid'];
            $ed_wf_giftamount = $_POST['ed_wf_giftamount'];
            $ed_wf_giftAsset = $_POST['ed_wf_giftAsset'];
            $ed_wf_giftType = $_POST['ed_wf_giftType'];
            $ed_wf_giftPersonName = $_POST['ed_wf_giftPersonName'];
            $ed_wf_giftIndexVal = $_POST['ed_wf_giftIndexVal'];
            
            if($ed_wf_giftAsset!=''){
                $ed_wf_giftTypeVal =  $ed_wf_giftAsset;
            } 
            if($ed_wf_giftamount!=''){
               $ed_wf_giftTypeVal =  $ed_wf_giftamount; 
            } 
            $editInputval = array(
                'gift_person_name'=> $ed_wf_giftPersonName,
                'gift_type' => $ed_wf_giftType,
                'gift_type_value' => $ed_wf_giftTypeVal    
            ); 

            $Edget_giftData =  get_user_meta( $ed_wf_userid, 'gift_submitted_data', true );
            $rearrangeupdData = $Edget_giftData['gift_data'];
            foreach ($rearrangeupdData  as $Ed_key => $get_petData_value) {
                if($Ed_key == $ed_wf_giftIndexVal){
                    $rearrangeupdData[$ed_wf_giftIndexVal] = $editInputval;
                }
            }
            $Upd_giftdata = array( 'gift_data'=>$rearrangeupdData,
                'gift_status'=> 1);
            update_user_meta( $ed_wf_userid, 'gift_submitted_data', $Upd_giftdata);
            echo json_encode(array('msg'=>'gift_data_updated'));
        }
        die(); 
    }
}




/****Each Gift delete ****/
//delete pet data
add_action('wp_ajax_delete_gift','delete_gift');
add_action('wp_ajax_nopriv_delete_gift','delete_gift');
if ( ! function_exists( 'delete_gift' ) ) {
    function delete_gift(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['wf_userid'];
            $deleteInputIndex = $_POST['wf_row_index'];
            $get_giftData =  get_user_meta( $userid, 'gift_submitted_data', true );
            $giftdata = $get_giftData['gift_data'];
            foreach ($giftdata  as $key => $get_petData_value) {
                if($key == $deleteInputIndex){
                    unset($giftdata[$deleteInputIndex]);
                }
            }
            $get_petDataarange = array_values($giftdata);
            $all_petDatatobeSaveds = $get_petDataarange;
            $dateAftergiftDel =array( 
                'gift_data'=>$all_petDatatobeSaveds,
                'gift_status'=> 1
            );

            $get_childrData_name = $get_childrData['child_name'];
            $get_childrData_age = $get_childrData['mature_age'];
            $get_childrData_status = $get_childrData['children_status'];
            $upd_after_del_gudrdian =  array(
                'child_name'=> $get_childrData_name,
                'mature_age'=>$get_childrData_age,
                'guardian_name'=>$reset_guradianNames,
                'children_status'=> $get_childrData_status
            );
            update_user_meta( $userid, 'gift_submitted_data', $dateAftergiftDel );
            echo json_encode(array('msg'=>'gift_deleted'));
        die();
        }
    }
}

?>