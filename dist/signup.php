<?php include './components/authantiloginsignup.php';?>
<?php
include './dbcon.php';

$emailerror=false;
$usernameerror=false;
$username="";
$firstname="";
$lastname="";
$password="";
$email="";
$role='student';
if(isset($_POST['submit'])) 
{
     $username=addslashes((htmlentities($_POST["username"])));
     $firstname=addslashes((htmlentities($_POST['firstname'])));
     $lastname=addslashes((htmlentities($_POST['lastname'])));
     $email=addslashes((htmlentities($_POST['email'])));
     $role=addslashes((htmlentities($_POST['role'])));
     $password=addslashes((htmlentities($_POST['password'])));
     $sql="SELECT * FROM `users` WHERE `username`=?;";  
     $execu=$pdo->prepare($sql);
     $execu->execute(array($username)); 
     $data=$execu->fetch();
     if($data){
       $usernameerror=true;
     }else{
      if($role == "student"){
        if(!$email){
         $emailerror=true;
 
        }else{
          //insert to db with stu user 
          $password=hash('sha256', $password);
          $sql="insert into users(username,firstname,lastname,email,password,role)values(?,?,?,?,?,?);";  
          $execu=$pdo->prepare($sql);
          $execu->execute((array($username,$firstname,$lastname,$email,$password,$role))); 
          //generate a key for parent
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i <20; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          $sql="insert into parent(parentkey,username)values(?,?);";  
          $execu=$pdo->prepare($sql);
          $execu->execute((array($randomString,$username)));
          $pdo= null;
          header("location: index.php",  true,  301 );  exit;

        }
      }else{
         //insert to db with teacher user 
         $password=hash('sha256', $password);
         $sql="insert into users(username,firstname,lastname,email,password,role)values(?,?,?,?,?,?);";  
         $execu=$pdo->prepare($sql);
         $execu->execute((array($username,$firstname,$lastname,$email,$password,$role))); 
         $pdo= null;
         header("location: index.php",  true,  301 );  exit;
 
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

    <title>Sign Up</title>
</head>
<body class='bg-green-500'>
<?php include './components/nav.php';?>

<div class="container  py-4 ">
<form method="POST" class="w-full max-w-lg mx-auto p-4 bg-gray-100 rounded-xl">
  <div class="flex flex-wrap -mx-3 mb-6">
  <div class="w-full md:w-full px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-user-name">
        User Name
      </label>
      <input value="<?php echo $username; ?>" required name="username" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 <?php if($usernameerror)echo ' border-red-500'; ?> rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-user-name" type="text" placeholder="user name">
      <p class="mb-5 text-gray-600 <?php if($usernameerror)echo ' text-red-600'; ?> text-xs italic">User Name Must Be Uniqe</p>
    </div>
    <br>
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        First Name
      </label>
      <input value="<?php echo $firstname; ?>" required name="firstname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="first name">
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
        Last Name
      </label>
      <input value="<?php echo $lastname; ?>" required name="lastname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="last name">
    </div>
  </div>

  <div class="w-full md:w-full  mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-parent-email">
        Parent Email 
      </label>
      <input value="<?php echo $email; ?>" name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded <?php if($emailerror)echo ' border border-red-500'; ?> py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-parent-email" type="email" placeholder="Parent Email">
      <p class="text-gray-600 <?php if($emailerror)echo ' text-red-600'; ?> text-xs italic">If You Are Student Your Parent's Email is Required</p>
    </div>
<br>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
        Password 
      </label>
      <input value="<?php echo $password; ?>" required name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-password" type="password" placeholder="******************">
    </div>
  </div>

    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
        Role
      </label>
      <div class="relative">
        <select  name="role" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
        <option <?php if($role =="student") echo "selected='selected'"; ?>>student</option>
        <option  <?php if($role =="teacher") echo "selected='selected'"; ?>>teacher</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>

  
    </div>
    <button name="submit" type="submit" class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-gray-100 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-white py-1 px-2 rounded" >
      Sign Up
    </button> 

    <button class="flex-shrink-0  hover:bg-green-700 border-green-500 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-green-400 hover:text-white py-1 px-2 rounded" type="button">
      Log In
    </button> 

  </div>
</form>
</div>
</body>
</html>