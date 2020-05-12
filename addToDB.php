<?php
		session_start();
		if($_POST["count"]!=0)
		{
			$con=mysqli_connect('localhost','root','','asset');
			$aname=$_POST["atype"];
			$acode=$_POST["acode"];
			
			$sql="select name from asset_types where name='$aname'";
			$result=$con->query($sql);
			if($result->num_rows == 0)
			{
				$sql="INSERT INTO `asset_types` (`Name`, `Asset_Code`) VALUES ('$aname', '$acode');";
				$result=$con->query($sql);
				$sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','Created Asset Type','$aname', CURRENT_TIMESTAMP);";
				$result=$con->query($sql);
				
				$sql="CREATE TABLE IF NOT EXISTS `$aname` ( `Item_code` INT NOT NULL )";
				$result=$con->query($sql);
				if(isset($_POST["user"]))
				{
					$sql="ALTER TABLE `$aname` ADD `username` TEXT NOT NULL;";
					$result=$con->query($sql);
					$sql="ALTER TABLE '$aname' ADD CONSTRAINT `fk_user` FOREIGN KEY (`username`)REFERENCES `user` (`username`)";
					$result=$con->query($sql);
				}
				if(isset($_POST["dept"]))
				{
					$sql="ALTER TABLE `$aname` ADD `dept_id` INT NOT NULL;";
					$result=$con->query($sql);
					$sql="ALTER TABLE '$aname' ADD CONSTRAINT `fk_user` FOREIGN KEY (`dept_id`)REFERENCES `department` (`dept_id`)";
					$result=$con->query($sql);
				}
				for($i=0;$i<$_POST["count"];$i++)
				{
					$title=$_POST["fielda".$i];
					$datatype=$_POST["fieldb".$i];
					if($datatype=='1')
						$sql="ALTER TABLE `$aname` ADD `$title` INT NULL;";
					else if($datatype=='2')
						$sql="ALTER TABLE `$aname` ADD `$title` TEXT NULL;";
					$result=$con->query($sql);
				}
				
				echo "Assets succesfully added.";
			}
			else{
				echo "Asset with this name already exists.";
			}
		}	
	?>