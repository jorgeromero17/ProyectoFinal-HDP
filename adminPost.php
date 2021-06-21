<?php

//agregamos archivos a necesitar 
include_once('head.php');
include_once('guardarPost.php');
include_once("sesionAdmin.php");

//en las siguientes variables 
//guardaremos el ID del usuario
//y el tipo
$id_usuario= $_SESSION['id'];
$tipo=$_SESSION['tipo'];
?>

<body>
    <div class="container mt-5">
        <div class="mb-3 d-flex justify-content-center">
            <a href="crearBlog.php" class="btn my-3" style="background:#554dde; color:white;">Agregar post</a>
        </div>
        <div class="p-3"  style="border:1px solid #554dde; border-radius:10px;">
            <table class="table table-hover" id="posts" style="border:none;">	
                <thead>
                    <tr>
                        <th class="id" style="color:#262b47;">Id</th>
                        <!-- <th class="nombre" style="color:#262b47;">Nombre Usuario</th> -->
                        <th class="titulo" style="color:#262b47;">Titulo</th>
                       <!--  <th class="contenido" style="color:#262b47;">Contenido</th> -->
                        <th class="fecha_crea" style="color:#262b47;">Fecha de creacion</th>
                        <!-- <th style="color:#262b47;">Imagen</th> -->
                        <th style="color:#262b47;">Acciones</th>
                    </tr>
                </thead>
                    <?php 

                        //aquí mandamos a llamar a getpost
                        //y le pasamos como parámetro el ID 
                        //del usuario antes Guardado, nos trae los datos
                        //y lo guardamos en la variable post
                        $posts=getpostAdmin($id_usuario);

                        //aquí ya se imprimirá una tabla con todos los post 
                        //existentes
                        $limite = count($posts);
                        for ($i=0; $i < $limite; $i++) { 
                            echo '<tr>';
                            echo '<td class="id" style="color:#554dde;">'.$posts[$i]['id'].'</td>';
                            /* echo '<td class="nombre" style="color:#554dde;">'.$posts[$i]['nombre']." ".$posts[$i]['apellido'].'</td>'; */
                            echo '<td class="titulo" style="color:#554dde;">'.$posts[$i]['titulo'].'</td>';
                           /*  echo '<td class="contenido" style="color:#554dde;">'.$posts[$i]['contenido'].'</td>'; */
                            echo '<td class="fecha_crea" style="color:#554dde;">'.$posts[$i]['fecha_crea'].'</td>';
                          /*   echo '<td style="color:#554dde;">'.$posts[$i]['imagen'].'</td>'; */
                            echo '<td >
							<div class="dropdown">
							<button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background:#554dde;">Menu</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
							echo '<li><a class="dropdown-item" href="modificarPost.php?id='.$posts[$i]['id'].'"><i class="fas fa-edit me-1"></i> Editar</a></li>';
							echo '<li><a class="dropdown-item" href="guardarPost.php?delete&id='.$posts[$i]['id'].'" onclick="return confirm(\'Esta seguro de borrar los datos '.$posts[$i]['nombre'].'?\')"><i class="fas fa-trash-alt me-1"></i> Borrar</a></li>';
							echo '</ul>';
							echo '</div>';
							echo '</td>';
                            echo '</tr>';
                        }
                    
                    ?>
            </table>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script> 
//lo siguiente es para darle
//formato al data table 
//para que todo este en español
//en la siguiente función lo cambiamos
$(document).ready( function (){
    $('#posts').DataTable({
		"responsive": true,
		"paging": true,
		"language":{
			"leghntMenu": "mostrar _MENU_ por pagina",
			"zeroRecords":"no se encontro ningun registro que coincida",
			"info": "Mostrando _TOTAL_ de _MAX_ registros",
			"search": "Buscar",
			"searchPlaceholder": "Posts",
			"infoFiltered": "(de un total de _MAX_ registros)",
			"paginate":{
				"previous": "Anterior",
				"next": "Siguiente"
			}
		}
	})

        function ocultarCols(){ //Aqui es para hacer responsive la tabla, si la pantalla se hace pequeña se van quitando celdas para que no se salga
            if (screen.width < 400){ //la logica es que si  llega a un tamaño mas pequeño se ocultan celdas, si llega a uno mas grande se muestran
                $(".id").hide()     
                /* $(".nombre").hide() */
                $(".fecha_crea").hide()
            }
            if (screen.width >= 400 && screen.width < 600){
                $(".id").show()
                /* $(".nombre").hide() */
                $(".fecha_crea").hide()
            }
            if (screen.width >= 600 && screen.width < 760){
                $(".id").show()
                /* $(".nombre").hide() */
                $(".fecha_crea").show()
            }
            if(screen.width >= 768){
                $(".id").show()
                /* $(".nombre").show() */
                $(".fecha_crea").show()
            }
        }

        ocultarCols()

        $(window).resize(function() {
            ocultarCols()
        }) 
    })
</script>

</body>
</html>
