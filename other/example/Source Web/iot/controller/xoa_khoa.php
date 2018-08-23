<?php
	session_start();
	if(isset($_POST['id_khoa'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM khoa WHERE ID_KHOA='".$_POST['id_khoa']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Đã xóa khoa";
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=khoa_danhsach');
?>