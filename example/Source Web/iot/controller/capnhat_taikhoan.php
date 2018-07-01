<?php
	session_start();
	require_once("../lib/connect.php");
	if(isset($_POST['hoten'])){
		$sql="UPDATE user SET HOTEN_USER='".$_POST['hoten']."',GIOI_TINH='".$_POST['gioitinh']."', NGAY_SINH='".$_POST['ngaysinh']."', DIA_CHI='".$_POST['diachi']."', SO_DT='".$_POST['sodienthoai']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
		if(mysqli_query($conn,$sql)){
			switch ($_POST['id_quyen']) {
				case 1:
					$sql="UPDATE quan_ly SET HOTEN_USER='".$_POST['hoten']."',GIOI_TINH='".$_POST['gioitinh']."', NGAY_SINH='".$_POST['ngaysinh']."', DIA_CHI='".$_POST['diachi']."', SO_DT='".$_POST['sodienthoai']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
					break;
				case 2:
					$sql="UPDATE giao_vien SET HOTEN_USER='".$_POST['hoten']."',GIOI_TINH='".$_POST['gioitinh']."', NGAY_SINH='".$_POST['ngaysinh']."', DIA_CHI='".$_POST['diachi']."', SO_DT='".$_POST['sodienthoai']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
					break;
				case 3:
					$sql="UPDATE sinh_vien SET HOTEN_USER='".$_POST['hoten']."',GIOI_TINH='".$_POST['gioitinh']."', NGAY_SINH='".$_POST['ngaysinh']."', DIA_CHI='".$_POST['diachi']."', SO_DT='".$_POST['sodienthoai']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
					break;
				default:
					# code...
					break;
			}
			if(mysqli_query($conn,$sql)){
				$_SESSION['success']='Cập nhật thành công';
			}
			else{
				$_SESSION['error']='Cập nhật thất bại, vui lòng liên hệ quản trị viên để khắc phục!';
			}
		}
		else{
			$_SESSION['error']='Cập nhật thất bại, vui lòng liên hệ quản trị viên để khắc phục!';
		}
	}
	if(isset($_POST['mathe'])){
		$sql = "UPDATE user SET MATHE_USER='".$_POST['mathe']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
		if(mysqli_query($conn,$sql)){
			switch ($_POST['id_quyen']) {
				case 1:
					$sql = "UPDATE user SET MATHE_USER='".$_POST['mathe']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
					break;
				case 2:
					$sql = "UPDATE user SET MATHE_USER='".$_POST['mathe']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
					break;
				case 3:
					$sql = "UPDATE user SET MATHE_USER='".$_POST['mathe']."' WHERE TAIKHOAN_USER='".$_POST['taikhoan']."';";
					break;
				default:
					# code...
					break;
			}
			if(mysqli_query($conn,$sql)){
				$_SESSION['success']='Cập nhật mã thẻ thành công';
			}
			else{
				$_SESSION['error']='Cập nhật mã thẻ thất bại, vui lòng liên hệ quản trị viên để khắc phục!';
			}
		}
		else{
			$_SESSION['error']='Cập nhật mã thẻ thất bại, vui lòng liên hệ quản trị viên để khắc phục!';
		}
	}
	//Điều hướng trang về trang thêm nhóm học phần
    header('Location: ../ql_index.php?khoatrang=capnhattaikhoan&taikhoan='.$_POST['taikhoan']);
?>