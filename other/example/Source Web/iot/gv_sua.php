<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  if(isset($_POST["id_nhom_hp"])){
	  $id_nhom_hp=$_POST["id_nhom_hp"];
  }
  if(isset($_GET["id_nhom_hp"])){
	  $id_nhom_hp=$_GET["id_nhom_hp"];
	 // echo "$id_nhom_hp";
  }
   if(isset($_POST["id_lh"])){
	  $id_nhom_hp=$_POST["id_lh"];
  }
  if(isset($_GET["id_lh"])){
	  $id_lh=$_GET["id_lh"];
	//  echo "$id_lh";
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
            if(isset($_POST["capnhat"]))
			{
				$id_phong=$_POST['id_phong'];
				$id_tiet=$_POST['id_tiet'];
				$id_tuan=$_GET['id_tuan'];
				 $id_nhom_hp=$_POST["id_nhom_hp"];
				$thu=$_POST['thu'];
				$sql3="UPDATE LICH_HOC SET ID_PHONG='$id_phong', ID_TIET='$id_tiet', THU = '$thu', ID_TUAN='$id_tuan' WHERE ID_LH='$id_lh'";
				if(mysqli_query($conn,$sql3)){
          $_SESSION['success']="Cập nhật thành công";
					}	
				else { 
					$_SESSION['error']="Cập nhật thất bại";
				}
				}
					?>
                    
            <span class="box-title" style="font-size:40px; margin-left: 10%; color: black;">CẬP NHẬT HỌC PHẦN GIẢNG DẠY</span>
            </div>
            <div class="box-body" style="text-align: center">
            <?php
			if(isset($_GET["id_tuan"]) AND isset($_GET["id_nhom_hp"]) AND isset($_GET["id_lh"]) )
									{
										$id_nhom_hp= $_GET["id_nhom_hp"];
										$id_tuan= $_GET["id_tuan"];
										$id_lh =$_GET["id_lh"];
			$sql= "SELECT DISTINCT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, lich_hoc.NGAY_HOC, tiet_hoc.GIO_BD, phong.ID_PHONG, lich_hoc.THU, tiet_hoc.ID_TIET
											FROM lich_hoc, nhom_hp, danh_sach_diem_danh, phong, mon_hoc, tiet_hoc
											WHERE 
                                                  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND
                                                  phong.ID_PHONG=lich_hoc.ID_PHONG AND
                                                  mon_hoc.MA_MH=nhom_hp.MA_MH AND
                                                  lich_hoc.ID_NHOM_HP=$id_nhom_hp AND
												  lich_hoc.ID_TUAN=$id_tuan AND
												  lich_hoc.ID_LH=$id_lh
								 
								";
								//echo $sql;
 			$query = mysqli_query($conn,$sql);
			$kq = mysqli_fetch_array($query);
			//echo "$kq[ID_PHONG]";
			}
			?>
            <div id="alert" align="center" style="width: 60%; margin-left: 20%;">
              <?php
                if(isset($_SESSION['error'])){
                  echo "<div class=\"alert alert-danger\">".$_SESSION['error']."</div>";
                  unset($_SESSION['error']);
                }
                else if(isset($_SESSION['success'])){
                  echo "<div class=\"alert alert-success\">".$_SESSION['success']."</div>";
                  unset($_SESSION['success']);
                }
              ?>
            </div>
            <form class="form-horizontal" method="post" action="#" name="form_them_nhomhp">
              <div class="box-body">
                <div class="form-group">
                  <label for="manhom" class="col-sm-2 control-label">Mã nhóm</label>

                  <div class="col-sm-10">
                  	<input type="hidden" name="id_lh" value="<?php echo "$id_lh"; ?>" style="width:30px"/>
                    <input type="hidden" name="id_nhom_hp" value="<?php echo "$id_nhom_hp"; ?>" style="width:30px"/>
                    <input type="hidden" name="capnhat" value="capnhat" style="width:30px"/>
                    <input type="text" class="form-control" name="manhom" value="<?php echo "$kq[MA_NHOM_HP]"; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="mamon" class="col-sm-2 control-label">Mã môn học</label>

                  <div class="col-sm-10">
                    <input type="search" class="form-control" name="mamon" value="<?php echo "$kq[MA_MH]"; ?>" readonly>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="phonghoc" class="col-sm-2 control-label">Phòng học </label>
					
                  <div class="col-sm-10">
                    <select class="form-control" name="id_phong">
                        <?php
                          require_once("lib/connect.php");
                          $sql1= "SELECT ID_PHONG, TEN_PHONG, DIA_DIEM_PHONG FROM PHONG";
						  $sql4 ="SELECT TEN_PHONG, DIA_DIEM_PHONG FROM PHONG WHERE ID_PHONG=$kq[ID_PHONG]";
						  //echo "$sql4";
                          $query = mysqli_query($conn,$sql1);
						  $query4 = mysqli_query($conn,$sql4);
						  $row4 = mysqli_fetch_array($query4);
						  echo $kq['ID_PHONG'];
						 // echo "<option value=\"$kq[ID_PHONG]\" selected></option>";
                          echo "<option value=\"$kq[ID_PHONG]\" selected>".$row4['TEN_PHONG']." - ".$row4['DIA_DIEM_PHONG']."</option>";
                          while($row = mysqli_fetch_array($query)){
                            echo "<option value=\"".$row['ID_PHONG']."\">".$row['TEN_PHONG']." - ".$row['DIA_DIEM_PHONG']."</option>";
                          }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="giobd" class="col-sm-2 control-label">Giờ bắt đầu</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="id_tiet">
                        <?php
                          require_once("lib/connect.php");
                          $sql1= "SELECT ID_TIET, GIO_BD, GIO_KT FROM TIET_HOC";
						  $sql5 ="SELECT GIO_BD FROM TIET_HOC WHERE ID_TIET=$kq[ID_TIET]";
						  $query5 = mysqli_query($conn,$sql5);
						  $row5 = mysqli_fetch_array($query5);
                          $query = mysqli_query($conn,$sql1);
                          echo "<option value=\"$kq[ID_TIET]\" selected>$row5[GIO_BD]</option>";
                          while($row = mysqli_fetch_array($query)){
                            echo "<option value=\"".$row['ID_TIET']."\">".$row['GIO_BD']."</option>";
                          }
                        ?>
                        
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="thu" class="col-sm-2 control-label">Thứ</label>

                    <div class="col-sm-10">
                        <select class="form-control" name="thu">
                        <option value="<?php echo "$kq[THU]" ?>" selected><?php echo "Thứ $kq[THU]" ?></option>
                        <option value="2">Thứ 2</option>
                        <option value="3">Thứ 3</option>
                        <option value="4">Thứ 4</option>
                        <option value="5">Thứ 5</option>
                        <option value="6">Thứ 6</option>
                        <option value="7">Thứ 7</option>
                        <option value="8">Chủ nhật</option>
                      </select>
                    </div>                  
                  </div>
                </div>
                </div>
                 <div class="box-footer" style="text-align: center">
              <a href=<?php echo '"gv_index.php?khoatrang=gv_diemdanh_final&id_nhom_hp='.$_GET["id_nhom_hp"].'&id_tuan='.$_GET["id_tuan"].'"'; ?>>
                <button type="button" class="btn btn-default">Trở lại</button>
              </a>
              <button type="submit" class="btn btn-default">Cập nhật</button>
            </div>
                
              </form>
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
