<!DOCTYPE html>
<html>
<head>
	<title>My App</title>
</head>
<link rel="stylesheet" type="text/css" href="../../css/my.css">
<link rel="stylesheet" type="text/css" href="../../bootstrap/css/bootstrap.min.css">
<body style="background-color: yellow;">
<?php  
$id = $_GET['id'];
require_once("../../conn.php");
$con = new connection();

//data from product(name,price)
$query = "SELECT * FROM product WHERE id=$id";
$sth = $con->dbh->query($query);

$rec = $sth->fetch(PDO::FETCH_BOTH);
$name1 = $rec['name'];

//data from images table
$sql = "select * from images where product_id=$id";
$img_sel = $con->dbh->query($sql);


if(isset($_POST['update'])  && $_POST['update']=="Update"){
	$name = $_POST['name'];
	$price = $_POST['price'];
	try{
	$sql = "UPDATE product SET name='$name', price='$price' WHERE id=$id";
	$sth = $con->dbh->query($sql);
	
	echo "update successfully";
	}catch(PDOException $e){
		echo $e->getMessage();
	}
	$id = $rec['id'];
	
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
					$name = "p_".$id."_".$_FILES["files"]["name"][$key];
					
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
						($id,'$name')";
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
		
		header("location:update_product.php?id=$id");
	//exit();
}	

if(isset($_POST['delete']) && $_POST['delete']=="Delete"){
		if(array_key_exists('img_del',$_POST)){
			//print_r($_POST['hobby']);
		print_r($_POST['img_del']);
		//$arr = array ($_POST['hobby']);		
		$arr= $_POST['img_del'];
		foreach($arr as $key => $value)
		{	

			//Deleting images 
			$sql = "select * from images where img_id=$value";
			$q1 = $con->dbh->query($sql);
			
			$dir = "UploadFolder/images/";

			while($res = $q1->fetch(PDO::FETCH_BOTH)){
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
			 $q_del = "delete from images where img_id=$value";
			 try{
			 $sth = $con->dbh->query($q_del);
			 
			header("location:update_product.php?id=$id");

			}catch(PDOException $e){
				$e->getMessage();
			}
			
		}
	}
}
	

?>
<h1 class="h1">Update Product</h1>
<form name="form_update" id="form_update" method="post" enctype="multipart/form-data" >
<table class=" table table-condensed" border="5" cellpadding="5" cellspacing="5" style="background-color: white;">
<th>Feilds</th>
<th>values</th>
	<tr>
	<td>Product Name</td>
	<td><input type="text" name="name" value="<?php echo $rec['name'] ?>"></td>
	</tr>
	<tr>
	<td>Product Price</td>
	<td><input type="text" name="price" value="<?php echo $rec['price'] ?>"></td>
	</tr>
	


	<tr>
		<td>Status of Product</td>
		
			<?php 
		if($rec['status']==1)
		{
			?>
		<td>
		<div class="material-switch pull-left">
                            <input id="someSwitchOptionSuccess<?php echo $rec['id'];?>" 
                            name="someSwitchOption001" 
                            type="checkbox"
                            checked="checked" 
                            class="switch"
                            data-id="<?php echo $rec['id'];?>"
                            data-status="<?php echo $rec['status'];?>" />
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
		<div class="material-switch pull-left">
                            <input id="someSwitchOptionSuccess<?php echo $rec['id'];?>" 
                            name="someSwitchOption001" 
                            type="checkbox" 
                            class="switch" 
							data-id="<?php echo $rec['id'];?>" 
                           data-status="<?php echo $rec['status'];?>"/>
                           <label 
                           for="someSwitchOptionSuccess<?php echo $rec['id'];?>" 
                           class="label-success switchBtn" 
                           
                          	</label>
                        
                        </div>
		</td>
		<?php } ?>
	</tr>
	<tr>
		<td>Images
		<br>

<label>Add Product Images</label>
<input type="file" name="files[]" multiple="multiple" />

<label>Delete Product Images</label>
<input type="submit" name="delete" value="Delete" onclick="my()">

		</td>
		
		<?php
		//$imgid = $res['img_id'];
					//$i = $res['img_id'];
			$dir = "UploadFolder/images/";
			echo "<td class = 'img_checkbox'>";
			echo "<input type='checkbox' id='img_selectall'>";
			echo "<label>Select ALL </label>";
			?>
			
			<?php

			while($res = $img_sel->fetch(PDO::FETCH_BOTH)){
				?>
				 <img src="<?php echo $dir.$res['img_name'] ?>" alt="not found">
				<?php 
					echo "<input type = 'checkbox' class='img_check' name='img_del[]' value='"
					.$res['img_id']."'>";
 				?>
				<?php
			}	
			echo "</td>";
		?>				
		
	
		</td>
	</tr>
	<tr>
	<td colspan="2"><center><input type="submit" name="update" value="Update" onclick="my()"></center></td>
	
	</tr>
</table>

</form>
<center><a href="index.php">Go Back TO Product List</a></center>
</body>
</html>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="../../js/my.js"></script>
<script src="js/my.js"></script>
<script>
	function my(){
		window.location.reload(true);		
	}
</script>





