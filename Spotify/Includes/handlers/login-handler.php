<?php
	
	$con=mysqli_connect("localhost","root","" ,"maga");

    if(isset($_POST["loginButton"])){
       
    	$username=$_POST["loginUsername"];
    	$password=$_POST["loginPassword"];


    	$wasSeuccessful=$account->login($username,$password);

		$query=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");

		$row=mysqli_fetch_array($query);

		$userType=$row['userType'];
		// $admin;

		// while($row=mysqli_fetch_array($query)){
		// 	if($row['userType']=="admin"){
		// 		$admin="admin";
		// 	}
		// }  	

    	if($wasSeuccessful){
    		$_SESSION['userLoggedIn']=$username;
    		if($userType=="admin"){
    			header("Location: admin.php");
    		}
    		else{
    			header("Location: index.php");
    		}
    	}

    }

?>