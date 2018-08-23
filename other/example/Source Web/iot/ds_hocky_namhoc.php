<?php
  require_once("controller/xacthuc_ql.php");
?>

<div>
    <!-- Main content -->
    <section >
      <div style="padding-top: 50px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="text-align: center">
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
              <form class="form-horizontal" method="post" name="form_them_hknh" action="controller/them_hknh.php">
                
                <div class="box-body">
                  <div class="form-group">
                    <label for="hocky" class="col-sm-3 control-label">Học kỳ</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="hocky">
                        <?php
                          if(isset($_GET['hocky'])){
                            if($_GET['hocky']=='1'){
                              echo "<option value='1' selected>1</option>
                                    <option value='2'>2</option>
                                    <option value='Hè''>Hè</option>";

                            }
                            if($_GET['hocky']=='2'){
                              echo "<option value='1'>1</option>
                                    <option value='2' selected>2</option>
                                    <option value='Hè''>Hè</option>";

                            }
                            if($_GET['hocky']=='Hè'){
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
                    	<input type="text" class="form-control" name="namhoc" placeholder="Năm học">
                    </div>                  
                  </div>
                  <div class="form-group">
                    <label for="ngay_bd_hk" class="col-sm-3 control-label">Ngày bắt đầu học kỳ</label>

                    <div class="col-sm-9">
                    	<input type="date" class="form-control" name="ngay_bd_hk" placeholder="Ngày bắt đầu học kỳ">
                    </div>                  
                  </div>
                </div>
                <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
                <div class="box-footer" style="text-align: center">
                  <button type="button" class="btn btn-info pull-center" style="text-align: center" onclick="testThemHKNH()">
                    Thêm
                  </button>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          
        </form>
            
				<span class="box-title" style="font-size:40px; margin-left: 27%; color: white">DANH SÁCH HỌC KỲ NĂM HỌC</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>STT</th>
                    <th>Học kỳ</th>
                    <th>Năm học</th>
                    <th>Ngày bắt đầu</th>
                    <th colspan="2"></th>
                  </tr>
                </thead>
                <tbody align="center" style="background-color: white">
                  <?php
                      require_once("lib/connect.php");
                      $sql= "SELECT * FROM hocky_namhoc order by ID_HKNH DESC";
                      $query = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$row['ID_HKNH']."</td>";
                        echo "<td>".$row['HOCKY']."</td>";
                        echo "<td>".$row['NAMHOC']."</td>";
                        echo "<td>".$row['NGAY_BD_HK']."</td>";
                        echo "<td class='ghichu' title='Xóa' onclick='xoaHKNH(".$row['ID_HKNH'].")'>
                                <i class='glyphicon glyphicon-trash'></i>
                              </td>
                              <td class='ghichu' title='Cập nhật' onclick='suaHKNH(".$row['ID_HKNH'].")'>
                                <i class='glyphicon glyphicon-pencil'></i>
                              </td>";
                        echo "</tr>";
                      }
                  ?>
                </tbody>
              </table>
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

  <form action="ql_index.php" method="get" name="form_suaHKNH">
  <input type="hidden" name="khoatrang" value='capnhat_hocky_namhoc'>
  <input type="hidden" name="id_hknh" value="">
 </form>
 <form action="controller/xoa_hknh.php" method="post" name="form_xoaHKNH">
  <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
  <input type="hidden" name="id_hknh" value="">
 </form>
 

