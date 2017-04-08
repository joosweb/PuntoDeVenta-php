 <?php
	require("../config/conexFunctions.php");

	$monto = $_GET['monto'];
 	$comentario = $_GET['comentario'];
 	
	$Producto = new Productos();

	if($Producto->IngresarGasto($monto, $comentario)) {
		return true;
	}

 ?>

