<?php
	require("../config/conexFunctions.php");
	$Producto = new Productos();
	$rut = $_GET['administrador'];
	$password = $_GET['password'];
	if($Producto->CheckAdmin($rut,$password)){
		echo 'ok';
	}
	else {
		return false;
	}
?>