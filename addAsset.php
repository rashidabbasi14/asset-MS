<?php include 'home.php';?>

<html>	
	<body>
		<div id="mainmenu" class="bluff-tooltip" style="right:0;border:solid;position:absolute;width:85%; height:85%;resize: both;overflow: auto;">
			<div class="container" id="invPanel">
				<div class="panel panel-default" style="position:relative;">
				  <div class="panel-body">	
						<button id="button4" class ="btn btn-default" onclick="AssetSave()"> Save </button>
						<button id="button5" class ="btn btn-default" onclick="CancelBut()	"> Cancel </button>
						
						<div class="dropdown" style="display:inline;">
							<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Add Field
							<span class="caret"></span></button>
							<ul class="dropdown-menu">
							  <li id="anormal"><a href="#">Normal</a></li>
							  <li id="auser"><a href="#">User</a></li>
							  <li id="adept"><a href="#">Department</a></li>
							</ul>
						 </div>	
						
				  </div>
				</div>
				
			</div>
			&emsp;Enter Asset Type: <input id="atype" value=''></input>&emsp;Asset Code: <input id="acode" value=''></input> <br><br class="assty">
			&emsp;&emsp;<b><input style="display:none;"type="text" id="user" value="User Field Inserted" readonly></b><br><br>
			&emsp;&emsp;<b><input style="display:none;"type="text" id="dept" value="Department Field Inserted" readonly></b>
		</div>
	</body>
						
						
	
	<script>
			
			var counter = 0;
			var string = '';
			var hidden=0;
			var uhidden=0;
			var form = document.getElementById('mainmenu');
			$('#anormal').click(function(event)
			{
				if(counter==0)
					$(".assty").after("&emsp;&emsp;Field Name &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Data Type<br>"+(counter+1) + "&emsp; <input id='fielda"+counter+"' value='title'></input> &emsp;<select id='fieldb"+counter+"'> <option selected value='2'>Text</option>  <option value='1'>INT</option> </select><br><br class='ini"+counter+"'>");
				else
					$(".ini"+(counter-1)).after((counter+1) + "&emsp; <input id='fielda"+counter+"' value='title'></input> &emsp;<select id='fieldb"+counter+"'> <option selected value='2'>Text</option>  <option value='1'>INT</option> </select><br><br class='ini"+counter+"'>");
				counter++;
			});
			$('#auser').click(function(event) {   
				if(uhidden==0)
				{
					document.getElementById('user').setAttribute("style","display:inline");				
					uhidden=1;
				}
				else
				{
					document.getElementById('user').setAttribute("style","display:none");
					uhidden=0;
				}
			});
			$('#adept').click(function(event) {   
				if(hidden==0)
				{
					document.getElementById('dept').setAttribute("style","display:inline");			
					hidden=1;
				}
				else
				{
					document.getElementById('dept').setAttribute("style","display:none");                 
					hidden=0;
				}
			});
			function CancelBut()
			{
				location.href = 'asset.php';
			}
			function AssetSave()
			{
				var i=0;
				for(i=0;i<counter;i++)
				{
					if(i==0)
					{
						string = string+'fielda'+i+"="+document.getElementById("fielda"+i).value+"&"+'fieldb'+i+"="+document.getElementById("fieldb"+i).value;
					}
					else
					{
						string = string+'&fielda'+i+"="+document.getElementById("fielda"+i).value+"&"+'fieldb'+i+"="+document.getElementById("fieldb"+i).value;
					}
				}
				if(counter==0)
					alert("You haven't added a field.");
				else if(document.getElementById("atype").value.length == 0 || document.getElementById("acode").value.length==0)
					alert("Asset Code or Type not defined.");
				else
				{
					string = string + "&count="+counter+"&atype="+document.getElementById("atype").value+"&acode="+document.getElementById("acode").value;
					if(uhidden==1)
						string = string + "&user=enable";
					if(hidden==1)
						string = string + "&dept=enable"
					var hr = new XMLHttpRequest();
					var url = "addToDB.php";
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
				}
			}
	</script>
</html>