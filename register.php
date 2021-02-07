<?php
 ob_start();
 session_start();

 
 if(isset($_SESSION['user']) != ""){
 header("Location: index.php");
 }
 include_once 'includes/db_connect.php';

 if (isset($_POST['submit']))
 {
	$fname = trim($_POST["fname"]);
	$lname = trim($_POST["lname"]);
	$uname = trim($_POST["uname"]);
	$pass  = trim($_POST["pass"]);
	$email = trim($_POST["email"]);
	$country = trim($_POST["country"]);
	$phone  = trim($_POST["cell"]);
	$city = trim($_POST["city"]);
	$address = trim($_POST["address"]);
	$zip = trim($_POST["zip"]);
 
 
 
    if ($count == 0) { // if email is not found add user
        $stmts = $conn->prepare("INSERT INTO users(fname,lname,uname,pass,email,country,cell,city,address,zip) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmts->bind_param("ssss",$fname,$lname,$uname,$pass,$email,$country,$phone,$city,$address,$zip);
        $res = $stmts->execute();//get result
        $stmts->close();
        $user_id = mysqli_insert_id($conn);
        if ($user_id > 0) {
            $_SESSION['user'] = $user_id; // set session and redirect to index page
            if (isset($_SESSION['user'])) {
                print_r($_SESSION);
                header("Location: index.php");
                exit;
            }
        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again";
        }
    } else {
        $errTyp = "warning";
        $errMSG = "Email is already used";
    }
}
?>