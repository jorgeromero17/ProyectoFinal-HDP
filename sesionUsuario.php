<?php

if(!isset($_SESSION['id'])){
    header("Location: index.php"); // VAlida que alguien que no este logeado no se pueda meter a ciertas paginas
}