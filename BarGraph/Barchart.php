<?php

	$con=mysqli_connect('localhost','root','','asset');
	$sql="select price from Laptop";
	$result=$con->query($sql);
	
	
	$data = array();
	while($row=$result->fetch_assoc())
	{
		$data[]=$row;
	}
	print json_encode($data);


?>