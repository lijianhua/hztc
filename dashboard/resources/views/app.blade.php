<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>控制台 - 魔媒网</title>

  <link href="{{ asset('/css/all.css') }}" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <script>
  var CKEDITOR_BASEPATH = '/editor/';
  </script>
</head>
<body class="skin-blue fixed sidebar-mini">

  <div class="wrapper">
    @include ('layouts.header')
    @include ('layouts.sidebar')
    @include ('layouts.content')
    @include ('layouts.footer')
  </div>

  <!-- Scripts -->
  <script src="{{ asset('/js/vendor.js') }}"></script>
  <script src="{{ asset('/js/all.js') }}"></script>
</body>
</html>
