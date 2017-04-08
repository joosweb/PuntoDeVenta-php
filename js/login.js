$(document).ready(function() {


	$('#loginForm').submit(function(e) {

		e.preventDefault();

		var MRut = $('#MRut').val();
		var MPas = $('#password').val();

		var datos = 'rut='+MRut+'&password='+MPas;

		 $('#precarga').html('<img src="https://www.jose-aguilar.com/scripts/jquery/loading/images/loader.gif" width="20"/>');

		$.ajax({
			type: 'GET',
			data: datos,
			url: "../ajax/login.php",
			}).done( function(e) {
				if(e == 'ok') {
					$(location).attr('href', 'dashboard.php');
					//$('#precarga').html('');
				}
				else if(e == 'error')
				{
					$('#error').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>  <strong>Ops Error!</strong> Por favor ingresa tus datos nuevamente</div>');
					$('#precarga').html('');
				}
				
		  	});

	});


});