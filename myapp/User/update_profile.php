<?php session_start(); ?>
<?php 
require_once("../includes/header.php");
$con = new connection();
$id = $_REQUEST['id'];
$query = "select * from user where id=$id";
try{
$sth = $con->dbh->query($query);
}catch(PDOException $e){
	echo $e->getMessage();
}
$user_info = $sth->fetch(PDO::FETCH_BOTH);
?>
<a href="index.php">Go Back </a>
<h1 align="center" class="h1">My Profile</h1>
<form name = "form1" method="post">
	<table class="table" border='1' width="500" cellpadding="10" cellspacing="0" align="center" id="user_profile">
		<tr>
			<td>First Name </td>
			<td><input type="text" name="firstname" value="<?php echo $user_info['firstname']; ?>" class="input-lg"></td>
		</tr>
		<tr>
			<td>Last Name </td>
			<td><input type="text" name="lastname" value="<?php echo $user_info['lastname']; ?>" class="input-lg"></td>
		</tr>
		<tr>
			<td>User Name </td>
			<td><input type="text" name="username" value="<?php echo $user_info['username']; ?>" class="input-lg"></td>
		</tr>
		<tr>
			<td>Password</td>
			<td><input type="text" name="password" value="<?php echo $user_info['password']; ?>" class="input-lg"></td>
		</tr>
		<tr>
			<td colspan="2">
				<center>
					<input type="submit" class="btn-success btn-lg" value="update" name="update">
				</center>
			</td>
		</tr>
	</table>
</form>
<?php 
	if((isset($_POST['update'])) && ($_POST['update']=='update')){
		$firstname = $_POST['firstname'];
		$lastname  = $_POST['lastname'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "UPDATE user SET 
		firstname = '$firstname',
		lastname = '$lastname',
		username  = '$username',
		password = '$password' WHERE id=$id";
		try{
		$sth = $con->dbh->query($sql);
		$_SESSION['username'] = $username;
		echo "<div class='text-success'>Update Success</div>";
		}catch(PDOException $e){
			if($e->getCode() == '23000'){
				echo "<div class='text-danger'> Username Already Exists Or Something Wrong </div>";
			}
			else{
			echo $e->getMessage();
			}
		}
		}
 ?>
 <?php $con->get_footer(); ?>
