<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
$id_producto = $_POST['id_producto'];
echo $Producto->BuscarProducto($id_producto);
?>