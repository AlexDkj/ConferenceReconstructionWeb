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
 
 
 // check email exist or not
    $stmt = $conn->prepare("SELECT email FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
	
    $count = $result->num_rows;
 
 
 
    if ($count == 0) { // if email is not found add user
	
        $stmts = $conn->prepare("INSERT INTO 'users'('fname','lname','uname','pass','email','country','cell','city','address','zip') VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
<html>

<div class="navbar-header">
		<?php include 'includes/header.php';?>
	</div>
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="section-title">Registration Form</h3>
                </div>
            </div>
                
			<?php
			if (isset($errMSG)){
			
			
			?>
			<div class="form-group">
                        <div class="alert alert-<?php echo ($errTyp == "success") ? "success" : $errTyp; ?>">
                            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            <form action ="form.php"  method = "post" id="registration-form">
			
				<div class="row">
						<div class="col-md-12" id="registration-msg" style="display:none;">
							<div class="alert"></div>
						</div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name" id="fname" name="fname" required>
                        </div>
						
						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" id="uname" name="uname" required>
                        </div>
						
						<div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail" id="email" name="email" required>
                        </div>
						
						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone" id="cell" name="cell" required>
                        </div>
						
						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Address" id="address" name="address" required>
                        </div>
						
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name" id="lname" name="lname" required>
                        </div>
						
						<div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" id="pass" name="pass" required>
                        </div>

						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Country" id="country" name="country" required>
                        </div>
						
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="City" id="city" name="city" required>
                        </div>
						
						<div class="form-group">
                            <input type="text" class="form-control" placeholder="Zip Code" id="zip" name="zip" required>
                        </div>
                    </div>
                </div>
                <div class="text-center mt20">
                    <button type="submit" class="btn btn-black btn-lg" id="registration-submit-btn">Register </button>
                </div>
            </form>
			
        </div>
	
</html>