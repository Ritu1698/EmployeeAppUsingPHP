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
		echo "<div class=\"row\">";
		echo "<div class=\"col-sm-3\">";
		echo "<form action=\"\" method=\"post\" enctype=\"multipart/form-data\">  
				<input class=\"form-control\" type=\"file\" name=\"fileToUpload\"/>  
				<br>
				<input class=\"btn btn-primary\" type=\"submit\" value=\"Upload\" name=\"submit\"/>  
				<input class=\"btn btn-primary\" type=\"button\" name=\"logout\" value=\"Logout\" onclick=\"window.location ='loginpage.php';\">
			</form>";
		echo"</div>";
		echo"</div>";
	}
	
	if(isset($_FILES['fileToUpload'])){
		  $errors=0;
		  $file_name = $_FILES['fileToUpload']['name'];
		  $file_size =$_FILES['fileToUpload']['size'];
		  $file_tmp =$_FILES['fileToUpload']['tmp_name'];
		  $file_type=$_FILES['fileToUpload']['type'];
		  $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
		  
		  $extensions= array("xlsx","xlsm","xlsb", "xltx", "xltm");
		  
		  if(in_array($file_ext,$extensions)=== false){
			 $errors = 1;
		  }
		  
		  if($errors==0){
			 move_uploaded_file($file_tmp,"K:/".$file_name);
			  echo "<script language='javascript'>";
			  echo "alert('Sucessfully Added!!!')";
			  echo "</script>";
		  }
		  else if($errors == 1){
			echo "<script language='javascript'>";
			echo "alert('extension not allowed, please choose a JPEG or PNG file.')";
			echo "</script>"; 
		  }
		  unset($_FILES['fileToUpload']);
		  unset($_POST);
		  header("Refresh:0");
		}

	?>