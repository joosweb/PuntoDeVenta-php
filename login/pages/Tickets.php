<hr>
<script type="text/javascript">
    function ReportesDeTickets() {

        var rut = $('#vendedor').val();
        var fecha_inicio = $('#start_date').val();
        var fecha_termino = $('#end_date').val();

        var datos = 'rut=' + rut + '&fecha_inicio=' + fecha_inicio + '&fecha_termino=' + fecha_termino;

        $.ajax({
                type: "GET",
                data: datos,
                url: "../ajax/ReportesTickets.php",
                }).done( function(e) {              
                    $('#reportes').html(e);                 
              });
    }
    function ListarOrderByStock($orderBy) {

        var datos = 'orderBy=' + $orderBy;

        $.ajax({
                type: "GET",
                data: datos,
                url: "../ajax/ListarOrderByStock.php",
                }).done( function(e) {              
                    $('#stockProductos').html(e);                 
              });
    }

</script>
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
                        <div class="panel-heading">Tickets - Informes diarios, mensuales, anuales</div>
                        <div class="panel-body">
                        <table class="table">
                          <tr>
                            <td width="10%"> 
                              <div class="form-group">
                                  <label for="">Seleccione Usuario</label>
                                  <?php echo $Producto->getVendedor(); ?>
                              </div>
                            </td>
                            <td width="10%">
                              <div class="form-group">
                                <label for="">Fecha de inicio</label>
                                <input type="text" name="date" id="start_date">
                                </div>
                            </td>
                            <td width="10%">
                              <div class="form-group">
                                <label for="">Fecha de termino</label>
                                <input type="text" name="date" id="end_date">
                                </div>
                            </td>
                            <td>
                                <label for="">&nbsp;</label>
                                <button type="button" onclick="ReportesDeTickets()" class="btn btn-default">Generar Reporte</button>         
                            </td>
                          </tr>
                        </table> 
                        <div id="reportes">
                          
                        </div>                         
                         </div>
                         </div> 
                        </div>
                        </div>
                    </div>
                    </div>         
                </div>
            </div>