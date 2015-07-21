@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>错误!</strong> 您的请求存在下面问题：<br><br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

