<?php 

session_start(); 
include("db.php");

$name = $_SESSION['name'];

$query2 = "SELECT * FROM USUARIO WHERE Usuario='$name'";
$result2 = mysqli_query($conn,$query2);
while($row = mysqli_fetch_array($result2)){
    $tipo = $row['Tipo'];
}

?>