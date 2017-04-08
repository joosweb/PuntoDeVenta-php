 <?php
require("../config/conexFunctions.php");
	$rut = $_GET['rut'];
 	$fecha_inicio = $_GET['fecha_inicio'];
 	$fecha_termino = $_GET['fecha_termino'];

 	
	$Producto = new Productos();

	echo $Producto->BusquedaTickets($rut, $fecha_inicio, $fecha_termino) ;

 ?>

