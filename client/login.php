
<!DOCTYPE html>
<html>
    <head>
        <title>Login page</title>
        <link rel="stylesheet"href="css/style.css">
    </head>
    <body>
        <div class="container">
            <h1>Login</h1>
            <form action="login2.php" method="post">
            <div class="textbox">
                <input type="text" placeholder="" required=""name="email">
                <label>email</label>    
            </div>
                <div class="textbox">
                    <input type="password" placeholder="" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required="" name="password">
                    <label>password</label>
                </div>

                <input class="btn" type="submit" name="" value="Login"> 
            </form>
            <a class="b1" href="#">FORGOT PASSWORD?</a>
            <a class="b2" href="register.html">CREATE ACCOUNT</a>
            </div>
        </div>
    </body>
</html>
