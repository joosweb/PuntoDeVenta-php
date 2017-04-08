<?php
ob_start();
@session_start();
error_reporting(0);

class Conexion
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "123456";
    private $db   = "lubricentro";

    public function mysql()
    {

        $mysql = new mysqli($this->host, $this->user, $this->pass, $this->db);

        $mysql->set_charset('utf8');

        if ($mysql) {
            return $mysql;
        } else {
            return $mysql->error();
        }
    }
}

/**
 *
 */
class IngresoUsuarios extends Conexion
{

    public function Login($MRut, $MPas)
    {

        $sql = mysqli_query($this->mysql(), "SELECT * FROM usuarios WHERE rut='" . $MRut . "' and password=PASSWORD('" . $MPas . "') LIMIT 1");

        $rowcount = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        if ($rowcount['id']) {
            $_SESSION['nombre']    = $rowcount['nombre'];
            $_SESSION['apellidos'] = $rowcount['apellidos'];
            $_SESSION['rut']       = $rowcount['rut'];
            $_SESSION['tipo']      = $rowcount['tipo'];
            echo 'ok';
        } else {
            echo 'error';
        }
    }
}

class Productos extends Conexion
{   
    public function IngresarGasto($monto, $comentario) {
         $hoy = date('Y-m-d');
         $sql = mysqli_query($this->mysql(), "INSERT INTO gastos (importe,fecha,comentario) VALUES ('".$monto."', '".$hoy."','".$comentario."') ");
             if($sql) {
                return true;
             }
    }
    public function IngresarCajaDiaria($monto) {
         $hoy = date('Y-m-d');
         $sql = mysqli_query($this->mysql(), "INSERT INTO caja_diaria (caja_inicial,fecha_caja,estado) VALUES ('".$monto."', '".$hoy."','ABIERTA') ");
             if($sql) {
                return true;
             }
    }

    public function getCaja() {
         $hoy = date('Y-m-d');
         $sql = mysqli_query($this->mysql(), "SELECT * FROM caja_diaria WHERE DATE(fecha_caja) = '" . $hoy . "'");
         $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
         return $row['caja_inicial'];
    }

    public function getCajaHoy() {
         $hoy = date('Y-m-d');
         $sql = mysqli_query($this->mysql(), "SELECT id FROM caja_diaria WHERE DATE(fecha_caja) = '" . $hoy . "'");
         $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        if($row['id']) {
            return true;
        }
        else 
        {
            return false;
        }
    }

    public function TotalVentasDelDia(){
        $hoy = date('Y-m-d');
        $sql = mysqli_query($this->mysql(), "SELECT * FROM log_ventas INNER JOIN productos ON log_ventas.codigo_producto = productos.codigo_producto WHERE DATE(log_ventas.fecha_venta) = '".$hoy."'");

        while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $total = $total + $row['precio'];
        }

        return $total;
    }

    public function CajaInicial() {
        $hoy = date('Y-m-d');
        $sql = mysqli_query($this->mysql(), "SELECT caja_inicial FROM caja_diaria WHERE fecha_caja = '" . $hoy . "'");
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        return $row['caja_inicial'];
    }

    public function Gastos() {
        $hoy = date('Y-m-d');
        $sql = mysqli_query($this->mysql(), "SELECT SUM(importe) as GASTOS FROM gastos WHERE fecha = '" . $hoy . "'");
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        return $row['GASTOS'];
    }

    public function TotalCajaInicialMenosGastos() {
        return ($this->CajaInicial() - $this->Gastos());
    }
    public function CheckAdmin($rut,$password) {

        $sql = mysqli_query($this->mysql(), "SELECT * FROM usuarios WHERE rut='" . $rut . "' and password=PASSWORD('" . $password . "') LIMIT 1");

        $row=mysqli_fetch_array($sql,MYSQLI_ASSOC);

        if($row['id']){
            return true;
        }
    }

    public function BuscarNombre($rut)
    {
        $sql = mysqli_query($this->mysql(), "SELECT nombre,apellidos FROM usuarios WHERE rut = '" . $rut . "'");
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        return $row['nombre'] . ' ' . $row['apellidos'];
    }
    public function BusquedaTickets($rut, $fecha_inicio, $fecha_termino)
    {

        $sql = mysqli_query($this->mysql(), "SELECT * FROM ticketventa WHERE DATE(fecha_ticket) >= '" . date("Y-m-d", strtotime($fecha_inicio)) . "' AND DATE(fecha_ticket) <= '" . date("Y-m-d", strtotime($fecha_termino)) . "' AND rut_usuario='" . $rut . "'");

        $return = $return . '<table class="table table-striped table-hover">
                                <tr>
                                  <th>#</th>
                                  <th>Nombre</th>
                                  <th>Fecha Ingreso</th>
                                  <th>Comentario</th>
                                  <th>Monto</th>
                                  <th>1.5% del total</th>
                                </tr>';
        $i = 1;

        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {

            $return = $return . '<tr><td>' . $i++ . '</td>';
            $return = $return . '<td>' . $this->BuscarNombre($rut) . '</td>';
            $return = $return . '<td>' . $row['fecha_ticket'] . '</td>';
            $return = $return . '<td><textarea disabled>' . $row['comentario'] . '</textarea></td>';
            $return = $return . '<td>' . $row['monto'] . '</td>';
            $return = $return . '<td>$ ' . ($row['monto'] * 0.015) . '</td>';

            $total            = $total + $row['monto'];
            $total_porcentaje = $total_porcentaje + ($row['monto'] * 0.015);
        }

        $return = $return . '<tr> <td></td><td></td><td></td><td></td><th >MONTO TOTAL:</th><th>' . $this->Moneda($total, "pesos") . '<th></tr>';
        $return = $return . '<tr> <td></td><td></td><td></td><td></td><th>MONTO TOTAL 1.5%:</th><th>' . $this->Moneda($total_porcentaje, "pesos") . '<th></tr>';

        return $return;
    }
    public function getAdministrador($class)
    {
        $sql = mysqli_query($this->mysql(), "SELECT * FROM usuarios WHERE tipo = 2");

        $return = '<select name="administrador" id="administrador" class="' . $class . '">';

        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $return = $return . '<option value = "' . $row['rut'] . '" > ' . $row['nombre'] . ' ' . $row['apellidos'] . '</option >';
        }

        return $return . '</select>';

    }
    public function getVendedor($class)
    {
        $sql = mysqli_query($this->mysql(), "SELECT * FROM usuarios WHERE tipo = 1");

        $return = '<select name="vendedor" id="vendedor" class="' . $class . '">';

        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $return = $return . '<option value = "' . $row['rut'] . '" > ' . $row['nombre'] . ' ' . $row['apellidos'] . '</option >';
        }

        return $return . '</select>';

    }

    public function AgregarTicketVenta($vendedor, $monto, $comentario)
    {
        $hoy = date("Y-m-d H:i:s");

        $sql = mysqli_query($this->mysql(), "INSERT INTO ticketventa (rut_usuario, monto,fecha_ticket,comentario) VALUES ('" . $vendedor . "', '" . $monto . "','" . $hoy . "', '" . $comentario . "')");
        if ($sql) {
            return true;
        }
    }

    public function ListarProductosConStock($OrderBy)
    {

        if (!$OrderBy) {
            $OrderBy = 'ASC';
        }

        $sql = mysqli_query($this->mysql(), "SELECT * FROM productos INNER JOIN categoria ON productos.id_categoria=categoria.id_categoria ORDER BY productos.stock " . $OrderBy . "");

        $i = 0;

        $return = '<table class="table">
            <tr>
                <th>#</th>
                <th>Categoria</th>
                <th>Nombre del producto</th>
                <th>Codigo</th>
                <th>Stock</th>
            </tr>
        ';

        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {

            $return = $return . '<tr class=""><td>' . $i++ . '</td>';
            $return = $return . '<td>' . $row['nombre_categoria'] . '</td>';
            $return = $return . '<td>' . $row['nombre_producto'] . '</td>';
            $return = $return . '<td>' . $row['codigo_producto'] . '</td>';
            if ($row['stock'] <= 5) {
                $return = $return . '<td class="danger">' . $row['stock'] . '</td>';
            } else if ($row['stock'] >= 5 && $row['stock'] <= 20) {
                $return = $return . '<td class="warning">' . $row['stock'] . '</td>';
            } else {
                $return = $return . '<td class="info">' . $row['stock'] . '</td>';
            }

        }

        echo $return . '</tr></table>';
    }

    public function EditarUsuario($run, $password, $nombre, $apellidos, $tipoUser)
    {
        if (!$password) {
            $sql = mysqli_query($this->mysql(), "UPDATE usuarios set nombre = '" . $nombre . "', apellidos='" . $apellidos . "', tipo=" . $tipoUser . " WHERE rut = '" . $run . "' LIMIT 1");
        } else {
            $sql = mysqli_query($this->mysql(), "UPDATE usuarios set password=PASSWORD('" . $password . "'), nombre = '" . $nombre . "', apellidos='" . $apellidos . "', tipo=" . $tipoUser . " WHERE rut = '" . $run . "' LIMIT 1");
        }

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function EliminarUsuario($id)
    {
        $sql = mysqli_query($this->mysql(), "DELETE from usuarios WHERE id='" . $id . "' LIMIT 1");
        if ($sql) {
            echo '<div class="alert alert-dismissible alert-success">
                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                  El usuario ha sido eliminado correctamente.
                  </div>';
        }
    }

    public function BuscarUsuarioPorId($id)
    {
        $sql = mysqli_query($this->mysql(), "SELECT * FROM usuarios WHERE id='" . $id . "'");
        $row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        return $row;
    }

    public function ListarUsuarios()
    {
        $sql = mysqli_query($this->mysql(), "SELECT * FROM usuarios");

        echo '<table class="table">
              <tr>
              <th>#</th>
              <th>Run</th>
              <th>Nombre</th>
              <th>Tipo de Usuario</th>
              <th>Acción</th>
              ';
        $i = 1;

        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {

            if ($row['tipo'] == 1) {
                $usuario = 'Vendedor';
            } else {
                $usuario = "Administrador";
            }
            $return = $return . '<tr><td>' . $i++ . '</td>';
            $return = $return . '<td>' . $row['rut'] . '</td>';
            $return = $return . '<td>' . $row['nombre'] . '</td>';
            $return = $return . '<td>' . $usuario . '</td>';
            $return = $return . '<td><a href="dashboard.php?s=Usuarios&action=editar&id=' . $row['id'] . '" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> | <a href="dashboard.php?s=Usuarios&action=eliminar&id=' . $row['id'] . '" title="Eliminar"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td></tr>';
        }

        echo $return . '</table>';
    }

    public function AgregarUsuario($run, $password, $nombre, $apellidos, $tipoUser)
    {
        $sql = mysqli_query($this->mysql(), "INSERT INTO usuarios (rut,password,nombre,apellidos,tipo) VALUES ('" . $run . "', PASSWORD('" . $password . "'), '" . $nombre . "', '" . $apellidos . "', '" . $tipoUser . "')");

        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function EliminarCategoria($id_categoria)
    {
        $sql = mysqli_query($this->mysql(), "DELETE from categoria WHERE id_categoria='" . $id_categoria . "' LIMIT 1");
        if ($sql) {
            return true;
        }
    }

    public function ActualizarCategoria($id_categoria, $nombre_categoria)
    {
        $sql = mysqli_query($this->mysql(), "UPDATE categoria set nombre_categoria = '" . $nombre_categoria . "' WHERE id_categoria=" . $id_categoria . " LIMIT 1");
        if ($sql) {
            return true;
        }
    }

    public function NombreCategoriaPorId($id_categoria)
    {
        $sql   = mysqli_query($this->mysql(), "SELECT * FROM categoria WHERE id_categoria=" . $id_categoria . "");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        return $query;
    }

    public function TotalProductos()
    {
        $sql   = mysqli_query($this->mysql(), "SELECT count(*) as TOTAL FROM productos");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        return $query['TOTAL'];
    }

    public function EliminarProducto($id_producto)
    {
        $sql = mysqli_query($this->mysql(), "DELETE from productos WHERE id='" . $id_producto . "' LIMIT 1");
        if ($sql) {
            return true;
        }
    }

    public function ActualizarProducto($categoria, $nombre_producto, $precio, $stock, $codigo_producto)
    {
        $sql = mysqli_query($this->mysql(), "UPDATE productos set id_categoria='" . $categoria . "', nombre_producto='" . $nombre_producto . "', precio='" . $precio . "',codigo_producto='" . $codigo_producto . "', stock='" . $stock . "' WHERE codigo_producto='" . $codigo_producto . "' LIMIT 1");
        if ($sql) {
            return true;
        }
    }

    public function MostrarCategorias()
    {

        $sql    = mysqli_query($this->mysql(), "SELECT * FROM categoria");
        $return = '';
        $return = $return . '<table class="table">';
        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $return = $return . '<tr><td><a href="dashboard.php?s=idCat=' . $query['id_categoria'] . '">' . $query['nombre_categoria'] . '</></td><td><a href="dashboard.php?s=Editarproductos&action=EditarC&idC=' . $query['id_categoria'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a> | <a href="dashboard.php?s=Editarproductos&action=EliminarC&idC=' . $query['id_categoria'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></td></tr>';
        }

        return $return . '</table>';
    }

    public function InsertarProducto($categoria, $nombre_producto, $precio, $stock, $codigo_producto)
    {

        $fecha_ingreso = date("Y-m-d");

        $sql = mysqli_query($this->mysql(), "INSERT INTO productos (id_categoria,nombre_producto,precio,fecha_ingreso,codigo_producto,stock) VALUES ('" . $categoria . "','" . $nombre_producto . "','" . $precio . "','" . $fecha_ingreso . "','" . $codigo_producto . "','" . $stock . "')");

        if ($sql) {
            return true;
        } else {
            return false;
        }

    }

    public function AgregarCategoria($categoria)
    {
        $sql = mysqli_query($this->mysql(), "INSERT INTO categoria (nombre_categoria) VALUES ('" . $categoria . "')");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function ConsultarStock($id)
    {
        $sql   = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE codigo_producto = '" . $id . "'");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        if ($query['stock'] >= 1) {
            return true;
        }
    }

    public function BPDC($codigo_producto, $atributo)
    {
        $sql   = mysqli_query($this->mysql(), "SELECT * FROM carrito WHERE codigo_producto = '" . $codigo_producto . "'");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        return $query[$atributo];
    }

    public function ProcesarPedido()
    {
        $hoy      = date("Y-m-d H:i:s");
        $sql      = mysqli_query($this->mysql(), "SELECT * FROM carrito");
        $rowcount = mysqli_num_rows($sql);
        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $codigo_producto[] = $query['codigo_producto'];
        }
        for ($i = 0; $i < $rowcount; $i++) {
            if ($this->ConsultarStock($codigo_producto[$i])) {
                $log = mysqli_query($this->mysql(), "INSERT INTO log_ventas (codigo_producto,cantidad,fecha_venta) VALUES ('" . $codigo_producto[$i] . "', 1, '" . $hoy . "') ");
                $sql = mysqli_query($this->mysql(), "UPDATE productos set stock = (stock - 1) WHERE codigo_producto = '" . $codigo_producto[$i] . "' ");
            }
        }

        $sql = mysqli_query($this->mysql(), "TRUNCATE TABLE carrito");

        return true;
    }

    public function BuscarProductoPorId($id)
    {

        $sql   = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE id='" . $id . "'");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        return $query;
    }

    public function BuscarProductoPorNombre($name, $max)
    {

        $sql    = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE nombre_producto like '%" . $name . "%' LIMIT $max");
        $i      = 1;
        $RETURN = $RETURN . '<table class="table table-bordered"><tr>
                        <th width="5%">#</th>
                        <th width="19%">Nombre Producto</th>
                        <th width="37%">Stock</th>
                        <th width="37%">Accion</th>
                        </tr>';
        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {

            $RETURN = $RETURN . "<tr>";
            $RETURN = $RETURN . "<td width='10%'>" . $i++ . "</td>";
            $RETURN = $RETURN . "<td width='10%'>" . $query['nombre_producto'] . "</td>";
            $RETURN = $RETURN . "<td width='25%'>" . $query['stock'] . "</td>";
            $RETURN = $RETURN . '<td width="25%"><a href="dashboard.php?s=Editarproductos&action=editarP&idProducto=' . $query['id'] . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a> | <a href="dashboard.php?s=Editarproductos&action=EliminarP&idProducto=' . $query['id'] . '"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></td></td>';
            $RETURN = $RETURN . "</tr>";
        }

        $RETURN = $RETURN . "</table>";

        return $RETURN;
    }

    public function BuscarProductoV($tipo, $dato)
    {

        if ($tipo == 1) {
            $sql = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE codigo_producto = '" . $dato . "'");
        }
        if ($tipo == 2) {
            $sql = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE nombre_producto like '" . $dato . "%'");
        }

        $i = 1;

        $RETURN = $RETURN . '<table class="table table-bordered"><tr>
                        <th width="5%">#</th>
                        <th width="19%">Cod. de Barras</th>
                        <th width="37%">Nombre Producto</th>
                        <th width="10%">Precio</th>
                        <th width="10%">Stock</th>
                        <th width="10%">Accion</th>
                        </tr>';

        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            $RETURN = $RETURN . "<tr>";
            $RETURN = $RETURN . "<td width='10%'>" . $i++ . "</td>";
            $RETURN = $RETURN . "<td width='10%'>" . $query['codigo_producto'] . "</td>";
            $RETURN = $RETURN . "<td width='25%'>" . $query['nombre_producto'] . ".</td>";
            $RETURN = $RETURN . "<td width='23%'>" . $query['precio'] . "</td>";
            $RETURN = $RETURN . "<td width='5%'>" . $query['stock'] . "</td>";
            $RETURN = $RETURN . "<td width='5%'><button onClick='add_producto(" . $query['codigo_producto'] . ")' title='Agregar al carrito'><i class='fa fa-plus-circle' aria-hidden='true'></i></button></td>";
            $RETURN = $RETURN . "</tr>";
        }

        $RETURN = $RETURN . "</table>";

        return $RETURN;
    }

    public function AnularVenta()
    {

        $sql = mysqli_query($this->mysql(), "TRUNCATE TABLE carrito");

        return true;
    }

    public function FindProductOnCarrito($codigo_producto)
    {
        $sql   = mysqli_query($this->mysql(), "SELECT * FROM carrito WHERE codigo_producto = " . $codigo_producto . " ");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        if ($query['id']) {
            return true;
        }
    }

    public function BuscarProducto($id)
    {

        $sql   = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE codigo_producto = " . $id . " ");
        $query = mysqli_fetch_array($sql, MYSQLI_ASSOC);

        $i = 1;

        if ($query['stock'] <= 0) {
            echo 'SinStock';
            exit();
        } else {

            if ($query['id']) {
                if ($this->FindProductOnCarrito($query['codigo_producto'])) {
                    $sql = mysqli_query($this->mysql(), "UPDATE carrito set cantidad =  (cantidad + 1) WHERE codigo_producto= '" . $query['codigo_producto'] . "'");
                    echo 'ok';
                } else {
                    $sql = mysqli_query($this->mysql(), "INSERT INTO carrito (codigo_producto,nombre_producto,precio,cantidad) VALUES ('" . $query['codigo_producto'] . "', '" . $query['nombre_producto'] . "', '" . $query['precio'] . "', 1) ");
                    echo 'ok';
                }
            }
        }
    }

    public function ListarCategorias($id)
    {
        $sql = mysqli_query($this->mysql(), "SELECT * FROM categoria");
        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            if ($id == $query['id_categoria']) {
                $RETURN = $RETURN . "<option value='" . $query['id_categoria'] . "' selected>" . $query['nombre_categoria'] . "</option>";
            } else {
                $RETURN = $RETURN . "<option value='" . $query['id_categoria'] . "'>" . $query['nombre_categoria'] . "</option>";
            }

        }

        return $RETURN;

    }

    public function ListarProductosXCategoria($id)
    {
        $sql = mysqli_query($this->mysql(), "SELECT * FROM productos WHERE id_categoria='" . $id . "'");
        $i   = 1;
        echo '<table class="table table-bordered" style="text-align:center; max-height: 500px;">';
        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            @$RETURN = $RETURN . "<tr>";
            $RETURN  = $RETURN . "<td width='10%'>" . $i++ . "</td>";
            $RETURN  = $RETURN . "<td width='25%'>" . $query['nombre_producto'] . ".</td>";
            $RETURN  = $RETURN . "<td width='23%'>" . $query['precio'] . "</td>";
            $RETURN  = $RETURN . "<td width='22%'><a href='#' onClick='' title='Añadir al carrito'><i class='fa fa-plus-square' aria-hidden='true'></i></a></td>";
            $RETURN  = $RETURN . "<td width='28%'>" . $query['stock'] . "</td></tr>";
        }

        @$RETURN = $RETURN;

        echo $RETURN . "</table>";

    }

    public function ListarCarrito()
    {

        $sql = mysqli_query($this->mysql(), "SELECT * FROM carrito");

        $i = 1;

        echo "<table class='table table-bordered'>";
        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            @$RETURN = $RETURN . "<tr>";
            $RETURN  = $RETURN . "<td width='5%'>" . $i++ . "</td>";
            $RETURN  = $RETURN . "<td width='12%'>" . $query['codigo_producto'] . "</td>";
            $RETURN  = $RETURN . "<td width='38%'>" . $query['nombre_producto'] . ".</td>";
            $RETURN  = $RETURN . "<td width='10%'>$ " . $query['precio'] . "</td>";
            $RETURN  = $RETURN . "<td width='10%'> " . $query['cantidad'] . " </td>";
            $RETURN  = $RETURN . "<td width='5%'><a href='ajax/BorrarProducto.php?id=" . $query['id'] . "' class='btn btn-danger btn-sm'><i class='fa fa-trash-o' aria-hidden='true'></i> Eliminar</a></td></tr>";
        }

        @$RETURN = $RETURN . "<br></table>";

        echo $RETURN;
    }

    public function ListarProductos()
    {

        $sql = mysqli_query($this->mysql(), "SELECT * FROM productos");

        $i = 1;

        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            @$RETURN = $RETURN . "<tr>";
            $RETURN  = $RETURN . "<td width='12%'>" . $i++ . "</td>";
            $RETURN  = $RETURN . "<td width='38%'>" . $query['nombre_producto'] . ".</td>";
            $RETURN  = $RETURN . "<td width='28%'>" . $query['precio'] . "</td>";
            $RETURN  = $RETURN . "<td><a href='#' onClick='' title='Añadir al carrito'><i class='fa fa-plus-square' aria-hidden='true'></i></a></td>";
            $RETURN  = $RETURN . "<td width='28%'>" . $query['stock'] . "</td></tr>";
        }

        @$RETURN = $RETURN;

        echo $RETURN;
    }

    public function ProcesarVenta()
    {

        @$sql = mysqli_query($this->mysql(), "SELECT * FROM carrito");

        $i = 1;

        while ($query = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            @$RETURN = $RETURN . "<tr>";
            $RETURN  = $RETURN . "<td>" . $i++ . "</td>";
            $RETURN  = $RETURN . "<td>" . $query['nombre_producto'] . "</td>";
            $RETURN  = $RETURN . "<td>$ " . $query['precio'] . "</td>";
        }

        @$RETURN = $RETURN;

        echo $RETURN;
    }

    public function DevolverTotal()
    {

        $sql = mysqli_query($this->mysql(), "SELECT * FROM carrito");
        while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
            for ($i = 0; $i < $row['cantidad']; $i++) {
                $total = $total + $row['precio'];
            }
        }

        return $total;

    }

    public function BorrarProducto($id)
    {
        $sql = mysqli_query($this->mysql(), "DELETE from carrito WHERE id='" . $id . "'");
        if ($sql) {
            return true;
        } else {
            return false;
        }
    }

    public function Moneda($numero, $moneda)
    {
        $longitud  = strlen($numero);
        $punto     = substr($numero, -1, 1);
        $punto2    = substr($numero, 0, 1);
        $separador = ".";
        if ($punto == ".") {
            $numero   = substr($numero, 0, $longitud - 1);
            $longitud = strlen($numero);
        }
        if ($punto2 == ".") {
            $numero   = "0" . $numero;
            $longitud = strlen($numero);
        }
        $num_entero = strpos($numero, $separador);
        $centavos   = substr($numero, ($num_entero));
        $l_cent     = strlen($centavos);
        if ($l_cent == 2) {$centavos = $centavos . "0";} elseif ($l_cent == 3) {$centavos = $centavos;} elseif ($l_cent > 3) {$centavos = substr($centavos, 0, 3);}
        $entero = substr($numero, -$longitud, $longitud - $l_cent);
        if (!$num_entero) {
            $num_entero = $longitud;
            $centavos   = "";
            $entero     = substr($numero, -$longitud, $longitud);
        }

        $start = floor($num_entero / 3);
        $res   = $num_entero - ($start * 3);
        if ($res == 0) {
            $coma = $start - 1;
            $init = 0;} else {
            $coma = $start;
            $init = 3 - $res;}
        $d = $init;
        $i = 0;
        $c = $coma;
        while ($i <= $num_entero) {
            if ($d == 3 && $c > 0) {
                $d   = 0;
                $sep = ",";
                $c   = $c - 1;} else { $sep = "";}
            $final .= $sep . $entero[$i];
            $i = $i + 1; // todos los digitos
            $d = $d + 1; // poner las comas
        }
        if ($moneda == "pesos") {
            $moneda = "$";
            return $moneda . " " . $final . $centavos;
        } elseif ($moneda == "dolares") {
            $moneda = "USD";
            return $moneda . " " . $final . $centavos;
        } elseif ($moneda == "euros") {
            $moneda = "EUR";
            return $final . $centavos . " " . $moneda;
        }
    }
}
