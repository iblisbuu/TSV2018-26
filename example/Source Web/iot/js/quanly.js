var ar_kytu = new Array('=','<','>','?','#','@','%','$',';',':','{','}','[',']','"',"'",'`');

//Hàm kiểm tra xem 1 chuỗi có chứa kí tự đặc biệt hay không
function testString(str){
	var check=true;
	for(var i=0;i<ar_kytu.length;i++){
		if(str.indexOf(ar_kytu[i])!=-1){
			check=false;
			break;
		}
	}
	return check;
}

function testSearch(){
	var str = document.forms['form_search'].elements['info_search'].value;
	var check=testString(str);
	if(check==true){
		document.forms['form_search'].submit();
	}
	else{
		document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin tìm kiếm không được chứa các ký tự đặc biệt</div>";
		document.forms['form_search'].elements['info_search'].focus();
	}
}

var ar_name_form_themtaikhoan = new Array('taikhoan','hoten','mathe','ngaysinh','diachi','sodienthoai');
var ar_error_form_themtaikhoan = new Array('Bạn chưa nhập tài khoản','Bạn chưa nhập họ tên','Bạn chưa nhập mã thẻ','Bạn chưa nhập ngày sinh','Bạn chưa nhập địa chỉ','Bạn chưa nhập số điện thoại');

function testThemTaiKhoan(){
	var check=true;

	for(var i=0;i<document.forms['form_them_taikhoan'].length-2;i++){
		var str = document.forms['form_them_taikhoan'].elements[i].value;
		str = str.trim();
		document.forms['form_them_taikhoan'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_taikhoan'].elements[i].name;
			var index = ar_name_form_themtaikhoan.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themtaikhoan[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_taikhoan'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_taikhoan'].submit();
	}
}

var ar_name_form_themmonhoc = new Array('mamon','tenmon','sotinchi');
var ar_error_form_themmonhoc = new Array('Bạn chưa nhập mã môn học','Bạn chưa nhập tên môn học','Bạn chưa nhập số tín chỉ môn học');

function testThemMonHoc(){
	var check=true;

	for(var i=0;i<document.forms['form_them_monhoc'].length;i++){
		var str = document.forms['form_them_monhoc'].elements[i].value;
		str = str.trim();
		document.forms['form_them_monhoc'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_monhoc'].elements[i].name;
			var index = ar_name_form_themmonhoc.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themmonhoc[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_monhoc'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_monhoc'].submit();
	}
}

var ar_name_form_themphonghoc = new Array('tenphong','diadiem','succhua','ip_rf');
var ar_error_form_themphonghoc = new Array('Bạn chưa nhập tên phòng học','Bạn chưa nhập địa điểm phòng học','Bạn chưa nhập sức chứa phòng học','Bạn chưa nhập IP RFID');

function testThemPhongHoc(){
	var check=true;

	for(var i=0;i<document.forms['form_them_phonghoc'].length;i++){
		var str = document.forms['form_them_phonghoc'].elements[i].value;
		str = str.trim();
		document.forms['form_them_phonghoc'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_phonghoc'].elements[i].name;
			var index = ar_name_form_themphonghoc.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themphonghoc[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_phonghoc'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_phonghoc'].submit();
	}
}

var ar_name_form_themnhomhp = new Array('manhom','mamon');
var ar_error_form_themnhomhp = new Array('Bạn chưa nhập mã nhóm học phần','Bạn chưa nhập mã môn học');

function testThemNhomHP(){
	var check=true;

	for(var i=0;i<document.forms['form_them_nhomhp'].length;i++){
		var str = document.forms['form_them_nhomhp'].elements[i].value;
		str = str.trim();
		document.forms['form_them_nhomhp'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_nhomhp'].elements[i].name;
			var index = ar_name_form_themnhomhp.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themnhomhp[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_nhomhp'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_nhomhp'].submit();
	}
}

var ar_name_form_themkhoa = new Array('tenkhoa');
var ar_error_form_themkhoa = new Array('Bạn chưa nhập tên khoa cần thêm');

function testThemKhoa(){
	var check=true;

	for(var i=0;i<document.forms['form_them_khoa'].length;i++){
		var str = document.forms['form_them_khoa'].elements[i].value;
		str = str.trim();
		document.forms['form_them_khoa'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_khoa'].elements[i].name;
			var index = ar_name_form_themkhoa.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themkhoa[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_khoa'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_khoa'].submit();
	}
}

var ar_name_form_themnganh = new Array('tennganh');
var ar_error_form_themnganh = new Array('Bạn chưa nhập tên ngành cần thêm');

function testThemNganh(){
	var check=true;

	for(var i=0;i<document.forms['form_them_nganh'].length;i++){
		var str = document.forms['form_them_nganh'].elements[i].value;
		str = str.trim();
		document.forms['form_them_nganh'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_nganh'].elements[i].name;
			var index = ar_name_form_themnganh.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themnganh[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_nganh'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_nganh'].submit();
	}
}

var ar_name_form_hknh = new Array('hocky','namhoc','ngay_bd_hk');
var ar_error_form_themhknh = new Array('Bạn chưa chọn học kỳ','Bạn chưa nhập năm học','Bạn chưa chọn ngày bắt đầu học kỳ');

function testThemHKNH(){
	var check=true;

	for(var i=0;i<document.forms['form_them_hknh'].length-2;i++){
		var str = document.forms['form_them_hknh'].elements[i].value;
		str = str.trim();
		document.forms['form_them_hknh'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_them_hknh'].elements[i].name;
			var index = ar_name_form_hknh.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themhknh[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_them_hknh'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_them_hknh'].submit();
	}
}

function suaNhomHP(id_nhom_hp,hocky,namhoc,ma_mh,ma_nhom,giao_vien,siso_toida){
	document.forms['form_sua_nhom'].elements['id_nhom_hp'].value=id_nhom_hp;
	document.forms['form_sua_nhom'].elements['hocky'].value=hocky;
	document.forms['form_sua_nhom'].elements['namhoc'].value=namhoc;
	document.forms['form_sua_nhom'].elements['ma_mh'].value=ma_mh;
	document.forms['form_sua_nhom'].elements['ma_nhom'].value=ma_nhom;
	document.forms['form_sua_nhom'].elements['giao_vien'].value=giao_vien;
	document.forms['form_sua_nhom'].elements['siso_toida'].value=siso_toida;
	document.forms['form_sua_nhom'].submit();
}

function xemNhomHP(id_nhom_hp,hocky,namhoc,ma_mh,ma_nhom,giao_vien,siso_toida){
	document.forms['form_xem_nhom'].elements['id_nhom_hp'].value=id_nhom_hp;
	document.forms['form_xem_nhom'].elements['hocky'].value=hocky;
	document.forms['form_xem_nhom'].elements['namhoc'].value=namhoc;
	document.forms['form_xem_nhom'].elements['ma_mh'].value=ma_mh;
	document.forms['form_xem_nhom'].elements['ma_nhom'].value=ma_nhom;
	document.forms['form_xem_nhom'].elements['giao_vien'].value=giao_vien;
	document.forms['form_xem_nhom'].elements['siso_toida'].value=siso_toida;
	document.forms['form_xem_nhom'].submit();
}

function setSoBuoiHocTrongTuan(){
	var n = document.forms['form_them_nhomhp'].elements['sobuoitrongtuan'].value;
	var ds_phong = document.getElementById('ds_phong').innerHTML;
	var str = "";
	for(var i=1;i<=n;i++){
		str+="<label class=\"col-md-offset-2\">+ Buổi "+i+"</label><br>"
            +"<label class=\"control-label col-sm-4\">Thứ</label>"
            +"<div class=\"col-sm-8\">"
            +  "<select class=\"form-control\" name=\"thu"+i+"\">"
            +    "<option value=\"2\">Hai</option>"
            +    "<option value=\"3\">Ba</option>"
            +    "<option value=\"4\">Tư</option>"
            +    "<option value=\"5\">Năm</option>"
            +    "<option value=\"6\">Sáu</option>"
            +    "<option value=\"7\">Bảy</option>"
            +    "<option value=\"8\">Chủ nhật</option>"
            +  "</select>"
            +"</div>"
            +"<label class=\"control-label col-sm-4\">Tiết bắt đầu</label>"
            +"<div class=\"col-sm-8\">"
            +  "<select class=\"form-control\" name=\"tiet"+i+"\">"
            +    "<option value=\"1\">1 từ 07:00 đến 07:45</option>"
            +    "<option value=\"2\">2 từ 07:45 đến 08:30</option>"
            +    "<option value=\"3\">3 từ 08:30 đến 09:15</option>"
            +    "<option value=\"4\">4 từ 09:15 đến 10:00</option>"
            +    "<option value=\"5\">5 từ 10:00 đến 11:00</option>"
            +    "<option value=\"6\">6 từ 13:30 đến 14:15</option>"
            +    "<option value=\"7\">7 từ 14:15 đến 15:00</option>"
            +    "<option value=\"8\">8 từ 15:00 đến 15:45</option>"
            +    "<option value=\"9\">9 từ 15:45 đến 16:30</option>"
            +    "<option value=\"10\">10 từ 16:30 đến 17:15</option>"
            +    "<option value=\"11\">11 từ 18:00 đến 18:45</option>"
            +    "<option value=\"12\">12 từ 18:45 đến 19:30</option>"
            +    "<option value=\"13\">13 từ 19:30 đến 20:15</option>"
            +    "<option value=\"14\">14 từ 20:15 đến 21:00</option>"
            +    "<option value=\"15\">15 từ 21:00 đến 21:45</option>"
            +  "</select>"
            +"</div>"
            +"<label class=\"control-label col-sm-4\">Số tiết</label>"
            +"<div class=\"col-sm-8\">"
            +  "<select class=\"form-control\" name=\"sotiet"+i+"\">"
            +    "<option value=\"1\">1</option>"
            +    "<option value=\"2\">2</option>"
            +    "<option value=\"3\">3</option>"
            +    "<option value=\"4\">4</option>"
            +    "<option value=\"5\">5</option>"
            +  "</select>"
            +"</div>"
            +"<label class=\"control-label col-sm-4\">Phòng</label>"
            +"<div class=\"col-sm-8\">"
            +  "<select class=\"form-control\" name=\"phong"+i+"\">"
            +    ds_phong
            +  "</select>"
            +"</div>";
	}
	document.getElementById('div_sobuoihoctrongtuan').innerHTML=str;
}

function capNhatTaiKhoan(taikhoan){
	document.forms['form_capnhat'].elements['taikhoan'].value=taikhoan;
	document.forms['form_capnhat'].submit();
}

function testCapNhatTaiKhoan1(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_taikhoan1'].length-3;i++){
		var str = document.forms['form_capnhat_taikhoan1'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_taikhoan1'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_taikhoan1'].elements[i].name;
			var index = ar_name_form_themtaikhoan.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themtaikhoan[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_taikhoan1'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		//alert(document.forms['form_capnhat_taikhoan1'].elements['hoten'].value);
		document.forms['form_capnhat_taikhoan1'].submit();
	}
}

function testCapNhatTaiKhoan2(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_taikhoan2'].length-3;i++){
		var str = document.forms['form_capnhat_taikhoan2'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_taikhoan2'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_taikhoan2'].elements[i].name;
			var index = ar_name_form_themtaikhoan.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themtaikhoan[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_taikhoan2'].elements[i].focus();
			break;
		}

	}
	if(check==true){
		document.forms['form_capnhat_taikhoan2'].submit();
	}
}

function xoaMonHoc(mamon){
	document.forms['form_xoaMonHoc'].elements['mamon'].value=mamon;
	document.forms['form_xoaMonHoc'].submit();
}

function suaMonHoc(mamon){
	document.forms['form_suaMonHoc'].elements['mamon'].value=mamon;
	document.forms['form_suaMonHoc'].submit();
}

function testCapNhatMonHoc(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_monhoc'].length-1;i++){
		var str = document.forms['form_capnhat_monhoc'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_monhoc'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_monhoc'].elements[i].name;
			var index = ar_name_form_themmonhoc.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themmonhoc[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_monhoc'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_capnhat_monhoc'].submit();
	}
}

function xoaPhongHoc(id_phong){
	document.forms['form_xoaPhongHoc'].elements['id_phong'].value=id_phong;
	document.forms['form_xoaPhongHoc'].submit();
}

function suaPhongHoc(id_phong){
	document.forms['form_suaPhongHoc'].elements['id_phong'].value=id_phong;
	document.forms['form_suaPhongHoc'].submit();
}

function testCapNhatPhongHoc(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_phonghoc'].length-1;i++){
		var str = document.forms['form_capnhat_phonghoc'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_phonghoc'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_phonghoc'].elements[i].name;
			var index = ar_name_form_themphonghoc.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themphonghoc[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_phonghoc'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_capnhat_phonghoc'].submit();
	}
}

function xoaKhoa(id_khoa){
	document.forms['form_xoaKhoa'].elements['id_khoa'].value=id_khoa;
	document.forms['form_xoaKhoa'].submit();
}

function suaKhoa(id_khoa){
	document.forms['form_suaKhoa'].elements['id_khoa'].value=id_khoa;
	document.forms['form_suaKhoa'].submit();
}

function testCapNhatKhoa(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_khoa'].length-2;i++){
		var str = document.forms['form_capnhat_khoa'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_khoa'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_khoa'].elements[i].name;
			var index = ar_name_form_themkhoa.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themkhoa[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_khoa'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_capnhat_khoa'].submit();
	}
}

function xoaNganh(id_nganh){
	document.forms['form_xoaNganh'].elements['id_nganh'].value=id_nganh;
	document.forms['form_xoaNganh'].submit();
}

function suaNganh(id_nganh){
	document.forms['form_suaNganh'].elements['id_nganh'].value=id_nganh;
	document.forms['form_suaNganh'].submit();
}

function testCapNhatNganh(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_nganh'].length-1;i++){
		var str = document.forms['form_capnhat_nganh'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_nganh'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_nganh'].elements[i].name;
			var index = ar_name_form_themnganh.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themnganh[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_nganh'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_capnhat_nganh'].submit();
	}
}

function xoaHKNH(id_hknh){
	document.forms['form_xoaHKNH'].elements['id_hknh'].value=id_hknh;
	document.forms['form_xoaHKNH'].submit();
}

function suaHKNH(id_hknh){
	document.forms['form_suaHKNH'].elements['id_hknh'].value=id_hknh;
	document.forms['form_suaHKNH'].submit();
}

function testCapNhatHKNH(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_hknh'].length-3;i++){
		var str = document.forms['form_capnhat_hknh'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_hknh'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_hknh'].elements[i].name;
			var index = ar_name_form_hknh.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themhknh[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_hknh'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_capnhat_hknh'].submit();
	}
}

function testCapNhatNhomHP(){
	var check=true;

	for(var i=0;i<document.forms['form_capnhat_nhomhp'].length-1;i++){
		var str = document.forms['form_capnhat_nhomhp'].elements[i].value;
		str = str.trim();
		document.forms['form_capnhat_nhomhp'].elements[i].value=str;
		
		if(str==''){
			var name = document.forms['form_capnhat_nhomhp'].elements[i].name;
			var index = ar_name_form_themnhomhp.indexOf(name);
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>"+ar_error_form_themnhomhp[index]+"</div>";
			check=false;
		}
		else if(testString(str)==false){
			document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Thông tin nhập vào không được chứa các ký tự đặc biệt</div>";
			check=false;
			
		}

		if(check==false){
			document.forms['form_capnhat_nhomhp'].elements[i].focus();
			break;
		}

	}

	if(check==true){
		document.forms['form_capnhat_nhomhp'].submit();
	}
}

function xoaNhomHP(id_nhom_hp){
	if(confirm("Bạn có chắc muốn xóa nhóm học phần này?")){
		document.forms['form_xoa_nhom'].elements['id_nhom_hp'].value=id_nhom_hp;
		document.forms['form_xoa_nhom'].submit();
	}
}

function testSubmitFileExcel(){
	var fileInput = document.getElementById('file_sv');
	var filePath = fileInput.value;//lấy giá trị input theo id
	var allowedExtensions = /(\.xlsx|\.xlms|\.xls)$/i;//các tập tin cho phép
	//Kiểm tra định dạng
	if(!allowedExtensions.exec(filePath)){
		document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Vui lòng upload các file có định dạng: .xlsx hoặc.xlms hoặc .xls</div>";
	}else{
		document.forms['form_upload_file'].submit();
	}
}

function xoaThanhVien(mssv){
	document.forms['form_xoa_thanhvien'].elements['mssv'].value=mssv;
	document.forms['form_xoa_thanhvien'].submit();
}