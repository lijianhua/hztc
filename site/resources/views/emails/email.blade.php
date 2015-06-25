<div class="mail">
  <div
class="auth_mail">验证你的登录邮箱就可以使用adbugo的所有功能啦！验证邮件已发送至：<span
class="link">{{$data['email']}}</span></div>
  <a href="https://mail.{{explode('@',$data['email'])[1]}}/     " class="remindbtn" target="_blank">立即验证</a> 
</div>
