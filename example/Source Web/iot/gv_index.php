<?php
  require_once("controller/xacthuc_gv.php");
  require_once("lib/connect.php");
  $user = $_SESSION['username'];
  $sql= "SELECT * FROM user WHERE TAIKHOAN_USER= '$user'";
  $query = mysqli_query($conn,$sql);
  while($kq = mysqli_fetch_array($query)){
	  $ten = $kq['HOTEN_USER'];
	  $hinh = $kq['HINH_USER'];
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Quản lí Giảng viên</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <!-- https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.cs -->
  <link rel="stylesheet" href="dist/css/font-awesome.min.css">
  <!-- Ionicons -->
 <!--  https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
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
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini" style="width: 98%; margin-left: 1%;">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
    
      <span class="logo-lg">Quản lí Giảng viên</span>
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
              <img src="dist/img/<?php echo $hinh; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $ten.' - '.$user; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/<?php echo $hinh; ?>" class="img-circle" alt="User Image">

                <p>
               <?php echo $ten ;?>
				  </p>
              </li>
              <!-- Menu Body -->
           
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?khoatrang=gv_thongtin" class="btn btn-default btn-flat">THÔNG TIN</a>
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
        <div class="pull-left image">
          <img src="dist/img/<?php echo $hinh; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $ten ;?> </p>
       <!--  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
        </div>
      </div>
      <!-- search form -->
     
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">DANH MỤC</li>
        <li class="treeview">
          <a href="?khoatrang=gv_lichday">
            <i class="glyphicon glyphicon-calendar"></i>
            <span>Quản lí lịch dạy</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
        </li>
  
        <!--li class="treeview">
          <a href="?khoatrang=gv_nhomhocphan_danhsach">
            <i class="fa fa-table"></i> 
            <span>Quản lí nhóm học phần</span>
            <i class="fa fa-angle-left pull-right"></i>
			</a>
			</li-->
            
        <li class="treeview">
          <a href="?khoatrang=gv_diemdanh">
            <i class="glyphicon glyphicon-briefcase"></i> 
            <span>Quản lí nhóm học phần</span>
            <i class="fa fa-angle-left pull-right"></i>
			</a>
			</li>
           </ul>
			
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content">
   <div style="width: 80%; margin-left: 20%; margin-bottom: 40%;">
    <?php 
	  if(isset($_GET['khoatrang'])){
		  $khoa = $_GET['khoatrang'];
		  if($khoa=='gv_lichday') include_once('gv_lichday.php');
		  else
			  if($khoa=='gv_nhomhocphan_danhsach') include_once('gv_ds_nhomhocphan.php');
			  else
			  if($khoa=='gv_diemdanh') include_once('gv_diemdanh.php');
			  else
			  if($khoa=='gv_diemdanh_ct') include_once('gv_diemdanh_ct.php');
			  else
			  if($khoa=='gv_thongtin') include_once('gv_thongtin.php');
			  else
			  if($khoa=='gv_doimatkhau') include_once('gv_doimatkhau.php');
			  else
			  if($khoa=='gv_lichday_ct') include_once('gv_lichday_ct.php');
			  else
			  if($khoa=='gv_ds_nhomhocphan_ct') include_once('gv_ds_nhomhocphan_ct.php');
			  else
			  if($khoa=='gv_danhsach') include_once('gv_danhsach.php');
			  else
			  if($khoa=='gv_diemdanh_final') include_once('gv_diemdanh_final.php');
			   else
			  if($khoa=='gv_diemdanh_final_1') include_once('gv_diemdanh_final_1.php');
			   else
			  if($khoa=='gv_sua') include_once('gv_sua.php');
			  else
			  if($khoa=='gv_xoa') include_once('gv_xoa.php');
			   else
			  if($khoa=='gv_them') include_once('gv_them.php');
	  }
	  ?>
	  </div>
    
		</div>
		</div>
	
  <!-- /.content-wrapper -->
  <footer class="main-footer">

    <div style="text-align:left; margin-left: 35%;"><strong>NIÊN LUẬN CÔNG NGHỆ THÔNG TIN 2018</strong></div>
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
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
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
