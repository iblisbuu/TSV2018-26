<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $date=date("d/m/Y-H:i:s");
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
				<span class="box-title" style="font-size:40px; margin-left: 7%;">DANH SÁCH SINH VIÊN</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <div>
                <?php
                  $sql = "SELECT * FROM nhom_hp JOIN mon_hoc ON nhom_hp.MA_MH=mon_hoc.MA_MH JOIN hocky_namhoc ON nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH WHERE ID_NHOM_HP=".$_GET['id_nhomhp'].";";
                  $query = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_array($query);
                  $mamon=$row['MA_MH'];
                  $tenmon=$row['TEN_MH'];
                  $siso=$row['SISO_NHOM_HP'];
                  $siso_toida=$row['SISO_TOIDA_NHOM_HP'];
                  $hocky=$row['HOCKY'];
                  $namhoc=$row['NAMHOC'];
                  $manhom=$row['MA_NHOM_HP'];
                  $giaovien=$row['TAIKHOAN_USER'];
                ?>
                <div class="form-group">
                  <div class="col-xs-6">
                    <?php
                      echo "Mã môn học: ".$mamon;
                    ?>
                  </div>
                  <div class="col-xs-6">
                    <?php
                      echo "Tên môn học: ".$tenmon;
                    ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <?php
                      echo "Học kỳ ".$hocky." năm học ".$namhoc;
                    ?>
                  </div>
                  <div class="col-xs-6">
                    <?php
                      echo "Mã giảng viên: ".$giaovien;
                    ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-6">
                    <?php
                      echo "Mã nhóm: ".$manhom;
                    ?>
                  </div>
                  <div class="col-xs-6">
                    <?php
                      echo "Sỉ số: ".$siso."/".$siso_toida;
                    ?>
                  </div>
                </div>
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>STT</th>
                    <th>MSSV</th>
                    <th>Họ và tên</th>
                    <th>Giới tính</th>
                    <th>Mail</th>
                    <th>Số ĐT</th>
  				        </tr>
                </thead>
                <tbody style="text-align:center;">
                  <?php
                    $sql="SELECT * FROM sv_thuoc_nhom_hp JOIN sinh_vien ON sv_thuoc_nhom_hp.TAIKHOAN_USER=sinh_vien.TAIKHOAN_USER WHERE ID_NHOM_HP=".$_GET['id_nhomhp'].";";
                    $query=mysqli_query($conn,$sql);
                    $i=1;
                    while($row=mysqli_fetch_array($query)){
                      echo "<tr>";
                      echo "<td>".$i."</td>";
                      echo "<td>".$row['TAIKHOAN_USER']."</td>";
                      echo "<td>".$row['HOTEN_USER']."</td>";
                      echo "<td>".$row['GIOI_TINH']."</td>";
                      echo "<td>".$row['EMAIL']."</td>";
                      echo "<td>".$row['SO_DT']."</td>";
                      echo "</tr>";
                      $i++;
                    }
				          ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" style="text-align: center">
              <button onClick="window.history.go(-1)" type="button" class="btn btn-default">Trở lại</button>
              <button type="button" class="btn btn-info" onclick="testSubmitFileExcel()">
                <a style="color: white;" href=<?php echo "\"controller/in_danh_sach_sv.php?id_nhom_hp=".$_GET['id_nhomhp']."\""; ?> target="_blank">
                  <i class="glyphicon glyphicon-save"></i> Download file excel
                </a>
              </button>
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
