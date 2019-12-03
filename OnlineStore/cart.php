<?php 

session_start(); 

$user = $_SESSION['name'];

if(!isset($name)){
    header('Location: filtro.php');
}

include("db.php");

if(isset($_POST['add'])){
    $product = $_POST['hidden_name_product'];
    $ssn = $_POST['hidden_ssn'];
    $price = $_POST['hidden_price'];
    $quantity = $_POST['quantity'];
    $subtotal = $quantity * $price;
    $status = "No pagado";

    $query1 = "SELECT * FROM PRODUCTO WHERE Nombre_producto='$product' AND Ssn='$ssn'";
    $result1 = mysqli_query($conn, $query1);
    while($row = mysqli_fetch_array($result1)){
        $inv = $row['Cantidad_inv'] - $quantity;
        if($inv < 0){
            $_SESSION['message'] = "Inventario lleno por " . ($inv*-1) . " productos";
            $_SESSION['message_type'] = 'danger';
        } else {
            $query_ver = "SELECT * FROM CARRITOS WHERE Nombre_producto='$product' AND Usuario='$user' AND Usuario='$status'";
            $result_ver = mysqli_query($conn,$query_ver);
            if(mysqli_num_rows($result_ver) > 0 ){
                $query_up = "UPDATE CARRITOS SET Cantidad=$quantity, Subtotal='$subtotal' WHERE Nombre_producto='$product'";
                $result_up = mysqli_query($conn, $query_up);
                if(!$result_up){
                    die(mysqli_error($conn));
                }
            } else {
                $query = "INSERT INTO CARRITOS(Ssn, Usuario, Nombre_producto, Cantidad, Precio, Subtotal, Status) VALUES ('$ssn', '$user', '$product', '$quantity', '$price', '$subtotal', '$status')";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    die(mysqli_error($conn));
                }
                header("Location: filtro.php");
            }
        } // end else
    }


    
    
}

?>