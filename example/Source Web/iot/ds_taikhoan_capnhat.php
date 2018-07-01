<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['taikhoan'])){
    header('Location: ql_index.php?khoatrang=nguoidung_danhsach');
  }
  else{
    require_once("lib/connect.php");
    $sql = "SELECT * FROM user where TAIKHOAN_USER='".$_GET['taikhoan']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $hoten = $row['HOTEN_USER'];
    $gioitinh = $row['GIOI_TINH'];
    $ngaysinh = $row['NGAY_SINH'];
    $diachi = $row['DIA_CHI'];
    $sodienthoai = $row['SO_DT'];
    $mathe = $row['MATHE_USER'];
    $id_quyen = $row['ID_QUYEN'];
    $email = $row['EMAIL'];
  }
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
	                else if(isset($_SESSION['success'])){
	                  echo "<div class=\"alert alert-success\">".$_SESSION['success']."</div>";
	                  unset($_SESSION['success']);
	                }
	              ?>
	            </div>
            	<form class="form-horizontal" method="post" name="form_capnhat_taikhoan1" action="controller/capnhat_taikhoan.php">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><h3>Thông tin người dùng</h3></label>
                </div>
                <div class="form-group">
                  <label for="hoten" class="col-sm-2 control-label">Họ tên</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="hoten" placeholder="Họ tên" value=<?php echo "'".$hoten."'";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="gioitinh" class="col-sm-2 control-label">Giới tính</label>

                  <div class="col-sm-10">
                    <select name="gioitinh" class="form-control">
                      <?php
                        if($gioitinh=='Nam'){
                          echo "<option value=\"Nam\" selected>Nam</option>
                                <option value=\"Nữ\">Nữ</option>
                                <option value=\"Khác\">Khác</option>";
                        }
                        else if($gioitinh=='Nữ'){
                          echo "<option value=\"Nam\">Nam</option>
                                <option value=\"Nữ\" selected>Nữ</option>
                                <option value=\"Khác\">Khác</option>";
                        }
                        else{
                          echo "<option value=\"Nam\">Nam</option>
                                <option value=\"Nữ\">Nữ</option>
                                <option value=\"Khác\" selected>Khác</option>";
                        }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="ngaysinh" class="col-sm-2 control-label">Ngày sinh</label>

                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="ngaysinh" placeholder="Ngày sinh" value=<?php echo "'".$ngaysinh."'";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="diachi" class="col-sm-2 control-label">Địa chỉ</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="diachi" placeholder="Địa chỉ" value=<?php echo "'".$diachi."'";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sodienthoai" class="col-sm-2 control-label">Số điện thoại</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="sodienthoai" placeholder="Số điện thoại" min="0" maxlength="15" value=<?php echo "'".$sodienthoai."'";?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="sodienthoai" class="col-sm-2 control-label">Địa chỉ mail</label>

                  <div class="col-sm-10">
                    <?php echo $email; ?>
                  </div>
                </div>
                <input type="hidden" name="taikhoan" value=<?php echo "'".$_GET['taikhoan']."'"?> >
                <input type="hidden" name="id_quyen" value=<?php echo $id_quyen; ?> >
                <input type="hidden" name="url" value=<?php echo $_SERVER['HTTP_REFERER'] ?> >
              </div>
              <div class="box-footer">
                <button type="button" class="btn btn-info pull-right" onclick="testCapNhatTaiKhoan1()">Cập nhật</button>
              </div>
            </form>
            
            
            <form class="form-horizontal" method="post" name="form_capnhat_taikhoan2" action="controller/capnhat_taikhoan.php">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-4 control-label"><h3>Thông tin tài khoản</h3></label>
                </div>
                <div class="form-group">
                  <label for="mathe" class="col-sm-2 control-label">Tài khoản</label>

                  <div class="col-sm-10">
                    <?php echo $_GET['taikhoan']?>
                  </div>
                </div>
                <!--div class="form-group">
                  <label for="mathe" class="col-sm-2 control-label">Mật khẩu</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="matkhau1" placeholder="Mật khẩu">
                  </div>
                </div>
                <div class="form-group">
                  <label for="mathe" class="col-sm-2 control-label">Nhập lại mật khẩu</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="matkhau2" placeholder="Nhập lại mật khẩu">
                  </div>
                </div-->
                <div class="form-group">
                  <label for="mathe" class="col-sm-2 control-label">Mã thẻ</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="mathe" placeholder="Mã thẻ" value=<?php echo "'".$mathe."'";?>>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Quyền</label>

                  <div class="col-sm-10">
                      <?php
                        require_once("lib/connect.php");
                        $sql= "SELECT * FROM quyen where ID_QUYEN=".$id_quyen;
                        $query = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_array($query);
                        echo $row['TEN_QUYEN'];
                      ?>
                  </div>
                </div>
              </div>
              <input type="hidden" name="taikhoan" value=<?php echo "'".$_GET['taikhoan']."'"?> >
              <input type="hidden" name="id_quyen" value=<?php echo $id_quyen; ?> >
              <input type="hidden" name="url" value=<?php echo $_SERVER['HTTP_REFERER'] ?> >
              <div class="box-footer">
                <button type="button" class="btn btn-info pull-right" onclick="testCapNhatTaiKhoan2()">Cập nhật</button>
              </div>
            </form>
              <!-- /.box-body -->
              
              
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