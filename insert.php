<?php


	include 'conn.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password =$_POST['password'];
$password =password_hash($password, PASSWORD_BCRYPT);

	
	$query="INSERT INTO `users`(`name`,`email`,`password`) VALUES ('$name','$email','$password')";
	$result=mysqli_query($con,$query);
	if ($result) {
		echo "succssfully Registered";
	}
	else{
		echo "Error in Registration";
	}
?>