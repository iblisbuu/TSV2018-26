<?php
  require_once("controller/xacthuc_ql.php");
  $user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quản lí sinh viên</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="js/quanly.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="hold-transition skin-blue sidebar-mini" style="width: 98%; margin-left: 1%">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
    
      <span class="logo-lg">Quản lí Sinh viên</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            
			  </a>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['hoten']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
              <?php echo $_SESSION['hoten']; ?>
				  </p>
              </li>
              <!-- Menu Body -->
           
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?khoatrang=ql_thongtin" class="btn btn-default btn-flat">THÔNG TIN</a>
                </div>
                <div class="pull-right">
                  <a href="controller/dangxuat.php" class="btn btn-default btn-flat">ĐĂNG XUẤT</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
			</li>
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
        
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">DANH MỤC QUẢN LÍ</li>
        <li class="treeview">
          <a href="?khoatrang=nguoidung_danhsach">
            <i class="fa fa-pie-chart"></i>
            <span>Quản lí người dùng</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="?khoatrang=monhoc_danhsach">
            <i class="fa fa-laptop"></i>
            <span>Quản lí môn học</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="?khoatrang=phonghoc_danhsach">
            <i class="fa fa-edit"></i> <span>Quản lí phòng</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="?khoatrang=nhomhocphan_danhsach">
            <i class="fa fa-table"></i> <span>Quản lí nhóm học phần</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <!--li class="treeview">
          <a href="?khoatrang=khoa_danhsach">
            <i class="fa fa-table"></i> <span>Quản lí khoa</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
        <li class="treeview">
          <a href="?khoatrang=nganh_danhsach">
            <i class="fa fa-table"></i> <span>Quản lí ngành học</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li-->
        <li class="treeview">
          <a href="?khoatrang=hocky_namhoc">
            <i class="fa fa-table"></i> <span>Quản lí học kỳ</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
			</ul>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-header" style="margin-left: 20%; margin-bottom:40%;">
  
    <?php 
  	  if(isset($_GET['khoatrang'])){
  		  $khoa = $_GET['khoatrang'];
  		  if($khoa=='nguoidung_danhsach') include_once('ds_taikhoan.php');
  		  else if($khoa=='themtaikhoan') include_once('ds_taikhoan_them.php');
        else if($khoa=='capnhattaikhoan') include_once('ds_taikhoan_capnhat.php');
  		  else if($khoa=='monhoc_danhsach') include_once('ds_monhoc.php');
  		  else if($khoa=='monhoc_them') include_once('ds_monhoc_them.php');
        else if($khoa=='capnhatmonhoc') include_once('ds_monhoc_capnhat.php');
  		  else if($khoa=='phonghoc_danhsach') include_once('ds_phonghoc.php');
  		  else if($khoa=='phonghoc_them') include_once('ds_phonghoc_them.php');
        else if($khoa=='capnhatphonghoc') include_once('ds_phonghoc_capnhat.php');
  		  else if($khoa=='nhomhocphan_danhsach') include_once('ds_nhomhocphan.php');
  		  else if($khoa=='nhomhocphan_them') include_once('ds_nhomhocphan_them.php');
        else if($khoa=='nhomhocphan_sua') include_once('ds_nhomhocphan_sua.php');
        else if($khoa=='nhomhocphan_xem') include_once('ds_nhomhocphan_xem.php');
        else if($khoa=='khoa_danhsach') include_once('ds_khoa.php');
        else if($khoa=='khoa_them') include_once('ds_khoa_them.php');
        else if($khoa=='capnhatkhoa') include_once('ds_khoa_capnhat.php');
        else if($khoa=='nganh_danhsach') include_once('ds_nganh.php');
        else if($khoa=='nganh_them') include_once('ds_nganh_them.php');
        else if($khoa=='capnhatnganh') include_once('ds_nganh_capnhat.php');
        else if($khoa=='chuongtrinhdaotao_danhsach') include_once('ds_chuongtrinhdaotao.php');
        else if($khoa=='chuongtrinhdaotao_them') include_once('ds_chuongtrinhdaotao_them.php');
        else if($khoa=='lop_danhsach') include_once('ds_lop.php');
        else if($khoa=='lop_them') include_once('ds_lop_them.php');
        else if($khoa=='hocky_namhoc') include_once('ds_hocky_namhoc.php');
        else if($khoa=='capnhat_hocky_namhoc') include_once('ds_hocky_namhoc_capnhat.php');
		else if($khoa=='ql_thongtin') include_once('ql_thongtin.php');
		else if($khoa=='ql_doimatkhau') include_once('ql_doimatkhau.php');
  	  }
	  ?>
	  </div>
    
		
		</div>
	
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    </div>
    <div style=" margin-left: 30%;"><strong>NIÊN LUẬN CÔNG NGHỆ THÔNG TIN 2018</strong></div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
     
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->

<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->

<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
