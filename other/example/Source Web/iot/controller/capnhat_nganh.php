<?php
	session_start();
	if(isset($_POST['id_nganh'])){
		require_once("../lib/connect.php");
		$sql="UPDATE nganh SET TEN_NGANH='".$_POST['tennganh']."' WHERE ID_NGANH='".$_POST['id_nganh']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Cập nhật thành công";
		}
		else{
			$_SESSION['error']="Cập nhật thất bại, vui lòng liên hệ quản trị viên khắc phục!";
		}
	}
	header('Location: ../ql_index.php?khoatrang=capnhatnganh&id_nganh='.$_POST['id_nganh']);
?>