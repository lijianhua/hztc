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
});
