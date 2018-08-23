<?php
	session_start();
	if(isset($_POST['id_nhom_hp'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM nhom_hp WHERE ID_NHOM_HP='".$_POST['id_nhom_hp']."';";
		//echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Đã xóa nhóm học phần ";
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=nhomhocphan_danhsach&info_search='.$_POST['ma_mh'].'&hocky='.$_POST['hocky'].'&namhoc='.$_POST['namhoc']);
?>