$(document).ready(function () {

  function randomStr(length) {
      var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890", result = "";

      for (var i = 0; i < 10; i ++){
        result += chars.charAt(Math.floor(Math.random() * chars.length));

      return result;
    };
  };

  $('#captchda').click(function () {
    this.src = '/captcha/default?' + randomStr(10);
  });
  $('#captcha_validate').click(function () {
    captcha = document.getElementById('captchda');
    captcha.src = '/captcha/default?' + randomStr(10);
  });

  $('#username').change(function(){
      var username = $.trim($('#username').val());
      $.ajax({
        type:'GET',
        url:'/user/'+username,
        success:function(data){
          if(data == 0){
            $('.login-error').text('账户名不存在');
            $('.ogin-submit button').attr('type','button');
            return false;
          }else{
            $('.login-error').text('');
          }
        }
      })
  });
  $('.login-submit button').click(function(){
    var username = $.trim($('#username').val());
    var password = $.trim($('#password').val());
    var usercode = $.trim($('#usercode').val());

     if(username.length == 0 || username == ""){
        $('.login-error').text('用户名不能为空!');
        return false;
    }else if(password.length == 0 || password == ""){
      $('.login-error').text('密码不能为空!');
      return false;
    }else if(usercode.length == 0 || usercode == ""){
        $('.login-error').text('请输入验证码!');
        return false;
    }else{
      $.ajax({
        type:'GET',
        url:'/user/'+username,
        success:function(data){
          if(data == 0){
            $('.login-error').text('账户名不存在');
            return false;
          }else{
            $('.login-error').text('');
            $("#login-form").submit();
          }
        }
      })
    }
      
  })
});
