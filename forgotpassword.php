<!DOCTYPE html>
<html>
    <head>
        <title>Reset Your password</title>
        <link rel="stylesheet" href="css/style3.css">
    </head>
    <body>
    <div class="logo">
    <p>Reset Your Password</p>
    </div>
        <div class="container">
        <form action="reset-password.php"method="POST">
            <div class="textbox">
            <input type="email" name="email" required="">
            <label>Email Address</label>
        </div>
         	<input class="btn" type="submit" value="RECIEVE NEW PASSWORD BY EMAIL" name="reset">
        </form>

        <?php
        if(isset($_GET["reset"])){
            if($_GET["reset"] == "success"){
                echo '<p>Check your e-mail!</p>';
            }
        }
        ?>
        </div>
    </body>
</html>

