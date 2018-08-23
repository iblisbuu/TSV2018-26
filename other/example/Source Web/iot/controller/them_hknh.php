<?php
	session_start();
	if(isset($_POST['hocky']) && isset($_POST['namhoc']) && isset($_POST['ngay_bd_hk'])){
		//Kiểm tra xem ngày bắt đầu học kỳ có phải là thứ 2 hay không
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$date=date_create($_POST['ngay_bd_hk']);
		
		if(date_format($date,"D")!="Mon"){//Nếu ngày bắt đầu học kỳ không phải là thứ 2
			//Báo lổi ngày bắt đầu học kỳ phải là thứ 2
			$_SESSION['error']='Lổi ngày bắt đầu học kỳ phải là thứ 2!';
		}
		else{//Ngược lại
			require_once("../lib/connect.php");
	        $sql= "SELECT max(ID_HKNH) FROM hocky_namhoc";
	        $query = mysqli_query($conn,$sql);
	        $row = mysqli_fetch_array($query);
	        $id_max = $row['max(ID_HKNH)'];
	        $id_max++;
	        $sql="INSERT INTO hocky_namhoc(ID_HKNH,HOCKY,NAMHOC,NGAY_BD_HK) VALUES(".$id_max.",".$_POST['hocky'].",'".$_POST['namhoc']."','".$_POST['ngay_bd_hk']."')";
	        if(mysqli_query($conn,$sql)){
	        	$_SESSION['success']='Đã thêm học kỳ '.$_POST['hocky'].' năm học '.$_POST['namhoc'].', bắt đầu ngày '.$_POST['ngay_bd_hk'];
	        }
	        else{
	        	$_SESSION['error']='Lổi không thể tạo học kỳ năm học, vui lòng liên hệ quản trị viên để khắc phục!';
	        }
		}

	}
	header('Location: ../ql_index.php?khoatrang=hocky_namhoc');
?>