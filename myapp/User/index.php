<?php session_start(); ?>
<?php  require_once("../includes/header.php");
?>
<!--
<div align="right">
	<a href="update_profile.php?id=<?php //echo $user_info['id']; ?>"><button class="btn-default btn-lg">My Profile</button></a>
</div>-->
<h1 class="h1">Hello <?php echo $_SESSION['username']; ?> </h1>
<div>
	<h1 align="center">Welcome Back To My App</h1>
</div>
</div>
<?php $con->get_footer(); ?>
