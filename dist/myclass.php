<?php
ob_start();  
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['id']) && isset($_SESSION['role'])){
  if($_SESSION['role'] == 'admin'){
    header("location: ./index.php",  true );  exit;

  }else{
    include './dbcon.php';
  }
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

    <title>My Class</title>
</head>
<body class='bg-gray-100'>
<?php include './components/nav.php';?>

<div class="container  py-4 ">
  <h1 class="text-center text-black text-2xl	">My Class</h1>
<?php
//select  for teacher
if($_SESSION['role'] == 'teacher'){  
  $sql="select * from class where teacherid=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($_SESSION['id'])); 
  }
  //select for student
  if($_SESSION['role'] == 'student'){
    $sql="select enrollstu.id,enrollstu.status,class.classname,class.teachername From enrollstu 
    INNER JOIN class ON enrollstu.classid=class.id WHERE enrollstu.studentname=? AND enrollstu.status=?;"; 
    $stmt=$pdo->prepare($sql); 
    $stmt->execute(array($_SESSION['username'],'active'));
    }

 while ($row = $stmt->fetch()) {
  if($_SESSION['role'] == 'teacher'){
    if($row['status'] == 'deactivate'){
        $link='';
       $bg_color='bg-red-100';
    }else{
       $bg_color='bg-green-100';
       $link='<a  href="class?id='.$row['id'].'" class="flex-shrink-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" type="button">
       Manage   
          </a>';

    }
 echo '
 <div class="w-full mx-auto max-w-sm '.$bg_color.'  my-3 rounded-xl">
 <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
<span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">name: '.$row['classname'].', teacher:'.$row['teachername'].' ,status : '.$row['status'].'</span>  
'.$link.'
 </div>

</div>
 ';
      
}

  if($_SESSION['role'] == 'student'){
    $bg_color='bg-green-100';
       $link='<a  href="class?id='.$row['id'].'" class="flex-shrink-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" type="button">
       Manage   
          </a>';

          echo '
 <div class="w-full mx-auto max-w-sm '.$bg_color.'  my-3 rounded-xl">
 <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
<span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">Class Name: '.$row['classname'].', Teacher:'.$row['teachername'].' ,status : '.$row['status'].'</span>  
'.$link.'
 </div>

</div>
 ';
      // print_r($row);

  }

}
?>


</div>
</body>
</html>