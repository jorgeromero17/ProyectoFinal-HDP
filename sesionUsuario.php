<?php
#se valida que no pueda acceder a ciertas paginas si no esta iniciada la sesion
if(!isset($_COOKIE['session_id'])){
    header("Location: index.php"); 
}
else{
    if($_COOKIE['session_id'] == "null"){
        header("Location: index.php"); 
    }
}