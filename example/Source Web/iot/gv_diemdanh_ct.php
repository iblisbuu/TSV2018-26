<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $date=date("d/m/Y-H:i:s");
  if(isset($_POST["id_nhom_hp"])){
	  $id_nhom_hp=$_POST["id_nhom_hp"];
  }
  if(isset($_GET["id_nhom_hp"])){
	  $id_nhom_hp=$_GET["id_nhom_hp"];
	  echo "$id_nhom_hp";
  }
?>
<script language="javascript">
function isEmpty(ten)
{
	if (ten=="")
		return false;
	return true;
}
function ktra(hocky,namhoc, monhoc){
	if((hocky=='default' && namhoc=='default' && monhoc=="") || 
	(monhoc!="" && namhoc!='default' && hocky=='default' ) || (monhoc!="" && hocky!='default' && namhoc=='default' )){
		alert ("Vui lòng nhập tên môn học hoặc chọn học kỳ, năm học!");
		return false;
	}
	return true;
}
function ktra_check(dd){
	if(dd==""){
		alert ("Vui lòng nhập đúng định dạng!");
		return false;
	}
	if(dd!=0 && dd!=1){
		alert ("Vui lòng nhập đúng định dạng!");
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
            <form class="form-horizontal" method="GET" action="gv_index.php" onSubmit="return ktra_lichday(hocky.value, namhoc.value);">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Chọn tuần</label>

                  <div class="col-sm-10">
                  <input type="hidden" name="khoatrang" value='gv_diemdanh_final'>
                  <input type="hidden" name="id_nhom_hp" value='<?php echo $id_nhom_hp ?>'>
                  <input type="hidden" name="hocky" value='<?php echo $_GET['hocky'] ?>'>
                  <input type="hidden" name="namhoc" value='<?php echo $_GET['namhoc'] ?>'>
                    <select name="id_tuan" style="width: 100%; height: 35px; margin: 2px;">
                    	<option disabled="true" selected="true" value="default" >Chọn tuần</option>
                  <?php 
				  		$sql1= "SELECT DISTINCT ID_TUAN FROM lich_hoc WHERE ID_NHOM_HP='$id_nhom_hp'";
						echo "$sql1";
 			 	  		$query1 = mysqli_query($conn,$sql1);
 			     		 while($kq1 = mysqli_fetch_array($query1)){
	  				 echo " 
                    	<option value='$kq1[ID_TUAN]' >$kq1[ID_TUAN]</option>
                    	
                    	";
 					 } //while 
				  ?>
                  </select>
                  </div>
                </div>
                </div>
                <div class="box-footer" style="text-align: center">
                <button type="submit" class="btn btn-info pull-center" style="text-align: center">Tìm kiếm</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        
      </form>
				<span class="box-title" style="font-size:40px; margin-left: 30%; color: white;">DANH SÁCH ĐIỂM DANH</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                <tr>
                <th>Thứ</th>
                <th>Tiết bắt đầu</th>
                <th>Số tiết</th>
                <th>Phòng học</th>
                <th>Xem danh sách lớp</th>
                <th>Sửa</th>
                <th>Xóa</th>
              </tr>
                </thead>
                <tbody style="text-align:center; background-color:white">
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="box-footer" style="text-align: center">
              <a href="?khoatrang=gv_diemdanh&hocky=<?php echo $_GET['hocky'] ?>&namhoc=<?php echo $_GET['namhoc'] ?>">
                <button type="button" class="btn btn-default">Trở lại</button>
              </a>
              <a href="?khoatrang=gv_them&id_nhom_hp=<?php echo $id_nhom_hp ?>&hocky=<?php echo $_GET['hocky'] ?>&namhoc=<?php echo $_GET['namhoc'] ?>">
                <button type="button" class="btn btn-info">Thêm nhóm</button>
              </a>
            </div>
    
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

