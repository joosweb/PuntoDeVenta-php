<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
echo $Producto->ListarCarrito();
?>