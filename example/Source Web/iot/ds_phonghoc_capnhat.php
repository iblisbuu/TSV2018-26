<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['id_phong'])){
    header('Location: ql_index.php?khoatrang=phonghoc_danhsach');
  }
  else{
    require_once("lib/connect.php");
    $sql = "SELECT * FROM phong where ID_PHONG='".$_GET['id_phong']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $tenphong = $row['TEN_PHONG'];
    $diadiem = $row['DIA_DIEM_PHONG'];
    $succhua = $row['SUC_CHUA_PHONG'];
    $ip_rf = $row['IP_RFID'];
  }
?>

<body>
<div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
              <a href='?khoatrang=phonghoc_danhsach'> 
                <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
              </a>
              <h3 class="box-title" style="font-size: 40px;">CẬP NHẬT PHÒNG HỌC</h3>
            </div>
            <!-- /.box-header -->
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
            <!-- form start -->
            <form class="form-horizontal" method="post" name="form_capnhat_phonghoc" action="controller/capnhat_phonghoc.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="tenphong" class="col-sm-2 control-label">Tên phòng</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tenphong" placeholder="Nhập tên phòng" value=<?php echo "'".$tenphong."'" ?> >
                  </div>
                </div>
                <div class="form-group">
                  <label for="diadiem" class="col-sm-2 control-label">Địa điểm</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="diadiem" placeholder="Nhập địa điểm" value=<?php echo "'".$diadiem."'" ?>>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="succhua" class="col-sm-2 control-label">Sức chứa</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="succhua" placeholder="Nhập sức chứa" value=<?php echo "'".$succhua."'" ?>>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="ip_rf" class="col-sm-2 control-label">IP_RFID</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ip_rf" placeholder="Nhập IP_RFID" value=<?php echo "'".$ip_rf."'" ?>>
                  </div>
                </div>
              </div>
              <input type="hidden" name="id_phong" value=<?php echo $_GET['id_phong']; ?>>
              <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
            </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-info pull-right" onclick="testCapNhatPhongHoc()">Cập nhật</button>
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