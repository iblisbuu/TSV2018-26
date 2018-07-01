<?php
	session_start();
	if(isset($_POST['id_nhom_hp']) && isset($_POST['mssv'])){
		require_once("../lib/connect.php");
		$sql="DELETE FROM sv_thuoc_nhom_hp WHERE ID_NHOM_HP='".$_POST['id_nhom_hp']."' AND TAIKHOAN_USER='".$_POST['mssv']."';";
		if(mysqli_query($conn,$sql)){
			$sql = "UPDATE nhom_hp SET SISO_NHOM_HP=SISO_NHOM_HP-1 WHERE ID_NHOM_HP='".$_POST['id_nhom_hp']."'";
			mysqli_query($conn,$sql);
			$_SESSION['success']="Đã xóa sinh viên ".$_POST['mssv']." khỏi nhóm này";
		}
		else{
			$_SESSION['error']="Xóa thất bại, vui lòng liên hệ quản trị viên khắc phục!";
			
		}
	}
	header('Location: ../ql_index.php?khoatrang=nhomhocphan_xem&id_nhom_hp='.$_POST['id_nhom_hp'].'&hocky='.$_POST['hocky'].'&namhoc='.$_POST['namhoc'].'&ma_mh='.$_POST['mamon'].'&ma_nhom='.$_POST['manhom'].'&giao_vien='.$_POST['giaovien'].'&siso_toida='.$_POST['sisotoida']);
?>