<script>

        function validarContra(){ //devuelve false si la contrasena no esta validada

            if ( $("#password").length ) {

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
            else {
                return true
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