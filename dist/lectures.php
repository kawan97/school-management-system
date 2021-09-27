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
$classid=addslashes((htmlentities($_GET['id'])));

}else{
    header("location: ./index.php",  true );  exit;
}

if (isset( $_POST['submit'])) { 
  $lecturename=addslashes((htmlentities($_POST['lecturename'])));
  $sql="insert into lecture(classid,lecturename)values(?,?);";  
  $execu=$pdo->prepare($sql);
  $execu->execute((array($classid,$lecturename)));
  $pdo= null;
  header("location: ./lectures.php?id=".$classid,  true,  301 );  exit;
}
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
<form method="post" class="w-full max-w-lg mx-auto p-4 bg-gray-100 rounded-xl">
  <div class="flex flex-wrap -mx-3 mb-6">
  <div class="w-full md:w-full px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-class-name">
        Lecture Name 
      </label>
      <input required name="lecturename" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-class-name" type="text" placeholder="Lecture Name">
    </div>
  </div>

    <button type="submit" name="submit" class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-gray-100 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-white py-1 px-2 rounded">
      Add Lecture
    </button> 

  </div>
</form>
<?php
$sql="select lecture.id,lecture.classid,lecture.lecturename,lecture.date,class.teacherid From lecture INNER JOIN
class ON lecture.classid=class.id WHERE lecture.classid=?;"; 
$stmt=$pdo->prepare($sql); 
$stmt->execute(array($classid)); 
while ($row = $stmt->fetch()) { 
    if($row['teacherid'] == $_SESSION['id']){
    }else{
      header("location: ./index.php",  true );  exit;
    }

    echo '
    <div class="w-full mx-auto max-w-sm bg-gray-100  my-3 rounded-xl">
    <div class="flex items-center border-b rounded-xl border-gray-500 py-2">
  <span class="w-full text-gray-700 mx-3 py-1 px-2 leading-tight">Lecture Name: '.$row['lecturename'].', Data:'.$row['date'].'</span>  
  <a  href="absence.php?id='.$row['id'].'" class="flex-shrink-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" >
  Absence
      </a>
      <a  href="feedback.php?id='.$row['id'].'" class="flex-shrink-0 border-transparent border-4 bg-green-500 mx-4 text-white hover:text-green-800 text-sm py-1 px-2 rounded" >
        Feedback
      </a>
    </div>
  </div>';   
}
?>

</div>
</body>
</html>