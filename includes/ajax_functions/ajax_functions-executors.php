<?php 
//Add primary executors data
/*add_action('wp_ajax_primary_executor_data_save','primary_executor_data_save');
add_action('wp_ajax_nopriv_primary_executor_data_save','primary_executor_data_save');
if ( ! function_exists( 'primary_executor_data_save' ) ) {
    function primary_executor_data_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $primary_exe_names = $_POST['primary_exe_names'];
            if(!empty($primary_exe_names)){
                $prim_exec_na = $primary_exe_names;
            } else {
                $prim_exec_na = array();
            }
            $child_data_get = get_user_meta($user_id, 'primary_executor_submitted_data',true);
            $prim_exec_ndata =  array(
                'primary_executor_name'=>$prim_exec_na,
                'primary_executor_status'=> 1
            );
            update_user_meta( $wf_userid, 'primary_executor_submitted_data', $prim_exec_ndata );
            echo json_encode(array('msg'=>'primary_exe_data_saved'));
        }
        die(); 
    }
}*/

//Add New primary executor
add_action('wp_ajax_add_new_bkp_exec','add_new_bkp_exec');
add_action('wp_ajax_nopriv_add_new_bkp_exec','add_new_bkp_exec');
if ( ! function_exists( 'add_new_bkp_exec' ) ) {
    function add_new_bkp_exec(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $getBkpExeName = $_POST['bkp_exector_name'];
            //willed partne name save
            if(!empty($getBkpExeName)){
                $bkpExename = $getBkpExeName;
            } 
            $willdePartners = get_user_meta($userid, 'willed_partners',true);
            if(!empty($willdePartners)){
                array_push($willdePartners,$bkpExename);
                update_user_meta( $userid, 'willed_partners', $willdePartners );
                end($willdePartners);
                $key = key($willdePartners); 
                $lastindex =  $key;
                echo json_encode(array('msg'=>'bkp_exec_update' ,'retrunbkp_exec_name'=> $getBkpExeName));
            } else {
                update_user_meta( $userid, 'willed_partners', array($bkpExename) );
                echo json_encode(array('msg'=>'bkp_exec_added', 'retrunbkp_exec_name'=> $getBkpExeName ));
            }
            die();
        }
    }
}

//save updated partner Executor name popup
add_action('wp_ajax_upda_prm_executor_name','upda_prm_executor_name');
add_action('wp_ajax_nopriv_upda_prm_executor_name','upda_prm_executor_name');
if ( ! function_exists( 'upda_prm_executor_name' ) ) {
    function upda_prm_executor_name(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $editInputvalof_primary_exec = $_POST['primaryExe_val'];
            $primeExe_old_name = $_POST['primaryExe_old_name'];
            //updated in willed partner
            $get_allprimary_executorsData =  get_user_meta( $userid, 'willed_partners', true );
            $Key_of_valuetobeUpdat =  array_search($primeExe_old_name, $get_allprimary_executorsData);
            foreach($get_allprimary_executorsData as $key => $value){
                $get_allprimary_executorsData[$Key_of_valuetobeUpdat] = $editInputvalof_primary_exec;
            }
            $all_primary_execDatatobeSaved = $get_allprimary_executorsData;
            update_user_meta( $userid, 'willed_partners', $all_primary_execDatatobeSaved );
            echo json_encode(array('msg'=>'prmExec_popupDataSave', 'primary_exec_name'=>$editInputvalof_primary_exec));
        die();
        }
    }
}

/*********************Start function backup executor**********************/
//Add Backup executors data
/*add_action('wp_ajax_backup_executor_data_save','backup_executor_data_save');
add_action('wp_ajax_nopriv_backup_executor_data_save','backup_executor_data_save');
if ( ! function_exists( 'backup_executor_data_save' ) ) {
    function backup_executor_data_save(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $backup_exe_names = $_POST['backup_exe_names'];
            if(!empty($backup_exe_names)){
                $backup_exec_na = $backup_exe_names;
            } else {
                $backup_exec_na = array();
            }
            $backup_exec_ndata =  array(
                'backup_executor_name'=>$backup_exec_na,
                'backup_executor_status'=> 1
            );
            update_user_meta( $wf_userid, 'backup_executor_submitted_data', $backup_exec_ndata );
            echo json_encode(array('msg'=>'backup_exe_data_saved'));
        }
        die(); 
    }
}
*/

//Add New Backup executor
add_action('wp_ajax_add_new_prm_exec','add_new_prm_exec');
add_action('wp_ajax_nopriv_add_new_prm_exec','add_new_prm_exec');
if ( ! function_exists( 'add_new_prm_exec' ) ) {
    function add_new_prm_exec(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $getormExeName = $_POST['partnername'];
            //willed partne name save
            if(!empty($getormExeName)){
                $partnername = $getormExeName;
            } 
            $willdePartners = get_user_meta($userid, 'willed_partners',true);
            if(!empty($willdePartners)){
                array_push($willdePartners,$partnername);
                update_user_meta( $userid, 'willed_partners', $willdePartners );
                //update_user_meta( $userid, 'children_submitted_data', $childrendata );
                end($willdePartners);
                $key = key($willdePartners); 
                $lastindex =  $key;
                echo json_encode(array('msg'=>'prm_exec_update' ,'retrunPrm_exec_name'=> $getormExeName));
            } else {
                update_user_meta( $userid, 'willed_partners', array($partnername) );
                echo json_encode(array('msg'=>'prm_exec_added', 'retrunPrm_exec_name'=> $getormExeName ));
            }
            die();
        }
    }
}

//save updated Primary Executor name popup
add_action('wp_ajax_upda_bkp_executor_name','upda_bkp_executor_name');
add_action('wp_ajax_nopriv_upda_bkp_executor_name','upda_bkp_executor_name');
if ( ! function_exists( 'upda_bkp_executor_name' ) ) {
    function upda_bkp_executor_name(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['userid'];
            $editInputvalof_backup_exec = $_POST['backupExe_val'];
            $bkp_exec_old_name = $_POST['backupExe_old_name'];
            //updated in willed partner
            $get_allbakcup_executorsData =  get_user_meta( $userid, 'willed_partners', true );
            $bkpKey_of_valuetobeUpdat =  array_search($bkp_exec_old_name, $get_allbakcup_executorsData);
            foreach($get_allbakcup_executorsData as $key => $value){
                $get_allbakcup_executorsData[$bkpKey_of_valuetobeUpdat] = $editInputvalof_backup_exec;
            }
            $all_backup_execDatatobeSaved = $get_allbakcup_executorsData;
            update_user_meta( $userid, 'willed_partners', $all_backup_execDatatobeSaved );
            echo json_encode(array('msg'=>'bkpExec_popupDataSave', 'backup_exec_name'=>$editInputvalof_backup_exec));
        die();
        }
    }
}


/**********************Identify executor fnction ****************************/
//save updated Primary Executor name popup
add_action('wp_ajax_indentify_executor_data_save','indentify_executor_data_save');
add_action('wp_ajax_nopriv_indentify_executor_data_save','indentify_executor_data_save');
if ( ! function_exists( 'indentify_executor_data_save' ) ) {
    function indentify_executor_data_save(){
        if( isset( $_POST['action'] ) ){
            $userid = $_POST['wf_userid'];
            $allIdentifyRows = $_POST['total_Addres_row'];
            //primary exe data
            $allprimaryName = $_POST['primary_exe_names'];
            $allprimaryAdress = $_POST['primary_exe_address'];
            $total_prmss =  count($allprimaryName);
            $total_prm =$total_prmss;
            foreach ($allprimaryName  as $key => $valuenm) {
                $valuenmArr[] = $valuenm; 
            }
            foreach ($allprimaryAdress  as $key => $valueadee) {
                $valueaddArr[] = $valueadee;
            }
            $alldataIdentifyExe=[]; 
            $i='';
            for($i=0;$i<=$total_prm-1;$i++){
                $alldataIdentifyExe[] = array(
                    'executor_name'=>$valuenmArr[$i],
                    'executor_address'=>$valueaddArr[$i]
                );      
            }
            //backup exe data
            $allBackupName = $_POST['backup_exe_names'];
            $allBackupAdress = $_POST['backup_exe_address']; 
            $total_bkpss =  count($allBackupName);
            $total_bkp =$total_bkpss;
            foreach ($allBackupName  as $key => $Bkpvaluenm) {
                $BkpvaluenmArr[] = $Bkpvaluenm; 
            }
            foreach ($allBackupAdress  as $key => $Bkpvalueadee) {
                $BkpvalueaddArr[] = $Bkpvalueadee;
            }
            $alldataBackupExe=[]; 
            $j='';
            for($j=0;$j<=$total_bkp-1;$j++){
                $alldataBackupExe[] = array(
                    'executor_name'=>$BkpvaluenmArr[$j],
                    'executor_address'=>$BkpvalueaddArr[$j]
                );      
            }
            $sendtoDbAlldata_identify_data =  array(
                'primary_executor_data'=>$alldataIdentifyExe,
                'backup_executor_data'=>$alldataBackupExe,
                'identify_executor_status'=> 1,
            );            
            update_user_meta( $userid,'identify_executor_submitted_data',$sendtoDbAlldata_identify_data );
            echo json_encode(array('msg'=>'IdentifyExec_popupDataSave') );
        die();
        }
    }
}
?>