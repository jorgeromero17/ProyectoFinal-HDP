<?php 
include("head.php");
include_once("sesionUsuario.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>
<body>

    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <form onsubmit="return validarPass()"; action="usuarios.php?modificarContra&id=<?=$id?>" method="post" class="col-11 col-sm-10 col-md-8 col-lg-6 mt-5 p-4" style="border-radius:10px; border:1px solid #554dde; background:white;">
                <div class="mb-3 d-flex justify-content-center">
                    <labl class="h3" style="color:#554dde;">Editar Contraseña</label>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Contraseña Actual</label>
                    <input type="password" class="form-control" id="passwordActual" name="contraActual" style="border:1px solid #554dde;" required >
                    <?php
                        if(isset($_GET['status'])){
                            if($_GET['status']=='error'){
                                echo '<div id="info-contraActual" class="form-text" style="color:#FF4D4D" >La contraseña actual no coincide</div>';
                            }
                        }
                    ?>
                </div>
                <div class="mb-3">
                    <label class="form-label" style="color:#554dde; font-weight:600;">Contraseña Nueva</label>
                    <input type="password" class="form-control" id="password" name="contra" style="border:1px solid #554dde;"required >
                    <div id="info-contra" class="form-text" style="color:#262b47;">La contraseña deben tener 8 caracteres como mínimo, no deben contener espacios y deben incluir al menos un símbolo (+*.?)</div>
                </div>
                <div class="d-grid gap-2 ">
                    <button type="submit" class="btn text-light mt-3" style="background:#554dde;font-weight:600;">Guardar</button>
                </div>
                <?php
                if(isset($_GET['status'])){
                    if($_GET['status']=='ok'){
                        echo '<div id="info-correta" class="form-text mt-2 text-success">La contraseña se modificó satisfactoriamente</div>';
                    }
                }
                ?> 
            </form>   
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script>

    function validarPass(){ //devuelve false si la contrasena no esta validada


        let contra = $('#password').val()//traemos lo que hay en el campo de contra
        let  info = $('#info-contra') //traemos el info para mandar feedback
        
        if(contra.length < 8){ //si lo que esta en contra es menor que 8, tonces se madna feedback de error
            console.log('contra menor a 8')
            info.attr("style","color:#FF4D4D");
            info.text('La contraseña deben tener 8 caracteres como mínimo')
            return false
        }
        else{
            let espacios = false //variables que sirven para validar si hay espacios y signos
            let signos = false

            for (let i = 0; i < contra.length; i++) { //iteramos cada caracter de la contra
                if(contra.charAt(i) == " "){
                    espacios = true //si en la hay espacios se pone en true
                }
                if((contra.charCodeAt(i) >= 33 && contra.charCodeAt(i) <= 47) || (contra.charCodeAt(i) >= 58 && contra.charCodeAt(i) <= 64) || (contra.charCodeAt(i) >= 91 && contra.charCodeAt(i) <= 96)){
                    signos = true //con charCodeAt verificamos el assci de cada caracter y si hay signos se pone en true
                }
            }

            if (espacios) { //si espacios viene true, retorna false, por lo tanto no se va en el post, ademas se manda feedback de error
                console.log('con espacio')
                info.attr("style","color:#FF4D4D");
                info.text('La contraseña no debe contener espacios')
                return false
            }
            else{ //si signos viene true, retorna true, por lo tanto el post se manda
                if(signos){
                    console.log('con signo')
                    return true
                }
                else{ //si espacios viene false, retorna false, por lo tanto no se va en el post, ademas se manda feedback de error
                    console.log('sin signo')
                    info.attr("style","color:#FF4D4D");
                    info.text('La contraseña debe contener signos')
                    return false
                }
            }
        }
 

    }
    
</script>

</body>
</html>