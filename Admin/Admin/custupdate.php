<?php
 $servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "fragrance_loungue";
$mysqli = new  mysqli($servername, $username, $password,$db) or die($mysqli->error);
if(isset($_POST['updaterequest']))
{   
    $id=$_POST['pid'];
    $pritem=$_POST['pritem'];

	$result=$mysqli->query("update products SET cost_per_item = '$pritem' where id = '$id'") or die($mysqli->error);


		echo '<script>alert("Success!");
				window.location.replace("products.php");
		</script>';
	

}


?>	


	
