<?php
/**
 * Plugin Name: Willed Multipstep Form
 * Author: Webperfection
 * Version:1.0
**/

/*************** Do not allow directly accessing this file************/
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/*************Call core files***********/
define( 'CD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
require_once( CD_PLUGIN_PATH . 'lib/init.php' );

/**************Create template on plugin activation**************/
function create_video_pages() {
    $post = array(
        'post_title'    => wp_strip_all_tags( 'Willed Form' ),
        'post_content'  => '[online_willed_form]',
        'post_status'   => 'publish',
        'post_author'   => 1,
        'post_type'     => 'page',
    );
    $newvalue = wp_insert_post( $post, false );
    update_option( 'vidpage', $newvalue );

    //$template = CD_PLUGIN_PATH . 'templates/wf_dashboard.php';
    $postdahb = array(
        'comment_status' => 'closed',
        'ping_status' =>  'closed' ,
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_name' => 'wfdashboard',
        'post_status' => 'publish' ,
        'post_title' => 'WF Dashboard',
        'post_type' => 'page',
        //'page_template' => $template
    );  

    $newvaluepostdahb = wp_insert_post( $postdahb, false );
    update_option( 'vidpagedash', $newvaluepostdahb );
    update_post_meta( $newvaluepostdahb, '_wp_page_template', 'wf_dashboard.php' );

    //login page
    $postdahblog = array(
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_name' => 'wflogin',
        'post_status' => 'publish' ,
        'post_title' => 'WF Login',
        'post_type' => 'page',
    );  
    $newvaluepostlogn = wp_insert_post( $postdahblog, false );
    update_option( 'vidpagelogin', $newvaluepostlogn );
    update_post_meta( $newvaluepostlogn, '_wp_page_template', 'wf_login.php' );

    //Activation message page
    $postActMsg = array(
        'post_author' => 1,
        'post_date' => date('Y-m-d H:i:s'),
        'post_name' => 'wfactmsg',
        'post_status' => 'publish' ,
        'post_title' => 'WF Activation',
        'post_type' => 'page',
    );  
    $newActvalue = wp_insert_post( $postActMsg, false );
    update_option( 'vidpageActmsg', $newActvalue );
    update_post_meta( $newActvalue, '_wp_page_template','wf_activate_act_msg.php' );

}
register_activation_hook(__FILE__, 'create_video_pages');

add_action( 'template_include', 'uploadr_redirect' );
function uploadr_redirect( $template ) {
    $plugindir = dirname( __FILE__ );
    if ( is_page_template( 'wf_dashboard.php' )) {
        $template = $plugindir . '/templates/wf_dashboard.php';
    }
    return $template;
}

add_action( 'template_include', 'uploadr_redirect_login' );
function uploadr_redirect_login( $template ) {
    $plugindir = dirname( __FILE__ );
    if ( is_page_template( 'wf_login.php' )) {
        $template = $plugindir . '/templates/wf_login.php';
    }
    return $template;
}

add_action( 'template_include', 'uploadr_redirect_act_msg' );
function uploadr_redirect_act_msg( $template ) {
    $plugindir = dirname( __FILE__ );
    if ( is_page_template( 'wf_activate_act_msg.php' )) {
        $template = $plugindir . '/templates/wf_activate_act_msg.php';
    }
    return $template;
}


/**************Delete template on plugin deactivation*************/
function deactivate_plugin() {
    $page_id = get_option('vidpage');
    wp_delete_post($page_id);

    $page_iddash = get_option('vidpagedash');
    wp_delete_post($page_iddash);

    $page_idlogin = get_option('vidpagelogin');
    wp_delete_post($page_idlogin);

    $page_idmsgAct = get_option('vidpageActmsg');
    wp_delete_post($page_idmsgAct);

}
register_deactivation_hook( __FILE__, 'deactivate_plugin' );