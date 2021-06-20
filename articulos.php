<?php include("head.php");
include("funciones.php");

//aquí hacemos una función donde
//nos traerá todos los post existentes
function getAllPosts(){ 
    require_once 'database/conexion.php';
    $con = getconfig();

    //haremos una consulta especial ya que
    //necesitamos el nombre del usuario del post
    //así que nesecitamos traernos datos de diferentes tablas
    $query = "SELECT p.id, u.id AS id_usuario, u.nombre,u.apellido, p.titulo, p.fecha_crea, p.imagen  
    FROM posts AS p 
    JOIN usuarios AS u ON u.id=p.id_usuario 
    ORDER BY p.fecha_crea DESC";
    //aquí prepararemos la consulta antes hecha
    $statement = $con->prepare($query);
            $statement->execute();
            $res = $statement->fetchAll(PDO::FETCH_ASSOC);
            //cerrar flujo y base de datos
            $statement->closeCursor();
            $con = null;

            //retornamos los datos
            return $res;
}

function buscarPost($busqueda){ //funcion que busca palabras en los titulos para mostrarle al usuario, duvuelve un array 'post'
    
    $res = getAllPosts(); //llamamos para que traiga todos los posts y guardamos en $res
      
    $resTitulo[] = ''; //inicializamos un array para guardar todas las coincidencias por palabras
    $limite = count($res); 
    for ($i=0; $i < $limite; $i++) { //un for para buscar en cada titulo de todos los posts
        
        $titulodelPost = strtolower($res[$i]['titulo']); //ponemos en minusculas todas las palabras el titulo y la busqueda para abarcar mas coincidencias
        $busqueda = strtolower($busqueda);

        $arrayTitulo = explode(" ", $titulodelPost); //convertimos el string del titulo del post en un array en el que cada palabra es un miembro de este array
        $arrayBusqueda = explode(" ", $busqueda); //convertimos el string de la busqueda en un array igual que el de titulo

        $cont = 0; //contador que sirve para que si ya coincidio con alguna palabra del titulo evaluado no se haga push de este nuevamente

        foreach ($arrayTitulo as $palabraT) { //desglosamos los array de titulo y busqueda para ver si alguna palabra coincide
            foreach ($arrayBusqueda as $palabraB) {
                if($palabraT == $palabraB){ //si alguna palabra coincide y no se ha guardado todavia este post, se guarda en $resTitulo
                    if($cont==0){
                        array_push($resTitulo,$res[$i]);
                        $cont=$cont+1;
                    }
                }
            }
        } 
    
    }  

    unset($resTitulo[0]); //le quitamos el primer valor al array de titulos que coincidieron con la busqueda porque este esta vacio
    return $resTitulo; //devolvemos la respuesta
}

if(!isset($_GET['Buscar'])){ //si no esta seteada en el GET que queremos buscar, traemos todos
    $res = getAllPosts();
}
else { //si no, evaluamos que este seteada la busqueda en el POST
    if(isset($_POST['busqueda'])){  // si lo esta, llamamos a buscarPost()
        $res = buscarPost($_POST['busqueda']);
    }
    else{ //si no esta seteada la busqueda en el POST traemos todos
        $res = getAllPosts();
    }
}

?>

<body>

<div class="container">
    <div class="row d-flex justify-content-center mt-5">
    

        <form action="articulos.php?Buscar" method="post" class="input-group mb-3"style="border-radius:12px; border:1px solid #554dde; background:white;padding:0;">
            <input type="text" name="busqueda" class="form-control" placeholder="Busca por palabras que recuerdes del título" style="border-top-left-radius:10px;border-bottom-left-radius:10px;">
            <button class="btn px-4" type="submit" id="button-busqueda" style="background:#554dde;border-top-right-radius:10px;border-bottom-right-radius:10px;color:white">Buscar</button>
        </form>

        
        <?php  
            
            if(count($res) < 1){
                echo '<div class="alert alert-danger d-flex aling-content-center" role="alert">
                        <i class="fas fa-heart-broken me-2" style="font-size:25px;"></i><strong>Raios, no se han encontrado resultados...</strong>
                    </div>';
            }
            else{
                foreach ($res as $row){
                $id_usuario= $row["id_usuario"];
                $id= $row["id"];
                $titulo= $row["titulo"];
                /* $contenido= $row["contenido"]; */
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
           
        
        <?php } } ?>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>



</html>

