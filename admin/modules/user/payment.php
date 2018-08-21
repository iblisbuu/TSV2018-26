<?php if (!defined('IN_SITE')) die ('The request not found');

// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
//if (!is_deposit()){
//    redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
//}
?>

<?php include_once('widgets/header.php'); ?>

<?php
$id = get_current_id();

if(is_deposit()||is_service()){
    $query = "select * from payments where id_collect_member = '$id' ORDER BY date_time DESC";
}
if(is_student()){
     $query = "select * from payments where id_pay_member = '$id' ORDER BY date_time DESC";
}

if(is_admin()){
    $query = "select * from payments ORDER BY date_time DESC";
}
// Thực thi câu truy vấn
$users = mysqli_query($conn, $query);

?>

<div class="container">
<h1 align="center">List of newest transactions</h1>
<table cellspacing="0" cellpadding="0" class="table table-hover datatables">
    <thead>
        <tr class="info">
            <th>ID Deposit</th>
            <th>ID Member</th>
            <th>Amount Of Money</th>
            <th>Type Payment</th>
            <th>Date Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //  CODE HIỂN THỊ NGƯỜI DÙNG
        ?>
        <?php foreach ($users as $item) { ?>
        <tr class="<?php echo ($item['type_payment'] == '+') ? 'success' : 'danger' ; ?>">
            <td><?php echo $item['id_collect_member']; ?></td>
            <td><?php echo $item['id_pay_member']; ?></td>
            <td><?php echo $item['amountofmoney']; ?></td>
            <td><?php echo $item['type_payment']; ?></td>
            <?php
            $datetime = date('d/m/Y H:m:s',strtotime($item['date_time']));?>
            <td><?php echo $datetime; ?></td>

        </tr>
        <?php } ?>
    </tbody>
</table>        
<script language="javascript">
    $(document).ready(function(){
        // Nếu người dùng click vào nút delete
        // Thì submit form
        $('.btn-submit').click(function(){
            $(this).parent().submit();
            return false;
        });

        // Nếu sự kiện submit form xảy ra thì hỏi người dùng có chắc không?
        $('.form-delete').submit(function(){
            if (!confirm('Bạn có chắc muốn xóa thành viên này không?')){
                return false;
            }

            // Nếu người dùng chắc chắn muốn xóa thì ta thêm vào trong form delete
            // một input hidden có giá trị là URL hiện tại, mục đích là giúp ở
            // trang delete sẽ lấy url này để chuyển hướng trở lại sau khi xóa xong
            $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');

            // Thực hiện xóa
            return true;
        });
    });
</script>
</div>
</body>
</html>

<?php include_once('widgets/footer.php'); ?>
