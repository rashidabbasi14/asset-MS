<!doctype html>

<html>
	<head>
		<title>Login form</title>
		<link rel="stylesheet" type="text/css" href="CSS/layout.css">
	</head>
	
	<style>
	body {
		background-image: url("Images/image.jpg");
	}
	</style>
	
	<body background="image.jpg">
	<?php	
			$con=mysqli_connect('localhost','root','','asset');
			$username=isset($_POST["Username"]) ? $_POST["Username"] : '';
			$password=isset($_POST["Password"]) ? $_POST["Password"] : '';
			if(isset($_POST["Submit"]))
			{
				$sql="select username from user where username='$username' and password='$password';";
				$result=$con->query($sql);	
				if($result->num_rows > 0)
				{
					session_start();
					$_SESSION['LAST_ACTIVITY'] = time();
					$_SESSION["username"]=$username;
					$_SESSION["password"]=$password;
					
					echo "<script>alert('Successfully logged in.')</script>";
					echo "<script>location.href = 'information.php';</script>";
				}
				else
				{
					echo "<script>alert('Invalid Username and Password')</script>";
				}
			}
	?>
		<h2>Asset Management System</h2>
		
		<div class="login-box">
		<h1>Login Here</h1>
			<form action="" method="POST">
				<p>Username</p>
				<input type="text" name="Username" placeholder="Enter Username">
				<p>Password</p>
				<input type="password" class="password" name="Password" placeholder="Password">
				<input type="submit" name="Submit" value="Login">
			</form>
		</div>
	</body>
</html>
