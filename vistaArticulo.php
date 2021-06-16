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
            $id_usuario= $row["id"];
            $titulo= $row["titulo"];
            $contenido= $row["contenido"];
            $img_existente= $row["imagen"];
            $fecha= $row["fecha_crea"];
            $por=$row["nombre"]." ".$row["apellido"];
        }
?>

<body>
    
    <div class="container">
        <div class="row d-flex justify-content-center my-5">    
            <div class="imagen-post" style="background-image: url('<?= $img_existente?>');"></div> 
            <div class="contenido-post">
                <h1 class="my-4 display-4" style="font-weight:600; padding:30px;"><?=$titulo ?></h1>
                <p class="" style="font-weight:regular; padding:30px;"><?=$contenido ?></p>
                <div class="h6" style="padding: 0px 30px 30px 30px" >
                    <p class=""><?=$por ?></p>
                    <p class="" ><?=$fecha ?></p>
                </div>
            </div>

            <div class="contenido-post overflow-auto mt-4" style="border-radius:10px;border:1px solid #262b47;padding:0;height:400px;">
                
                <div class="">
                    <p class="h5 mt-4 mx-auto" style="width:90%;">Comentarios</p>
                    
                    <form class="my-4 mx-auto d-flex flex-column" style="height:250px; width:90%;">
                        <textarea class="p-4" name="comentario" id="" cols="30" rows="10" placeholder="Agregar comentario..." style='width:100%;height:200px;;border:1px solid #554dde;background:#f5f5f5; color:#262b47; font-size:16px; border-radius:10px;'></textarea>
                        <button type="submit" class="btn text-light mt-3 align-self-end" style="background:#554dde;font-weight:600;">Agregar</button>
                    </form>

                    <div class="my-4 p-4 mx-auto" style="background:#f5f5f5; color:#262b47; font-size:16px; border-radius:10px;  min-height:200px; width:90%;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta maxime, quisquam, magni quod omnis natus officia.
                    </div>
                    <div class="my-4 p-4 mx-auto" style="background:#f5f5f5; color:#262b47; font-size:16px; border-radius:10px;  min-height:200px; width:90%;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta maxime, quisquam, magni quod omnis natus officia.
                    </div>
                    <div class="my-4 p-4 mx-auto" style="background:#f5f5f5; color:#262b47; font-size:16px; border-radius:10px;  min-height:200px; width:90%;">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta maxime, quisquam, magni quod omnis natus officia.
                    </div>
                </div>
                
            </div>

        </div>
    </div>


    


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>