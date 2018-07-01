<?php
  require_once("controller/xacthuc_ql.php");
  if(!isset($_GET['id_nhom_hp'])){
    header('Location: ql_index.php?khoatrang=hocky_namhoc');
  }
  else{
    $link='?khoatrang=nhomhocphan_danhsach&info_search='.$_GET['ma_mh'].'&hocky='.$_GET['hocky'].'&namhoc='.$_GET['namhoc'];
    require_once("lib/connect.php");
    $sql = "SELECT * FROM giao_vien where TAIKHOAN_USER='".$_GET['giao_vien']."'";
    $query = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($query);
    $hoten_giaovien=$row['HOTEN_USER'];
  }
?>

<div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
            <a href=<?php echo "'".$link."'";?>>
             <button style="width: 5%;" type="button" class="btn btn-block btn-primary btn-lg">-</button>
            </a>
            </div>
            <div class="box-body">
            	<h3>Thông tin nhóm học phần</h3>
            	<div class="box-body">
            		<div class="form-group">
                  		<label class="col-sm-2 control-label">Mã nhóm:</label>
                  		<div class="col-sm-4">
                    		<?php echo $_GET['ma_nhom']; ?>
                  		</div>
                  		<label class="col-sm-2 control-label">Mã môn:</label>
                  		<div class="col-sm-4">
                    		<?php echo $_GET['ma_mh']; ?>
                  		</div>
                	</div>
                	<br>
                	<div class="form-group">
                  		<label class="col-sm-2 control-label">Học kỳ:</label>
                  		<div class="col-sm-4">
                    		<?php echo $_GET['hocky']; ?>
                  		</div>
                  		<label class="col-sm-2 control-label">Năm học:</label>
                  		<div class="col-sm-4">
                    		<?php echo $_GET['namhoc']; ?>
                  		</div>
                	</div>
                	<br>
                	<div class="form-group">
                  		<label class="col-sm-2 control-label">Mã cán bộ:</label>
                  		<div class="col-sm-4">
                    		<?php echo $_GET['giao_vien']; ?>
                  		</div>
                  		<label class="col-sm-2 control-label">Họ tên:</label>
                  		<div class="col-sm-4">
                    		<?php echo $hoten_giaovien; ?>
                  		</div>
                	</div>
                	<br>
                	<div class="form-group">
                  		<label class="col-sm-2 control-label">Sỉ số tối đa:</label>
                  		<div class="col-sm-4">
                    		<?php echo $_GET['siso_toida']; ?>
                  		</div>
                  		<label class="col-sm-2 control-label"></label>
                  		<div class="col-sm-4">
                    		
                  		</div>
                	</div>
            	</div>
            </div>
            <hr>
            <div class="box-body">
            	<h3>Danh sách sinh viên</h3>
            	<div id="alert" align="center" style="width: 60%; margin-left: 20%;">
	              <?php
	                if(isset($_SESSION['error'])){
	                  echo "<div class=\"alert alert-danger\">".$_SESSION['error']."</div>";
	                  unset($_SESSION['error']);
	                }
	                if(isset($_SESSION['success'])){
	                  echo "<div class=\"alert alert-success\">".$_SESSION['success']."</div>";
	                  unset($_SESSION['success']);
	                }
	              ?>
	            </div>
            	<div class="form-group">
            		<form action="controller/upload_danhsach_sinhvien.php" method="post" name="form_upload_file" enctype="multipart/form-data">
            			<span class="btn btn-default btn-file" >
	    					<i class="glyphicon glyphicon-picture"></i> Chọn file excel chứa danh sách sinh viên
	    					<input required="true" type="file" name="file_sv" id="file_sv">
						</span>
						<input type="hidden" name="id_nhom_hp" value=<?php echo "'".$_GET['id_nhom_hp']."'"; ?>>
						<input type="hidden" name="hocky" value=<?php echo "'".$_GET['hocky']."'"; ?>>
						<input type="hidden" name="namhoc" value=<?php echo "'".$_GET['namhoc']."'"; ?>>
						<input type="hidden" name="mamon" value=<?php echo "'".$_GET['ma_mh']."'"; ?>>
						<input type="hidden" name="giaovien" value=<?php echo "'".$_GET['giao_vien']."'"; ?>>
						<input type="hidden" name="manhom" value=<?php echo "'".$_GET['ma_nhom']."'"; ?>>
						<input type="hidden" name="sisotoida" value=<?php echo "'".$_GET['siso_toida']."'"; ?>>
            			<button type="button" class="btn btn-info" onclick="testSubmitFileExcel()">
	            			<i class="glyphicon glyphicon-import"></i> Upload
	            		</button>
            		</form>
            	</div>
            	<div class="box-body" >
	              <table id="example2" class="table table-bordered table-hover">
	                <thead style="background-color: #066EB0; color: white; text-align-last: center">
	                <tr>
	                  <th>Số thứ tự</th>
	                  <th>Mã số</th>
	                  <th>Họ tên</th>
	                  <th>Xóa</th>
	                </tr>
	                </thead>
	                <tbody style="text-align:center;">
	                  <?php
	                    if(isset($_GET['id_nhom_hp'])){
	                      require_once("lib/connect.php");
	                      $sql= "SELECT sv_thuoc_nhom_hp.TAIKHOAN_USER,HOTEN_USER FROM sv_thuoc_nhom_hp JOIN sinh_vien ON sv_thuoc_nhom_hp.TAIKHOAN_USER=sinh_vien.TAIKHOAN_USER WHERE ID_NHOM_HP=".$_GET['id_nhom_hp']." order by sv_thuoc_nhom_hp.TAIKHOAN_USER;";
	                      $query = mysqli_query($conn,$sql);
	                      $i=1;
	                      while($row = mysqli_fetch_array($query)){
	                        echo "<tr>";
	                        echo "<td>".$i."</td>";
	                        echo "<td>".$row['TAIKHOAN_USER']."</td>";
	                        echo "<td>".$row['HOTEN_USER']."</td>";
	                        echo "<td class='ghichu' title='Xóa' onclick='xoaThanhVien(\"".$row['TAIKHOAN_USER']."\")'>
	                                <i class='glyphicon glyphicon-trash'></i>
	                              </td>";
	                        echo "</tr>";
	                        $i++;
	                      }
	                    }
	                  ?>
	                </tbody>
	              </table>
	            </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <!-- /.box-body -->
              
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
<form action="controller/xoa_thanhvien.php" method="post" name="form_xoa_thanhvien">
    <input type="hidden" name="id_nhom_hp" value=<?php echo "'".$_GET['id_nhom_hp']."'"; ?>>
	<input type="hidden" name="hocky" value=<?php echo "'".$_GET['hocky']."'"; ?>>
	<input type="hidden" name="namhoc" value=<?php echo "'".$_GET['namhoc']."'"; ?>>
	<input type="hidden" name="mamon" value=<?php echo "'".$_GET['ma_mh']."'"; ?>>
	<input type="hidden" name="giaovien" value=<?php echo "'".$_GET['giao_vien']."'"; ?>>
	<input type="hidden" name="manhom" value=<?php echo "'".$_GET['ma_nhom']."'"; ?>>
	<input type="hidden" name="sisotoida" value=<?php echo "'".$_GET['siso_toida']."'"; ?>>
	<input type="hidden" name="mssv" value="">
</form>