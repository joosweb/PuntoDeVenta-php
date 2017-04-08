<hr>
<div class="row">
            <div class="span16">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-list"></i>
                        <h5>Agregar, Editar y Eliminar Usuarios</h5>
                        <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                            <i class="icon-reorder"></i>
                        </button>
                    </div>
                    <div class="box-content box-list collapse in">
                     <hr>
                     <div class="col-md-6"> 
                      <div class="panel panel-default">
                        <div class="panel-heading">Agregar Usuario</div>
                        <div class="panel-body">  
	                       <?php
	                       if(isset($_POST['Agregar']) == 'Agregar'){
	                       		
	                       		$run = $_POST['run'];
	                       		$password = $_POST['password'];
	                       		$nombre = $_POST['nombre'];
	                       		$apellidos = $_POST['apellidos'];
	                       		$tipoUser = $_POST['tipoUsuario'];

	                       		if($Producto->AgregarUsuario($run, $password, $nombre, $apellidos, $tipoUser)) {
	                       			echo '<div class="alert alert-dismissible alert-success">
                                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                      <strong>Muy bien!</strong>El usuario ha sido creado correctamente.
                                                    </div>';
	                       		}
	                       		else {
	                       			echo 'error';
	                       		}
	                        }
                          else if(isset($_POST['Actualizar']) == 'Actualizar') {

                            $run = $_POST['run'];
                            $password = $_POST['password'];
                            $nombre = $_POST['nombre'];
                            $apellidos = $_POST['apellidos'];
                            $tipoUser = $_POST['tipoUsuario'];

                            if($Producto->EditarUsuario($run, $password, $nombre, $apellidos, $tipoUser)) {
                              echo '<div class="alert alert-dismissible alert-success">
                                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                      <strong>Muy bien!</strong>El usuario ha sido actualizado correctamente.
                                                    </div>';
                            }
                            else {
                              echo 'error';
                            }
                          }
	                       ?>
                         <?php if($_GET['action'] == 'editar') {  
                          $row = $Producto->BuscarUsuarioPorId($_GET['id']);                     
                         ?>
                            <h4>Editar Usuario</h4>
                            <p>Si la contraseña esta en blanco la actual contraseña no cambiara, es decir no se reemplazara a menos que ingrese usted una nueva.</p>
                            <form class="well" id="form" action="" method="POST">
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">RUN</label>
                                        <input type="text" name="run" value="<?php echo $row['rut']; ?>" class="form-control" id="exampleInputPassword1" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Constraseña</label>
                                        <input type="password" name="password" value="" class="form-control" id="exampleInputPassword1" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Nombre</label>
                                        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control" id="exampleInputPassword1" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Apellidos</label>
                                        <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" class="form-control" id="exampleInputPassword1" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">tipo</label>
                                       	<select name="tipoUsuario" id="tipoUsuario">
                                       		<option value="1">Usuario Vendedor</option>
                                       		<option value="2">Usuario Administrador</option>
                                       	</select>
                                      </div>                                                        
                                      <input type="submit" name="Actualizar" class="btn btn-default" value="Actualizar">
                                   </form>
                                  <?php  } else { ?>
                                  <form class="well" id="form" action="" method="POST">
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">RUN</label>
                                        <input type="text" name="run" class="form-control" id="exampleInputPassword1" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Constraseña</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" id="exampleInputPassword1" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Apellidos</label>
                                        <input type="text" name="apellidos" class="form-control" id="exampleInputPassword1" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">tipo</label>
                                        <select name="tipoUsuario" id="tipoUsuario">
                                          <option value="1">Usuario Vendedor</option>
                                          <option value="1">Usuario Administrador</option>
                                        </select>
                                      </div>                                                        
                                      <input type="submit" name="Agregar" class="btn btn-default" value="Agregar">
                                   </form>
                                <?php } ?>
                               </div>
                              </div> 
                             </div> 
                             <div class="col-md-5">                    
                             <div class="panel panel-default">
                              <div class="panel-heading">Editar Usuarios</div>
                              <div class="panel-body">
                              <?php if($_GET['action'] == 'eliminar'){
                                echo $Producto->EliminarUsuario($_GET['id']);
                              }
                              ?>
                              <?php echo $Producto->ListarUsuarios(); ?>                                
                              </div>
                            </div>
                       </div>                  
                    </div>
                </div>
            </div>
          