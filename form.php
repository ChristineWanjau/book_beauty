<?php

include('config.php');

if(isset($_POST['fullname']) && isset($_POST['course']) && isset($_POST['admin'])&& isset($_POST['pwd']))
{ 
    $fullname=$_POST['fullname'];
    $course=$_POST['course'];
    $admission=$_POST['admin'];
    $password=$_POST['pwd'];


    $insert="INSERT INTO student(admission,fullname,course, password ,datetime)VALUES('$admission','$fullname','$course','$password',NOW())";
    $insertquery=mysqli_query($connection,$insert);
    if($insertquery)
    {
        echo
        "
        <script>
        alert('registered successfully');
        window.location.href='superadmin.php';
        </script>
        ";


    }
    else
    {
        echo
        "
        <script>
        alert('Unable to register');
        window.location.href='superadmin.php';
        </script>
        ";

    }



}
else{
    echo 
    "<script>
    alert('Please fill in all the fields');
    window.location.href='index.html';
    </script>";
}
?>