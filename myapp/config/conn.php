<!-- connection to database -->
<?php
//echo "included config";
$path = str_ireplace(array('config'),'',dirname(__FILE__));
define('BASE_PATH',$path);
class connection{
	public $db_hostname='localhost';
	public $db_username='root';
	public $db_password='';
	public $start_time;
	public $dbh;
	//public $base_url = $path;
	//echo "\n".$path;
	//$base_url = $path;
	//define('BASE_URL',$path);
	//require_once(BASE_URL.'/config/conn.php');

	//mysql connection constructor
	public function __construct()
	{
		//echo $this->getBaseUrl();exit;
		try {
			//connect to database
		     $this->dbh = new PDO("mysql:host=$this->db_hostname;dbname=bca",$this->db_username,$this->db_password);
		     $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // <== add this line
		    
		    echo '<script> console.log("Connected to Database")</script>';
		}catch(PDOException $e)
		{
	    	echo $e->getMessage();
		}
	}
//select 
	public function check_login($uname,$pas)
	{
		$query = "SELECT SQL_CALC_FOUND_ROWS username,password,user_type FROM user 
		WHERE username='$uname' and password='$pas'";
		$sth = $this->dbh->query($query);
		$result = $this->dbh->query("SELECT FOUND_ROWS()"); 
		$res = $sth->fetch(PDO::FETCH_BOTH);
		//$result->store_result;
		$row_count = $result->fetchColumn();
			if($row_count > 0)
			{
				$_SESSION["test"]=time();
				$_SESSION['username'] = $uname;
				$_SESSION['password'] = $pas;
				if(isset($_POST['keepmelogin']))
				{
					setcookie("name",$uname);
					setcookie("password",$pas);
				}
				if($res['user_type'] == 'Admin'){
					$_SESSION['Admin'] = "Admin";
					$location = "location:../admin";
					header($location);
				}
				else{
					$location = "location:../user";
					header($location);
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
			try{
			$query="insert into user(firstname,lastname,username,password,user_type) values('$fname','$lname','$uname','$pas','subscriber');";
			
			$sth = $this->dbh->query($query);
			header("location:index.php");
			}catch(PDOException $e){
				if($e->getCode() == 23000){
				echo "<br><font color = 'red'>User Alerady exists or Something Wrong </font>";
				}
				else{
				echo $e->getMessage();
				}
			}
		}
	public function Add_User($fname,$lname,$uname,$pas,$user_type)
		{
			try{
			$query="insert into user(firstname,lastname,username,password,user_type) values('$fname','$lname','$uname','$pas','$user_type');";
			$sth = $this->dbh->query($query);
			echo "User Added Successfully";
			}catch(PDOException $e){
				if($e->getCode() == 23000){
				echo "<br><font color = 'red'>User Alerady exists or Something Wrong </font>";
				}
				else{
				echo $e->getMessage();
				}

			}
		}
	public function Update_User($id,$fname,$lname,$uname,$pas,$user_type)
		{
			try{
			$query = "update user set 
			firstname='$fname',
			lastname='$lname',
			username='$uname',
			password='$pas',
			user_type='$user_type'
			where id = $id
			";
			$sth = $this->dbh->query($query);
			echo "<font class = 'mysuccess'> User Updated Successfully </font><br>";
			}catch(PDOException $e){
				echo "<font class = 'mydanger'> Something Wrong </font><br>";
				echo $e->getMessage();
			}
		}
	public function get_header(){
		//echo $url = realpath(dirname(__ROOT__));exit;
		//require_once(BASE_PATH."/includes/header.php");
		//include ("/includes/header.php");
	}
	public function get_footer(){
		require_once(BASE_URL."/includes/footer.php");
		//include(BASE_URL."/includes/footer.php");
	}
	public function get_admin_header(){
		//echo $url = realpath(dirname(__ROOT__));exit;
		require_once(BASE_URL."/admin/admin_includes/admin_header.php");
		//include("/Admin/admin_includes/admin_header.php");
	}
	public function get_admin_footer(){
		require_once(BASE_URL."/admin/admin_includes/admin_footer.php");
		//include("/Admin/admin_includes/admin_footer.php");
	}
}
?>
