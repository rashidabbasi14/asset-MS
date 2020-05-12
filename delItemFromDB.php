<?php
		session_start();
		if(isset($_POST["count"])?$_POST["count"]!=0:0)
		{
			$con=mysqli_connect('localhost','root','','asset');
			for($i=0;$i<$_POST["count"];$i++)
			{
				$sql="delete from ".$_POST["asset"]." where Item_code='".$_POST["field$i"]."'";
				$result=$con->query($sql);
				$sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','removed an item with ID ".$_POST["field$i"]." from ','".$_POST["asset"]."', CURRENT_TIMESTAMP);";
				$result=$con->query($sql);
			}
			echo"Selected items removed succesfully.";
		}
		else
			echo "No Items were selected.";
	?>