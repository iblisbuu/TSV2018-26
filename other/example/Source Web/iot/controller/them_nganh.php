<?php
	session_start();
	if(isset($_POST['tennganh'])){
		require_once("../lib/connect.php");

		$sql = "SELECT max(ID_NGANH) FROM nganh";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		$id_nganh = $row['max(ID_NGANH)']+1;
		
        $sql= "INSERT INTO nganh values(".$id_nganh.",'".$_POST['tennganh']."')";

        if(mysqli_query($conn,$sql)){
        	$_SESSION['success']='Đã thêm khoa '.$_POST['tennganh'];
        }
        else{
        	$_SESSION['error']='Lổi không thể thêm ngành học, vui lòng liên hệ quản trị viên để khắc phục!';
        }

        header('Location: ../ql_index.php?khoatrang=nganh_them');
	}
?>