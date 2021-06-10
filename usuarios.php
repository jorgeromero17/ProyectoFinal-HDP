<?php

function setUsuario(){
    require_once 'database/conexion.php';
    $con = getconfig();

    /* if(validarUsuario() == 1){
        header('Location: singup.php?status=error1'); 
    }
    elseif(validarUsuario() == 2){
        header('Location: singup.php?status=error2');
    }
    elseif(validarUsuario() == 3){
        header('Location: singup.php?status=error3');
    }
    else{ */
        try {
            $query = "INSERT INTO usuarios(nombre,apellido,email,usuario,contra,tipo) VALUES(:nombre,:apellido,:email,:usuario,:contra,:tipo)";
    
            $statement = $con->prepare($query);
    
            $statement->execute([
                ':nombre'=>$_POST["nombre"],
                ':apellido'=>$_POST["apellido"],
                ':email'=>$_POST["email"],
                ':usuario'=>$_POST["usuario"],
                ':contra'=> password_hash($_POST["contra"],PASSWORD_DEFAULT),
                ':tipo'=>0
            ]);
           
            $statement->closeCursor();
            $con = null;
            
            //header('Location: singup.php?status=ok');
    
        } catch (Exception $error) {
            print "Error!:".$error->getMessage()."<br>";
            die();
        } 
    /* } */

}

function getUsuario(){
    require_once 'database/conexion.php';
    $con = getconfig();
    
    if( isset($_GET["id"])){
        $id = $_GET["id"];
    }

    try {
        $query = "SELECT * FROM usuarios WHERE id =:id";

        $statement = $con->prepare($query);
        $statement->execute([
            ':id'=> $id
        ]);
        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        //cerrar flujo y base de datos
        $statement->closeCursor();
        $con = null;
        //retorna el array asociativo
        return $res;
        
    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}

/* function validarUsuario(){
    require_once 'database/conexion.php';
    $con = getconfig();
    try {
        $query = "SELECT * FROM usuarios WHERE usuario =:usuario";
        $query1 = "SELECT * FROM usuarios WHERE email =:email";

        $statement = $con->prepare($query);
        $statement1 = $con->prepare($query1);

        $statement->execute([
            ':usuario'=>$_POST["usuario"]
        ]);
        $statement1->execute([
            ':email'=>$_POST["email"]
        ]);

        $res = $statement->fetchAll(PDO::FETCH_ASSOC);
        $res1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
        
        $statement->closeCursor();
        $con = null;

        if(count($res)<1 && count($res1)>=1){
            return 1; //email existente
        }
        if(count($res1)<1 && count($res)>=1){
            return 2; //usuario existente
        }
        if(count($res)<1 && count($res1)<1){
            return 3; //email y usuario existente
        }
        else{
            return 0; //todo oko
        }

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }
}
 */

if(isset($_GET) && isset($_GET["setUsuario"])){
    setUsuario();
}
