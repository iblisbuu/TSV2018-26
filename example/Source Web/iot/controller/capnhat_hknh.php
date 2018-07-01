<?php
	session_start();
	if(isset($_POST['id_hknh'])){
		require_once("../lib/connect.php");
		$sql="UPDATE hocky_namhoc SET HOCKY='".$_POST['hocky']."', NAMHOC='".$_POST['namhoc']."', NGAY_BD_HK='".$_POST['ngay_bd_hk']."' WHERE ID_HKNH='".$_POST['id_hknh']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Cập nhật thành công";
		}
		else{
			$_SESSION['error']="Cập nhật thất bại, vui lòng liên hệ quản trị viên khắc phục!";
		}
	}
	header('Location: ../ql_index.php?khoatrang=capnhat_hocky_namhoc&id_hknh='.$_POST['id_hknh']);
?>