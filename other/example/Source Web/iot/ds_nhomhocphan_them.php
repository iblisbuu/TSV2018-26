<?php
  require_once("controller/xacthuc_ql.php");
?>

<div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
            <a href='?khoatrang=nhomhocphan_danhsach'>
             <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
            </a>
              <h3 class="box-title" style="font-size: 40px;">THÊM NHÓM HỌC PHẦN</h3>
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
            <form class="form-horizontal" method="post" action="controller/them_nhomhp.php" name="form_them_nhomhp">
              <div class="box-body">
                <div class="form-group">
                  <label for="manhom" class="col-sm-2 control-label">Mã nhóm</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="manhom" placeholder="Nhập mã nhóm">
                  </div>
                </div>
                <div class="form-group">
                  <label for="mamon" class="col-sm-2 control-label">Mã môn học</label>

                  <div class="col-sm-10">
                    <input type="search" class="form-control" name="mamon" placeholder="Nhập mã môn học">
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
                            echo "<option value=\"".$row['TAIKHOAN_USER']."\">".$row['TAIKHOAN_USER']." - ".$row['HOTEN_USER']."</option>";
                          }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="hocky" class="col-sm-2 control-label">Học kỳ</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="hocky">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="Hè">Hè</option>
                        
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
                  <div class="form-group">
                  <label for="sisotoida" class="col-sm-2 control-label">Sỉ số tối đa</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="sisotoida" placeholder="Nhập sỉ số tối đa" value="0" min="0" max="1000">
                  </div>
                </div>
                </div>
                <div class="box-body">
                  <div class="form-group">
                    <label for="tuanhoc" class="col-sm-2 control-label">Tuần học</label>

                    <div class="col-sm-10">
                      <label class="control-label">
                        1 <input type="checkbox" name="tuanhoc[]" value="1" checked="checked">
                        2 <input type="checkbox" name="tuanhoc[]" value="2" checked="checked">
                        3 <input type="checkbox" name="tuanhoc[]" value="3" checked="checked">
                        4 <input type="checkbox" name="tuanhoc[]" value="4" checked="checked">
                        5 <input type="checkbox" name="tuanhoc[]" value="5" checked="checked">
                        6 <input type="checkbox" name="tuanhoc[]" value="6" checked="checked">
                        7 <input type="checkbox" name="tuanhoc[]" value="7" checked="checked">
                        8 <input type="checkbox" name="tuanhoc[]" value="8" checked="checked">
                        9 <input type="checkbox" name="tuanhoc[]" value="9" checked="checked">
                        10 <input type="checkbox" name="tuanhoc[]" value="10" checked="checked">
                        11 <input type="checkbox" name="tuanhoc[]" value="11" checked="checked">
                        12 <input type="checkbox" name="tuanhoc[]" value="12" checked="checked">
                        13 <input type="checkbox" name="tuanhoc[]" value="13" checked="checked">
                        14 <input type="checkbox" name="tuanhoc[]" value="14" checked="checked">
                        15 <input type="checkbox" name="tuanhoc[]" value="15" checked="checked">
                        16 <input type="checkbox" name="tuanhoc[]" value="16" checked="checked">
                        17 <input type="checkbox" name="tuanhoc[]" value="17" checked="checked">
                        18 <input type="checkbox" name="tuanhoc[]" value="18" checked="checked">
                        19 <input type="checkbox" name="tuanhoc[]" value="19">
                        20 <input type="checkbox" name="tuanhoc[]" value="20">
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="sobuoitrongtuan" class="control-label col-sm-2">Số buổi trong tuần</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="sobuoitrongtuan" onchange="setSoBuoiHocTrongTuan()">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="div_sobuoihoctrongtuan">
                    
                  </div>
                </div>
              </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href='?khoatrang=nhomhocphan_danhsach'> 
                  <button type="button" class="btn btn-default">Trở lại</button>
                </a>
                <button type="button" class="btn btn-info pull-right" onclick="testThemNhomHP()">Thêm</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div style="display: none;" id="ds_phong">
            <?php
              require_once("lib/connect.php");
              $sql= "SELECT * FROM phong";
              $query = mysqli_query($conn,$sql);
              while($row = mysqli_fetch_array($query)){
                echo "<option value=".$row['ID_PHONG'].">".$row['TEN_PHONG']." _ ".$row['DIA_DIEM_PHONG']." _ Sức chứa: ".$row['SUC_CHUA_PHONG']."</option>";
              }
            ?>
          </div>
    
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
