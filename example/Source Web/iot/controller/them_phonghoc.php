<?php
	session_start();
	if(isset($_POST['tenphong']) && isset($_POST['diadiem']) && isset($_POST['succhua'])){
		require_once("../lib/connect.php");

		$sql = "SELECT max(ID_PHONG) FROM phong";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		$id_phong = $row['max(ID_PHONG)']+1;
		
        $sql= "INSERT INTO phong values(".$id_phong.",'".$_POST['tenphong']."','".$_POST['diadiem']."',".$_POST['succhua'].",'".$_POST['ip_rf']."')";

        if(mysqli_query($conn,$sql)){
        	$_SESSION['success']='Đã thêm phòng học '.$_POST['tenphòng'];
        }
        else{
        	$_SESSION['error']='Lổi không thể thêm phòng học, vui lòng liên hệ quản trị viên để khắc phục!';
        }

        header('Location: ../ql_index.php?khoatrang=phonghoc_them');
	}
?>