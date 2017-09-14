<?php session_start(); 
require_once("../config/conn.php");
$con = new connection();
?>
<?php 
/*if(isset($_COOKIE['name']) && isset($_COOKIE['password'])){
header("location:user.php");
}*/
//if login btn clicked
if(isset($_POST['login_btn'])  && ($_POST['login_btn']=="Submit")){
//init_set('session.ge_maxlifetime',1);
$uname = $_POST['username'];
$pas = $_POST['password'];
//$_SESSION["username"] = $uname;
//$_SESSION["password"] = $pas;
// header("location:user.php");
$r = $con->check_login($uname,$pas);
}
?>
<!DOCTYPE>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login form using HTML5 and CSS3</title>
  
  
  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <body>
<div class="container">
	<section id="content">
		<h1>MY APP</h1><img src="../images/logo/logo1.png" alt="logo">
		<form action="" method="post">
			<h1>Login Form</h1>
			<div>
				<input type="text" placeholder="Username" required="" id="username" name="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" name="password" />
			</div>
			<div>
				<input type="submit" value="Submit" name="login_btn" />
				<a href="#">Lost your password?</a>
				<a href="register.php">Register</a>
			</div>
		</form><!-- form -->
	<!--	<div class="button">
			<a href="#">Download source file</a>
		</div>--><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
  
    <script src="js/index.js"></script>

</body>
</html>
