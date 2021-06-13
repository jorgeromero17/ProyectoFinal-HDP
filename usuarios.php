<?php

function setUsuario(){
    require_once 'database/conexion.php';
    $con = getconfig();

        if(!isset($_POST['tipo'])){
            $_POST['tipo'] = 0;
        }

        try {
            $query = "INSERT INTO usuarios(nombre,apellido,email,usuario,contra,tipo) VALUES(:nombre,:apellido,:email,:usuario,:contra,:tipo)";
    
            $statement = $con->prepare($query);
    
            $statement->execute([
                ':nombre'=>$_POST["nombre"],
                ':apellido'=>$_POST["apellido"],
                ':email'=>$_POST["email"],
                ':usuario'=>$_POST["usuario"],
                ':contra'=> password_hash($_POST["contra"],PASSWORD_DEFAULT),
                ':tipo'=>$_POST["tipo"]
            ]);
           
            $statement->closeCursor();
            $con = null;
            
            if($_GET['from']=='a'){
                header('Location: adminUsuarios.php?getUsuarios');
            }else{
                header('Location: login.php');
            }
            
    
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
        $statement->execute();
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

function iniciarSesion(){
    echo "entre";
    require_once 'database/conexion.php';
    $con = getconfig();

    $usuario = $_POST["usuario"];
    $contra = $_POST["contra"];
    
    $query = "SELECT * FROM usuarios WHERE usuario= :usuario";
    $statement = $con->prepare($query);

    $statement->execute([
        ':usuario' => $usuario
    ]);

    $res = $statement->fetch(PDO::FETCH_ASSOC);
    var_dump($res);
    if(password_verify($contra,$res['contra'])){

        $query = "SELECT * FROM usuarios WHERE usuario= :usuario";
        $statement = $con->prepare($query);

        $statement->execute([
            ':usuario' => $usuario
        ]);

        $loginRow = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($loginRow != false){

            session_start();
            setcookie('session_id','token123dhhs25665%#7y', time()+3600,'/');

            $_SESSION['id']= $loginRow['id'];
            $_SESSION['nombre']= $loginRow['nombre'];
            $_SESSION['apellido']= $loginRow['apellido'];
            $_SESSION['usuario']= $loginRow['usuario'];
            $_SESSION['tipo']= $loginRow['tipo'];

            $statement->closeCursor();
            $statement = null;

            header('Location: articulos.php');
        }
        else{

            $statement->closeCursor();
            $statement = null;
           header('Location: login.php?status=error');
        }
        
    }
    else{

        $statement->closeCursor();
        $statement = null;
        header('Location: login.php?status=error');
    }
}


function CerrarSesion(){

    session_start();
    session_destroy();
    setcookie('session_id','null', -1,'/');

    header('Location: index.php');

}

if(isset($_GET) && isset($_GET["setUsuario"])){
    setUsuario();
}

if(isset($_GET) && isset($_GET["getUsuarios"])){
    $usuarios = getUsuarios();
}

if(isset($_GET) && isset($_GET["acceder"])){
    iniciarSesion();
}

if(isset($_GET) && isset($_GET["cerrar"])){
    CerrarSesion();
}
