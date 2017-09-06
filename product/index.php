<!-- Connection of Database-->
<?php
$con=mysqli_connect("localhost","root","","bca");
if($con){
	echo "connection succes";
}
else{
	echo mysqli_error($con);
}
?>

<html>
<head>

<!-- css file include-->
<link rel="stylesheet" type="text/css" href="css/my.css">
<!-- javascript file include-->

</head>
<!-- Data Insert -->
<?php
//Insert Data
if(isset($_POST['add']) && $_POST['add']=="Add"){
	
	$name = $_POST['name'];
	$price = $_POST['price'];
	
	$query="insert into product(name,price) values('$name',$price);";
	$q=mysqli_query($con,$query) or die("insert error");
	echo mysqli_error($con);
	header("location:index.php");
	exit();
}	
	

?>

<body>

<h1 align="center">Product List</h1>
<!--<h1>insert data into bca student</h1> -->
<br>
<center>
<span></span>
<button class="btn-lg btn-info" id="btn-insert">Insert Data</button>
</center>
<form name='insert' method='post' id="form-insert">

<table border="1" width="500" cellspacing="0" cellpadding="10" align="center" id="table-insert">


<tr align="center">
<td  height="50">
<label>Product Name</label>
</td>
<td align="center">
<input type='text' name='name' class="input-sm">
</td>
</tr>

<tr align="center">
<td height="50">
<label>Product Price</label>
</td>
<td>
<input type='text' name='price' class="input-sm">
</td>
</tr>

<tr>
<td colspan=2 height="70">
<center>
<input type="submit" name="add" value="Add" class="btn-success
btn-lg"
 /> 
</center>
</td>
</tr>


</table>


</form>

<center>
<input type="text"  id="string" placeholder="Search" />
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
$display_query = "SELECT * FROM product LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysqli_query($con,$display_query); //run the query
echo $page;

?>

<table border='1' width="500" cellpadding="10" cellspacing="0" align="center" id="table-display">
	<tr>
<td><input type='checkbox' id='selectall'></td>
<td colspan='3'>
<b>
Select All
</b>
</td>
</tr>

<th>checkbox</th>
<th>Product Name</th>
<th>Product Price</th>

<?php
	while($rec = mysqli_fetch_assoc($rs_result))
	{
		echo "<tr>";
		echo "<td>"."<input type = 'checkbox' name='hobby[]' value='".$rec['id']."'>"."</td>";
		echo "<td class='search'>".$rec['name']."</td>";
		echo "<td class='search'>".$rec['price']."</td>";
		echo "</tr>";
		
	}
?>

<tr><td colspan="4" height="70"><center><input type="submit" name="delete" value="Delete" class="btn-danger btn-lg" />
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
			$query = "delete from product where id =" . $value ;
			mysqli_query($con,$query);
			header("location:index.php");
		}
		}
	}
?>

<h3 align="center">Pages</h3>
<br>
<center>
<?php
$sql = "SELECT * FROM product"; 
$rs_result = mysqli_query($con,$sql); //run the query
$total_records = mysqli_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
?>

<a href='index.php?page=1' id='page' style="color: yellow;font-size: large;">|<</a> 

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/my.js"></script>
<?php

for ($i=1; $i<=$total_pages; $i++) { 
	?>
            <a href='index.php?page=<?php echo $i ?>' style="color: white;font-size: large;" id="<?php echo 'link'.$i; ?>" ><?php echo $i; ?></a> 
<?php
};

if(isset($page))
{
	echo " <script> change_style($page); </script>";
}
?>

<a href='index.php?page=<?php echo $total_pages ?>' style="color: yellow;font-size: large;"> >|</a> 
</center>

</body>

</html>
