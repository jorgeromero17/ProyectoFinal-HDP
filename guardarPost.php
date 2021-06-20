<?php
//hacemos conexión con la base de datos 
require_once 'database/conexion.php';
$con = getconfig();
//colocamos esto para que nos de la hora
//de acá, ya que si no lo colocamos
//nos dará una hora adelantada
date_default_timezone_set('America/El_Salvador');

//nos traemos los datos con post
if(!empty($_POST)){
  $titulo =$_POST["titulo"];
  $contenido =nl2br($_POST["contenido"]);
  $id_usuario= $_POST['id_usuario'];
  $fecha_crea=date('Y-m-d');
  $dir_image="img"; //directorio de imagenes
//haremos un try catch para ver si
//tenemos un error al subir la imagen
  try {
    //mandamos a llamar a la función de
    //subir imagen, le pasaremos los
    //parámetros que es el directorio y
    //la imagen a subir
    $img=subir_imagen($dir_image,'imagen');

    //si en dado caso el usuario deja vacío ese
    //campo dejamos una imagen predeterminada
    if($img==""){
        $img="nodisponible.jpg";
    }
    //si no simplemente guardamos la imagen 
    //en esta variable para poder subirla a 
    //la base 
    $img_path=$dir_image."/".$img;
      //los datos
      $data = [
             'id_usuario'=>$id_usuario,
             'titulo'=>$titulo,
             'contenido'=>$contenido,
             'fecha_crea'=>$fecha_crea,
             'imagen'=> $img_path,
       ];
     //hacemos la consulta de insertar 
     $consulta = "INSERT INTO posts(id_usuario, titulo, contenido, fecha_crea, imagen)
     VALUES(:id_usuario, :titulo, :contenido, :fecha_crea, :imagen)";
    $statement= $con->prepare($consulta);//preparamos la consulta
    $statement->execute($data);//le pasamos los valores, los datos
    $statement->closeCursor();
    $con = null;
    header('Location: articulos.php');//redirijimos después 
  } catch (Exception $error) {
      print "Error!:".$error->getMessage()."<br>";//si hay algún error
      die();
  }

}
//función para subir la imagen 
function subir_imagen($directorio_destino, $nombre_archivo)
{
    $tmp_name = $_FILES[$nombre_archivo]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo
    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
    {
 
      //si en dado caso el usuario sube una imagen con nombre
      //que sea igual a otra, optamos por agregarle un número 
      //random y la fecha en la que se subió al guardar la imagen
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

//función que nos ayudara a traernos
//solo los post del admin
function getpostAdmin($id_usuario){
    //hacemos conexión con la base de datos 
    require_once 'database/conexion.php';
    $con = getconfig();

    //haremos try catch para ver si tenemos errores
    try {
        
        //haremos una consulta especial 
        //ya que necesitamos datos de diferentes tablas 
        $query = "SELECT p.id, u.id AS id_usuario, u.nombre,u.apellido, p.titulo, 
        p.contenido, p.fecha_crea, p.imagen 
        FROM posts as p
        JOIN usuarios AS u on u.id=p.id_usuario 
        WHERE u.id=$id_usuario ORDER BY p.fecha_crea ASC";

        //preparamos la consulta 
        $statement = $con->prepare($query);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        //header('Location: adminPost.php');
        
        return $res;

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}

//función que nos ayudara 
//a traernos los post de 
//todos los usuarios 
function getpostUser($id_usuario){
    require_once 'database/conexion.php';
    $con = getconfig();

    //haremos un try catch para ver si tenemos algún error 
    try {
        
        //haremos una consulta especial ya que nesecitamos
       //datos de diferentes tablas 
        $query = "SELECT p.id, u.id, u.nombre,u.apellido, p.titulo, 
        p.contenido, p.fecha_crea, p.imagen 
        FROM posts as p
        JOIN usuarios AS u on u.id=p.id_usuario 
        WHERE u.id!=$id_usuario ORDER BY p.fecha_crea ASC";

        $statement = $con->prepare($query);//preparamos la consulta
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        //header('Location: adminPostUser.php');
        
        return $res;

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}

function eliminarPost(){
    require_once 'database/conexion.php';
    $con = getconfig();

    try {
        $query = "DELETE FROM posts WHERE id = :id";
        $query1 = "DELETE FROM coments WHERE id_post = :id";

        $statement = $con->prepare($query);
        $statement1 = $con->prepare($query1);

        $statement->execute([
            ':id'=> $_GET["id"]
        ]);
        $statement1->execute([
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


if(isset($_GET['delete']) && isset($_GET['id'])){
    eliminarPost();
}