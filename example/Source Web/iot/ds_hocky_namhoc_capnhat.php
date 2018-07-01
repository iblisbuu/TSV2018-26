<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['id_hknh'])){
    header('Location: ql_index.php?khoatrang=hocky_namhoc');
  }
  else{
    require_once("lib/connect.php");
    $sql = "SELECT * FROM hocky_namhoc where ID_HKNH='".$_GET['id_hknh']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $hocky = $row['HOCKY'];
    $namhoc = $row['NAMHOC'];
    $ngay_bd_hk = $row['NGAY_BD_HK'];
  }
?>

<div>
    <!-- Main content -->
    <section >
      <div style="padding-top: 50px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="text-align: center">
              <div class="box-header with-border" style="text-align: center;">
              <a href='?khoatrang=hocky_namhoc'>
                <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
              </a>
              <h3 class="box-title" style="font-size: 40px;">CẬP NHẬT HỌC KỲ - NĂM HỌC</h3>
            </div>
              <div align="center" style="width: 50%;margin-left: 20%;" id="alert">
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
              <form class="form-horizontal" method="post" name="form_capnhat_hknh" action="controller/capnhat_hknh.php">
                
                <div class="box-body">
                  <div class="form-group">
                    <label for="hocky" class="col-sm-3 control-label">Học kỳ</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="hocky">
                        <?php
                          if(isset($hocky)){
                            if($hocky=='1'){
                              echo "<option value='1' selected>1</option>
                                    <option value='2'>2</option>
                                    <option value='Hè''>Hè</option>";

                            }
                            if($hocky=='2'){
                              echo "<option value='1'>1</option>
                                    <option value='2' selected>2</option>
                                    <option value='Hè''>Hè</option>";

                            }
                            if($hocky=='Hè'){
                              echo "<option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='Hè' selected>Hè</option>";

                            }
                          }
                          else{
                            echo "<option value='1'>1</option>
                                  <option value='2'>2</option>
                                  <option value='Hè'>Hè</option>";
                        	}
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="namhoc" class="col-sm-3 control-label">Năm học</label>

                    <div class="col-sm-9">
                    	<input type="text" class="form-control" name="namhoc" placeholder="Năm học" value=<?php echo "'".$namhoc."'"; ?>>
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label for="ngay_bd_hk" class="col-sm-3 control-label">Ngày bắt đầu học kỳ</label>

                    <div class="col-sm-9">
                    	<input type="date" class="form-control" name="ngay_bd_hk" placeholder="Ngày bắt đầu học kỳ" value=<?php echo "'".$ngay_bd_hk."'"; ?>>
                    </div>                  
                  </div>
                </div>
                <input type="hidden" name="id_hknh" value=<?php echo $_GET['id_hknh']; ?>>
                <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
                <div class="box-footer" style="text-align: center">
                  <button type="button" class="btn btn-info pull-right" style="text-align: center" onclick="testCapNhatHKNH()">
                    Cập nhật
                  </button>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          
        	</form>
            
            </div>
            <!-- /.box-header -->
            
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