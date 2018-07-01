<?php
	session_start();
	if(isset($_POST['id_phong'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM phong WHERE ID_PHONG='".$_POST['id_phong']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Đã xóa phòng học";
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=phonghoc_danhsach');
?>