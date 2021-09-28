<?php
ob_start();  
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])){
  if($_SESSION['role'] == 'parent' || $_SESSION['role'] == 'student' ){
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Feedback</title>
</head>
<body>
<div class="shadow-lg rounded-lg overflow-hidden">
  <div class="py-3 px-5 bg-gray-50">
      Student Feedback
  </div>
  <canvas class="p-10 " id="chartBar"></canvas>
</div>

<!-- Required chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart bar -->
<script>

  const labelsBarChart = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
  ];
  const dataBarChart = {
    labels: labelsBarChart,
    datasets: [{
      label: 'Student Name: ',
      backgroundColor: 'hsl(252, 82.9%, 67.8%)',
      borderColor: 'hsl(252, 82.9%, 67.8%)',
      data: [0, <?php echo 17; ?>, 5, 2, 20, 30, ],
    }]
  };

  const configBarChart = {
    type: 'bar',
    data: dataBarChart,
    options: {}
  };


  var chartBar = new Chart(
    document.getElementById('chartBar'),
    configBarChart
  );
</script>
</body>
</html>