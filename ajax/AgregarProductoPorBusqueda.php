<?php
error_reporting(0);
require("../config/conexFunctions.php");
$Producto = new Productos();
$codigo = $_GET['codigo_producto'];
echo $Producto->BuscarProducto($codigo);
?>