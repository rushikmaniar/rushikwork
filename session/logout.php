<?php
session_start();

unset($_SESSION['username']);
setcookie("name","");
setcookie("password","");
header("location:index.php");

?>