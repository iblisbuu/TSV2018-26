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
             <a href=<?php echo "?khoatrang=sv_nhomhocphan&hocky=".$_GET['hocky'].'&namhoc='.$_GET['namhoc']; ?>>
                <button style="width: 5%;float: left" type="button" class="btn btn-block btn-primary btn-lg">-</button>
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
       
              
            
				<span class="box-title" style="font-size:40px;">BẢNG ĐIỂM DANH</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <div style="color:white;">
              </div>
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                  <tr>
                    <th>STT</th>
                    <th>Tuần</th>
                    <th>Thứ</th>
                    <th>Tiết</th>
                    <th>Số tiết</th>
                    <th>Phòng học</th>
           			<th>Trạng thái</th>
                    
                  </tr>
                </thead>
                <tbody align="center" style="background-color: white;">
                  <?php
                    if(isset($_GET['id_nhom_hp']) ){
                      require_once("lib/connect.php");
                      $sql= "SELECT lich_hoc.ID_TUAN,
								lich_hoc.THU,
								lich_hoc.ID_TIET,
								lich_hoc.SO_TIET,
								phong.TEN_PHONG,
								danh_sach_diem_danh.CHECK_DIEMDANH
							FROM lich_hoc
								JOIN danh_sach_diem_danh ON danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH
								JOIN phong ON phong.ID_PHONG=lich_hoc.ID_PHONG
							WHERE ID_NHOM_HP={$_GET['id_nhom_hp']}
								AND TAIKHOAN_USER='{$_SESSION['username']}'
							ORDER BY (lich_hoc.ID_TUAN);";
					//echo $sql."<br>";
                      $query = mysqli_query($conn,$sql);
                      $i=1;
					  
                      while($row = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>".$i."</td>";
                        echo "<td>".$row['ID_TUAN']."</td>";
						echo "<td>".$row['THU']."</td>";
						echo "<td>".$row['ID_TIET']."</td>";
						echo "<td>".$row['SO_TIET']."</td>";
						echo "<td>".$row['TEN_PHONG']."</td>";
						if( $row['CHECK_DIEMDANH']==1){
							echo "<td>Đã điểm danh</td>";
						} 
						else{
						echo "<td>Chưa điểm danh</td>";
						}
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