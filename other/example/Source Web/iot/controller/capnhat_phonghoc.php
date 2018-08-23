<?php
	session_start();
	if(isset($_POST['id_phong'])){
		require_once("../lib/connect.php");
		$sql="UPDATE phong SET TEN_PHONG='".$_POST['tenphong']."', DIA_DIEM_PHONG='".$_POST['diadiem']."', SUC_CHUA_PHONG='".$_POST['succhua']."', IP_RFID='".$_POST['ip_rf']."' WHERE ID_PHONG='".$_POST['id_phong']."';";
		echo $sql;
		if(mysqli_query($conn,$sql)){
			$_SESSION['success']="Cập nhật thành công";
		}
		else{
			$_SESSION['error']="Cập nhật thất bại, vui lòng liên hệ quản trị viên khắc phục!";
		}
	}
	header('Location: ../ql_index.php?khoatrang=capnhatphonghoc&id_phong='.$_POST['id_phong']);
?>