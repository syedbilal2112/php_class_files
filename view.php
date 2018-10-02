<?php

	include 'conn.php';

	$query="SELECT * FROM `users`";
	$result=mysqli_query($con,$query);
	$json_data=array();
	while($row=mysqli_fetch_assoc($result)){
		$json_data[]=$row;
	}
	
	echo json_encode($json_data);
?>
[
{
	"id":"1",
	"name":"asdf",
	"email":"asdf@gmail.com",
	"password":"$2y$10$TefZPpt9cz0.QNFEnQ1HUOkfHpBcacKbb76p2b3sQyPEhBBylPU5a"
},
{
	"id":"2",
	"name":"asdfd",
	"email":"asdf@gmail.com",
	"password":"$2y$10$e18bM5j\/.FmmUhDblWMsceCGR21mR5gZI7JHL8PywyiGMDaIWcyGu"
}
]