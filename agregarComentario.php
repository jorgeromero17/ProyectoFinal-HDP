<?php

if(!empty($_POST['comentario'])){

    require_once 'database/conexion.php';
    $con = getconfig();
    date_default_timezone_set('America/El_Salvador');

    // para los comentarios es necesario
    // obtener el id de usuario y id del post
    $id=$_POST['id_usuario'];
    $id_post=$_POST['id_post'];
    $comentario=$_POST['comentario'];
    $query = "INSERT INTO coments(id_usuario,comentario,fecha,aprobado,id_post) VALUES('$id','$comentario',CURDATE(),'0','$id_post')";

    $statement = $con->prepare($query);
    $statement->execute();

    //cerrar flujo y base de datos
    $statement->closeCursor();
    $con = null;
    
    header("Location:".$_SERVER['HTTP_REFERER']); // Vuelva a la pagina anterior
}  
?>