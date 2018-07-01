<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  date_default_timezone_set("Asia/Ho_Chi_Minh");
  $date=date("d/m/Y-H:i:s");
  
?>
<script language="javascript">
function isEmpty(ten)
{
	if (ten=="")
		return false;
	return true;
}
function ktra(hocky,namhoc, monhoc){
	if((hocky=='default' && namhoc=='default' && monhoc=="") || 
	(monhoc!="" && namhoc!='default' && hocky=='default' ) || (monhoc!="" && hocky!='default' && namhoc=='default' )){
		alert ("Vui lòng nhập tên môn học hoặc chọn học kỳ, năm học!");
		return false;
	}
	return true;
}
function ktra_check(dd){
	if(dd=="" ){
		alert ("Vui lòng nhập check điểm danh!");
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
            <form class="form-horizontal" method="post" action="#" onSubmit="return ktra(hocky.value, namhoc.value, txttenmon.value);">
              <div class="box-body">
                <div class="form-group">
                  <label for="txttenmon" class="col-sm-2 control-label">Môn học</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="txttenmon" placeholder="Tên môn học">
                  </div>
                </div>
                <div class="form-group">
                  <label for="txthocky" class="col-sm-2 control-label">Học kỳ</label>

                  <div class="col-sm-10">
                  <select name="hocky" style="width: 100%; height: 35px; margin: 2px;">
                    	<option disabled="true" selected="true" value="default" >Chọn học kỳ</option>
                  <?php 
				  $sql1= "SELECT DISTINCT HOCKY FROM nhom_hp, hocky_namhoc WHERE nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH AND nhom_hp.TAIKHOAN_USER='$user'";
 			 	  $query1 = mysqli_query($conn,$sql1);
 			      while($kq1 = mysqli_fetch_array($query1)){
	  			 echo " 
                    	<option value='$kq1[HOCKY]' >$kq1[HOCKY]</option>
                    	
                   ";
 					 }
				  ?>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="txtnamhoc" class="col-sm-2 control-label">Năm học</label>

                  <div class="col-sm-10">
                  <select name="namhoc" style="width: 100%; height: 35px; margin: 2px;">
                    		<option disabled="true" selected="true" value="default" >Chọn năm học</option>
                    <?php 
				 		 $sql2= "SELECT DISTINCT NAMHOC FROM nhom_hp, hocky_namhoc WHERE nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH AND nhom_hp.TAIKHOAN_USER='$user'";
 			 	  		 $query2 = mysqli_query($conn,$sql2);
 			     		 while($kq2 = mysqli_fetch_array($query2)){
	  			 		echo "
                    		<option value='$kq2[NAMHOC]' >$kq2[NAMHOC]</option>
                    		
							";
 					 }
				  ?>
                  </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="text-align: center">
                <button type="submit" class="btn btn-info pull-center" style="text-align: center">Tìm kiếm</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        
      </form>
            
				<span class="box-title" style="font-size:40px; margin-left: 27%;">DANH SÁCH ĐIỂM DANH</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                <tr>
                  <th>Học phần</th>
                  <th>Mã nhóm</th>
                  <th>Ngày</th>
                  <th>MSSV</th>
                  <th>Tên</th>
                  <th>Phòng học</th>
                  <th>Check</th>
                  <th>Cập nhật</th>
				</tr>
                </thead>
                <tbody style="text-align:center;ss">
               <?php
			   if(isset($_POST["diem_danh"]) AND isset($_POST["hocky"]) AND isset($_POST["namhoc"]) AND isset($_POST["txttenmon"])){
					$diem_danh=$_POST["diem_danh"];
					$id_user=$_POST["id_user"];
					$hk=$_POST["hocky"];
					//echo "Nhan duoc $hk";
					$namhoc= $_POST["namhoc"];
					//echo "Nam hoc $namhoc";
					$tenmon = $_POST["txttenmon"];
					//echo "$diem_danh $id_user";
					$sql3="UPDATE danh_sach_diem_danh SET CHECK_DIEMDANH='$diem_danh' WHERE TAIKHOAN_USER='$id_user'";			
					$query=mysqli_query($conn,$sql3);
					$tacdong = mysqli_affected_rows($conn);
					if($tacdong > 0){
						echo "<script> alert(\"Cập nhật thành công!\");</script>";
						}		
				 	$sql= "SELECT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, lich_hoc.NGAY_HOC, sinh_vien.TAIKHOAN_USER, 				sinh_vien.HOTEN_USER, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, danh_sach_diem_danh.CHECK_DIEMDANH
				       					   FROM sinh_vien,  lich_hoc, nhom_hp, hocky_namhoc, danh_sach_diem_danh, phong, mon_hoc
											WHERE sinh_vien.TAIKHOAN_USER=danh_sach_diem_danh.TAIKHOAN_USER AND
										  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
                              				danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH AND
                              				phong.ID_PHONG=lich_hoc.ID_PHONG AND
							  				mon_hoc.MA_MH=nhom_hp.MA_MH AND
							  				hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
							  				hocky_namhoc.HOCKY='$hk' AND
							  				hocky_namhoc.NAMHOC='$namhoc' AND
							  				mon_hoc.TEN_MH like '%$tenmon%'
											";
				 					 $sql1= "SELECT * FROM lich_hoc, nhom_hp, hocky_namhoc, mon_hoc
						  					WHERE nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
											  mon_hoc.MA_MH=nhom_hp.MA_MH AND
											  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
											  hocky_namhoc.ID_HKNH='' AND
											  nhom_hp.ID_NHOM_HP=''
												";
 				 
				// $query1 = mysqli_query($conn,$sql1);
				// $kq1 = mysqli_fetch_array($query1);
				// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 27%;\">GV: $kq1[TAIKHOAN_USER] &emsp;</span>";
				// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 10%;\">Học phần: $kq1[MA_MH] - $kq1[TEN_MH]</span></br>";
									 echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 60%; font-style:italic\">Cập nhật ngày: $date</span>";
									 $query = mysqli_query($conn,$sql);
									 $sodong = mysqli_num_rows($query);
									 if($sodong>0){
									 while($kq = mysqli_fetch_array($query)){
										echo "
											<tr>
												 <td>$kq[MA_MH]</td>
												 <td>$kq[MA_NHOM_HP]</td>
												 <td>$kq[NGAY_HOC]</td>
												 <td>$kq[TAIKHOAN_USER]</td>
												 <td>$kq[HOTEN_USER]</td>
												 <td>$kq[TEN_PHONG]/$kq[DIA_DIEM_PHONG]</td>
												 <form method=\"post\" action=\"#\" onSubmit=\"return ktra_check(diem_danh.value);\">
												 <td>
												 	<input type=\"hidden\" name=\"hocky\" value='$hk' style=\"width:30px\" />
													<input type=\"hidden\" name=\"namhoc\" value='$namhoc' style=\"width:30px\" />
													<input type=\"hidden\" name=\"txttenmon\" value='$tenmon' style=\"width:30px\" />
													<input type=\"hidden\" name=\"id_user\" value='$kq[TAIKHOAN_USER]' style=\"width:30px\" />
													<input type=\"text\" name=\"diem_danh\" value='$kq[CHECK_DIEMDANH]' style=\"width:30px\" />  
												</td>
												 <td ><button type=\"submit\" class=\"btn btn-info pull-center\" style=\"text-align: center\"><img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"></button></td></form>
											</tr>
										 ";
										 } //while
										  } //if dong
										   else 
										 echo "
										   <tr>
											  <td>Không có dữ liệu</td>
										   </tr>  
											  ";
									} //if (isset($_POST["diem_danh"]) AND isset($_POST["hocky"]) AND isset($_POST["namhoc"]) AND isset($_POST["txttenmon"]))
									else if(isset($_POST["diem_danh"]) AND isset($_POST["hocky"]) AND isset($_POST["namhoc"]) )
									{
										$diem_danh=$_POST["diem_danh"];
										$id_user=$_POST["id_user"];
										$hk=$_POST["hocky"];
										//echo "Nhan duoc $hk";
										$namhoc= $_POST["namhoc"];
										//echo "Nam hoc $namhoc";
										$sql3="UPDATE danh_sach_diem_danh SET CHECK_DIEMDANH='$diem_danh' WHERE TAIKHOAN_USER='$id_user'";			
										$query=mysqli_query($conn,$sql3);
										$tacdong = mysqli_affected_rows($conn);
										if($tacdong > 0){
											echo "<script> alert(\"Cập nhật thành công!\");</script>";
											}		
									 $sql= "SELECT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, lich_hoc.NGAY_HOC, sinh_vien.TAIKHOAN_USER, sinh_vien.HOTEN_USER, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, danh_sach_diem_danh.CHECK_DIEMDANH
											FROM sinh_vien,  lich_hoc, nhom_hp, hocky_namhoc, danh_sach_diem_danh, phong, mon_hoc
											WHERE sinh_vien.TAIKHOAN_USER=danh_sach_diem_danh.TAIKHOAN_USER AND
												  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH AND
												  phong.ID_PHONG=lich_hoc.ID_PHONG AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  hocky_namhoc.HOCKY='$hk' AND
												  hocky_namhoc.NAMHOC='$namhoc'
													";
									  $sql1= "SELECT * FROM lich_hoc, nhom_hp, hocky_namhoc, mon_hoc
											  WHERE nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  hocky_namhoc.ID_HKNH='' AND
												  nhom_hp.ID_NHOM_HP=''
													";
									 
									// $query1 = mysqli_query($conn,$sql1);
									// $kq1 = mysqli_fetch_array($query1);
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 27%;\">GV: $kq1[TAIKHOAN_USER] &emsp;</span>";
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 10%;\">Học phần: $kq1[MA_MH] - $kq1[TEN_MH]</span></br>";
									 echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 60%; font-style:italic\">Cập nhật ngày: $date</span>";
									 $query = mysqli_query($conn,$sql);
									 $sodong = mysqli_num_rows($query);
									 if($sodong>0){
									 while($kq = mysqli_fetch_array($query)){
										echo "
											<tr>
												 <td>$kq[MA_MH]</td>
												 <td>$kq[MA_NHOM_HP]</td>
												 <td>$kq[NGAY_HOC]</td>
												 <td>$kq[TAIKHOAN_USER]</td>
												 <td>$kq[HOTEN_USER]</td>
												 <td>$kq[TEN_PHONG]/$kq[DIA_DIEM_PHONG]</td>
												 <td>
												 	<input type=\"hidden\" name=\"hocky\" value='$hk' style=\"width:30px\" />
													<input type=\"hidden\" name=\"namhoc\" value='$namhoc' style=\"width:30px\" />
													<input type=\"hidden\" name=\"id_user\" value='$kq[TAIKHOAN_USER]' style=\"width:30px\" />
													<input type=\"text\" name=\"diem_danh\" value='$kq[CHECK_DIEMDANH]' style=\"width:30px\" />  
												</td>
												 <td ><button type=\"submit\" class=\"btn btn-info pull-center\" style=\"text-align: center\"><img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"></button></td></form>
											</tr>
										 ";
										 } //while
										  } //if dong
										  else 
										 echo "
										   <tr>
											  <td>Không có dữ liệu</td>
										   </tr>  
											  ";
									} //if (isset($_POST["diem_danh"]) AND isset($_POST["hocky"]) AND isset($_POST["namhoc"]) )
								else if(isset($_POST["diem_danh"]) AND isset($_POST["txttenmon"]))
									{$diem_danh=$_POST["diem_danh"];
										$id_user=$_POST["id_user"];
										$tenmon= $_POST["txttenmon"];
										$sql3="UPDATE danh_sach_diem_danh SET CHECK_DIEMDANH='$diem_danh' WHERE TAIKHOAN_USER='$id_user'";			
										$query=mysqli_query($conn,$sql3);
										$tacdong = mysqli_affected_rows($conn);
										if($tacdong > 0){
											echo "<script> alert(\"Cập nhật thành công!\");</script>";
											}		
									 $sql= "SELECT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, lich_hoc.NGAY_HOC, sinh_vien.TAIKHOAN_USER, sinh_vien.HOTEN_USER, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, danh_sach_diem_danh.CHECK_DIEMDANH
											FROM sinh_vien,  lich_hoc, nhom_hp, hocky_namhoc, danh_sach_diem_danh, phong, mon_hoc
											WHERE sinh_vien.TAIKHOAN_USER=danh_sach_diem_danh.TAIKHOAN_USER AND
												  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH AND
												  phong.ID_PHONG=lich_hoc.ID_PHONG AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  mon_hoc.TEN_MH like '%$tenmon%'
													";
									  $sql1= "SELECT * FROM lich_hoc, nhom_hp, hocky_namhoc, mon_hoc
											  WHERE nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  hocky_namhoc.ID_HKNH='' AND
												  nhom_hp.ID_NHOM_HP=''
													";
									 
									// $query1 = mysqli_query($conn,$sql1);
									// $kq1 = mysqli_fetch_array($query1);
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 27%;\">GV: $kq1[TAIKHOAN_USER] &emsp;</span>";
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 10%;\">Học phần: $kq1[MA_MH] - $kq1[TEN_MH]</span></br>";
									 echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 60%; font-style:italic\">Cập nhật ngày: $date</span>";
									 $query = mysqli_query($conn,$sql);
									 $sodong = mysqli_num_rows($query);
									if($sodong>0){
									 while($kq = mysqli_fetch_array($query)){
					
										echo "
											<tr>
												 <td>$kq[MA_MH]</td>
												 <td>$kq[MA_NHOM_HP]</td>
												 <td>$kq[NGAY_HOC]</td>
												 <td>$kq[TAIKHOAN_USER]</td>
												 <td>$kq[HOTEN_USER]</td>
												 <td>$kq[TEN_PHONG]/$kq[DIA_DIEM_PHONG]</td>
												 <form method=\"post\" action=\"#\" onSubmit=\"return ktra_check(diem_danh.value);\">
												 <td>
													<input type=\"hidden\" name=\"txttenmon\" value='$tenmon' style=\"width:30px\" />
													<input type=\"hidden\" name=\"id_user\" value='$kq[TAIKHOAN_USER]' style=\"width:30px\" />
													<input type=\"text\" name=\"diem_danh\" value='$kq[CHECK_DIEMDANH]' style=\"width:30px\" />  
												</td>
												 <td ><button type=\"submit\" class=\"btn btn-info pull-center\" style=\"text-align: center\"><img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"></button></td></form>
											</tr>
										 ";
										 } //while
										  } //if dong
										  else 
										 echo "
										   <tr>
											  <td>Không có dữ liệu</td>
										   </tr>  
											  ";
									} //if (isset($_POST["diem_danh"]) AND isset($_POST["txttenmon"]))
						else if(isset($_POST["hocky"]) AND isset($_POST["namhoc"]) AND isset($_POST["txttenmon"])){
											$hk=$_POST["hocky"];
											//echo "Nhan duoc $hk";
											$namhoc= $_POST["namhoc"];
											//echo "Nam hoc $namhoc";
											$tenmon = $_POST["txttenmon"];
											//echo "$diem_danh $id_user";
											$sql= "SELECT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, lich_hoc.NGAY_HOC, sinh_vien.TAIKHOAN_USER, 				sinh_vien.HOTEN_USER, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, danh_sach_diem_danh.CHECK_DIEMDANH
				       					   FROM sinh_vien,  lich_hoc, nhom_hp, hocky_namhoc, danh_sach_diem_danh, phong, mon_hoc
											WHERE sinh_vien.TAIKHOAN_USER=danh_sach_diem_danh.TAIKHOAN_USER AND
										  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
                              				danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH AND
                              				phong.ID_PHONG=lich_hoc.ID_PHONG AND
							  				mon_hoc.MA_MH=nhom_hp.MA_MH AND
							  				hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
							  				hocky_namhoc.HOCKY='$hk' AND
							  				hocky_namhoc.NAMHOC='$namhoc' AND
							  				mon_hoc.TEN_MH like '%$tenmon%'
											";
				 					 $sql1= "SELECT * FROM lich_hoc, nhom_hp, hocky_namhoc, mon_hoc
						  					WHERE nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
											  mon_hoc.MA_MH=nhom_hp.MA_MH AND
											  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
											  hocky_namhoc.ID_HKNH='' AND
											  nhom_hp.ID_NHOM_HP=''
												";
 				 
				// $query1 = mysqli_query($conn,$sql1);
				// $kq1 = mysqli_fetch_array($query1);
				// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 27%;\">GV: $kq1[TAIKHOAN_USER] &emsp;</span>";
				// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 10%;\">Học phần: $kq1[MA_MH] - $kq1[TEN_MH]</span></br>";
									 echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 60%; font-style:italic\">Cập nhật ngày: $date</span>";
									 $query = mysqli_query($conn,$sql);
									 $sodong = mysqli_num_rows($query);
									 if($sodong>0){
									 while($kq = mysqli_fetch_array($query)){
										echo "
											<tr>
												 <td>$kq[MA_MH]</td>
												 <td>$kq[MA_NHOM_HP]</td>
												 <td>$kq[NGAY_HOC]</td>
												 <td>$kq[TAIKHOAN_USER]</td>
												 <td>$kq[HOTEN_USER]</td>
												 <td>$kq[TEN_PHONG]/$kq[DIA_DIEM_PHONG]</td>
												 <form method=\"post\" action=\"#\" onSubmit=\"return ktra_check(diem_danh.value);\">
												 <td>
												 	<input type=\"hidden\" name=\"hocky\" value='$hk' style=\"width:30px\" />
													<input type=\"hidden\" name=\"namhoc\" value='$namhoc' style=\"width:30px\" />
													<input type=\"hidden\" name=\"txttenmon\" value='$tenmon' style=\"width:30px\" />
													<input type=\"hidden\" name=\"id_user\" value='$kq[TAIKHOAN_USER]' style=\"width:30px\" />
													<input type=\"text\" name=\"diem_danh\" value='$kq[CHECK_DIEMDANH]' style=\"width:30px\" />  
												</td>
												 <td ><button type=\"submit\" class=\"btn btn-info pull-center\" style=\"text-align: center\"><img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"></button></td></form>
											</tr>
										 ";
										 } //while
										  } //if dong
										   else 
										 echo "
										   <tr>
											  <td>Không có dữ liệu</td>
										   </tr>  
											  ";
									} //if (isset($_POST["diem_danh"]) AND isset($_POST["hocky"]) AND isset($_POST["namhoc"]) AND isset($_POST["txttenmon"]))
									else if(isset($_POST["hocky"]) AND isset($_POST["namhoc"]) )
									{
										$hk=$_POST["hocky"];
										//echo "Nhan duoc $hk";
										$namhoc= $_POST["namhoc"];
									 $sql= "SELECT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, lich_hoc.NGAY_HOC, sinh_vien.TAIKHOAN_USER, sinh_vien.HOTEN_USER, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, danh_sach_diem_danh.CHECK_DIEMDANH
											FROM sinh_vien,  lich_hoc, nhom_hp, hocky_namhoc, danh_sach_diem_danh, phong, mon_hoc
											WHERE sinh_vien.TAIKHOAN_USER=danh_sach_diem_danh.TAIKHOAN_USER AND
												  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH AND
												  phong.ID_PHONG=lich_hoc.ID_PHONG AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  hocky_namhoc.HOCKY='$hk' AND
												  hocky_namhoc.NAMHOC='$namhoc'
													";
									  $sql1= "SELECT * FROM lich_hoc, nhom_hp, hocky_namhoc, mon_hoc
											  WHERE nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  hocky_namhoc.ID_HKNH='' AND
												  nhom_hp.ID_NHOM_HP=''
													";
									 
									// $query1 = mysqli_query($conn,$sql1);
									// $kq1 = mysqli_fetch_array($query1);
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 27%;\">GV: $kq1[TAIKHOAN_USER] &emsp;</span>";
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 10%;\">Học phần: $kq1[MA_MH] - $kq1[TEN_MH]</span></br>";
									 echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 60%; font-style:italic\">Cập nhật ngày: $date</span>";
									 $query = mysqli_query($conn,$sql);
									 $sodong = mysqli_num_rows($query);
									 if($sodong>0){
									 while($kq = mysqli_fetch_array($query)){
										echo "
											<tr>
												 <td>$kq[MA_MH]</td>
												 <td>$kq[MA_NHOM_HP]</td>
												 <td>$kq[NGAY_HOC]</td>
												 <td>$kq[TAIKHOAN_USER]</td>
												 <td>$kq[HOTEN_USER]</td>
												 <td>$kq[TEN_PHONG]/$kq[DIA_DIEM_PHONG]</td>
												 <td>
												 	<input type=\"hidden\" name=\"hocky\" value='$hk' style=\"width:30px\" />
													<input type=\"hidden\" name=\"namhoc\" value='$namhoc' style=\"width:30px\" />
													<input type=\"hidden\" name=\"id_user\" value='$kq[TAIKHOAN_USER]' style=\"width:30px\" />
													<input type=\"text\" name=\"diem_danh\" value='$kq[CHECK_DIEMDANH]' style=\"width:30px\" />  
												</td>
												 <td ><button type=\"submit\" class=\"btn btn-info pull-center\" style=\"text-align: center\"><img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"></button></td></form>
											</tr>
										 ";
										 } //while
										  } //if dong
										  else 
										 echo "
										   <tr>
											  <td>Không có dữ liệu</td>
										   </tr>  
											  ";
									} //if (isset($_POST["diem_danh"]) AND isset($_POST["hocky"]) AND isset($_POST["namhoc"]) )
								else if(isset($_POST["txttenmon"]))
									{
										$tenmon= $_POST["txttenmon"];	
									 $sql= "SELECT mon_hoc.MA_MH, nhom_hp.MA_NHOM_HP, lich_hoc.NGAY_HOC, sinh_vien.TAIKHOAN_USER, sinh_vien.HOTEN_USER, phong.TEN_PHONG, phong.DIA_DIEM_PHONG, danh_sach_diem_danh.CHECK_DIEMDANH
											FROM sinh_vien,  lich_hoc, nhom_hp, hocky_namhoc, danh_sach_diem_danh, phong, mon_hoc
											WHERE sinh_vien.TAIKHOAN_USER=danh_sach_diem_danh.TAIKHOAN_USER AND
												  nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  danh_sach_diem_danh.ID_LH=lich_hoc.ID_LH AND
												  phong.ID_PHONG=lich_hoc.ID_PHONG AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  mon_hoc.TEN_MH like '%$tenmon%'
													";
									  $sql1= "SELECT * FROM lich_hoc, nhom_hp, hocky_namhoc, mon_hoc
											  WHERE nhom_hp.ID_NHOM_HP=lich_hoc.ID_NHOM_HP AND
												  mon_hoc.MA_MH=nhom_hp.MA_MH AND
												  hocky_namhoc.ID_HKNH=nhom_hp.ID_HKNH AND
												  hocky_namhoc.ID_HKNH='' AND
												  nhom_hp.ID_NHOM_HP=''
													";
									 
									// $query1 = mysqli_query($conn,$sql1);
									// $kq1 = mysqli_fetch_array($query1);
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 27%;\">GV: $kq1[TAIKHOAN_USER] &emsp;</span>";
									// echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 10%;\">Học phần: $kq1[MA_MH] - $kq1[TEN_MH]</span></br>";
									 echo "<span class=\"box-title\" style=\"font-size:20px; margin-left: 60%; font-style:italic\">Cập nhật ngày: $date</span>";
									 $query = mysqli_query($conn,$sql);
									 $sodong = mysqli_num_rows($query);
									if($sodong>0){
									 while($kq = mysqli_fetch_array($query)){
					
										echo "
											<tr>
												 <td>$kq[MA_MH]</td>
												 <td>$kq[MA_NHOM_HP]</td>
												 <td>$kq[NGAY_HOC]</td>
												 <td>$kq[TAIKHOAN_USER]</td>
												 <td>$kq[HOTEN_USER]</td>
												 <td>$kq[TEN_PHONG]/$kq[DIA_DIEM_PHONG]</td>
												 <form method=\"post\" action=\"#\" onSubmit=\"return ktra_check(diem_danh.value);\">
												 <td>
												 	<input type=\"hidden\" name=\"txttenmon\" value='$tenmon' style=\"width:30px\" />
													<input type=\"hidden\" name=\"id_user\" value='$kq[TAIKHOAN_USER]' style=\"width:30px\" />
													<input type=\"text\" name=\"diem_danh\" value='$kq[CHECK_DIEMDANH]' style=\"width:30px\" />  
												</td>
												 <td ><button type=\"submit\" class=\"btn btn-info pull-center\" style=\"text-align: center\"><img src=\"icon/update.png\" style=\"width: 15px; height: 15px;\"></button></td></form>
											</tr>
										 ";
										 } //while
										  } //if dong
										  else 
										 echo "
										   <tr>
											  <td>Không có dữ liệu</td>
										   </tr>  
											  ";
									}
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
