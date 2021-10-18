<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="../css/login-signup.css" />
    <title>Login - Doradora</title>
</head>

<body>
    <div class="login">
        <h1><a href="index.php">Doradora</a></h1>
        <h2>LOG IN</h2>
        <div class="login-form">
            <form action="index.php" method="POST">
                <p>Username</p>
                <input type="text" name="username" placeholder="Type your email" />
                <br />
                <br />
                <p>Password</p>
                <input type="password" name="password" placeholder="Type your password ">
                <br />
                <br />
                <div class="login-btn">
                    <input type="submit" value="Login" name="submit">
                </div>
            </form>
        </div>

        <div class="login-alt">
            <p>Or login with </p>
            <div class="login-alt-icon-container">
                <div class="apple-icon">
                    <i class="fab fa-apple fa-2x"></i>
                </div>

                <div class="facebook-icon">
                    <i class="fab fa-facebook-f fa-2x"></i>
                </div>

                <div class="google-icon">
                    <i class="fab fa-google fa-2x"></i>
                </div>

                <div class="twitter-icon">
                    <i class="fab fa-twitter fa-2x"></i>
                </div>
            </div>
        </div>

        <p>Not a member? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>
