<?php 

include_once("head.php");
include_once("usuarios.php");
?>
<body>
    <div class="container mt-5">

        <table class="table table-striped table-hover" id="usuarios">	
            <thead>
                <th>No</th>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </thead>
            
                <?php 
                    $limite = count($usuarios);
                    for ($i=0; $i < $limite; $i++) { 
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$usuarios[$i]['id'].'</td>';
                        echo '<td>'.$usuarios[$i]['nombre'].'</td>';
                        echo '<td>'.$usuarios[$i]['apellido'].'</td>';
                        echo '<td>'.$usuarios[$i]['email'].'</td>';
                        echo '<td>'.$usuarios[$i]['usuario'].'</td>';
                        echo '<td></td>';
                        echo '</tr>';
                    }
                
                ?>
            
        </table>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script> 
$(document).ready( function () {
    $('#usuarios').DataTable({
		"responsive": true,
		"paging": true,
		"language":{
			"leghntMenu": "mostrar _MENU_ por pagina",
			"zeroRecords":"no se encontro ningun registro que coincida",
			"info": "mostrando _TOTAL_ de _MAX_ registros",
			"search": "Buscar",
			"searchPlaceholder": "Usuarios",
			"infoFiltered": "(de un total de _MAX_ registros)",
			"paginate":{
				"previous": "Anterior",
				"next": "Siguiente"
			}
		}
	});

} );
</script>

</body>
</html>