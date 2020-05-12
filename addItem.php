<?php include 'home.php';?>

<html
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="right:0;border:solid;position:absolute;width:85%; height:85%;resize: both;overflow: auto;">
			<div class="container" id="invPanel">
				<div class="panel panel-default" style="position:relative;">
				  <div class="panel-body">	
						<button id="savBut()" class ="btn btn-default" onclick="itemSave()"> Save </button>
						<button id="button5" class ="btn btn-default" onclick="CancelBut()	"> Cancel </button>
				  </div>
				</div>
			</div>
			<?php
				echo "<div style='margin:0 auto;width: 100px;'>".$_GET["asset"]."</div><br><br>";
				
				$con=mysqli_connect('localhost','root','','asset');
				$asset=$_GET["asset"];
				$sql="show columns from $asset";
				$result=$con->query($sql);
				if($result->num_rows > 0) {
					while($row=$result->fetch_assoc()) {
						if($result->num_rows > 0) 
						{
							$col=$row["Field"];
							if($col=="username")
							{
								echo "<l id='luser'>User</l>&emsp; &emsp; &emsp;&emsp;&emsp;<select id='username'>";
								$sql="select username from user;";
								$result1=$con->query($sql);
								if($result1->num_rows > 0)
								{
									while($row1=$result1->fetch_assoc())
									{
										$user=$row1["username"];
										echo "<option value='$user'>$user</option>";
									}
								}
								echo "</select><br><br>";
							}
							else if($col=="dept_id")
							{
								echo "<l id='ldept'>Dept</l>&emsp;  &emsp;&emsp;&emsp; &emsp;<select id='dept_id'>";
								$sql="select dept_id, location, name from department;";
								$result1=$con->query($sql);
								if($result1->num_rows > 0)
								{
									while($row1=$result1->fetch_assoc())
									{
										$dept_id=$row1["dept_id"];
										$name=$row1["name"];
										$location=$row1["location"];
										echo "<option value='$dept_id'>$location($name)</option>";
									}
								}
								echo "</select><br><br>";
							}
							else
								echo "$col <div style='position:absolute; display:inline; left:100;'><input id='$col' value=''></div><br><br>";
						}
					}
				}
			?>
		</div>
	</body>
	<script>
			var counter = 0;
			var string = '';
			
			function CancelBut()
			{
				location.href = 'assetPage.php?asset=<?php echo $asset;?>';
			}
			
			function itemSave()
			{
				var counter=0;
				
				$("select").each(function(){
					if(counter==0)
							string = string+this.id+"="+this.value;
						else
							string = string+'&'+this.id+"="+this.value;
						counter++;
				});
				$("input").each(function(){
					if(counter==0)
							string = string+this.id+"="+this.value;
						else
							string = string+'&'+this.id+"="+this.value;
						counter++;
				});
				string=string+"&count="+counter+"&asset="+"<?php echo $asset;?>";
				var hr = new XMLHttpRequest();
				var url = "addItemToDB.php";
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
			}
	</script>
</html>