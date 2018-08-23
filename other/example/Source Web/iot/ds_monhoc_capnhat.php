<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['mamon'])){
    header('Location: ql_index.php?khoatrang=monhoc_danhsach');
  }
  else{
    require_once("lib/connect.php");
    $sql = "SELECT * FROM mon_hoc where MA_MH='".$_GET['mamon']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $tenmon = $row['TEN_MH'];
    $sotinchi = $row['SO_TC'];
  }
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
              <h3 class="box-title" style="font-size: 40px;">CẬP NHẬT MÔN HỌC</h3>
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
            <form class="form-horizontal" method="post" name="form_capnhat_monhoc" action="controller/capnhat_monhoc.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="txtmamon" class="col-sm-2 control-label">Mã môn học</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="mamon" placeholder="Mã môn học" value=<?php echo "'".$_GET['mamon']."'"; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="txttenmon" class="col-sm-2 control-label">Tên môn học</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tenmon" placeholder="Tên môn học" value=<?php echo "'".$tenmon."'"; ?>>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="txtsotinchi" class="col-sm-2 control-label">Số tín chỉ</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="sotinchi" placeholder="Số tín chỉ" min="0" max="10" value=<?php echo "'".$sotinchi."'"; ?>>
                  </div>
                </div>
              </div>
              <input type="hidden" name="mamoncu" value=<?php echo "'".$_GET['mamon']."'"; ?>>
		    </form>
              <!-- /.box-body -->
            <div class="box-footer">
              <button type="button" class="btn btn-info pull-right" onclick="testCapNhatMonHoc()">Cập nhật</button>
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
