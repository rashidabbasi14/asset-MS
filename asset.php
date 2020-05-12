<?php include 'home.php';?>

<html>
	<script>
		var hidden=0;
		var assets=[];
	</script>
	<body>
		<div id="toolpanel" class="bluff-tooltip" style="border:solid;position:absolute;width:20%; height:85%;resize: both;overflow: auto;">
			<ul>
				<li>Assets:</li>
				<ul class='alist'>
					<?php
						$con=mysqli_connect('localhost','root','','asset');
						$sql="select name from asset_types;";
						$result=$con->query($sql);
						if($result->num_rows > 0)
						{
							while($row=$result->fetch_assoc())
							{
								$asset=$row["name"];
								$sql="select count(item_code) from $asset;";
								$result1=$con->query($sql);
								if(isset($result1->num_rows)? $result1->num_rows > 0:0)
									$row1=$result1->fetch_assoc();
								else
									$row1=0;
								
								$count=$row1["count(item_code)"];
								echo "<li><a href='assetPage.php?asset=$asset'>$asset ($count)</a><div style='position:absolute; display:inline; right:10;'><input value='$asset' id='cbox$asset' type='checkbox' style='display:none;'></div></li>";
						
							}
						}
					?>
				</ul>
			</ul>
			<div class="panel-body" id="DelButs" style="margin:0 auto; position:absolute; bottom:0; display:none;">
				<button id="DelSave" class ="btn btn-default"> Confirm </button>&emsp;&emsp;
				<button id="DelCan" class ="btn btn-default"> Cancel </button>
			</div>
		</div>
		
		
		
		<div id="mainmenu" class="bluff-tooltip" style="right:0;border:solid;position:absolute;width:80%; height:85%;resize: both;overflow: auto;">
			<div class="container" id="invPanel" style="padding:0;">
				<div class="panel panel-default" style="position:relative; border-bottom:3px solid grey">
				  <div class="panel-body">
						<button id="button4" class ="btn btn-default" onclick="addAsset()"> Add </button>
						<button id="delBut" class ="btn btn-default"> Delete </button>
				  </div>
				</div>
			</div>	
		</div>
	</body>

	<script>
		function addAsset()
		{
			location.href = 'addAsset.php';
		}
		$('#delBut').click(function(event) { 
			if(hidden==0)
			{
				$(':checkbox').each(function() {
					this.setAttribute("style","display:inline");                       
				});
				hidden=1;
				document.getElementById("DelButs").setAttribute("style","margin:0 auto;position: absolute; bottom:0; display:inline;");
			}
		});
		$('#DelSave').click(function(event) 
		{ 
			var counter=0;
			var string='';
			$(':checkbox').each(function() {
				if(this.checked)
				{
					if(counter==0)
						string = string+'field'+counter+"="+this.value;
					else
						string = string+'&field'+counter+"="+this.value;
					counter++;
				}
			});
			string=string+"&count="+counter;
			
			var hr = new XMLHttpRequest();
			var url = "delFromDB.php";
			hr.open("POST",url,true);
			hr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			hr.onreadystatechange=function()
			{
				if(hr.readyState == 4 && hr.status == 200)
				{
					var return_data = hr.responseText;
					r=confirm(return_data);
					document.location.href = "asset.php";
				}
			}
			hr.send(string);
		});
		$('#DelCan').click(function(event) {
			$(':checkbox').each(function() {
				this.setAttribute("style","display:none;");                       
			});
			hidden=0;
			document.getElementById("DelButs").setAttribute("style","position: absolute; bottom:0; display:none;");
		});
	</script>

</html>