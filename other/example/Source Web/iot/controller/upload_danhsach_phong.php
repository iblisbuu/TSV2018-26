<?php
	session_start();

	if(isset($_FILES['file_sv'])){
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
		$count1=0;
		$count2=$Totalrow-1;
		$error="Không thể tạo các phòng: ";
		$count_error=0;

		$sql = "SELECT max(ID_PHONG) FROM phong";
		$query = mysqli_query($conn,$sql);
		$row = mysqli_fetch_array($query);
		$id_phong = $row['max(ID_PHONG)']+1;

		for ($i = 2; $i <= $Totalrow; $i++)
		{
		    // Tiến hành lấy giá trị của từng ô đổ vào mảng
			$tenphong = $sheet->getCellByColumnAndRow(1, $i)->getValue();
			$diadiem = $sheet->getCellByColumnAndRow(2, $i)->getValue();
			$succhua = $sheet->getCellByColumnAndRow(3, $i)->getValue();
			$ip_rfpd = $sheet->getCellByColumnAndRow(4, $i)->getValue();
			if(trim($tenphong,' ')!=""){
				$sql= "INSERT INTO phong values(".$id_phong.",'".$tenphong."','".$diadiem."',".$succhua.",'".$ip_rfpd."')";
				if(mysqli_query($conn,$sql)){
					$count1++;
          			$id_phong++;
	        	}
	        	else{
		        	$error=$error."<br>".$tenphong;
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
		$_SESSION['success']="Thêm thành công ".$count1."/".$count2." phòng.";
		if($count_error>0){
			$_SESSION['error']=$error;
		}
		

	}
	header('Location: ../ql_index.php?khoatrang=phonghoc_them');
?>