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

    <title>Feddback</title>
</head>
<body class='bg-green-500'>
<?php include './components/nav.php';?>

<div class="container  py-4 ">
  <?php  
  $sql="select * from lecture where id=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($lectureid)); 
  $classid=0;
  while ($row = $stmt->fetch()) {
    //thinking

    $classid=$row['classid'];
    $sqlteacher="select * from class where id=?;"; 
  $stmtteacher=$pdo->prepare($sqlteacher); 
  $stmtteacher->execute(array($classid));
  while ($rowteacher = $stmtteacher->fetch()) {
    if($rowteacher['teacherid'] == $_SESSION['id']){
      echo '<h1 class="text-xl text-white text-center my-4">Class: '.$rowteacher['classname'].'</h1>'; 

      echo '<h1 class="text-xl text-white text-center my-4">Lecture: '.$row['lecturename'].'</h1>'; 
      echo '<h1 class="text-xl text-white text-center my-4">'.$row['date'].'</h1>'; 
    }else{
      header("location: ./index.php",  true );  exit;
    }

  }
  }
  echo $classid;
  ?>
  <?php  
  $sql="select * from enrollstu where classid=?;"; 
  $stmt=$pdo->prepare($sql); 
  $stmt->execute(array($classid)); 
  while ($row = $stmt->fetch()) {
    $sqlcheck="select * from feedback where studentname=? and lectureid=?;"; 
    $stmtcheck=$pdo->prepare($sqlcheck); 
    $stmtcheck->execute(array($row['studentname'], $lectureid)); 
    $count=$stmtcheck->rowCount();
    if($count==0){
      if ( isset( $_POST['true'.$row['id']])) {
        $degree=addslashes((htmlentities($_POST['degree'])));
        $sql="insert into feedback(lectureid,degree,studentname)values(?,?,?);";       
       $execu=$pdo->prepare($sql);
       $execu->execute(array($lectureid,(int)$degree,$row['studentname'])); 
       $pdo= null;
       header("location: ./feedback.php?id=".$lectureid,  true,  301 );  exit;
      }

      echo '
      <form method="post" class="w-full  mx-auto max-w-sm bg-gray-100 rounded-xl">
        <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
         <span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">'.$row['studentname'].'</span> 
         <div class="w-full flex items-center justify-items-center	 md:w-1/2 md:mx-12 px-3 mb-6 md:mb-0">
      <div class="relative flex-shrink-0 sm:-mx-3 sm:py-8 mx-0 py-0">
        <select  name="degree" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
        <option >1</option>
        <option >2</option>
        <option >3</option>
        <option >4</option>
        <option >5</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
          <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
        </div>
      </div> 
         <button type="submit" name="true'.$row['id'].'"  class="flex-shrink-0 sm:my-6 md:my-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </button>
        </div>
      </form>
      '; 
    }

    if($count!= 0){
      while ($row = $stmtcheck->fetch()) { 
       echo '
        <div class="w-full mx-auto max-w-sm bg-gray-100 rounded-xl">
          <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
           <span class="w-full  text-gray-700 mx-3 py-1 px-2 leading-tight">'.$row['studentname'].'</span>  
           <p   class="flex-shrink-0 border-transparent flex flex-row border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" >
            '.$row['degree'].'/5
          </p>
          </div>
        </div>
        '; 
      
        
      }
    }
  }
  
  ?>

</div>
</body>
</html>