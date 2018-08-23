<?php
  require_once("controller/xacthuc_ql.php");
?>

<div>
      <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
              <a href="?khoatrang=monhoc_danhsach"> 
                <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
              </a>
              <h3 class="box-title" style="font-size: 40px;">THÊM MÔN HỌC</h3>
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
            <br>
            <div class="form-group">
                <form action="controller/upload_danhsach_monhoc.php" method="post" name="form_upload_file" enctype="multipart/form-data">
                  &emsp;<span class="btn btn-default btn-file" >
                <i class="glyphicon glyphicon-picture"></i> Chọn file excel chứa danh sách môn học
                <input required="true" type="file" name="file_sv" id="file_sv">
            </span>
            <button type="button" class="btn btn-info" onclick="testSubmitFileExcel()">
                    <i class="glyphicon glyphicon-import"></i> Upload
                  </button>
                </form>
              </div>
              <hr>
            <!-- form start -->
            <form class="form-horizontal" method="post" name="form_them_monhoc" action="controller/them_monhoc.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="txtmamon" class="col-sm-2 control-label">Mã môn học</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="mamon" placeholder="Mã môn học">
                  </div>
                </div>
                <div class="form-group">
                  <label for="txttenmon" class="col-sm-2 control-label">Tên môn học</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tenmon" placeholder="Tên môn học">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="txtsotinchi" class="col-sm-2 control-label">Số tín chỉ</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="sotinchi" placeholder="Số tín chỉ" value="0" min="0" max="10">
                  </div>
                </div>
              </div>
		        </form>
              <!-- /.box-body -->
              <div class="box-footer">
               <a href="?khoatrang=monhoc_danhsach"> 
                  <button type="button" class="btn btn-default">Trở lại</button>
                </a>
                <button type="button" class="btn btn-info pull-right" onclick="testThemMonHoc()">Thêm</button>
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
