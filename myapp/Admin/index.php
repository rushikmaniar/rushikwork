<?php
session_start();
if(!(isset($_SESSION['Admin'])))
{
	die("<h3>If Your Admin <br> Please login Again </h3>
	<a href = '../index.php'><button>Login</button></a>
<?php
");
//header ("location:../index.php");
}
?>
<?php require_once("admin_includes/admin_header.php");
$con = new connection();
?>
<h1 class="h1">Hi Admin <?php echo $_SESSION['username']; ?></h1>
<h2 class="h2" align="center">What Do You Want To Do ?</h2><br>
<a href="manage_user.php">
	<button class="btn btn-default btn-lg">Manage User</button>
</a>
<a href="product/">
	<button class="btn btn-default btn-lg">Manage product</button>
</a>
<?php $con->get_admin_footer(); ?>