<?php

if(isset($_SESSION['id'])){
    if($_SESSION['tipo']!=1){
        header("Location: articulos.php"); // VAlida que alguien que no sea Admin no se pueda meter a ciertas paginas
    }
}
else{
    header("Location: index.php"); // VAlida que alguien que no este logeado no se pueda meter a ciertas paginas
}