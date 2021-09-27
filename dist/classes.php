<?php
ob_start();  
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['id']) && isset($_SESSION['role'])){
  if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher'){
    header("location: ./index.php",  true );  exit;

  }else{
    include './dbcon.php';
    //select all actives class 
    $sql="select * from class where status=?;"; 
    $stmt=$pdo->prepare($sql); 
    $stmt->execute(array('active')); 
    //select student's classes
    $sqlenroll="select * from enrollstu where studentname=?;"; 
    $stmtenroll=$pdo->prepare($sqlenroll); 
    $stmtenroll->execute(array($_SESSION['username'])); 
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
 while ($row = $stmt->fetch()) { 
  if($_SESSION['role'] == 'student'){
       //count class's student
       $sqlcount="select * from enrollstu where classid=? and status=?;"; 
       $stmtcount=$pdo->prepare($sqlcount); 
       $stmtcount->execute(array($row['id'],'active'));
       $count=$stmtcount->rowCount();
      $check=true;
      ///thinking!!!!!
      while ($rowenroll = $stmtenroll->fetch()) { 
        if($rowenroll['studentname'] == $_SESSION['username'] && $row['id'] == $rowenroll['classid']){
          if($rowenroll['status']== "deactivate"){
           $check=false;
          $btntext="Asked to Enroll";
          $bg_color='bg-yellow-100';
          $btncolor='bg-yellow-500';
          $link='<p class="flex-shrink-0 border-transparent border-4 '.$btncolor.' mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" type="button">
          '.$btntext.'   
             </p>';
            //  break;

          }else{
            $check=false;
           $btntext="Manage";
           $bg_color='bg-green-100';
           $btncolor='bg-green-500';
           $link='<a  href="class?id='.$row['id'].'" class="flex-shrink-0 border-transparent border-4 '.$btncolor.' mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" type="button">
           '.$btntext.'   
              </a>';
              // break;
          }
        }
      }

      if($check){

        if ( isset( $_POST['enroll'.$row['id']])) {
          $id=addslashes((htmlentities($_POST['id'])));
          $sql="insert into enrollstu(studentname,classid)values(?,?);";  
          $execu=$pdo->prepare($sql);
          $execu->execute((array($_SESSION['username'],$id)));
          $pdo= null;
          header("location: ./classes.php",  true,  301 );  exit;
        }
        $btntext="Enroll";
        $bg_color='bg-blue-100';
        $btncolor='bg-blue-500';
        $link='<form method="post">
        <input type="hidden"  name="id" value="'.$row['id'].'">
        <button type="submit" name="enroll'.$row['id'].'" class="flex-shrink-0 border-transparent border-4 '.$btncolor.' mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded">
        '.$btntext.'   
           </button>
           </form>';
      }

 echo '
 <div class="w-full mx-auto max-w-sm '.$bg_color.'  my-3 rounded-xl">
 <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
<span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">name: '.$row['classname'].', teacher:'.$row['teachername'].' ,studentNo : '.$count.'</span>  
'.$link.'
 </div>

</div>
 ';
      
}


}
?>


</div>
</body>
</html>