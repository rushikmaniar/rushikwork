<?php
$con=mysqli_connect("localhost","root","","bca");
if($con)
	echo "connection success";
else
	echo mysql_error();
?>

<html>
<head>
<!-- css file include-->

<link rel="stylesheet" type="text/css" href="css/my.css">
<!--
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="dist/css/bootstrap-theme.min.css">
-->
<!-- javascript file include-->
<script src="js/jquery-3.2.1.min.js"></script>
<!--
<script src="dist/js/bootstrap.min.js"></script>
-->
<script>

	//function myfun()
	//{
		
		//document.write("hello");
		//document.getElementById("hobby").attr = checked;
		$(document).ready(function(){

			//$("#table-insert").hide();
			//$("#table-display").hide();


			$("#btn-insert").click(function() {
				//$("#table-insert").show();
				$("#table-insert").toggle("slideToggle(slow/400/fast)");
			});

			$("#btn-display").click(function() {
				//$("#table-display").show();
				$("#table-display").toggle("slideToggle(slow/400/fast)");

			});	

			$("#selectall").click(function() {

				if(this.checked)
				{

				$('#form-display input:checkbox').each(function(){
					$(this).prop('checked',true);
				});
			}
			else{
				$('#form-display input:checkbox').each(function(){
					$(this).prop('checked',false);
				});
			}
			});

	});

	//}


</script>
</head>
<?php
if(isset($_POST['add']) && $_POST['add']=="Add"){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$uname = $_POST['uname'];
	$query="insert into user(firstname,lastname,username) values('$fname','$lname','$uname');";
	$q=mysqli_query($con,$query) or die("insert error");
	echo mysqli_error($con);
	header("location:index.php");
	exit();
}	
	
?>

<body>

<h1 align="center">What Do You Want To Do ?</h1>
<!--<h1>insert data into bca student</h1> -->
<br>
<center>
<button class="btn-lg btn-info" id="btn-insert">Insert Data</button>
</center>
<form name='insert' method='post' id="form-insert">
<table border="1" width="500" cellspacing="0" cellpadding="10" align="center" id="table-insert">


<tr align="center">
<td  height="50">
<label>Firstname</label>
</td>
<td align="center">
<input type='text' name='fname' class="input-sm">
</td>
</tr>

<tr align="center">
<td height="50">
<label>Lastname</label>
</td>
<td>
<input type='text' name='lname' class="input-sm">
</td>
</tr>

<tr align="center">
<td height="50">
<label>username</label>
</td>
<td>
<input type='text' name='uname' class="input-sm">
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


<!--<h1>Display data of bca student table </h1> -->
<center>
<button class="btn-lg btn-info" id="btn-display">Display Data</button>
</center>
<form name='display' method='post' role="form" id="form-display">
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
<th>Firstname</th>
<th>Lastname</th>
<th>Username</th>

<?php
	$query = "select * from user";
	$res = mysqli_query($con,"select * from user") or die ("error");
	while($rec = mysqli_fetch_assoc($res))
	{
		echo "<tr>";
		echo "<td>"."<input type = 'checkbox' name='hobby[]' value='".$rec['id']."'>"."</td>";
		echo "<td>".$rec['firstname']."</td>";
		echo "<td>".$rec['lastname']."</td>";
		echo "<td>".$rec['username']."</td>";
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
			$query = "delete from user where id =" . $value ;
			mysqli_query($con,$query);
			header("location:index.php");
		}
		}
	}
?>

</body>
</html>
