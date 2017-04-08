<?php
	require("../config/conexFunctions.php");
	$Producto = new Productos();
	if($Producto->ProcesarPedido()){
		echo 'OK';
	}
	else {
		echo 'FAIL';
	}
?>