<!-- Connection of Database-->
<?php
session_start();
?>
<?php
if(!(isset($_SESSION['Admin'])))
{
	die("<h3>If Your Admin <br> Please login Again </h3>
	<a href = '../index.php'><button>Login</button></a>
<?php
");
//header ("location:../index.php");
}
?>
<?php
include "../conn.php";
$con = new connection();
$username1 = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My App</title>
		<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../css/my.css">
	</head>
	<header class="head">
		<a href = "../index.php">
			<img src="../pics/logo1.png" alt="logo" style="border-radius: 15px">
			<button class="btn-default">
			My App
			</button>
		</a>
		<div align="right">
			<a href="../logout.php">
				<button class="btn btn-default btn-lg" id="btn-logout">Logout</button>
			</a>
		</div>
	</header>
	<body>
		<h1 class="h1" align="center">Edit User</h1>
		<?php
		$id = $_REQUEST['id'];
		$display_query = "SELECT * FROM user where id = $id ";
		$sth = $con->dbh->query($display_query);
		$rec = $sth->fetch(PDO::FETCH_BOTH);
		$row_count = $sth->fetchColumn();
		$firstname = $rec['firstname'];
		$lastname = $rec['lastname'];
		$username = $rec['username'];
		$password = $rec['password'];
		$user_type = $rec['user_type'];
		if(isset($_POST['update'])){
			$firstname = $_POST['fname'];
			$lastname = $_POST['lname'];
			$username = $_POST['uname'];
			$password = $_POST['pas'];
			$user_type = $_POST['user_type'];
			$con->Update_User($id,$firstname,$lastname,$username,$password,$user_type);
		}
		?>
		<form name='edit' method='post' id="form-edit">
			<table border="1" width="500" cellspacing="0" cellpadding="10" align="center" id="table-insert">
				<!-- FirstName-->
				<tr align="center">
					<td  height="50">
						<label>First Name</label>
					</td>
					<td align="center">
						<input type='text' name='fname' class="input-sm" value="<?php echo $firstname; ?>">
					</td>
				</tr>
				<!-- LastName-->
				<tr align="center">
					<td height="50">
						<label>Last Name</label>
					</td>
					<td>
						<input type='text' name='lname' class="input-sm"  value="<?php echo $lastname;?>">
					</td>
				</tr>
				<!-- UserName-->
				<tr align="center">
					<td height="50">
						<label>User Name</label>
					</td>
					<td>
						<input type='text' name='uname' class="input-sm"  value="<?php echo $username;?>">
					</td>
				</tr>
				<!-- PasswordName-->
				<tr align="center">
					<td height="50">
						<label>Password</label>
					</td>
					<td>
						<input type='text' name='pas' class="input-sm"  value="<?php echo $password; ?>">
					</td>
				</tr>
				<!-- UserType-->
				<tr align="center">
					<td height="50">
						<label>User Type</label>
					</td>
					<td>
						<select name='user_type' id = "user_type">
							<?php
								if($user_type == "subscriber"){
							?>
							<option id = "admin" value="Admin">Admin</option>
							<option id = "subcriber" value="subscriber" selected="selected">Subscriber</option>
							<?php
							}else{
							?>
							<option id = "admin" value="Admin" selected="selected">Admin</option>
							<option id = "subcriber" value="subscriber" >Subscriber</option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan=2 height="70">
						<center>
						<input type="submit" name="update" value="Update" class="btn btn-primary"
						/>
						</center>
					</td>
				</tr>
			</table>
		</form>
		<center><a href="manage_user.php">Go Back To Manage User</a></center>
	</body>
</html>
<script src="../js/jquery/jquery.min.js"></script>
<script src="../js/my.js">
	
</script>