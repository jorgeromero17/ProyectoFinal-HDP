<?php include("head.php");

if(isset($_SESSION['id'])){
    header("Location: articulos.php");
}

function getError(){
    if(isset($_GET) && isset($_GET["status"])){
        return '<div id="info-email" class="form-text mt-2" style="color:#FF4D4D;">Usuario y/o contraseña incorrectas</div>';
    }
}

?>
<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <form action="usuarios.php?acceder" method="post" class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                <div class="mb-3 d-flex justify-content-center">
                    <labl class="h3" style="color:#554dde;">Iniciar Sesión</label>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="color:#554dde; font-weight:600;">Nombre de Usuario</label>
                    <input type="username" class="form-control" id="username" name="usuario" style="border:1px solid #554dde;">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label" style="color:#554dde; font-weight:600;">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="contra" style="border:1px solid #554dde;">
                </div>
                <div class="d-grid gap-2 ">
                    <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">Acceder</button>
                    <?php echo getError();?>
                </div>
            </form>    
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
