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
              <a href="?khoatrang=khoa_them">
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
                  <input type="text" name="info_search" class="form-control" placeholder="Tìm kiếm theo tên khoa...">
                  <span class="input-group-btn">
                    <button type="button" name="search" id="search-btn" class="btn btn-primary" onclick="testSearch()">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>        
                </div>
              </form>
              <br><br>
				      <span class="box-title" style="font-size:40px;">DANH SÁCH KHOA</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>Số thứ tự</th>
                    <th>Tên khoa</th>
                    <th colspan="3"></th>
                  </tr>
                </thead>
                <tbody style="text-align:center;">
                  <?php
                    if(isset($_GET['info_search'])){
                      require_once("lib/connect.php");
                      $sql= "SELECT * FROM khoa WHERE TEN_KHOA like '%".$_GET['info_search']."%' order by TEN_KHOA";
                      $query = mysqli_query($conn,$sql);
                      $i=1;
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['TEN_KHOA']."</td>";
                        echo "<td class='ghichu' title='Xóa' onclick=xoaKhoa(\"".$row['ID_KHOA']."\")>
                                <i class='glyphicon glyphicon-trash'></i>
                              </td>
                              <td class='ghichu' title='Cập nhật' onclick=suaKhoa(\"".$row['ID_KHOA']."\")>
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
 <form action="ql_index.php" method="get" name="form_suaKhoa">
  <input type="hidden" name="khoatrang" value='capnhatkhoa'>
  <input type="hidden" name="id_khoa" value="">
 </form>
 <form action="controller/xoa_khoa.php" method="post" name="form_xoaKhoa">
  <input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
  <input type="hidden" name="id_khoa" value="">
 </form>

  <!-- Control Sidebar -->
