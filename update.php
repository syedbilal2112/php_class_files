<?php


	include 'conn.php';
	$name = $_POST['name'];
	$id = $_POST['id'];
	$email = $_POST['email'];

	$query="UPDATE `users` SET `name`='$name',`email`='$email' WHERE `id`='$id'";
	$result=mysqli_query($con,$query);
	if ($result) {
		echo "succssfully Updated";
	}
	else{
		echo "Error in Updation";
	}
?>