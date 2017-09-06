<?php
/*$.ajax({
  type: "GET",
  url: "update_switch.php",
  data: ,
  cache: false,
  success: function(data){
     $("#resultarea").text(data);
  }
});*/

$con = mysqli_connect("localhost","root","","bca");
$id = $_REQUEST['rowid'];
$status = $_REQUEST['status'];
 // data passed here

?>
<script>
	console.log(<?php echo $id ." " .$status ?>);
</script>
<?php

$sql = "UPDATE product SET status=$status WHERE id=$id";
mysqli_query($con,$sql);
?>