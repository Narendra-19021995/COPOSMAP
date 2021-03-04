<?php
include 'Admin/logincon.php'; // Includes Login Script
if (isset($_SESSION['login_user'])) {
    header("location: Admin/profile.php"); // Redirecting To Profile Page
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="COPO.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Bootstrap\css\bootstrap.min.css">
    <style>
    body {
        background-image: linear-gradient(to);
        height: 100vh;
    }

    #login .container #login-row #login-column .login-box {
        margin-top: 120px;
        max-width: 600px;
        height: 320px;
        border: 1px solid #9C9C9C;
        background-image: linear-gradient(to bottom, #aec1c3, #a9b5b7, #bcc5c6, #cfd5d5, #e3e5e5);
    }

    #login .container #login-row #login-column .login-box #login-form {
        padding: 20px;
    }

    #login .container #login-row #login-column .login-box #login-form #register-link {
        margin-top: -85px;
    }
    </style>

    <title>Login</title>
</head>

<body>
    <div id="login">
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div class="login-box col-md-12">
                        <form id="login-form" class="form" action="<?php $PHP_SELF?>" method="post">
                            <h3 class="text-center text-info">Admin Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" placeholder="Username"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" placeholder="******" id="password"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="remember-me" class="text-info"><span>Remember me</span> <span><input
                                            id="remember-me" name="remember-me" type="checkbox"></span></label><br>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Login">
                                <span><?php echo $error; ?></span>
                            </div>
                            <!-- <div id="register-link" class="text-right">
                                <a href="#" class="text-info">Register here</a>
                            </div> -->
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="Bootstrap\js\Jquery.js"></script>
    <script src="Bootstrap\js\bootstrap.min.js"></script>
</body>

</html>