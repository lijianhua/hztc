$(function() {
  function isLogin() {
    return $('body').has('.header-top-user-name').length > 0;
  }

  function redirectOrAlert() {
    $.getJSON('/admin-verify', function(data) {
      if (data.status != 'ok') {
        alert('只有认证用户才能发广告，请前往个人中心进行验证');
      } else {
        window.location = 'http://bussiness.momeiw.com:8888';
      }
    });
  };

  $('#_to_dash_button').click(function(evt) {
    if (isLogin()) {
      evt.preventDefault();
      redirectOrAlert();
    }
  });
});
