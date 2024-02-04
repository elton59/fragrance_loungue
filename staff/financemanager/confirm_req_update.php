<?php
 $servername = "127.0.0.1";
$username = "root";
$password = "";
$db = "fragrance_loungue";
$mysqli = new  mysqli($servername, $username, $password,$db) or die($mysqli->error);
if(isset($_POST['update_request']))
{   
    $id=$_POST['pid'];
	$fid=$_POST['fid'];
	$batch_no=$_POST['batch_no'];
	$pdate=$_POST['pdate'];
	$tid=$_POST['tid'];
	$amount=$_POST['amount'];
	$sid=$_POST['sid'];
	$result=$mysqli->query("update products SET purchase_date='$pdate',batch_no='$batch_no',status='payment_completed' where id = '$id'") or die($mysqli->error);
	$resul2=$mysqli->query("INSERT into payments(finance_manager_id,amount,transaction_code,product_id,supplier_id,payment_status)VALUE('$fid','$amount','$tid','$id','$sid','approved')") or die($mysqli->error);


		echo '<script>alert("Success!");
				window.location.replace("products.php");
		</script>';
	

}


?>	


	
