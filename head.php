<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c8a0597b0e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500&family=Mate+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog</title>
</head>
<body>
<?php

session_start();

if(!isset($_COOKIE['session_id'])){
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