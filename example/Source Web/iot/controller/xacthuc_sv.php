<?php
	session_start();

	$check=true;

	if(isset($_SESSION['username']) && isset($_SESSION['quyen'])){
		if($_SESSION['quyen']!=3){
			$check=false;
		}
	}
	else{
		$check=false;
	}

	if($check==false){
		header('Location: index.php');
	}
?>