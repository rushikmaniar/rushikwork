<?php //session_start();


?>
<!DOCTYPE html>
<html>
<head>
	<title>Session</title>
<link rel="stylesheet" type="text/css" href="css/my.css">
<script src="js/jquery/jquery.min.js"></script>
<script src="js/my.js"></script>
</head>
<body>
<h1 align="center">login.php</h1>

<form method="POST">
  <table align="center" border="5">
    
    <tr>
    <td>FirstName</td>
    <td><input type="text" name="firstname"/></td>
    </tr>

    <tr>
    <td>Password</td>
    <td><input type="text" name="password"/></td>
    </tr>
    
    <tr>
    <td colspan="2"><input type="submit" name="login_btn" value="Submit" /></td>
    </tr>

  </table>
  <br>
  <center>
    <input type="checkbox" name="keepmelogin" value="keepmelogin" id="keepmelogin" />Keep Me logged in
    </center>
    <br>
</form>

<p align="center"><a href="signup.php">Not Memeber ?</a></p>
</body>
</html>


<?php
//include files
require_once "conn.php";
//create object of connection
$obj = new connection("localhost","root","","bca");

echo $_COOKIE['name'];
echo $_COOKIE['password'];


//check if cokkies are set
if(isset($_COOKIE['name']) && isset($_COOKIE['password'])){
  header("location:user.php");
}

//if login btn clicked
if(isset($_POST['login_btn'])  && ($_POST['login_btn']=="Submit")){
  //init_set('session.ge_maxlifetime',1);
  $uname = $_POST['firstname'];
  $pas = $_POST['password'];
  

  //$_SESSION["username"] = $uname;
  //$_SESSION["password"] = $pas;
 // header("location:user.php");
  $r = $obj->check_login($uname,$pas);
}
?>
