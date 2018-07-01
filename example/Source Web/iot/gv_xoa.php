<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];

?>
<script language="javascript">
function isEmpty(ten)
{
	if (ten=="")
		return false;
	return true;
}
function ktra(hocky,namhoc, monhoc){
	if(hocky=='default' && namhoc=='default' && monhoc=="" ){
		alert ("Vui lòng nhập tên môn học hoặc chọn học kỳ, năm học!");
		return false;
	}
	return true;
}

</script>
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
            <?php
            if(isset($_GET["id_lh"]))
			{
				$id_tuan=$_GET['id_tuan'];
				$id_nhom_hp=$_GET["id_nhom_hp"];
				$id_lh=$_GET["id_lh"];
				$sql3="DELETE FROM LICH_HOC WHERE ID_LH='$id_lh'";
				//echo $sql3;
				mysqli_query($conn,$sql3);
				$tacdong = mysqli_affected_rows($conn);
				if($tacdong > 0){
          $_SESSION['success']="Xóa lịch học thành công";
					echo "<script>
              window.location='gv_index.php?khoatrang=gv_diemdanh_final&id_nhom_hp=$id_nhom_hp&id_tuan=$id_tuan'; 
              </script>";
					}	
				else { 
					$_SESSION['error']="Xóa lịch học thất bại";
				}
				}
					?>
            <!-- /.box-body -->
            <div class="box-footer" style="text-align: center">
              <button onClick="window.history.go(-1)" type="button" class="btn btn-default">Trở lại</button>
             
            </div>
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
