<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://pap.kalsel.site/assets/foto_profil/sipapan.ico" rel="shortcut icon">

    <title>SIKBA {{ Auth::guard('operator2')->user()->ta }}</title>

    <!-- Bootstrap -->
    <link href="/gentella/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="/gentella/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/gentella/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/gentella/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="/gentella/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/gentella/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="/gentella/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
     <!-- Datatables -->
    <link href="/gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Theme Style -->
    <link href="/gentella/build/css/custom.min.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/wp/img/logoutama.png">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="/opt2/dashboard" class="site_title"><i class="fa fa-laptop"></i><span> SIK-BALATKOP</span></a>
            </div>

            <div class="clearfix"></div>

            <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>DASHBOARD</h3>
              <ul class="nav side-menu">
                <li><a href="/opt2/dashboard"><i class="fa fa-tachometer"></i>DASHBOARD</a></li>
                <br>
                <h3>DATA</h3> <br>
                <li><a href="/opt2/anggaran"><i class="fa fa-database"></i> ANGGARAN</a></li>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->

            <!-- /menu footer buttons -->

            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <nav class="nav navbar-nav">
              <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <img src="/gentella/images/user.png" alt="">Admin
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"  href="javascript:;"> Reset Password</a>
                    <a class="dropdown-item"  href="/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
        @yield('content')
        </div>
      </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy; 2025 BALAI PELATIHAN KOPERASI DAN USAHA KECIL PROV KALIMANTAN SELATAN. PRAKOM<a href="https://colorlib.com"></a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

    <script src="/gentella/vendors/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @stack('myscript')
    <!-- Bootstrap -->
    <script src="/gentella/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/gentella/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/gentella/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/gentella/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/gentella/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/gentella/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/gentella/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/gentella/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/gentella/vendors/Flot/jquery.flot.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/gentella/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/gentella/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/gentella/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/gentella/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/gentella/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/gentella/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/gentella/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/gentella/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/gentella/vendors/moment/min/moment.min.js"></script>
    <script src="/gentella/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

      <!-- Datatables -->
    <script src="/gentella/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/gentella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/gentella/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/gentella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/gentella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/gentella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/gentella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/gentella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="/gentella/vendors/jszip/dist/jszip.min.js"></script>
    <script src="/gentella/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="/gentella/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/gentella/build/js/custom.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  </body>
</html>
