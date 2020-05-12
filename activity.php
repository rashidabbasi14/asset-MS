<?php include 'home.php';?>

<html>
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="padding:30;margin: 0 auto; border:solid; width:80%; height:80%; overflow: auto;">
			<div style="text-align: center;margin: 0 auto;width:35%;"><b>Activities</b></div><br><br>
			<?php
				
				echo "<table id ='myTable' style='margin:auto;font-family:Trebuchet MS, Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;height:10%'>";
				$sql="select * from activity";
				$result=$con->query($sql);
				$all_property = array();
				if(isset($result->num_rows)?$result->num_rows>0:0) 
				{
					while ($property = mysqli_fetch_field($result)) 
					{
						array_push($all_property, $property->name);  //save those to array
					}
					while ($row = mysqli_fetch_array($result)) 
					{
						echo "<tr>";
						echo "<td style='border: 1px solid #ddd;padding: 12px;text-align: center;'>".$row["activity_id"].": <b>".$row["user"]."</b> ".$row["action"]." <b>".$row["table"]."</b> on ".$row["timestamp"]."</td>";
						echo '</tr>';
					}
					
				}
				echo "</table>"
				
			?>
		</div>
	</body>
</html>