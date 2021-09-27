<?php
ob_start();  
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])){
  if($_SESSION['role'] == 'teacher'){
  }else{
    header("location: ./index.php",  true );  exit;

  }
}else{
  header("location: ./index.php",  true );  exit;

}
include './dbcon.php';
if (isset($_GET['id'])) { 
$lectureid=addslashes((htmlentities($_GET['id'])));
}else{
    header("location: ./index.php",  true );  exit;
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">

    <title>Absence</title>
</head>
<body class='bg-green-500'>
<?php include './components/nav.php';?>

<div class="container  py-4 ">
  <?php  
  $sql="select * from lecture where id=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($lectureid)); 
  while ($row = $stmt->fetch()) {
    echo '<h1 class="text-xl text-white text-center my-4">'.$row['lecturename'].'</h1>'; 
  }
  
  ?>
<form class="w-full mx-auto max-w-sm bg-gray-100 rounded-xl">
  <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
<span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">Student Name </span>  
<button  class="flex-shrink-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" >
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
</svg>
    </button>
    <button class="flex-shrink-0 border-transparent border-4 bg-red-500 mx-4 text-white hover:text-red-800 text-sm py-1 px-2 rounded" >
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
    </button>
  </div>
</form>
</div>
</body>
</html>