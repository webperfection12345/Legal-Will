<?php 
/************Core functions***********/
require_once( CD_PLUGIN_PATH . 'includes/functions_core.php' );

/********JS and CSS files**********/
add_action( 'wp_enqueue_scripts', 'my_enqueue' );
function my_enqueue() {
 /*   wp_register_script( 'jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    wp_enqueue_script('jQuery');

    wp_register_script( 'Validation', 'https://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js');
    wp_enqueue_script('Validation');

    wp_register_style( 'font-awsome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style('font-awsome');

    wp_register_style('bs_style','https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css');
    wp_enqueue_style('bs_style');

    wp_register_script('bs_popper','https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js' );
    wp_enqueue_script('bs_popper');

     wp_register_script('bs_js', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js' );
    wp_enqueue_script('bs_js');

    wp_register_style( 'yourplugin_front', CD_PLUGIN_URL . '/assets/css/willed-style.css' );
    wp_enqueue_style('yourplugin_front');

    wp_register_script('yourplugin_back', CD_PLUGIN_URL. '/assets/js/willed-script.js' );
    wp_enqueue_script('yourplugin_back');

    wp_register_script('yourplugin_easing', '//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js' );
    wp_enqueue_script('yourplugin_easing');

*/
}  

add_action( 'init', 'url_crappier_method' );
function url_crappier_method(){
    $willedD =  $_SERVER['REQUEST_URI'];
    $string = $willedD;
    $trimmed = preg_replace('(^.)', '', $string);
    $trimmed = preg_replace('(.$)', '', $trimmed);
    if($trimmed=='willed-form'){?>
        <style type="text/css">
            .elementor-location-header,
            .page-header h1.entry-title,
            .elementor-location-footer
            {display: none;}
        </style>
    <?php 
    /*} elseif($trimmed=='wflogin'){
    ?>  
      <style type="text/css">
            .elementor-location-header,
            {display: none;}
        </style>
    <?php */
    } else{

    }

}


?>