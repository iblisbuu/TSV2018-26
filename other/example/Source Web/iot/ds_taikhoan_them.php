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
            <a href="?khoatrang=nguoidung_danhsach"> 
              <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
            </a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
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
                <form action="controller/upload_danhsach_taikhoan.php" method="post" name="form_upload_file" enctype="multipart/form-data">
                  &emsp;<span class="btn btn-default btn-file" >
                <i class="glyphicon glyphicon-picture"></i> Chọn file excel chứa danh sách người dùng
                <input required="true" type="file" name="file_sv" id="file_sv">
            </span>
            <button type="button" class="btn btn-info" onclick="testSubmitFileExcel()">
                    <i class="glyphicon glyphicon-import"></i> Upload
                  </button>
                </form>
              </div>
              <hr>
            <form class="form-horizontal" method="post" name="form_them_taikhoan" action="controller/them_taikhoan.php">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><h3>Thông tin người dùng</h3></label>
                </div>
                <div class="form-group">
                  <label for="hoten" class="col-sm-2 control-label">Họ tên</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="hoten" placeholder="Họ tên">
                  </div>
                </div>
                <div class="form-group">
                  <label for="gioitinh" class="col-sm-2 control-label">Giới tính</label>

                  <div class="col-sm-10">
                    <select name="gioitinh" class="form-control">
                      <option value="Nam">Nam</option>
                      <option value="Nữ">Nữ</option>
                      <option value="Khác">Khác</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="ngaysinh" class="col-sm-2 control-label">Ngày sinh</label>

                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh">
                  </div>
                </div>
                <div class="form-group">
                  <label for="diachi" class="col-sm-2 control-label">Địa chỉ</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="diachi" placeholder="Địa chỉ">
                  </div>
                </div>
                <div class="form-group">
                  <label for="sodienthoai" class="col-sm-2 control-label">Số điện thoại</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="sodienthoai" placeholder="Số điện thoại" min="0" maxlength="15">
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <label class="col-sm-4 control-label"><h3>Thông tin tài khoản</h3></label>
                </div>
                <div class="form-group">
                  <label for="taikhoan" class="col-sm-2 control-label">Tài khoản</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="taikhoan" placeholder="Tài khoản">
                  </div>
                </div>
                <div class="form-group">
                  <label for="mathe" class="col-sm-2 control-label">Mã thẻ</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="mathe" placeholder="Mã thẻ">
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Quyền</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="id_quyen">
                      <?php
                        require_once("lib/connect.php");
                        $sql= "SELECT * FROM quyen";
                        $query = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($query)){
                          if($row['ID_QUYEN']==3){
                            echo "<option value=\"".$row['ID_QUYEN']."\" selected>".$row['TEN_QUYEN']."</option>";
                          }
                          else{
                            echo "<option value=\"".$row['ID_QUYEN']."\">".$row['TEN_QUYEN']."</option>";
                          }
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <input type="hidden" name="url" value=<?php echo $_SERVER['HTTP_REFERER'] ?> >
              </div>
			      </form>
              <!-- /.box-body -->
              <div class="box-footer">
               <a href="?khoatrang=nguoidung_danhsach"> <button type="button" class="btn btn-default">Trở lại</button></a>
                <button type="button" class="btn btn-info pull-right" onclick="testThemTaiKhoan()">Thêm</button>
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