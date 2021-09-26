<?php include './components/authantiloginsignup.php';?>

<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php 
$inputerror=false;
include './dbcon.php';

if ( isset( $_POST['submit'])) { 
  $username=addslashes((htmlentities($_POST['username'])));
  $password=addslashes((htmlentities($_POST['password']))); 
  $key=addslashes((htmlentities($_POST['password']))); 

  $password=hash('sha256', $password);
  $getusername="";
  $getpassword=""; 
  $getfullname="";
  $getrole="";
  $sql="select * from users where username=? and password=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($username, $password)); 
  while ($row = $stmt->fetch()) { 
    
      $getusername=$row['username']; 
      $getpassword=$row['password']; 
      $getrole=$row['role']; 

      $getfullname=$row['firstname'].' '.$row['lastname'];
       $pdo= null;
  }
if ($stmt->rowCount()==1){ 
$_SESSION['type']='self';
$_SESSION['role']=$getrole; 
$_SESSION['username']=$getusername; 
$_SESSION['password']=$getpassword; 
setcookie("fullname", $getfullname, time() + (86400 * 2), "/");
echo $_SESSION['username'];

header ('Location: index.php'); 
  } 
  else 
  {
    //check for parent key
    $sql="select * from parent where username=? and parentkey=?;"; 
    $stmt=$pdo->prepare($sql); 
    $stmt->execute(array($username, $key));    
    $check=false; 
    while ($row = $stmt->fetch()) { 
    $check=true;
     $pdo= null;
  } 
  if($check){
    if ($stmt->rowCount()==1){ 
      $_SESSION['type']='parent'; 
      $_SESSION['role']='parent'; 
      $_SESSION['username']=$username; 
      $_SESSION['password']=$key; 
      setcookie("fullname", $username, time() + (86400 * 2), "/");
      header ('Location: index.php'); 
     echo $_SESSION['username'];
        } 
  }else{
  $inputerror=true; 

  }


    }
  }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">

    <title>LogIn</title>
</head>
<body class='bg-green-500'>
<?php include './components/nav.php';?>

<div class="container  py-7  ">
<form method="post" class="w-full max-w-lg mx-auto p-4 bg-gray-100 rounded-xl">
  <div class="flex flex-wrap -mx-3 mb-6">



  <div class="w-full md:w-full px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-user-name">
        User Name
      </label>
      <input required name="username" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-user-name" type="text" placeholder="user name">
    </div>
  </div>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Password Or Key
      </label>
      <input name="password" required class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" placeholder="********">
    </div>
  </div>
 <?php 
 if($inputerror){ echo '<p class="text-red-600 text-sm italic">invalid login credentials</p>'; }?>
    <button type="submit" name="submit" class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-gray-100 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-white py-1 px-2 rounded" type="button">
      LogIn
    </button> 

    <button class="flex-shrink-0  hover:bg-green-700 border-green-500 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-green-400 hover:text-white py-1 px-2 rounded" type="button">
      SignUp
    </button> 

  </div>
</form>
</div>
</body>
</html>