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

$sqldegree="select lecture.lecturename,lecture.date,feedback.degree From lecture INNER JOIN
feedback ON lecture.id=feedback.lectureid WHERE lecture.classid=? AND feedback.classid=? AND feedback.studentname=?;"; 
$stmtdegree=$pdo->prepare($sqldegree); 
$stmtdegree->execute(array($classid,$classid,$_SESSION['username']));
$dgrees='[';
$dates='[';
$colors='[';

while ($rowdegree = $stmtdegree->fetch()) {
  if((int)$rowdegree['degree']>=4){
    $colors=$colors.'\'green\',';
  }else if((int)$rowdegree['degree']==3){
    $colors=$colors.'\'orange\',';
  }else if((int)$rowdegree['degree']<=2){
    $colors=$colors.'\'red\',';
  }
  $dgrees=$dgrees.$rowdegree['degree'].',';
  $dates=$dates.'\''.$rowdegree['date'].'\',';


}


$colors=substr($colors, 0, -1);
$colors=$colors.']';
$dgrees=$dgrees.']';
$dates=$dates.']';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./style/style.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

  <title>Student Feedback</title>
</head>
<body class="bg-green-200">
<?php include './components/nav.php';?>
<div class="w-full  mx-auto max-w-lg my-10 bg-gray-100 rounded-xl">

<h1 class="text-center">Student Feedback  /5</h1>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = <?php echo $dates; ?>;
var yValues = <?php echo $dgrees; ?>;
var barColors = <?php echo $colors; ?> ;

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  
  options: {
    legend: {display: false},
    scales: {
                    xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Date'
                            }
                        }],
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 1,
                                stepValue: 1,
                                max: 5
                            }
                        }]
                },
    title: {
      display: true,
      text: "Student Name <?php echo $_SESSION['username'] ?>, /5"
    }
  }
});
</script>


</div>
</body>
</html>