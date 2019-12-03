<?php 

session_start(); 
include("db.php");

$name = $_SESSION['name'];

if(isset($name)){

    $query2 = "SELECT * FROM USUARIO WHERE Usuario='$name'";
    $result2 = mysqli_query($conn,$query2);
    while($row = mysqli_fetch_array($result2)){
        $tipo = $row['Tipo'];

        if($tipo == "Cliente"){
            header('Location: content.php');
        } else {
            header('Location: contentAdmin.php');
        }
    }
} else {
    header('Location: register.php');
}

?>