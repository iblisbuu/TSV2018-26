<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php include_once('widgets/header.php'); ?>

<?php if(is_admin()){?>
<h1>Chào mừng bạn đến với trang quản trị admin !</h1>
<?php }?>
<?php if(is_deposit()){?>
<h1>Chào mừng bạn đến với trang Deposit Staff !</h1>
<?php }?>
<?php if(is_service()){?>
<h1>Chào mừng bạn đến với trang Service Staff !</h1>
<?php }?>
<?php if(is_student()){?>
<h1>Chào mừng bạn đến với trang Student Or Lecturer !</h1>
<?php }?>

<?php include_once('widgets/footer.php'); ?>