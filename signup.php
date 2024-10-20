<!DOCTYPE html>
<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "fragrance_loungue";

$mysqli = new mysqli($servername, $username, $password, $db) or die($mysqli->error);

if (isset($_POST['signup'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $cemail = trim($_POST['cemail']);
    $location = trim($_POST['location']);
    $address = trim($_POST['address']);
    $gender = trim($_POST['gender']);
    $pass = trim($_POST['pass']);
    $pno = trim($_POST['pno']);

    // Server-side validation
    if (empty($fname) || empty($lname) || empty($cemail) || empty($location) || empty($address) || empty($gender) || empty($pass) || empty($pno)) {
        echo '<script>alert("All fields are required.");</script>';
    } elseif (!filter_var($cemail, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format.");</script>';
    } elseif (!preg_match('/^[0-9]{10}$/', $pno)) {
        echo '<script>alert("Invalid phone number format. It should be a 10-digit number.");</script>';
    } else {
        $stmt = $mysqli->prepare("INSERT INTO customers (firstname, email, gender, location, phone_number, lastname, address, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $fname, $cemail, $gender, $location, $pno, $lname, $address, $pass);

        if ($stmt->execute()) {
            echo '<script>alert("Account created successfully"); window.location.replace("login.php");</script>';
            exit();
        } else {
            echo '<script>alert("Operation failed"); window.location.replace("signup.php");</script>';
            exit();
        }
    }
}
?>
<html lang="en">
<head>
    <title>Welcome To Fragrance Lounge</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="./Login/images/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="./Login/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./Login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./Login/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="./Login/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="./Login/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="./Login/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="./Login/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="./Login/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="./Login/css/util.css">
    <link rel="stylesheet" type="text/css" href="./Login/css/main.css">
    <script>
        function validateForm() {
            var fname = document.forms["signupForm"]["fname"].value;
            var lname = document.forms["signupForm"]["lname"].value;
            var cemail = document.forms["signupForm"]["cemail"].value;
            var location = document.forms["signupForm"]["location"].value;
            var address = document.forms["signupForm"]["address"].value;
            var gender = document.forms["signupForm"]["gender"].value;
            var pass = document.forms["signupForm"]["pass"].value;
            var pno = document.forms["signupForm"]["pno"].value;

            if (fname == "" || lname == "" || cemail == "" || location == "" || address == "" || gender == "" || pass == "" || pno == "") {
                alert("All fields are required.");
                return false;
            }

            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(cemail)) {
                alert("Invalid email format.");
                return false;
            }

            var phonePattern = /^[0-9]{10}$/;
            if (!phonePattern.test(pno)) {
                alert("Invalid phone number format. It should be a 10-digit number.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form name="signupForm" class="login100-form validate-form" method="POST" onsubmit="return validateForm()">
                    <span class="login100-form-title p-b-49">
                        Welcome To Fragrance Lounge
                    </span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="First Name is required">
                        <span class="label-input100">First Name</span>
                        <input class="input100" type="text" name="fname" placeholder="Type your first name">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Last Name is required">
                        <span class="label-input100">Last Name</span>
                        <input class="input100" type="text" name="lname" placeholder="Type your last name">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Phone Number is required">
                        <span class="label-input100">Phone Number</span>
                        <input class="input100" type="text" name="pno" placeholder="Type your phone number">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                        <span class="label-input100">Email</span>
                        <input class="input100" type="text" name="cemail" placeholder="Type your email">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Location is required">
                        <span class="label-input100">Location</span>
                        <input class="input100" type="text" name="location" placeholder="Type your location">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Address is required">
                        <span class="label-input100">Address</span>
                        <input class="input100" type="text" name="address" placeholder="Type your address">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Gender is required">
                        <span class="label-input100">Gender</span>
                        <select class="input100" name="gender">
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="pass" placeholder="Type your password">
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
                </form>
            </div>
        </div>
    </div>

    <div id="dropDownSelect1"></div>

    <script src="./Login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="./Login/vendor/animsition/js/animsition.min.js"></script>
    <script src="./Login/vendor/bootstrap/js/popper.js"></script>
    <script src="./Login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./Login/vendor/select2/select2.min.js"></script>
    <script src="./Login/vendor/daterangepicker/moment.min.js"></script>
    <script src="./Login/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="./Login/vendor/countdowntime/countdowntime.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
