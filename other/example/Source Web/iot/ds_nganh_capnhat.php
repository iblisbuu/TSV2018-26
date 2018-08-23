<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['id_nganh'])){
    header('Location: ql_index.php?khoatrang=nganh_danhsach');
  }
  else{
    require_once("lib/connect.php");
    $sql = "SELECT * FROM nganh where ID_NGANH='".$_GET['id_nganh']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $tennganh = $row['TEN_NGANH'];
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
              <a href='?khoatrang=nganh_danhsach'>
                <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
              </a>
              <h3 class="box-title" style="font-size: 40px;">CẬP NHẬT NGÀNH</h3>
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
            <form class="form-horizontal" method="post" name="form_capnhat_nganh" action="controller/capnhat_nganh.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="tennganh" class="col-sm-2 control-label">Tên ngành</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tennganh" placeholder="Nhập tên ngành" value=<?php echo "'".$tennganh."'"; ?>>
                  </div>
                </div>
               </div>
               <input type="hidden" name="id_nganh" value=<?php echo $_GET['id_nganh']; ?>>
               <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
            </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-info pull-right" onclick="testCapNhatNganh()">Cập nhật</button>
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