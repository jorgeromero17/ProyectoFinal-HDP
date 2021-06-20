<?php

    //hacemos conexión con base de datos
    require_once 'database/conexion.php';
    $con = getconfig();
   //nos traemos los datos con post
    if(!empty($_POST)){
        $titulo =$_POST["titulo"];
        $id =$_POST["id_post"];
        $contenido =$_POST["contenido"];
        $id_usuario =$_POST["id_usuario"];
        $img_existente =$_POST["img_existente"];
        //$imagenNueva =$_POST["imagenNueva"];
        $fecha_crea=date('Y-m-d');
        $dir_image="img"; //directorio de imagenes
       
    
   
    //hacemos try catch para ver si tenemos errores
    //al subir la imagen
    try {

        //aquí mandamos a llamar a la función de subir
        //imagen, le pasaremos como parámetros el
        //directorio en el que se guardará la imagen 
        //y la imagen a guardar
        $img=subir_imagen($dir_image,'imagenNueva');
       //validamos, si el usuario deja vacío
     //la parte de la imagen
    if($img==""|| $img==false ){
        //si es vacío simplemente deja la imagen
        //antes puesta
        $img_path=$img_existente;
    }else{
    //si no se guarda la imagen nueva
    $img_path=$dir_image."/".$img;
    }
      $data = [
             'id'=>$id,
             'id_usuario'=>$id_usuario,
             'titulo'=>$titulo,
             'contenido'=>$contenido,
             'fecha_crea'=>$fecha_crea,
             'imagen'=> $img_path,
       ];
        //hacemos la consulta de acrualizar
        $query = "UPDATE posts SET id_usuario=:id_usuario, titulo=:titulo, contenido=:contenido, fecha_crea=:fecha_crea, imagen=:imagen WHERE id=:id";

        //preparamos la consulta
        $statement = $con->prepare($query);

       //le pasamos los parámetros, los datos
        $statement->execute($data);
       
        $statement->closeCursor();
        $con = null;
        //luego de cumplir esto lo redirijimos 
        header('Location: adminPost.php');
        
        

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
    }
    //función para poder subir la imagen al directorio
    function subir_imagen($directorio_destino, $nombre_archivo)
    {
       
        if($nombre_archivo!=''){
            $tmp_name = $_FILES[$nombre_archivo]['tmp_name'];
        
            //si hemos enviado un directorio que existe realmente y hemos subido el archivo
            if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
            {
            //en dado caso que el usuario ingrese una imagen 
            //que se llame igual a otra optamos por agregarle 
            //números random y la fecha en la que se sube al guardad
            //la imagen
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
        }
        else{
            return false;
        }
        //Si nos retorna false algo ha fallado
        //return "nodisponible.jpg";
    }
