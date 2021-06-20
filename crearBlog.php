<?php //formulario que permite crear publicaciones
include("head.php");
include("guardarPost.php");
include_once("sesionAdmin.php");

$id_usuario= $_SESSION['id'];
$nombre=$_SESSION['nombre']." ".$_SESSION['apellido'];
?>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <form action="guardarPost.php" method="post" enctype="multipart/form-data"  class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                <div class="mb-1 d-flex justify-content-center">
                    <label class="h3" style="color:#554dde;">Crear Post</label>
                    <input type="hidden" name='id_usuario' id='id_usuario' value='<?php echo $id_usuario;?>' />
                </div>
                <div class="mb-3 d-flex justify-content-center">
                    <label class="h6" style="color:#554dde;"><?php echo $nombre;?></label>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Titulo</label>
                    <textarea class="form-control" id="titulo" name="titulo" style="border:1px solid #554dde;" required></textarea>

                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;word-break: break-all;">Contenido</label>
                    <textarea class="form-control" id="Contenido" name="contenido" style="border:1px solid #554dde;height:300px;" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label" style="color:#554dde; font-weight:600;">Imagen de Portada</label>
                    <input class="form-control" type="file" id="imagen" name="imagen" style="border:1px solid #554dde;" >
                    <div class="d-grid gap-2 ">
                    <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">publicar</button>
                </div>

                </div>

            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>


</body>

</html>