<?php

include("filtroAdmin.php");

if($tipo == "Cliente"){
    header('Location: content.php');
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scaleable=no">
    <script src="https://kit.fontawesome.com/49eccc384e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style/main.css"/>
    <link rel="stylesheet" href="style/admin.css"/>
    <title>Suprim</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-primary" id="navbar">
        <div class=container>
            <a href="content.php" class="navbar-brand" id="text" style="color:white;">Suprim</a>
            <form class="form-inline my-2 my-lg-0" action="logout.php">
                <button class="btn btn btn-dark type="submit">Logout</button>
            </form>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:-60px;">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#products">Productos <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#usuarios">Usuarios</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#pagos">Pagos</a>
            </li>
            </ul>
        </div>
    </nav>

    <br><br><br><br>

    <!-- ------------------------------------------ -->
    <!-- PRODUCTOS -->
    <!-- ------------------------------------------ -->

    <h1 class="title" id="products">Productos<h1>

    <div class="container-admin">

        <h4 class="subtitle">¿Quiéres agregar uno?<h4>

        <form class="form-admin" method="post" action="productAdmin.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="subsubtitle">Código de barras</label>
                    <input name="ssn" type="text" class="form-control" autocomplete="off" maxlength="6" pattern="\d{6}" title="Código de barras" required="" placeholder="Ssn">
                </div>
                <div class="form-group col-md-6">
                    <label class="subsubtitle" >Nombre del producto</label>
                    <input name="product" type="text" name ="Nombre_producto" class="form-control" placeholder="Producto">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="subsubtitle" >Nombre de la imagen</label>
                    <input name="img" type="text" class="form-control" placeholder="nombre.png">
                </div>
                <div class="form-group col-md-4">
                    <label class="subsubtitle" >Precio</label>
                    <input name="precio" type="text" class="form-control" placeholder="2000">
                </div>
                <div class="form-group col-md-4">
                    <label class="subsubtitle">Inventario</label>
                    <input name="inventario" type="text" class="form-control" placeholder="100">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label class="subsubtitle">Descripción</label>
                    <input name="descripcion" type="text" class="form-control" placeholder="Desripción">
                </div>
                <div class="form-group col-md-2">
                    <label class="subsubtitle"></label> <br>
                    <input name="add-product" style="width: 100%; margin-top:7px;"class="btn btn-primary" type="submit" value="Agregar" style="margin: 0px 20px;"> 
                </div>
            </div>
        </form>

        <div class="col-md-14">
            <table class = "table table-hover">
                <thead>
                    <tr class="font">
                        <th>Ssn</th>
                        <th>Producto</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Inventario</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_pro = "SELECT * FROM PRODUCTO";
                    $result_pro = mysqli_query($conn, $query_pro);
                    while($row = mysqli_fetch_array($result_pro)){ ?>
                    <tr class="font">
                        <td><?php echo $row['Ssn']?></td>
                        <td><?php echo $row['Nombre_producto']?></td>
                        <td><?php echo $row['Descripcion']?></td>
                        <td><?php echo $row['Precio']?></td>
                        <td><?php echo $row['Imagen']?></td>
                        <td><?php echo $row['Cantidad_inv']?></td>
                        <td>
                            <a class="btn btn-danger" href="productAdmin.php?Ssn=<?php echo $row['Ssn']?>">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="includes/editProd.php?Ssn=<?php echo $row['Ssn']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ------------------------------------------ -->
    <!-- USUARIOS -->
    <!-- ------------------------------------------ -->

    <h1 class="title" id="usuarios">Usuarios<h1>

    <div class="container-admin">

        <h2 class="subtitle">Usuarios activos<h2>
        <h4 class="subtitle">¿Quiéres agregar uno?<h4>

        <form class="form-admin" method="post" action="userAdmin.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="subsubtitle">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="Nombre usuario">
                </div>
                <div class="form-group col-md-6">
                    <label class="subsubtitle">Tipo</label>
                    <input type="text" name="tipo" class="form-control" placeholder="Admin / Cliente">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="subsubtitle">Contraseña</label>
                    <input type="text" name="contrasena" class="form-control">
                </div>
                <div class="form-group col-md-5">
                    <label class="subsubtitle">Confirmar contraseña</label>
                    <input type="text" name="confirmar_contrasena" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label class="subsubtitle"></label> <br>
                    <input style="width: 100%; margin-top:7px;"class="btn btn-primary" name="add-user" type="submit" value="Agregar" style="margin: 0px 20px;"> 
                </div>
            </div>
        </form>

        <h2 class="subtitle">Usuarios activados<h2>

        <div class="col-md-14">
            <table class = "table table-hover">
                <thead>
                    <tr class="font">
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Tipo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status = "Activado";
                    $query_pro = "SELECT * FROM USUARIO WHERE Status='$status'";
                    $result_pro = mysqli_query($conn, $query_pro);
                    while($row = mysqli_fetch_array($result_pro)){ ?>
                    <tr class="font">
                        <td><?php echo $row['Usuario']?></td>
                        <td style="font-size: 10px;"><?php echo $row['Contrasena']?></td>
                        <td><?php echo $row['Tipo']?></td>
                        <td>
                            <a class="btn btn-danger" href="userAdmin.php?Usuario=<?php echo $row['Usuario']?>">
                                <i class="far fa-thumbs-down"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="includes/editUser.php?Usuario=<?php echo $row['Usuario']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <h2 class="subtitle">Usuarios desactivados<h2>

        <div class="col-md-14">
            <table class = "table table-hover">
                <thead>
                    <tr class="font">
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Tipo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $status = "Desactivado";
                    $query_pro = "SELECT * FROM USUARIO WHERE Status='$status'";
                    $result_pro = mysqli_query($conn, $query_pro);
                    while($row = mysqli_fetch_array($result_pro)){ ?>
                    <tr class="font">
                        <td><?php echo $row['Usuario']?></td>
                        <td style="font-size: 10px;"><?php echo $row['Contrasena']?></td>
                        <td><?php echo $row['Tipo']?></td>
                        <td>
                            <a class="btn btn-success" href="userAdmin.php?Nombre=<?php echo $row['Usuario']?>">
                                <i class="far fa-thumbs-up"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-info" href="includes/edit.php?Usuario=<?php echo $row['Usuario']?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    </div>

    <h1 class="title" id="pagos">Pagos<h1>

    <div class="container-admin">

        <h4 class="subtitle">Estos son todos los pagos:<h4>

        <div class="col-md-14">
            <table class = "table table-hover">
                <thead>
                    <tr class="font">
                        <th>Usuario</th>
                        <th>Total</th>
                        <th>Fecha Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_pro = "SELECT * FROM PAGO";
                    $result_pro = mysqli_query($conn, $query_pro);
                    while($row = mysqli_fetch_array($result_pro)){ ?>
                    <tr class="font">
                        <td><?php echo $row['Usuario']?></td>
                        <td><?php echo $row['Total']?></td>
                        <td><?php echo $row['Fecha_hora']?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>




<?php include("includes/footer.php")?>