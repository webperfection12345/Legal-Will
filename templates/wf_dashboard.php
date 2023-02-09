<?php 
//require_once( wp_normalize_path(ABSPATH).'wp-load.php');
include( CD_PLUGIN_PATH . 'templates/wf_head.php');
//include( CD_PLUGIN_PATH . 'includes/ajax_scripts/willed_ajax.php');
if(!is_user_logged_in()){wp_redirect(home_url());}
$user_id = get_current_user_id();
$user_data = wp_get_current_user();
$user_info = get_userdata( $user_id );
$homeURL =  home_url();
$wfdashboard = '/wfdashboard/';
$gotoEditulr = $homeURL.$wfdashboard;

$about_submitted_data = get_user_meta($user_id, 'about_submitted_data', true);
if($about_submitted_data){
$about_status = $about_submitted_data['about_status'];
}
//get_header();
?>
<div class="dashbaord_wrapper">
	<div class="container">
		<?php 
		if(isset($_GET['will'])){
			$queryurlval = $_GET['will'];
			if(!empty($queryurlval) && $queryurlval!=''){
				$main_title = '';
				/*edit menu*/
				echo '<div class="dashboard-sections">';
					if(!empty($queryurlval) && $queryurlval=='about'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/about_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						$main_title = 'Tell us about yourself';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-about.php');
					} else if(!empty($queryurlval) && $queryurlval=='partner'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/partners_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						$main_title = 'What is your relationship status?';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-partner.php');
					} else if(!empty($queryurlval) && $queryurlval=='children'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/children_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-children.php');
					} else if(!empty($queryurlval) && $queryurlval=='pets'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/pets_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-pets.php');
					} else if(!empty($queryurlval) && $queryurlval=='executors'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/executors_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-executors.php');
					}else if(!empty($queryurlval) && $queryurlval=='divideEstate'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/devide_state_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-divide_estate.php');
					} else if(!empty($queryurlval) && $queryurlval=='gifts'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/gifts_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-gifts.php');
					} else if(!empty($queryurlval) && $queryurlval=='funeralWishes'){
						include( CD_PLUGIN_PATH . 'includes/ajax_scripts/funeral_wishes_ajax_scripts.php');
						echo '<div class="div-'.$queryurlval.' ">';
						include(CD_PLUGIN_PATH. '/templates/edit-wfaccount/wf-funral_wishes.php');
					}
					echo '</div>';
				echo '</div>';
			}
		} else { ?>

			<!-- fronend dashboard -->
			<div class="row">
				<div class="col-md-6">
					<div class="image">
						<a href="https://hlblawyers.com.au"><img src="https://hlblawyers.com.au/wp-content/uploads/2021/08/logo.jpg"></a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="myaccount_login"> 
						<button type="button" class="" >My Account</button>
						<button type="button" class="" >
							<?php 
							if (is_user_logged_in()) : ?>
				        	<a href="<?php echo wp_logout_url(get_permalink()); ?>">Logout</a>
				        	<?php 
				    		endif;?>            
						</button>
					</div>

				</div>
				<div class="spacer"></div>
			</div>

			<div class="row title-row">
				<div class="col-md-7 offset-md-0 col-12">
					<div class="wf_title">
						<h3>Welcome</h3>
					</div>
				</div>
				<div class="col-md-4 offset-md-1 col-12">
					<div class="final-msg">
						<h4 >Final Messages</h4>
					</div>
				</div>  					
			</div>

			<div class="row">
				<!-- left panel -->
				<div class="col-md-7 col-12">
					<div class="your_will_box">
						<h4> Your Will </h4>
						<div class="dashboard_list_item">
							<h5>About you</h5>
							<div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=about'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
								<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
						</div>
						<div class="dashboard_list_item">
							<h5>Partner</h5>
							<div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=partner'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
								<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
						</div>
				        <div class="dashboard_list_item ">
				          	<h5>Children</h5>
				        	<div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=children'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
								<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
				      	</div>
				      	<div class="dashboard_list_item ">
				        	<h5>Pets</h5>
				    		<div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=pets'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
								<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
				  		</div>
				      	<div class="dashboard_list_item ">
				            <h5>Executors</h5>
				            <div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=executors'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></i></a></span>
								<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
				      	</div>
				      	<div class="dashboard_list_item ">
				            <h5>Divide Estate</h5>
				            <div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=divideEstate'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
								<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
				      	</div>
				      	<div class="dashboard_list_item ">
				            <h5>Gifts</h5>
				            <div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=gifts'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
									<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
				      	</div>
				      	<div class="dashboard_list_item ">
				            <h5>Funeral Wishes</h5>
				            <div class="item-icons">
								<span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=funeralWishes'; ?>"><svg height="100%" viewBox="0 0 12 12" fill="none" class="edit-icon v-icon__component theme--light black--text" style="font-size: 12px; height: 12px; width: 12px;"><path d="M8.54542 5.99803L3.81927 10.7242C3.78787 10.7556 3.75647 10.7713 3.72507 10.787L1.30704 11.0696C1.25993 11.0853 1.22853 11.0853 1.19713 11.0853C1.11862 11.0853 1.05581 11.0539 0.993009 11.0068C0.914501 10.9283 0.8988 10.8027 0.930203 10.6928L1.21283 8.27474C1.22853 8.24334 1.24423 8.21194 1.27564 8.18053L6.00178 3.45439L8.54542 5.99803ZM10.8378 2.4966L9.50321 1.16197C9.15778 0.83224 8.62393 0.83224 8.2942 1.16197L6.84966 2.60651L9.3933 5.15015L10.8378 3.70561C11.1676 3.37588 11.1676 2.84203 10.8378 2.4966Z"></path></svg></a></span>
									<div class="icon-success deact"><svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.0303 7.96967C18.3232 8.26256 18.3232 8.73744 18.0303 9.03033L11.0303 16.0303C10.7374 16.3232 10.2626 16.3232 9.96967 16.0303L5.96967 12.0303C5.67678 11.7374 5.67678 11.2626 5.96967 10.9697C6.26256 10.6768 6.73744 10.6768 7.03033 10.9697L10.5 14.4393L16.9697 7.96967C17.2626 7.67678 17.7374 7.67678 18.0303 7.96967Z" fill="black"/></svg></div>
							</div>
				      	</div>
				    </div>
		     	</div>

				<!-- right panel -->
				<div class="col-md-4 offset-md-1 col-12">
					<div data-toggle="modal" data-target="#finalmsgModal" class="final_message_div"><svg height="100%" viewBox="0 0 42 42" fill="none" class="plusbig-icon v-icon__component theme--light" style="font-size: 41px; height: 41px; width: 41px; color: rgb(196, 202, 214); caret-color: rgb(196, 202, 214);"><path d="M21 0.5V41.5" stroke-width="2"></path><path d="M0.5 21L41.5 21" stroke-width="2"></path></svg>				
					<p class="final-msg_cst"  > Add a final messages</p>
					</div>
				</div>	
			</div>
			<!--End fronend dashboard -->
		<?php 
		}
		?>
	</div><!-- container -->
</div><!-- wrapper -->


<!-- popoup message -->
<div class="modal fade" id="finalmsgModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Final messages</h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         	<div class="final_message_popup" >
				<div class="popup_para">
					<p>When you purchase your will you will be able to upload videos and documents to share with your friends, family or executors.</p>
					<p>Leave up to 10 messages</p>
					<p>Add a video, PDF or photo to each message</p>
					<p>Max file size of 200MB</p>
				</div>
			</div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<?php 
//get_footer();
?>