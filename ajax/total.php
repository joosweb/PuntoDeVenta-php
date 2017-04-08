<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
echo "TOTAL : ".@$Producto->Moneda($Producto->DevolverTotal(), "pesos");
?>