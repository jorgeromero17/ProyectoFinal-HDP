<?php 

include_once("head.php");
include_once("usuarios.php");

?>

<body>
    <div class="container mt-5">
        <div class="mb-3 d-flex justify-content-center">
            <a href="agregarUsuarios.php" class="btn my-3" style="background:#554dde; color:white;">Agregar Usuario</a>
        </div>
        <div class="p-3"  style="border:1px solid #554dde; border-radius:10px;">
            <table class="table table-hover" id="usuarios" style="border:none;">	
                <thead>
                    <tr>
                        <th class="id" style="color:#262b47;">Id</th>
                        <th class="nombre" style="color:#262b47;">Nombre</th>
                        <th class="apellido" style="color:#262b47;">Apellido</th>
                        <th class="email" style="color:#262b47;">Email</th>
                        <th style="color:#262b47;">Usuario</th>
                        <th style="color:#262b47;">Acciones</th>
                    </tr>
                </thead>
                    <?php 
                        $limite = count($usuarios);
                        for ($i=0; $i < $limite; $i++) { 
                            echo '<tr>';
                            echo '<td class="id" style="color:#554dde;">'.$usuarios[$i]['id'].'</td>';
                            echo '<td class="nombre" style="color:#554dde;">'.$usuarios[$i]['nombre'].'</td>';
                            echo '<td class="apellido" style="color:#554dde;">'.$usuarios[$i]['apellido'].'</td>';
                            echo '<td class="email" style="color:#554dde;">'.$usuarios[$i]['email'].'</td>';
                            echo '<td style="color:#554dde;">'.$usuarios[$i]['usuario'].'</td>';
                            echo '<td >
							<div class="dropdown">
							<button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background:#554dde;">Menu</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">';
							echo '<li><a class="dropdown-item" href="modificarUsuario.php?formModificar&id='.$usuarios[$i]['id'].'"><i class="fas fa-edit me-1"></i> Editar</a></li>';
							echo '<li><a class="dropdown-item" href="usuarios.php?aksi=delete&id='.$usuarios[$i]['id'].'" onclick="return confirm(\'Esta seguro de borrar los datos de '.$usuarios[$i]['nombre'].'?\')"><i class="fas fa-trash-alt me-1"></i> Borrar</a></li>';
							echo '<li><a class="dropdown-item" href="usuarios.php?aksi=silence&id='.$usuarios[$i]['id'].'" onclick="return confirm(\'Esta seguro de silenciar a '.$usuarios[$i]['nombre'].'?\')"><i class="fas fa-comment-slash me-1"></i>Silenciar</a></li>';
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
$(document).ready( function (){
    $('#usuarios').DataTable({
		"responsive": true,
		"paging": true,
		"language":{
			"leghntMenu": "mostrar _MENU_ por pagina",
			"zeroRecords":"no se encontro ningun registro que coincida",
			"info": "Mostrando _TOTAL_ de _MAX_ registros",
			"search": "Buscar",
			"searchPlaceholder": "Usuarios",
			"infoFiltered": "(de un total de _MAX_ registros)",
			"paginate":{
				"previous": "Anterior",
				"next": "Siguiente"
			}
		}
	});

        function ocultarCols(){
            if (screen.width < 575){
                $(".id").hide()
                $(".apellido").hide()
                $(".email").hide()
                $(".nombre").hide()
            }
            if (screen.width >= 575 && screen.width < 768){
                $(".id").show()
                $(".nombre").hide()
                $(".apellido").hide()
                $(".email").hide()
            }
            if(screen.width >= 768){
                $(".id").show()
                $(".nombre").show()
                $(".apellido").show()
                $(".email").show();
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