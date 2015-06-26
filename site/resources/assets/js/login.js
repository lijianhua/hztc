$(document).ready(function () {
    $(".login-submit button").click(function () {
        var username = $("#username").val();
        var password = $("#password").val();
        var usercode = $("#usercode").val();
        if(username == "" || username.length < 4){
            $(".login-yes:eq(0)").show();
            return false;
        }else{
            $(".login-yes:eq(0)").hide();
        }
        if(password == "" || password.length < 6){
            $(".login-yes:eq(1)").show();
            return false;
        }else{
            $(".login-yes:eq(1)").hide();
        }
        if(usercode == "" || usercode.length == 0){
            $(".login-yes:eq(2)").show();
            return false;
        }else{
            $(".login-yes:eq(3)").hide();
        }
    })
})
