<?php
  require_once("controller/xacthuc_ql.php");
  require_once("lib/connect.php");
  $user = $_SESSION['username'];
  
?>
<script language="javascript">
function isEmpty(ten)
{
	if (ten=="")
		return false;
	return true;
}
function ktra(matkhaucu, matkhaumoi, xacnhan){
	if(matkhaucu=="" || matkhaumoi=="" || xacnhan=="" ){
		alert ("Vui lòng nhập đầy đủ các trường!");
		return false;
	}
	if(matkhaumoi.length<8){
		alert ("Mật khẩu mới phải nhiều hơn 8 ký tự!");
		return false;
		}
	if(matkhaumoi!=xacnhan){
		alert ("Xác nhận mật khẩu mới không hợp lệ!");
		return false;
		}
	return true;
}

</script>
<?php
if(isset($_POST['act'])){
	$matkhaucu=$_POST['matkhaucu'];
	$mahoa_old=md5($matkhaucu);
	$matkhaumoi=$_POST['matkhaumoi'];
	$mahoa_new=md5($matkhaumoi);
	$xacnhan=$_POST['xacnhan'];
$sql = "SELECT * FROM user WHERE user.TAIKHOAN_USER='$user'";
$query = mysqli_query($conn,$sql);
$kq = mysqli_fetch_array($query);
//echo "$mahoa_old";
//echo $kq['PASSWORD_USER'];
if ($mahoa_old!=$kq['PASSWORD_USER']){
	echo "<script> alert ('Mật khẩu cũ không đúng') </script>";
}
else{
$sql1="UPDATE user, quan_ly SET user.PASSWORD_USER = '$mahoa_new', quan_ly.PASSWORD_USER = '$mahoa_new'
                                WHERE user.TAIKHOAN_USER='$user' AND quan_ly.TAIKHOAN_USER='$user'";
//echo $sql1;
$query1= mysqli_query($conn,$sql1);
if(mysqli_affected_rows($conn)>0){
	echo "<script> alert ('Đổi mật khẩu thành công!'); window.location='ql_index.php?khoatrang=ql_thongtin'; </script>";
}
else{
	echo "<script> alert ('Đổi mật khẩu thất bại!') </script>";
	}

}

	} //isset

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

  <header>
   
    <!-- Main content -->
    <section >
      <div style="padding-top: 50px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="text-align: center">            
            <!-- form start -->
            <form class="form-horizontal" method="post" action="#" onSubmit="return ktra(matkhaucu.value , matkhaumoi.value, xacnhan.value);">
              <div class="box-body">
                <div class="form-group">
                  <label for="txttenmon" class="col-sm-2 control-label">Mật khẩu cũ</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="matkhaucu" placeholder="Mật khẩu cũ">
                  </div>
                  </div>
                  <div class="form-group">
                  <label for="txttenmon" class="col-sm-2 control-label">Mật khẩu mới</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="matkhaumoi" placeholder="Mật khẩu mới">
                  </div>
                  </div>
                   <div class="form-group">
                  <label for="txttenmon" class="col-sm-2 control-label">Xác nhận khẩu mới</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="xacnhan" placeholder="Xác nhận mật khẩu mới">
                  </div>
                </div>
         
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="text-align: center">
                <input type="hidden" name="act">
                <a href="" class="btn btn-info pull-center">Hủy</a>
                <button type="submit" class="btn btn-info pull-center" style="text-align: center">Lưu thay đổi</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        
      </form>
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
