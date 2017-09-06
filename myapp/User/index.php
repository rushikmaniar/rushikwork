<?php session_start(); ?>
<?php
$con=mysqli_connect("localhost","root","","bca");
if($con){
	echo "connection succes";
}
else{
	echo mysqli_error($con);
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>My App </title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/my.css">

</head>
<body>

<header class="head">
<a href = "../index.php">
<img src="../pics/logo1.png" alt="logo" style="border-radius: 15px">
<button class="btn-default btn-lg">
My App
</button>
</a>
<div align="right">
	<a href="../logout.php">
<button class="btn btn-default btn-lg" id="btn-logout">Logout</button>
</a>
</div>
</header>

<h1 class="h1">Hello <?php echo $_SESSION['username']; ?> </h1>
<h1 align="center">Product List</h1>





<center>
<button class="btn-lg btn-info" id="btn-display">Display Data</button>
</center>

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
$display_query = "SELECT * FROM product where status = 1 LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysqli_query($con,$display_query); //run the query
echo $page;

?>

<table border='1' width="500" cellpadding="10" cellspacing="0" align="center" id="table-display" class="table">
	
<th>Product Name</th>
<th>Product Price</th>

<center>
<input type="text"  id="string" placeholder="Search.." class="input-lg" />
</center>
<?php
	while($rec = mysqli_fetch_assoc($rs_result))
	{
		echo "<tr>";
		echo "<td class='search'>".$rec['name']."</td>";
		echo "<td class='search'>".$rec['price']."</td>";
		echo "</tr>";
		
	}
?>

</table>

<h3 align="center">Pages</h3>
<br>
<center>
<?php
$sql = "SELECT * FROM product"; 
$rs_result = mysqli_query($con,$sql); //run the query
$total_records = mysqli_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
?>

<a href='index.php?page=1' id='page' style="color: red;font-size: large;">|<</a> 

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/my.js"></script>
<?php

for ($i=1; $i<=$total_pages; $i++) { 
	?>
            <a href='index.php?page=<?php echo $i ?>' style="color: black;font-size: large;" id="<?php echo 'link'.$i; ?>" ><?php echo $i; ?></a> 
<?php
};

if(isset($page))
{
	echo " <script> change_style($page); </script>";
}
?>

<a href='index.php?page=<?php echo $total_pages ?>' style="color: red;font-size: large;"> >|</a> 
</center>





</body>
</html>
<script src="../js/jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../js/my.js"></script>
