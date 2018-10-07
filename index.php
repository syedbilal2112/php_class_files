<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php $a=$_GET['email'];
	session_start();
		if(!isset($_SESSION[$a])) { // if already login
		   header("location: login.php"); // send to home page
		   exit; 
		}
	?>

Welcome <?php echo $a;?>
<a href="logout.php">Logout</a>
</body>
</html>