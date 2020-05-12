<?php include 'asset.php';?>

<html>
	<script>
		var hidden=0;
	</script>
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="right:0;border:solid;position:absolute;width:80%; height:85%;resize: both;overflow: auto;">
			<div class="container" id="invPanel" style="padding:0;">
				<div class="panel panel-default" style="position:relative;">
				  <div class="panel-body">
						<button name="addField" id="addField" class ="btn btn-default" onclick="addItem();"> Add Item </button>
						<button name="RemItem" id="RemItem" class ="btn btn-default"> Remove Item </button>
				  </div>
				</div>
			</div>
			
			<?php
				echo "<table id ='myTable' style='margin:auto;font-family:Trebuchet MS, Arial, Helvetica, sans-serif;border-collapse: collapse;width: 100%;height:10%'><tr>";
				$con=mysqli_connect('localhost','root','','asset');
				$asset=$_GET["asset"];
				$sql="show columns from $asset";
				$result=$con->query($sql);
				echo "<th class='chead' style='display:none;color: white;background-color: grey;border: 1px solid #ddd;padding: 10px;text-align: center;'><input type='checkbox' name='select-all' id='select-all' /></th>";
				if(isset($result->num_rows)?$result->num_rows>0:0) 
				{
					while($row=$result->fetch_assoc()) {
						if($result->num_rows > 0) {
							$col=$row["Field"];
							if($col!='dept_id')
								echo "<th style='color: white;background-color: grey;border: 1px solid #ddd;padding: 10px;text-align: center;'>$col</th>";
							else
								echo "<th style='color: white;background-color: grey;border: 1px solid #ddd;padding: 10px;text-align: center;'>Department</th>";
						}
					}
				}
				echo "</tr>";
				
				$sql="select * from $asset";
				$result=$con->query($sql);
				$all_property = array();
				if(isset($result->num_rows)?$result->num_rows>0:0) 
				{
					while ($property = mysqli_fetch_field($result)) 
					{
						array_push($all_property, $property->name);  //save those to array
					}
					while ($row = mysqli_fetch_array($result)) {
						echo "<tr>
						<td class='chead1' style='display:none; border: 1px solid #ddd;padding: 12px;text-align: center;'><input value='".$row["Item_code"]."' class='citem' type='checkbox' style='position:relative;'></td>";
						foreach ($all_property as $item) {
							if($item != "dept_id")
								echo "<td style='border: 1px solid #ddd;padding: 12px;text-align: center;'>". $row[$item] ."</td>";
							else
							{
								$sql="select location, name from department where dept_id=' $row[$item]'";
								$result1=$con->query($sql);
								$row1=$result1->fetch_assoc();
								$loc=$row1["location"];
								$na=$row1["name"];
								echo "<td style='border: 1px solid #ddd;padding: 12px;text-align: center;'>$loc($na)</td>";
							}
						}
						echo '</tr>';
					}
					
				}
				echo "</table>";
			?>
			
			<div class="panel-body" id="ItemDelButs" style="width:200;margin:0 auto;display:none">
				<button id="ItemDelSave" class ="btn btn-default"> Save </button>&emsp;&emsp;
				<button id="ItemDelCan" class ="btn btn-default"> Cancel </button>
			</div>
		</div>
	</body>
	<script>
		function addItem()
		{
			location.href = 'addItem.php?asset=<?php echo "$asset";?>';
		}
		$('#RemItem').click(function(event) { 
			if(hidden==0)
			{
				$('input[class=citem]').each(function() {
					this.setAttribute("style","display:block");                       
				});
				hidden=1;
				document.getElementById("ItemDelButs").setAttribute("style","width:200;margin:0 auto;");
				$('th[class=chead]').each(function() {
					this.setAttribute("style","color: white;background-color: grey;border: 1px solid #ddd;padding: 10px;text-align: center;");                       
				});
				$('td[class=chead1]').each(function() {
					this.setAttribute("style","border: 1px solid #ddd;padding: 12px;text-align: center");                       
				});
				hidden=1;
			}	
		});
		$('#ItemDelCan').click(function(event) {
			if(hidden==1)
			{
				$('input[class=citem]').each(function() {
					this.setAttribute("style","display:none");                       
				});
				hidden=1;
				document.getElementById("ItemDelButs").setAttribute("style","display:none; width:200;margin:0 auto;");
				$('th[class=chead]').each(function() {
					this.setAttribute("style","display:none");                       
				});
				$('td[class=chead1]').each(function() {
					this.setAttribute("style","display:none");                       
				});
				hidden=0;
			}	
		});
		$('#ItemDelSave').click(function(event) 
		{ 
			var counter=0;
			var string='';
			$('input[class=citem]').each(function() {
				if(this.checked)
				{
					if(counter==0)
						string = string+'field'+counter+"="+this.value;
					else
						string = string+'&field'+counter+"="+this.value;
					counter++;
				}
			});
			string=string+"&count="+counter+"&asset=<?php echo $asset;?>";
			var hr = new XMLHttpRequest();
			var url = "delItemFromDB.php";
			hr.open("POST",url,true);
			hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			hr.onreadystatechange=function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					var return_data = hr.responseText;
					r=confirm(return_data);
					location.href = 'assetPage.php?asset=<?php echo $asset;?>';
				}
			}
			hr.send(string);
		});
		$('#select-all').click(function(event) {   
			if(this.checked) {
				// Iterate each checkbox
				$(':checkbox').each(function() {
					this.checked = true;                        
				});
			} else {
				$(':checkbox').each(function() {
					this.checked = false;                       
				});
			}
		});
	</script>
</html>