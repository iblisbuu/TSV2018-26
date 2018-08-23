<?php
  require_once("controller/xacthuc_ql.php");
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
              <h3 class="box-title" style="font-size: 40px;">THÊM PHÒNG HỌC</h3>
            </div>
            <!-- /.box-header -->
            <br>
            <div id="alert" align="center" style="width: 60%; margin-left: 20%;">
              <?php
                if(isset($_SESSION['error'])){
                  echo "<div class=\"alert alert-danger\">".$_SESSION['error']."</div>";
                  unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                  echo "<div class=\"alert alert-success\">".$_SESSION['success']."</div>";
                  unset($_SESSION['success']);
                }
              ?>
            </div>
            <br>
            <div class="form-group">
                <form action="controller/upload_danhsach_phong.php" method="post" name="form_upload_file" enctype="multipart/form-data">
                  &emsp;<span class="btn btn-default btn-file" >
                <i class="glyphicon glyphicon-picture"></i> Chọn file excel chứa danh sách phòng
                <input required="true" type="file" name="file_sv" id="file_sv">
            </span>
            <button type="button" class="btn btn-info" onclick="testSubmitFileExcel()">
                    <i class="glyphicon glyphicon-import"></i> Upload
                  </button>
                </form>
              </div>
              <hr>
            <!-- form start -->
            <form class="form-horizontal" method="post" name="form_them_phonghoc" action="controller/them_phonghoc.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="tenphong" class="col-sm-2 control-label">Tên phòng</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tenphong" placeholder="Nhập tên phòng">
                  </div>
                </div>
                <div class="form-group">
                  <label for="diadiem" class="col-sm-2 control-label">Địa điểm</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="diadiem" placeholder="Nhập địa điểm">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="succhua" class="col-sm-2 control-label">Sức chứa</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="succhua" placeholder="Nhập sức chứa">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="ip_rf" class="col-sm-2 control-label">IP_RFID</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="ip_rf" placeholder="Nhập IP_RFID">
                  </div>
                </div>
              </div>
              <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
            </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href='?khoatrang=phonghoc_danhsach'> <button type="button" class="btn btn-default">Trở lại</button></a>
                <button type="button" class="btn btn-info pull-right" onclick="testThemPhongHoc()">Thêm</button>
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