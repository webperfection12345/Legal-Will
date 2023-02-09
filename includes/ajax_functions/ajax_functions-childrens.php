<?php 
add_action('wp_ajax_children_dashboard','children_dashboard');
add_action('wp_ajax_nopriv_children_dashboard','children_dashboard');

/*****************About-dashaboard submit function******************/
if ( ! function_exists( 'children_dashboard' ) ) {
    function children_dashboard(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $child_data_get = get_user_meta($wf_userid, 'children_submitted_data',true);
            if(!empty($child_data_get)){
                $childrendataTosave   =  $child_data_get; 
            } else {
                $getchildrendata =  array(
                    'child_name'=>'',
                    'mature_age'=>'',
                    'guardian_name'=>'',
                );
                $childrendataTosave = array( 
                    'child_data'=>array($getchildrendata),
                    'children_status'=> 1
                );
            }
            update_user_meta( $wf_userid, 'children_submitted_data', $childrendataTosave );
        	echo json_encode(array('msg'=>'chilren_updated'));
        }
        die();
    }
}


//Add child data
add_action('wp_ajax_child_data_save','child_data_save');
add_action('wp_ajax_nopriv_child_data_save','child_data_save');
if ( ! function_exists( 'child_data_save' ) ) {
    function child_data_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_child_name = $_POST['wf_child_name'];
            $age_under = $_POST['age_under'];
            $gudrian_names = $_POST['gudrian_names'];
            $childrendata =  array(
                'child_name'=> $wf_child_name,
                'mature_age'=>$age_under,
                'guardian_name'=>$gudrian_names,
            );
            $child_tdata = array( 
                'child_data'=>array($childrendata),
                'children_status'=> 1
            );
            $child_data_get = get_user_meta($wf_userid, 'children_submitted_data',true);
            if($child_data_get){
                $nullchilddata = $child_data_get['child_data'];
                array_push($nullchilddata,$childrendata );  
                $nullchilddata = array('child_data'=>$nullchilddata,
                'children_status'=> 1);
            } else { 
                $nullchilddata  = $child_tdata;
            }    
            update_user_meta( $wf_userid, 'children_submitted_data', $nullchilddata );
            echo json_encode(array('msg'=>'child_data_saved'));
        }
        die(); 
    }
}



//Get child data when edit
add_action('wp_ajax_child_data_edit','child_data_edit');
add_action('wp_ajax_nopriv_child_data_edit','child_data_edit');
if ( ! function_exists( 'child_data_edit' ) ) {
    function child_data_edit(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_indexNumbrtoUpd = $_POST['indexNumbrtoUpd'];
            $ridi = get_user_meta( $wf_userid, 'children_submitted_data', true );    
            $get_allchildanData = $ridi['child_data']; 
            foreach($get_allchildanData as $key => $singlevalue){
                if($key==$wf_indexNumbrtoUpd){
                    $rtnChildname = $singlevalue['child_name'];
                    $rtnChildage = $singlevalue['mature_age'];
                    $rtnChildGurdian = $singlevalue['guardian_name'];
                }
            }
            $editdata = array(
                'msg'=>'single_child_data',
                'rtnChildname'=>$rtnChildname,
                'rtnChildage'=>$rtnChildage,
                'rtnChildGurdian'=>$rtnChildGurdian
            );
            echo json_encode( $editdata);
        }
        die(); 
    }
}



//Update child data
add_action('wp_ajax_child_data_update','child_data_update');
add_action('wp_ajax_nopriv_child_data_update','child_data_update');
if ( ! function_exists( 'child_data_update' ) ) {
    function child_data_update(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid_edit'];
            $wf_child_name_edit = $_POST['wf_child_name_edit'];
            $age_under_edit = $_POST['age_under_edit'];
            $gudrian_names = $_POST['gudrian_names_edit'];
            $IndexNumTobeupd = $_POST['editIndexNum'];
            $child_data_get_edit = get_user_meta($wf_userid, 'children_submitted_data',true);

            if($age_under_edit=='no'){
               $gudrian_namesVal = ''; 
            }  
            if($age_under_edit=='yes'){
               $gudrian_namesVal =  $gudrian_names; 
            }  
            $childrendataEdit =  array(
                'child_name'=> $wf_child_name_edit,
                'mature_age'=>$age_under_edit,
                'guardian_name'=>$gudrian_namesVal,
            );
            $child_tdataedit = array( 
                'child_data'=>array($childrendataEdit),
                'children_status'=> 1
            );
            $child_data_get_editVAL = $child_data_get_edit['child_data'];
            foreach( $child_data_get_editVAL as $edkey => $singlevalue){
                if($edkey==$IndexNumTobeupd){
                    $child_data_get_editVAL[$IndexNumTobeupd] = $childrendataEdit;
                }
            }
            $child_data_editVALSave = array(
                'child_data'=>$child_data_get_editVAL,
                'children_status'=> 1
            ); 
            update_user_meta( $wf_userid, 'children_submitted_data', $child_data_editVALSave );
            echo json_encode(array('msg'=>'child_data_updated'));
        }
        die(); 
    }
}

//Add Guardian
add_action('wp_ajax_add_guardians','add_guardians');
add_action('wp_ajax_nopriv_add_guardians','add_guardians');
if ( ! function_exists( 'add_guardians' ) ) {
    function add_guardians(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $getpartnername = $_POST['partnername'];
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
                echo json_encode(array('msg'=>'guardian_added' ,'guadridnName' => $partnername));
            } else {
                //update_user_meta( $userid, 'children_submitted_data', $childrendata );
                update_user_meta( $userid, 'willed_partners', array($partnername) );
                echo json_encode(array('msg'=>'guardian_added','guadridnName' => $partnername));
            }
            die();
        }
    }
}


//Select Guardian
add_action('wp_ajax_selectGuardiansForChildren','selectGuardiansForChildren');
add_action('wp_ajax_nopriv_selectGuardiansForChildren','selectGuardiansForChildren');
if ( ! function_exists( 'selectGuardiansForChildren' ) ) {
    function selectGuardiansForChildren(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $slectedGurdain = $_POST['slectedGurdain'];
            $defulatGurdianss = get_user_meta( $userid, 'children_submitted_data',true);
            if(!empty($defulatGurdianss)){
                $pushgurdians = $defulatGurdianss['guardian_name'];
                $totlalpushgurdians = count($pushgurdians);
                if($totlalpushgurdians == 1 ){
                    array_push($pushgurdians,$slectedGurdain ); 
                    $dopusharrs = array($pushgurdians);
                    $dopushs = $dopusharrs[0];
                } else {
                    $dopushs = array($slectedGurdain);
                }
            } else {
               $dopushs = array($slectedGurdain); 
            }

            $get_childrData =  get_user_meta( $userid, 'children_submitted_data', true );
            $get_childrData_names = $get_childrData['child_name'];
            $get_childrData_ages = $get_childrData['mature_age'];
            $get_childrData_statuss = $get_childrData['children_status'];
            $childrendata =  array(
                'child_name'=> $get_childrData_names,
                'mature_age'=>$get_childrData_ages,
                'guardian_name'=>$dopushs,
                'children_status'=>$get_childrData_statuss
            );
            
            //updated in willed partner
            $guardian_old_names = $slectedGurdain;
            $get_allguradianDatas =  get_user_meta( $userid, 'willed_partners', true );
            $Key_of_valuetobeUpdat =  array_search($guardian_old_names, $get_allguradianDatas);
            unset($get_allguradianDatas[$Key_of_valuetobeUpdat]);
            $all_guradianDatatobeSaveds = $get_allguradianDatas;
            array_push($all_guradianDatatobeSaveds,$guardian_old_names);
            $SelectValSavedOnLastIndex = array_values($all_guradianDatatobeSaveds); 

            //update_user_meta( $userid, 'children_submitted_data', $childrendata );
            update_user_meta( $userid, 'willed_partners', $SelectValSavedOnLastIndex );
            echo json_encode(array('msg'=>'guardian_selected'));
            die();  
        }
    }
}

//delete gurdains of sidebar
add_action('wp_ajax_delete_guardians','delete_guardians');
add_action('wp_ajax_nopriv_delete_guardians','delete_guardians');
if ( ! function_exists( 'delete_guardians' ) ) {
    function delete_guardians(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $deleteInputIndex = $_POST['delInputIndex'];
            $get_childrData =  get_user_meta( $userid, 'children_submitted_data', true );
            $get_guardian_name = $get_childrData['guardian_name'];
            unset($get_guardian_name[$deleteInputIndex]);
            $reset_guradianNames = array_values($get_guardian_name); 
            
            $get_childrData_name = $get_childrData['child_name'];
            $get_childrData_age = $get_childrData['mature_age'];
            $get_childrData_status = $get_childrData['children_status'];
            $upd_after_del_gudrdian =  array(
                'child_name'=> $get_childrData_name,
                'mature_age'=>$get_childrData_age,
                'guardian_name'=>$reset_guradianNames,
                'children_status'=> $get_childrData_status
            );
            update_user_meta( $userid, 'children_submitted_data', $upd_after_del_gudrdian );
            echo json_encode(array('msg'=>'guardian_deleted'));
        die();
        }
    }
}

//edit gurdains name from popup
add_action('wp_ajax_edit_guardians_name','edit_guardians_name');
add_action('wp_ajax_nopriv_edit_guardians_name','edit_guardians_name');
if ( ! function_exists( 'edit_guardians_name' ) ) {
    function edit_guardians_name(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $editInputval = $_POST['upd_gurdaina_name'];
            $guardian_old_name = $_POST['guardian_old_name'];
            $guardian_keyindex = $_POST['guardian_keyindex'];
           
            //updated in willed partner
            $get_allguradianData =  get_user_meta( $userid, 'willed_partners', true );
            $Key_of_valuetobeUpdat =  array_search($guardian_old_name, $get_allguradianData);
            foreach($get_allguradianData as $key => $value){
                $get_allguradianData[$Key_of_valuetobeUpdat] = $editInputval;
            }
            $all_guradianDatatobeSaved = $get_allguradianData;
            update_user_meta( $userid, 'willed_partners', $all_guradianDatatobeSaved );
            echo json_encode(array('msg'=>'popupChildDataSave','newGardianName' => $editInputval));
        die();
        }
    }
}


//Update edited gurdains name from popup
add_action('wp_ajax_updaet_guardians_name','updaet_guardians_name');
add_action('wp_ajax_nopriv_updaet_guardians_name','updaet_guardians_name');
if ( ! function_exists( 'updaet_guardians_name' ) ) {
    function updaet_guardians_name(){
        if( isset( $_POST['action'] ) ){
            $userids = $_POST['userid'];
            $editInputval_edit = $_POST['upd_gurdaina_name_edit'];
            $guardian_old_name_edit = $_POST['guardian_old_name_edit'];
            $guardian_keyindex = $_POST['guardian_keyindex'];
            //updated in willed partner
            $get_allguradianData_edt =  get_user_meta( $userids, 'willed_partners', true );
            $Key_of_valuetobeUpdat_edit = array_search($guardian_old_name_edit, $get_allguradianData_edt);
            foreach($get_allguradianData_edt as $key => $value){
                $get_allguradianData_edt[$Key_of_valuetobeUpdat_edit] = $editInputval_edit;
            }
            $all_guradianDatatobeSaved_edi = $get_allguradianData_edt;
            update_user_meta( $userids, 'willed_partners', $all_guradianDatatobeSaved_edi );
            echo json_encode(array('msg'=>'popupGuradinaDataupdated','newGardianNamepopup' => $editInputval_edit));
        die();
        }
    }
}




//delete each child from db  
add_action('wp_ajax_deleteChildinDb','deleteChildinDb');
add_action('wp_ajax_nopriv_deleteChildinDb','deleteChildinDb');
if ( ! function_exists( 'deleteChildinDb' ) ) {
    function deleteChildinDb(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['wf_userid'];
            $deleteChildtIndex = $_POST['wf_childrow_index'];
            $allget_childsData =  get_user_meta( $userid, 'children_submitted_data', true );
            $get_childsData = $allget_childsData['child_data'];
            foreach ($get_childsData  as $key => $get_petData_value) {
                if($key == $deleteChildtIndex){
                    unset($get_childsData[$deleteChildtIndex]);
                }
            }
            $get_petDataarange = array_values($get_childsData);
            $Savechilddata = array(
                'child_data'=>$get_petDataarange,
                'children_status'=> 1
            );        
            update_user_meta( $userid, 'children_submitted_data', $Savechilddata );
            echo json_encode(array('msg'=>'child_deleted'));
        die();
        }
    }
}
?>