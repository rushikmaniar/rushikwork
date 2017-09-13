<!-- Connection of Database-->
<?php
require_once("admin_includes/admin_header.php");
$con = new connection();
?>
	<?php
	//Insert Data
	if(isset($_POST['add']) && $_POST['add']=="Add"){
		
		$name = $_POST['name'];
		$price = $_POST['price'];
		$insertstatus = 1;
		
		//insert data in product table
		if(isset($_POST['insertstatus'])){
			$insertstatus = 1;
		}
		else{
			$insertstatus = 0;
		}
		//echo $insertstatus;
		$query="insert into product(name,price,status) values('$name',$price,$insertstatus);";
		$sth = $con->dbh->query($query);
			
		//last insert record id
		$last_id = $con->dbh->lastInsertId();
		
		$errors = array();
					$uploadedFiles = array();
					$extension = array("jpeg","jpg","png","gif");
					$bytes = 1024;
					$KB = 1024;
					$totalBytes = $bytes * $KB;
					//	$myfolder = $_POST['name'];
					//$myNewFolderPath = "UploadFolder/images/" . $myfolder;
					
					$UploadFolder = "UploadFolder/images";
					
					
					$counter = 0;
					
					foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name){
						$temp = $_FILES["files"]["tmp_name"][$key];
						$name = "p_".$last_id."_".$_FILES["files"]["name"][$key];
						
						if(empty($temp))
						{
							break;
						}
						
						$counter++;
						$UploadOk = true;
						
						if($_FILES["files"]["size"][$key] > $totalBytes)
						{
							$UploadOk = false;
							array_push($errors, $name." file size is larger than the 1 MB.");
						}
						
						$ext = pathinfo($name, PATHINFO_EXTENSION);
						if(in_array($ext, $extension) == false){
							$UploadOk = false;
							array_push($errors, $name." is invalid file type.");
						}
						
						if(file_exists($UploadFolder."/".$name) == true){
							$UploadOk = false;
							array_push($errors, $name." file is already exist.");
						}
						
						if($UploadOk == true){
							move_uploaded_file($temp,$UploadFolder."/".$name);
							array_push($uploadedFiles, $name);
							
							$query = "insert into images
							(product_id,img_name)
							values
							($last_id,'$name')";
							$sth = $con->dbh->query($query);
							
							}
					}
					
					if($counter>0){
						if(count($errors)>0)
						{
							echo "<b>Errors:</b>";
							echo "<br/><ul>";
								foreach($errors as $error)
								{
									echo "<li>".$error."</li>";
								}
							echo "</ul><br/>";
						}
						
						if(count($uploadedFiles)>0){
							echo "<b>Uploaded Files:</b>";
							echo "<br/><ul>";
								foreach($uploadedFiles as $fileName)
								{
									echo "<li>".$fileName."</li>";
								}
							echo "</ul><br/>";
							
							echo count($uploadedFiles)." file(s) are successfully uploaded.";
														}
					}
					else{
						echo "Please, Select file(s) to upload.";
					}
			
			//header("location:index.php");
		//exit();
		}
		
	?>
	<body>
		<a href="../index.php"> &lt;-Go To Admin Panel</a>
		<h1 align="center" class="h1">Product List</h1>
		<!--<h1>insert data into bca student</h1> -->
		<br>
		<center>
		<span></span>
		<button class="btn-lg btn-info" id="btn-insert">Insert Data</button>
		</center>
		<form name='insert' method='post' id="form-insert" enctype="multipart/form-data">
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
					<td><label>Status Of Product</label></td>
					<td>
						<div class="material-switch pull-left">
							<input id="someSwitchOptionSuccess_insert"
							name="insertstatus"
							type="checkbox"
							checked="checked"
							value = "1"
							class="switch"
							
							/>
							<label for="someSwitchOptionSuccess_insert"
								class="label-success switchBtn"
								
							></label>
						</div>
					</td>
					
				</tr>
				<tr>
					<td><label>Upload Product Images</label></td>
					<td><input type="file" name="files[]" multiple="multiple" /></td>
				</tr>
				<tr>
					<td colspan=2 height="70">
						<center>
						<input type="submit" id="btn_add" name="add" value="Add"
						class="btn-success btn-lg"
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
			$sth = $con->dbh->query($display_query);
			//echo $page;
			?>
			<table border='1' width="500" cellpadding="10" cellspacing="0" align="center" id="table_display">
				<tr>
					<td><input type='checkbox' id='selectall'></td>
					<td colspan='4'>
						<br>
						Select All
						</b>
					</td>
				</tr>
				<th>checkbox</th>
				<th>Product Name</th>
				<th>Product Price</th>
				<th>Status</th>
				<th>edit</th>
				<?php
					while($rec = $sth->fetch())
					{
						echo "<tr>";
							echo "<td>"."<input type = 'checkbox' class='del_check' name='hobby[]' value='".$rec['id']."'>"."</td>";
							echo "<td class='search'>".$rec['name']."</td>";
							echo "<td class='search'>".$rec['price']."</td>";
					?>
					
					<?php
					if($rec['status']==1)
					{
					?>
					<td>
						<div class="material-switch pull-left">
							<input id="someSwitchOptionSuccess<?php echo $rec['id'];?>"
							name="someSwitchOption001"
							type="checkbox"/
							checked="checked"
							class="switch"
							data-id="<?php echo $rec['id'];?>"
							data-status="<?php echo $rec['status'];?>"
							/>
							<label for="someSwitchOptionSuccess<?php echo $rec['id'];?>"
								class="label-success switchBtn"
							></label>
						</div>
					</td>
					<?php
					}
					else{
					?>
					<td>
						<div class="material-switch pull-left" >
							<input id="someSwitchOptionSuccess<?php echo $rec['id'];?>"
							name="someSwitchOption001"
							type="checkbox"
							class="switch"
							data-id="<?php echo $rec['id'];?>"
							data-status="<?php echo $rec['status'];?>"
							/>
							<label
								for="someSwitchOptionSuccess<?php echo $rec['id'];?>"
								class="label-success switchBtn"
								>
							</label>
							
						</div>
					</td>
					
					<?php
					}
					?>
					<td><a href="update_product.php?id=<?php echo $rec['id']; ?> ">Edit</a></td>
					<?php
				echo "</tr>";
				
				}//while loop end
				?>
				<tr><td colspan="5" height="70"><center><input type="submit" name="delete" value="Delete" class="btn-danger btn-lg" />
				<script src="js/jquery-3.2.1.min.js"></script>
				<script src="../../js/my.js"></script>
				<script src="js/my.js"></script>
				</center>
			</td>
		</tr>
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
			//deleting data
			echo "key=".$key."value=".$value;
			$query = "delete from product where id =$value" ;
			$sth = $con->dbh->query($query);
			
			//Deleting images
			$sql = "select * from images where product_id=$value";
			$sth = $con->dbh->query($sql);
			
			$dir = "UploadFolder/images/";
			while($res = $sth->fetch()){
				$filename= $dir.$res['img_name'];
				
			if (file_exists($filename)) {
			unlink($filename);
			} else {
			// File not found.
			echo "file not found";
			}
				//echo $res['img_path'];
				//$i++;
				}
			//delete from image table
			$q_del = "delete from images where product_id=$value";
			$sth = $con->dbh->query($q_del);
			
			header("location:index.php");
		}
		}
	}
?>
<h3 align="center">Pages</h3>
<br>
<center>
<?php
$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM product";
$sth = $con->dbh->query($sql);
$result = $con->dbh->query("SELECT FOUND_ROWS()");
$total_records = $result->fetchColumn();
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
	echo "
<script>
var pageId=document.getElementById('link'+$page);
$(pageId).addClass('selectedPage');
</script>";
}
?>
<a href='index.php?page=<?php echo $total_pages ?>' style="color: red;font-size: large;"> >|</a>
</center>
</body>
</html>