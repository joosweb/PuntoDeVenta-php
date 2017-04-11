<?php
require("config/conexFunctions.php");
$Producto = new Productos();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<title>Lubricentro</title>
</head>
<body>
<script type="text/javascript">
	
	$(document).ready(function() {

		$("#calcularVuelto").click(function(event) {

			var total = $('#TotalVenta').html();
			var res = total.replace(",", ""); 
			var res = res.replace("$", ""); 
			var MontoIngresado = $('#montoRecepcion').val();

			var resultado = (MontoIngresado - res);

			$('#vuelto').html('$ ' + resultado);
			
		});

		$('#ProcesarVenta').click(function(){
				$.ajax({
				    url: "ajax/RealizarPedido.php",
				}).done( function(e) {
					if(e == 'OK') {
						location.reload();
					}		    
				});		
				
				$('#myModal').modal('hide');
		});
	});
</script>
<!-- Modal -->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Proceso de venta</h4>
		      </div>
		      <div class="modal-body">
		        <div class="panel panel-default">
				  <div class="panel-body">
				  <div id="carrito" style="overflow:scroll; height:200px;" >
				  <table class='table table-bordered'>
				   		<?php $Producto->ProcesarVenta(); ?>
				    </table>
				  </div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
					  <div class="panel-body">
					    Total : <span id="TotalVenta" style="color:yellow; font-size:24px;"><?php echo @$Producto->Moneda($Producto->DevolverTotal(), "pesos"); ?></span>
					  </div>				 
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
					  <div class="panel-body">
					    Vuelto : <span id="vuelto" style="color:red; font-size:24px;"></span>
					  </div>					 
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-default">
					  <div class="panel-body">
					   <form class="form-inline">
						  <div class="form-group">
						    <input type="text" class="form-control" id="montoRecepcion" placeholder="$">
						  </div>
						  <button type="button" id="calcularVuelto" class="btn btn-warning">Calcular vuelto</button>
						</form>
					  </div>					 
					</div>
				</div>
		      </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="button" id="ProcesarVenta" class="btn btn-primary">Procesar Venta</button>
		      </div>
	      </div>
</body>
</html>