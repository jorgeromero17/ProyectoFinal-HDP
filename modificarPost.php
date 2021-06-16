<?php include("head.php");
//include_once("guardarPost.php");
require_once 'database/conexion.php';
$con = getconfig();
date_default_timezone_set('America/El_Salvador');


$id=$_GET['id'];
$nombre=$_SESSION['nombre']." ".$_SESSION['apellido'];
$query="SELECT * FROM posts WHERE id=$id";
$statement = $con->prepare($query);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        foreach ($res as $row){
            $id_usuario= $row["id_usuario"];
            $titulo= $row["titulo"];
            $contenido= $row["contenido"];
            $img_existente= $row["imagen"];
        }
        
        

?>


<body>

    <div class="container">
        <div class="row d-flex justify-content-center my-5">
            <form action="guardarModificado.php" enctype="multipart/form-data" method="post" class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="h3" style="color:#554dde;">Modificar Post</label>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="h6" style="color:#554dde;"><?php echo $nombre;?></label>
                    </div>
                <div class="mb-3 d-flex justify-content-center">
                
                <img src="<?= $img_existente?>"  widht=100 height=100 alt="...">
                    <input type="hidden" name='id_usuario' id='id_usuario' value='<?php echo $id_usuario;?>' />
                    <input type="hidden" name='id_post' id='id_post' value="<?=$id?>" />
                </div>
                <div class="mb-3">
                <label class="form-label" style="color:#554dde; font-weight:600;">Titulo</label>
                <textarea class="form-control" id="titulo" name="titulo" style="border:1px solid #554dde;"  required><?=$titulo ?></textarea>

                </div>
                <div class="mb-3">
                <label class="form-label" style="color:#554dde; font-weight:600;">Contenido</label>
                <textarea class="form-control" id="Contenido" name="contenido" style="border:1px solid #554dde;#554dde;height:300px;"  required><?=$contenido ?></textarea>
                </div>
                <div class="mb-3">
                <label for="formFile" class="form-label" style="color:#554dde; font-weight:600;">Imagen de Portada</label>
                <input class="form-control" type="file" id="imagenNueva" name="imagenNueva" style="border:1px solid #554dde;" >
                <input type="text" name='img_existente' id='img_existente' value="<?=$img_existente?>" />
                <div class="d-grid gap-2 ">
                <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">Guardar</button>
                </div>

                </div>

                </form>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>