<?php 
if(isset($_GET['will'])){
    $queryurlval = $_GET['will'];
    if(!empty($queryurlval) && $queryurlval!=''){
        $about_enable = ($queryurlval == 'about') ? 'enabled' : 'disabled';   
        $partner_enable = ($queryurlval == 'partner') ? 'enabled' : 'disabled';   
        $children_enable = ($queryurlval == 'children') ? 'enabled' : 'disabled';   
        $pets_enable = ($queryurlval == 'pets') ? 'enabled' : 'disabled';   
        $executors_enable = ($queryurlval == 'executors') ? 'enabled' : 'disabled';   
        $divideEstate_enable = ($queryurlval == 'divideEstate') ? 'enabled' : 'disabled';   
        $gifts_enable = ($queryurlval == 'gifts') ? 'enabled' : 'disabled';   
        $funeralWishes_enable = ($queryurlval == 'funeralWishes') ? 'enabled' : 'disabled';   
    }
}
?>

<div class="overview-item d-flex align-center " >
    <div class="item-title w-subtitle">About you</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=about'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center ">
    <div class="item-title w-subtitle">Partner</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=partner'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center <?php echo $children_enable; ?>">
    <div class="item-title w-subtitle">Children</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=children'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center <?php echo $pets_enable; ?>">
    <div class="item-title w-subtitle">Pets</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=pets'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center <?php echo $executors_enable; ?>">
    <div class="item-title w-subtitle">Executors</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=executors'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center <?php echo $divideEstate_enable; ?>">
    <div class="item-title w-subtitle">Divide Estate</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=divideEstate'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center <?php echo $gifts_enable; ?>">
    <div class="item-title w-subtitle">Gifts</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=gifts'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div>
<div class="overview-item d-flex align-center <?php echo $funeralWishes_enable; ?>">
    <div class="item-title w-subtitle">Funeral Wishes</div>
    <div class="spacer"></div>
    <div class="item-icons">
        <span class="edit_icon"><a href="<?php echo $gotoEditulr.'?will=funeralWishes'; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></span>
        <div class="icon-success deact"><i class="fa fa-check" aria-hidden="true"></i></div>
    </div>
</div> 

</div>
<!-- close div 'dashbaord_sidebar_section' -->
    <div class="dashbaord_sidebar_lower">
       <p><strong>Need Assistance?</strong></p>
       <div class="light_bg mt-4">             
          <div class="w-subtitle mb-2">000 000</div>
          <div>9am to 5pm AEST, Mon - Fri</div>
          </div>
       <div class="light_bg mt-4">  
          <div class="w-subtitle mb-2">Send us a message</div>
          <div>Start email us, <a href="#" class="font-weight-medium">Click here</a></div>  
       </div>
    </div> 
