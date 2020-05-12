<?php	
		session_start();
		if($_POST["count"]!=0)
		{
			$con=mysqli_connect('localhost','root','','asset');
			$aname=$_POST["asset"];
			$item_code=$_POST["Item_code"];
			$sql="select Item_code from $aname where Item_code='$item_code'";
			$result=$con->query($sql);
			if($result->num_rows == 0)
			{
				$sql="INSERT INTO `$aname` (`Item_code`) VALUES ('$item_code');";
				$result=$con->query($sql);
				
				$sql="INSERT INTO `activity` (`user`, `action`, `table`, `timestamp`) VALUES ('". $_SESSION["username"] ."','Inserted an item with ID $item_code in','$aname', CURRENT_TIMESTAMP);";
				$result=$con->query($sql);
				
				$sql="show columns from $aname";
				$result=$con->query($sql);
				if($result->num_rows > 0) 
				{
					while($row=$result->fetch_assoc()) 
					{
						if($result->num_rows > 0 && $row["Field"] != "Item_code") 
						{
							$col=$row["Field"];	
							$sql="UPDATE `$aname` SET `$col` = '".$_POST["$col"]."' WHERE `$aname`.`Item_code` = $item_code;";
							$con->query($sql);
						}
					}
				}
				
				echo "Item succesfully added.";
			}
			else{
				echo "-Item with this Item Code already exists.";
			}
		}	
	?>