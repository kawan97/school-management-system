<?php 
include './components/authbacktolgin.php';

?>
<?php
$updated=false;
$revenue="";
$hobby="";
$health="";
$interest="";
$blood='';
$username;
if(isset($_GET['username'])){
  $username=addslashes((htmlentities($_GET['username'])));
}
include './dbcon.php';
$sql="select * from profile where username=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($_SESSION['username'])); 
  while ($row = $stmt->fetch()) { 
    $revenue=$row['revenue'];
    $hobby=$row['hobby'];
    $health=$row['health'];
    $interest=$row['interest'];
    $blood=$row['blood'];
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">

    <title>Profile:<?php echo $username;?></title>
</head>
<body class='bg-green-500'>
<?php include './components/nav.php';?>

<div class="container  py-4 ">
<form method="POST" class="w-full max-w-lg mx-auto p-4 bg-gray-100 rounded-xl">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Parent Revenue
      </label>
      <input value="<?php echo $revenue; ?>" required name="revenue" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="parent revenue">
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
      Hobby
      </label>
      <input value="<?php echo $hobby; ?>" required name="hobby" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="text" placeholder="hobby">
    </div>
  </div>

  <div class="w-full md:w-full  mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-parent-interest">
         interest 
      </label>
      <input value="<?php echo $interest; ?>" name="interest" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded  py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-parent-interest" type="text" placeholder=" interest">
    </div>
<br>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-health">
        health 
      </label>
      <input value="<?php echo $health; ?>" required name="health" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-health" type="text" placeholder="health">
    </div>
  </div>

    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
        blood
      </label>
      <div class="relative">
        <select  name="blood" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
        <option <?php if($blood =="A+") echo "selected='selected'"; ?>>A+</option>
        <option  <?php if($blood =="B+") echo "selected='selected'"; ?>>B+</option>
        <option  <?php if($blood =="B-") echo "selected='selected'"; ?>>B-</option>
        <option  <?php if($blood =="A-") echo "selected='selected'"; ?>>A-</option>
        <option  <?php if($blood =="AB+") echo "selected='selected'"; ?>>AB+</option>
        <option  <?php if($blood =="AB-") echo "selected='selected'"; ?>>AB-</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div>

  
    </div>
    <button name="submit" type="submit" class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-gray-100 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-white py-1 px-2 rounded" >
      Update
    </button> 

    <?php
  if($updated){
    echo '    <h1 class="text-center">Updated!</h1>
    ' ;
  }
    ?>


  </div>
</form>
</div>
</body>
</html>