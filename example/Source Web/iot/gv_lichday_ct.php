<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  //if(isset($_GET['hocky'])){
	//  $hky=$_GET['hocky'];
	 // $nh=$_GET['namhoc'];
	//  $mamon=$_GET['mamon'];
	//  $mahp=$_GET['mahp'];
	//  }
 //echo "$hky $nh $mamon";
?>
<script language="javascript">
function isEmpty(ten)
{
	if (ten=="")
		return false;
	return true;
}
function ktra_lichday(hocky,namhoc){
	if(hocky=='default' && namhoc=='default'){
		alert ("Vui lòng chọn học kỳ, năm học!");
		return false;
	}
	return true;
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
				<span class="box-title" style="font-size:40px; margin-left: 0%;">CHI TIẾT LỊCH DẠY     
                </span>
                </br>
                <span class="box-title" style="font-size:30px; margin-left: 0%; font-style:italic">
               <?php if(isset($_GET["hocky"]) AND isset($_GET["namhoc"]) ){
			   			echo "Học kì " .$_GET["hocky"]." (".$_GET["namhoc"].")" ;
			         }
					 else if(isset($_GET["hocky"])){
			   			echo "Học kì " .$_GET["hocky"];
					 }
					 else if(isset($_GET["namhoc"])){
			   			echo "Năm học " .$_GET["namhoc"];
					 }
			   ?>
                </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                <tr>
                  <th>Thứ</th>
                  <th>Mã học phần</th>
                  <th>Mã nhóm</th>
                  <th>Tên học phần</th>
                  <th>Giờ học</th>
                  <th>Số tiết</th>
                  <th>Sỉ số</th>
                  <th>Phòng học</th>
                  <th>Tuần học</th>
                   <th>Danh sách</th>
                </tr>
                </thead>
                <tbody style="text-align:center;ss">
                <?php
				
				if(isset($_GET["hocky"]) AND isset($_GET["namhoc"]) )
				{
					$hk=$_GET["hocky"];
					//echo "Nhan duoc $hk";
					$namhoc = $_GET["namhoc"];
					//echo "Nam hoc $namhoc";
					$mahp=$_GET['mahp'];
				 $sql= "SELECT lich_hoc.THU, lich_hoc.SO_TIET, lich_hoc.ID_TUAN, lich_hoc.ID_NHOM_HP, mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP,phong.TEN_PHONG, mon_hoc.TEN_MH, phong.DIA_DIEM_PHONG, nhom_hp.SISO_NHOM_HP, tiet_hoc.GIO_BD, hocky_namhoc.ID_HKNH, tiet_hoc.ID_TIET, lich_hoc.ID_LH
				                 FROM lich_hoc, nhom_hp, mon_hoc, phong, hocky_namhoc, tiet_hoc
       							 WHERE 
								 lich_hoc.ID_NHOM_HP=nhom_hp.ID_NHOM_HP AND
								 nhom_hp.MA_MH = mon_hoc.MA_MH AND
								 lich_hoc.ID_PHONG = phong.ID_PHONG AND
								 lich_hoc.ID_TIET = tiet_hoc.ID_TIET AND
								 nhom_hp.ID_HKNH = hocky_namhoc.ID_HKNH AND
							 	 hocky_namhoc.HOCKY='$hk' AND 
			 					 hocky_namhoc.NAMHOC='$namhoc' AND
								 nhom_hp.TAIKHOAN_USER='$user' AND
								 lich_hoc.ID_NHOM_HP='$mahp'
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
                 			 <td>$kq[MA_MH]</td>
                 			 <td>$kq[MA_NHOM_HP]</td>
                 			 <td>$kq[TEN_MH]</td>
							 <td>$kq[GIO_BD]</td>
                 			 <td>$kq[SO_TIET]</td>
							 <td>$kq[SISO_NHOM_HP]</td>
                 			 <td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                 			 <td>
				     ";
					  
					  $sql3="SELECT lich_hoc.ID_TUAN FROM lich_hoc, tiet_hoc WHERE ID_NHOM_HP=$kq[ID_NHOM_HP] AND lich_hoc.THU= $kq[THU] AND lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND tiet_hoc.ID_TIET=$kq[ID_TIET]";
					  $query3=mysqli_query($conn,$sql3);
					  $sodong3 = mysqli_num_rows($query3);
					  if($sodong3>0){
  				 		$i=1;
  				 		while($kq3 = mysqli_fetch_array($query3)){
  				 			if($i<$sodong3){
  				 				echo "$kq3[ID_TUAN]-";
  				 			}
	  						else{
	  							echo "$kq3[ID_TUAN]";
	  						}
	  						$i++;
          			 	} //while kq3
					  	echo "</td>
						<td ><a href=\"?khoatrang=gv_danhsach&id_hknh=$kq[ID_HKNH]&id_nhomhp=$kq[ID_NHOM_HP]&id_lh=$kq[ID_LH]\"><img src=\"icon/chitiet.png\" style=\"width: 15px; height: 15px;\"</a></td>
							</tr>";
					  	} //if so dong3
				 else {
					 echo "
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
          			  } //while kq
					  } //if dong
					 else 
					 echo "
					   <tr>
					      <td>Không có dữ liệu</td>
					   </tr>  
						  ";
				} //if
				
				else if(isset($_GET["hocky"]))
				{
					$hk=$_GET["hocky"];
					//echo "Nhan duoc $hk";
					$mahp=$_GET['mahp'];
				 $sql= "SELECT lich_hoc.THU, lich_hoc.SO_TIET, lich_hoc.ID_TUAN, lich_hoc.ID_NHOM_HP, mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP,phong.TEN_PHONG, mon_hoc.TEN_MH, phong.DIA_DIEM_PHONG, nhom_hp.SISO_NHOM_HP, tiet_hoc.GIO_BD, hocky_namhoc.ID_HKNH, tiet_hoc.ID_TIET, lich_hoc.ID_LH
				                 FROM lich_hoc, nhom_hp, mon_hoc, phong, hocky_namhoc, tiet_hoc
       							 WHERE 
								 lich_hoc.ID_NHOM_HP=nhom_hp.ID_NHOM_HP AND
								 nhom_hp.MA_MH = mon_hoc.MA_MH AND
								 lich_hoc.ID_PHONG = phong.ID_PHONG AND
								 lich_hoc.ID_TIET = tiet_hoc.ID_TIET AND
								 nhom_hp.ID_HKNH = hocky_namhoc.ID_HKNH AND
							 	 hocky_namhoc.HOCKY='$hk' AND 
								 nhom_hp.TAIKHOAN_USER='$user' AND
								 lich_hoc.ID_NHOM_HP='$mahp'
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
                 			 <td>$kq[MA_MH]</td>
                 			 <td>$kq[MA_NHOM_HP]</td>
                 			 <td>$kq[TEN_MH]</td>
							 <td>$kq[GIO_BD]</td>
                 			 <td>$kq[SO_TIET]</td>
							 <td>$kq[SISO_NHOM_HP]</td>
                 			 <td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                 			 <td>
				     ";
					  
					  $sql3="SELECT lich_hoc.ID_TUAN FROM lich_hoc, tiet_hoc WHERE ID_NHOM_HP=$kq[ID_NHOM_HP] AND lich_hoc.THU= $kq[THU] AND lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND tiet_hoc.ID_TIET=$kq[ID_TIET]";
					  $query3=mysqli_query($conn,$sql3);
					  $sodong3 = mysqli_num_rows($query3);
					  if($sodong3>0){
  				 		$i=1;
  				 		while($kq3 = mysqli_fetch_array($query3)){
  				 			if($i<$sodong3){
  				 				echo "$kq3[ID_TUAN]-";
  				 			}
	  						else{
	  							echo "$kq3[ID_TUAN]";
	  						}
	  						$i++;
          			 	} //while kq3
					  	echo "</td>
						<td ><a href=\"?khoatrang=gv_danhsach&id_hknh=$kq[ID_HKNH]&id_nhomhp=$kq[ID_NHOM_HP]&id_lh=$kq[ID_LH]\"><img src=\"icon/chitiet.png\" style=\"width: 15px; height: 15px;\"</a></td>
							</tr>";
					  	} //if so dong3
				 else {
					 echo "
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
          			  } //while kq
					  } //if dong
					 else 
					 echo "
					   <tr>
					      <td>Không có dữ liệu</td>
					   </tr>  
						  ";
				} //if
				else if(isset($_GET["namhoc"]) )
				{
					$namhoc = $_GET["namhoc"];
					//echo "Nam hoc $namhoc";
					$mahp=$_GET['mahp'];
				 $sql= "SELECT lich_hoc.THU, lich_hoc.SO_TIET, lich_hoc.ID_TUAN, lich_hoc.ID_NHOM_HP, mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP,phong.TEN_PHONG, mon_hoc.TEN_MH, phong.DIA_DIEM_PHONG, nhom_hp.SISO_NHOM_HP,tiet_hoc.GIO_BD, hocky_namhoc.ID_HKNH, tiet_hoc.ID_TIET, lich_hoc.ID_LH
				                 FROM lich_hoc, nhom_hp, mon_hoc, phong, hocky_namhoc, tiet_hoc
       							 WHERE 
								 lich_hoc.ID_NHOM_HP=nhom_hp.ID_NHOM_HP AND
								 nhom_hp.MA_MH = mon_hoc.MA_MH AND
								 lich_hoc.ID_PHONG = phong.ID_PHONG AND
								 lich_hoc.ID_TIET = tiet_hoc.ID_TIET AND
								 nhom_hp.ID_HKNH = hocky_namhoc.ID_HKNH AND
			 					 hocky_namhoc.NAMHOC='$namhoc' AND
								 nhom_hp.TAIKHOAN_USER='$user' AND
								 lich_hoc.ID_NHOM_HP='$mahp'
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
                 			 <td>$kq[MA_MH]</td>
                 			 <td>$kq[MA_NHOM_HP]</td>
                 			 <td>$kq[TEN_MH]</td>
							 <td>$kq[GIO_BD]</td>
                 			 <td>$kq[SO_TIET]</td>
							 <td>$kq[SISO_NHOM_HP]</td>
                 			 <td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                 			 <td>
				     ";
					  
					  $sql3="SELECT lich_hoc.ID_TUAN FROM lich_hoc, tiet_hoc WHERE ID_NHOM_HP=$kq[ID_NHOM_HP] AND lich_hoc.THU= $kq[THU] AND lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND tiet_hoc.ID_TIET=$kq[ID_TIET]";
					  $query3=mysqli_query($conn,$sql3);
					  $sodong3 = mysqli_num_rows($query3);
					  if($sodong3>0){
  				 		$i=1;
  				 		while($kq3 = mysqli_fetch_array($query3)){
  				 			if($i<$sodong3){
  				 				echo "$kq3[ID_TUAN]-";
  				 			}
	  						else{
	  							echo "$kq3[ID_TUAN]";
	  						}
	  						$i++;
          			 	} //while kq3
					  	echo "</td>
						<td ><a href=\"?khoatrang=gv_danhsach&id_hknh=$kq[ID_HKNH]&id_nhomhp=$kq[ID_NHOM_HP]&id_lh=$kq[ID_LH]\"><img src=\"icon/chitiet.png\" style=\"width: 15px; height: 15px;\"</a></td>
							</tr>";
					  	} //if so dong3
				 else {
					 echo "
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
          			  } //while kq
					  } //if dong
					 else 
					 echo "
					   <tr>
					      <td>Không có dữ liệu</td>
					   </tr>  
						  ";
				} //if
				?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer" style="text-align: center">
              <button onClick="window.history.go(-1)" type="button" class="btn btn-default">Trở lại</button>
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
