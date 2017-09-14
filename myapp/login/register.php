<?php session_start(); 
require_once("../config/conn.php");
$con = new connection();
?>
<?php 
/*if(isset($_COOKIE['name']) && isset($_COOKIE['password'])){
header("location:user.php");
}*/
//if login btn clicked
if(isset($_POST['signup_btn'])  && ($_POST['signup_btn']=="Submit")){
//init_set('session.ge_maxlifetime',1);
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$uname = $_POST['username'];
$pas = $_POST['password'];
//$_SESSION["username"] = $uname;
//$_SESSION["password"] = $pas;
// header("location:user.php");
$r = $con->insert($fname,$lname,$uname,$pas);
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
		<form action="" method="post">
		<h1>MY APP</h1><img src="../images/logo/logo1.png" alt="logo">
			<h1>SignUp Form</h1>
			<div>
				<input type="text" placeholder="firstname" required="" id="firstname" name="username" />
			</div>
			<div>
				<input type="text" placeholder="lastname" required="" id="lastname" name="username" />
			</div>
			<div>
				<input type="text" placeholder="Username" required="" id="username" name="username" />
			</div>
			<div>
				<input type="password" placeholder="Password" required="" id="password" name="password" />
			</div>
			<div>
				<input type="submit" value="Submit" name="signup_btn"/>
				<a href="#">Lost your password?</a>
				<a href="index.php">Already Memeber</a>
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
