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
    $count=0;
	if(isset($_POST['taikhoan']) && isset($_POST['hoten']) && isset($_POST['mathe'])){
        $email = createEmail($_POST['hoten'],$_POST['taikhoan'],$_POST['id_quyen']);
        require_once("../lib/connect.php");
        $sql = "INSERT INTO user values('".$_POST['taikhoan']."','".$_POST['id_quyen']."','".md5('12345678')."','".$_POST['hoten']."','".$_POST['mathe']."',NULL,'".$_POST['ngaysinh']."','".$_POST['gioitinh']."','".$_POST['diachi']."','".$email."','".$_POST['sodienthoai']."')";
        if(mysqli_query($conn,$sql)){
            $check=true;
            switch ($_POST['id_quyen']) {
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
                        $sql= $sql." values('".$_POST['taikhoan']."','".$_POST['id_quyen']."','".md5('12345678')."','".$_POST['hoten']."','".$_POST['mathe']."','".$_POST['ngaysinh']."','".$_POST['gioitinh']."','".$_POST['diachi']."','".$email."','".$_POST['sodienthoai']."')";
                        if(mysqli_query($conn,$sql)){
                               $_SESSION['success']='Đã thêm người dùng '.$_POST['hoten'].' có tài khoản: '.$_POST['taikhoan'];
                        }
                        else{
                                $_SESSION['error']='Lổi không thể thêm người dùng, vui lòng liên hệ quản trị viên để khắc phục!';
                        }
                }
                else{
                        $_SESSION['success']='Đã thêm người dùng '.$_POST['hoten'].' có tài khoản: '.$_POST['taikhoan'];
                }
                
        }
        else{
        	$_SESSION['error']='Lổi không thể thêm người dùng, vui lòng liên hệ quản trị viên để khắc phục!';
        }

        header('Location: ../ql_index.php?khoatrang=themtaikhoan');
	}
?>