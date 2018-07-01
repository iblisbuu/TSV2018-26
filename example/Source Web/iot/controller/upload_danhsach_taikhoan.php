<?php
	session_start();
	function stripUnicode($str){
        if(!$str) return false;
            $unicode = array(
                'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'd'=>'đ',
                'D'=>'Đ',
                'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'i'=>'í|ì|ỉ|ĩ|ị',
                'I'=>'Í,Ì,Ỉ,Ĩ,Ị',
                'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
                'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
            );
        foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        return $str;
    }

    function createEmail($hoten,$taikhoan,$quyen){
        $email = "";
        $hoten = stripUnicode($hoten);
        $hoten = strtolower($hoten);
        $taikhoan = strtolower($taikhoan);
        $ar_hoten = explode (' ', $hoten);
        if($quyen==3){
            $email = $ar_hoten[count($ar_hoten)-1].$taikhoan."@student.ctu.edu.vn";
        }
        else{
            for($i=0;$i<count($ar_hoten)-1;$i++){
                $str = $ar_hoten[$i];
                $email = $email.$str[0];
            }
            $email = $email.$ar_hoten[count($ar_hoten)-1]."@ctu.edu.vn";
        }
        return $email;
    }

	if(isset($_FILES['file_sv'])){
		$name = date('YmdHis');
		echo $name."<br>";
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
		$error="Không thể tạo các tài khoản: ";
		$count_error=0;
		for ($i = 2; $i <= $Totalrow; $i++)
		{
		    // Tiến hành lấy giá trị của từng ô đổ vào mảng
			$quyen = $sheet->getCellByColumnAndRow(1, $i)->getValue();
			$taikhoan = strtoupper($sheet->getCellByColumnAndRow(2, $i)->getValue());
			$hoten = $sheet->getCellByColumnAndRow(3, $i)->getValue();
			$mathe = $sheet->getCellByColumnAndRow(4, $i)->getValue();
			$gioitinh = $sheet->getCellByColumnAndRow(5, $i)->getValue();
			$ngaysinh = $sheet->getCellByColumnAndRow(6, $i)->getValue();
			$sodt = $sheet->getCellByColumnAndRow(7, $i)->getValue();
			$diachi = $sheet->getCellByColumnAndRow(8, $i)->getValue();
			$email = createEmail($hoten,$taikhoan,$quyen);
			if(trim($taikhoan,' ')!=""){
				$sql = "INSERT INTO user values('".$taikhoan."','".$quyen."','".md5('12345678')."','".$hoten."','".$mathe."',NULL,'".$ngaysinh."','".$gioitinh."','".$diachi."','".$email."','".$sodt."');";
				if(mysqli_query($conn,$sql)){
					$count1++;
                	$check=true;
                	switch ($quyen) {
                        case 1:
                                $sql= "INSERT INTO quan_ly (TAIKHOAN_USER, ID_QUYEN, PASSWORD_USER, HOTEN_USER, MATHE_USER, NGAY_SINH, GIOI_TINH, DIA_CHI, EMAIL, SO_DT)";
                                break;
                        case 2:
                                $sql= "INSERT INTO giao_vien (TAIKHOAN_USER, ID_QUYEN, PASSWORD_USER, HOTEN_USER, MATHE_USER, NGAY_SINH, GIOI_TINH, DIA_CHI, EMAIL, SO_DT)";
                                break;
                        case 3:
                               $sql= "INSERT INTO sinh_vien (TAIKHOAN_USER, ID_QUYEN, PASSWORD_USER, HOTEN_USER, MATHE_USER, NGAY_SINH, GIOI_TINH, DIA_CHI, EMAIL, SO_DT)";
                                break;
                        default:
                                $_SESSION['error']='Lổi không thể thêm người dùng, vui lòng liên hệ quản trị viên để khắc phục!';
                                $check=false;
                                break;
                	}
                	if($check==true){
                    	$sql= $sql." values('".$taikhoan."','".$quyen."','".md5('12345678')."','".$hoten."','".$mathe."','".$ngaysinh."','".$gioitinh."','".$diachi."','".$email."','".$sodt."')";
                    	mysqli_query($conn,$sql);
                	}
	        	}
	        	else{
		        	$error=$error."<br>".$taikhoan;
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
		$_SESSION['success']="Thêm thành công ".$count1."/".$count2." người dùng.";
		if($count_error>0){
			$_SESSION['error']=$error;
		}
		

	}
	header('Location: ../ql_index.php?khoatrang=themtaikhoan');
?>