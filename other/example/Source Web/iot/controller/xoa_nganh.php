<?php
	session_start();
	if(isset($_POST['id_nganh'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM nganh WHERE ID_NGANH='".$_POST['id_nganh']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Đã xóa khoa";
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=nganh_danhsach');
?>