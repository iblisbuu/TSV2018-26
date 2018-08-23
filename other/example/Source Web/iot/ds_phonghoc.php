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
              <a href="?khoatrang=phonghoc_them">
                <button style="width: 5%;float: left;" type="button" class="btn btn-block btn-primary btn-lg">+</button>
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
              <form action="ql_index.php" method="get" name="form_search">
                <div class="input-group" style="width: 25%; position: absolute; left: 73%; top:10%;">
                  <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
                  <input type="text" name="info_search" class="form-control" placeholder="Tìm kiếm theo tên phòng...">
                  <span class="input-group-btn">
                    <button type="button" name="search" id="search-btn" class="btn btn-primary" onclick="testSearch()">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>        
                </div>
              </form>
              <br><br>
				      <span class="box-title" style="font-size:40px;">DANH SÁCH PHÒNG HỌC</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>Số thứ tự</th>
                    <th>Tên phòng</th>
                    <th>Địa điểm</th>
                    <th>Sức chứa</th>
                    <th>IP_RFID</th>
                    <th colspan="3">Chỉnh sửa</th>
                  </tr>
                </thead>
                <tbody style="text-align:center;">
                  <?php
                    if(isset($_GET['info_search'])){
                      require_once("lib/connect.php");
                      $sql= "SELECT * FROM phong WHERE TEN_PHONG like '%".$_GET['info_search']."%' order by TEN_PHONG";
                      $query = mysqli_query($conn,$sql);
                      $i=1;
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['TEN_PHONG']."</td>";
                        echo "<td>".$row['DIA_DIEM_PHONG']."</td>";
                        echo "<td>".$row['SUC_CHUA_PHONG']."</td>";
                        echo "<td>".$row['IP_RFID']."</td>";
                        echo "<td class='ghichu' title='Xóa' onclick='xoaPhongHoc(\"".$row['ID_PHONG']."\")'>
                                <i class='glyphicon glyphicon-trash'></i>
                              </td>
                              <td class='ghichu' title='Cập nhật' onclick='suaPhongHoc(\"".$row['ID_PHONG']."\")'>
                                <i class='glyphicon glyphicon-pencil'></i>
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
 <form action="ql_index.php" method="get" name="form_suaPhongHoc">
  <input type="hidden" name="khoatrang" value='capnhatphonghoc'>
  <input type="hidden" name="id_phong" value="">
 </form>
 <form action="controller/xoa_phonghoc.php" method="post" name="form_xoaPhongHoc">
  <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
  <input type="hidden" name="id_phong" value="">
 </form>

  <!-- Control Sidebar -->
