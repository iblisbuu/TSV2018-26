<?php
	session_start();
	if(isset($_FILES['file_sv']) && isset($_POST['id_nhom_hp'])){
		$name = date('YmdHis');
		move_uploaded_file($_FILES['file_sv']['tmp_name'], '../temp/'.$name.'_'.$_FILES['file_sv']['name']);
		$inputFileName= '../temp/'.$name.'_'.$_FILES['file_sv']['name'];
		require_once("../lib/Classes/PHPExcel/IOFactory.php");
		require_once("../lib/connect.php");

		//Tiến hành xác thực file
		$objFile = PHPExcel_IOFactory::identify($inputFileName);
		$objData = PHPExcel_IOFactory::createReader($objFile);

		//Chỉ đọc dữ liệu
		$objData->setReadDataOnly(true);
		// Load dữ liệu sang dạng đối tượng
		$objPHPExcel = $objData->load($inputFileName);

		//Chọn trang cần truy xuất
		$sheet  = $objPHPExcel->setActiveSheetIndex(0);

		//Lấy ra số dòng cuối cùng
		$Totalrow = $sheet->getHighestRow();
		//Lấy ra tên cột cuối cùng
		$LastColumn = $sheet->getHighestColumn();

		//Chuyển đổi tên cột đó về vị trí thứ, VD: C là 3,D là 4
		$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
		//Tiến hành lặp qua từng ô dữ liệu
		//----Lặp dòng, Vì dòng đầu là tiêu đề cột nên chúng ta sẽ lặp giá trị từ dòng 2

		$sql = "SELECT SISO_NHOM_HP FROM nhom_hp where ID_NHOM_HP=".$_POST['id_nhom_hp'].";";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		$siso=$row['SISO_NHOM_HP'];

		$count1=0;
		$count2=$Totalrow;
		$error="Không thể thêm các sinh viên: ";
		$count_error=0;

		for ($i = 1; $i <= $Totalrow; $i++)
		{
		    // Tiến hành lấy giá trị của từng ô đổ vào mảng
			$mssv = strtoupper($sheet->getCellByColumnAndRow(0, $i)->getValue());
			if(trim($mssv,' ')!=""){
				$sql= "INSERT INTO sv_thuoc_nhom_hp values('".$mssv."',".$_POST['id_nhom_hp'].")";
				if($siso<$_POST['sisotoida']){
					if(mysqli_query($conn,$sql)){
			        	$count1++;
			        	$siso++;
			        	$sql="SELECT ID_LH FROM lich_hoc WHERE ID_NHOM_HP=".$_POST['id_nhom_hp'].";";
			        	$query = mysqli_query($conn,$sql);
			        	while($row = mysqli_fetch_array($query)){
		                    $sql="INSERT INTO danh_sach_diem_danh VALUES(".$row['ID_LH'].",'".$mssv."',0);";
		                    mysqli_query($conn,$sql);
		                }
			        }
			        else{
			        	$error=$error."<br>".$mssv;
			        	$count_error++;
			        }
				}
		        else{
		        	$error=$error."<br>".$mssv;
		        	$count_error++;
		        }
		    }
		    else{
		    	$count2--;
		    }
		}

		if (file_exists($inputFileName))
		{
		    unlink($inputFileName);
		}
		$sql = "UPDATE nhom_hp SET SISO_NHOM_HP=".$siso." WHERE ID_NHOM_HP=".$_POST['id_nhom_hp'].";";
		mysqli_query($conn,$sql);
		$_SESSION['success']="Thêm thành công ".$count1."/".$count2." sinh viên";
		if($count_error>0){
			$_SESSION['error']=$error;
		}

	}
	header('Location: ../ql_index.php?khoatrang=nhomhocphan_xem&id_nhom_hp='.$_POST['id_nhom_hp'].'&hocky='.$_POST['hocky'].'&namhoc='.$_POST['namhoc'].'&ma_mh='.$_POST['mamon'].'&ma_nhom='.$_POST['manhom'].'&giao_vien='.$_POST['giaovien'].'&siso_toida='.$_POST['sisotoida']);
?>