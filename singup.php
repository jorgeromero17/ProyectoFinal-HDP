<?php 

include("head.php");

function getUsuarios(){
    require_once 'database/conexion.php';
    $con = getconfig();

    try {
        $query = "SELECT * FROM usuarios";

        $statement = $con->prepare($query);
        $statement->execute();
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        
        return $res;

    } catch (Exception $error) {
        print "Error!:".$a->getMessage()."<br>";
        die();
    }
}

?>

<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <form onsubmit="return validarUsuario()"; action="usuarios.php?setUsuario" method="post" class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                <div class="mb-3 d-flex justify-content-center">
                    <labl class="h3" style="color:#554dde;">Registrate</label>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Nombre</label>
                    <input type="firstName" class="form-control" id="nombre" name="nombre"style="border:1px solid #554dde;" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Apellido</label>
                    <input type="lastName" class="form-control" id="apellido" name="apellido"style="border:1px solid #554dde;" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Nombre de Usuario</label>
                    <input type="username" class="form-control" id="username" name="usuario" style="border:1px solid #554dde;" required>
                    <div id="info-usuario" class="form-text"></div>
                
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Coreo electronico</label>
                    <input type="email" class="form-control" id="email" name="email" style="border:1px solid #554dde;" required>
                    <div id="info-email" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="contra" style="border:1px solid #554dde;" required>
                    <div id="info-contra" class="form-text" style="color:#262b47;">La contraseña deben tener 8 caracteres como mínimo, no deben contener espacios y deben incluir al menos un símbolo (+*.?)</div>
                </div>
                <div class="d-grid gap-2 ">
                    <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">Registrar</button>
                </div>
            </form>    
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script>

        function validarContra(){ //devuelve false si la contrasena no esta validada

            let contra = $('#password').val()
            let  info = $('#info-contra')
            /* console.log(contra) */
            
            if(contra.length < 8){
                console.log('contra menor a 8')
                info.attr("style","color:#FF4D4D");
                info.text('La contraseña deben tener 8 caracteres como mínimo')
                return false
            }
            else{
                let espacios = false
                let signos = false

                for (let i = 0; i < contra.length; i++) {
                    if(contra.charAt(i) == " "){
                        espacios = true
                    }
                    if((contra.charCodeAt(i) >= 33 && contra.charCodeAt(i) <= 47) || (contra.charCodeAt(i) >= 58 && contra.charCodeAt(i) <= 64) || (contra.charCodeAt(i) >= 91 && contra.charCodeAt(i) <= 96)){
                        signos = true
                    }
                }

                if (espacios) {
                    console.log('con espacio')
                    info.attr("style","color:#FF4D4D");
                    info.text('La contraseña no debe contener espacios')
                    return false
                }
                else{
                    if(signos){
                        console.log('con signo')
                        return true
                    }
                    else{
                        console.log('sin signo')
                        info.attr("style","color:#FF4D4D");
                        info.text('La contraseña debe contener signos')
                        return false
                    }
                }
            }
        } 

        function validarNombreUsuario(json){ //devuelve false para que el usuario se cambie

            let usuarioExiste = false
            let user = $('#username').val()
            let  info = $('#info-usuario')

            json.forEach(usuario => {
                if(user == usuario['usuario']){
                    usuarioExiste = true
                }
            })

            if(usuarioExiste){
                info.attr("style","color:#FF4D4D");
                info.text("Nombre de usuario existente, intente con otro")
                return false
            }
            else{
                info.text(" ")
                return true
            }

        }

        function validarEmail(json){ //devuelve false para que el email se cambie

            let emailExiste = false
            let email = $('#email').val()
            let  info = $('#info-email')

            json.forEach(usuario => {
                if(email == usuario['email']){
                    emailExiste = true
                }
            })

            if(emailExiste){
                info.attr("style","color:#FF4D4D");
                info.text("El correo electronico esta en uso, intente con otro")
                return false
            }
            else{
                info.text(" ")
                return true
            }

        }

        function validarUsuario(){ 
            
            let contra = validarContra()
            let usuario = validarNombreUsuario(<?php echo json_encode(getUsuarios());?>) 
            let email = validarEmail(<?php echo json_encode(getUsuarios());?>)

            console.log(contra,usuario,email)
            if(contra && usuario && email){
                return true
            }
            else {
                return false
            }
        }

    </script>
</body>

</html>