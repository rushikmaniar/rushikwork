<?php echo "<h1>header File run</h1>";?>


<?php 
//echo __FILE__;
echo "<br>";
echo dirname(__FILE__);
echo "<br>";
$configPath = str_replace(array('header'),'',dirname(__FILE__));
echo "<br>";
echo $configPath .= "config/config.php";


//print_r($_SERVER);
//echo "<pre>";
require_once($configPath);

?>

<?php echo "<h1>header File Added</h1>";?>