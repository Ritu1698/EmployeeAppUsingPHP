<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Add User</title>
</head>
<body>
<form action="adduser.php" method="post">
        <div class="row">
            <div class="col-sm-3">
                <h1>Add User</h1>
                <br>
                <div class="textbox">
                    <label for="srid"><b>Admin ID</b></label>
                    <input class="form-control" type="text" placeholder="Enter an id .." name="srid" value=""
                        required>
                </div>
                <br>
                <br>
                <div class="textbox">
                    <label for="adminid"><b>Username</b></label>
                    <input class="form-control" type="text" placeholder="Enter an id .." name="adminid" value=""
                        required>
                </div>
                <br>
                <div class="textbox">
                    <label for="password"><b>Password</b></label>
                    <input class="form-control" type="password" placeholder="Enter a password .." name="password"
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
                <input class="btn btn-primary" type="submit" name="add" value="Add">
                <input class="btn btn-primary" type="reset" name="reset" value="Reset">
            </div>
        </div>
    </form>
</body>
</html>

<?php
require_once 'db_connection.php';
//when add button hit of this page
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['add'])) {
    $srid = $_POST["srid"];
    $userid = $_POST["adminid"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $encryp_password= md5($password);
    $query = "INSERT INTO \"public\".\"EmployeeLogin\" VALUES ('$srid','$userid','$encryp_password','$role')";
    $result = pg_query($query); 
    if($result >= 1){
        header("Location: adminviewpage.php");
    }
    else{
        echo "<script language='javascript'>";
        echo "alert('Error in insertion!')";
        echo "</script>";
        die();
    }
    
}
?>