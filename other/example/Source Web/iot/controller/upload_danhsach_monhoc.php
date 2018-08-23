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

		for ($i = 2; $i <= $Totalrow; $i++)
		{
		    // Tiến hành lấy giá trị của từng ô đổ vào mảng
			$mamon = strtoupper($sheet->getCellByColumnAndRow(1, $i)->getValue());
			$tenmon = $sheet->getCellByColumnAndRow(2, $i)->getValue();
			$sotc = $sheet->getCellByColumnAndRow(3, $i)->getValue();
			if(trim($mamon,' ')!=""){
				$sql= "INSERT INTO mon_hoc values('".$mamon."','".$tenmon."',".$sotc.")";
				if(mysqli_query($conn,$sql)){
					$count1++;
          			$id_phong++;
	        	}
	        	else{
		        	$error=$error."<br>".$mamon;
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
		$_SESSION['success']="Thêm thành công ".$count1."/".$count2." môn học.";
		if($count_error>0){
			$_SESSION['error']=$error;
		}
		

	}
	header('Location: ../ql_index.php?khoatrang=phonghoc_them');
?>