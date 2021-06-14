<?php

    require_once 'database/conexion.php';
    $con = getconfig();
   
    if(!empty($_POST)){
        $titulo =$_POST["titulo"];
        $id =$_POST["id_post"];
        $contenido =$_POST["contenido"];
        $id_usuario =$_POST["id_usuario"];
        $img_existente =$_POST["img_existente"];
        $imagenNueva =$_POST["imagenNueva"];
        $fecha_crea=date('Y-m-d');
        $dir_image="img"; //directorio de imagenes
       
    
   

    try {

        $img=subir_imagen($dir_image,'imagenNueva');
        
    if($img==""|| $img==false ){
        $img_path=$img_existente;
    }else{
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
        $query = "UPDATE posts SET id_usuario=:id_usuario, titulo=:titulo, contenido=:contenido, fecha_crea=:fecha_crea, imagen=:imagen WHERE id=:id";

        $statement = $con->prepare($query);

        $statement->execute($data);
       
        $statement->closeCursor();
        $con = null;
        header('Location: adminPost.php');
        
        

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
        return "nodisponible.jpg";
    }