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
            <input type="password" name="password"required="">
            <label>Password</label>
            </div>
            <input type="submit" class="btn" name="login" value="Log in"><br>
            <?php
            if(isset($_GET["newpwd"])){
                if($_GET['newpwd'] == "passwordupdated"){
                    echo '<p>Your password has been reset!</p>';
                }
            }
            ?>
            <a href="forgotpassword.php">Forgot password?</a>
            <p>Don't have an account already?</p><a href="index.php">Sign in</a>
        </form>
        </div>
    </body>
</html>