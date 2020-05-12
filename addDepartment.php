<?php include 'home.php';?>

<html
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="right:0;border:solid;position:absolute;width:85%; height:85%;resize: both;overflow: auto;">
			<div class="container" id="invPanel">
				<div class="panel panel-default" style="position:relative;">
				  <div class="panel-body">	
						<button id="savBut" class ="btn btn-default" onclick="itemSave()"> Save </button>
						<button id="button5" class ="btn btn-default" onclick="CancelBut()"> Cancel </button>
				  </div>
				</div>
			</div>
			<?php
				echo "<div style='margin:0 auto;width: 150px;'>Add Department</div><br><br>";
				
				$con=mysqli_connect('localhost','root','','asset');
				$sql="show columns from Department";
				$result=$con->query($sql);
				if($result->num_rows > 0) {
					while($row=$result->fetch_assoc()) {
						if($result->num_rows > 0) {
							$col=$row["Field"];
								echo "$col <div style='position:absolute; display:inline; left:100;'><input id='inp$col' value=''></div><br><br>";
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
				console.log("Test");
				location.href = 'department.php';
			}
			
			function itemSave()
			{
				var counter=0;
				var flag=0;
				$("input").each(function(){
					if(this.value!=''){
						if(counter==0)
								string = string+'field'+counter+"="+this.value;
							else
								string = string+'&field'+counter+"="+this.value;
							counter++;
					}
					else
						flag=1;
				});
				if(flag==0){
					var hr = new XMLHttpRequest();
					var url = "addDepartmentToDB.php";
					hr.open("POST",url,true);
					hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					hr.onreadystatechange=function()
					{
						if(hr.readyState == 4 && hr.status == 200)
						{
							var return_data = hr.responseText;
							r=confirm(return_data);
							location.href = 'addDepartment.php';
						}
					}
					hr.send(string);
				}
				else
					alert("Fields cannot be empty.");
			}
	</script>
</html>