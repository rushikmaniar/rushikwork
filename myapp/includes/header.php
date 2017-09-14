<!-- header.php -->
<?php 
//echo "<pre>";
//print_r($basepath = $_SERVER['SCRIPT_FILENAME']);
//echo "\n".__FILE__;
$path = str_ireplace(array('includes'),'',dirname(__FILE__));
//echo "\n".$path;
//$base_url = $path;
define('BASE_URL',$path);
require_once(BASE_URL.'/config/conn.php');
$con = new connection();
$query = "select * from user where username = '".$_SESSION['username']."'";
$sth = $con->dbh->query($query);
$user_info = $sth->fetch(PDO::FETCH_BOTH);
//echo "</pre>";
//exit;
 ?>
 <!--
<!DOCTYPE html>
<html>
<head>
	<title>My App</title>
	<link rel="stylesheet" type="text/css" href="http://localhost/github/rushikwork/myapp/assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="http://localhost/github/rushikwork/myapp/assets/css/my.css">
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
	<a href="http://localhost/github/rushikwork/myapp/logout.php">
<button class="btn btn-default btn-lg" id="btn-logout">Logout</button>
</a>
</div>
</header>
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Bananaleaf by TEMPLATED</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="../assets/css/style.css" rel="stylesheet" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="../user/index.php">Homepage</a></li>
			<li><a href="../user/products.php">Products</a></li>
			<li><a href="../user/photos.php">Photos</a></li>
			<li><a href="../user/update_profile.php?id=<?php echo $user_info['id']; ?>">My Profile</a></li>
			<li><a href="../logout.php">Logout</a></li>
		</ul>
	</div>
</div>
<div id="logo">
	<h1><a href="#">My App</a></h1>
	<h2>Design By Rushik</h2>
</div>
