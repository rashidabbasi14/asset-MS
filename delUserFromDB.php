<?php
		if(isset($_POST["count"])?$_POST["count"]!=0:0)
		{
			$con=mysqli_connect('localhost','root','','asset');
			for($i=0;$i<$_POST["count"];$i++)
			{
				$sql="delete from user where username='".$_POST["field$i"]."'";
				$result=$con->query($sql);
			}
			echo "User have been removed.";
		}
		else
			echo "No users selected.";
	?>