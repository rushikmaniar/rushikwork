<?php
	require_once "conn.php";
	//ini_set('session.ge_maxlife',$fixtime);
	/*echo $_SESSION['test']."<br>";
	echo time();
	*/
	/*isset ($_SESSION['test'])?$_SESSION['test']:time();
	
	$diff = time() - $_SESSION['test'];
	if($diff > 15)
	{
		echo "hello";
		
		unset($_SESSION['username']);
		setcookie("name","");
		setcookie("password","");
		header("location:index.php");
	}
	*/

?>
<!DOCTYPE html>
<html>
	<head>
		<title>login success</title>
	</head>
	<body>
		<div align="right">
			<a href="logout.php">
				<button>logout</button>
			</a>
		</div>
		<h1>Hi</h1>
		<?php
		echo "<h1>".$_SESSION['username']."</h1>"."<br>";
		?>
	</body>
</html>