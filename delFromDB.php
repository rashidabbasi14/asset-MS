<?php
		session_start();
		if(isset($_POST["count"])?$_POST["count"]!=0:0)
		{
			$con=mysqli_connect('localhost','root','','asset');
			for($i=0;$i<$_POST["count"];$i++)
			{
				$sql="DROP TABLE ".$_POST["field$i"];
				$result=$con->query($sql);
				$sql="delete from asset_types where name='".$_POST["field$i"]."'";
				$result=$con->query($sql);
				
				$sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','Deleted Asset Type','".$_POST["field$i"]."', CURRENT_TIMESTAMP);";
				$result=$con->query($sql);
			}
			echo "Assets have been removed.";
		}
		else
			echo "No asset selected.";
	?>