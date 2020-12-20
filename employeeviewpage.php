	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>Employee Page</title>
	</head>

	<body>
	</body>
	</html>
	<?php
	session_start();
	require_once 'db_connection.php';
	$userid = $_SESSION['id'];
	//userid empty shows direct access of employee page
	if($userid == ''){
		echo "<div class=\"textbox\">";
		echo "<h4>Oops! Invalid Entry..</h4>";
		echo "<div>";
	}
	else{
		echo "<div class=\"textbox\">";
		echo "<h4>Welcome ".$userid." to the Employee Page</h4>";
		echo "</div>";
		echo "<input class=\"btn btn-primary\" type=\"button\" name=\"logout\" value=\"Logout\" onclick=\"window.location ='loginpage.php';\">";
	}

	?>