@extends('app_login')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">激活账号</div>
				<div class="panel-body">
          <div class="mail">
            <div class="auth_mail">验证你的登录邮箱就可以使用adbugo的所有功能啦！验证邮件已发送至：<span class="link">{{$data['email']}}</span></div>
            <a href="https://mail.{{explode('@',$data['email'])[1]}}/"
class="remindbtn" target="_blank" style = 'color:blue'>立即验证</a> 
          </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
