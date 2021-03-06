 var tel_interval;
 var tel_phone_code = $("#sign-info-code").val();
 var tel_number = $("#sign-info-phone").val();
 var tel_seconds = 60;
$(document).ready(function () {
    $(".sign-change .sign-change-item").click(function () {
        $(this).find('i').addClass('fa-dot-circle-o');
        $(this).find('label').addClass('active')
        $(this).siblings().find('label').removeClass('active')
        $(this).siblings().find('i').removeClass('fa-dot-circle-o')
        $(this).siblings().find('i').addClass('fa-circle-o')
    });


    //密码强度判断
    $("#password").blur(function () {
        var this_password = $(this).val();
        if (this_password.length < 6) {
            $(this).parents('td').find(".sign-warning").css('display', 'inline-block');
            $(".sign-strength .sign-strength-item").removeClass('color');
        } else if (this_password.length >= 6 && this_password.length < 8) {
            $(".sign-strength .sign-strength-item:eq(0)").addClass('color')
            $(".sign-strength .sign-strength-item:eq(0)").prevAll().addClass('color')
            $(".sign-strength .sign-strength-item:eq(0)").nextAll().removeClass('color');
            $(this).parents('td').find(".sign-warning").hide();
        } else if (this_password.length >= 8 && this_password.length < 10) {
            $(".sign-strength .sign-strength-item:eq(1)").addClass('color');
            $(".sign-strength .sign-strength-item:eq(1)").prevAll().addClass('color');
            $(".sign-strength .sign-strength-item:eq(1)").nextAll().removeClass('color');
            $(this).parents('td').find(".sign-warning").hide();
        } else if (this_password.length >= 10) {
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
        var phone = $.trim($('#phone').val());
        var phone_code = $.trim($('#phone_code').val());
        tel_phone_code = $("#sign-info-code").val();
        tel_number = $("#sign-info-phone").val();


        var re_password = $.trim($('#re_password').val());
        var reg = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/;
        var reg_phone = /^0?1[3|4|5|8][0-9]\d{8}$/;

        var usertext = /^[\u4e00-\u9fa5a-zA-Z1-9_]+$/gi;

        if (!usertext.test(username)) {
          $('#username').parents('td').find('.sign-warning').text('用户名不能有特殊字符');
           $('#username').parents('td').find('.sign-warning').css('display','inline-block');
            return false;
        }else if(username.length < 6){
          $('#username').parents('td').find('.sign-warning').text('用户名长度不能小于6');
          $('#username').parents('td').find('.sign-warning').css('display','inline-block');
          return false;
        }else {
            $('#username').parents('td').find('.sign-warning').css('display','none');
        }

        if (email.length != 0 && reg.test(email)){
            $('#email').parents('td').find('.sign-warning').css('display','none');
        } else {
            $('#email').parents('td').find('.sign-warning').css('display','inline-block');
            return false
        }
        //if (reg_phone.test(phone) && phone.length == 11) {
        //    $('#phone').parents('td').find('.sign-warning').css('display','none');
        //}else{
        //    $('#phone').parents('td').find('.sign-warning').css('display','inline-block');
        //    return false;
        //}

        //if (phone_code == tel_phone_code && phone == tel_number) {
        //    $('#phone_code').parents('td').find('.sign-warning').css('display','none');
        //}else{
        //    $('#phone_code').parents('td').find('.sign-warning').css('display','inline-block');
        //    return false;
        //}

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
    });
    $("#agree").click(function(){
        $(".clause-bg").hide();
    });
    
    $(".tel_bt").click(function(){
        
        var login_code = $.trim($(".login-code").val());
        
        $.ajax({
            type:'get',
            url:'/getcaptcha',
            data:{captcha:login_code},
            success:function(data){
                if(data == 1){
                    tel_seconds = 60;
                    tel_code();
                    $(".login-code").parents('td').find('.sign-warning').css('display','none');
                }else{
                    $(".login-code").parents('td').find('.sign-warning').css('display','inline-block');
                    return false;
                }
            }
        });
        
        

        // $.ajax({
        //     url:'/SMS',
        //     type:'post',
        //     data:{phone:tel},
        //     success:function(data){
        //         // alert(data);
        //     }
        // })

      // login_code();
      // tel_seconds = 60;
      // $(this).attr('disabled',true);
      //  tel_interval = window.setInterval(set_time,1000);
    });

});

function tel_code(){
    var reg_phone = /^0?1[3|4|5|8][0-9]\d{8}$/;
    var tel = $.trim($('#phone').val());
    if (reg_phone.test(tel) && tel.length == 11) {
        $.ajax({
            url:'/SMS',
            type:'post',
            data:{phone:tel},
            success:function(data){
                tel_phone_code = $("#sign-info-code").val(data['message']);
                tel_number = $("#sign-info-phone").val(data['phone']);
                $("#sign-info-code").val(data['message']);
                $("#sign-info-phone").val(data['phone']);
            }
        });
        tel_interval = window.setInterval(set_time,1000);
        $('#phone').parents('td').find('.sign-warning').css('display','none');
    }else{
        $('#phone').parents('td').find('.sign-warning').css('display','inline-block');
        return false;
    }
}

function set_time(){
  if(tel_seconds <= 0){
    $(".tel_bt").val("再次获取验证码");
    $('.tel_bt').removeAttr('disabled');
    window.clearInterval(tel_interval);
  }else{
    $('.tel_bt').attr('disabled',true);
    tel_seconds -= 1;
    $(".tel_bt").val(tel_seconds+"秒后再次获取");
    
  }
}


function login_code(){
    var login_code = $.trim($(".login-code").val());
    // var _token = $("input[name=_token]").val();
    $.ajax({
        type:'get',
        url:'/getcaptcha',
        data:{captcha:login_code},
        success:function(data){
            if(data == 1){
                $(".login-code").parents('td').find('.sign-warning').css('display','none');
                $(this).attr('disabled',false);
            }else{
                $(".login-code").parents('td').find('.sign-warning').css('display','inline-block');
                return false;
            }
        }
    })
}




