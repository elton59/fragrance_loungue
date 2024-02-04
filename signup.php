<!DOCTYPE html>
<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "fragrance_loungue";
$mysqli = new  mysqli($servername, $username, $password,$db) or die($mysqli->error);
   if(isset($_POST['signup']))
{

	$fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $cemail=$_POST['cemail'];
    $location=$_POST['location'];
	$address=$_POST['address'];
    $gender=$_POST['gender'];
    $pass=$_POST['pass'];
    $pno=$_POST['pno'];

$result =$mysqli->query("INSERT into customers(firstname,email,gender,location,phone_number,lastname,address,password) VALUES('$fname','$cemail','$gender','$location','$pno','$lname','$address','$pass')") or die($mysqli->error);

if ($result){
echo 

'<script>alert("Account created successfully");
				window.location.replace("login.php");
		</script>';


exit();
}
else
{
echo '<script>alert("Operation failed");
				window.location.replace("signup.php");
		</script>';
exit();
}
}

?>
<html lang="en">
<head>
	<title>Welcome To fragrance Longue</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="./Login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./Login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="./Login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="./Login/css/util.css">
	<link rel="stylesheet" type="text/css" href="./Login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="POST">
					<span class="login100-form-title p-b-49">
						Welcome To Fragrance Longue
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">FirstName</span>
						<input class="input100" type="text" name="fname" placeholder="Type your username" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">LastName</span>
						<input class="input100" type="text" name="lname" placeholder="lastname" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">PhoneNumber</span>
						<input class="input100" type="text" name="pno" placeholder="Phone Number" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="cemail" placeholder="Type your username" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Location</span>
						<input class="input100" type="text" name="location" placeholder="Type your username">
						<span class="focus-input100" data-symbol="&#xf206;" required></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Address</span>
						<input class="input100" type="text" name="address" placeholder="Type your username" required>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Gender</span>
						<select class="input100" type="text" name="gender" required>
						<option class="focus-input100" data-symbol="&#xf206;" value="female">female</span></option>
                        <option class="focus-input100" data-symbol="&#xf206;" value="male">male</span>
                        </option></select>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="Type your password" required>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					
					<div class="text-right p-t-8 p-b-31">
						<a href="#">
							Forgot password?
						</a>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button type="submit" class="login100-form-btn" name="signup">
								Signup
							</button>
						</div>
					</div>

					<div class="txt1 text-center p-t-54 p-b-20">
						<span>
							<a href="signup.php" style="color:blue">Click here to create account</a>
						</span>
                        <br/>
                        <span>
							Follow us on:
						</span>
					</div>

					<div class="flex-c-m">
						<a href="#" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="#" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="#" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>					
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="./Login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="./Login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="./Login/vendor/bootstrap/js/popper.js"></script>
	<script src="./Login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="./Login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="./Login/vendor/daterangepicker/moment.min.js"></script>
	<script src="./Login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="./Login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>