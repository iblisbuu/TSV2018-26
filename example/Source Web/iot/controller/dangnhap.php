<?php
	session_start();
	/*Thi*/

	if(isset($_POST['username']) && isset($_POST['password'])){
		require_once("../lib/connect.php");
		
		//Loại bỏ các ký tự 
		$username = isset($_POST['username']) ? $_POST['username'] : false;
		$username = str_replace('"', '', $username);
		$username = str_replace("'", '', $username);
		$username = str_replace("=", '', $username);
		$password = isset($_POST['password']) ? $_POST['password'] : false;
		$password = str_replace('"', '', $password);
		$password = str_replace("'", '', $password);
		$password = str_replace("=", '', $password);

		$sql= "SELECT * FROM user WHERE TAIKHOAN_USER= '$username'";
		$query = mysqli_query($conn,$sql);
		if(mysqli_num_rows($query) != 0){ //Đếm số hàng trả về
			$row = mysqli_fetch_array($query);
			echo "Đã vào";
			if(md5($password)===$row['PASSWORD_USER']){
				$_SESSION['username'] = $row['TAIKHOAN_USER'];
				$_SESSION['hoten'] = $row['HOTEN_USER'];
				$_SESSION['quyen'] = $row['ID_QUYEN'];
				mysqli_close($conn);
				switch ($_SESSION['quyen']) {
					case '1':
						header('Location: ../ql_index.php');
						break;
					case '2':
						header('Location: ../gv_index.php?khoatrang=gv_lichday');
						break;
					case '3':
						header('Location: ../sv_index.php');
						break;
					default:
						break;
				}
			}
			else{
				$_SESSION['error'] = "Tài khoản hoặc mật khẩu không hợp lệ";
				header('Location: ../index.php');
			}
		}
		else{
			$_SESSION['error'] = "Tài khoản hoặc mật khẩu không hợp lệ";
			header('Location: ../index.php');
		}
	}
?>