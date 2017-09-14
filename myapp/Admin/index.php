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
<?php $con->get_admin_footer(); ?>