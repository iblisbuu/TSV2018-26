<?php
  require_once("controller/xacthuc_sv.php");
?>

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
<script>
 
 function kiemtra() {
	file=document.forms["danganh"].hinhanh.value;
	if(file!=""){
		type=file.split(".");
			if(type[1]!=='JPG'&&type[1]!=='jpg'
			&&type[1]!=='PNG'&&type[1]!=='png'
			&&type[1]!=='GIF'&&type[1]!=='gif'
			&&type[1]!=='JPEG'&&type[1]!=='jpeg'){
					alert("Chọn file ảnh đúng định dạng JPG,PNG,GIF");
					file=document.forms["danganh"].hinhanh.focus();
					return 0;
		  			}
	}
	size=$('#hinhanh')[0].files[0].size;
	size=size/1024/1024;
	if(size>2){
	alert("kích thước file >2mb. Vui lòng chọn lại ảnh!");
	document.forms['danganh'].hinhanh.focus();
	return 0;
	}
	document.forms["danganh"].submit();
 }

	
 </script> 
</head>
<body>
<?php 
				include('lib/connect.php');
				if(isset($_POST['mssv'])){
					$file_part=$_FILES["hinhanh"]["name"];
					$sql="UPDATE `sinh_vien` SET `HINH_USER`='{$file_part}' WHERE TAIKHOAN_USER='{$_POST['mssv']}'";
					mysqli_query($conn,$sql) or die('loi');
					move_uploaded_file($_FILES["hinhanh"]["tmp_name"],"img_user/".$file_part);
					/*unlink("img_user/{$_POST['hinh']}");/*mục đích xoá ảnh bị thay đổi*/
					echo $sql;
					}
		
?>
<div>

  
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-12" style="margin-top: 5%">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border" style="text-align: center;">
              <h3 class="box-title" style="font-size: 40px;">THÔNG TIN SINH VIÊN</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <div class="form-horizontal" >
             <div style="position:absolute; width: 250px; height: 300px; background-color: blue; left: 2%; border-radius: 15px;">
                              
				<?php  
				if(isset($_SESSION["username"])){
				$sql="select * from sinh_vien 
					  where TAIKHOAN_USER='{$_SESSION['username']}'	
					 ";
				$result=mysqli_query($conn,$sql) or die("Lỗi");
				if($result!=NULL && mysqli_num_rows($result)>0){
					while($row=mysqli_fetch_assoc($result)){ 
				?>
             
             <img src="<?php  echo "img_user/{$row['HINH_USER']}";   ?>"  width="250px" height="300px"/> 
             
           </div>
       
              <div class="box-body" style="padding-left: 30%;">

                <div class="form-group">
                  <label for="txttaikhoan" class="col-sm-2 control-label">Mã số sinh viên:</label>

                  <div class="col-sm-10">
					  <div class="form-control" style="border: none; font-size: 20px;"> <?php echo $row['TAIKHOAN_USER'];    ?></div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="txthoten" class="col-sm-2 control-label">Họ tên:</label>

                 
                   <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo  $row['HOTEN_USER'];    ?></div>
                  </div>
                  
                </div>
                 <div class="form-group">
                  <label for="txtmathe" class="col-sm-2 control-label">Ngày sinh:</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo  $row['NGAY_SINH'];    ?></div>
                  </div>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Giới tính:</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo  $row['GIOI_TINH'];   ?></div>
                  </div>
                </div>
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Địa chỉ:</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo  $row['DIA_CHI'];   ?></div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Email:</label>

                 <div class="col-sm-10">
					  <div class="form-control" style="border: none;font-size: 20px;"><?php echo  $row['EMAIL'];   ?></div>
                  </div>
                </div>
              </div>
				
              <!-- /.box-body -->
              <!--nhi-->
              <div style="position:absolute; height: 50px;margin-top:0%;">
             
                 <form name="danganh" method="post" action="#" enctype="multipart/form-data">
                    <input type="file" name="hinhanh" id="hinhanh"/> 
                    <input type="hidden" name="mssv" value="<?php echo $row['TAIKHOAN_USER'];?>"/> 
                    <input type="hidden" name="hinh" value="<?php echo $row['HINH_USER'];?>"/> 
                    <input type="button" name="sub" value="Đăng Ảnh" onClick="kiemtra();"/>
                 </form>
                   
             </div>
              <!--nhi-->
              <div class="box-footer" style="text-align: center">
               <a href="?sv_index.php"> <button type="button" class="btn btn-default">Trở lại</button></a> 
              </div>
              
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
<?php 	
		}
					
	}else echo "không có sinh viên";
} 
?> */

