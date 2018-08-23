<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['id_nhom_hp'])){
    header('Location: ql_index.php?khoatrang=hocky_namhoc');
  }
  else{
    $link='?khoatrang=nhomhocphan_danhsach&info_search='.$_GET['ma_mh'].'&hocky='.$_GET['hocky'].'&namhoc='.$_GET['namhoc'];
  }
?>

<div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
            <a href=<?php echo "'".$link."'";?>>
             <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
            </a>
              <h3 class="box-title" style="font-size: 40px;">THÔNG TIN NHÓM HỌC PHẦN</h3>
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
            <form class="form-horizontal" method="post" action="controller/capnhat_nhomhp.php" name="form_capnhat_nhomhp">
              <div class="box-body">
                <div class="form-group">
                  <label for="manhom" class="col-sm-2 control-label">Mã nhóm</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="manhom" placeholder="Nhập mã nhóm" value=<?php echo '"'.$_GET['ma_nhom'].'"'?> >
                  </div>
                </div>
                <div class="form-group">
                  <label for="mamon" class="col-sm-2 control-label">Mã môn học</label>

                  <div class="col-sm-10">
                    <input type="search" class="form-control" name="mamon" placeholder="Nhập mã môn học" value=<?php echo '"'.$_GET['ma_mh'].'"'?>>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="giaovien" class="col-sm-2 control-label">Giáo viên</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="giaovien">
                        <?php
                          require_once("lib/connect.php");
                          $sql= "SELECT TAIKHOAN_USER, HOTEN_USER FROM giao_vien";
                          $query = mysqli_query($conn,$sql);
                          echo "<option value=\"NULL\" selected>Chưa có</option>";
                          while($row = mysqli_fetch_array($query)){
                            if($row['TAIKHOAN_USER']==$_GET['giao_vien']){
                              echo "<option selected value=\"".$row['TAIKHOAN_USER']."\">".$row['TAIKHOAN_USER']." - ".$row['HOTEN_USER']."</option>";
                            }
                            else{
                              echo "<option value=\"".$row['TAIKHOAN_USER']."\">".$row['TAIKHOAN_USER']." - ".$row['HOTEN_USER']."</option>";
                            }
                          }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="hocky" class="col-sm-2 control-label">Học kỳ</label>

                    <div class="col-sm-10">
                      <?php
                          echo $_GET['hocky'];
                      ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="namhoc" class="col-sm-2 control-label">Năm học</label>

                    <div class="col-sm-10">
                      <?php
                        echo $_GET['namhoc'];
                      ?>
                    </div>                  
                  </div>
                  <div class="form-group">
                  <label for="sisotoida" class="col-sm-2 control-label">Sỉ số tối đa</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="sisotoida" placeholder="Nhập sỉ số tối đa" value=<?php echo '"'.$_GET['siso_toida'].'"'?> min="0" max="1000">
                  </div>
                </div>
                </div>
                <input type="hidden" name="id_nhom_hp" value=<?php echo '"'.$_GET['id_nhom_hp'].'"'?>>
                <input type="hidden" name="hocky" value=<?php echo '"'.$_GET['hocky'].'"'?>>
                <input type="hidden" name="namhoc" value=<?php echo '"'.$_GET['namhoc'].'"'?>>
              </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-info pull-right" onclick="testCapNhatNhomHP()">Cập nhật</button>
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
