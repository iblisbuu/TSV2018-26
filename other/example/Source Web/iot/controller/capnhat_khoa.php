<?php
	session_start();
	if(isset($_POST['id_khoa'])){
		require_once("../lib/connect.php");
		$sql="UPDATE khoa SET TEN_KHOA='".$_POST['tenkhoa']."' WHERE ID_KHOA='".$_POST['id_khoa']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Cập nhật thành công";
		}
		else{
			$_SESSION['error']="Cập nhật thất bại, vui lòng liên hệ quản trị viên khắc phục!";
		}
	}
	header('Location: ../ql_index.php?khoatrang=capnhatkhoa&id_khoa='.$_POST['id_khoa']);
?>