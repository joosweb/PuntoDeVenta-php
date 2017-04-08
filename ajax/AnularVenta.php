<?php
	require("../config/conexFunctions.php");
	$Producto = new Productos();
	if($Producto->AnularVenta()){
		echo 'OK';
	}
	else {
		echo 'FAIL';
	}
?>