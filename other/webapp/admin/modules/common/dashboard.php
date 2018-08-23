<?php if (!defined('IN_SITE')) die ('The request not found');?>
<?php
  include_once('widgets/header.php');
  // if(!isset($_COOKIE['ss_user_token'])) {
  //     session_destroy();
  //     redirect(base_url('admin/?m=common&a=login'));
  // }
?>

<?php if(is_admin()){?>
<h1 style="text-align: center;">Chào mừng bạn đến với trang quản trị admin !</h1>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<?php }?>
<?php if(is_deposit()){?>
<h1 style="text-align: center;">Chào mừng bạn đến với trang Deposit Staff !</h1>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<?php }?>
<?php if(is_service()){?>
<h1 style="text-align: center;">Chào mừng bạn đến với trang Service Staff !</h1>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<?php }?>
<?php if(is_student()){?>
<h1 style="text-align: center;">Chào mừng bạn đến với trang Student Or Lecturer !</h1>
<br>
<br>
<br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<?php } ?>

<?php include_once('widgets/footer.php'); ?>
