<?php


	include 'conn.php';
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query="SELECT password FROM `users` WHERE `email`='$email'";
	session_start();
	$result=mysqli_query($con,$query);
	$row=mysqli_fetch_row($result);
   	$user=$row[0];
   	if(password_verify($password, $user)){
   		$_SESSION[$email]=$email; 
   		header("location: index.php?email=$email");
   	}
   else{
   	$message="not right password or email address";
   		header("location: login.php?message=$message");
   	
   }
   	
   	
?>