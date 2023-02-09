$(document).ready(function() {
    $('#goto_start_form').click(function(e) {
        e.preventDefault();
        setTimeout(function() {
            $('.main_start_page').hide();
            $('.welcome_willed_pst').show();
            $('.main_form').hide();
        }, 200);
    });

    $('.Get_Started').click(function(e) {
        e.preventDefault();
        setTimeout(function() {
            $('.welcome_willed_pst').hide();
            $('.main_start_page').hide();
            $('.main_form').show();
            //$('.fieldset_with_no_australia').css('display','block'); 
        }, 200);
    });

    /*
    $('body').find(".next_btn").click(function() {
        alert();
        $(this).parent().next().fadeIn('slow');
        $(this).parent().css({'display': 'none'});
        next_fs = $(this).parent().next();
        $('.active').next().addClass('active');
        $("#progressbar li").eq($(".fieldset").index(next_fs)).addClass("active");
    });

    $(".pre_btn").click(function() { 
        $(this).parent().prev().fadeIn('slow');
        $(this).parent().css({ 'display': 'none' });
        current_fs = $(this).parent();
        $('.active:last').removeClass('active');
        $("#progressbar li").eq($(".fieldset").index(current_fs)).removeClass("active");
    });*/


    $('body').find('.fs_no_btn_live').click(function(){
        $('.fieldset_with_no_australia').css({'display': 'none'});        
        $('.sorry_div_live').show();
    });
    $('body').find('.fs_no_btn_age').click(function(){
        $('.fieldset_with_no_18age').css({'display': 'none'});        
        $('.sorry_div_18age').show();
    });
    $('body').find('.sorry_div_live .back_btn').click(function(){
        $('.fieldset_with_no_australia').show();
        $(this).parent().css({
        'display': 'none'
        });   
    });
    $('body').find('.sorry_div_18age .back_btn').click(function(){
        $('.fieldset_with_no_18age').show();
        $(this).parent().css({
        'display': 'none'
        });   
    });

    $('body').find('.first_fieldset_bk_btn').click(function(){
        //location.reload(true);
        $('.welcome_willed_pst').show();
        $('.main_form').hide();
        $('.fieldset_with_no_australia').show();
        $('.regform').reload();
    });

    $('body').find('.wf_have_any_pets').click(function(){
        $('.main_form').hide();
        $('.before_account_sigup').show();
    });

    $('body').find('.goto_create_account').click(function(){
        $('.main_form').hide();
        $('.before_account_sigup').hide();
        $('.on_account_sigup').show();
    });

    //Next prev fieldset
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next_btn").click(function(){
        current_fs = $(this).parent();
        next_fs = $(this).parent().next();
        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
        //show the next fieldset
        current_fs.css({'display':'none'});
        next_fs.show(); 
    });

    $(".pre_btn").click(function(){
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
        current_fs.hide();
        previous_fs.show(); 
    });



        
});