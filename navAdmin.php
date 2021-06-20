<?php
$nombre = $_SESSION['nombre']." ".$_SESSION['apellido'];
?>
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#554dde;">
    <div class="container-fluid">
        <a class="navbar-brand epimeteo" href="articulos.php">Epimeteo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-tools"></i> Administrar
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="adminUsuarios.php?getUsuarios"><i class="fas fa-users me-2"></i>Usuarios</a></li>
                        <li><a class="dropdown-item" href="adminPost.php"><i class="fas fa-newspaper me-2"></i>Mis Publicaciones</a></li>
                        <!-- <li><a class="dropdown-item" href="adminPostUser.php"><i class="fas fa-newspaper me-2"></i>Publicaciones otros</a></li> -->
                        <li><a class="dropdown-item" href="comentariosNuevos.php"><i class="fas fa-comments me-2"></i>Comentarios Nuevos</a></li>
                        <li><a class="dropdown-item" href="comentariosRechazados.php"><i class="fas fa-comments me-2"></i>Comentarios Rechazados</a></li>
                        <li class="nav-item">
                    <!-- <a class="nav-link active" href="crearBlog.php?"><i class="me-2"></i>Crear blog</a> -->
                    </li>
                    </ul>
                </li>
            </ul>
            
            <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle mx-2" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $nombre;?> </button>
                
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <!-- <li><a class="dropdown-item" href="modificarUsuario.php?formModificar&id=<?php /* echo $_SESSION['id']; */ ?>"><i class="fas fa-user-edit me-2"></i>Editar Perfil</a></li>
            <li><a class="dropdown-item" href="modificarContra.php"><i class="fas fa-key me-2"></i>Editar Contraseña</a></li> -->
            <li><a class="dropdown-item" href="usuarios.php?cerrar"><i class="fas fa-sign-out-alt me-2"></i> Cerrar sesion</a></li>
            </ul>
            </div>

        </div>
    </div>
</nav>