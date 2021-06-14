<?php
$nombre = $_SESSION['nombre']." ".$_SESSION['apellido'];
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background:#554dde;height: 8vh;">
    <div class="container-fluid">
        <a class="navbar-brand epimeteo" href="index.php">Epimeteo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#"><i class="fas fa-users me-2"></i>Nosotros</a>
                    <li class="nav-item">
                    <a class="nav-link active" href="crearBlog.php?"><i class="me-2"></i>Crear blog</a>
                    </li>
                </li>
            </ul>

            <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle mx-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $nombre;?> </button>
                
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item" href="#"><i class="fas fa-cog"></i> Configuracion</a></li>
            <li><a class="dropdown-item" href="usuarios.php?cerrar"><i class="fas fa-sign-out-alt"></i> Cerrar sesion</a></li>
            </ul>
            </div>

        </div>
    </div>
</nav>