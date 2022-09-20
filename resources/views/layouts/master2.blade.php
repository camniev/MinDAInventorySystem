
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MinDA Inventory Management System</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">

  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">

  <link rel="stylesheet" href="dist/css/adminlte.min.css">

  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


   <style>
        body {
          font-family: Calibri;
          background-image: url('{{ url('/images/1920x1080-gray-solid-color-background.png') }}');
          background-repeat: repeat;
          font-size: 14px !important;
          height: 100%;
        }

        .banner_bg {
          background-image: url('{{ url('/images/banner_1280x60hw_minda_combi_color.png') }}');
          background-repeat: no-repeat;
          height: 100%;
          width: 100%;
        }

        .navbtn {
          background-color: #E6E6E6;
          border: none;
          color: #084B8A;
          padding: 16px 32px;
          text-align: center;
          font-size: 16px;
          margin: 1px 2px;
          transition: 0.4s;
          width: 100%;
        }

        .navbtn:hover {
          background-color: #2176bd;
          color: white;
        }

        .btn {
          font-size: 12px;
        }

        th {
          background: #F2F2F2;
        }

        tr:nth-child(odd) td {
           {{--background: #F2F2F2;--}}
           background: #FFF;
        }

        tr:nth-child(even) td {
           background: #FFF;
        }

        table, tr,td {
          border: none;
          border-bottom: solid thin #A9D0F5;
        }

        input[type="text"],input[type="date"],textarea
        {

          font-size: 14px;
        }

        [type="checkbox"]
        {
            vertical-align:middle;
        }

        textarea
        {
          font-family: inherit;
        }

        select
        {
          font-size: 14px;
        }

        option
        {
          font-size: 14px;
        }

        .content 
        {
          display:none;
        }
        .preload
        {
          width:100px;
          height: 100px;
          position: fixed;
          top: 40%;
          left: 40%;
        }
    </style> 
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('backend.header')
    
  @include('backend.sidebar')


  <div class="content-wrapper">
    <section class="content-header">
      <ol class="breadcrumb">

    </section>
    <section class="content">

      <div class="row">
        <div class="col-md-8">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Visitors Report</h3>

             
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <main class="py-4">
      @yield('content')
  </main>

@include('backend.footer')
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
