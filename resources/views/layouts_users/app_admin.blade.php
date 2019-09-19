<!DOCTYPE html>
<html>
  <head>
    <!-- DataTables -->
      {{-- <script type="text/javascript" src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script> --}}
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRM Shelter</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {{-- <link rel="icon" href="{{asset('/img/logo_lsp_its.jpg')}}"> --}}
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('admin_lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin_lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('admin_lte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{asset('admin_lte/bower_components/jvectormap/jquery-jvectormap.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin_lte/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{asset('admin_lte/dist/css/skins/_all-skins.min.css')}}">
    {{-- jquery --}}
  
  {{-- data table --}}
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

	
  {{-- manual style css --}}
  
  <link rel="stylesheet" href="{{asset('css/admin.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css')}}">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="{{asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">
@yield('css')
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="{{asset('#')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>RM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CRM</b> Shelter</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      
      <div class="navbar-custom-menu">
      
        <ul class="nav navbar-nav">
          
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">1</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 1 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="{{asset('/admin/reminder')}}">
                      <i class="fa fa-user text-red"></i> kontrak member akan berakhir
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="">View all</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{asset('admin_lte/dist/img/avatar04.png')}}" class="user-image" alt="User Image">
              <span class="hidden-xs"> {{ Auth::user()->nama_depan }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{asset('admin_lte/dist/img/avatar04.png')}}" class="img-circle" alt="User Image">

                <p>
                    Admin<br>
                    {{ Auth::user()->nama_depan }}{{ Auth::user()->nama_belakang }}
                  <small></small>
                </p>
              </li>
              <!-- Menu Body -->
              {{-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li> --}}
              <!-- Menu Footer-->
              <li class="user-footer">
                
                {{-- <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Sign out</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div> --}}
                <div class="pull-right" >
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('admin_lte/dist/img/avatar04.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Admin</p>
          {{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}
        </div>
      </div>
      <!-- search form -->
      {{-- <form action="" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <li class="active treeview menu-open">
          <a href="">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{asset('/admin/home')}}"><i class="fa fa-circle-o"></i> Home</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="">
            <i class="fa fa-plus"></i> <span>Master CRM Shelter</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li class="active"><a href="{{asset('/admin/insert_customer')}}"><i class="fa fa-circle-o"></i> Insert Customer</a></li>
            </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-plus"></i> <span>Insert Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li class="active"><a href="{{asset('/admin/insertkontrak')}}"><i class="fa fa-circle-o"></i>Insert Laporan Kontrak</a></li>
              <li class="active"><a href="{{asset('/admin/insertvisit')}}"><i class="fa fa-circle-o"></i>Insert Laporan Visit</a></li>
              <li class="active"><a href="{{asset('/admin/insertcall')}}"><i class="fa fa-circle-o"></i>Insert Laporan Call</a></li>
              <li class="active"><a href="{{asset('/admin/insertkeluhan')}}"><i class="fa fa-circle-o"></i>Insert Laporan Keluhan</a></li>
            </ul>
        </li>

        {{-- <li class="treeview">
            <a href="">
              <i class="fa fa-database"></i> <span>Wilayah dan Bisnis Unit</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{asset('/admin/bisnis_unit')}}"><i class="fa fa-circle-o"></i> Daftar Bisnis Unit</a></li>
                <li class="active"><a href="{{asset('/admin/area')}}"><i class="fa fa-circle-o"></i> Daftar Area</a></li>
                <li class="active"><a href="{{asset('/admin/wilayah')}}"><i class="fa fa-circle-o"></i> Daftar Wilayah</a></li>
              </ul>
          </li> --}}

        <li class="treeview">
          <a href="">
            <i class="fa fa-database"></i> <span>Daftar Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
            <ul class="treeview-menu">
              <li class="active"><a href="{{asset('/admin/kontrak')}}"><i class="fa fa-circle-o"></i> Laporan Kontrak</a></li>
              <li class="active"><a href="{{asset('/admin/visit')}}"><i class="fa fa-circle-o"></i> Laporan Visit</a></li>
              <li class="active"><a href="{{asset('/admin/call')}}"><i class="fa fa-circle-o"></i> Laporan Call</a></li>
              <li class="active"><a href="{{asset('/admin/keluhan')}}"><i class="fa fa-circle-o"></i> Laporan Keluhan</a></li>
              <li class="active"><a href="{{asset('/admin/mou')}}"><i class="fa fa-circle-o"></i> Laporan Data MOU</a></li>
              <li class="active"><a href="{{asset('/admin/data_customer')}}"><i class="fa fa-circle-o"></i> Laporan Data Customer ALL</a></li>
            </ul>
        </li>

        <li class="treeview">
          <a href="">
            <i class="fa fa-database"></i> <span>Kelola Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            {{-- <li><a href="{{asset('/admin/user')}}"><i class="fa fa-circle-o"></i> User CRM</a></li> --}}
            <li class="active"><a href="{{asset('/admin/customer')}}"><i class="fa fa-circle-o"></i> Customer</a></li>
            <li class="active"><a href="{{asset('/admin/profile')}}"><i class="fa fa-circle-o"></i> Profile Customer</a></li>
          </ul>
        </li>

        
        
        {{-- <li class="treeview">
          <a href="">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href=""><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href=""><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href=""><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href=""><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href=""><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href=""><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li> --}}

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('content_header')
     
    </section>

    <!-- Main content -->
    <section class="content">
    @yield('content')
    </section>
 
   



    {{-- <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer> --}}
  
 
<!-- ./wrapper -->
<!-- jQuery 3 -->

<script src="{{asset('admin_lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('https://code.jquery.com/jquery-3.4.0.min.js')}}"></script>
<script src="{{asset('https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}"></script>


{{-- js ku --}}
<script src="{{asset('admin_lte/dist/js/admin.js')}}"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin_lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('admin_lte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin_lte/dist/js/adminlte.min.js')}}"></script>
<!-- Sparkline -->
{{-- <script src="{{asset('admin_lte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script> --}}
<!-- jvectormap  -->
{{-- <script src="{{asset('admin_lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script> --}}
{{-- <script src="{{asset('admin_lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script> --}}
<!-- SlimScroll -->
{{-- <script src="{{asset('admin_lte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script> --}}
<!-- ChartJS -->
<script src="{{asset('admin_lte/bower_components/chart.js/Chart.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('admin_lte/dist/js/pages/dashboard2.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin_lte/dist/js/demo.js')}}"></script>

@yield('date_pick')
@yield('js')
</body>
</html>
  