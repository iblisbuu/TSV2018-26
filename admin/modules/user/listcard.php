<?php if (!defined('IN_SITE')) die ('The request not found');

// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (is_admin()||is_deposit()){?>

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
                window.location = '<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'searchcard')); ?>';
            </script>
            <?php
        }
        else{
            echo "Yeu cau Nhap Du Lieu Vao O Tim Kiem";
            ?>
            <div class="controls">
                <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'listcard')); ?>">back</a>
            </div>
            <?php
            return $is_search = (is_search());

        }
    }
?>


<?php
        // //  CODE XỬ LÝ PHÂN TRANG
        // // Tìm tổng số records
        // $sql = "SELECT count(id_card) as counter from cards";
        // $result = db_get_row($sql);
        // $total_records = $result['counter'];
        //
        // // Lấy trang hiện tại
        // $current_page = input_get('page');
        //
        // // Lấy limit
        // $limit = 10;
        //
        // // Lấy link
        // $link = create_link(base_url('admin'), array(
        //     'm' => 'user',
        //     'a' => 'listcard',
        //     'page' => '{page}'
        // ));
        // // Thực hiện phân trang
        // $paging = paging($link, $total_records, $current_page, $limit);
        // $sql = db_create_sql("SELECT * FROM cards {where} ORDER BY id_card ASC LIMIT {$paging['start']}, {$paging['limit']}");
        $sql = db_create_sql("SELECT * FROM cards");
        $users = db_get_list($sql);
        ?>
        <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>List user</title>

        </head>

   <body>
<div class="container">
<center><h1>List of cards</h1></center>
        <!-- <div class="controls">
            <form id="main-form" method="post" action="">
                <div class="col-xs-6 col-md-4">
                 <input type="text" name="search" class="form-control" placeholder="ID members" />
                </div>

                    <td>

                        <input type="hidden" name="request_name" value="search" class="button" onclick="$('#main-form').submit()"/>
                    </td>
                    <td>
                        <input type="submit" name="login-btn" value="Search" class="btn btn-default"/>
                    </td>
                </tr>
            </form>
        <br> -->
<div class="controls">
<a class="btn btn-primary btn-sm" role="button" style=" " href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'addcard')); ?>">Add</a>
<a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>" class="btn btn-primary btn-sm" role="button" >Back</a>
</div>

<table  class="table table-hover datatables">
    <thead>
        <tr  class="info">
            <th>ID Card</th>
            <th>ID Member</th>
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
            <td ><?php echo $item['id_card']; ?></td>
            <!-- <td ><?php echo $item['password']; ?></td> -->
            <td ><?php echo $item['id_member']; ?></td>
            <?php if (is_admin()){ ?>
            <td>
                <form method="POST" class="form-delete" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'delete')); ?>">
                    <input type="hidden" name="id_card" value="<?php echo $item['id_card']; ?>"/>
                    <input type="hidden" name="request_name" value="delete_card"/>
                    <a href="#" class="btn-submit">Delete</a>
                </form>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>

</table>

<!-- <div class="btn-toolbar" role="toolbar">
    <?php //  CODE HIỂN THỊ CÁC NÚT PHÂN TRANG
    echo $paging['html'] ;
    ?>
</div> -->

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
            if (!confirm('Bạn có chắc muốn xóa card này không?')){
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
 </body>
 </html>
<?php include_once('widgets/footer.php'); ?>
 <?php
    }else{
    redirect(create_link(base_url('admin'), array('m' => 'common', 'a' => 'logout')));
}?>
