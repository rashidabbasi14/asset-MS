<?php
		session_start();
		$con=mysqli_connect('localhost','root','','asset');
		$dept_id=$_POST["field0"];
		$sql="select dept_id from department where dept_id='$dept_id'";
		$result=$con->query($sql);
		if($result->num_rows == 0)
		{
			$sql="INSERT INTO `department` (`dept_id`) VALUES ('$dept_id');";
			$result=$con->query($sql);
			
			$sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','added a new department with ID $dept_id in','$aname', CURRENT_TIMESTAMP);";
			$result=$con->query($sql);
			
			$sql="show columns from department";
			$result=$con->query($sql);
			$i=0;
			if($result->num_rows > 0) 
			{
				while($row=$result->fetch_assoc()) 
				{
					if($result->num_rows > 0 && $row["Field"] != "dept_id") 
					{
						$col=$row["Field"];	
						$sql="UPDATE `department` SET `$col` = '".$_POST["field".$i]."' WHERE `department`.`dept_id` = $dept_id;";
						$con->query($sql);
					}
					$i++;
				}
			}
			
			echo "Department succesfully added.";
		}
		else{
			echo "Department with this ID already exists.";
		}
	?>