<?php 

session_start();

if(isset($_SESSION['name'])){
    header('Location: filtro.php');
}

include("db.php");

if(isset($_POST['login'])){

    //session_start();

    $usuario = $_POST['name'];
    $contrasena = $_POST['password'];
    $contrasena = hash('sha512', $contrasena);
    $status = "Activado";

    $query = "SELECT * FROM USUARIO WHERE Usuario='$usuario' AND Contrasena='$contrasena' AND Status='$status'";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0 ){

        $_SESSION['name'] = $usuario;

        while($row = mysqli_fetch_array($result)){
            $tipo = $row['Tipo'];

            if($tipo == "Cliente"){
                header('Location: filtro.php');
            } else {
                header('Location: filtro.php');
            }

        }

        // $query = "SELECT * FROM USUARIO WHERE Contrasena='$contrasena'";
        // $result = mysqli_query($conn,$query);

        // if(mysqli_num_rows($result) > 0 ){
        //     $_SESSION['name'] = $usuario;
        //     //echo $_SESSION['name'];
        //     header('Location: filtro.php');
        // } else {
        //     $_SESSION['message'] = "Contraseña Incorrecta";
        //     $_SESSION['message_type'] = 'danger';
        // }
    } else {
        function_alert("Es posible que tu usuario o contraseña esten incorrectas o estas desactivado");
        //echo '<h6 class="alert">Es posible que tu usuario o contraseña esten incorrectas o estas desactivado</h6>';
        session_unset();
        session_destroy();
        //header('Location: index.php');
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
    <script src="https://kit.fontawesome.com/49eccc384e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/login.css"/>
    <title>Login</title>
</head>
<body class="body-login">
 
    
    <form class="form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h1 class="login">Inicia Sesión</h1>
        <input type="text" name="name" placeholder="Ingresa tu usuario" required="">
        <input type="password" name="password" placeholder="Ingresa tu contraseña" required="">
        <input class="btn" name="login" type="submit" value="Send"> <br>
        <span><a href="register.php">¿No tienes cuenta?</a></span> <br><br>
        <div class="alerta" style="margin:auto;">
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