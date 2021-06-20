<?php
//aqui encontramos toda la logica que tiene que ver con el usuario 

function setUsuario(){ //set usuario hace una consulta a la base de datos para agregar un usuario
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

function getUsuario(){ //esta funcion devuelve un usuario que coincida con el id que trae el get
    require_once 'database/conexion.php';
    $con = getconfig();
    
    if( isset($_GET["id"])){
        $id = $_GET["id"];
    }

    try {
        $query = "SELECT * FROM usuarios WHERE id =:id";

        $statement = $con->prepare($query);
        $statement->execute([
            ':id'=>$id
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


function getUsuarios(){ //esta funcion trae todos los datos, de todos los usuarios existentes, devuelve un array asocciativo
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

function modificarUsuario(){ //esta funcion modifica los datos del usuario que coincida con el id que trae post 
    require_once 'database/conexion.php'; 
    $con = getconfig();

    if(!isset($_POST['tipo'])){
        $_POST['tipo'] = 0;
    }
    

    try {
        $query = "UPDATE usuarios SET nombre=:nombre,apellido=:apellido,email=:email,usuario=:usuario,tipo=:tipo WHERE id=:id";

        $statement = $con->prepare($query);

        $statement->execute([
            ':nombre'=>$_POST["nombre"],
            ':apellido'=>$_POST["apellido"],
            ':usuario'=>$_POST["usuario"],
            ':email'=>$_POST["email"],
            ':tipo'=>$_POST["tipo"],
            ':id'=> $_POST["id"]
        ]);
       
        $statement->closeCursor();
        $con = null;
        
        if($_POST['tipoModificando'] == 1){ //aqui si es usuario de tipo admin devuelve a un lado, si no devuelve a otro
            header('Location: adminUsuarios.php?getUsuarios');
        }
        else{
            header('Location: modificarUsuario.php?formModificar&id='.$_POST["id"]."&status=ok");
        }   

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }

}
function modificarContra(){ //esta funcion modifica la contraseña del usuario

    require_once 'database/conexion.php';
    $con = getconfig();

    $usuario = getUsuario();
    $id = $usuario[0]['id'];
    $contra = $usuario[0]['contra'];
    $contraActual = $_POST['contraActual'];

    if(password_verify($contraActual,$contra)){
        try {
            $query = "UPDATE usuarios SET contra=:contra WHERE id=:id";
    
            $statement = $con->prepare($query);
    
            $statement->execute([
                ':contra'=>password_hash($_POST["contra"],PASSWORD_DEFAULT),
                ':id'=> $id
            ]);
           
            $statement->closeCursor();
            $con = null;
            
           header('Location: modificarContra.php?status=ok&id='.$id);
    
        } catch (Exception $error) {
            print "Error!:".$error->getMessage()."<br>";
            die();
        }     
    }
    else {
        header('Location: modificarContra.php?status=error&id='.$id);
    }

}

function silenciarUsuario(){ //esta sirve para silenciar o desilenciar el usuario. si el get trae silence se silencia, si no,
                             //trae disilence, entonces se desilencia                       
    require_once 'database/conexion.php';
    $con = getconfig();
    
    if( isset($_GET["id"])){
        $id = $_GET["id"];
    }
    if( $_GET["aksi"] == 'silence'){
        $silence = 1;
    }
    else {
        $silence = 0;
    }

    var_dump($silence);
    try {
        $query = "UPDATE usuarios SET inactivar_coment=:silence WHERE id=:id";

        $statement = $con->prepare($query);

        $statement->execute([
            ':silence' => $silence,
            ':id' => $id
        ]);
       
        $statement->closeCursor();
        $con = null;
        
        header('Location: adminUsuarios.php?getUsuarios');

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }


}



function eliminarUsuario(){ //funcion para eliminar usuario, esta elimina el usuario que venga en el get

    require_once 'database/conexion.php';
    $con = getconfig();
    
    if( isset($_GET["id"])){
        $id = $_GET["id"];
    }

    try {
        $query = "DELETE FROM usuarios WHERE id = :id";

        $statement = $con->prepare($query);

        $statement->execute([
            ':id' => $id
        ]);
       
        $statement->closeCursor();
        $con = null;
        
        header('Location: adminUsuarios.php?getUsuarios');

    } catch (Exception $error) {
        print "Error!:".$error->getMessage()."<br>";
        die();
    }


}


function iniciarSesion(){ //inicia sesion, crea la cookie
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

    $res = $statement->fetch(PDO::FETCH_ASSOC); //se trae el usuario
    var_dump($res);
    if(password_verify($contra,$res['contra'])){ //verifica que la contra del usuario sea la que viene en el post

        $query = "SELECT * FROM usuarios WHERE usuario= :usuario"; //si es asi preparamos la consulta para traer los datos de ste usuario
        $statement = $con->prepare($query);

        $statement->execute([
            ':usuario' => $usuario
        ]);

        $loginRow = $statement->fetch(PDO::FETCH_ASSOC);
        
        if($loginRow != false){ //si viene algo, se inicia sesion, se crea la cookie y se guardan en la super global session, todos los datos necesarios

            session_start();
            setcookie('session_id','token123dhhs25665%#7y', time()+86400,'/'); //la coockie dura un dia

            $_SESSION['id']= $loginRow['id'];
            $_SESSION['nombre']= $loginRow['nombre'];
            $_SESSION['apellido']= $loginRow['apellido'];
            $_SESSION['usuario']= $loginRow['usuario'];
            $_SESSION['tipo']= $loginRow['tipo'];
            $_SESSION['inactivar_coment'] = $loginRow['inactivar_coment'];

            $statement->closeCursor();
            $statement = null;

            header('Location: articulos.php'); //lo llevamos a articulos
        }
        else{

            $statement->closeCursor();
            $statement = null;
           header('Location: login.php?status=error'); //si hay error en algo devuelve en el get error para feedback
        }
        
    }
    else{

        $statement->closeCursor();
        $statement = null;
        header('Location: login.php?status=error'); //si hay error en algo devuelve en el get error para feedback
    }
}


function CerrarSesion(){

    session_start(); //ponemos en null la cookie, destruimos la sesion
    session_destroy();
    setcookie('session_id','null', -1,'/');

    header('Location: index.php'); //mandamos al index

}


//Estas son las condiciones para que se ejecute cada funcion, si se cumplen se ejecutarán

if(isset($_GET) && isset($_GET["setUsuario"])){  //si el get trae seteado setUsuario se ejecuta setUsuario
    setUsuario();
}

if(isset($_GET) && isset($_GET["getUsuarios"])){ //si el get trae seteado setUsuarios se ejecuta getUsuarios
    $usuarios = getUsuarios();
}

if(isset($_GET) && isset($_GET["formModificar"]) && isset($_GET["id"]) ){ //si el get trae seteados id y formModificar se ejecuta getUsuario
    $usuario = getUsuario(); //usuarios es la variable que se utiliza en el form de modificar
}

if(isset($_GET) && isset($_GET["modificar"])){ //si el get trae seteado modificar se ejecuta modificarUsuario
    modificarUsuario();
}

if(isset($_GET) && isset($_GET["modificarContra"])){ //si get trae seteado modificarContra se ejecuta la funcion con el mismo nombre
    modificarContra();
}

if(isset($_GET) && isset($_GET["aksi"]) && $_GET["aksi"]=='silence' || isset($_GET) && isset($_GET["aksi"]) && $_GET["aksi"]=='disilence'){
    silenciarUsuario(); //si la condicion se cumple se ejecuta silenciarUsuario
}


if(isset($_GET) && isset($_GET["aksi"]) && $_GET["aksi"]=='delete'){
    eliminarUsuario(); //si la condicion se cumple se ejecuta eliminarUsuario
}


if(isset($_GET) && isset($_GET["acceder"])){
    iniciarSesion(); //si la condicion se cumple se ejecuta iniciarSesion
}

if(isset($_GET) && isset($_GET["cerrar"])){
    CerrarSesion(); //si la condicion se cumple se ejecuta la funcion que cierra sesion
}