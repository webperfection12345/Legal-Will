<?php 
add_action('wp_ajax_funeral_dashboard','funeral_dashboard');
add_action('wp_ajax_nopriv_funeral_dashboard','funeral_dashboard');



/*****************About-dashaboard submit function******************/
if ( ! function_exists( 'funeral_dashboard' ) ) {
    function funeral_dashboard(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_funeral_status = $_POST['wf_funeral_status'];
            $funeral_wishes_textarea = $_POST['funeral_wishes_textarea'];
            $funeraldata =  array(
                'funeral_wishes_status'=> $wf_funeral_status,
                'funeral_wishes_textarea'=>$funeral_wishes_textarea,
                'funeral_status'=> 1
            );
            $willdePartnr_next = get_user_meta($wf_userid, 'willed_partners',true);
            update_user_meta( $wf_userid, 'funeral_submitted_data', $funeraldata );
        	echo json_encode(array('msg'=>'funeral_updated'));
        }
        die();
    }
}




add_action('wp_ajax_save_funeral','save_funerals');
add_action('wp_ajax_nopriv_save_funerals','save_funerals');
if ( ! function_exists( 'save_funerals' ) ) {
    function save_funerals(){
        if( isset( $_POST['action'] ) ){
            $getfuneralname = $_POST['funeral_wishes_textarea'];
            $funeralname='';
            if(!empty($getfuneralname)){
                $funeralname = $getfuneralname;
            } 
            $relationship_status = $_POST['funeral_wishes_status'];
            $userid = $_POST['userid'];
            $funeraldata =  array(
                'funeral_wishes_status'=> $relationship_status,
                'funeral_wishes_textarea'=>$funeralname,
                'funeral_status'=> 1
            );
            $willdePartners = get_user_meta($userid, 'willed_partners',true);
            if(!empty($willdePartners)){
                array_push($willdePartners,$funeralname);
                update_user_meta( $userid, 'willed_partners', $willdePartners );
                update_user_meta( $userid, 'funeral_submitted_data', $funeraldata );
                end($willdePartners);
                $key = key($willdePartners); 
                $lastindex =  $key;
                //echo  $lastindex;
                echo json_encode(array('msg'=>'funeral_added' ,'lastindex'=> $lastindex));
            } else {
                update_user_meta( $userid, 'funeral_submitted_data', $funeraldata );
                update_user_meta( $userid, 'willed_partners', array($funeralname) );
                //echo 'funeral_added';
                echo json_encode(array('msg'=>'funeral_added'));
            }
            // die();
        }
    }
}


?>