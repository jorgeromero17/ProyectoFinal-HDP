<?php
//archivo con la logica de agregar, cambiar estado y eliminar comentario

if(!empty($_POST['comentario'])){//se ejecuta si el post trae la variable comentario con contenido

    require_once 'database/conexion.php'; //traemos lo necesario para la conexion a la base de datos
    $con = getconfig();
    date_default_timezone_set('America/El_Salvador');

    // para los comentarios es necesario
    // obtener el id de usuario y id del post
    $id=$_POST['id_usuario'];
    $id_post=$_POST['id_post'];
    $comentario=nl2br($_POST["comentario"]); //la consulta de agregar comentario se ejecuta
    $query = "INSERT INTO coments(id_usuario,comentario,fecha,aprobado,id_post) VALUES('$id','$comentario',CURDATE(),'0','$id_post')";

    $statement = $con->prepare($query); //ejecutamos la consulta
    $statement->execute();

    //cerrar flujo y base de datos
    $statement->closeCursor();
    $con = null;
    
    header("Location: vistaArticulo.php?id=$id_post&coment");//volvemos a la vista del articulo, con feedback para el usuario
}  

function CambiarEstado(){ //sirve para cambiar el estado del comentario en solicitud, para aceptar o rechazar
    require_once 'database/conexion.php';
    $con = getconfig();//traemos lo necesario para la conexion a la base de datos

    try {//la consulta donde solo actualizamos el compo aprobado, con lo que venga en el get
        $query = "UPDATE coments SET aprobado=:aprobado WHERE id=:id";

        $statement = $con->prepare($query); //la consulta se prepara

        $statement->execute([ //se ejectuta

            ':aprobado'=>$_GET["mod"],
            ':id'=> $_GET["id"]
        ]);
       
        $statement->closeCursor(); //libera la conexión al servidor
        $con = null; //anulamos la conexion
        
        header("Location:".$_SERVER['HTTP_REFERER']); // Vuelva a la pagina anterior

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}

function eliminarComentario(){ 
    require_once 'database/conexion.php';//traemos lo necesario para la conexion a la base de datos
    $con = getconfig();

    try {//declaramos la consulta donde queremos que se elimine el comentario con el id que trae el get
        $query = "DELETE FROM coments WHERE id = :id";

        $statement = $con->prepare($query); //se prepara la consulta

        $statement->execute([//se ejecuta
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

if(isset($_GET['id']) && isset($_GET['mod'])){ //cambiar estado solo se ejecuta si el id y mod estan seteados en el get
    CambiarEstado();
}

if(isset($_GET['id']) && isset($_GET['delete'])){ //eliminar comentario solo se pone en marcha si estan seteadas la variables id y delete en el get 
    EliminarComentario();
}