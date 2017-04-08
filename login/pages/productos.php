<hr>
<div class="row">
            <div class="span16">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-list"></i>
                        <h5>Agregar productos y categorias</h5>
                        <button class="btn btn-box-right" data-toggle="collapse" data-target=".box-list">
                            <i class="icon-reorder"></i>
                        </button>
                    </div>
                    <div class="box-content box-list collapse in">
                     <hr>
                     <div class="col-md-6"> 
                      <div class="panel panel-default">
                        <div class="panel-heading">Agregar Producto</div>
                        <div class="panel-body">  
                             <?php if(isset($_POST['Insertar']) == 'Insertar') {

                                            @$categoria = $_POST['categoria'];
                                            @$nombre_producto = $_POST['nombre_producto'];
                                            @$precio = $_POST['precio'];
                                            @$stock = $_POST['stock'];
                                            @$codigo_producto = $_POST['codigo_producto'];

                                            if($Producto->InsertarProducto($categoria,$nombre_producto,$precio,$stock,$codigo_producto)) {
                                                echo ' <div class="alert alert-dismissible alert-success">
                                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                                      <strong>Muy bien!</strong> El producto se añadio satisfactoriamente.
                                                    </div>';
                                            }
                                        else
                                        {
                                        ?>
                                       <div class="alert alert-dismissible alert-danger">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong>Error!</strong> contacta con un administrador.
                                        </div>
                                        <?php
                                      }
                                  } 
                                  ?>              
                                 <form class="well" id="form" action="dashboard.php" method="POST">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Categoria</label>
                                     <select name="categoria" id="">
                                        <?php echo $Producto->ListarCategorias(); ?>
                                     </select>
                                     </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Nombre del producto</label>
                                        <input type="text" name="nombre_producto" class="form-control" id="exampleInputPassword1" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Precio</label>
                                        <input type="text" name="precio" class="form-control" id="exampleInputPassword1" placeholder="$" required>
                                      </div>  
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Stock</label>
                                        <input type="text" name="stock" class="form-control" id="exampleInputPassword1" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleInputPassword1">Codigo de barra (Usar pistola en esta casilla)</label>
                                        <input type="text" name="codigo_producto" class="form-control" id="exampleInputPassword1" required>
                                      </div>                     
                                      <input type="submit" name="Insertar" class="btn btn-default" value="Insertar">
                                   </form>
                                  </div>
                                </div> 
                            </div> 
                            <div class="col-md-5">                    
                            <div class="panel panel-default">
                              <div class="panel-heading">Agregar Categoria</div>
                              <div class="panel-body">
                                  <?php 
                                  $categoria = $_POST['categoria'];

                                  if(isset($_POST['Agregar']) == 'Agregar') {
                                    if($Producto->AgregarCategoria($categoria)) {
                                        echo ' <div class="alert alert-dismissible alert-success">
                                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                                              <strong>Muy bien!</strong> La categoria se añadio satisfactoriamente.
                                            </div>';
                                    }
                                    else
                                    {
                                        ?>
                                       <div class="alert alert-dismissible alert-danger">
                                          <button type="button" class="close" data-dismiss="alert">&times;</button>
                                          <strong>Error!</strong> contacta con un administrador.
                                        </div>
                                        <?php
                                    }
                                  }
                                  ?>
                                <form class="well" action="dashboard.php" method="POST"> 
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre de categoria</label>
                                    <input type="text" class="form-control" name="categoria" placeholder="Lubricantes" required>
                                  </div>                             
                                  <input type="submit" class="btn btn-default" name="Agregar" value="Agregar">
                                </form>
                              </div>
                            </div>
                       </div>                  
                    </div>
                </div>
            </div>
          