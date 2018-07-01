<?php
	session_start();
	if(isset($_POST['mamon']) && isset($_POST['tenmon']) && isset($_POST['sotinchi'])){
		require_once("../lib/connect.php");
        $sql= "INSERT INTO mon_hoc values('".$_POST['mamon']."','".$_POST['tenmon']."',".$_POST['sotinchi'].")";
        if(mysqli_query($conn,$sql)){
        	$_SESSION['success']='Đã thêm môn học '.$_POST['tenmon'].' có mã: '.$_POST['mamon'];
        }
        else{
        	$_SESSION['error']='Lổi không thể thêm môn học, vui lòng liên hệ quản trị viên để khắc phục!';
        }

        header('Location: ../ql_index.php?khoatrang=monhoc_them');
	}
?>