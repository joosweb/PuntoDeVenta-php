<?php
error_reporting(0);
require("../config/conexFunctions.php");
$Producto = new Productos();
$id_producto = $_POST['id_producto'];
echo @$Producto->ListarCarrito();
?>