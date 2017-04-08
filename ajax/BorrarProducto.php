<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
$id = $_GET['id'];
if($Producto->BorrarProducto($id)) {
	header('Location: ../index.php');
}
?>