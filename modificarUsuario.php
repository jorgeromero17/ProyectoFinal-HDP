<?php include("head.php");
include_once("usuarios.php");

function imprimirTipo($tipo){
    if($tipo=='1'){
      echo '<option value="0">Usuario</option>
            <option value="1" selected="selected">Administrador</option>';
    }
    else{
      echo '<option value="0" selected="selected" >Usuario</option>
      <option value="1">Administrador</option>';
    }
}

?>
<body>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <form action="usuarios.php?modificar" method="post" class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                <div class="mb-3 d-flex justify-content-center">
                    <labl class="h3" style="color:#554dde;">Editar Usuario</label>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Id de Usuario:</label>
                    <input type="" class="form-control" id="id" name="id"style="border:1px solid #554dde;" readonly <?='value="'.$usuario[0]['id'].'"'?> >
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Nombre</label>
                    <input type="firstName" class="form-control" id="nombre" name="nombre"style="border:1px solid #554dde;" required <?='value="'.$usuario[0]['nombre'].'"'?> >
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Apellido</label>
                    <input type="lastName" class="form-control" id="apellido" name="apellido"style="border:1px solid #554dde;" <?='value="'.$usuario[0]['apellido'].'"'?> required>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Nombre de Usuario</label>
                    <input type="username" class="form-control" id="username" name="usuario" style="border:1px solid #554dde;" <?='value="'.$usuario[0]['usuario'].'"'?> required>
                    <div id="info-usuario" class="form-text"></div>
                
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Coreo electronico</label>
                    <input type="email" class="form-control" id="email" name="email" style="border:1px solid #554dde;" <?='value="'.$usuario[0]['email'].'"'?> required>
                    <div id="info-email" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Tipo de Usuario</label>
                    <select id="tipo" name="tipo" class="form-select form-select-sm" aria-label=".form-select-sm example" style="border:1px solid #554dde; height:40px;" required>
                        <?php imprimirTipo($usuario[0]['tipo']);?>
                    </select>
                </div>
                <div class="d-grid gap-2 ">
                    <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">Guardar</button>
                </div>
            </form>    
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<?php 
//include('validarUsuario.php');
?>
<script>


    let seleccion = $('#tipo').find('option:selected').val()
    console.log(seleccion)

    $("#tipo").change(function(){
        let seleccion = $('#tipo').find('option:selected').val()
        console.log(seleccion)
    })
    
</script>

</body>
</html>