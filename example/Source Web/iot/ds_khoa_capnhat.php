<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['id_khoa'])){
    header('Location: ql_index.php?khoatrang=khoa_danhsach');
  }
  else{
    require_once("lib/connect.php");
    $sql = "SELECT * FROM khoa where ID_KHOA='".$_GET['id_khoa']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $tenkhoa = $row['TEN_KHOA'];
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
              <a href='?khoatrang=khoa_danhsach'>
                <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
              </a>
              <h3 class="box-title" style="font-size: 40px;">CẬP NHẬT KHOA</h3>
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
            <form class="form-horizontal" method="post" name="form_capnhat_khoa" action="controller/capnhat_khoa.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="tenkhoa" class="col-sm-2 control-label">Tên khoa</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tenkhoa" placeholder="Nhập tên khoa" value=<?php echo "'".$tenkhoa."'"; ?>>
                  </div>
                </div>
               </div>
               <input type="hidden" name="id_khoa" value=<?php echo $_GET['id_khoa']; ?>>
               <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
            </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href='?khoatrang=khoa_danhsach'> <button type="button" class="btn btn-default">Trở lại</button></a>
                <button type="button" class="btn btn-info pull-right" onclick="testCapNhatKhoa()">Thêm</button>
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