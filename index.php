<?php
require "config/conexFunctions.php";
$Producto = new Productos();
if ($_SESSION['rut'] == false) {
    header('Location: login/login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<meta name="viewport" content="width=500, initial-scale=1, maximum-scale=1">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/scripts.js"></script>
	<title>Lubricentro</title>
</head>
<body>
<style type="text/css">
	#table-scroll {
  height:400px;
  overflow:auto;
  margin-top:20px;
}
</style>
<script>
$(function(){
    $(".val").click(function(e){
         e.preventDefault();
          var input = $('#campo1').val();
          var a = $(this).attr("href");
          $(".screen").val(input + a);
    });

     $(".DEL").click(function(e){
     	 e.preventDefault();
          $("#campo1").val('');
     });

     $(".clear").click(function(){
          $(".outcome").val("");
          $(".screen").html("");
     });

     $(".min").click(function(){
         $(".cal").stop().animate({width: "0px", height: "0px", marginLeft: "700px", marginTop: "1000px"}, 500);
        setTimeout(function(){$(".cal").css("display", "none")}, 600);
     });

     $(".close").click(function(){
          $(".cal").css("display", "none");
     })
})
</script>
<div id="container">
	<div id="top-header">
	<div class="modal fade" id="gasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">Ingreso de Gastos</h4>
			      </div>
			      <div class="modal-body">
			      <div id="msgGasto"></div>
					<form method="get" action="" id="formGasto">
					  <div class="form-group">
					    <label for="exampleInputEmail1">Monto</label>
					    <input type="text" id="montoGasto" class="form-control" id="exampleInputEmail1" placeholder="$">
					  </div>
					  <div class="form-group">
					    <label for="exampleInputEmail1">Comentario</label>
					    <textarea id="comentarioGasto" class="form-control" id="" cols="30" rows="10"></textarea>
					  </div>
					  <button type="submit" class="btn btn-default">GUARDAR</button>
					</form>
			    </div>
			  </div>
			</div>
			</div>
			<!-- Modal -->
			<div class="modal fade" id="Ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">Ticket de Venta</h4>
			      </div>
			      <div class="modal-body">
			      <span id="msgTicket"></span>
			        <form method="GET" action="index.php" id="FormTicket">
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Seleccione Vendedor:</label>
			          		 <?php echo $Producto->getVendedor('form-control'); ?>
			          </div>
			           <div class="form-group">
			            <label for="recipient-name" class="control-label">Ingrese el monto:</label>
						<input type="text" class="form-control" id="monto" name="monto" placeholder="$">
			          </div>
			          <div class="form-group">
			            <label for="message-text" class="control-label">Comentario:</label>
			            <textarea class="form-control" name="comentario" id="comentario"></textarea>
			          </div>
			           <div class="form-group">
			            <input type="submit" class="btn btn-success" value="AGREGAR" placeholder="$">
			          </div>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
		<!-- Modal -->
	<div class="modal fade" id="caja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">Reportes de caja</h4>
			      </div>
			      <div class="modal-body">
			      <div id="container-caja">
			      <span id="msgCaja"></span>
			      <button type="button" class="btn btn-info btn-sm" id="GenerarReporte">Generar Reporte</button>
			      <div id="tablaReportes"></div>
			      </div>
			      </div>
			    </div>
			  </div>
			</div>
			<div class="modal fade" id="Ticket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="exampleModalLabel">Ticket de Venta</h4>
			      </div>
			      <div class="modal-body">
			      <span id="msgTicket"></span>
			        <form method="GET" action="index.php" id="FormTicket">
			          <div class="form-group">
			            <label for="recipient-name" class="control-label">Seleccione Vendedor:</label>
			          		 <?php echo $Producto->getVendedor('form-control'); ?>
			          </div>
			           <div class="form-group">
			            <label for="recipient-name" class="control-label">Ingrese el monto:</label>
						<input type="text" class="form-control" id="monto" name="monto" placeholder="$">
			          </div>
			          <div class="form-group">
			            <label for="message-text" class="control-label">Comentario:</label>
			            <textarea class="form-control" name="comentario" id="comentario"></textarea>
			          </div>
			           <div class="form-group">
			            <input type="submit" class="btn btn-success" value="AGREGAR" placeholder="$">
			          </div>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
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
				   		 <?php $Producto->ProcesarVenta();?>
				    </table>
				  </div>
				</div>
				</div>
				<div class="row">
				<div class="col-md-3">
					<div class="panel panel-default">
					  <div class="panel-body">
					    Total : <?php echo @$Producto->Moneda($Producto->DevolverTotal(), "pesos"); ?>
					  </div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
					  <div class="panel-body">
					    Vuelto : <span id="vuelto" style="color:red; font-size:18px;"></span>
					  </div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="panel panel-default">
					  <div class="panel-body">
					   <form class="form-inline">
						  <div class="form-group">
						    <input type="text" id="monto" class="form-control input-sm" placeholder="$">
						  </div>
						  <button type="button" id="calcularVuelto" class="btn btn-warning btn-sm">Calcular vuelto</button>
						</form>
					  </div>
					</div>
				</div>
		      </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		        <button type="button" id="ProcesarVenta"  class="btn btn-primary">Procesar Venta</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Modal -->
		<div class="modal fade bs-example-modal-lg" id="BuscarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Buscar Producto</h4>
		      </div>
		      <div class="modal-body">
		       <form action="" id="FormBusqueda" class="form-inline">
				  <div class="form-group">
				    <label for="exampleInputName2">Buscar por : </label>
				    <select name="tipo" id="tipo" class="form-control input-sm">
				    	<option value="1">Codigo de Barra</option>
				    	<option value="2">Nombre de producto</option>
				    </select>
				  </div>
				  <div class="form-group">
				    <input type="text" class="form-control input-sm" name="dato" id="dato">
				  </div>
				  <div class="form-group">
				    <div id="msg_addProducto" style="display:none;">
						<div class="alertP alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						 El articulo ha sido añadido correctamente.
						</div>
					</div>
					<div id="msg_stockProducto" style="display:none;">
						<div class="alertP alert-dismissible alert-danger">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						 No hay stock para este producto por favor verifique inventario.
						</div>
					</div>
				  </div>
				</form>
				<hr><div id="table-scroll">
					 <span id="resultado_busqueda" style="width:400px; height:200px;"></span>
					</div>
		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<div id="input-article">
			<div id="search-form">
				<div class="input-article">
				<form action="" class="form-inline" id="target">
					<label for="">Nº Articulo</label> <input type="text" name="campo1" id="campo1" class="screen"><input type="hidden" value="" class="outcome" />
					<input type="submit"  name="campo1" id="campo1" class="btn btn-success btn-sm" style="font-size:12px;" value="ENTER">
					<button type="button" data-toggle="modal" data-target="#Ticket" data-whatever="@mdo"  name="ticket" id="ticket" class="btn btn-primary btn-sm" style="font-size:12px;">
					INGRESAR TICKET
					</button>
					<span id="cajero" style="float:right;"><b>Cajero: </b> <?php echo $_SESSION['nombre']; ?></span>
				</form>
			</div>
		</div>

	</div>
	<div class="row">
		 <div class="col-md-10">
		 <div class="panel panel-default">
			  <div class="panel-body">
			    <div id="sell-items">
			     <table class="table table-bordered" style="width:100%;">
				<tr>
				<th width="3%">#</th>
				<th width="8%">Cod. de Barras</th>
				<th width="24%">Nombre Producto</th>
				<th width="7%">Precio</th>
				<th width="6%">Cantidad</th>
				<th width="5%">Acción</th>
				</tr></table>
				<div id="venta" style="width:100%;">
					<span id="resultado">
					</span>
					</div>
				</div>
				<br><br>
			 	<div class="panel panel-default">
				  <div class="panel-body" id="total">
				   	<div class="text-total">
				   	</div>
				   </div>
			      </div>
		 		</div>
			  </div>
			</div>
		   <div class="col-md-2">
		   <div class="panel panel-default">
			  <div class="panel-body">
				    <tr>
				 		<td>
				 			<a class="quick-btn" style="background-color:#4B8A08;" href="venta.php" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-shopping-cart fa-2x"></i>
							<span>Procesar Venta</span>
							<span class="label label-default"></span>
						    </a>
						</td>
						<td>
				 			<a class="quick-btn" href="#" data-toggle="modal" data-target="#BuscarProducto">
							<i class="fa fa-search fa-2x"></i>
							<span>Buscar Producto</span>
							<span class="label label-default"></span>
						    </a>
						</td>
						<td>
				 			<a class="quick-btn" href="#" onclick="javascript:if(confirm('Seguro que desea anular la venta?')){AnularVenta(); return false;}">
							<i class="fa fa-recycle fa-2x"></i>
							<span>Anular Venta</span>
							<span class="label label-default"></span>
						    </a>
						</td>
						<td>
				 			<a class="quick-btn" href="#" data-toggle="modal" data-target="#gasto">
							<i class="fa fa-money fa-2x"></i>
							<span>Añadir Gasto</span>
							<span class="label label-default"></span>
						    </a>
						</td>
						<td>
				 			<a class="quick-btn" href="#" data-toggle="modal" data-target="#caja">
							<i class="fa fa-usd fa-2x"></i>
							<span>Caja</span>
							<span class="label label-default"></span>
						    </a>
						</td>
						<td>
				 			<a class="quick-btn" href="#"  onclick="javascript:if(confirm('Seguro que desea cerrar esta ventana?')){Salir(); return false;}">
							<i class="fa fa-sign-out fa-2x"></i>
							<span>Salir</span>
							<span class="label label-default"></span>
						    </a>
						</td>
				 	</tr>
				 </table>
				</div>
				</div>
			  </div>
		   </div>
		</div>
	</div>
</body>
</html>