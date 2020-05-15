<?php

session_start();
unset($_SESSION['clientemail']);
header("Location:home.php");

?>