	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title>Login Page</title>
	</head>

	<body>
		<form action="loginpage.php" method="post">
			<div class="row">
				<div class="col-sm-3">
					<h1>Login</h1>
					<br>
					<div class="textbox">
						<label for="adminid"><b>User ID</b></label>
						<input class="form-control" type="text" placeholder="Enter your id .." name="adminid" value=""
							required>
					</div>
					<br>
					<div class="textbox">
						<label for="password"><b>Password</b></label>
						<input class="form-control" type="password" placeholder="Enter your password .." name="password"
							value="" required>
					</div>
					<br>
					<div class="textbox">
						<label for="role"><b>Role</b></label>
						<select class="form-control" name="role" id="role">
							<option value="admin" selected="selected">Admin</option>
							<option value="employee">Employee</option>
						</select>
					</div>
					<br>
					<input class="btn btn-primary" type="submit" name="login" value="Sign In">
					<input class="btn btn-primary" type="reset" name="reset" value="Reset">
				</div>
			</div>
		</form>
	</body>

	</html>


	<?php
	session_start();
	$_SESSION['id'] = '';
	require_once 'db_connection.php';
	//When login button of this page submitted
	if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['login'])) {
		 
		$userid = $_POST["adminid"];
		$password = $_POST["password"];
		$role = $_POST["role"];
		//checking admin role
		if($role == "admin")
		{
			$result = pg_query($db_conn, "SELECT password FROM \"public\".\"EmployeeLogin\"where username = '".$userid."' and role = '".$role."';");
			$row=pg_fetch_assoc($result);
			$fetch_password = $row['password'];
			$password_encryp = md5($password);
			//password matching
			if($password_encryp == $fetch_password) {
				$_SESSION['id'] = $userid;
				//will go to adminviewpage if correct password
				header("Location: adminviewpage.php");
			}
			//else error alert
			else {
				echo "<script language='javascript'>";
				echo "alert('Wrong Information')";
				echo "</script>";
				die();
			}
		}
		
		//checking if employee role
		else if($role == "employee"){
			$result = pg_query($db_conn, "SELECT password FROM \"public\".\"EmployeeLogin\"where username = '".$userid."';");
			$row=pg_fetch_assoc($result);
			$fetch_password = $row['password'];
			$password_encryp = md5($password);
			//password matching
			if($password_encryp == $fetch_password) {
					$_SESSION['id'] = $userid;
					//goes to employeeviewpage
					header("Location: employeeviewpage.php");
			}
			//else error alert
			else {
				echo "<script language='javascript'>";
				echo "alert('Wrong Information')";
				echo "</script>";
				die();
			}
		}
		
	}
	?>