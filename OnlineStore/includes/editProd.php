<?php

include("../filtroAdmin.php");

if($tipo == "Cliente"){
    header('Location: ../content.php');
}

if(isset($_GET['Ssn'])) {
    $ssn = $_GET['Ssn'];
    $query = "SELECT * FROM PRODUCTO WHERE Ssn=$ssn";
    $result = mysqli_query($conn, $query);
}
if(isset($_POST['edit-prod'])) {
    $ssn = $_POST['Ssn'];
    $precio = $_POST['precio'];
    $inventario = $_POST['inventario'];
    $query = "UPDATE PRODUCTO set Precio='$precio', Cantidad_inv='$inventario' WHERE Ssn='$ssn'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die(mysqli_error($conn));
    }
    header('Location: ../filtro.php');
}
?>


<?php include('header.php'); ?>

    <div class="container-edit" style="margin-top: 80px; padding: 10px 30px;">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); border-width: 0px">
                <form action="editProd.php?id=<?php echo $_GET['Ssn']; ?>" method="POST">
                    <div class="form-group row">
                        <label class="subsubtitle col-sm-6 col-form-label">Código de barra:</label>            
                        <div class="col-sm-6">
                            <input name="Ssn" type="text" class="form-control-plaintext" value="<?php echo $ssn; ?>" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="subsubtitle">Precio: </label>
                        <input name="precio" class="form-control" cols="30" rows="10"></input>
                    </div>
                    <div class="form-group">
                        <label class="subsubtitle">Cantidad en el inventario: </label>
                        <input name="inventario" class="form-control" cols="30" rows="10" required=""></input>
                    </div>
                    <input style="width: 100%; margin-top:7px;"class="btn btn-success" name="edit-prod" type="submit" value="Editar" style="margin: 0px 20px;"> 
                </form>
            </div>
        </div>
    </div>
    </div>

<?php include('footer.php'); ?>