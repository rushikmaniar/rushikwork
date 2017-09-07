<!-- header.php -->
<?php session_start(); ?>
<?php require_once("conn.php"); 
$con = new connection();
$con->check_login("rushik","rushik");
?>


