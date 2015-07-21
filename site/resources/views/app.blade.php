<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADbugo</title>

  <link href="{{ asset('/css/all.css') }}" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
<div id="doc1">
    <div id="hd">
      @include ('layouts.header')
      <article>
        @yield ('content')
      </article>
    </div>
</div>
 
  @include ('layouts.footer')
<!-- Scripts -->
<script src="{{ asset('/js/vendor.js') }}"></script>
<script src="{{ asset('/js/all.js') }}"></script>
<script type="text/javascript">
    $(function(){
        $('#da-thumbs > li').each( function() { $(this).hoverdir();});
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</body>
</html>
