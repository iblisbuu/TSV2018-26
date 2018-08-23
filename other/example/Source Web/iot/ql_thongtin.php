<?php
  //require_once("controller/xacthuc_gv.php");
  require_once("lib/connect.php");
  $user = $_SESSION['username'];
  echo $user;
  $sql= "SELECT * FROM quan_ly, user
  				  WHERE
  						user.TAIKHOAN_USER= '$user' AND
						user.TAIKHOAN_USER=quan_ly.TAIKHOAN_USER AND
						user.ID_QUYEN='1'
						";
  $query = mysqli_query($conn,$sql);
  while($kq = mysqli_fetch_array($query)){
	  $ma_gv    = $kq['TAIKHOAN_USER'];
	  $gioi_tinh= $kq['GIOI_TINH'];
	  $ngay_sinh= $kq['NGAY_SINH'];
	  $dia_chi  = $kq['DIA_CHI'];
	  $ma_the   = $kq['MATHE_USER'];
	  $ten      = $kq['HOTEN_USER'];
	  $hinh     = $kq['HINH_USER'];
	  $mail     = $kq['EMAIL'];
	  $sdt      = $kq['SO_DT'];
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div>

  
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title" style="font-size: 40px;">THÔNG TIN QUẢN LÝ</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
             <div style="position: absolute; width: 250px; height: 300px; left: 2%; border-radius: 15px;">
             <img  width="290px" height="300px" src="dist/img/<?php echo $hinh; ?>">
             </div>
              <div class="box-body" style="padding-left: 30%;">
              <div class="form-group">
                  <label for="txtmathe" class="col-sm-2 control-label">Mã thẻ</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $ma_the; ?></div>
                  </div>
                </div>
               
                <div class="form-group">
                  <label for="txttaikhoan" class="col-sm-2 control-label">Tên đăng nhập</label>

                  <div class="col-sm-10">
					  <div class="form-control" style="border: none; font-size: 20px;"><?php echo $ma_gv; ?></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="txthoten" class="col-sm-2 control-label">Họ tên</label>

                 
                   <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $ten ?></div>
                  </div>
                  
                </div>
                 <div class="form-group">
                  <label for="txtngaysinh" class="col-sm-2 control-label">Ngày sinh</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $ngay_sinh; ?></div>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="txtdiachi" class="col-sm-2 control-label">Địa chỉ</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $dia_chi; ?></div>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label for="txtgioitinh" class="col-sm-2 control-label">Giới tính</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $gioi_tinh; ?></div>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label for="txtbomon" class="col-sm-2 control-label">Email</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $mail; ?></div>
                  </div>
                </div>
                
                 <div class="form-group">
                  <label for="txtbomon" class="col-sm-2 control-label">Số điện thoại</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo $sdt; ?></div>
                  </div>
                </div>
				
              <!-- /.box-body -->
              <div class="box-footer" style="text-align: left; margin-left: 7%;">
               <a href="ql_index.php"> <button type="button" class="btn btn-default">Trở lại</button></a>
               <a href="?khoatrang=ql_doimatkhau"> <button type="button" class="btn btn-default">Đổi mật khẩu</button></a>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

    
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->
 
</body>
</html>
