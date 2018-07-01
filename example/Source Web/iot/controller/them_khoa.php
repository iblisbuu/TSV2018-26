<?php
	session_start();
	if(isset($_POST['tenkhoa'])){
		require_once("../lib/connect.php");

		$sql = "SELECT max(ID_KHOA) FROM khoa";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		$id_khoa = $row['max(ID_KHOA)']+1;
		
        $sql= "INSERT INTO khoa values(".$id_khoa.",'".$_POST['tenkhoa']."')";

        if(mysqli_query($conn,$sql)){
        	$_SESSION['success']='Đã thêm '.$_POST['tenkhoa'];
        }
        else{
        	$_SESSION['error']='Lổi không thể thêm khoa, vui lòng liên hệ quản trị viên để khắc phục!';
        }

        header('Location: ../ql_index.php?khoatrang=khoa_them');
	}
?>