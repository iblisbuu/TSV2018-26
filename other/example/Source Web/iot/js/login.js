/*Thi*/
function test(){
	document.getElementById('alert').innerHTML="";

	var taikhoan = document.forms[0].elements["username"].value;
	var matkhau = document.forms[0].elements["password"].value;
	taikhoan = taikhoan.trim();
	matkhau = matkhau.trim();

	if(taikhoan==''){
		document.forms[0].elements["username"].focus();
		document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Bạn chưa nhập tài khoản</div>";
	}
	else if(matkhau==''){
		document.forms[0].elements["password"].focus();
		document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Bạn chưa nhập mật khẩu</div>";
	}
	else{
		document.forms[0].submit();
	}
}