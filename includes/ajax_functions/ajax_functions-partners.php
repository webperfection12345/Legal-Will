<?php 
add_action('wp_ajax_partner_dashboard','partner_dashboard');
add_action('wp_ajax_nopriv_partner_dashboard','partner_dashboard');

/*****************About-dashaboard submit function******************/
if ( ! function_exists( 'partner_dashboard' ) ) {
    function partner_dashboard(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_relates_status = $_POST['wf_relates_status'];
            $wf_partner_name = $_POST['wf_partner_name'];
            $partnerdata =  array(
                'relatives_status'=> $wf_relates_status,
                'partner_name'=>$wf_partner_name,
                'partner_status'=> 1
            );
            $willdePartnr_next = get_user_meta($wf_userid, 'willed_partners',true);
            update_user_meta( $wf_userid, 'partner_submitted_data', $partnerdata );
        	echo json_encode(array('msg'=>'partner_updated'));
        }
        die();
    }
}



add_action('wp_ajax_save_partners','save_partners');
add_action('wp_ajax_nopriv_save_partners','save_partners');
if ( ! function_exists( 'save_partners' ) ) {
    function save_partners(){
        if( isset( $_POST['action'] ) ){
            $getpartnername = $_POST['partnername'];
            $partnername='';
            if(!empty($getpartnername)){
                $partnername = $getpartnername;
            } 
            $relationship_status = $_POST['relationship_status'];
            $userid = $_POST['userid'];
            $partnerdata =  array(
                'relatives_status'=> $relationship_status,
                'partner_name'=>$partnername,
                'partner_status'=> 1
            );
            $willdePartners = get_user_meta($userid, 'willed_partners',true);
            if(!empty($willdePartners)){
                array_push($willdePartners,$partnername);
                update_user_meta( $userid, 'willed_partners', $willdePartners );
                update_user_meta( $userid, 'partner_submitted_data', $partnerdata );
                end($willdePartners);
                $key = key($willdePartners); 
                $lastindex =  $key;
                //echo  $lastindex;
                echo json_encode(array('msg'=>'patner_added' ,'lastindex'=> $lastindex));
            } else {
                update_user_meta( $userid, 'partner_submitted_data', $partnerdata );
                update_user_meta( $userid, 'willed_partners', array($partnername) );
                //echo 'patner_added';
                echo json_encode(array('msg'=>'patner_added'));
            }
            die();
        }
    }
}


add_action('wp_ajax_upd_partners','upd_partners');
add_action('wp_ajax_nopriv_upd_partners','upd_partners');
if ( ! function_exists( 'upd_partners' ) ) {
    global $wpdb; 
    if( isset($_POST['upd_partnername']) &&  isset( $_POST['partner_userid']) && isset( $_POST['item_index']) ){
        $partnername = $_POST['upd_partnername'];
        $partner_userid = $_POST['partner_userid'];
        $wf_relates_status = $_POST['wf_relates_status'];
        $item_index = $_POST['item_index'];
        $partnerdata =  array(
            'relatives_status'=> $wf_relates_status,
            'partner_name'=>$partnername,
            'partner_status'=> 1
        );
        $allpartmers = get_user_meta( $partner_userid, 'willed_partners', true );
        unset($allpartmers[$item_index]); 
        $afterunset = $allpartmers;
        array_push($afterunset,$partnername );

        $umetidparnt = $wpdb->get_results("SELECT `umeta_id` FROM `wp_usermeta` WHERE `meta_key` = 'partner_submitted_data' AND `user_id` = '".$partner_userid."' ");
        foreach ($umetidparnt as $valuesss) {
            $chkd = $wpdb->query($wpdb->prepare("UPDATE `wp_usermeta` SET `meta_key` = 'partner_submitted_data', `meta_value`='".serialize($partnerdata). "' WHERE user_id = '".$partner_userid."' AND umeta_id = '".$valuesss->umeta_id."' "));
            if($chkd){
                // echo json_encode(array('msg'=>'edit_partner_upd'));
               
            }
        }

        $meta_value  = get_user_meta($partner_userid, 'willed_partners',true);
        if(!empty($meta_value)){
            $meta_value[$item_index] = $partnername;
            $table_name = $wpdb->prefix.'usermeta';
            $umetid = $wpdb->get_results("SELECT `umeta_id` FROM `wp_usermeta` WHERE `meta_key` = 'willed_partners' AND `user_id` = '".$partner_userid."' ");
            foreach ($umetid as $valuess) {
                $chk = $wpdb->query($wpdb->prepare("UPDATE `wp_usermeta` SET `meta_key` = 'willed_partners', `meta_value`='". serialize($afterunset). "' WHERE user_id = '".$partner_userid."' AND umeta_id = '".$valuess->umeta_id."' "));
                //if($chk){
                    //echo 'edit_partner_upd';
                  
//
              //  }
            }
        }
        echo json_encode(array('msg'=>'edit_partner_upd'));
        die();
    }
}
?>