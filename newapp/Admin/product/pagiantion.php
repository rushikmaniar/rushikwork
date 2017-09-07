
<html>
<body>
<form method="POST">
<?php 
$num_rec_per_page=5;
mysql_connect('localhost','root','');
mysql_select_db('bca');
if (isset($_REQUEST["page"])) { $page  = $_REQUEST["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM product LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysql_query ($sql); //run the query
echo $page;
?> 
<table>
<tr><td>Name</td><td>Price</td></tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
            <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>            
            </tr>
<?php 
}; 
?> 
</table>

<?php 
$sql = "SELECT * FROM product"; 
$rs_result = mysql_query($sql); //run the query
$total_records = mysql_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 

echo "<a href='pagiantion.php?page=1'>".'|<'."</a> "; // Goto 1st page  

for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='pagiantion.php?page=".$i."'>".$i."</a> "; 

}; 
echo "<a href='pagiantion.php?page=$total_pages'>".'>|'."</a> "; // Goto last page
?>
</form>
</body>
</html>