function BuscarProducto(value) {
	$('#buscarProducto').load('ajax/devolverProductos.php?categoria='+value);
}
function Salir() {
	window.close();
}
function  AnularVenta() {
		$.ajax({
			url: "ajax/AnularVenta.php",
			}).done( function(e) {
			if(e == 'OK') {
			 window.location.href = 'index.php';
			}		    
			});
	}

function  add_producto(id) {

			var datos = 'codigo_producto=' + id;
			
			$.ajax({
				type: "GET",
				data: datos,
				url: "ajax/AgregarProductoPorBusqueda.php",
				}).done( function(e) {	
					if(e == 'SinStock'){
						$('#msg_stockProducto').css('display', 'block').fadeOut(3000);
					}
					else {
						$('#msg_addProducto').css('display', 'block').fadeOut(3000);	
					}
				 				  
			  });
}
$(document).ready(function() {

		/// AÑADIR TICKET
		$('#formGasto').submit(function(e) {
			e.preventDefault();

			var monto = $('#montoGasto').val();
			var comentario = $('#comentarioGasto').val();

			if(monto == '' || comentario == ''){
				$('#msgGasto').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> Los campos no deben estar vacios.</div>');
				return false;				 				  
			}


			var datos = 'monto=' + monto + '&comentario=' + comentario;

			$('#msgGasto').html(' <i class="fa fa-cog fa-spin fa-2x fa-fw"></i>');	

			$.ajax({
				type: "GET",
				data: datos,
				url: "ajax/IngresarGasto.php",
				}).done( function(e) {
				$('#msgGasto').html('<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> El gasto se añadio correctamente.</div>');				 				  
			  });


		});

		$('#GenerarReporte').click(function() {
			$('#tablaReportes').load('ajax/ReporteCaja.php');
		});

		$('#SubmitCaja').submit(function(e) {
			e.preventDefault();

			var administrador = $('#administrador').val();
			var password = $('#password').val();

			var datos = 'administrador=' + administrador + '&password=' + password;

			$('#msgCaja').html(' <i class="fa fa-cog fa-spin fa-2x fa-fw"></i>');	

			$.ajax({
				type: "GET",
				data: datos,
				url: "ajax/LoginCaja.php",
				}).done( function(e) {
					if(e == 'ok'){
						$('#msgCaja').html('<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button> La caja se ha cerrado correctamente.</div>');	
					}
					else {
						$('#msgCaja').html(' <div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button> Su contraseña es incorrecta.</div>');	
					}			 				  
			  });
		});

		$('#FormTicket').submit(function(e) {
			e.preventDefault();

			// capturar los datos del formulario

			var vendedor = $('#vendedor').val();
			var monto = $('#monto').val();
			var comentario = $('#comentario').val();

			if(vendedor == '' || monto == '' || comentario == ''){
				$('#msgTicket').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Por favor llene todos los campos del formulario</div>');
				return false;
			}
			else {
				$('#msgTicket').html('<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i>');
			}

			
			// Traer datos de busqueda

			var datos = 'vendedor=' + vendedor + '&monto=' + monto + '&comentario=' + comentario;

			$.ajax({
				type: "GET",
				data: datos,
				url: "ajax/AgregarTicketVenta.php",
				}).done( function(e) {				
				 	$('#msgTicket').html(e).fadeOut(3000);				  
			  });
		});


		$('#BuscarProducto').on('hidden.bs.modal', function () {
		    window.location.reload(true);
		});

		$('#dato').keyup(function() {

			// capturar los datos del formulario

			var dato = $('#dato').val();
			var tipo = $('#tipo').val();

			// Traer datos de busqueda

			var datos = 'tipo=' + tipo + '&dato=' + dato;

			$.ajax({
				type: "GET",
				data: datos,
				url: "ajax/BuscarProductoV.php",
				}).done( function(e) {				
				 	$('#resultado_busqueda').html(e);				  
			  });

		});

		$("#campo1").val('');

		$("#resultado").load('ajax/carrito.php');
		$(".text-total").load("ajax/total.php");

    	$("#campo1").focus();

	    	$( "#target").submit(function(event){
	    		event.preventDefault();

	    		 var id_producto = $("#campo1").val();

				  $.ajax({
			        url: "ajax/buscarProducto.php",
			        type: "POST",
			        data: "id_producto="+id_producto ,
			        success: function (response) {
			        	if(response =='ok'){

			        		$("#resultado").html(response);
			                 $("#resultado").load('ajax/carrito.php');
			                 $("#total").load("ajax/total.php");	

			                 location.reload();	 
			        	}
			        	else if(response == 'SinStock') {
			        		alert('No hay stock para este producto por favor verifique inventario.');
			        	}
				                                 			                 
			        },
			        error: function(jqXHR, textStatus, errorThrown) {
			           alert(textStatus, errorThrown);
			        	}
			   	   }); 
			  

			  	 $("#campo1").val('');
			  	 $("#campo1").focus();

	    });

	 


});

