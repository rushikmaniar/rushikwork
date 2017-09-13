<?php session_start(); ?>
<?php  require_once("../config/conn.php");
$con = new connection();
//require_once("../includes/header.php");
$con->get_header();
$query = "select * from user where username = '".$_SESSION['username']."'";
$sth = $con->dbh->query($query);
$user_info = $sth->fetch(PDO::FETCH_BOTH);
?>
<div align="right">
	<a href="update_profile.php?id=<?php echo $user_info['id']; ?>"><button class="btn-default btn-lg">My Profile</button></a>
</div>
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
$rs_result = $con->dbh->query($display_query);
//echo $page;
?>
<table border='1' width="500" cellpadding="10" cellspacing="0" align="center" id="table-display" class="table">
<!-- <th>Product Name</th>
<th>Product Price</th>
<th>Product Images</th> -->
<center>
<input type="text"  id="string" placeholder="Search.." class="input-lg" />
</center>
<?php
	/*while($rec = $rs_result->fetch(PDO::FETCH_BOTH))
	{
		echo "<tr>";
		echo "<td class='search'>".$rec['name']."</td>";
		echo "<td class='search'>".$rec['price']."</td>";
		?>
		<td>
		<?php
		//$imgid = $res['img_id'];
					//$i = $res['img_id'];
			$dir = "http://localhost/github/rushikwork/newapp/Admin/product/Uploadfolder/images/";

			$id = $rec['id'];
			$sql = "select * from images where product_id=$id";
			$img_sel = $con->dbh->query($sql);
			while($res = $img_sel->fetch(PDO::FETCH_BOTH)){
				?>
				 <img src="<?php echo $dir.$res['img_name'] ?>" alt="not found">
				 &emsp;
				<?php
			}	
		?>				
		</td>
		<?php
		echo "</tr>";
	}*/
	while($rec = $rs_result->fetch(PDO::FETCH_BOTH))
	{
		echo "<tr>";
		//echo "<td class='search'>".$rec['name']."</td>";
		//echo "<td class='search'>".$rec['price']."</td>";
		?>
		<td>
		<?php
		//$imgid = $res['img_id'];
					//$i = $res['img_id'];
			$dir = "http://localhost/github/rushikwork/myapp/Admin/admin_uploads/images/";
			$id = $rec['id'];
			$sql = "select * from images where product_id=$id LIMIT 1";
			$img_sel = $con->dbh->query($sql);
			while($res = $img_sel->fetch(PDO::FETCH_BOTH)){
				?>
				 <img src="<?php echo $dir.$res['img_name'] ?>" alt="not found">
				 &emsp;
				<?php
			}	
		?>		
		<br>
		<a href="product_details.php?p_id=<?php echo $rec['id']; ?>">		
		<font class="h3 text-info"><?php echo $rec['name']; ?></font>
		</a>
		<br>
		<font class="h2 text-bold">Rs. <?php echo $rec['price']; ?></font>
		</td>
		<?php
		//echo "<hr>";
		echo "</tr>";
	}
?>
</table>
<h3 align="center">Pages</h3>
<br>
<center>
<?php
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM product"; 
$sth = $con->dbh->query($sql);
$result = $con->dbh->query("SELECT FOUND_ROWS()"); 
$row_count =$result->fetchColumn();
$total_records = $row_count;  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
?>
<a href='index.php?page=1' id='page' style="color: red;font-size: large;">|<</a> 
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
<?php require_once("../includes/footer.php"); ?>
