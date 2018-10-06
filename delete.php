<?php


	include 'conn.php';
	$id = $_POST['id'];
	
	$query="DELETE FROM `users` WHERE `id`='$id'";
	$result=mysqli_query($con,$query);
	if ($result) {
		echo "succssfully Deleted";
	}
	else{
		echo "Error in Deletion";
	}
?>