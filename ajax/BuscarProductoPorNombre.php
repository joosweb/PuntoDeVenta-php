<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
$nombre= $_POST['nombre'];
$max = 10;
echo $Producto->BuscarProductoPorNombre($nombre, $max);
?>