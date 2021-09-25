<?php
$host="localhost";
$db="sms";
try{
$pdo= new PDO("mysql:host=$host;dbname=$db","root","");
//Echo 'connected';
}
catch (PDOException $e){
 // echo "not connected ".$e->getMessage();
    die();
}
//$pdo= null;
?>

 
<?php
/*	$pass="123456";
	$hashed_Pass=hash('sha256', $pass);
	echo ($pass."</br>");
	echo ($hashed_Pass); */
?> 
