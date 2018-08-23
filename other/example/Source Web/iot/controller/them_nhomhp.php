<?php
	session_start();
	if(isset($_POST['manhom']) && isset($_POST['mamon'])){
		require_once("../lib/connect.php");
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		
		//Kiểm tra xem mã môn học có tồn tại hay không
		$sql = "SELECT count(*) AS SOLG_MON FROM mon_hoc WHERE MA_MH = '".$_POST['mamon']."'";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);

		if($row['SOLG_MON']==1){
			//Nếu tồn tại
			//Tìm id học kỳ năm học
			$sql = "SELECT ID_HKNH,NGAY_BD_HK FROM hocky_namhoc WHERE HOCKY='".$_POST['hocky']."' AND NAMHOC='".$_POST['namhoc']."'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($query);
			$id_hknh = $row['ID_HKNH'];
			$ngay_bat_dau_hoc_ky = $row['NGAY_BD_HK'];
			$day = date_create($ngay_bat_dau_hoc_ky);
			//Tiếp tục kiểm tra xem trong học kỳ năm học này đã tồn tại mã nhóm học phần này hay không
			$sql = "SELECT count(*) AS SOLG_NHOM FROM nhom_hp WHERE MA_MH='".$_POST['mamon']."' AND ID_HKNH='".$id_hknh."' AND MA_NHOM_HP='".$_POST['manhom']."'";
			$query = mysqli_query($conn,$sql);
			$row = mysqli_fetch_array($query);
			if($row['SOLG_NHOM']==1){
				//Nếu tồn tại
				//Tạo session báo lổi đã tồn tại mã nhóm học phần này
				$_SESSION['error']='Học kỳ '.$_POST['hocky'].' năm học '.$_POST['namhoc'].' đã tồn tại nhóm '.$_POST['manhom'];
			}
			else{
				//Nếu không tồn tại
				//Tìm max ID_NHOM_HP
				$sql = "SELECT max(ID_NHOM_HP) from nhom_hp";
				$query = mysqli_query($conn,$sql);
				$row = mysqli_fetch_array($query);
				$id_nhom_hp_max = $row['max(ID_NHOM_HP)'];
				$id_nhom_hp_max++;
				//Thêm dữ liệu vào CSDL
				$sql = "INSERT INTO nhom_hp(ID_NHOM_HP,ID_HKNH,MA_MH,MA_NHOM_HP,TAIKHOAN_USER,SISO_NHOM_HP,SISO_TOIDA_NHOM_HP)";
				if($_POST['giaovien']=='NULL'){
					$sql = $sql." VALUES(".$id_nhom_hp_max.",".$id_hknh.",'".$_POST['mamon']."','".$_POST['manhom']."',".$_POST['giaovien'].",0,'".$_POST['sisotoida']."')";
				}
				else{
					$sql = $sql." VALUES(".$id_nhom_hp_max.",".$id_hknh.",'".$_POST['mamon']."','".$_POST['manhom']."','".$_POST['giaovien']."',0,'".$_POST['sisotoida']."')";
				}
				//Tiến hành truy vấn
				if(mysqli_query($conn,$sql)){
					//Nếu thêm dữ liệu thành công
					//Tạo session lưu thông báo thành công
					$_SESSION['success']='Đã tạo nhóm học phần '.$_POST['manhom'].' môn học '.$_POST['mamon'].' vào học kỳ '.$_POST['hocky'].' năm học '.$_POST['namhoc'];
					//Tìm max(ID_LH)
					$sql = "SELECT max(ID_LH) FROM lich_hoc";
					$query = mysqli_query($conn,$sql);
					$row = mysqli_fetch_array($query);
					$id_lh_max = $row['max(ID_LH)'];
					$sql = "";
					foreach ($_POST['tuanhoc'] as $key => $value) {
						//$sql = $sql."INSERT INTO lich_hoc(ID_LH,ID_TUAN,ID_TIET,ID_PHONG,ID_NHOM_HP,SO_TIET,NGAY_HOC,THU) VALUES";
						if($_POST['sobuoitrongtuan']==0){
							$id_lh_max++;
							$sql = "INSERT INTO lich_hoc VALUES(".$id_lh_max.",".$value.",NULL,NULL,".$id_nhom_hp_max.",NULL,NULL,NULL);";
							mysqli_query($conn,$sql);
						}
						else{
							for($i=1;$i<=$_POST['sobuoitrongtuan'];$i++){
								$date = mktime(0,0,0,date_format($day,"m"),date_format($day,"d")+($_POST['thu'.$i]-2)+($value-1)*7,date_format($day,"y"));
								$id_lh_max++;
								$sql = "INSERT INTO lich_hoc VALUES(".$id_lh_max.",".$value.",".$_POST['tiet'.$i].",".$_POST['phong'.$i].",".$id_nhom_hp_max.",".$_POST['sotiet'.$i].",'".date('y-m-d',$date)."',".$_POST['thu'.$i].");";
								mysqli_query($conn,$sql);
							}
						}
						
					}

				}
				else{
					//Nếu thêm dữ liệu thất bại
					//Tạo session lưu thông báo thất bại
					$_SESSION['error']='Lổi không thể thêm nhóm học phần, vui lòng liên hệ quản trị viên để khắc phục!';
				}
			}
		}
		else{
			//Nếu không tồn tại
			//Tạo session báo lổi không tìm thấy mã học phần này
			$_SESSION['error']='Không tìm thấy mã học phần '.$_POST['mamon'];
		}

        //Điều hướng trang về trang thêm nhóm học phần
        header('Location: ../ql_index.php?khoatrang=nhomhocphan_them');
	}
?>