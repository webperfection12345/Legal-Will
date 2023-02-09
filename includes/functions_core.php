<?php 
//require_once( wp_normalize_path(ABSPATH).'class-phpass.php');
/*****************Global shortcode*********************/
function willed_bualcutor_shortcode($atts, $content = null){
    ob_start();
    extract( shortcode_atts( array(), $atts ) );
    $nc_scroll_c = include( CD_PLUGIN_PATH . 'templates/start_page.php');
    $nc_scroll_c = ob_get_clean();
    return $nc_scroll_c;
}
add_shortcode('online_willed_form', 'willed_bualcutor_shortcode');

/********Email exist on creae account**********/
add_action('wp_ajax_test_email','test_email');
add_action('wp_ajax_nopriv_test_email','test_email');
function test_email(){
    if(isset($_POST['email'])){
        $email = $_POST['email'];       
        $exists = email_exists( $email );
        if ( $exists ) {           
           echo json_encode(false);
        } else {
            //echo "Email available";
            echo json_encode(true);
        }
        die();
    }   
}

/********Email exist on creae account**********/
add_action('wp_ajax_createuser_account','createuser_account');
add_action('wp_ajax_nopriv_createuser_account','createuser_account');
function createuser_account(){
    if(isset($_POST['action']) && isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email']; 
        $password = $_POST['password']; 

        if(isset($_POST['email'])){
            $email = $_POST['email'];       
            $exists = email_exists( $email );
            if ( $exists ) {           
                echo json_encode( array('msg' => 'email_exists', 'new_id'=>$user_id ) );
            } else {
                $userdata = array(
                    'user_login'            => rand(),   
                    'user_pass'             => $password,   
                    'user_email'            => $email,   //(string) The user email address. 
                );
                $user_id = wp_insert_user( $userdata ) ;
                if($user_id ){
                    update_user_meta($user_id ,'login_status',0);
                    $user = get_user_by( 'id', $user_id ); 
                    if( $user ) {
                        $Acturl ='https://hlblawyers.com.au/wfactmsg/?will=userAct&msg=true&uid='.$user_id;
                        $admin_email = get_option( 'admin_email' );
                        $to = $email;
                        $subject = 'Registration request | Willed Form';

                        $headers = "From: " . strip_tags($admin_email) . "\r\n";
                        $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                        $message = '<html><body>';
                        $message .= '<div style="width:450px;margin:0 auto;"><div style="text-align: center;"><h2>Thank you for register!</h2></div><div>For activate your account, click on following activate link:-</div><br><a target="_blank" style="border: 1px solid;padding: 10px 15px;text-decoration: none;background: #1b75cf;color:#fff;" href="'.$Acturl.'">Activate</a></div>';
                        $message .= "</body></html>";
                        $sent = wp_mail($to, $subject, $message, $headers);
                        if($sent){
                           echo json_encode( array('msg' => 'accountcreate', 'new_id'=>$user_id ) );
                           //ob_flush(); 
                           //flush();
                        }
                    } 
                }
            }
        }
    }
    die();
}

/*****************Enqueue Ajax url***********************/
add_action('wp_enqueue_scripts' , 'add_ajax_variale');
function add_ajax_variale(){

    wp_enqueue_script('ajax_custom_script',CD_PLUGIN_URL.'/assets/js/willed-script.js', null, null, true );
    wp_localize_script( 'ajax_custom_script', 'frontendajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));

    wp_register_script( 'ajax_dashbaord_script',  CD_PLUGIN_URL . '/assets/js/dashbord-script.js', null, null, true);
    wp_localize_script( 'ajax_dashbaord_script', 'dahsbaordajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    wp_enqueue_script( 'ajax_dashbaord_script' );
}

/***********Redirect on dashboard after login ***********/
if(isset($_GET['wf-action'])){ 
    $wf_action = $_GET['wf-action']; 
    if( !empty($wf_action) && $wf_action == 'dashboard' ){
        include( CD_PLUGIN_PATH . 'templates/dashboard.php');
    }
}

/********Login account**********/
add_action('wp_ajax_login_act','login_act');
add_action('wp_ajax_nopriv_login_act','login_act');
function login_act(){
    if(isset($_POST['emailValue']) && isset($_POST['passwordValue'])){
        $email = $_POST['emailValue'];
        $password = $_POST['passwordValue'];
        if( !empty($email) || !empty ($password) ){     
            $user = get_user_by('email', $email);
            if(!$user){
                echo json_encode( array('msg' => 'email_pswd_invalid') );
            } else {
                $emailVerif_status = get_user_meta($user->ID, 'login_status',true);
                if( $emailVerif_status == 1 ){
                    $wp_hasher = new PasswordHash(8, TRUE);
                    $password_hashed = $user->user_pass;
                    $plain_password = $password;
                    if(wp_check_password($plain_password, $password_hashed, $user->ID) ){
                        wp_set_current_user( $user->ID, $user->user_login );
                        wp_set_auth_cookie( $user->ID );
                        do_action( 'wp_login', $user->user_login, $user );
                        echo json_encode( array('msg' => 'successlog') );
                    } else {
                        echo json_encode( array('msg' => 'email_pswd_invalid') );
                    }
                } else {
                    echo json_encode( array( 'msg' => 'email_not_verified') );
                }
            }
            die();
        }
    }   
}

/**************No priv ajax functions***************/
//About
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-about.php' );
//Partner
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-partners.php' );
//Children
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-childrens.php' );
//Pets
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-pets.php' );
//Executors
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-executors.php' );
//Divide Estate
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-divide_estate.php' );
//Gifts
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-gifts.php' );
//Funral wishes
require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-funral_wishes.php' );
//payemnt
//require_once( CD_PLUGIN_PATH . 'includes/ajax_functions/ajax_functions-childrens.php' );