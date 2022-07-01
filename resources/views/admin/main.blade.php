<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin {{ isset($title) ? ' | '.$title : '' }}</title>
  @include('admin.inc.ext-css')
  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('admin.inc.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin.inc.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @include('admin.inc.footer')

</div>
<!-- ./wrapper -->

@include('admin.inc.ext-js')
@stack('js')
</body>
</html>
