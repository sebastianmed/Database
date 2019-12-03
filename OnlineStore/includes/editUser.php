<?php

include("../filtroAdmin.php");

if($tipo == "Cliente"){
    header('Location: ../content.php');
}

if(isset($_GET['Usuario'])) {
    $user = $_GET['Usuario'];
    $query = "SELECT * FROM USUARIO WHERE Usuario=$user";
    $result = mysqli_query($conn, $query);
}
if(isset($_POST['edit-user'])) {
    $user = $_POST['Usuario'];
    $tipo = $_POST['Tipo'];
    $query = "UPDATE USUARIO set Tipo='$tipo' WHERE Usuario='$user'";
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
                <form action="editUser.php?id=<?php echo $_GET['Usuario']; ?>" method="POST">
                    <div class="form-group row">
                        <label class="subsubtitle col-sm-4 col-form-label">Usuario:</label>            
                        <div class="col-sm-8">
                        <input name="Usuario" type="text" class="form-control-plaintext" value="<?php echo $user; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="subsubtitle">Tipo: </label>
                        <input name="Tipo" class="form-control" cols="30" rows="10" required="" ></input>
                    </div>
                    <input style="width: 100%; margin-top:7px;"class="btn btn-success" name="edit-user" type="submit" value="Editar" style="margin: 0px 20px;"> 
                </form>
            </div>
        </div>
    </div>
    </div>

<?php include('footer.php'); ?>