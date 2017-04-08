<?php
require "../config/conexFunctions.php";

$Producto = new Productos();

$vendedor   = $_GET['vendedor'];
$monto      = $_GET['monto'];
$comentario = $_GET['comentario'];

if ($Producto->AgregarTicketVenta($vendedor, $monto, $comentario)) {
    echo '<div class="alert alert-dismissible alert-success">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  El ticket ha sido agregado correctamente..
		</div>';
}
