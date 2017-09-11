<!-- header.php -->
<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>My App</title>
	<link rel="stylesheet" type="text/css" href="./assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./assets/css/my.css">
</head>
<body>
<header class="head">
	<a href = "index.php">
<img src="http://localhost/github/rushikwork/myapp/images/logo/logo1.png" alt="logo" style="border-radius: 15px">
<button class="btn-default btn-lg">
My App
</button>
</a>
<div align="right">
	<a href="logout.php">
<button class="btn btn-default btn-lg" id="btn-logout">Logout</button>
</a>
</div>
</header>
