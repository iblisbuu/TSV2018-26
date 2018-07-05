<?php if (!defined('IN_SITE')) die ('The request not found');
 
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_deposit()){
    redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
}
?>
 
<?php include_once('widgets/header.php'); ?>

<?php
    if(is_submit('search')){
        // Gán hàm addslashes để chống sql injection
        $search = addslashes($_POST['search']);
        set_search($search);
    if (!$search=='')
    {
        // Xóa key re-password ra khoi $data
        //unset($data['re-password']);
         
        // Nếu insert thành công thì thông báo
        // và chuyển hướng về trang danh sách user
            ?>
            <script language="javascript">
                window.location = '<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>';
            </script>
            <?php
        }
        else{
            echo "Yeu cau Nhap Du Lieu Vao O Tim Kiem";
            ?>
            <div class="controls">
                <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'Payment')); ?>">Trở về</a>
            </div>
            <?php
            return $is_search = (is_search());

        }
    }
?>

 
<?php 
        //  CODE XỬ LÝ PHÂN TRANG
        $id = get_current_id(); 
        // Tìm tổng số records
        $sql = "SELECT count(date_time) as counter from payments where id_collect_member ='$id'";
        $result = db_get_row($sql);
        $total_records = $result['counter'];
         
        // Lấy trang hiện tại
        $current_page = input_get('page');
         
        // Lấy limit
        $limit = 10;
         
        // Lấy link
        $link = create_link(base_url('admin'), array(
            'm' => 'user',
            'a' => 'payment',
            'page' => '{page}'
        ));
        // Thực hiện phân trang
        $paging = paging($link, $total_records, $current_page, $limit);

        $query = "select * from payments where id_collect_member = '$id' ORDER BY date_time DESC LIMIT {$paging['start']}, {$paging['limit']} ";
        // Thực thi câu truy vấn
        $users = mysqli_query($conn, $query);

        ?>

         <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>List user</title>
   
        </head>
<body>
        <div class="container">
        <h1 align="center">Danh Sách Các Giao Dịch Mới Nhất</h1>
        <div class="controls">
            <form id="main-form" method="post" action="">
                <div class="col-xs-6 col-md-4">
                 <input type="text" name="search" class="form-control" placeholder="ID Member" />
                </div>
                
                    <td>
                        <input type="hidden" name="request_name" value="search" class="button" onclick="$('#main-form').submit()"/>
                    </td>
                    <td>
                        <input type="submit" name="login-btn" value="Search" class="btn btn-default" />
                    </td>
                </tr>
            </form>
        <br>
            <a  href="<?php echo create_link(base_url('admin'), array('m' => 'common', 'a' => 'dashboard')); ?>" class="btn btn-primary btn-sm" role="button" >Back</a>
        </div>
        <table cellspacing="0" cellpadding="0" class="table table-hover">
            <thead>
                <tr class="info">
                    <th>ID Deposit</th>
                    <th>ID Member</th>
                    <th>Amount Of Money</th>
                    <th>Type Payment</th>
                    <th>Date Time</th>
                    <?php if (is_admin()){ ?>
                    <th>Action</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                //  CODE HIỂN THỊ NGƯỜI DÙNG 
                ?>
                <?php foreach ($users as $item) { ?>
                <tr class="danger">
                    <td><?php echo $item['id_collect_member']; ?></td>
                    <td><?php echo $item['id_pay_member']; ?></td>
                    <td><?php echo $item['amountofmoney']; ?></td>
                    <td><?php echo $item['type_payment']; ?></td>
                    <?php 
                    $datetime = date('d-m-Y H:i:s',strtotime($item['date_time']));?>
                    <td><?php echo $datetime; ?></td>
                    <?php if (is_admin()){ ?>
                    <td>
                        <form method="POST" class="form-delete" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'delete')); ?>">
                            <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit', 'id_member' => $item['id_member'])); ?>">Edit</a>
                            <input type="hidden" name="id_member" value="<?php echo $item['id_member']; ?>"/>
                            <input type="hidden" name="request_name" value="delete_user"/>
                            <a href="#" class="btn-submit">Delete</a>
                        </form>
                    </td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
<div class="pagination">
    <?php //  CODE HIỂN THỊ CÁC NÚT PHÂN TRANG 
        echo $paging['html'];
        ?>
</div>
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