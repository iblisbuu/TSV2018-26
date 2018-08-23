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
              <a href="?khoatrang=themtaikhoan">
                <button style="width: 5%;float: left" type="button" class="btn btn-block btn-primary btn-lg">+</button>
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
                <div class="input-group" style="width: 25%; position: absolute; left: 73%; top:10%; float: right">
                  <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
                  <input type="text" name="info_search" class="form-control" placeholder="Tìm kiếm mã người dùng...">

                  <span class="input-group-btn">
                    <button type="button" id="search-btn" class="btn btn-primary" onclick="testSearch()">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
              </form>
              <br><br>
				      <span class="box-title" style="font-size:40px;">TÀI KHOẢN NGƯỜI DÙNG</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                <tr>
                  <th>Tài khoản</th>
                  <th>Họ tên</th>
                  <th>Giới tính</th>
                  <th>Mã thẻ</th>
                  <th>Quyền</th>
                  <th>Email</th>
                  <th>Số điện thoại</th>
					        <th></th>
                </tr>
                </thead>
                <tbody style="text-align:center;">
                  <?php
                    if(isset($_GET['info_search'])){
                      require_once("lib/connect.php");
                      $sql= "SELECT * FROM user JOIN quyen ON user.ID_QUYEN=quyen.ID_QUYEN WHERE TAIKHOAN_USER like '%".$_GET['info_search']."%' order by TAIKHOAN_USER";
                      $query = mysqli_query($conn,$sql);
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$row['TAIKHOAN_USER']."</td>";
                        echo "<td>".$row['HOTEN_USER']."</td>";
                        echo "<td>".$row['GIOI_TINH']."</td>";
                        echo "<td>".$row['MATHE_USER']."</td>";
                        echo "<td>".$row['TEN_QUYEN']."</td>";
                        echo "<td>".$row['EMAIL']."</td>";
                        echo "<td>".$row['SO_DT']."</td>";
                        echo "<td class='ghichu' title='Cập nhật' onclick='capNhatTaiKhoan(\"".$row['TAIKHOAN_USER']."\")'>
                                <i class='glyphicon glyphicon-pencil'></i>
                              </td>";
                        echo "</tr>";
                      }
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <form action="ql_index.php" method="get" name="form_capnhat">
            <input type="hidden" name="khoatrang" value='capnhattaikhoan'>
            <input type="hidden" name="taikhoan" value="">
          </form>
    
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
