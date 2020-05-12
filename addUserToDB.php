<?php
		session_start();
		$con=mysqli_connect('localhost','root','','asset');
		$username=$_POST["field0"];
		$password=$_POST["field1"];
		$sql="select username from user where username='$username'";
		$result=$con->query($sql);
		if($result->num_rows == 0)
		{
			$sql="INSERT INTO `user` (`username`,`password`) VALUES ('$username','$password');";
			$result=$con->query($sql);
			
			echo $sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','Added User','$username', CURRENT_TIMESTAMP);";
				$result=$con->query($sql);
			echo "User succesfully added.";
		}
		else{
			echo "User with this username already exists.";
		}
	?>