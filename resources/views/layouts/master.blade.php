<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{route('index')}}/css/svg/device-mobile.svg">

    <title>meALERT</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="{{route('index')}}/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="{{route('index')}}/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{route('index')}}/css/blog.css" rel="stylesheet">
    <link href="{{route('index')}}/css/octicons.css" rel="stylesheet">
    <link href="{{route('index')}}/datatables/datatables.min.css" rel="stylesheet">
    <link href="{{route('index')}}/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css" rel="stylesheet">
  </head>

  <body class="d-xl-flex flex-column justify-content-between bg-light">
    <div >
    <div class="container-fluid">
    @include('layouts.nav')
    </div>
    <div class="container">

  <!-- /.blog-top -->

    </div>
    <div class="row container-fluid">
      @if(Route::current()->getName() == 'home' || Route::current()->getName() == 'index')
      <div class="col-xl-10">
        @else
        <div class="col-xl-12">
        @endif
    <main role="main" class="">
      <div class="row">
        <div class="col-xl-12 blog-main">
        @yield('content')<!-- /.blog-main -->
      </div>
      <?php //dd($show_right) ?>

        <!-- /.blog-sidebar -->
      </div><!-- /.row -->

    </main><!-- /.container -->
  </div>
  <div class="col-xl-2">


    @if(Route::current()->getName() == 'home' || Route::current()->getName() == 'index')
      @Include('layouts.rightside')
    @endif


  </div>
  </div>
</div>
</div>
@include('layouts.footer')
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{route('index')}}/js/jquery-3.3.1.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="{{route('index')}}/js/popper.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="{{route('index')}}/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="{{route('index')}}/js/jquery.dataTables.min.js"></script>
    <script src="{{route('index')}}/js/holder.min.js"></script>
    <script src="{{route('index')}}/js/bootstrap-datepicker.min.js"></script>
    <script src="{{route('index')}}/datatables/datatables.min.js"></script>
    <script src="{{route('index')}}/js/notify.min.js"></script>
    @yield('js')
    @yield('right_sidejs')
    <script>
    $(document).ready( function () {
      if("{{session('success')}}"){
        $.notify("{{session('success')}}","success");
      }
      if("{{session('error')}}"){
        $.notify("{{session('error')}}","error");
      }
      if("{{session('info')}}"){
        $.notify("{{session('info')}}","info");
      }
        $('#datatable').DataTable();
    } );
    </script>

  </body>
</html>
