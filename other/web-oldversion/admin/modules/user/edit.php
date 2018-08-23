<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
 
<?php
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()){
    redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
}
?>

<?php
    $UG = db_get_list('select * from usergroups');
?>

<?php
        $id_member = input_get('id_member');
        if ($id_member)
        {
            // Lấy thông tin người dùng
            $user = db_get_row(db_create_sql('SELECT * FROM members {where}', array(
                'id_member' => $id_member
            )));
        }
?>
<?php 
// Biến chứa lỗi
$error = array();

// require file xử lý database cho user
require_once('database/user.php');

// Nếu người dùng submit form
if (is_submit('update_user'))
{
    // Lấy danh sách dữ liệu từ form
    $data = array(
        $id_member  	= input_post('id_member'),
        //$password       = md5(input_post('password')),
        //'re-password'   =>input_post('re-password'),
        $name 		    = input_post('name'),
        $sex     		= input_post('sex'),
        $dayofbirth  	= input_post('dayofbirth'),
        $phone      	= input_post('phone'),
        $ID_UG     	    = input_post('ID_UG'),
        $ID_WP      	= input_post('ID_WP'),
    );
    // Thực hiện validate
    $error = db_updateuser_validate($data);
     
    // Nếu validate không có lỗi
    if (!$error)
    {
        // Xóa key re-password ra khoi $data
        unset($data['re-password']);
         
        // Nếu insert thành công thì thông báo
        // và chuyển hướng về trang danh sách user

        if (db_execute(db_create_sql("UPDATE  members SET id_member='$id_member', name='$name',sex='$sex',dayofbirth='$dayofbirth',phone='$phone', ID_UG = '$ID_UG', ID_WP='$ID_WP' {where}", array('id_member' => $id_member)))){
            ?>
            <script language="javascript">
                alert('Sửa người dùng thành công!');
                window.location = '<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>';
            </script>
            <?php
            die();
        }
    }
}
?>
 
<?php include_once('widgets/header.php'); ?>
<div class="container">
<center><h1>Chỉnh Sửa thành viên</h1></center>
 


 
<form id="main-form" method="post" action="">
    <input type="hidden" name="request_name" value="update_user"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <th width="200px"><sup style="color: red">(*)</sup>Tên đăng nhập</th>
            <td>
                <?php
                //echo var_dump(db_get_list(db_create_sql("select * from members {where}", array('id_member' => $id_member))));
                    ?>
                    <input name = "id_member" type = "text" class="form-control" placeholder="Họ tên" value="<?php echo $user['id_member'] ?>" readonly>
                <?php show_error($error, 'id_member'); ?>

            </td>
        </tr>
        <!--<tr>
            <td>Mật khẩu</td>
            <td>
                <input type="password" name="password" value="<?php echo input_post('password'); ?>" />
                <?php show_error($error, 'password'); ?>
            </td>
        </tr>
        <tr>
            <td>Nhập lại mật khẩu</td>
            <td>
                <input type="password" name="re-password" value="<?php echo input_post('re-password'); ?>" />
                <?php show_error($error, 're-password'); ?>
            </td>
        </tr>-->
        <tr>
            <th><sup style="color: red">(*)</sup>Họ Tên</th>
            <td>
                <input name = "name" type = "text" class="form-control" placeholder="Họ tên" value="<?php echo $user['name'] ?>">
                <?php show_error($error, 'name'); ?>
            </td>
        </tr>
        <tr>
            <th><sup style="color: red">(*)</sup>Giới Tính </th>
            <td>
                <select name="sex" class="form-control">
                    <option value="">-- Chọn Giới Tính --</option>
                    <option value ="nam"<?php   if($user['sex'] == "nam")   echo 'selected="selected"'?>>Nam</option>
                    <option value ="nu"<?php    if($user['sex'] == "nu")    echo 'selected="selected"'?>>Nữ</option>
                    <option value ="khac"<?php  if($user['sex'] == "khac")  echo 'selected="selected"'?>>Khác</option>
                </select>
                <?php show_error($error, 'sex'); ?>
            </td>
        </tr>
        <tr>
            <th><sup style="color: red">(*)</sup>Ngày Sinh </th>
            <td>
                <input name = "dayofbirth" class="form-control" type = "date" value="<?php echo $user['dayofbirth'] ?>">
                <?php show_error($error, 'dayofbirth'); ?>
            </td>
        </tr>
        <tr>
            <th><sup style="color: red">(*)</sup>Số Điện Thoại</th>
            <td>
                <input name = "phone" type = "number" class="form-control" value="<?php echo $user['phone'] ?>">
                <?php show_error($error, 'phone'); ?>
            </td>
        </tr>
        <tr>
            <th><sup style="color: red">(*)</sup>Work Group</th>
            <td>
                <select name="ID_UG" class="form-control">
                <?php //var_dump($UG)?>
                    <option value="">-- Chọn Work Group --</option>
                    <option value ="1"<?php if($user['ID_UG']== 1) echo 'selected="selected"'?>>Initial admin</option>
                    <option value ="2"<?php if($user['ID_UG']== 2) echo 'selected="selected"'?>>Admin</option>
                    <option value ="3"<?php if($user['ID_UG']== 3) echo 'selected="selected"'?>>Deposit staff</option>
                    <option value ="4"<?php if($user['ID_UG']== 4) echo 'selected="selected"'?>>service staff</option>
                    <option value ="5"<?php if($user['ID_UG']== 5) echo 'selected="selected"'?>>Student / Lecturer</option>
                </select>
                <?php show_error($error, 'ID_UG'); ?>
            </td>
        </tr>
        <tr>
            <th><sup style="color: red">(*)</sup>Work Place</th>
            <td>
                <select name="ID_WP" class="form-control">
                    <option value="">-- Chọn Work Place --</option>
                    <option value="KH"  <?php if($user['ID_WP']== 'KH')     echo 'selected="selected"' ?>>Khoa KHTN</option>
                    <option value="KT"  <?php if($user['ID_WP']== 'KT')     echo 'selected="selected"' ?>>Khoa KT-QTKD</option>
                    <option value="MT"  <?php if($user['ID_WP']== 'MT')     echo 'selected="selected"' ?>>Khoa KHCT</option>
                    <option value="XH"  <?php if($user['ID_WP']== 'XH')     echo 'selected="selected"' ?>>Khoa KHXHNV</option>
                    <option value="DB"  <?php if($user['ID_WP']== 'DB')     echo 'selected="selected"' ?>>Khoa DBDT</option>
                    <option value="DI"  <?php if($user['ID_WP']== 'DI')     echo 'selected="selected"' ?>>Khoa CNTT&TT</option>
                    <option value="CN"  <?php if($user['ID_WP']== 'CN')     echo 'selected="selected"' ?>>Khoa CN</option>
                    <option value="TS"  <?php if($user['ID_WP']== 'TS')     echo 'selected="selected"' ?>>Khoa TS</option>
                    <option value="NN"  <?php if($user['ID_WP']== 'NN')     echo 'selected="selected"' ?>>Khoa NN&SHUD</option>
                    <option value="SH"  <?php if($user['ID_WP']== 'SH')     echo 'selected="selected"' ?>>Vien NC&PTCNSH</option>
                    <option value="MTN" <?php if($user['ID_WP']== 'MTN')    echo 'selected="selected"' ?>>Khoa MT&TNTN</option>
                    <option value="HA"  <?php if($user['ID_WP']== 'HA')     echo 'selected="selected"' ?>>Khoa PTNT</option>
                    <option value="HL"  <?php if($user['ID_WP']== 'HL')     echo 'selected="selected"' ?>>TTHL</option>
                    <option value="NDH" <?php if($user['ID_WP']== 'NDH')    echo 'selected="selected"' ?>>Nha Dieu Hanh</option>
                    <option value="A1"  <?php if($user['ID_WP']== 'A1')     echo 'selected="selected"' ?>>Nha hoc A1</option>
                    <option value="A3"  <?php if($user['ID_WP']== 'A3')     echo 'selected="selected"' ?>>Nha hoc A3</option>
                    <option value="B1"  <?php if($user['ID_WP']== 'B1')     echo 'selected="selected"' ?>>Nha hoc B1</option>
                    <option value="C1"  <?php if($user['ID_WP']== 'C1')     echo 'selected="selected"' ?>>Nha hoc C1</option>
                    <option value="C2"  <?php if($user['ID_WP']== 'C2')     echo 'selected="selected"' ?>>Nha hoc C2</option>
                </select>
                <?php show_error($error, 'ID_WP'); ?>
            </td>
        </tr>
    </table>
</form>
<div class="controls">
    <a class="btn btn-primary btn-sm" role="button" onclick="$('#main-form').submit()" href="#">Lưu</a>
    <a class="btn btn-primary btn-sm" role="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>">Trở về</a>
</div>
 </div>
<?php include_once('widgets/footer.php'); ?>
