<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  if(isset($_POST["id_nhom_hp"])){
	  $id_nhom_hp=$_POST["id_nhom_hp"];
  }
  if(isset($_GET["id_nhom_hp"])){
	  $id_nhom_hp=$_GET["id_nhom_hp"];
	 // echo "$id_nhom_hp";
  }
   if(isset($_POST["id_lh"])){
	  $id_nhom_hp=$_POST["id_lh"];
  }
  if(isset($_GET["id_lh"])){
	  $id_lh=$_GET["id_lh"];
	//  echo "$id_lh";
  }
?>
<script language="javascript">
function isEmpty(ten)
{
	if (ten=="")
		return false;
	return true;
}
function ktra(hocky,namhoc, monhoc){
	if(hocky=='default' && namhoc=='default' && monhoc=="" ){
		alert ("Vui lòng nhập tên môn học hoặc chọn học kỳ, năm học!");
		return false;
	}
	return true;
}
function checkxoa()
{
  var thongbao=window.confirm("Bạn chắc chắn muốn xóa mục này?");
  if (thongbao==true)
  		return true;
  else 
		return false;
}
</script>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div>

  <header>
   
    <!-- Main content -->
    <section >
      <div style="padding-top: 50px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="text-align: center">
            
            <!-- form start -->
             <form class="form-horizontal" method="GET" action="gv_index.php" onSubmit="return ktra_lichday(hocky.value, namhoc.value);">
              <div class="box-body">
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
                <div class="form-group">
                   <label class="col-sm-2 control-label">Chọn tuần</label>

                  <div class="col-sm-10">
                  <input type="hidden" name="khoatrang" value='gv_diemdanh_final' style="width:30px"/>
                  <input type="hidden" name="id_nhom_hp" value='<?php echo "$id_nhom_hp" ?>' style="width:30px" />
                    <select name="id_tuan" style="width: 100%; height: 35px; margin: 2px;">
                    	
                      <?php
                        if(!isset($_GET['id_tuan'])){
                          echo "<option disabled=\"true\" selected=\"true\" value=\"default\" >Chọn tuần</option>";
                        }
                        else{
                          echo "<option value=\"default\" >Chọn tuần</option>";
                        }
    				  		      $sql1= "SELECT DISTINCT ID_TUAN FROM lich_hoc WHERE ID_NHOM_HP='$id_nhom_hp'";
     			 	  		      $query1 = mysqli_query($conn,$sql1);
     			     		      while($kq1 = mysqli_fetch_array($query1)){
                          if(isset($_GET['id_tuan'])){
                            if($_GET['id_tuan']==$kq1['ID_TUAN']){
                              echo "<option selected value='$kq1[ID_TUAN]' >$kq1[ID_TUAN]</option>";
                            }
                            else{
                              echo "<option value='$kq1[ID_TUAN]' >$kq1[ID_TUAN]</option>";
                            }
                          }
                          else{
                            echo "<option value='$kq1[ID_TUAN]' >$kq1[ID_TUAN]</option>";
                          }
      	  				        
     					          } //while 
    				          ?>
                  </select>
                  </div>
                </div>
                </div>
                <div class="box-footer" style="text-align: center">
                <button type="submit" class="btn btn-info pull-center" style="text-align: center">Tìm kiếm</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        
      </form>
          <!-- ./form-->
				<span class="box-title" style="font-size:40px; margin-left: 20%; color:white">
          CHI TIẾT DANH SÁCH NHÓM HỌC PHẦN
        </span>

        </div>
        <!-- /.box-header -->
        <div class="box-body" >
          
          <div style="color: white;">
            <?php
              $sql = "SELECT * FROM nhom_hp JOIN mon_hoc ON nhom_hp.MA_MH=mon_hoc.MA_MH JOIN hocky_namhoc ON nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH WHERE ID_NHOM_HP=".$id_nhom_hp.";";
              $query = mysqli_query($conn,$sql);
              $row = mysqli_fetch_array($query);
              $mamon=$row['MA_MH'];
              $tenmon=$row['TEN_MH'];
              $siso=$row['SISO_NHOM_HP'];
              $siso_toida=$row['SISO_TOIDA_NHOM_HP'];
              $hocky=$row['HOCKY'];
              $namhoc=$row['NAMHOC'];
              $manhom=$row['MA_NHOM_HP'];
            ?>
            <div class="form-group">
              <div class="col-xs-6">
                <?php
                  echo "Mã môn học: ".$mamon;
                ?>
              </div>
              <div class="col-xs-6">
                <?php
                  echo "Tên môn học: ".$tenmon;
                ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-6">
                <?php
                  echo "Học kỳ ".$hocky." năm học ".$namhoc;
                ?>
              </div>
              <div class="col-xs-6">
                <?php
                  echo "Tuần học thứ: ".$_GET['id_tuan'];
                ?>
              </div>
            </div>
            <div class="form-group">
              <div class="col-xs-6">
                <?php
                  echo "Mã nhóm: ".$manhom;
                ?>
              </div>
              <div class="col-xs-6">
                <?php
                  echo "Sỉ số: ".$siso."/".$siso_toida;
                ?>
              </div>
            </div>
          </div>
          <table id="example2" class="table table-bordered table-hover" >
            <thead style="background-color: #066EB0; color: white; text-align-last: center">
              <tr>
                <th>Thứ</th>
                <th>Tiết bắt đầu</th>
                <th>Số tiết</th>
                <th>Phòng học</th>
                <th>Xem danh sách lớp</th>
                <th>Sửa</th>
                <th>Xóa</th>
				      </tr>
            </thead>
            <tbody style="text-align:center;ss; background-color:white">
              <?php
        				if(isset($_GET["id_nhom_hp"]) AND isset($_GET["id_tuan"]))
        				{
        					//$GLOBALS['id_nhom_hp']=$_GET["id_nhom_hp"];
        					$id_nhom_hp=$_GET["id_nhom_hp"];
        					//echo "Nhan duoc $hk";
        					//$GLOBALS['id_tuan']=$_GET["id_tuan"];
        					$id_tuan = $_GET["id_tuan"];
        					//echo "Nam hoc $namhoc";
        					//$id_lh = $_GET["id_lh"];
        				 $sql= "SELECT mon_hoc.TEN_MH, nhom_hp.MA_NHOM_HP, lich_hoc.THU, tiet_hoc.GIO_BD, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, lich_hoc.ID_TUAN ,lich_hoc.SO_TIET, lich_hoc.ID_NHOM_HP,nhom_hp.SISO_NHOM_HP, tiet_hoc.ID_TIET, lich_hoc.ID_LH
        				 				 FROM lich_hoc, nhom_hp, mon_hoc, phong, hocky_namhoc, tiet_hoc
               							 WHERE 
        								 lich_hoc.ID_NHOM_HP=nhom_hp.ID_NHOM_HP AND
        								 nhom_hp.MA_MH = mon_hoc.MA_MH AND
        								 lich_hoc.ID_PHONG = phong.ID_PHONG AND
        								 lich_hoc.ID_TIET = tiet_hoc.ID_TIET AND
        								 nhom_hp.ID_HKNH = hocky_namhoc.ID_HKNH AND
        								 nhom_hp.ID_NHOM_HP='$id_nhom_hp' AND
        								 lich_hoc.ID_TUAN='$id_tuan'
        								 GROUP BY lich_hoc.THU, tiet_hoc.ID_TIET
        								";
         				 $query = mysqli_query($conn,$sql);
        				 $sodong = mysqli_num_rows($query);
        				 //echo "$sodong";
          				  if($sodong>0){
          				  while($kq = mysqli_fetch_array($query)){ 
        	  				  echo "
        						    <tr>
                         	<td>$kq[THU]</td>
                         	<td>$kq[GIO_BD]</td>
                         	<td>$kq[SO_TIET]</td>
                         	<td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                        ";
        					  
        					  	echo "<td >
                              <a href=\"?khoatrang=gv_diemdanh_final_1&id_nhom_hp=$kq[ID_NHOM_HP]&id_tuan=$kq[ID_TUAN]&id_lh=$kq[ID_LH]\">
                                <img src=\"icon/xem.png\" style=\"width: 15px; height: 15px;\"/>
                              </a>
                            </td>
        						        <td >
                              <a href=\"?khoatrang=gv_sua&id_nhom_hp=$kq[ID_NHOM_HP]&id_tuan=$kq[ID_TUAN]&id_lh=$kq[ID_LH]\">
                                <img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"/>
                              </a>
                            </td>
        						        <td >
                              <a href=\"?khoatrang=gv_xoa&id_nhom_hp=$kq[ID_NHOM_HP]&id_tuan=$kq[ID_TUAN]&id_lh=$kq[ID_LH]\">
                                <img src=\"icon/del.png\" style=\"width: 15px; height: 15px;\"/ onclick=\"return checkxoa()\">
                              </a>
                            </td>
        							</tr>";
        				//	  	} //if so dong3
        				/* else {
        					 echo "
        					     <td>Không có dữ liệu</td>
        					 </tr>
        					 
        					 ";
        				 }*/
                  			 
        				 } //if so dong 
        				} //while
        				 else {
        					 echo "
        					 <tr>
        					     <td colspan='7'>Không có dữ liệu</td>
        					 </tr>
        					 
        					 ";
        				 }
        				} //if
        				?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" style="text-align: center">
              <a href="?khoatrang=gv_diemdanh&hocky=<?php echo $_GET['hocky'] ?>&namhoc=<?php echo $_GET['namhoc'] ?>">
                <button type="button" class="btn btn-default">Trở lại</button>
              </a>
              <a href="?khoatrang=gv_them&id_nhom_hp=<?php echo $id_nhom_hp ?>&id_tuan=<?php echo $id_tuan ?>&hocky=<?php echo $_GET['hocky'] ?>&namhoc=<?php echo $_GET['namhoc'] ?>">
                <button type="button" class="btn btn-info">Thêm nhóm</button>
              </a>
            </div>
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
 
</body>
</html>
