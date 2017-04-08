<?php
error_reporting(0);
require("../config/conexFunctions.php");
$Login = new IngresoUsuarios();
$MRut = $_GET['rut'];
$MPas = $_GET['password'];
echo $Login->Login($MRut, $MPas);
?>