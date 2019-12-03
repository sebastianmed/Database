<?php

include("filtroAdmin.php");

if($tipo == "Cliente"){
    header('Location: content.php');
}

// --------------------------------------------
// AGREGAR PRODUCTOS -->
// --------------------------------------------

if(isset($_POST['add-product'])){
    $ssn = $_POST['ssn'];
    $product = $_POST['product'];
    $img = $_POST['img'];
    $price = $_POST['precio'];
    $inventario = $_POST['inventario'];
    $description = $_POST['descripcion'];

    $query = "SELECT * FROM PRODUCTO WHERE Ssn='$ssn'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<h2>Producto existente</h2>';
    } else {
        $query_prod = "INSERT INTO PRODUCTO(Ssn, Nombre_producto, Descripcion, Precio, Imagen, Cantidad_inv) VALUES ('$ssn', '$product', '$description', '$price', '$img', '$inventario')";
        $result_prod = mysqli_query($conn, $query_prod);
        if(!$result_prod){
            die(mysqli_error($conn));
        } 
    }

    header('Location: filtro.php');
}

// --------------------------------------------
// BORRAR PRODUCTOS -->
// --------------------------------------------

if(isset($_GET['Ssn'])){
    $ssn = $_GET['Ssn'];
    $query_del = "DELETE FROM PRODUCTO WHERE Ssn=$ssn";
    $result_del = mysqli_query($conn, $query_del);
    if(!$result_del){
        die(mysqli_error($conn));
    }

    header("Location: filtro.php");
}

// --------------------------------------------
// EDITAR PRODUCTOS -->
// --------------------------------------------

?>