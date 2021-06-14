<?php
require_once 'database/conexion.php';
$con = getconfig();
date_default_timezone_set('America/El_Salvador');

if(!empty($_POST)){
  $titulo =$_POST["titulo"];
  $contenido =$_POST["contenido"];
  $id_usuario= $_POST['id_usuario'];
  $fecha_crea=date('Y-m-d');
  $dir_image="img"; //directorio de imagenes
  try {

    $img=subir_imagen($dir_image,'imagen');
    if($img==""){
        $img="nodisponible.jpg";
    }
    $img_path=$dir_image."/".$img;
      $data = [
             'id_usuario'=>$id_usuario,
             'titulo'=>$titulo,
             'contenido'=>$contenido,
             'fecha_crea'=>$fecha_crea,
             'imagen'=> $img_path,
       ];
     $consulta = "INSERT INTO posts(id_usuario, titulo, contenido, fecha_crea, imagen)
     VALUES(:id_usuario, :titulo, :contenido, :fecha_crea, :imagen)";
    $statement= $con->prepare($consulta);
    $statement->execute($data);
    $statement->closeCursor();
    $con = null;
    header('Location: articulos.php');
  } catch (Exception $error) {
      print "Error!:".$error->getMessage()."<br>";
      die();
  }

}
function subir_imagen($directorio_destino, $nombre_archivo)
{
    $tmp_name = $_FILES[$nombre_archivo]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
    {
      $prefijo=date('Y-m-d')."_".mt_rand(1,30)."_";

        $img_file = $prefijo.$_FILES[$nombre_archivo]['name'];
        $img_type = $_FILES[$nombre_archivo]['type'];
        // Si se trata de una imagen del tipo
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") || strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //debe tener  permisos para subir la imágen
            if (move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file))
            {
             //  echo "imagen:".$img_file;
                return $img_file;

            }
        }
    }
    //Si nos retorna false algo ha fallado
    return false;
}


function getpostAdmin($id_usuario){
    require_once 'database/conexion.php';
    $con = getconfig();

    try {
        
        $query = "SELECT p.id, u.id AS id_usuario, u.nombre,u.apellido, p.titulo, 
        p.contenido, p.fecha_crea, p.imagen 
        FROM posts as p
        JOIN usuarios AS u on u.id=p.id_usuario 
        WHERE u.id=$id_usuario ORDER BY p.fecha_crea ASC";

        $statement = $con->prepare($query);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        header('Location: adminPost.php');
        
        return $res;

    } catch (Exception $error) {
        print "Error!:".$a->getMessage()."<br>";
        die();
    }
}
function getpostUser($id_usuario){
    require_once 'database/conexion.php';
    $con = getconfig();

    try {
        
        $query = "SELECT p.id, u.id, u.nombre,u.apellido, p.titulo, 
        p.contenido, p.fecha_crea, p.imagen 
        FROM posts as p
        JOIN usuarios AS u on u.id=p.id_usuario 
        WHERE u.id!=$id_usuario ORDER BY p.fecha_crea ASC";

        $statement = $con->prepare($query);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        header('Location: adminPostUser.php');
        
        return $res;

    } catch (Exception $error) {
        print "Error!:".$a->getMessage()."<br>";
        die();
    }
}

