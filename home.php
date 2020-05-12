<?php
	session_start();
	$username=$_SESSION["username"];
	$password=$_SESSION["password"];
	
	$con=mysqli_connect('localhost','root','','asset');
	$sql="select username from user where username='$username' and password='$password';";
	$result=$con->query($sql);	
	if($result->num_rows <= 0)
	{
		echo "<script>location.href = 'login.php'</script>";
	}
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
		echo "<script>location.href = 'logout.php'</script>";
	}
	$_SESSION['LAST_ACTIVITY'] = time();
?>
<html>
	<head>
		<title>Asset Management</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="CSS/layout.css">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		
			<div class="container" style="padding:0;width:100%;">
				<div class="panel panel-default" style="border-bottom:2px solid red;position:relative;width:100%;background:none;">
				  <div class="panel-body" style="width:100%;overflow: hidden;background-color: #333;font-family: Arial, Helvetica, sans-serif;border:none">
						<button id="InfBut" class ="btn btn-default"> Information </button>
						<button id="ActBut" class ="btn btn-default" > Activity </button>
						<button id="InvBut" class ="btn btn-default"> Inventory </button>
						<button id="DepBut" class ="btn btn-default"> Departments </button>
						<button id="UserBut" class ="btn btn-default" > Users </button>
						<button id="SearchBut" class ="btn btn-default" > Search </button>
						<div style="right:15;top:15; position:absolute">
							<button name="button3" class ="btn btn-default" onclick="logout()"> Log out</button>
						</div>
				  </div>
				</div>
			</div>
	</body>
	<script>
		$('#InfBut').click(function(event) {
			location.href = 'information.php';
		});
		$('#ActBut').click(function(event) {
			location.href = 'activity.php';
		});
		$('#SearchBut').click(function(event) {
			location.href = 'search.php';
		});
		$('#DepBut').click(function(event) {
			location.href = 'department.php';
		});
		$('#UserBut').click(function(event) {
			location.href = 'user.php';
		});
		$('#InvBut').click(function(event) {
			location.href = 'asset.php';
		});
		
		function logout()
		{
			location.href = 'logout.php';	
		}
	</script>

</html>