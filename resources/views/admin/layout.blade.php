<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>roofer.com.ua</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/bower/AdminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/bower/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. -->
  <link rel="stylesheet" href="/bower/AdminLTE/dist/css/skins/skin-blue.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="/bower/AdminLTE/plugins/iCheck/all.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <a href="/" class="logo">
      <span class="logo-mini"><b>R</b></span>
      <span class="logo-lg"><b>roofers</b>.com.ua</span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/bower/AdminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="/bower/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                <p>
                  {{Auth::user()->name}}
                  <small>Зарегистрирован {{Auth::user()->created_at->format('d.m.Y')}}</small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Выход</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu">
        <li class="header">МЕНЮ</li>
        <li class="treeview {{ Request::is('admin/company*')?'active':'' }}">
          <a href="#"><i class="fa fa-bank"></i> <span>Компании</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.company.index')}}"><i class="fa fa-list"></i>Список компаний</a></li>
            <li><a href="{{route('admin.company.create')}}"><i class="fa fa-plus"></i>Добавить компанию</a></li>
          </ul>
        </li>
        <li class="treeview {{ Request::is('admin/news*')?'active':'' }}">
          <a href="#"><i class="fa fa-newspaper-o"></i> <span>Новости</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.news.index')}}"><i class="fa fa-list"></i>Список новостей</a></li>
            <li><a href="{{route('admin.news.create')}}"><i class="fa fa-plus"></i>Добавить новость</a></li>
          </ul>
        </li>
        <li class="treeview {{ Request::is('admin/sales*')?'active':'' }}">
          <a href="#"><i class="fa fa-percent"></i> <span>Акции и скидки</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.sales.index')}}"><i class="fa fa-list"></i>Список акций</a></li>
            <li><a href="{{route('admin.sales.create')}}"><i class="fa fa-plus"></i>Добавить акцию</a></li>
          </ul>
        </li>
        <li class="treeview ">
          <a href="#"><i class="fa fa-user"></i> <span>Пользователи</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="{{route('admin.company.index')}}"><i class="fa fa-list"></i>Список пользователей</a></li>
            <li><a href="{{route('admin.company.create')}}"><i class="fa fa-plus"></i>Добавить пользователя</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2015 <a href="#">roofers.com.ua</a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.0 -->
<script src="/bower/AdminLTE/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/bower/AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/bower/AdminLTE/dist/js/app.min.js"></script>

<script src="/bower/AdminLTE/plugins/fastclick/fastclick.min.js"></script>

<script src="/bower/AdminLTE/plugins/ckeditor/ckeditor.js"></script>

<!-- iCheck 1.0.1 -->
<script src="/bower/AdminLTE/plugins/iCheck/icheck.min.js"></script>

<script>
    $(function() {
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
      });

      $('[data-remove]').click(function(){
        $(this).parents($(this).attr('data-remove')).remove();
      })

    });
</script>

</body>
</html>
