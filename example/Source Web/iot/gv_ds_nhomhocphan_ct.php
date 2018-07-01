<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  
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
				<span class="box-title" style="font-size:40px; margin-left: 5%;">CHI TIẾT DANH SÁCH NHÓM HỌC PHẦN
                </span></br>
                <span class="box-title" style="font-size:30px; margin-left: 10%; font-style:italic">
                <?php if(isset($_GET["hocky"]) AND isset($_GET["namhoc"]) ){
			   			echo "Học kì " .$_GET["hocky"]." (".$_GET["namhoc"].")" ;
			         }
					 else if(isset($_GET["hocky"])){
			   			echo "Học kì " .$_GET["hocky"];
					 }
					 else if(isset($_GET["namhoc"])){
			   			echo "Năm học " .$_GET["namhoc"];
					 }
					 else if(isset($_GET["txttenmon"])){
			   			echo "Môn học: " .$_GET["txttenmon"];
					 }
			   ?> </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                <tr>
                  <th>Học phần</th>
                  <th>Mã nhóm</th>
                  <th>Thứ</th>
                  <th>Tiết bắt đầu</th>
                  <th>Số tiết</th>
                  <th>Phòng học</th>
                  <th>Tuần học</th>
                  <th>Sỉ số lớp</th>
                  <th>Xem danh sách lớp</th>
				</tr>
                </thead>
                <tbody style="text-align:center;ss">
                <?php
				
				if(isset($_GET["hocky"]) AND isset($_GET["txttenmon"]) AND isset($_GET["namhoc"]) )
				{
					$hk=$_GET["hocky"];
					//echo "Nhan duoc $hk";
					$namhoc = $_GET["namhoc"];
					//echo "Nam hoc $namhoc";
					$tenmon = $_GET["txttenmon"];
					$mahp=$_GET['mahp'];
				 $sql= "SELECT mon_hoc.TEN_MH, nhom_hp.MA_NHOM_HP, lich_hoc.THU, tiet_hoc.GIO_BD, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, lich_hoc.ID_TUAN ,lich_hoc.SO_TIET, lich_hoc.ID_NHOM_HP,nhom_hp.SISO_NHOM_HP, tiet_hoc.ID_TIET
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
								 mon_hoc.TEN_MH like '%$tenmon%' AND
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
				 			 <td>$kq[TEN_MH]</td>
                 			 <td>$kq[MA_NHOM_HP]</td>
                 			 <td>$kq[THU]</td>
                 			 <td>$kq[GIO_BD]</td>
                 			 <td>$kq[SO_TIET]</td>
                 			 <td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                 			<td>
				     ";
					  
					  $sql3="SELECT lich_hoc.ID_TUAN FROM lich_hoc, tiet_hoc WHERE ID_NHOM_HP=$kq[ID_NHOM_HP] AND lich_hoc.THU= $kq[THU] AND lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND tiet_hoc.ID_TIET=$kq[ID_TIET]";
					  $query3=mysqli_query($conn,$sql3);
					  $sodong3 = mysqli_num_rows($query3);
					  if($sodong3>0){
  				 	while($kq3 = mysqli_fetch_array($query3)){
	  					echo "
				 			 $kq3[ID_TUAN]-
				    	 ";
          			 	 } //while kq3
					  	echo "</td>
						<td >$kq[SISO_NHOM_HP]</td>
						<td ><a href=\"?khoatrang=gv_diemdanh_ct&id_nhom_hp=$kq[ID_NHOM_HP]\"><img src=\"icon/xem.png\" style=\"width: 15px; height: 15px;\"/></a></td>
							</tr>";
					  	} //if so dong3
				 else {
					 echo "
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
          			  } //while kq
				 } //if so dong
				 else {
					 echo "
					 <tr>
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
				} //if
				

				else if(isset($_GET["hocky"]) AND isset($_GET["namhoc"]) )
				{
					$hk=$_GET["hocky"];
					//echo "Nhan duoc $hk";
					$namhoc = $_GET["namhoc"];
					//echo "Nam hoc $namhoc";
					$mahp=$_GET['mahp'];
				 $sql= "SELECT mon_hoc.TEN_MH, nhom_hp.MA_NHOM_HP, lich_hoc.THU, tiet_hoc.GIO_BD, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, lich_hoc.ID_TUAN ,lich_hoc.SO_TIET,lich_hoc.ID_NHOM_HP,nhom_hp.SISO_NHOM_HP, tiet_hoc.ID_TIET
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
  				 if($sodong>0){
  				 while($kq = mysqli_fetch_array($query)){
	  				echo "
						<tr>
				 			 <td>$kq[TEN_MH]</td>
                 			 <td>$kq[MA_NHOM_HP]</td>
                 			 <td>$kq[THU]</td>
                 			 <td>$kq[GIO_BD]</td>
                 			 <td>$kq[SO_TIET]</td>
                 			 <td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                 			 <td>
				     ";
					  
					  $sql3="SELECT lich_hoc.ID_TUAN FROM lich_hoc, tiet_hoc WHERE ID_NHOM_HP=$kq[ID_NHOM_HP] AND lich_hoc.THU= $kq[THU] AND lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND tiet_hoc.ID_TIET=$kq[ID_TIET]";
					  $query3=mysqli_query($conn,$sql3);
					  $sodong3 = mysqli_num_rows($query3);
					  if($sodong3>0){
  				 	while($kq3 = mysqli_fetch_array($query3)){
	  					echo "
				 			 $kq3[ID_TUAN]-
				    	 ";
          			 	 } //while kq3
					  	echo "</td>
						<td >$kq[SISO_NHOM_HP]</td>
						<td ><a href=\"?khoatrang=gv_diemdanh_ct&id_nhom_hp=$kq[ID_NHOM_HP]\"><img src=\"icon/xem.png\" style=\"width: 15px; height: 15px;\"/></a></td>
							</tr>";
					  	} //if so dong3
				 else {
					 echo "
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
          			  } //while kq
				 } //if so dong
				 else {
					 echo "
					 <tr>
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
				} //if

				else if(isset($_GET["txttenmon"]) )
				{
					$tenmon =$_GET['txttenmon'];
					//echo "$tenmon";
					$mahp=$_GET['mahp'];
				 $sql= "SELECT mon_hoc.TEN_MH, nhom_hp.MA_NHOM_HP, lich_hoc.THU, tiet_hoc.GIO_BD, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, lich_hoc.ID_TUAN, lich_hoc.SO_TIET,lich_hoc.ID_NHOM_HP,nhom_hp.SISO_NHOM_HP, tiet_hoc.ID_TIET
				 				 FROM lich_hoc, nhom_hp, mon_hoc, phong, hocky_namhoc, tiet_hoc
       							 WHERE 
								 lich_hoc.ID_NHOM_HP=nhom_hp.ID_NHOM_HP AND
								 nhom_hp.MA_MH = mon_hoc.MA_MH AND
								 lich_hoc.ID_PHONG = phong.ID_PHONG AND
								 lich_hoc.ID_TIET = tiet_hoc.ID_TIET AND
								 nhom_hp.ID_HKNH = hocky_namhoc.ID_HKNH AND
								 mon_hoc.TEN_MH like '%$tenmon%' AND
								 lich_hoc.ID_NHOM_HP='$mahp'
								 GROUP BY lich_hoc.THU, tiet_hoc.ID_TIET
								";
 				 $query = mysqli_query($conn,$sql);
				 $sodong = mysqli_num_rows($query);
				 if($sodong>0){
  				 while($kq = mysqli_fetch_array($query)){
	  				echo "
						<tr>
				 			 <td>$kq[TEN_MH]</td>
                 			 <td>$kq[MA_NHOM_HP]</td>
                 			 <td>$kq[THU]</td>
                 			 <td>$kq[GIO_BD]</td>
                 			 <td>$kq[SO_TIET]</td>
                 			 <td>$kq[TEN_PHONG]-$kq[DIA_DIEM_PHONG]</td>
                 			 <td>
				     ";
					  
					  $sql3="SELECT lich_hoc.ID_TUAN FROM lich_hoc, tiet_hoc WHERE ID_NHOM_HP=$kq[ID_NHOM_HP] AND lich_hoc.THU= $kq[THU] AND lich_hoc.ID_TIET=tiet_hoc.ID_TIET AND tiet_hoc.ID_TIET=$kq[ID_TIET]";
					  $query3=mysqli_query($conn,$sql3);
					  $sodong3 = mysqli_num_rows($query3);
					  if($sodong3>0){
  				 	while($kq3 = mysqli_fetch_array($query3)){
	  					echo "
				 			 $kq3[ID_TUAN]-
				    	 ";
          			 	 } //while kq3
					  	echo "</td>
						<td >$kq[SISO_NHOM_HP]</td>
						<td ><a href=\"?khoatrang=gv_diemdanh_ct&id_nhom_hp=$kq[ID_NHOM_HP]\"><img src=\"icon/xem.png\" style=\"width: 15px; height: 15px;\"/></a></td>
							</tr>";
					  	} //if so dong3
				 else {
					 echo "
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
          			  } //while kq
				 } //if so dong
				 else {
					 echo "
					 <tr>
					     <td>Không có dữ liệu</td>
					 </tr>
					 
					 ";
				 }
				} //if
				?>

                </tfoot>
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
 
</body>
</html>
