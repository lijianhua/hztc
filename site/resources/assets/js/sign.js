$(document).ready(function () {
    $(".sign-change .sign-change-item").click(function(){
        $(this).find('i').addClass('fa-dot-circle-o');
        $(this).find('label').addClass('active')
        $(this).siblings().find('label').removeClass('active')
        $(this).siblings().find('i').removeClass('fa-dot-circle-o')
        $(this).siblings().find('i').addClass('fa-circle-o')
    });


    //密码强度判断
    $("#password").blur(function () {
        var this_password = $(this).val();
        if(this_password.length < 6){
            $(this).parents('td').find(".sign-warning").show();
            $(".sign-strength .sign-strength-item").removeClass('color');
        }else if(this_password.length>=6 && this_password.length <8){
            $(".sign-strength .sign-strength-item:eq(0)").addClass('color')
            $(".sign-strength .sign-strength-item:eq(0)").prevAll().addClass('color')
            $(".sign-strength .sign-strength-item:eq(0)").nextAll().removeClass('color');
            $(this).parents('td').find(".sign-warning").hide();
        }else if(this_password.length >=8 && this_password.length <10){
            $(".sign-strength .sign-strength-item:eq(1)").addClass('color');
            $(".sign-strength .sign-strength-item:eq(1)").prevAll().addClass('color');
            $(".sign-strength .sign-strength-item:eq(1)").nextAll().removeClass('color');
            $(this).parents('td').find(".sign-warning").hide();
        }else if(this_password.length >=10){
            $(".sign-strength .sign-strength-item:eq(2)").addClass('color');
            $(".sign-strength .sign-strength-item:eq(2)").prevAll().addClass('color');
            $(".sign-strength .sign-strength-item:eq(2)").nextAll().removeClass('color');
            $(this).parents('td').find(".sign-warning").hide();
        }
    });


    $(".sign-submit").click(function () {
        var username = $.trim($('#username').val());
        var email = $.trim($('#email').val());
        var password = $.trim($('#password').val());
        var re_password = $.trim($('#re_password').val());
        var reg = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;

        var usertext = /^[\u4e00-\u9fa5a-zA-Z1-9_]+$/gi;

        if (username.length >= 6 && usertext.test(username)) {
            $('#username').parents('td').find('.sign-warning').css('display','none');
        } else {
            $('#username').parents('td').find('.sign-warning').css('display','inline-block');
            return false
        }

        if (username.length != 0 && reg.test(email)){
            $('#email').parents('td').find('.sign-warning').css('display','none');
        } else {
            $('#email').parents('td').find('.sign-warning').css('display','inline-block');
            return false
        }

        if (password.length >= 6){
            $('#password').parents('td').find('.sign-warning').css('display','none');
        } else {
            $('#password').parents('td').find('.sign-warning').css('display','inline-block');
            return false
        }

        if (re_password == password){
            $('#re_password').parents('td').find('.sign-warning').css('display','none');
        } else {
            $('#re_password').parents('td').find('.sign-warning').css('display','inline-block');
            return false
        }

        if($(".sign-checkbox").is(':checked') == true){
            $('.sign-checkbox').parents('td').find('.checkbox-sign-warning').css('display','none');
        }else{
            $('.sign-checkbox').parents('td').find('.checkbox-sign-warning').css('display','inline-block');
            return false
        }
    });

    $("#clause-view").click(function () {
        $(".clause-bg").show();
    });
    $(".clause-close i").click(function(){
        $(".clause-bg").hide();
    })
    $("#agree").click(function(){
        $(".clause-bg").hide();
    })
})
