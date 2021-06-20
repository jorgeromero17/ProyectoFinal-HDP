<?php

include_once 'head.php';
$id_usuario= $_SESSION['id'];
$tipo=$_SESSION['tipo'];
?>

<body>
<div class="container">
    <div class="row d-flex justify-content-center my-5"> 
    <!-- <p class="h5 mt-4 mx-auto" style="width:90%;">Comentarios Rechazados</p>   -->
        <div class="overflow-auto mt-4" style="padding:0;height:600px;">
                
                <?php  
                require_once 'database/conexion.php';
                $con = getconfig();
                date_default_timezone_set('America/El_Salvador');

                // Para moderar los posts, traemos aquellos
                // que no esten aprobados, es decir que sean cero (0):
                // 0 = no esta aprobado
                // 1 = esta aprobado el post
                // 2 = ha sido rechazado

                $query="SELECT * FROM coments WHERE aprobado=2";               
                $statement = $con->prepare($query);
                $statement->execute();
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);
                $statement->closeCursor();
                
                foreach ($res as $row){
                    $id_usuario= $row["id_usuario"];
                    $id_post= $row['id_post'];
                    
                    // traemos los datos de usuarios
                    $consulta="SELECT * FROM usuarios WHERE id=$id_usuario";             
                    $st = $con->prepare($consulta);
                    $st->execute();
                    $aux = $st->fetchAll(PDO::FETCH_ASSOC);
                    $st->closeCursor();
                    foreach ($aux as $val){
                        $usuario = $val['usuario'];
                    }

                    // traemos los posts
                    $consulta_id_post= "SELECT * FROM posts WHERE id=$id_post";
                    $state = $con->prepare($consulta_id_post);
                    $state->execute();
                    $auxiliar = $state->fetchAll(PDO::FETCH_ASSOC);
                    $state->closeCursor();

                    foreach($auxiliar as $valor){
                        $titulo_post = $valor['titulo'];
                    }

                    // Se Muestran los posts no moderados
                    $fecha= $row["fecha"];
                    $comentario= $row["comentario"];
                    $id= $row["id"];

                    echo <<<END
                            <div class="my-4 p-4 mx-auto" style="background:white; color:#262b47; font-size:16px; border-radius:10px; width:90%; border:1px solid #554dde;">
                            <div class="mb-3" style="color:#554dde;font-weight:bold;">
                                [$usuario]
                            </div>
                            <div style="min-height:50px;color:#262b47;font-size:18px;font-weight:500;">
                                <span>$comentario</span>
                            </div>
                            <div class="mt-3">
                                <p style="margin:0;color:#4f4c89">En: $titulo_post</p>
                                <p style="margin:0;color:#4f4c89">El: $fecha</p>
                            </div>
                            <div action="agregar" class="d-flex justify-content-end">
                                <a type="button" href="comentarios.php?id=$id&delete" class="btn mx-2" style="background:#white;font-weight:600;border:1px solid #554dde;color:#554dde;">Eliminar</a>
                                <a type="button" href="comentarios.php?id=$id&mod=1" class="btn text-light mx-2" style="background:#554dde;font-weight:600;">Aceptar</a>
                            </div>
                        </div>
                    END;
                    }
                    //cerrar flujo y base de datos
                    $con = null;
                ?>
        </div>

    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>