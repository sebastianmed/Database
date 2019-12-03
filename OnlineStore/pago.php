<?php

include("filtroAdmin.php");

if($tipo == "Admin"){
    header('Location: contentAdmin.php');
}

$status = "No Pagado";

//echo $name;

include("db.php");

$query5 = "SELECT * FROM CARRITOS WHERE USUARIO='$name' AND Status='$status'";
    $result_cart = mysqli_query($conn, $query5);
    $total = 0;
    while($row = mysqli_fetch_array($result_cart)){
        $total = $total + $row['Subtotal'];
        $id =  $row['No_carrito']; 
    }

if(isset($_POST['add-pago'])){
    $pais = $_POST["pais"];
    $ciudad = $_POST["ciudad"];
    $colonia = $_POST["colonia"];
    $calle = $_POST["calle"];
    $no_dpto = $_POST["no_dpto"];
    $no_carrito = $_POST["hidden_no_carrito"];
    $num = 0;

    $query3 = "SELECT * FROM PRODUCTO NATURAL JOIN CARRITOS WHERE Usuario='$name' AND Status='$status'";
    $result3 = mysqli_query($conn, $query3);
    while($row = mysqli_fetch_array($result3)){
        $num = $num + 1;
        $row['Cantidad_inv'] = $row['Cantidad_inv'] - $row['Cantidad'];
        $inv = $row['Cantidad_inv'];
        $product = $row['Nombre_producto'];
        if($inv < 0){
            $foo = 3;
        } else {
            $query4 = "UPDATE PRODUCTO SET Cantidad_inv='$inv' WHERE Nombre_producto='$product'";
            $result4 = mysqli_query($conn, $query4);
            if(!$result4){
                die(mysqli_error($conn));
            }
            $inv = 0;

            if($num == 1){
                $query = "INSERT INTO PAGO(No_carrito, Usuario, Pais, Ciudad, Colonia, Calle, No_dpto, Total) VALUES ('$no_carrito', '$name', '$pais', '$ciudad', '$colonia', '$calle', '$no_dpto', '$total')";
                $result = mysqli_query($conn, $query);
                if(!$result){
                    die(mysqli_error($conn));
                }
            }
        
            $query2 = "UPDATE CARRITOS SET Status='Pagado' WHERE Usuario='$name'";
            $result2 = mysqli_query($conn, $query2);
            if(!$result2){
                die(mysqli_error($conn));
            }
            header("Location: filtro.php");
        }
    } 
    

}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleable=no">
    <!-- <link rel="stylesheet" href="style/main.css"/> -->
    <link rel="stylesheet" href="style/pago.css"/>
    <script src="https://kit.fontawesome.com/49eccc384e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Regístrate</title>
</head>
<body class="cuerpo_login" style="background-color:#0275d8;">   

<h5 class="modal-title" style="text-align: center; margin: 20px 0px; font-size: 50px; color: white;">Finaliza tu compra</h5>




<div class="container">
    <?php 
        $query6 = "SELECT MAX(No_carrito) FROM CARRITOS";
        $result = mysqli_query($conn,$query6);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
    ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="pago.php">
                        <div class="form">
                            <input type="hidden" name="hidden_total" value="<?php echo $total;?>">
                            <input type="hidden" name="hidden_no_carrito" value="<?php echo $id;?>">
                            <h7>País</h7>
                            <input style="margin: 5px 0px 6px 0px;" type="text" name="pais" class="form-control" required="required">
                            <h7>Ciudad</h7>
                            <input style="margin: 5px 0px 6px 0px;" type="text" name="ciudad" class="form-control" required="required">
                            <h7>Colonia</h7>
                            <input style="margin: 5px 0px 6px 0px;" type="text" name="colonia" class="form-control" required="required">
                            <h7>Calle</h7>
                            <input style="margin: 5px 0px 6px 0px;" type="text" name="calle" class="form-control" required="required">
                            <h7>No. interior</h7>
                            <input style="margin: 5px 0px 20px 0px;" type="text" name="no_dpto" class="form-control" required="required">
                            <div class="form-group">
                                <label for="cc_name">Nombre</label>
                                <input type="text" name="name" class="form-control" id="cc_name" pattern="\w+ \w+.*" title="First and last name" required="required">
                            </div>
                        <div class="form-group">
                            <label>Número de la tarjeta</label>
                            <input type="text" class="form-control" autocomplete="off" maxlength="16" pattern="\d{16}" title="Credit card number" required="">
                        </div>
                        <div class="form-group row">
                            <label class="col-md-12">Fecha de expiración</label>
                            <div class="col-md-4">
                                <select class="form-control" name="cc_exp_mo" size="0">
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control" name="cc_exp_yr" size="0">
                                    <option>2019</option>
                                    <option>2020</option>
                                    <option>2021</option>
                                    <option>2022</option>
                                    <option>2023</option>
                                    <option>2024</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" autocomplete="off" maxlength="3" pattern="\d{3}" title="Three digits at back of your card" required="" placeholder="CVC">
                            </div>
                            <input class="btn btn-primary" name="add-pago" type="submit" value="Pagar" style="margin: 0px 20px;"> <br>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php   
            }
        }      
    ?>
</div>


<?php include("includes/footer.php")?>