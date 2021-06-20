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
    
    header("Location: vistaArticulo.php?id=$id_post&coment"); // Vuelva a la pagina anterior
}  

function CambiarEstado(){
    require_once 'database/conexion.php';
    $con = getconfig();

    try {
        $query = "UPDATE coments SET aprobado=:aprobado WHERE id=:id";

        $statement = $con->prepare($query);

        $statement->execute([

            ':aprobado'=>$_GET["mod"],
            ':id'=> $_GET["id"]
        ]);
       
        $statement->closeCursor();
        $con = null;
        
        header("Location:".$_SERVER['HTTP_REFERER']); // Vuelva a la pagina anterior

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}

function eliminarComentario(){
    require_once 'database/conexion.php';
    $con = getconfig();

    try {
        $query = "DELETE FROM coments WHERE id = :id";

        $statement = $con->prepare($query);

        $statement->execute([
            ':id'=> $_GET["id"]
        ]);
       
        $statement->closeCursor();
        $con = null;
        
        header("Location:".$_SERVER['HTTP_REFERER']); // Vuelva a la pagina anterior

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}

if(isset($_GET['id']) && isset($_GET['mod'])){
    CambiarEstado();
}

if(isset($_GET['id']) && isset($_GET['delete'])){
    EliminarComentario();
}