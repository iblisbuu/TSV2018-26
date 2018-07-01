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
                    <label for="hocky" class="col-sm-2 control-label">Tuần</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="tuan">
                        <?php
                          for($i=1;$i <= 20;$i++){
							  echo " <option value='$i''>$i</option>";            
						  }          
                        ?>
                      </select>
                    </div>
                  </div>
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
            
				<span class="box-title" style="font-size:40px; margin-left: 27%; color: white;">THỜI KHOÁ BIỂU</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <div style="color:white;">
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>Thứ</th>
                    <th>Mã học phần</th>
                    <th>Mã nhóm</th>
                    <th>Tiết bắt đầu</th>
                    <th>Số tiết</th>
                    <th>Phòng học</th>
           
                    
                  </tr>
                </thead>
                <tbody align="center" style="background-color: white;">
                  <?php
                    if(isset($_GET['hocky']) && isset($_GET['namhoc'])){
                      require_once("lib/connect.php");
                      $sql= "SELECT mon_hoc.MA_MH, 
					  			nhom_hp.MA_NHOM_HP,
								mon_hoc.TEN_MH, 
								lich_hoc.ID_TIET,
								phong.TEN_PHONG,
								lich_hoc.SO_TIET,
								lich_hoc.THU
							FROM sv_thuoc_nhom_hp 
								JOIN nhom_hp ON nhom_hp.ID_NHOM_HP=sv_thuoc_nhom_hp.ID_NHOM_HP
								JOIN mon_hoc ON nhom_hp.MA_MH=mon_hoc.MA_MH
								JOIN hocky_namhoc ON hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH
								JOIN lich_hoc ON lich_hoc.ID_NHOM_HP=lich_hoc.ID_NHOM_HP
								JOIN phong ON phong.ID_PHONG=lich_hoc.ID_PHONG
							WHERE sv_thuoc_nhom_hp.TAIKHOAN_USER='{$_SESSION['username']}'
								AND HOCKY='".$_GET['hocky']."'
								AND NAMHOC='".$_GET['namhoc']."'
								AND lich_hoc.ID_TUAN=".$_GET['tuan']
							." ORDER BY (lich_hoc.THU);";
					//echo $sql."<br>";
                      $query = mysqli_query($conn,$sql);
                      
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$row['THU']."</td>";
                        echo "<td>".$row['MA_MH']."</td>";
						echo "<td>".$row['MA_NHOM_HP']."</td>";
						echo "<td>".$row['ID_TIET']."</td>";
						echo "<td>".$row['SO_TIET']."</td>";
						echo "<td>".$row['TEN_PHONG']."</td>";
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