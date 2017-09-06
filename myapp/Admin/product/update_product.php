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
$con = mysqli_connect("localhost","root","","bca");

//data from product(name,price)
$query = "SELECT * FROM product WHERE id=$id";
$q = mysqli_query($con,$query);
$rec = mysqli_fetch_array($q);
$name1 = $rec['name'];

//data from images table
$sql = "select * from images where product_id=$id";
$q1 = mysqli_query($con,$sql);
//$res = mysqli_fetch_array($q1);

if(isset($_POST['update'])  && $_POST['update']=="Update"){
	$name = $_POST['name'];
	$price = $_POST['price'];
	$sql = "UPDATE product SET name='$name', price='$price' WHERE id=$id";
	$query = mysqli_query($con,$sql);
	if($query){echo "update successfully";}

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
						$q=mysqli_query($con,$query);
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
		
		//header("location:update_product.php");
	//exit();
}	

?>
<h1 class="h1">Update Product</h1>
<form name="form1" method="post" enctype="multipart/form-data" >
<table class=" table table-condensed" border="5" cellpadding="5" cellspacing="5" style="background-color: white;">
	<tr>
	<td>Product Name</td>
	<td><input type="text" name="name" value="<?php echo $rec['name'] ?>"></td>
	</tr>
	<tr>
	<td>Product Price</td>
	<td><input type="text" name="price" value="<?php echo $rec['price'] ?>"></td>
	</tr>
	


	<tr>
		<td>Status of Product not working </td>
		
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
                            data-id="<?php echo $rec['id'];?>" 
                            data-status="<?php echo $rec['status'];?>"></label>
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

                            />
                           <label 
                           for="someSwitchOptionSuccess<?php echo $rec['id'];?>" 
                           class="label-success switchBtn" 
                           data-id="<?php echo $rec['id'];?>" 
                           data-status="<?php echo $rec['status'];?>">
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


		</td>
		<td>
			
		<?php
		//$imgid = $res['img_id'];
					//$i = $res['img_id'];
			$dir = "UploadFolder/images/";
			while($res = mysqli_fetch_array($q1)){
				?>
				 <img src="<?php echo $dir.$res['img_name'] ?>" alt="not found">
				&emsp;
				<?php
				//echo $res['img_path'];
				//$i++;
			}	
		?>				
		
			
		</td>
	</tr>
	<tr>
	<td colspan="2"><center><input type="submit" name="update" value="Update" onclick="my()"></center></td>
	
	</tr>
</table>

</form>
</body>
</html>
<script>
	function my(){
		window.location.href = window.location.href;		
	}
</script>
<script src="../../js/jquery-3.2.1.min.js"></script>
<script src="../../js/my.js"></script>




