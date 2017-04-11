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
                     <div class="col-md-11"> 
                      <div class="panel panel-default">
                        <div class="panel-heading">Ingresar Caja - Fecha <b><?php echo date('Y-m-d'); ?></b></div>
                        <div class="panel-body">
                        <?php if($Producto->getCajaHoy()) { ?>
                          <div class="alert alert-dismissible alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                           Caja inicial: <?php echo $Producto->getCaja();  ?>
                          </div>
                          
                         <?php } else 
                          { 
                          ?>
                          <?php if($_POST['GUARDAR'] == 'GUARDAR') { 
                              $monto = $_POST['monto'];
                              if($monto == '') {
                                echo '<div class="alert alert-dismissible alert-warning">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                        Por favor ingrese un monto en la casilla solicitada..
                                      </div>';
                              }
                              else
                              {
                              if($Producto->IngresarCajaDiaria($monto)) {
                                  echo '<div class="alert alert-dismissible alert-success">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       La caja con fecha <b>'.date('Y-m-d').'</b> ha sido creada correctamente.
                                      </div>';
                                }
                                else
                              {
                                  echo '<div class="alert alert-dismissible alert-danger">
                                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                                       Ha ocurrido un error, por favor contacte con un administrador.
                                      </div>';
                              }
                            }
                          }?>
                          <form action="dashboard.php?s=caja" method="post">
                           <div class="form-group">
                             <label for="">Ingrese Caja inicial:</label>
                             <input type="text" name="monto" class="form-control" style="width:20%;">
                           </div>
                           <div class="form-group">
                             <input type="submit" class="btn btn-default" value="GUARDAR" name="GUARDAR">
                           </div>
                         </form>
                          <?php
                          } 
                          ?>                        
                         </div>
                         </div> 
                        </div>
                        </div>
                    </div>
                    </div>         
                </div>
            </div>