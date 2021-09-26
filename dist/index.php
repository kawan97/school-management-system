<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style/style.css" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <?php include './components/nav.php';?>
    <?php include './dbcon.php';?>
    <?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
    <?php
print_r($_SESSION);
?>

    <h1 class="text-pink-400">hiii</h1>
</body>
</html>