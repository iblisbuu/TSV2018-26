<?php if (!defined('IN_SITE')) die('The request not found'); ?>
<?php date_default_timezone_set("Asia/Ho_Chi_Minh"); ?>
<?php
// Update balance every loading
$id_current_member = get_current_id();
$sql_update_balance = "SELECT balance FROM members WHERE id_member='$id_current_member'";
$balance = db_get_row($sql_update_balance);
$_SESSION['ss_user_token']['balance'] = $balance['balance'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hệ thống thanh toán nhanh</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="style/css/style.css" >
        <script src="jquery/jquery.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet">

        <!-- Notify.js -->
        <script type="text/javascript" src="jquery/notify.min.js"></script>
        <script type="text/javascript">
          function callNotify(message,status) {
            $.notify(message,status);
          }
        </script>

        <!-- DataTable 1.10.16 -->
        <link rel="stylesheet" type="text/css" href="././datatables/datatables.min.css"/>
        <script type="text/javascript" src="././datatables/datatables.min.js"></script>
        <!-- Using DataTables -->
        <script type="text/javascript">
        $(document).ready(function () {
            $('.datatables').DataTable({
            //   "language" : {
            //     "url" : "//cdn.datatables.net/plug-ins/1.10.16/i18n/Vietnamese.json"
            // }
          });
        });
        </script>

    </head>
    <body>
        <div id="container">
        <?php if (is_admin()){ ?>
            <div id="content">

                  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header" >
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
    <!--     <a class="navbar-brand" href="#">Brand</a> -->
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul  class="nav navbar-nav">
          <li><a   role="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>"> Users <span class="sr-only">(current)</span></a></li>
          <!-- <li class="active" style="background-color: #3374C2"><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>">User <span class="sr-only">(current)</span></a></li> -->
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>">Transactions</a></li>
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'listcard')); ?>">List Card</a></li>
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'revenue')); ?>">Revenue Report</a></li>
          <li><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'listdevice')); ?>">List Device</a></li>
         
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'editpass')); ?>">Change password</a></li>
        </ul>
        <form class="navbar-form navbar-left">
        <!--   <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button> -->
        </form>
        <ul class="nav navbar-nav navbar-right">
          <div style="padding-top: 15px">
                      Hello <span style="font-weight: bold"> <?php echo get_current_name(); ?> </span>| Balance: <span style="font-weight: bold"> <?php echo get_current_balance(); ?> VND </span>|
                      <a class="btn btn-primary btn-sm" role="button" href="<?php echo base_url('admin/?m=common&a=logout'); ?>">Logout</a>
                  </div>


        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
        <?php } ?>
        <?php if (is_student()){ ?>
            <div id="content">

                  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
    <!--     <a class="navbar-brand" href="#">Brand</a> -->
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul  class="nav navbar-nav">
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>">Transactions</a></li>
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'editpass')); ?>">Change password</a></li>

        </ul>
        <form class="navbar-form navbar-left">
        <!--   <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button> -->
        </form>
        <ul class="nav navbar-nav navbar-right">
          <div style="padding-top: 15px">
                      Hello <span style="font-weight: bold"> <?php echo get_current_name(); ?> </span>| Balance: <span style="font-weight: bold"> <?php echo get_current_balance(); ?> VND </span>|
                      <a class="btn btn-primary btn-sm" role="button" href="<?php echo base_url('admin/?m=common&a=logout'); ?>">Logout</a>
                  </div>


        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
        <?php } ?>

        <?php if (is_deposit()){ ?>
                  <div id="content">

                  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
    <!--     <a class="navbar-brand" href="#">Brand</a> -->
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul  class="nav navbar-nav">
          <li><a   role="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'pay'));  ?>"> Deposit <span class="sr-only">(current)</span></a></li>
          <!-- <li class="active" style="background-color: #3374C2"><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>">User <span class="sr-only">(current)</span></a></li> -->
          <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>">Transactions</a></li>
         <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'listcard')); ?>">List Card</a></li>
         <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'editpass')); ?>">Change password</a></li>
        </ul>
        <form class="navbar-form navbar-left">
          <!-- <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button> -->
        </form>
        <ul class="nav navbar-nav navbar-right">
          <div style="padding-top: 15px">
                      Hello <span style="font-weight: bold"> <?php echo get_current_name(); ?> </span>| Balance: <span style="font-weight: bold"> <?php echo get_current_balance(); ?> VND </span>|
                      <a class="btn btn-primary btn-sm" role="button" href="<?php echo base_url('admin/?m=common&a=logout'); ?>">Logout</a>
                  </div>


        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>



        <?php } ?>

        <?php if (is_service()){ ?>



      <div id="content">

                  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
    <!--     <a class="navbar-brand" href="#">Brand</a> -->
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul  class="nav navbar-nav">
         <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'payment')); ?>">Transactions</a></li>
         <li ><a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'editpass')); ?>">Change password</a></li>
        </ul>
        <form class="navbar-form navbar-left">
          <!-- <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button> -->
        </form>
        <ul class="nav navbar-nav navbar-right">
          <div style="padding-top: 15px">
                    Hello <span style="font-weight: bold"> <?php echo get_current_name(); ?> </span>| Balance: <span style="font-weight: bold"> <?php echo get_current_balance(); ?> VND </span>|
                      <a class="btn btn-primary btn-sm" role="button" href="<?php echo base_url('admin/?m=common&a=logout'); ?>">Logout</a>
                  </div>


        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>




        <?php } ?>


            <div id="content">
