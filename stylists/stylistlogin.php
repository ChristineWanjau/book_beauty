<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="css/style3.css">
    </head>
    <body>
    <div class="logo">
    <p>LOGIN AS A STYLIST</p>
    </div>
        <div class="container">
        <form action="login.php"method="POST">
            <div class="textbox">
            <input type="email" name="email" required="">
            <label>Email Address</label>
        </div>

        <div class="textbox">
            <input type="password" name="password" required="">
            <label>Password</label>
            </div>
            <input type="submit" class="btn" name="login" value="Log in"><br>
            <a href="#">Forgot password?</a>
            <p>Don't have an account already?</p><a href="stylistregister.php">Sign in</a>
        </form>
        </div>
    </body>
</html>