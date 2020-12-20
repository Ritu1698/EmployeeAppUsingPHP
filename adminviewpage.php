	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>Admin Page</title>
	</head>

	<body>

	<?php
	session_start();
	require_once 'db_connection.php';
	$userid = $_SESSION['id'];
	//when delete button hit of this page
	if(isset($_POST['deleteuser'])){
		if($_POST['deleteuser'] == $userid){
			echo "<script>
			alert(\"Cant Delete Current User, Please Login through another Admin!\");
			</script>";
		}
		else{
			$result = pg_query($db_conn, "DELETE FROM \"public\".\"EmployeeLogin\"where username = '".$_POST['deleteuser']."';");
			header("Location: adminviewpage.php");
		}
	}
	//userid empty means direct access of adminviewpage
	if($userid == ''){
		echo "<div class=\"textbox\">";
		echo "<h4>Oops! Invalid Entry..</h4>";
		echo "<div>";
	}
	else{
		echo "<div class=\"textbox\">";
		echo "<h4 style=\"text-align:center;\">Welcome ".$userid." to the Admin Page</h4>";
		echo "<div>";
		echo "<br>";
		echo "<div style=\"text-align:right\">";
		echo "<input class=\"btn btn-primary\" type=\"button\" name=\"adduser\" value=\"+ Add User\" onclick=\"window.location ='adduser.php';\">";
		echo "</div>";
		$result = pg_query($db_conn,"SELECT * FROM \"public\".\"EmployeeLogin\";");
		echo "<table>";
		echo "<tr>";
		echo "<th align='center' width='200'> Serial No.</th>";
		echo "<th align='center' width='200'> User ID</th>";
		echo "<th align='center' width='200'> Password</th>";
		echo "<th align='center' width='200'> Role</th>";
		
		while($row=pg_fetch_assoc($result))
		{
			echo "<tr>";
			echo "<td align='center' width='200'>" . $row['sr_id'] . "</td>";
			echo "<td align='center' width='200'>" . $row['username'] . "</td>";
			echo "<td align='center' width='200'>" . $row['password'] . "</td>";
			echo "<td align='center' width='200'>" . $row['role'] . "</td>";
			echo "<td align='center' width='200'> 
			<form method=\"post\" action=\"edituser.php\">
			<button class=\"btn btn-secondary\" type=\"submit\" name=\"edituser\" value=".$row['username'].">Edit</button>
			</form>
			</td>";
			echo "<td align='center' width='200'> 
			<form method=\"post\" action=\"adminviewpage.php\">
			<button class=\"btn btn-secondary\" type=\"submit\" name=\"deleteuser\" value=".$row['username'].">Delete</button>
			</form>
			</td>";
			echo "</tr>";
		}
			echo "</table>";
			echo "<input class=\"btn btn-primary\" type=\"button\" name=\"logout\" value=\"Logout\" onclick=\"window.location ='loginpage.php';\">";
	}
	?>

	</body>
	</html>