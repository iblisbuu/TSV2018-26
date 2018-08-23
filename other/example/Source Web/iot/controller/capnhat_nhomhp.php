<?php
	session_start();
	if(isset($_POST['id_nhom_hp'])){
		require_once("../lib/connect.php");
		$sql="UPDATE nhom_hp SET MA_MH='".$_POST['mamon']."', TAIKHOAN_USER='".$_POST['giaovien']."', MA_NHOM_HP='".$_POST['manhom']."', SISO_TOIDA_NHOM_HP=".$_POST['sisotoida']." WHERE ID_NHOM_HP='".$_POST['id_nhom_hp']."';";
		echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Cập nhật thành công";
		}
		else{
			$_SESSION['error']="Cập nhật thất bại, vui lòng liên hệ quản trị viên khắc phục!";
		}
	}
	header('Location: ../ql_index.php?khoatrang=nhomhocphan_sua&id_nhom_hp='.$_POST['id_nhom_hp'].'&hocky='.$_POST['hocky'].'&namhoc='.$_POST['namhoc'].'&ma_mh='.$_POST['mamon'].'&ma_nhom='.$_POST['manhom'].'&giao_vien='.$_POST['giaovien'].'&siso_toida='.$_POST['sisotoida']);
?>