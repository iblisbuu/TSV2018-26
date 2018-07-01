<?php
  require_once("controller/xacthuc_gv.php");
  $user = $_SESSION['username'];
  
?>

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

  <header>
   
    <!-- Main content -->
    <section >
      <div style="padding-top: 50px">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="text-align: center">
            <!-- form start -->
            <form class="form-horizontal" method="get" action="gv_index.php">
            	<input type="hidden" name="khoatrang" value=<?php echo $_GET['khoatrang']; ?>>
              <div class="box-body">
                <div class="form-group">
                  <label for="txthocky" class="col-sm-2 control-label">Học kỳ</label>

                  <div class="col-sm-10">
                  <select name="hocky" style="width: 100%; height: 35px; margin: 2px;">
                    	<option disabled="true" selected="true" value="default">Chọn học kỳ</option>
                  		<option value='1' >1</option>
                        <option value='2' >2</option>
                        <option value='3' >Hè</option>
                    </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="txtnamhoc" class="col-sm-2 control-label">Năm học</label>

                  <div class="col-sm-10">
                  <select name="namhoc" style="width: 100%; height: 35px; margin: 2px;">
                    		<option disabled="true" selected="true" value="default" >Chọn năm học</option>
                    <?php 
				 		 $sql2= "SELECT DISTINCT NAMHOC FROM nhom_hp, hocky_namhoc WHERE nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH AND nhom_hp.TAIKHOAN_USER='$user'";
 			 	  		 $query2 = mysqli_query($conn,$sql2);
 			     		 while($kq2 = mysqli_fetch_array($query2)){
	  			 		echo "
                    		<option value='$kq2[NAMHOC]' >$kq2[NAMHOC]</option>
                    		
							";
 					 }
				  ?>
                  </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" style="text-align: center">
                <button type="submit" class="btn btn-info pull-center" style="text-align: center">Tìm kiếm</button>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
        
      </form>
            
				<span class="box-title" style="font-size:40px; margin-left: 27%; color: white;">DANH SÁCH NHÓM HỌC PHẦN
                </span></br>
                <span class="box-title" style="font-size:30px; margin-left: 37%; font-style:italic;color: white;">
                <?php if(isset($_GET["hocky"]) AND isset($_GET["namhoc"]) ){
			   			echo "Học kì " .$_GET["hocky"]." (".$_GET["namhoc"].")" ;
			         }
					 else if(isset($_GET["hocky"])){
			   			echo "Học kì " .$_GET["hocky"];
					 }
					 else if(isset($_GET["namhoc"])){
			   			echo "Năm học " .$_GET["namhoc"];
					 }
			   ?> </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
              <table id="example2" class="table table-bordered table-hover">
                <thead style="background-color: #066EB0; color: white; text-align-last: center">
                <tr>
                  <th>Mã HP</th>
                  <th>Tên HP</th>
                  <th>Nhóm</th>
                  <th>Tuần</th>
                  <th>Điểm danh</th>
				</tr>
                </thead>
                <tbody style="text-align:center; background-color: white;">
                <?php
					if(isset($_GET['hocky']) && isset($_GET['namhoc'])){
						require_once("lib/connect.php");
						$sql = "SELECT ID_NHOM_HP, nhom_hp.MA_MH, TEN_MH, MA_NHOM_HP
								FROM nhom_hp JOIN hocky_namhoc ON nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH 
											 JOIN mon_hoc ON nhom_hp.MA_MH=mon_hoc.MA_MH 
								WHERE TAIKHOAN_USER='".$_SESSION['username']."' 
									AND HOCKY=".$_GET['hocky']." 
									AND NAMHOC='".$_GET['namhoc']."'
								ORDER BY(nhom_hp.MA_MH);";
						$query = mysqli_query($conn,$sql);
                        while($row = mysqli_fetch_array($query)){
                        	echo "<tr>";
                        	echo "<td>".$row['MA_MH']."</td>";
                        	echo "<td>".$row['TEN_MH']."</td>";
                        	echo "<td>".$row['MA_NHOM_HP']."</td>";
                        	$sql2 = "SELECT DISTINCT(ID_TUAN) 
                        			FROM lich_hoc 
                        			WHERE ID_NHOM_HP=".$row['ID_NHOM_HP']."
                        			ORDER BY(ID_TUAN)";
                        	$query2 = mysqli_query($conn,$sql2);
                        	$str_tuan = "";
                        	$i=0;
                        	while($row2 = mysqli_fetch_array($query2)){
                        		if($i==0){
                        			$str_tuan=$row2['ID_TUAN'];
                        			$i++;
                        		}
                        		else{
                        			$str_tuan=$str_tuan."-".$row2['ID_TUAN'];
                        		}
                        	}
                        	echo "<td>".$str_tuan."</td>";
                            echo "<td>
                              	  	<a href=\"?khoatrang=gv_diemdanh_ct&id_nhom_hp=$row[ID_NHOM_HP]";
                            echo "&hocky=".$_GET['hocky'];
                            echo "&namhoc=".$_GET['namhoc']."\">
                              	  		<img src=\"icon/xem.png\" style=\"width: 15px; height: 15px;\"/>
                              	  	</a>
                              	  </td>";
                        	echo "</tr>";
                        
                        }
					}
				?>
                </tbody>
              </table>
            </div>
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
