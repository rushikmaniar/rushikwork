<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>My App</title>
  <!-- Css Include -->

<link rel="stylesheet" type="text/css" href="css/my.css">


</head>

<?php
require_once "conn.php";

$obj = new connection("localhost","root","","bca");



if(isset($_POST['insert_btn'])  && ($_POST['insert_btn']=="SignUp" ))
{
	$firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $password = $_POST['password'];

  $_SESSION['firstname'] = $firstname;
  $_SESSION['lastname'] = $lastname;
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;
   
  $obj->insert($firstname,$lastname,$username,$password);
  
}


?>
<body>
<header class="head">
<a href = "index.php">
<img src="pics/logo1.png" alt="logo" style="border-radius: 15px">
<button class="btn-default">

My App
</button>
</a>
</header>

<h1 align="center" class="h1">SignUp.php</h1>

<form method="POST">
  <table align="center" border="5" class="table-condensed" width="30%">
    
    <tr>
    <td>FirstName</td>
    <td><input type="text" name="firstname"/></td>
    </tr>

    <tr>
    <td>Lastname</td>
    <td><input type="text" name="lastname"/></td>
    </tr>

    <tr>
    <td>Username</td>
    <td><input type="text" name="username"/></td>
    </tr>

    <tr>
    <td>Password</td>
    <td><input type="text" name="password"/></td>
    </tr>

    <tr>
    <td colspan="2"><center><input type="submit" name="insert_btn" value="SignUp" /></td></center>
    </tr>

  </table>
</form>

</body>
</html>
<!-- Javascript Include -->

<script src="js/jquery/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script> 
<script src="js/my.js"></script>

