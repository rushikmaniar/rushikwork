<?php session_start(); ?>
<?php
require_once("../includes/header.php");
$con = new connection();
$query = "select * from user where username = '".$_SESSION['username']."'";
$sth = $con->dbh->query($query);
$user_info = $sth->fetch(PDO::FETCH_BOTH);
?>
<h1 class="h1">Hello <?php echo $_SESSION['username']; ?> </h1>
<h1 align="center">Product List</h1>
<center>
<button class="btn-lg btn-info" id="btn-display">Display Data</button>
</center>
<!-- Logic of Pagianation-->
<?php 
$p_id = $_REQUEST['p_id'];
$display_query = "SELECT * FROM product where status = 1 and id=$p_id"; 
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
		<font class="h3 text-info"><?php echo $rec['name']; ?></font>
		<br>
		<font class="h2 text-bold">Rs. <?php echo $rec['price']; ?></font>
		<br>
		<?php
		//$imgid = $res['img_id'];
					//$i = $res['img_id'];
			$dir = "http://localhost/github/rushikwork/newapp/Admin/product/Uploadfolder/images/";
			$id = $rec['id'];
			$sql = "select * from images where product_id=$id";
			$img_sel = $con->dbh->query($sql);
			while($res = $img_sel->fetch(PDO::FETCH_BOTH)){
				echo "<a href = '".$dir.$res['img_name']."'>";
				?>
				 <img src="<?php echo $dir.$res['img_name'] ?>" alt="not found">
				 </a>
				 &emsp;
				<?php
			}	
		?>		
		</td>
		<?php
		//echo "<hr>";
		echo "</tr>";
	}
$con->get_footer();
?>
</table>
