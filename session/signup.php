<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>Session</title>
<link rel="stylesheet" type="text/css" href="css/my.css">
<script src="js/my.js"></script>
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
<h1 align="center">SignUp.php</h1>

<form method="POST">
  <table align="center" border="5">
    
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
    <td colspan="2"><input type="submit" name="insert_btn" value="SignUp" /></td>
    </tr>

  </table>
</form>

</body>
</html>