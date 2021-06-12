<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8a0597b0e.js" crossorigin="anonymous"></script>
    <title>Blog</title>
</head>

<?php

session_start();

if(!isset($_COOKIE['session_id']) ){
    include_once("nav.php");
    
}
if(isset($_COOKIE['session_id'])){
    
    if($_COOKIE['session_id'] != "null"){

        if($_SESSION['tipo'] == 1){
            include_once("navAdmin.php");
        }
        else{
            include_once("nav1.php");
        }
    }
    if($_COOKIE['session_id'] == "null"){
        include_once("nav.php");
    }
}

?>