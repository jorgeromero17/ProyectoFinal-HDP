<?php include("head.php");
include("funciones.php");
/* session_start();

var_dump($_SESSION['usuario']); */
require_once 'database/conexion.php';
$con = getconfig();

$query = "SELECT p.id, u.id AS id_usuario, u.nombre,u.apellido, p.titulo, 
p.contenido, p.fecha_crea, p.imagen 
FROM posts as p
JOIN usuarios AS u on u.id=p.id_usuario 
ORDER BY p.fecha_crea DESC";
$statement = $con->prepare($query);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
       

?>
<body>

<div class="container">
    <div class="row d-flex justify-content-center mt-5">
    

        
        <?php  foreach ($res as $row){
            $id_usuario= $row["id_usuario"];
            $id= $row["id"];
            $titulo= $row["titulo"];
            $contenido= $row["contenido"];
            $img_existente= $row["imagen"];
            $fecha_crea= fecha_dmy( $row["fecha_crea"]);
            $por=$row["nombre"]." ".$row["apellido"];

        ?>

        <div class="card col-10 col-sm-10 col-md-5 col-lg-4 col-xl-3 m-3" style="border-radius:10px; border:1px solid #262b47; background:white; padding:0;">
            <div clas="w100" style="background-image: url('<?= $img_existente?>');background-repeat: no-repeat;background-size: cover;background-position: center;height:200px; border-top-left-radius:10px; border-top-right-radius:10px;"></div>
            <div style="flex: 1;display: flex;flex-direction: column;justify-content: space-between;">
                <div clas="card-body" style="padding:15px;">
                    <h5 class="h4 mt-3" style="color:#262b47;font-weight:700;"><?=$titulo ?></h5>
                    <div class="d-flex flex-column">
                        <label class="mt-3" style="color:#4f4c89;">Por: <?=$por ?></label>
                        <label class="mt-1" style="color:#4f4c89;"><?=$fecha_crea ?></label>
                    </div>
                </div>
                <div style="padding:15px;">
                    <?php echo' <a type="button" href="vistaArticulo.php?id='.$id.'" class="btn text-light" style="background:#554dde">Leer post<i class="fas fa-chevron-right ms-2"></i></i></a>'?>
                </div>
            </div>
        </div>
           
        
        <?php } ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>



</html>

