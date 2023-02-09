<?php 
include( CD_PLUGIN_PATH . 'templates/wf_head.php');
if( isset($_GET) ){
    $willedget = $_GET['will'];
    $willedmsg = $_GET['msg'];
    $willeduid = $_GET['uid'];
    if( $willedget !='' && $willedmsg !='' && is_numeric($willeduid) ){
    	$userid = $willeduid;
    	$user_info = get_userdata($userid);
    	$emailVerif_status = get_user_meta($userid, 'login_status',true);
    	if($emailVerif_status == 0){
		 	update_user_meta($userid, 'login_status', 1);
    	} elseif($emailVerif_status == 1){
    		echo 'Email already verified. Please login';
    	} else{}
	}
}
?>
<div class="wflogin_container">
	<?php 
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image_url = wp_get_attachment_image_src ( $custom_logo_id , 'full' );
	?>
	<!-- Welcome -->
	<div class="logo_willed_form"><img src="<?php echo $image_url[0];?>" class="wf_form_logo"></div>
	<form class="logform" >
		<h4 class="title">Email verified!</h4>				
		<div>
			<p>Your account has been activate. Now you can login to your account.</p>
		</div>
		<div class="booka_call">
			<p><a href="<?php echo site_url('/wflogin/'); ?>" class="login_btn">Log in</a></p>
		</div>
	</form>
</div>