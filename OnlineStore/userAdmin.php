<?php

include("filtroAdmin.php");

if($tipo == "Cliente"){
    header('Location: content.php');
}

// --------------------------------------------
// AGREGAR USUARIOS
// --------------------------------------------

if(isset($_POST['add-user'])){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    $tipo = $_POST['tipo'];

    $message = '';

    $query_user = "SELECT * FROM USUARIO WHERE Usuario='$usuario'";
    $result_user = mysqli_query($conn, $query_user);

    // VERIFICACIÓN DE QUE EL NOMBRE DE USUARIO NO EXISTA
    if (mysqli_num_rows($result_user) > 0) {
        echo '<h2>Usuario existente</h2>';
        $message = '1';
    }

    // VERIFICACIÓN QUE AMBOS CAMPOS DE LAS CONTRASEÑAS SEAN IGUALES
    if($contrasena != $confirmar_contrasena){
        echo '<h2>Las contraseñas no coinciden</h2>';
        $message = '1';
    } 

    // ENCRIPTACIÓN DE LA CONTRASEÑA
    $contrasena = hash('sha512', $contrasena);
    
    //INSERTAR EN LA BASE DE DATOS
    if($message == ''){
        $queryI = "INSERT INTO USUARIO(Usuario, Contrasena, Tipo) VALUES ('$usuario', '$contrasena', '$tipo')";
        $resultI = mysqli_query($conn, $queryI);
        if(!$resultI){
            die(mysqli_error($conn));
        } 
    }

    header('Location: filtro.php');

}

// --------------------------------------------
// BORRAR USUARIOS -->
// --------------------------------------------

if(isset($_GET['Usuario'])){
    $user = $_GET['Usuario'];
    $status = "Desactivado";
    $query_del = "UPDATE USUARIO SET Status='$status' WHERE Usuario='$user'";
    $result_del = mysqli_query($conn, $query_del);
    if(!$result_del){
        die(mysqli_error($conn));
    }
    header("Location: filtro.php");
}

if(isset($_GET['Nombre'])){
    $user = $_GET['Nombre'];
    $status = "Activado";
    $query_del = "UPDATE USUARIO SET Status='$status' WHERE Usuario='$user'";
    $result_del = mysqli_query($conn, $query_del);
    if(!$result_del){
        die(mysqli_error($conn));
    }
    header("Location: filtro.php");
}

// --------------------------------------------
// EDITAR USUARIOS -->
// --------------------------------------------

if(isset($_POST['edit-user'])){
    $tipo = $_POST['tipo'];
    $name = $_POST['name'];
    $query_up = "UPDATE USUARIO SET Tipo='$tipo' WHERE Usuario='$name'";
    $result_up = mysqli_query($conn, $query_up);
    if(!$result_up){
        die(mysqli_error($conn));
    }
    header("Location: filtro.php");
}


?>