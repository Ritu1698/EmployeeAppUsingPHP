<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Edit User</title>
</head>
<body>
<form action="edituser.php" method="post">
        <div class="row">
            <div class="col-sm-3">
                <h1>Edit User</h1>
                <br>
                <div class="textbox">
                    <label for="srid"><b>Admin ID</b></label>
                    <input class="form-control" id = "srid" type="text" placeholder="Enter an id .." name="srid" value=""
                        required>
                </div>
                <br>
                <br>
                <div class="textbox">
                    <label for="adminid"><b>Username</b></label>
                    <input class="form-control" id="adminid" type="text" placeholder="Enter an id .." name="adminid" value=""
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
                <input type="hidden" id="oldsrid" name="oldsrid" value="">
                <br>
                <input class="btn btn-primary" type="submit" name="edit" value="Edit">
            </div>
        </div>
    </form>
</body>
</html>

<?php
require_once 'db_connection.php';
//When edit data coming from adminviewpage.php using post method
if ($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['edituser'])) {
    $result = pg_query($db_conn,"SELECT * FROM \"public\".\"EmployeeLogin\" where username = '".$_POST['edituser']."';");
    $row=pg_fetch_assoc($result);
    echo "<script>
    document.getElementById(\"srid\").value = ".$row['sr_id'].";
    document.getElementById(\"oldsrid\").value = ".$row['sr_id'].";
    document.getElementById(\"adminid\").value = '".$row['username']."';
    </script>";
     if($row['role'] == 'admin'){
         echo "<script>
         document.getElementById(\"role\").selectedIndex = 0;
         </script>";
     }
     else if($row['role'] == 'employee'){
         echo "<script>
         document.getElementById(\"role\").selectedIndex = 1;
         </script>";
     }

}
//When data to be updated coming from edit button in this page
else if($_SERVER["REQUEST_METHOD"]== "POST" && isset($_POST['edit'])){
    //When id value changed
    if($_POST['oldsrid'] != $_POST['srid']){
        //checking for newid instance in db
        $result = pg_query($db_conn, "SELECT sr_id FROM \"public\".\"EmployeeLogin\"where sr_id = '".$_POST['srid']."';");
        $row=pg_fetch_assoc($result);
        $fetch_srid = $row['sr_id'];
        //if newid present then error alert
        if($fetch_srid ==  $_POST['srid'] ){
            echo "<script language='javascript'>";
            echo "alert('Error in insertion!')";
            echo "</script>";
            die();
        }
    }
    //when id kept same deleting old instance
    $result = pg_query($db_conn, "DELETE FROM \"public\".\"EmployeeLogin\"where sr_id = '".$_POST['oldsrid']."';");
        $srid = $_POST["srid"];
        $userid = $_POST["adminid"];
        $password = $_POST["password"];
        $role = $_POST["role"];
        $encryp_password= md5($password);
        //inserting new instance
        $query = "INSERT INTO \"public\".\"EmployeeLogin\" VALUES ('$srid','$userid','$encryp_password','$role')";
        $result1 = pg_query($query); 
        echo $result1;
        //query executed correctly
        if($result1 >= 1){
            header("Location: adminviewpage.php");
        }
        //error in insert query
        else{
            echo "<script language='javascript'>";
            echo "alert('Error in insertion!')";
            echo "</script>";
            die();
        }
    
    
}
?>