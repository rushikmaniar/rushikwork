<!-- header.php -->
<?php 
echo $path = str_ireplace(array('admin_includes','\admin'),'',dirname(__FILE__));
//echo "\n".$path;
//$base_url = $path;
define('BASE_URL','http://localhost/github/rushikwork/myapp/');
define('BASE_PATH',$path);
require_once(BASE_PATH.'config/conn.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>My App</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>admin/assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>admin/assets/css/default.css">
</head>
<body>
<div id="wrapper">
  <div id="header">
    <div id="logo">
      <h1><a href="../index.php">MY APP</a></h1>
      <h2><span>By TEMPLATED</span></h2>
    </div>
    <!-- end div#logo -->
  </div>
  <!-- end div#header -->
  <div id="menu">
    <ul>
      <li class="active"><a href="<?php echo BASE_URL; ?>admin/index.php">Home</a></li>
      <li><a href="<?php echo BASE_URL; ?>admin/product/index.php">Manage Products</a></li>
      <li><a href="<?php echo BASE_URL; ?>admin/manage_user.php">Manage User</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  </div>
  <div id="splash"><img src="<?php echo BASE_URL; ?>admin/assets/images/img01.jpg" width="940" height="410" alt="" /></div>
  <!-- end div#menu -->

