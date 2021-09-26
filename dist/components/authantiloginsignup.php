<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if(isset($_SESSION['username']) && isset($_SESSION['password'])){
        header('Location:./index.php');

    }else{
    }
?>