<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel='icon' href='favicon.ico' type='image/x-icon' />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Mindanao Development Authority Inventory Management System</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"> -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/minda.css') }}" rel="stylesheet">

    <link href="{{ asset('css/file-upload.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css')}}">
    
    <link href="{{ asset('css/iCheck/all.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">

    <style type="text/css">
      @import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap-glyphicons.css");
    </style>

    <!-- DataTable CSS -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('plugins/datatables/dataTables.bootstrap.css')}}"> -->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    
    <script src="{{ asset('js/lightbox.js') }}" defer></script>

     <style type="text/css"> 
        * { 
          font-family: 'Poppins', Arial, sans-serif;
        }

       body
       {
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

      h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', Arial, sans-serif;
        font-weight: 600;
        margin-top: 0px;
        margin-bottom: 0px;
      }

       .main-sidebar ul li span, .treeview-menu li a {
        font-size: 11px;
        font-weight: 600;
       }


      /* modal */
      .fade {
        transition: opacity .15s linear;
        opacity: 1;
      }

      .modal-dialog {
        margin-top: 150px;
      }

      .modal-header {
        display: block;
        padding: 0px;
        border-bottom: 0px;
        border-top-left-radius: calc(0.3rem - 1px);
        border-top-right-radius: calc(0.3rem - 1px);
        padding: 2rem 2rem;
        text-align: center;
      }

      .modal-content {
        border-radius: 10px;
      }

      .modal-content h4 {
        font-weight: 600;
      }

      .modal-header .close {
        margin: 0px;
        padding: 0px;
      }

      .modal-xl {
        width: 700px;
      }

      .box-new {
        position: relative;
        border-radius: 3px;
        background: #ffffff;
        margin-bottom: 20px;
        width: 100%;
        box-shadow: 0 3px 3px rgba(0,0,0,0.03);
        border-radius: 20px;
      }

      .modal-body .form-group input[type=text], .modal-body .form-group textarea, .modal-body .form-group select {
        border: 0px;
        background-color: #e9f3f5;
        padding-top: 25px;
        padding-bottom: 25px;
        font-size: 13px;
        margin-bottom: 24px;
        color: #000;
        font-weight: 500;
      }

      .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
          color: #fff;
          background-color: #007bff;
      }

      .nav {
        display:flex;
      }
      

      /* .modal-body .form-group input[type=text]:focus {
        color: #000;
        font-weight: 500;
      } */

      /* modal select */

      .select2-container--default .select2-selection--single {
        background-color: #e9f3f5;
        /* border: 1px solid #aaa; */
        /* border-radius: 4px; */
        border: 0px;
      }

      /* select textbox size */
      .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 0px;
        padding-top: 14px;
        padding-bottom: 36px;
        user-select: none;
        -webkit-user-select: none;
      }


      /* select text line height */
      /* .select2-container--default .select2-selection--single .select2-selection__rendered {
          color: #444;
          line-height: 0px;
      } */

      .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px;
      }


      /* select arrow */
      .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 14px;
        right: 4px;
        width: 20px;
      }

      .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 10px;
        right: 4px;
        width: 20px;
      }

      /* end modal select */

      /* Rounded tabs */

    @media (min-width: 576px) {
      .rounded-nav {
        border-radius: 50rem !important;
      }
    }

    @media (min-width: 576px) {
      .rounded-nav .nav-link {
        border-radius: 50rem !important;
      }
    }

    /* With arrow tabs */

    .with-arrow .nav-link.active {
      position: relative;
    }

    .with-arrow .nav-link.active::after {
      content: '';
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
      border-top: 6px solid #2b90d9;
      position: absolute;
      bottom: -6px;
      left: 50%;
      transform: translateX(-50%);
      display: block;
    }

    .btn-blank {
      color: #444;
      border-color: 0px;
    }

    #update-snackbar {
      visibility: hidden;
      min-width: 260px;
      background-color: #51a954;
      color: #fff;
      text-align: center;
      border-radius: 5px;
      padding: 16px;
      position: absolute;
      top: 70px;
      right: 20px;
      z-index: 1;
      font-size: 17px;
      display: flex;
      flex-direction: row;
      justify-content: center;
    }

    #update-snackbar.show-update {
      visibility: visible;
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
      from {top: 0; opacity: 0;} 
      to {top: 70px; opacity: 1;}
    }

    @keyframes fadein {
      from {top: 0; opacity: 0;}
      to {top: 70px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
      from {top: 70px; opacity: 1;} 
      to {top: 0; opacity: 0;}
    }

    @keyframes fadeout {
      from {top: 70px; opacity: 1;}
      to {top: 0; opacity: 0;}
    }

    .btn-info {
      background-color: #3c8dbc;
      border-color: #3c8dbc;
    }
    
     </style>

</head>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    @include('partials.header')
      
    @include('partials.sidebar')

    @yield('content')

    @include('partials.footer')
  </div>
</body>

<!-- file upload script -->
<script src="{{ asset('js/fu-script.js') }}"></script>

<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

<script src="{{ asset('css/iCheck/icheck.min.js') }}"></script>

<!-- DataTable JS -->
<script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<!-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script> -->

<script>
  //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    $(function() {
      $(".select2").select2();
    });
</script>
</html>
