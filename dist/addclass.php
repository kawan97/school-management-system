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
<form class="w-full max-w-lg mx-auto p-4 bg-gray-100 rounded-xl">
  <div class="flex flex-wrap -mx-3 mb-6">



  <div class="w-full md:w-full px-3 mb-6 md:mb-0">
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-class-name">
        claas Name 
      </label>
      <input require name="classname" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-class-name" type="text" placeholder="Class Name">
    </div>
  </div>

    <button class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-gray-100 my-4  py-4 w-full hover:border-gray-300 text-xl border-4 text-white py-1 px-2 rounded" type="button">
      Add Class
    </button> 

  </div>
</form>
</div>
</body>
</html>