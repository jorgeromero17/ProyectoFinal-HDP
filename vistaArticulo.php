<?php include("head.php");
//include_once("guardarPost.php");
require_once 'database/conexion.php';
$con = getconfig();
date_default_timezone_set('America/El_Salvador');


$id=$_GET['id'];
$nombre=$_SESSION['nombre']." ".$_SESSION['apellido'];
//$query="SELECT * FROM posts WHERE id=$id";

$query = "SELECT p.id, u.id, u.nombre,u.apellido, p.titulo, 
p.contenido, p.fecha_crea, p.imagen 
FROM posts as p
JOIN usuarios AS u on u.id=p.id_usuario 
WHERE p.id=$id ORDER BY p.fecha_crea ASC";

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
            $por=$row["nombre"]." ".$row["apellido"];
        }
        
        

?>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <form action="articulos.php" enctype="multipart/form-data" method="post" class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                <div class="mb-3 d-flex justify-content-center">
                
                <label class="h3" style="color:#554dde;"><?=$titulo ?></label>
                        </div>
                        <div class="mb-3 d-flex justify-content-center">
                        <label class="mt-1" style="color:#4f4c89;">Por: <?=$por ?></label>
                        </div>
                <div class="mb-3 d-flex justify-content-center">
                <img src="<?= $img_existente?>"  widht=200 height=200 alt="...">
                </div>
               
                <div class="mb-3">
                <textarea class="form-control" readonly id="Contenido" name="contenido" style="border:1px solid #554dde;"  required><?=$contenido ?></textarea>
                </div>
                <div class="d-grid gap-2 ">
                <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">regresar</button>
                </div>

                </div>

                </form>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>