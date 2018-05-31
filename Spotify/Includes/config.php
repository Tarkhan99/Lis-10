<?php 

	ob_start();
	session_start();

	$timezone=date_default_timezone_set("Asia/Baku");

	$con=mysqli_connect("localhost","root","" ,"Spotify");

	if(mysqli_connect_errno()){
		echo "Failed connect".mysqli_connect_errno();
	}
 ?>