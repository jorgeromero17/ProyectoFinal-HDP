<?php
#se valida que no pueda acceder a ciertas paginas si no esta iniciada la sesion o si no es admin
if(isset($_COOKIE['session_id'])){
    if($_COOKIE['session_id'] != "null"){
        if($_SESSION['tipo']!=1){
            header("Location: articulos.php"); 
        }
    }
    else{
        header("Location: index.php");     
    }
}
else{
    header("Location: index.php"); 
}