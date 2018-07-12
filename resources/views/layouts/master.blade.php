<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>MEALERT</title>

    <!-- Bootstrap core CSS -->
<link rel="stylesheet" href="/css/bootstrap.min.css" integrity="" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="/css/blog.css" rel="stylesheet">
    <link href="/css/octicons.css" rel="stylesheet">
    <link href="/datatables/datatables.min.css" rel="stylesheet">
    <link href="/css/jquery.dataTables.min.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">
    @include('layouts.nav')
    </div>
    <div class="container">

  <!-- /.blog-top -->

    </div>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-10 blog-main">
        @yield('content')<!-- /.blog-main -->
      </div>
      <?php //dd($show_right) ?>
        @Include('layouts.rightside')<!-- /.blog-sidebar -->
      </div><!-- /.row -->

    </main><!-- /.container -->


@include('layouts.footer')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery-3.3.1.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="/js/popper.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js" integrity="" crossorigin="anonymous"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/holder.min.js"></script>
    <script src="/js/bootstrap-datepicker.min.js"></script>
    <script src="/datatables/datatables.min.js"></script>
    <script src="/js/notify.min.js"></script>
    @yield('js')
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
