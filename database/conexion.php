<?php

function getconfig(){

    require_once('config.php');

    try {
        $con = new PDO("mysql::host=".HOST.";dbname=".DB_NAME,USER,PASS);
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $con->exec("SET NAMES ".DB_CHARSET);
    
        return $con;
    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}