<?php 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=data.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<meta charset="utf-8" />
<div>
    <?php
        if(isset($_GET['id_nhom_hp'])){
	        require_once("../lib/connect.php");
            $sql = "SELECT * FROM nhom_hp JOIN mon_hoc ON nhom_hp.MA_MH=mon_hoc.MA_MH JOIN hocky_namhoc ON nhom_hp.ID_HKNH=hocky_namhoc.ID_HKNH WHERE ID_NHOM_HP=".$_GET['id_nhom_hp'].";";
            $query = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($query);
            $mamon=$row['MA_MH'];
            $tenmon=$row['TEN_MH'];
            $siso=$row['SISO_NHOM_HP'];
            $siso_toida=$row['SISO_TOIDA_NHOM_HP'];
            $hocky=$row['HOCKY'];
            $namhoc=$row['NAMHOC'];
            $manhom=$row['MA_NHOM_HP'];
            $giaovien=$row['TAIKHOAN_USER'];
        }
    ?>
    <div class="form-group">
    	<div class="col-xs-6">
        	<?php
        		if(isset($_GET['id_nhom_hp'])){
                    echo "Mã môn học: ".$mamon;
                }
        	?>
    	</div>
    	<div class="col-xs-6">
        	<?php
        		if(isset($_GET['id_nhom_hp'])){
                    echo "Tên môn học: ".$tenmon;
                }
        	?>
    	</div>
    </div>
    <div class="form-group">
    	<div class="col-xs-6">
        	<?php
        		if(isset($_GET['id_nhom_hp'])){
                    echo "Học kỳ ".$hocky." năm học ".$namhoc;
                }
        	?>
    	</div>
    	<div class="col-xs-6">
        	<?php
        		if(isset($_GET['id_nhom_hp'])){
                    echo "Mã giảng viên: ".$giaovien;
                }
        	?>
    	</div>
    </div>
    <div class="form-group">
        <div class="col-xs-6">
            <?php
            	if(isset($_GET['id_nhom_hp'])){
                    echo "Mã nhóm: ".$manhom;
                }
            ?>
        </div>
        <div class="col-xs-6">
            <?php
            	if(isset($_GET['id_nhom_hp'])){
                    echo "Sỉ số: ".$siso."/".$siso_toida;
                }
            ?>
        </div>
    </div>
</div>
<table border="1">
    <thead>
        <tr>
            <th>STT</th>
            <th>MSSV</th>
            <th>Họ và tên</th>
            <th>Giới tính</th>
            <th>Mail</th>
            <th>Số ĐT</th>
  		</tr>
    </thead>
    <tbody>
        <?php
        	if(isset($_GET['id_nhom_hp'])){
	            $sql="SELECT * FROM sv_thuoc_nhom_hp JOIN sinh_vien ON sv_thuoc_nhom_hp.TAIKHOAN_USER=sinh_vien.TAIKHOAN_USER WHERE ID_NHOM_HP=".$_GET['id_nhom_hp'].";";
	            $query=mysqli_query($conn,$sql);
	            $i=1;
	            while($row=mysqli_fetch_array($query)){
	                echo "<tr>";
	                echo "<td>".$i."</td>";
	                echo "<td>".$row['TAIKHOAN_USER']."</td>";
	                echo "<td>".$row['HOTEN_USER']."</td>";
	                echo "<td>".$row['GIOI_TINH']."</td>";
	                echo "<td>".$row['EMAIL']."</td>";
	                echo "<td>".$row['SO_DT']."</td>";
	                echo "</tr>";
	            	$i++;
	         	}
         	}
		?>
	</tbody>
</table>
