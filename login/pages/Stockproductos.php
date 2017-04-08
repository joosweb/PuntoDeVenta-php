<hr>
<script type="text/javascript">
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
                        <div class="panel-heading">Stock de productos</div>
                        <div class="panel-body">
                        <select name="OrderbY" id="OrderbY" onchange="ListarOrderByStock(this.value)">
                            <option value="0">Ordenar Por:</option>
                            <option value="ASC">Menor Stock</option>
                            <option value="DESC">Mayor Stock</option>
                        </select>
                        <div id="stockProductos">
                            <?php $Producto->ListarProductosConStock() ; ?>
                        </div>
                         </div>
                         </div> 
                        </div>
                        </div>
                    </div>
                    </div>         
                </div>
            </div>