<?php 

include("filtroAdmin.php");

if($tipo == "Admin"){
    header('Location: contentAdmin.php');
}

// if(!isset($name)){
//     header('Location: filtro.php');
// } 

//echo $name;

// include("db.php");

?>

<?php include("includes/header.php")?>

<div class="container" style="width:65%">
    <h1 style="margin: 75px 0px 25px 0px;">Nuestros productos:</h1>
    <hr class="my-4">
    <div class="row">
    <?php
        // session_unset();
        $query = "SELECT * FROM PRODUCTO";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
            ?>
                <div class="col-md-4 col-sm">
                    <form method="post" action="cart.php">
                        <div class="product" style="margin-bottom:25px;">
                            <img style="margin:10px 0px;" src="img/<?php echo $row["Imagen"]; ?>" class="img img-responsive">
                            <h5 class="text" style="color:black; margin-bottom:10px;"><?php echo $row["Nombre_producto"];?></h5>
                            <h5 class="text-primary" style="color:blue; font-size:40px; margin-bottom:20px;">$<?php echo $row["Precio"];?></h5>
                            <h6 style="color:grey; float:left;" >Cantidad:</h6>
                            <input type="text" name="quantity" class="form-control" value="1">
                            <input type="hidden" name="hidden_ssn" value="<?php echo $row["Ssn"];?>">
                            <input type="hidden" name="hidden_name_product" value="<?php echo $row["Nombre_producto"];?>">
                            <input type="hidden" name="hidden_price" value="<?php echo $row["Precio"];?>">
                            <input type="submit" name="add" style="margin-top:10px; background-color:#153e6b; border-color:#153e6b" class="botonH btn btn-primary btn-block" value="Agregar al carrito">
                        </div>
                    </form>
                </div> 
            <?php   
            }
        }      
    ?>
    </div>

    <hr class="my-4">
    <h2 style="margin: 20px 0px 20px 0px;">Tu carrito, <?php echo $name;?>:</h3>
    <!-- <hr class="my-4" > -->

    <div class="col-md-14" style="margin: 20px 0px 40px 0px;">
        <table class = "table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio del producto</th>
                    <th>Subtotal</th>
                    <th>Borrar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM CARRITOS WHERE Usuario='$name' AND Status='No Pagado'";
                $result_cart = mysqli_query($conn, $query);
                $total = 0;
                while($row = mysqli_fetch_array($result_cart)){ ?>
                    <tr>
                        <td><?php echo $row['Nombre_producto']?></td>
                        <td><?php echo $row['Cantidad']?></td>
                        <td>$<?php echo $row['Precio']?></td>
                        <td>$<?php echo $row['Subtotal']?></td>
                        <td>
                            <a class="btn btn-danger" href="includes/delete.php?No_carrito=<?php echo $row['No_carrito']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                     </tr>
                     <?php 
                     $total = $total + $row['Subtotal'];
                }
                     ?>
                     <tr>
                         <td colspan="3">Total</td>
                         <th>$ <?php echo $total;?></th>
                         <td>
                            <form action="pago.php">
                                <input type="submit" name="add-pago" class="btn btn-success" style="margin: 0px 0px; padding: 5px 40px;" value="Pagar" />
                            </form>
                         </td>
                     </tr>
            </tbody>
        </table>

    </div>



<?php include("includes/footer.php")?>