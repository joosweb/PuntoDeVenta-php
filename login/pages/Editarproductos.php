<script type="text/javascript">
	$(document).ready(function() {
		$('#nombre').keyup(function(e) {
			var nombre = $('#nombre').val();

			var datos = 'nombre=' + nombre;

			$.ajax({
				type: "POST",
				data: datos,
				url: "../ajax/BuscarProductoPorNombre.php",
				}).done( function(e) {				
				 	$('#resultado').html(e);				  
			  });
		});
	});
</script>
<hr>
<div class="row">
            <div class="span16">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-list"></i>
                        <h5>Editar Productos y categorias</h5>
                        <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                            <i class="icon-reorder"></i>
                        </button>
                    </div>
                    <div class="box-content box-list collapse in">
                     <hr>
                     <div class="col-md-6"> 
	                      <div id="productos">
	                      	 <div class="box">
    					 		<div class="box-content">
    					 		<h5>Buscar Productos <span style="float:right;"> Total (<?php echo $Producto->TotalProductos(); ?>) Productos</span></h5> 
    					 		<form action="" id="Search" method="POST" class="form-inline">
    					 		<div class="form-group">
    					 			<input type="text" style="width:50%;" id="nombre" class="form-control" placeholder="Castrol, Silicona, Lubricante...">
    					 		</div>								
    					 		</form>
    					 		<div id="resultado">
    					 		<?php
    					 		if($_GET['action'] == 'EliminarP') {
    					 			$id_producto = $_GET['idProducto'];
    					 			if($Producto->EliminarProducto($id_producto)) {
    					 				echo '<div class="alert alert-dismissible alert-success">
											  <button type="button" class="close" data-dismiss="alert">&times;</button>
											  El producto ha sido eliminado</a>.
											</div>';
    					 			}
    					 		} 
    					 		else if(isset($_POST['ActualizarP']) == 'Actualizar') {
    					 			@$categoria = $_POST['categoria'];
                                    @$nombre_producto = $_POST['nombre_producto'];
                                    @$precio = $_POST['precio'];
                                    @$stock = $_POST['stock'];
                                    @$codigo_producto = $_POST['codigo_producto'];

                                    if($Producto->ActualizarProducto($categoria,$nombre_producto,$precio,$stock,$codigo_producto)){
                                    	echo '<div class="alert alert-dismissible alert-success">
											  <button type="button" class="close" data-dismiss="alert">&times;</button>
											  El producto '.$nombre_producto.' ha sido actualizado correctamente</a>.
											</div>';
                                    }
    					 		}
    					 		else if($_GET['action'] == 'editarP') {
    					 			
    					 			$idProducto=$_GET['idProducto'];
    					 			$P = $Producto->BuscarProductoPorId($idProducto);
    					 			$categoria_id = $P['id_categoria'];

    					 			echo '<form class="well" id="ActualizarProducto" action="" method="POST">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Categoria</label>
                                     <select name="categoria" id="categoria">
                                       '.$Producto->ListarCategorias($categoria_id).'
                                     </select>
                                     </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Nombre del producto</label>
                                        <input type="text" name="nombre_producto" value="'.$P['nombre_producto'].'" class="form-control" id="exampleInputPassword1" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Precio</label>
                                        <input type="text" name="precio" value="'.$P['precio'].'" class="form-control" id="exampleInputPassword1" placeholder="$" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Stock</label>
                                        <input type="text" name="stock"value="'.$P['stock'].'" class="form-control" id="exampleInputPassword1" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Codigo de barra (Usar pistola en esta casilla)</label>
                                        <input type="text" value="'.$P['codigo_producto'].'" name="codigo_producto" class="form-control" id="exampleInputPassword1" required>
                                      </div>                     
                                      <input type="submit" name="ActualizarP" class="btn btn-default" value="Actualizar">
                                      <a class="btn btn-success" href="javascript:history.back();">Volver</a>
                                   </form>';
    					 		}
    					 		else {
    					 				 $name = '';
    					 				 $max = 10;
    					 			echo $Producto->BuscarProductoPorNombre($name,$max);
    					 		 }
    					 				 
    					 		 ?>    					 		
    					 		</div>
    					 		</div>
    					 	</div>
	                      </div>
                     </div> 
                     <div class="col-md-4">
                     <div class="box">
    					 <div class="box-content"> 
    					 <h5>Editar Categorias </h5>
	                      <?php

	                      	if(isset($_POST['ActualizarC']) == 'Actualizar') {

	                      		$id_categoria = $_GET['idC'];
	                      		$nombre_categoria = $_POST['categoria'];

	                      		if($Producto->ActualizarCategoria($id_categoria,$nombre_categoria)) {
	                      			echo '<div class="alert alert-dismissible alert-success">
											  <button type="button" class="close" data-dismiss="alert">&times;</button>
											  La categoria ha sido actualizada correctamente <a class="" href="javascript:history.back();">Volver</a></a></a>.
											</div>';
	                      		}	                      		
	                      	}
	                      	else if($_GET['action'] == 'EliminarC') {
	                      		$id_categoria = $_GET['idC'];
	                      		if($Producto->EliminarCategoria($id_categoria)) {
	                      			echo '<div class="alert alert-dismissible alert-success">
											  <button type="button" class="close" data-dismiss="alert">&times;</button>
											  La categoria ha sido eliminada correctamente <a class="" href="javascript:history.back();">Volver</a></a>.
											</div>';
	                      		}
	                      	}
	                      	else if($_GET['action'] == 'EditarC') {
	                      		$id_categoria = $_GET['idC'];
	                      		$row = $Producto->NombreCategoriaPorId($id_categoria);
	                      		echo '<form class="well" action="" method="POST"> 
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre de categoria</label>
                                    <input type="text" value="'.$row['nombre_categoria'].'" class="form-control" name="categoria" placeholder="Lubricantes" required>
                                  </div>                             
                                  <input type="submit" class="btn btn-default" name="ActualizarC" value="Actualizar">
                                  <a class="btn btn-success" href="javascript:history.back();">Volver</a>
                                </form>';
	                      	}
	                      	else {
	                      		echo $Producto->MostrarCategorias(); 
	                      	}
	                        
	                      ?>
                      	</div>
                      </div>
                      <hr>
                     </div> 
                   </div>  
				</div>
               </div>                
            </div>
      </div>
</div>
