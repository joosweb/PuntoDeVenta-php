<?php
require("../config/conexFunctions.php");
$Producto = new Productos();
if(!$_SESSION['rut']) {
    header('Location: login.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Simple Dashboard</title>
    <meta name="viewport" content="width=500, initial-scale=1, maximum-scale=1">
    
    <meta name="layout" content="main"/>
    
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script src="../js/jquery/jquery-1.8.2.min.js" type="text/javascript" ></script>
    <link href="../css/font-awesome.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <link href="../css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />


    <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap-iso.css" />

    <!-- Bootstrap Date-Picker Plugin -->
    <script type="text/javascript" src="../js/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap-datepicker3.css"/>
    <script>
    $(document).ready(function(){
      
      var date_input=$('input[name="date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
        var forms = document.getElementsByTagName('form');
        for (var i = 0; i < forms.length; i++) {
            forms[i].noValidate = true;

            forms[i].addEventListener('submit', function(event) {
                //Prevent submission if checkValidity on the form returns false.
                if (!event.target.checkValidity()) {
                    event.preventDefault();
                    //Implement you own means of displaying error messages to the user here.
                    alert('Ningun campo debe estar vacio.')
                }
            }, false);
        }
    });    
    <!--
    function popup(url) 
        {
         params  = 'width='+screen.width;
         params += ', height='+screen.height;
         params += ', top=0, left=0'
         params += ', fullscreen=yes';

         newwin=window.open(url,'windowname4', params);
         if (window.focus) {newwin.focus()}
         return false;
        }
    // -->
    </script>
</head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="dashboard.php" class="brand"><i class="icon-leaf"> Lubricentro</i></a>
                    <div id="app-nav-top-bar" class="nav-collapse">
                       
                        <ul class="nav pull-right">
                            <li>
                                <a href="../ajax/logout.php">Salir</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="body-container">
            <div id="body-content">
            <div class="container">
            <div class="row">
              <!--    nevagacion  -->
              <?php
                $site = htmlentities($_GET['s']);

                switch ($site) {
                  case 'productos':
                    if(file_exists('pages/productos.php')) {
                      include('pages/productos.php');
                    }
                    else
                    {
                      include('pages/404.html');
                    }
                    break;
                  case 'Usuarios':
                    if(file_exists('pages/usuarios.php')) {
                      include('pages/usuarios.php');
                    }
                    else
                    {
                      include('pages/404.html');
                    }
                    break;
                 case 'Editarproductos':
                    if(file_exists('pages/Editarproductos.php')) {
                      include('pages/Editarproductos.php');
                    }
                    else
                    {
                      include('pages/404.html');
                    }
                    break;
                 case 'tickets':
                    if(file_exists('pages/Tickets.php')) {
                      include('pages/Tickets.php');
                    }
                    else
                    {
                      include('pages/404.html');
                    }
                    break;
                
                case 'stock':
                    if(file_exists('pages/Stockproductos.php')) {
                      include('pages/Stockproductos.php');
                    }
                    else
                    {
                      include('pages/404.html');
                    }
                    break;

                case 'caja':
                    if(file_exists('pages/caja.php')) {
                      include('pages/caja.php');
                    }
                    else
                    {
                      include('pages/404.html');
                    }
                    break;


                  default:
                    # code...
                    break;
                }
              ?>
               <!--     fin de navegacion -->
                    <div class="body-nav body-nav-horizontal body-nav-fixed">
                        <div class="container">
                            <ul>
                                <li>
                                    <a href="dashboard.php?s=productos">
                                        <i class="fa fa-plus-circle fa-2x" aria-hidden="true"></i><br>A. Productos
                                    </a>
                                </li>  
                                <li>
                                    <a href="dashboard.php?s=Editarproductos">
                                        <i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i><br>E. Productos
                                    </a>
                                </li>   
                                <li>
                                    <a href="dashboard.php?s=Usuarios">
                                        <i class="fa fa-user-circle-o fa-2x"></i><br> Usuarios
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard.php?s=stock">
                                        <i class="fa fa-server fa-2x"></i> <br> Stock
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard.php?s=tickets">
                                        <i class="fa fa-money fa-2x"></i> <br> Tickets
                                    </a>
                                </li>
                                <li>
                                    <a href="dashboard.php?s=caja">
                                        <i class="fa fa-bar-chart fa-2x"></i> <br> Caja
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript: void(0)" onclick="popup('../index.php')" >
                                        <i class="fa fa-shopping-cart fa-2x"></i> <br> Punto de venta
                                    </a>
                                </li>                                
                            </ul>
                        </div>
                    </div>
              </div>
        </div>
        
        <div id="spinner" class="spinner" style="display:none;">
            Loading&hellip;
        </div>
    
        <footer class="application-footer">
            <div class="container">
                <div class="disclaimer">
                    <p>Copyright ©  2016</p>
                </div>
            </div>
        </footer>
        
        <script src="../js/bootstrap/bootstrap-transition.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-alert.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-modal.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-dropdown.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-scrollspy.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-tab.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-tooltip.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-popover.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-button.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-collapse.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-carousel.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-typeahead.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-affix.js" type="text/javascript" ></script>
        <script src="../js/bootstrap/bootstrap-datepicker.js" type="text/javascript" ></script>
        <script src="../js/jquery/jquery-tablesorter.js" type="text/javascript" ></script>
        <script src="../js/jquery/jquery-chosen.js" type="text/javascript" ></script>
        <script src="../js/jquery/virtual-tour.js" type="text/javascript" ></script>
        <script type="text/javascript">
        $(function() {
            $('#sample-table').tablesorter();
            $('#datepicker').datepicker();
            $(".chosen").chosen();
        });
    </script>

	</body>
</html>