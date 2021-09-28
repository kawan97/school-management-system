<?php 
include './components/authbacktolgin.php';

?>
<?php
$revenue="";
$hobby="";
$health="";
$interest="";
$blood='A+';
$username='';
if(isset($_GET['username'])){
  $username=addslashes((htmlentities($_GET['username'])));

}
include './dbcon.php';
$sql="select * from profile where username=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($username)); 
  while ($row = $stmt->fetch()) { 
    $revenue=$row['revenue'];
    $hobby=$row['hobby'];
    $health=$row['health'];
    $interest=$row['interest'];
    $blood=$row['blood'];
  }
  if ($stmt->rowCount()==0){
    header ('Location: index.php'); 
 
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">

    <title>Set Up Profile</title>
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
      <p><?php echo $revenue; ?></p>
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
      Hobby
      </label>
      <p><?php echo $hobby; ?></p>

    </div>
  </div>

  <div class="w-full md:w-full  mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-parent-interest">
         interest 
      </label>
      <p><?php echo $interest; ?></p>
    </div>
<br>
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-health">
        health 
      </label>
    <p><?php echo $health; ?></p>
    </div>
  </div>

    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-state">
        blood
      </label>
      <div class="relative">
      <p><?php echo $blood; ?></p>

        </div>
      </div>

  
    </div>





  </div>
</form>
</div>
</body>
</html>