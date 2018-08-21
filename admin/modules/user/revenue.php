<?php if (!defined('IN_SITE')) die ('The request not found');

// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if(!is_admin()){
  redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
}
?>

<?php include_once('widgets/header.php'); ?>

<div class="container">
  <center><h1>Revenue Report</h1></center>
  <hr>
  <center>
    <form method="post" class="form-inline">
      <div class="form-group">
        <input type="text" name="id" class="form-control" placeholder="ID Deposit staff" />
      </div>
      <div class="form-group">
        <label>From:</label>
        <input type="date" name="from" value="<?php echo date("d-m-Y"); ?>" class="form-control"/>
      </div>
      <div class="form-group">
        <label>To:</label>
        <input type="date" name="to" value="<?php echo date("d-m-Y"); ?>" class="form-control"/>
      </div>
      <div class="form-group">
        <input type="submit" name="get-report" value="Get Report" class="form-control" />
      </div>
    </form>
  </center>
  <hr>

<?php

if(isset($_POST['get-report'])) {
  // Gán hàm addslashes để chống sql injection
  $member = addslashes($_POST['id']);
  $from = addslashes($_POST['from']);
  $to = addslashes($_POST['to']);

  $show_date_from = date_format(date_create($from),"d-m-Y");
  $show_date_to = date_format(date_create($to),"d-m-Y");

  // Tìm tổng số records
  $sql_total_record = "SELECT * FROM payments WHERE id_collect_member = '$member' AND date_time >= '$from' AND date_time <= '$to'";
  $total_records = db_get_num_rows($sql_total_record);

  // Tìm tổng số tiền
  $sql_total_money = "SELECT sum(amountofmoney) AS total_money FROM payments WHERE id_collect_member = '$member' AND date_time >= '$from' AND date_time <= '$to'";
  $result_query = db_get_row($sql_total_money);
  $total_money = $result_query['total_money'];

  if($total_records > 0 && $from != "" && $to != "") {
    // Thực thi câu truy vấn
    $users = mysqli_query($conn, $sql_total_record);
?>
<?php // NOTE: Hiển thị thông tin giao dịch ?>
  <center>
    <div class="alert alert-success">
      <?php
        echo "Has $total_records transaction(s) from: <b>'$show_date_from'</b> to: <b>'$show_date_to'</b>. ";
        echo "Total: " . $total_money . ' VND';
      ?>
    </div>
  </center>
  <table class="table table-hover datatables">
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
      <?php foreach ($users as $item) { ?>
      <tr class="<?php echo ($item['type_payment'] == '+') ? 'success': 'danger'; ?>">
        <td><?php echo $item['id_collect_member']; ?></td>
        <td><?php echo $item['id_pay_member']; ?></td>
        <td><?php echo $item['amountofmoney']; ?></td>
        <td><?php echo $item['type_payment']; ?></td>
        <?php $datetime = date('d-m-Y',strtotime($item['date_time'])); ?>
        <td><?php echo $datetime; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php
  } else {
    echo '<center><div class="alert alert-warning">No result!</div></center>';
  }
} else {
  echo '<center><div class="alert alert-info">Please enter data into searchbar!</div></center>';
}
?>
</div>
<?php include_once('widgets/footer.php'); ?>
