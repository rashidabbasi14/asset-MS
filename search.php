<?php include 'home.php';?>

<html>
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="posiiton:relative;padding:10;margin: 0 auto; border:solid; width:80%; height:80%; overflow: auto;">
			<form method="POST"><div style="margin: 0 auto;width:35%;"><input name="search"></input>
			<button  style="display:inline">Search</button></div></form>
			
			<?php
				echo "<table id ='myTable' style='margin:auto;font-family:Trebuchet MS, Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;height:10%'><tr>";
				$con=mysqli_connect('localhost','root','','asset');
				if(isset($_POST["search"]))
				{
					$found=0;
					$sql="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' AND TABLE_SCHEMA='asset'";
					$result=$con->query($sql);
					while($row=$result->fetch_assoc()) 
					{
						$sql="show columns from ".$row["TABLE_NAME"];
						$result1=$con->query($sql);
						if(isset($result1->num_rows)? $result1->num_rows >0:0)
						{
							while($row1=$result1->fetch_assoc()) 
							{
								$sql="select * from ".$row["TABLE_NAME"]." where ".$row1["Field"]."='".$_POST["search"]."'";
								$result2=$con->query($sql);
								if(isset($result2->num_rows)? $result1->num_rows >0:0)
								{
									if($row2=$result2->fetch_assoc()) 
									{
										$found=1;
										$sql="show columns from ".$row["TABLE_NAME"];
										$result3=$con->query($sql);
										echo "<table id ='myTable' style='margin:auto;font-family:Trebuchet MS, Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;height:10%'><tr><th colspan=10 style='color: white;background-color: #2E8B57;border: 1px solid #ddd;padding: 12px;text-align: center;'>".$row["TABLE_NAME"]."</th></tr><th class='chead' style='display:none;color: white;background-color: grey;border: 1px solid #ddd;padding: 10px;text-align: center;'><input type='checkbox' name='select-all' id='select-all' /></th>";
										if(isset($result3->num_rows)?$result3->num_rows>0:0) 
										{
											while($row3=$result3->fetch_assoc()) {
												if($result3->num_rows > 0) {
													$col=$row3["Field"];
													echo "<th style='color: white;background-color: grey;border: 1px solid #ddd;padding: 10px;text-align: center;'>$col</th>";
												}
											}
										}
										echo "</tr>";
										$sql="select * from ".$row["TABLE_NAME"]." where ".$row1["Field"]."='".$_POST["search"]."'";
										$result4=$con->query($sql);
										$all_property = array();
										if(isset($result4->num_rows)?$result4->num_rows>0:0) 
										{
											while ($property = mysqli_fetch_field($result4)) 
											{
												array_push($all_property, $property->name);  //save those to array
											}
											while ($row4 = mysqli_fetch_array($result4))
											{
												echo "<tr><td class='chead1' style='display:none; border: 1px solid #ddd;padding: 12px;text-align: center;'><input class='citem' type='checkbox' style='position:relative;'></td>";
												foreach ($all_property as $item) {
														echo "<td style='border: 1px solid #ddd;padding: 12px;text-align: center;'>". $row4[$item] ."</td>";
												}
												echo '</tr>';
											}
											
										}
										echo "</table><br>";
									}
								}
							}
						}
					}
					if($found==0)
					{
						echo "<b>No result found.</b>";
					}
				}
			?>
		</div>
	</body>
</html>