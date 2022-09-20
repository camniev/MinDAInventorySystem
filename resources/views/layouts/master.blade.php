
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='icon' href='favicon.ico' type='image/x-icon'/ >
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Mindanao Development Authority Inventory Management System</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/minda.css') }}" rel="stylesheet">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
      @import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap-glyphicons.css");
    </style>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="{{ asset('js/lightbox.js') }}" defer></script>

     <style type="text/css">
       
       body
       {
          font-family: 'Calibri';
          font-size: 11px;
          font-weight: normal !important;
       }

       table{
        width: 100% !important;
       }

       td
       {
        font-weight: normal;
        border: solid thin #E6E7E7;
        height: 40px;
       }

     </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('backend.header')
    
  @include('backend.sidebar')

  <main class="py-4">
      @yield('content')
  </main>

@include('backend.footer')
</div>

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

</body>
</html>
