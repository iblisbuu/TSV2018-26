<?php if (!defined('IN_SITE')) die ('The request not found'); ?>

<?php
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (is_admin()){
// Biến chứa lỗi
$error = array();
// require file xử lý database cho user
require_once('database/user.php');

// Nếu người dùng submit form
if (is_submit('add_device'))
{
        // Lấy danh sách dữ liệu từ form để update
        $data = array(
            'key_device'  	=> input_post('key_device'),
            'description' 	=> input_post('description'),
        );
        // Thực hiện validate
        $error = db_adddevice_validate($data);
        // Nếu validate không có lỗi
        if (!$error)
        {
            if (db_insert('devices', $data)){
                ?>
                <script language="javascript">
                    alert('Thêm Device thành công!');
                    window.location = '<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'adddevice')); ?>';
                </script>
                <?php
                die();
            }
    }
}
?>

<?php include_once('widgets/header.php'); ?>

<div class="container">
<h1 align="center">Add Device</h1>


<center><form id="main-form" method="post" action="">
    <input type="hidden" name="request_name" value="add_device"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px"><sup style="color: red">(*)</sup>Key Device</td>
            <td>
                <?php
                //echo var_dump(db_get_list(db_create_sql("select * from members {where}", array('id_member' => $id_member))));
                    ?>
                    <input type="text" name="key_device" class="form-control"  placeholder="Key Device" value="<?php echo input_post('key_device');  ?>"/>
                <?php show_error($error, 'key_device'); ?>

            </td>
        </tr>

            <td width="200px"><sup style="color: red"></sup>Description</td>
            <td>
                <input type="text" name="description" class="form-control" placeholder="Description" value="<?php echo input_post('description'); ?>" />
                <?php show_error($error, 'description'); ?>
            </td>
        </tr>
    </table>
</form>
<br>
<div class="controls">
    <a class="btn btn-primary btn-sm" onclick="$('#main-form').submit()" href="#">Add</a>
    <a class="btn btn-primary btn-sm" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'listdevice')); ?>">Back</a>
</div>
</center>
<br>
</div>
<br><br>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php include_once('widgets/footer.php'); ?>
<?php
    redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
}?>
