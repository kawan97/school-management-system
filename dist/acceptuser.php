<?php
ob_start();  
include './dbcon.php';

 $sql="select * from users where status=?;"; 
 $stmt=$pdo->prepare($sql); 
 $stmt->execute(array('deactivate')); 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">

    <title>Add Class</title>
</head>
<body class='bg-green-500'>
<?php include './components/nav.php';?>

<div class="container  py-4 ">
<?php
 while ($row = $stmt->fetch()) { 
  if ( isset( $_POST['accept'.$row['username']])) {
    $username=addslashes((htmlentities($_POST['username'])));
    $sql="UPDATE users
    SET status = ?
   WHERE username = ?;";       
   $execu=$pdo->prepare($sql);
   $execu->execute(array('active',$username)); 
   $pdo= null;
   header("location: ./acceptuser.php",  true,  301 );  exit;
  }
  if ( isset( $_POST['delete'.$row['username']])) {
    $username=addslashes((htmlentities($_POST['username'])));
    $role=addslashes((htmlentities($_POST['role'])));
    $sql="DELETE FROM users WHERE username=?;";  
    $execu=$pdo->prepare($sql);
    $execu->execute((array($username))); 
    if($role == 'student'){
      $sql="DELETE FROM parent WHERE username=?;";  
      $execu=$pdo->prepare($sql);
      $execu->execute((array($username))); 
    }
    $pdo= null;
    header("location: ./acceptuser.php",  true,  301 );  exit;
  }

  echo '
  <form method="post" class="w-full mx-auto max-w-sm bg-gray-100  my-3 rounded-xl">
  <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
<span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">name: '.$row['username'].', role:'.$row['role'].'</span>  
<button type="submit" name="accept'.$row['username'].'" class="flex-shrink-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" type="button">
<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
</svg>
    </button>
    <button type="submit" name="delete'.$row['username'].'" class="flex-shrink-0 border-transparent border-4 bg-red-500 mx-4 text-white hover:text-red-800 text-sm py-1 px-2 rounded" type="button">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
</svg>
    </button>
  </div>
  <input type="hidden"  name="username" value="'.$row['username'].'">
  <input type="hidden"  name="role" value="'.$row['role'].'">

</form>
  
  
  ';

}
?>


</div>
</body>
</html>