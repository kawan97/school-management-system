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

if (isset($_GET['month']) && isset($_GET['year'])) {
  $month=addslashes((htmlentities($_GET['month'])));
  $year=addslashes((htmlentities($_GET['year'])));
}else{
  $year=date("Y");
  $month=date('m');

}

$start=$year.'-'.$month.'-1';
$end = strtotime($start);
$end = date("Y-m-d",strtotime("+1 month",$end));

$sqldegree="select lecture.lecturename,lecture.date,feedback.degree From lecture INNER JOIN
feedback ON lecture.id=feedback.lectureid WHERE lecture.classid=? AND feedback.classid=? AND feedback.studentname=? AND
 (lecture.date >= ? AND lecture.date < ?);"; 
$stmtdegree=$pdo->prepare($sqldegree); 
$stmtdegree->execute(array($classid,$classid,$_SESSION['username'],$start,$end));
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

if(isset($_POST['submit'])) {
  $month=addslashes((htmlentities($_POST["month"])));
  $year=addslashes((htmlentities($_POST['year'])));
  header("location: studentfeedback.php?id=".$classid.'&&month='.$month.'&&year='.$year);  
}


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
<form method="POST" class="w-full mt-8 max-w-lg mx-auto p-4 bg-gray-100 rounded-xl">
  <div class="flex flex-wrap -mx-3 mb-6">
    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
        Month
      </label>
      <input value="<?php echo $month; ?>" required name="month" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="number" max="12" placeholder="enter month">
    </div>
    <div class="w-full md:w-1/2 px-3">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
      Year
      </label>
      <input value="<?php echo $year; ?>" required name="year" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" type="number" placeholder="enter year">
    </div>
  </div>
    </div>
    <button name="submit" type="submit" class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-gray-100 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-white py-1 px-2 rounded" >
     Go!
    </button> 
  </div>
</form>

<div class="w-full  mx-auto max-w-lg my-10 bg-gray-100 rounded-xl">

<h1 class="text-center">Student Feedback  /5</h1>
<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
var xValues = <?php echo $dates; ?>;
var yValues = <?php echo $dgrees; ?>;
var barColors = <?php echo $colors; ?> ;

new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: "purple",
      borderColor: "black",
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
      text: "Student Name <?php echo $_SESSION['username']; ?>,Start: <?php echo $start; ?> End:<?php echo $end; ?>,   /5 "
    }
  }
});
</script>


</div>
</body>
</html>