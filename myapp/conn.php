
<?php
	
class connection
{
	public $con;
	public $start_time;
	//mysql connection cnstructor
	public function __construct($host,$username,$password,$db)
	{

	$this->con =mysqli_connect($host,$username,$password,$db);
	if($this->con)
		echo "<font class='mysuccess'>connection success</font>	<br>	";
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

		$query = "SELECT username,password,user_type FROM user WHERE username='$uname' and password='$pas'";
		
		$res = mysqli_query($this->con,$query);
		
		$rec = mysqli_fetch_assoc($res);
		
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
				if($rec['user_type'] == 'Admin'){
					$_SESSION['Admin'] = "Admin";
					header("Location:Admin/");
				}
				else{
					header("location:User/");
				}
			}
			else
			{
				?>
				<!--<script>alert("UserName or Password Wrong \n Something Went Wrong \n TryAgain")</script>-->
				<font class="mydanger">
				UserName or Password Wrong <br>
				Or <br>
				Something Went Wrong
				<br>
				</font>
				<?php
			}

	}
	
//insert

	public function insert($fname,$lname,$uname,$pas)
		{
			
			$query="insert into user(firstname,lastname,username,password,user_type) values('$fname','$lname','$uname','$pas','subscriber');";
			$q = mysqli_query($this->con,$query);
			
			if($q)	
			{
				$_SESSION['username'] = $uname;
				$_SESSION['password'] = $pas;
				header("location:User/index.php");
			}
			else
				echo "<font class = 'mydanger'>UserName Exists Or Something Wrong </font><br>";
				echo mysqli_error($this->con);
		}
		
	

	public function Add_User($fname,$lname,$uname,$pas,$user_type)
		{
			
			$query="insert into user(firstname,lastname,username,password,user_type) values('$fname','$lname','$uname','$pas',$user_type);";
			$q = mysqli_query($this->con,$query);
			
			if($q)	
			{
				echo "<font class = 'mysuccess'> User Added Successfully </font><br>";
				//header("location:User/index.php");
			}
			else
				echo "<font class = 'mydanger'> Something Wrong </font><br>";
				echo mysqli_error($this->con);
		}


	public function Update_User($id,$fname,$lname,$uname,$pas,$user_type)
		{
			
			$query = "update user set 
			firstname='$fname',
			lastname='$lname',
			username='$uname',
			password='$pas',
			user_type='$user_type'
			where id = $id
			";
			$q = mysqli_query($this->con,$query);
			
			if($q)	
			{
				echo "<font class = 'mysuccess'> User Updated Successfully </font><br>";
				//header("location:User/index.php");
			}
			else
				echo "<font class = 'mydanger'> Something Wrong </font><br>";
				echo mysqli_error($this->con);
		}
		
}




?>
