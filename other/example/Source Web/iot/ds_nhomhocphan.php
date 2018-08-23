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
              <a href="?khoatrang=nhomhocphan_them">
                <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">+</button>
              </a>
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
              <form class="form-horizontal" method="get" name="form_search" action="ql_index.php">
                <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
                <div class="box-body">
                  <div class="form-group">
                    <label for="tenmon" class="col-sm-2 control-label">Môn học</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="info_search" placeholder="Mã môn học"
                        <?php
                          if(isset($_GET['info_search'])){
                            echo "value='".$_GET['info_search']."'";
                          }
                        ?>
                      >
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
                  <button type="button" class="btn btn-info pull-center" style="text-align: center" onclick="testSearch()">
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
              <?php
                if(isset($_GET['info_search']) && isset($_GET['hocky']) && isset($_GET['namhoc'])){
                  require_once("lib/connect.php");
                  $sql= "SELECT * FROM mon_hoc WHERE MA_MH = '".$_GET['info_search']."'";
                  $query = mysqli_query($conn,$sql);
                  while($row = mysqli_fetch_array($query)){
                    echo "Mã học phần: ".$row['MA_MH']."<br>";
                    echo "Tên môn học: ".$row['TEN_MH']."<br>";
                    echo "Số tín chỉ : ".$row['SO_TC']."<br>";
                  }
                }
              ?>
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>STT</th>
                    <th>Mã nhóm</th>
                    <th>Giảng viên</th>
                    <th>Sỉ số</th>
                    <th colspan="3"></th>
                  </tr>
                </thead>
                <tbody align="center" style="background-color: white;">
                  <?php
                    if(isset($_GET['info_search']) && isset($_GET['hocky']) && isset($_GET['namhoc'])){
                      require_once("lib/connect.php");
                      $sql= "SELECT * FROM nhom_hp left join giao_vien on giao_vien.TAIKHOAN_USER=nhom_hp.TAIKHOAN_USER join hocky_namhoc on hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH WHERE MA_MH = '".$_GET['info_search']."' AND HOCKY='".$_GET['hocky']."' AND NAMHOC='".$_GET['namhoc']."' order by MA_NHOM_HP";
                      $query = mysqli_query($conn,$sql);
                      $i=1;
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['MA_NHOM_HP']."</td>";
                        if($row['TAIKHOAN_USER']==NULL){
                          echo "<td>Chưa có</td>";
                        }
                        else{
                          echo "<td>".$row['TAIKHOAN_USER'].' - '.$row['HOTEN_USER']."</td>";
                        }
                        echo "<td>".$row['SISO_NHOM_HP']."/".$row['SISO_TOIDA_NHOM_HP']."</td>";
                        echo "<td class='ghichu' title='Xóa' onclick='xoaNhomHP(\"".$row['ID_NHOM_HP']."\")'>
                                <i class='glyphicon glyphicon-trash'></i>
                              </td>
                              <td class='ghichu' title='Cập nhật' onclick='suaNhomHP(\"".$row['ID_NHOM_HP']."\",\"".$_GET['hocky']."\",\"".$_GET['namhoc']."\",\"".$row['MA_MH']."\",\"".$row['MA_NHOM_HP']."\",\"".$row['TAIKHOAN_USER']."\",\"".$row['SISO_TOIDA_NHOM_HP']."\")'>
                                <i class='glyphicon glyphicon-pencil'></i>
                              </td>
                              <td class='ghichu' title='Xem thông tin nhóm học phần' onclick='xemNhomHP(\"".$row['ID_NHOM_HP']."\",\"".$_GET['hocky']."\",\"".$_GET['namhoc']."\",\"".$row['MA_MH']."\",\"".$row['MA_NHOM_HP']."\",\"".$row['TAIKHOAN_USER']."\",\"".$row['SISO_TOIDA_NHOM_HP']."\")'>
                                <i class='glyphicon glyphicon-arrow-right'></i>
                              </td>";
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

  <form action="ql_index.php" method="get" name="form_sua_nhom">
    <input type="hidden" name="khoatrang" value="nhomhocphan_sua">
    <input type="hidden" name="id_nhom_hp" value="">
    <input type="hidden" name="hocky" value="">
    <input type="hidden" name="namhoc" value="">
    <input type="hidden" name="ma_mh" value="">
    <input type="hidden" name="ma_nhom" value="">
    <input type="hidden" name="giao_vien" value="">
    <input type="hidden" name="siso_toida" value="">
  </form>
 
  <form action="controller/xoa_nhom_hp.php" method="post" name="form_xoa_nhom">
    <input type="hidden" name="hocky" value=<?php echo $_GET['hocky']?> >
    <input type="hidden" name="namhoc" value=<?php echo $_GET['namhoc']?> >
    <input type="hidden" name="ma_mh" value=<?php echo $_GET['info_search']?> >
    <input type="hidden" name="id_nhom_hp" value="" >
  </form>

  <form action="ql_index.php" method="get" name="form_xem_nhom">
    <input type="hidden" name="khoatrang" value="nhomhocphan_xem">
    <input type="hidden" name="id_nhom_hp" value="">
    <input type="hidden" name="hocky" value="">
    <input type="hidden" name="namhoc" value="">
    <input type="hidden" name="ma_mh" value="">
    <input type="hidden" name="ma_nhom" value="">
    <input type="hidden" name="giao_vien" value="">
    <input type="hidden" name="siso_toida" value="">
  </form>