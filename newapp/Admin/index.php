<?php 
session_start();
if(!(isset($_SESSION['Admin'])))
{
	die("<h3>If Your Admin <br> Please login Again </h3>
	<a href = '../index.php'><button>Login</button></a>
	<?php
	");
	//header ("location:../index.php");
}


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>My App</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/my.css">
</head>
<body>

<header class="head">
<a href = "../index.php">
<img src="../pics/logo1.png" alt="logo" style="border-radius: 15px">
<button class="btn-default btn-lg">
My App
</button>
</a>
<div align="right">
	<a href="../logout.php">
<button class="btn btn-default btn-lg" id="btn-logout">Logout</button>
</a>
</div>
</header>


<h1 class="h1">Hi Admin <?php echo $_SESSION['username']; ?></h1>
<h2 class="h2" align="center">What Do You Want To Do ?</h2><br>
<a href="manage_user.php">
<button class="btn btn-default btn-lg">Manage User</button>
</a>
<a href="product/">
<button class="btn btn-default btn-lg">Manage product</button>
</a>
</body>
</html>
<script src="../js/jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/my.js"></script>