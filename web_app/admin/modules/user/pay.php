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
if (is_submit('add_pay'))
{
    if(input_post('id_card') == '') {
      echo '<script language="javascript">'."
         alert('Chưa nhập thẻ!');
         window.location = '".create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay'))."';
      </script>";
    }
    
    $id_card = (int)input_post('id_card');
    //$error = db_idmember_validate($id_member);
    if (!$error) {
      // Lấy thông tin người dùng
      $card = db_get_row(db_create_sql('SELECT * FROM cards {where}', array(
        'id_card' => $id_card
      )));
    }

    error_reporting(0);

    if(count($card) > 0) {
      session_set_lv2('pay', 'user', $card['id_member']);
      echo '<script language="javascript">'."
         window.location = '".create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay_step_3'))."';
      </script>";
    } else {
      session_set_lv2('pay', 'card', $id_card);
      echo '<script language="javascript">'."
         alert('Thẻ chưa kích hoạt!');
         window.location = '".create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay_step_2'))."';
      </script>";
    }
}
?>

<?php include_once('widgets/header.php'); ?>

<div class="container">
<h1 align="center">Deposit (Scan Card)</h1>


<center><form id="main-form" method="POST">
    <input type="hidden" name="request_name" value="add_pay"/>
    <table cellspacing="0" cellpadding="0" class="form">
      <tr>
          <td width="200px"><sup style="color: red">(*)</sup>ID Card</td>
          <td>
              <input type="text" name="id_card" class="form-control" placeholder="ID Card of Member" required/>
          </td>
      </tr>
    </table>
</form>
<br>
<div class="controls">
    <button class="btn btn-primary btn-sm" onclick="$('#main-form').submit()">Next</button>
    <a class="btn btn-primary btn-sm" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>">Back</a>
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
