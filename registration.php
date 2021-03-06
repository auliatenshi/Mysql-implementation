<!DOCTYPE html>
<html>

<head>
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Client area</title>
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-03.png" alt="IMG">
                </div>

                <?php
                require('db.php');
                // When form submitted, insert values into the database.
                if (isset($_REQUEST['username'])) {
                    // removes backslashes
                    $username = stripslashes($_REQUEST['username']);
                    //escapes special characters in a string
                    $username = mysqli_real_escape_string($con, $username);
                    $email    = stripslashes($_REQUEST['email']);
                    $email    = mysqli_real_escape_string($con, $email);
                    $password = stripslashes($_REQUEST['password']);
                    $password = mysqli_real_escape_string($con, $password);
                    $create_datetime = date("Y-m-d H:i:s");

                    // Chek Username & Email availability
                    $sql_user = "SELECT * FROM users WHERE username='$username'";
                    $sql_email = "SELECT * FROM users WHERE email='$email'";
                    $res_user = mysqli_query($con, $sql_user);
                    $res_email = mysqli_query($con, $sql_email);

                    if (mysqli_num_rows($res_user) > 0) {
                        echo "<div class='login100-form'>
					  <center><h3>Username has already been taken</h3></center><br/><br>
						<form action='registration.php'>
							<button class='login100-form-btn' href='registration.php' >
								Back To Registration
							</button>
						</form><br>
					  </div>";
                    } else if (mysqli_num_rows($res_email) > 0) {
                        echo "<div class='login100-form'>
					  <center><h3>Email has already been taken</h3></center><br/><br>
						<form action='registration.php'>
							<button class='login100-form-btn' href='registration.php' >
								Back To Registration
							</button>
						</form><br>
					  </div>";
                    }

                    // If Username & Email available
                    else {
                        $query    = "INSERT into `users` (username, password, email, create_datetime)
						 VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime')";
                        $result   = mysqli_query($con, $query);
                        if ($result) {
                            echo "<div class='login100-form'>
					  <center><h3>You are registered successfully.</h3></center><br/><br>
					  <form action='index.php'>
							<button class='login100-form-btn' href='index.php' >
								Login
							</button>
							</form><br>
					  </div>";
                        } else {
                            echo "<div class='login100-form'>
				<center><h3>Required fields are missing.</h3></center><br/>
					  <form action='registration.php'>
							<button class='login100-form-btn' href='registration.php' >
								Registration
							</button>
							</form>
					  </div>";
                        }
                    }
                }
                // Form Section
                else {
                ?>
                    <form class="login100-form validate-form" method="post" name="login">
                        <span class="login100-form-title">
                            Member Registration
                        </span>

                        <div class="wrap-input100 validate-input" data-validate="Username Is Required">
                            <input class="input100" type="text" name="username" placeholder="Username">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="wrap-input100 validate-input" data-validate="Email Is Required">
                            <input class="input100" type="text" name="email" placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" name="password" placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="login100-form-btn" type="submit" value="Register" name="submit">
                                Register
                            </button>
                        </div><br>
                        <div class="text-center p-t-12">
                            <a class="txt2" href="index.php">
                                Already have an account ? Login!
                            </a>
                        </div>
                        <br>

                    </form>
                <?php
                }
                ?>
                <!--===============================================================================================-->
                <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/bootstrap/js/popper.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/select2/select2.min.js"></script>
                <!--===============================================================================================-->
                <script src="vendor/tilt/tilt.jquery.min.js"></script>
                <script>
                    $('.js-tilt').tilt({
                        scale: 1.1
                    })
                </script>
                <!--===============================================================================================-->
                <script src="js/main.js"></script>

</body>

</html>