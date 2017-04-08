<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
$id = $_GET['categoria'];
echo $Producto->ListarProductosXCategoria($id);
?>