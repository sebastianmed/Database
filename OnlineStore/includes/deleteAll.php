<?php 

session_start(); 

include("../db.php");

if(isset($_GET['No_carrito'])){
    $no_carrito = $_GET['No_carrito'];
    $query = "DELETE FROM CARRITOS";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die(mysqli_error($conn));
    }

    header("Location: ../content.php");
}

?>