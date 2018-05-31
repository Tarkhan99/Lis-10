<?php 

include("Includes/config.php");
include("Includes/classes/Artist.php");
include("Includes/classes/Album.php");
include("Includes/classes/Song.php");


if(isset($_SESSION['userLoggedIn'])){
	$userLoggedIn=$_SESSION['userLoggedIn'];
	echo "<script> userLoggedIn='$userLoggedIn'; </script>";
}else{
	header("Location: register.php");
}

 ?>

<!DOCTYPE html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/javascript.js"></script>
</head>
<body>

	<div id="mainContainer">

		<div id="topContainer">

			<?php include("Includes/navBarContainer.php") ?>

			<div id="mainViewContainer">
			
				<div id="mainContent">

