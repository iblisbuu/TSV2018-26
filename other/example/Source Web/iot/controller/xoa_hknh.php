<?php
	session_start();
	if(isset($_POST['id_hknh'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM hocky_namhoc WHERE ID_HKNH='".$_POST['id_hknh']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Đã xóa học kỳ năm học";
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=hocky_namhoc');
?>