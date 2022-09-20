
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>MinDA Inventory Management System</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/minda.css') }}" rel="stylesheet">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family='Calibri':300,400,600,700,300italic,400italic,600italic">


    <style type="text/css">
      @import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap-glyphicons.css");
    </style>

    

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


  <main class="py-4">
      @yield('content')
  </main>

</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
