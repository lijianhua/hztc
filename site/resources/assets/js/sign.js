$(document).ready(function () {
    $(".sign-change .sign-change-item").click(function(){
        $(this).find('i').addClass('fa-dot-circle-o');
        $(this).find('label').addClass('active')
        $(this).siblings().find('label').removeClass('active')
        $(this).siblings().find('i').removeClass('fa-dot-circle-o')
        $(this).siblings().find('i').addClass('fa-circle-o')
    });


    //√‹¬Î«ø∂»≈–∂œ
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
})