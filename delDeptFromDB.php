<?php
		session_start();
		if(isset($_POST["count"])?$_POST["count"]!=0:0)
		{
			$con=mysqli_connect('localhost','root','','asset');
			for($i=0;$i<$_POST["count"];$i++)
			{
				$sql="delete from department where dept_id='".$_POST["field$i"]."'";
				$result=$con->query($sql);
				
				$sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','removed department  ID ".$_POST["field$i"]." from ','Department', CURRENT_TIMESTAMP);";
				$result=$con->query($sql);
			}
			echo "Department(s) have been removed.";
		}
		else
			echo "No department selected.";
	?>