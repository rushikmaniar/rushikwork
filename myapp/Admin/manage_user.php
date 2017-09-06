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
$con=mysqli_connect("localhost","root","","bca");
if($con){
	echo "<font class='mysuccess'>connection succes</font>";
}
else{
	echo mysqli_error($con);
}
$username1 = $_SESSION['username'];
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/my.css">

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
</head>
<!-- Data Insert -->
<?php
//Insert Data
if(isset($_POST['add']) && $_POST['add']=="Add"){
	
	$firstname = $_POST['fname'];
	$lastname = $_POST['lname'];
	$username = $_POST['uname'];
	$password = $_POST['pas'];
	$user_type = $_POST['user_type'];

	$query="insert into user(firstname,lastname,username,password,user_type) values('$firstname','$lastname','$username','$password','$user_type');";
	$q=mysqli_query($con,$query) or die("insert error");
	if($q){
		echo "User Added Successfully";
	}
	//echo mysqli_error($con);
	//header("location:index.php");
	//exit();
}	
	

?>

<body>

<h1 align="center" class="h1">User Data</h1>
<!--<h1>insert data into bca student</h1> -->
<br>
<center>
<span></span>
<button class="btn-lg btn-info" id="btn-insert">Add User</button>
</center>
<form name='insert' method='post' id="form-insert">

<table border="1" width="500" cellspacing="0" cellpadding="10" align="center" id="table-insert">

<!-- FirstName-->
<tr align="center">
<td  height="50">
<label>First Name</label>
</td>
<td align="center">
<input type='text' name='fname' class="input-sm" required>
</td>
</tr>

<!-- LastName-->
<tr align="center">
<td height="50">
<label>Last Name</label>
</td>
<td>
<input type='text' name='lname' class="input-sm" required>
</td>
</tr>

<!-- UserName-->
<tr align="center">
<td height="50">
<label>User Name</label>
</td>
<td>
<input type='text' name='uname' class="input-sm" required>
</td>
</tr>

<!-- PasswordName-->
<tr align="center">
<td height="50">
<label>Password</label>
</td>
<td>
<input type='text' name='pas' class="input-sm" required>
</td>
</tr>

<!-- UserType-->
<tr align="center">
<td height="50">
<label>User Type</label>
</td>
<td>
<select name='user_type'>
	<option value="Admin">Admin</option>
	<option value="subscriber" selected >Subscriber</option>
</select>
</td>
</tr>

<tr>
<td colspan=2 height="70">
<center>
<input type="submit" name="add" value="Add" class="btn btn-primary"
 /> 
</center>
</td>
</tr>


</table>


</form>

<center>
<input type="text" class="input-lg"  id="string" placeholder="Search.." />
</center>

<!--<h1>Display data of bca student table </h1> -->
<center>
<button class="btn-lg btn-info" id="btn-display">Display Data</button>
</center>
<form name='display' method='post' role="form" id="form-display">

<!-- Logic of Pagianation-->
<?php 
$num_rec_per_page=5;
if (isset($_REQUEST["page"])) { 
		$page  = $_REQUEST["page"]; 
	} 
else { 
	$page=1; 
};

$start_from = ($page-1) * $num_rec_per_page; 
$display_query = "SELECT * FROM user where username !='$username1' LIMIT $start_from, $num_rec_per_page "; 
$rs_result = mysqli_query($con,$display_query); //run the query
echo $page;

?>

<table border='5' align="center" width="80%" id="table-display">
	<tr>
<td><input type='checkbox' id='selectall'></td>
<td colspan='7'>
<b>
Select All
</b>
</td>
</tr>

<th>checkbox</th>
<th>FirstName</th>
<th>LastName</th>.
<th>UserName</th>
<th>Password</th>
<th>User Type</th>
<th>Edit</th>


<?php
	while($rec = mysqli_fetch_assoc($rs_result))
	{
		echo "<tr>";
		echo "<td>"."<input type = 'checkbox' name='hobby[]' value='".$rec['id']."'>"."</td>";
		echo "<td class='search'>".$rec['firstname']."</td>";
		echo "<td class='search'>".$rec['lastname']."</td>";
		echo "<td class='search'>".$rec['username']."</td>";
		echo "<td class='search'>".$rec['password']."</td>";
		echo "<td class='search'>".$rec['user_type']."</td>";
		?>

		<td>
		<a href="edit_user.php?id=<?php echo $rec['id'];?>">Edit</a>
		</td>
		<?php
		echo "</tr>";
		
	}
?>

<tr><td colspan="7" height="70"><center><input type="submit" name="delete" value="Delete" class="btn-danger btn-lg" />
</table>

</form>
<?php
	if(isset($_POST['delete']) && $_POST['delete']=="Delete"){
		if(array_key_exists('hobby',$_POST)){
			//print_r($_POST['hobby']);
		print_r($_POST['hobby']);
		//$arr = array ($_POST['hobby']);		
		$arr= $_POST['hobby'];
		foreach($arr as $key => $value)
		{	
			echo "key=".$key."value=".$value;
			$query = "delete from user where id =" . $value ;
			mysqli_query($con,$query);
			header("location:manage_user.php");
		}
		}
	}
?>

<h3 align="center">Pages</h3>
<br>
<center>
<?php
$sql = "SELECT * FROM user where username !='$username1'"; 
$rs_result = mysqli_query($con,$sql); //run the query
$total_records = mysqli_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
?>

<a href='index.php?page=1' id='page' style="color: yellow;font-size: large;">|<</a> 

<?php

for ($i=1; $i<=$total_pages; $i++) { 
	?>
            <a href='index.php?page=<?php echo $i ?>' style="color: white;font-size: large;" id="<?php echo 'link'.$i; ?>" ><?php echo $i; ?></a> 
<?php
};
?>

<script src="../js/jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/my.js"></script>

<?php
if(isset($page))
{
	echo " <script> change_style($page); </script>";
}
?>

<a href='manage_user.php?page=<?php echo $total_pages ?>' style="color: yellow;font-size: large;"> >|</a> 
</center>

</body>

</html>
