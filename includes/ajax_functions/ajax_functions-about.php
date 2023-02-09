<?php 
add_action('wp_ajax_about_dashboard','about_dashboard');
add_action('wp_ajax_nopriv_about_dashboard','about_dashboard');

/*****************About-dashaboard submit function******************/
if ( ! function_exists( 'about_dashboard' ) ) {
    function about_dashboard(){
        if( isset( $_POST['action'] ) ){
            $wf_userid = $_POST['wf_userid'];
            $wf_first_name = $_POST['wf_first_name'];
            $wf_middle_name = $_POST['wf_middle_name'];
            $wf_last_name = $_POST['wf_last_name'];
            $wf_dob_day = $_POST['wf_dob_day'];
            $wf_dob_month = $_POST['wf_dob_month'];
            $wf_dob_year = $_POST['wf_dob_year'];
            $wf_google_address = $_POST['wf_google_address'];
            $wf_phone = $_POST['wf_phone'];

            if(!empty($wf_first_name)){
                update_user_meta( $wf_userid, 'first_name', $wf_first_name );
            }
            if(!empty($wf_middle_name)){
               // update_user_meta( $wf_userid, 'middle_name', $wf_middle_name );
            }
            if(!empty($wf_last_name)){
                update_user_meta( $wf_userid, 'last_name', $wf_last_name );
            }
            if(!empty($wf_dob_day)){
               // update_user_meta( $wf_userid, 'dob_day', $wf_dob_day );
            }
            if(!empty($wf_dob_month)){
                //update_user_meta( $wf_userid, 'dob_month', $wf_dob_month );
            }
            if(!empty($wf_dob_year)){
               // update_user_meta( $wf_userid, 'dob_year', $wf_dob_year );
            }
            if(!empty($wf_google_address)){
                //update_user_meta( $wf_userid, 'google_address', $wf_google_address );
            }
            if(!empty($wf_phone)){
               // update_user_meta( $wf_userid, 'phone', $wf_phone );
            }

            $aboutdata =  array(
                'first_name'=> $wf_first_name,
                'middle_name'=> $wf_middle_name,
                'last_name'=> $wf_last_name,
                'dob_day'=> $wf_dob_day,
                'dob_month'=> $wf_dob_month,
                'dob_year'=> $wf_dob_year,
                'google_address'=> $wf_google_address,
                'phone'=> $wf_phone,
                'about_status'=> 1
            );
            update_user_meta( $wf_userid, 'about_submitted_data', $aboutdata );
        	echo 'about_updated';

        }
        die();
    }
}?>