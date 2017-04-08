<?php
error_reporting(0);
require("../config/conexFunctions.php");
$Producto = new Productos();
$tipo = $_GET['tipo'];
$dato = $_GET['dato'];
echo $Producto->BuscarProductoV($tipo, $dato);
?>