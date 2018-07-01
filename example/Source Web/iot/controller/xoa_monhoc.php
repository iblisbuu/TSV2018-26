<?php
	session_start();
	if(isset($_POST['mamon'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM mon_hoc WHERE MA_MH='".$_POST['mamon']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Đã xóa môn học ".$_POST['mamon'];
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=monhoc_danhsach&info_search='.$_POST['mamon']);
?>