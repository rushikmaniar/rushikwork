<!-- header.php -->
<?php 
$path = str_ireplace(array('admin_includes','admin'),'',dirname(__FILE__));
//echo "\n".$path;
//$base_url = $path;
define('BASE_URL',$path);
require_once(BASE_URL.'/config/conn.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>My App</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/github/rushikwork/myapp/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/github/rushikwork/myapp/assets/css/my.css">
</head>
<body>
<header class="admin_head">
	<a href = "index.php">
<img src="http://localhost/github/rushikwork/myapp/images/logo/logo1.png" alt="logo" style="border-radius: 15px; background-color: white;">
<button class="btn-default btn-lg">
My App
</button>
</a>
<div align="right">
	<a href="http://localhost/github/rushikwork/myapp/logout.php">
<button class="btn btn-default btn-lg" id="btn-logout">Logout</button>
</a>
</div>
</header>
