<?php if (!defined('IN_SITE')) die ('The request not found'); ?>

<?php
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_deposit()){
    redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
}
?>
<?php
// Biến chứa lỗi
$error = array();
// require file xử lý database cho user
require_once('database/user.php');

// Nếu người dùng submit form
if (is_submit('add_pay')) {

    $id_card = input_post('id_card');
    $id_member = input_post('id_member');
    //$error = db_idmember_validate($id_member);
    if (!$error) {
      // Lấy thông tin người dùng
      $user = db_get_row(db_create_sql('SELECT * FROM members {where}', array(
        'id_member' => $id_member
      )));
    }
    error_reporting(0);

    //Lấy danh sách dữ liệu từ form để inset
    $is_data = array(
        'id_card'         => $id_card,
        'id_member'     => $id_member,
    );
    // Lấy danh sách dữ liệu từ form để update
    if(count($user) > 0) {
      if (db_insert('cards', $is_data)){
        session_set_lv2('pay', 'user', $id_member);
        echo '<script language="javascript">'."
           window.location = '".create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay_step_3'))."';
        </script>";
        die();
      }
    } else {
      echo '<script language="javascript">'."
         alert('Đây là ai?');
         window.location = '".create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay'))."';
      </script>";
    }
    // if (db_insert('cards', $is_data)){
    //   session_set_lv2('pay', 'user', $id_member);
    //   echo '<script language="javascript">'."
    //      window.location = '".create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay_step_3'))."';
    //   </script>";
    //   die();
    // }
}
?>

<?php include_once('widgets/header.php'); ?>

<div class="container">
<h1 align="center">Deposit (Add Card)</h1>


<center><form id="main-form" method="POST">
    <input type="hidden" name="request_name" value="add_pay"/>
    <input type="hidden" name="id_card" value="<?php echo session_get_lv2('pay', 'card');  ?>"/>
    <table cellspacing="0" cellpadding="0" class="form">
        <tr>
            <td width="200px"><sup style="color: red">(*)</sup>ID Member</td>
            <td>
                <input type="text" name="id_member" class="form-control" placeholder="ID Member" value="<?php echo input_post('id_member'); ?>" />
                <?php show_error($error, 'id_member'); ?>
            </td>
        </tr>
    </table>
</form>
<br>
<div class="controls">
  <button class="btn btn-primary btn-sm" onclick="$('#main-form').submit()">Next</button>
  <a class="btn btn-primary btn-sm" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay')); ?>">Back</a>
</div>
</center>
</div>
<br>
<br>
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
