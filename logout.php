<?php
	session_start();
	session_destroy();
	echo "<script>alert('You have been logged out.');location.href = 'login.php'</script>";
?>
