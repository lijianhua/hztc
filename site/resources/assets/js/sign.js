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
    $('#username').blur(function(){
      var text = $(this).val();
      if(text.length != 0)
      {
        var re = /^[\u4e00-\u9fa5a-zA-Z1-9_]+$/gi; 
        if(re.test(text))
          {
             if(text.length < 6) 
                {
                    $(this).parents('td').find(".sign-warning").html('用户名不能少于六位').show();
                }
          }
        else
        {
         $(this).parents('td').find(".sign-warning").html('用户名不能含有特殊字符').show();
        }
      }
      else
      {
         $(this).parents('td').find(".sign-warning").html('用户名不能为空').show();
      }
    });
})
