<?php 

session_start();

if(isset($_SESSION['name'])){
    header('Location: content.php');
}

include("db.php");

if(isset($_POST['register'])){
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];
    $confirmarcontrasena = $_POST['confirm_password'];

    $message = '';

    $query = "SELECT * FROM USUARIO WHERE Usuario='$usuario'";
    $result = mysqli_query($conn, $query);

    // VERIFICACIÓN DE QUE EL NOMBRE DE USUARIO NO EXISTA
    if (mysqli_num_rows($result) > 0) {
        function_alert("Nombre de usuario existente");
        $message = '1';
    }

    // VERIFICACIÓN QUE AMBOS CAMPOS DE LAS CONTRASEÑAS SEAN IGUALES
    if($contrasena != $confirmarcontrasena){
        function_alert("Las contraseñas no son iguales");
        $message = '1';
    } 

    // ENCRIPTACIÓN DE LA CONTRASEÑA
    $contrasena = hash('sha512', $contrasena);
    
    //INSERTAR EN LA BASE DE DATOS
    if($message == ''){
        $queryI = "INSERT INTO USUARIO(Usuario, Contrasena) VALUES ('$usuario', '$contrasena')";
        $resultI = mysqli_query($conn, $queryI);
        if(!$resultI){
            die(mysqli_error($conn));
        } 
        header("Location: index.php");
    }

}

function function_alert($message) { 
	echo "<script>alert('$message');</script>"; 
} 


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleable=no">
    <!-- <link rel="stylesheet" href="style/main.css"/> -->
    <link rel="stylesheet" href="style/login.css"/>
    <script src="https://kit.fontawesome.com/49eccc384e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Regístrate</title>
</head>
<body class="body-login">

    <form class="form-re" action="register.php" method="post">
        <h1 class="login">Regístrate</h1>
        <input type="text" name="usuario" placeholder="Ingresa tu usuario" required="">
        <input type="password" name="password" placeholder="Ingresa tu contrasena" required="">
        <input type="password" name="confirm_password" placeholder="Confirma tu contrasena" required="">
        <input class="btn" name="register" type="submit" value="Send"> <br>
        <span><a href="index.php">¿Ya tienes cuenta?</a></span> <br><br>
        <div class="alerta">
            <?php if(isset($_SESSION['message'])) {?>
            <div class="alert alert-<?= $_SESSION['message_type']?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message']?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php session_unset(); }?> 
        </div>
    </form>
    

</body>
</html> 