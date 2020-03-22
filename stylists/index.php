<!DOCTYPE html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="css/style3.css">
    </head>
    <body>
    <div class="logo">
    <p>REGISTER AS A STYLIST</p>
    </div>
        <div class="error"></div>
        <div class="container">
        <form action="stylistregister2.php"method="POST">
            <div class="textbox">
            <input id="name" type="text" name="businessname" required="">
            <label>What is the name of your business?</label>
        </div>
        <div class="textbox">
            <input type="text" name="name" required="">
            <label>What is your name?</label>
            </div>
            <div class="textbox">
            <input type="email" name="email" required="">
            <label>What is your email address?</label>
            </div>
             <div class="textbox">
            <input type="text" name="contact" pattern="[0-9]{10}" maxlength="10"  title="10 numeric digits only" required="">
            <label>What is your business contact?</label>
        </div>
        <div class="textbox">
            <input type="text" name="location" required="">
            <label>What is your location?</label>
        </div>
             <div class="textbox">
            <input type="password" name="password" pattern="^\S{4,}$" required="">
            <label> Set your Password</label>
            </div>
             <div class="textbox">
            <input type="password" name="confirm" required="">
            <label> Confirm Password</label>
            </div>
             <input type="submit" class="btn" value="Create your book beauty account">
            <p>Already a user?</p>
            <a href="stylistlogin.php">Log in</a>
        </form>
        </div>
    </body>
</html>

