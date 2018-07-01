<?php
	session_start();
	if(isset($_POST['mamoncu']) && isset($_POST['mamon'])){
		require_once("../lib/connect.php");
		$sql="UPDATE mon_hoc SET MA_MH='".$_POST['mamon']."', TEN_MH='".$_POST['tenmon']."', SO_TC='".$_POST['sotinchi']."' WHERE MA_MH='".$_POST['mamoncu']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Cập nhật thành công";
			header('Location: ../ql_index.php?khoatrang=capnhatmonhoc&mamon='.$_POST['mamon']);
		}
		else{
			$_SESSION['error']="Cập nhật thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			header('Location: ../ql_index.php?khoatrang=capnhatmonhoc&mamon='.$_POST['mamoncu']);
		}
	}
?>