<?php
  require_once("controller/xacthuc_sv.php");
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
              <form class="form-horizontal" method="get" name="form_search" action="sv_index.php">
                <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
                <div class="box-body">
                  
                  <div class="form-group">
                    <label for="hocky" class="col-sm-2 control-label">Học kỳ</label>

                    <div class="col-sm-10">
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
                    <label for="namhoc" class="col-sm-2 control-label">Năm học</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="namhoc">
                      	<?php
                          require_once("lib/connect.php");
                          $sql= "SELECT count(distinct(NAMHOC)) FROM hocky_namhoc";
                          $query = mysqli_query($conn,$sql);
                          $row = mysqli_fetch_array($query);
                          $count = $row['count(distinct(NAMHOC))'];
                          $sql= "SELECT distinct(NAMHOC) FROM hocky_namhoc";
                          $query = mysqli_query($conn,$sql);
                          $i=1;
                          while($row = mysqli_fetch_array($query)){
                            if($count==$i){
                              echo "<option value=\"".$row['NAMHOC']."\" selected>".$row['NAMHOC']."</option>";
                            }
                            else{
                              echo "<option value=\"".$row['NAMHOC']."\">".$row['NAMHOC']."</option>";
                            }
                            $i++;
                          }
                        ?>
                      </select>
                    </div>                  
                  </div>
                </div>

                <div class="box-footer" style="text-align: center">
                  <button type="submit" class="btn btn-info pull-center" style="text-align: center">
                    Tìm kiếm
                  </button>
                </div>
              </div>
              <!-- /.box-body -->
            </div>
          
        </form>
            
				<span class="box-title" style="font-size:40px; margin-left: 27%; color: white;">DANH SÁCH NHÓM HỌC PHẦN</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <div style="color:white;">
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>STT</th>
                    <th>Mã nhóm</th>
                    <th>Mã môn</th>
                    <th>Tên nhóm hoc phần</th>
                    <th>Giảng viên</th>
                    <th>Check_điểm danh</th>
                  </tr>
                </thead>
                <tbody align="center" style="background-color: white;">
                  <?php
                    if(isset($_GET['hocky']) && isset($_GET['namhoc'])){
                      require_once("lib/connect.php");
                      $sql= "SELECT nhom_hp.ID_NHOM_HP, 
					  				nhom_hp.MA_NHOM_HP, 
									mon_hoc.MA_MH, 
									mon_hoc.TEN_MH, 
									nhom_hp.TAIKHOAN_USER, 
									giao_vien.HOTEN_USER 
							FROM sv_thuoc_nhom_hp JOIN nhom_hp ON nhom_hp.ID_NHOM_HP=sv_thuoc_nhom_hp.ID_NHOM_HP 
												JOIN mon_hoc ON mon_hoc.MA_MH=nhom_hp.MA_MH 
												JOIN giao_vien ON giao_vien.TAIKHOAN_USER=nhom_hp.TAIKHOAN_USER 
												JOIN hocky_namhoc ON hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH 
							WHERE sv_thuoc_nhom_hp.TAIKHOAN_USER='".$_SESSION['username']."' 
									AND HOCKY='".$_GET['hocky']."' 
									AND NAMHOC='".$_GET['namhoc']."';";
                      $query = mysqli_query($conn,$sql);
                      $i=1;
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['MA_NHOM_HP']."</td>";
						echo "<td>".$row['MA_MH']."</td>";
						echo "<td>".$row['TEN_MH']."</td>";
						echo "<td>".$row['TAIKHOAN_USER']." - ".$row['HOTEN_USER']."</td>";
						echo "<td ><a href=\"sv_index.php?khoatrang=sv_check_diemdanh&hocky=".$_GET['hocky']."&namhoc=".$_GET['namhoc']."&id_nhom_hp={$row['ID_NHOM_HP']}\"><img src=\"icon/xem.png\" style=\"width: 15px; height: 15px;\"/></a></td>";
                        echo "</tr>";
                        $i++;
                      }
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