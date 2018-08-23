<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<script language="javascript">
  function isEmpty(ten)
  {
  	if (ten=="")
  		return false;
  	return true;
  }
  
  function testSubmit(){
    document.getElementById('alert').innerHTML="";
    var sotiet = parseInt(document.forms['form_them_nhomhp'].elements['sotiet'].value);
    var id_phong = document.forms['form_them_nhomhp'].elements['id_phong'].value;
    var id_tiet = parseInt(document.forms['form_them_nhomhp'].elements['id_tiet'].value);
    //alert(sotiet+"+"+id_tiet+"-1="+(sotiet+id_tiet-1));
    if(id_tiet!='NULL'){
      id_tiet=parseInt(id_tiet);
    }
    if(id_phong=='NULL'){
      document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Vui lòng chọn phòng!</div>";
    }
    else if(id_tiet=='NULL'){
      document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Vui lòng chọn giờ bắt đầu!</div>";
    }
    else if(sotiet<=0){
      document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Số tiết tối thiểu là 1</div>";
      document.forms['form_them_nhomhp'].elements['sotiet'].focus();
    }
    else if(sotiet+id_tiet%5-1>5){
      document.getElementById('alert').innerHTML="<div class='alert alert-danger'>Tiết bắt đầu là tiết "+id_tiet+" nên chỉ học tối đa "+(5-id_tiet+1)+"</div>";
      document.forms['form_them_nhomhp'].elements['sotiet'].focus();
    }
    else{
      document.forms['form_them_nhomhp'].submit();
    }
  }
</script>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<div>
   
    <!-- Main content -->
    <section >
      <div style="padding-top: 50px">
        <div class="col-xs-12">
          <div class="box">
          <div class="box-header" style="text-align: center">
            <!-- form start -->
            <?php
            if(isset($_POST["them"]))
      			{
      				$id_phong=$_POST['id_phong'];
      				$id_tiet=$_POST['id_tiet'];
      				$id_tuan=$_POST["id_tuan"];
      				$id_nhom_hp=$_POST["id_nhom_hp"];
      				$thu=$_POST["thu"];
      				$sotiet=$_POST['sotiet'];
      				
              //Tìm ID_LD max + 1
              $sql = "SELECT max(ID_LH) FROM lich_hoc";
              $query = mysqli_query($conn,$sql);
              $row = mysqli_fetch_array($query);
              $id_lh_max = $row['max(ID_LH)']+1;

              //Tìm ngày bắt đầu học kỳ năm học
              $sql = "SELECT NGAY_BD_HK FROM nhom_hp JOIN hocky_namhoc ON nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH WHERE ID_NHOM_HP=".$id_nhom_hp.";";
              $query = mysqli_query($conn,$sql);
              $row = mysqli_fetch_array($query);
              $ngay_bd_hk = date_create($row['NGAY_BD_HK']);
              $date = mktime(0,0,0,date_format($ngay_bd_hk,"m"),date_format($ngay_bd_hk,"d")+($thu-2)+($id_tuan-1)*7,date_format($ngay_bd_hk,"y"));
              $sql = "INSERT INTO lich_hoc VALUES(".$id_lh_max.",".$id_tuan.",".$id_tiet.",".$id_phong.",".$id_nhom_hp.",".$sotiet.",'".date('Y-m-d',$date)."',".$thu.");";
              if(mysqli_query($conn,$sql)){
                $sql = "SELECT TAIKHOAN_USER FROM sv_thuoc_nhom_hp WHERE ID_NHOM_HP=".$id_nhom_hp.";";
                $query = mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($query)){
                  $sql = "INSERT INTO danh_sach_diem_danh VALUES(".$id_lh_max.",'".$row['TAIKHOAN_USER']."',0);";
                  mysqli_query($conn,$sql);
                }
                $_SESSION['success']="Thêm lịch học thành công";
              }
              else{
                $_SESSION['error']="Thêm lịch học thất bại";
              }
      				
      			} 
			
					?>
                    
            <span class="box-title" style="font-size:40px; margin-left: 10%; color: black;">
              CẬP NHẬT HỌC PHẦN GIẢNG DẠY
            </span>
            </div>
            <div class="box-body" style="text-align: center">
            <?php
              if(isset($_GET["id_nhom_hp"])){
                $id_nhom_hp= $_GET["id_nhom_hp"];
                $sql= "SELECT MA_MH, MA_NHOM_HP
                        FROM nhom_hp WHERE ID_NHOM_HP=$id_nhom_hp;";
                $query = mysqli_query($conn,$sql);
                $kq = mysqli_fetch_array($query);
              }
			      ?>
            <div id="alert" align="center" style="width: 60%; margin-left: 20%;">
              <?php
                if(isset($_SESSION['error'])){
                  echo "<div class=\"alert alert-danger\">".$_SESSION['error']."</div>";
                  unset($_SESSION['error']);
                }
                else if(isset($_SESSION['success'])){
                  echo "<div class=\"alert alert-success\">".$_SESSION['success']."</div>";
                  unset($_SESSION['success']);
                }
              ?>
            </div>
            <form class="form-horizontal" method="post" action="gv_index.php" name="form_them_nhomhp">
              <div class="box-body">
                <div class="form-group">
                  <label for="manhom" class="col-sm-2 control-label">Mã nhóm</label>

                  <div class="col-sm-10">
                    <input type="hidden" name="id_nhom_hp" value="<?php echo "$id_nhom_hp"; ?>" style="width:30px"/>
                    <input type="hidden" name="them" value="them" style="width:30px"/>
                    <input type="text" class="form-control" name="manhom" value="<?php echo "$kq[MA_NHOM_HP]"; ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="mamon" class="col-sm-2 control-label">Mã môn học</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="mamon" value="<?php echo "$kq[MA_MH]"; ?>" readonly>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="tuan" class="col-sm-2 control-label">Tuần</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="id_tuan">
                      <?php
                        $id_tuan=1;
                        if(isset($_GET['id_tuan'])){
                          $id_tuan=$_GET['id_tuan'];
                        }
                        for ($i=1; $i <= 20; $i++) { 
                          if($id_tuan==$i){
                            echo "<option value=\"".$i."\" selected>Tuần ".$i."</option>";
                          }
                          else{
                            echo "<option value=\"".$i."\">Tuần ".$i."</option>";
                          }
                        }
                      ?>    
                    </select>
                  </div>                  
                </div>
                <div class="form-group">
                  <label for="tuan" class="col-sm-2 control-label">Thứ</label>

                  <div class="col-sm-10">
                    <select class="form-control" name="thu">
                      <option value="2">Thứ 2</option>
                      <option value="3">Thứ 3</option>  
                      <option value="4">Thứ 4</option>  
                      <option value="5">Thứ 5</option>  
                      <option value="6">Thứ 6</option>  
                      <option value="7">Thứ 7</option>  
                      <option value="8">Chủ nhật</option> 
                    </select>
                  </div>                  
                </div>
                <div class="form-group">
                  <label for="phonghoc" class="col-sm-2 control-label">Phòng học </label>
					
                  <div class="col-sm-10">
                    <select class="form-control" name="id_phong">
                        <?php
                          require_once("lib/connect.php");
                          $sql= "SELECT * FROM phong";
                          $query = mysqli_query($conn,$sql);
                          echo "<option value='NULL'>Chọn phòng</option>";
                          while($row = mysqli_fetch_array($query)){
                            echo "<option value=".$row['ID_PHONG'].">".$row['TEN_PHONG']." _ ".$row['DIA_DIEM_PHONG']." _ Sức chứa: ".$row['SUC_CHUA_PHONG']."</option>";
                          }
                        ?>
                      </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="giobd" class="col-sm-2 control-label">Tiết bắt đầu</label>

                    <div class="col-sm-10">
                      <select class="form-control" name="id_tiet">
                        <?php
                          require_once("lib/connect.php");
                          $sql1= "SELECT ID_TIET, GIO_BD, GIO_KT FROM TIET_HOC";
                          $query = mysqli_query($conn,$sql1);
                          echo "<option value=\"NULL\" selected>Chọn giờ bắt đầu</option>";
                          while($row = mysqli_fetch_array($query)){
                            echo "<option value=\"".$row['ID_TIET']."\">Tiết ".$row['ID_TIET']." từ ".$row['GIO_BD']." đến ".$row['GIO_KT']."</option>";
                          }
                        ?>
                        
                      </select>
                    </div>
                  </div>
                <div class="form-group">
                  <label for="mamon" class="col-sm-2 control-label">Số tiết</label>

                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="sotiet" placeholder="Nhập số tiết" max="10" min="0" value="0">
                  </div>
                </div>
                </div>
            <div class="box-footer" style="text-align: center">
              <a href=<?php if(isset($_GET['id_tuan'])){
                                echo "\"?khoatrang=gv_diemdanh_final&id_nhom_hp=".$_GET['id_nhom_hp']."&hocky=".$_GET['hocky']."&namhoc=".$_GET['namhoc']."&id_tuan=".$_GET['id_tuan']."\"";
                            }
                            else{
                              echo "\"?khoatrang=gv_diemdanh_ct&id_nhom_hp=".$_GET['id_nhom_hp']."&hocky=".$_GET['hocky']."&namhoc=".$_GET['namhoc']."\"";
                            }
                        ?>>
                <button type="button" class="btn btn-default">Trở lại</button>
              </a>
              <button type="button" class="btn btn-info" onclick="testSubmit()">Thêm</button>
            </div>
                
              </form>
            <!-- /.box-body -->
            
          </div>
          <!-- /.box -->

    
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

  <!-- Control Sidebar -->

</body>
</html>