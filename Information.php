<?php include 'home.php';?>

<html>
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="padding:50;margin: 0 auto; border:solid; width:80%; height:80%; overflow: auto;">
			<br><br><br><br>
			<?php
						$con=mysqli_connect('localhost','root','','asset');
						
						$sql="select count(dept_id) from department;";
						$result=$con->query($sql);
						if($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								echo "<li>Total departments: <b>".$row["count(dept_id)"]."</b></li>";
							}
						}
						
						$sql="select count(name) from asset_types;";
						$result=$con->query($sql);
						if($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								echo "<li>Total assets types:<b>".$row["count(name)"]."</b></li>";
							}
						}
						
						$sql="select name from asset_types;";
						$result=$con->query($sql);
						if($result->num_rows > 0)
						{
							$count=0;
							while($row=$result->fetch_assoc())
							{
								$asset=$row["name"];
								$sql="select count(item_code) from $asset;";
								$result1=$con->query($sql);
								$row1=$result1->fetch_assoc();
								
								$count+=$row1["count(item_code)"];
								
							}
							echo "<li>Total assets: <b>$count</b></li>";
						}
						
						$sql="select count(username) from user;";
						$result=$con->query($sql);
						if($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								echo "<li>Total users: <b>".$row["count(username)"]."</b></li>";
							}
						}
			?>
		</div>
	</body>
</html>