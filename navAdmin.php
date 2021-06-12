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
                        <li><a class="dropdown-item" href="#"><i class="fas fa-newspaper me-2"></i>Publicaciones</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-comments me-2"></i>Comentarios</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="d-flex navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="usuarios.php?cerrar"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>