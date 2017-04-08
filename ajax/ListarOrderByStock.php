<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
$OrderBy = $_GET['orderBy'];
echo $Producto->ListarProductosConStock($OrderBy);
?>