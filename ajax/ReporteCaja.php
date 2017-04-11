<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
?>
<hr>
	<table class="table">
			       	<tr>
			       		<td>Fecha de caja:</td>
			       		<td><?php echo date('Y-m-d');?></td>
			       	</tr>
			       	<tr>
			       		<td width="30%" align="left">Caja Inicial:</td>
			       		<td align="left"><?php echo $Producto->moneda($Producto->CajaInicial(), 'pesos'); ?></td>
			       	</tr>
			       	<tr>
			       		<td>Gastos:</td>
			       		<td><?php echo $Producto->moneda($Producto->Gastos(), 'pesos'); ?></td>
			       	</tr>
			       	<tr>
			       		<td>Caja - Gasto:</td>
			       		<td><?php echo $Producto->moneda($Producto->TotalCajaInicialMenosGastos(), 'pesos'); ?></td>
			       	</tr>
			       	<tr>
			       		<td>Total de Ventas del dia:</td>
			       		<td><?php echo $Producto->moneda($Producto->TotalVentasDelDia(), 'pesos'); ?></td>
			       	</tr>
			       	<tr class="danger" style="font-size:14px;">
			       		<td><span style="font-size:16px;">Total en caja:</span></td>
			       		<td><span style="font-size:16px;"><?php echo $Producto->moneda(($Producto->TotalCajaInicialMenosGastos() + $Producto->TotalVentasDelDia()), 'pesos'); ?></span></td>
			       	</tr>
			       </table>
			       <hr>
			       <!--
			       <form action="" method="get" id="SubmitCaja">
			       	<div class="form-group">
			       	<label for="">Seleccione administrador:</label>
				      	<?php ##echo $Producto->getAdministrador('form-control'); ?> 		
				    </div>
				    <div class="form-group">
			       	<label for="">Ingrese Contraseña:</label>
				      	<input type="password" id="password" class="form-control"> 		
				    </div>
			       	<div class="form-group">				       
			       		<button type="submit"  class="btn btn-warning">Cerrar Caja</button>
			       	</div>
			       </form>
			       -->