<?php
session_start();
class connection
{
	public $con;
	public $start_time;
	//mysql connection cnstructor
	public function __construct($host,$username,$password,$db)
	{

	$this->con =mysqli_connect($host,$username,$password,$db);
	if($this->con)
		echo "connection success<br>";
	else
		echo mysql_error();


	}
//select 
	
	public function check_login($uname,$pas)
	{
		//echo $_SESSION['username'];
		//echo $_SESSION['password'];
		//$uname = $_SESSION['username'];
		//$pas = $_SESSION['password'];

		$query = "SELECT username,password FROM user WHERE username='$uname' and password='$pas'";
		
		$res = mysqli_query($this->con,$query);
		/*if($res)
		{
			//echo "login success";
			header("location:user.php");
		}
		else
		{
			echo mysqli_error($this->con);
		}*/

		$rec = mysqli_fetch_assoc($res);
		//print_r($rec);
		/*if($rec['username']=='$uname' &&
			 $rec['password']=='$pas')
		{
			
			echo "login success";
		}
		else
			echo mysqli_error($this->con);
		*/
			if(mysqli_num_rows($res) > 0)
			{
				$_SESSION["test"]=time();
				$_SESSION['username'] = $uname;
				$_SESSION['password'] = $pas;
				if(isset($_POST['keepmelogin']))
				{
					setcookie("name",$uname);
					setcookie("password",$pas);
				}

				header("location:user.php");
			}
			else
			{
				echo "incorrct username or password";
				
			}

	}
	
//insert

	public function insert($fname,$lname,$uname,$pas)
		{
			
			$query="insert into user(firstname,lastname,username,password) values('$fname','$lname','$uname','$pas');";
			$q = mysqli_query($this->con,$query);
			
			if($q)	
			{
				$_SESSION['username'] = $uname;
				$_SESSION['password'] = $pas;
				header("location:user.php");
			}
			else
				echo mysqli_error($this->con);
		}
		
}




?>