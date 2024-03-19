<?php 

require_once '../includes/core.php'; 

date_default_timezone_set("America/Lima");


$axusuario =  $_SESSION['userId'];
$diaactual =date("Y-m-d");
$diaactual_1 =date("d-m-Y");
$horaactual = date("g");
$anoactual = date("Y");
$ndias = date("d");
$axperiodo_actual=date("m-Y");

$query = "SELECT top 1 * FROM usuarios WHERE usuario= '".$axusuario."'";
$result=odbc_exec($con,$query);
if(odbc_num_rows($result) == 1) {

   $value = odbc_fetch_array($result);

  $axiduser= $value['COD_USUARIO'];
   $axidempresa = $value['ID_EMPRESA'];
   $axrazonsocial = $value['NOMBRE_EMPRESA'];
   $axnombreusuario = $value['NOM_USUARIO'];
   $axrucempresa = $value['RUC_EMPRESA'];
   $axid_usuario= $value['ID_USUARIO'];
   $axcoduser= $value['ID_USUARIO'];
   $axtiponegocio= $value['TIPO_NEGOCIO'];
   $axnom_user= $value['USUARIO'];
   $axarea_usuario= $value['NOM_AREA_USUARIO'];

   $SQLVendedores = "SELECT * FROM USUARIOS WHERE TIPO_USUARIO='VENDEDOR' ORDER BY NOM_USUARIO";
  $RSVendedores=odbc_exec($con,$SQLVendedores);

  $SQLtipo_doc_egresos = "SELECT ID_TD,DETALLE_DOC FROM TIPO_DOCUMENTOS WHERE EGRESOS='COMPRAS' ORDER BY ID_TD";
$RStipo_doc_egresos=odbc_exec($con,$SQLtipo_doc_egresos);


$SQLProveedores = "SELECT * FROM BENEFICIARIOS WHERE TIPO_PROV_CLIE='PROVEEDOR' ORDER BY RAZON_SOCIAL";
$RSProveedores=odbc_exec($con,$SQLProveedores);


$SQLCtas = "SELECT * FROM CUENTA_BANCARIAS ORDER BY ID_CTA ASC";
$RSCtas=odbc_exec($con,$SQLCtas);



$SQLcategorias = "SELECT ID_CATEGORIA,NOM_CATEGORIA FROM CATEGORIAS  WHERE TIPO_CATEGORIA='SERVICIOS' ORDER BY ID_CATEGORIA ASC";
$RSQLCategorias=odbc_exec($con,$SQLcategorias);


   /* $sqltipo_caracteristica = "SELECT TIPO_CARACTERISTICA FROM MK_PROYECTOS_DT GROUP BY TIPO_CARACTERISTICA";
   $RSCaracteristicas=odbc_exec($con,$sqltipo_caracteristica);

   /*$sqlareas = "SELECT AREA_TRABAJO FROM AREAS_TRABAJO GROUP BY AREA_TRABAJO";
   $rsareas=odbc_exec($con,$sqlareas);

   $sqlproyectos_1 = "SELECT ID_PROYECTO,NOMBRE_CORTO_PY FROM MK_PROYECTOS WHERE ESTADO_PY='ACTIVO' AND ID_EMPRESA='$axidempresa'";
   $rsproyectos_1=odbc_exec($con,$sqlproyectos_1);

   $sqlcanales_1 = "SELECT ID_CANAL,DESCRIPCION_CANAL FROM MK_CANALES ORDER BY DESCRIPCION_CANAL ASC";
   $rscanales_1=odbc_exec($con,$sqlcanales_1);

   $sqlmedios_1 = "SELECT ID_MEDIO_CAPTACION,DESCRIPCION_MEDIO FROM MK_MEDIO_CAPTACION ORDER BY DESCRIPCION_MEDIO ASC";
   $rsmedios_1=odbc_exec($con,$sqlmedios_1);

   $sqluser_coordinador = "SELECT ID_USUARIO,NOM_USUARIO FROM USUARIOS_LISTAR WHERE ASIG_EQUIPOS='SI'  ORDER BY NOM_USUARIO ASC";
   $rsuser_coordinador=odbc_exec($con,$sqluser_coordinador);

   $sqluser_coordinador_1 = "SELECT ID_USUARIO,NOM_USUARIO FROM USUARIOS_LISTAR WHERE ASIG_EQUIPOS='SI'  ORDER BY NOM_USUARIO ASC";
   $rsuser_coordinador_1=odbc_exec($con,$sqluser_coordinador_1);
  */
   $SQLTipo_doc_ident_1 = "SELECT ID_DOC,ABREV_TD FROM TB2_DOCIDENTIDAD ORDER BY ABREV_TD ASC";
   $RSTipo_doc_ident_1=odbc_exec($con,$SQLTipo_doc_ident_1);

   $SQLlocales = "SELECT ID_LOCAL,RAZON_SOCIAL FROM LOCALES ORDER BY RAZON_SOCIAL ASC";
   $rslocales = odbc_exec($con,$SQLlocales);

   $SQLcategorias = "SELECT ID_CATEGORIA,NOM_CATEGORIA FROM CATEGORIAS ORDER BY NOM_CATEGORIA ASC";
   $rscategorias = odbc_exec($con,$SQLcategorias);
   
   $SQLAfectacion = "SELECT ID_AFECTACION,ABREV_AFECTACION FROM TIPO_AFECTACION ORDER BY ABREV_AFECTACION ASC";
   $RSAfectacion = odbc_exec($con,$SQLAfectacion);

 /*

   $sqlejecutivos_venta = "SELECT ID_USUARIO,NOM_USUARIO FROM USUARIOS_EJECUTIVOS ORDER BY NOM_USUARIO ASC";
   $rsejecutivos_venta=odbc_exec($con,$sqlejecutivos_venta);

   $sqlasig_desviacion = "SELECT TIPO_DESVIACION FROM MK_DESVIACIONES GROUP BY TIPO_DESVIACION";
   $rsasig_desviacion=odbc_exec($con,$sqlasig_desviacion);

   $sqlasig_desviacion_reasignacion = "SELECT TIPO_DESVIACION FROM MK_DESVIACIONES GROUP BY TIPO_DESVIACION";
   $rsasig_desviacion_reasignacion=odbc_exec($con,$sqlasig_desviacion_reasignacion);
   */

 }
 
?>




<!doctype html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">     
    <link rel="stylesheet" href="../css/bootstrap-icons.css">    

    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> <!--grafico_proyeccion TACOMETRO-->
    

    <link rel="stylesheet" href="../css/estiloindex.css">
    <script src="../js/sweetalert2@11.js"></script>
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script--> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="../js/loader.js"></script> <!--LIBRERIA PARA GRAFICOS--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  
  

    



    <title>Web | Oleoginos </title>        
    <link rel="shortcut icon" href="../icon/favicon.ico"/>     


    

  </head>
  
  <style type="text/css">

    /*@import url('https://fonts.googleapis.com/css?family=Poppins');*/

    
/* Definir variables */
:root {
  --amarillo: #0F920F; /* Amarillo */
  --azul: #2B5170; /* azul */
  --fondo_blanco:  #FFF;
  --amarillo_bajito:#FBF1D1;
  
}

    *{
      margin: 0;
      padding: 0;
     /* user-select: none;*/
      box-sizing: border-box;
      /*font-family: 'Poppins', sans-serif;
      font-family: 'Roboto', sans-serif;
      font-family: 'Kalnia', serif;
      font-family: 'Inter', sans-serif;
      font-family: 'Ubuntu', sans-serif;
      font-family: 'Josefin Sans', sans-serif;
      font-family: 'Signika Negative', sans-serif;*/

      font-family: 'Montserrat', sans-serif;
    }

    .sidebar{
      position:   fixed;
      width: 360px;
      height: 100%;
      left:   0;
      background: white;
    }

     nav ul{
      background: white;
      height: 100%;
      width:  100%;
      list-style: none;
     } 

    nav ul li{
      line-height:  60px;
      border-bottom: 1px solid rgba(255,255,255,0,1);
    }




    nav ul li a{
      position: relative;
      color: red;
      text-decoration: none;
      font-size: 18;
      padding-left:40px;
      font-weight: 500;
      display: block;
      width: 100%;     
      border-left: 3px solid transparent;


    }
      nav ul li a.active{
        color: cyan;
        background: white;
        border-left-color: cyan;
      }

      nav ul ul{
        position: static;
        display: none;
      }

      nav ul .feat-show.show{
        display: block;
      }

      nav ul ul li{
        line-height: 42px;
        border-bottom: none;

      }

      nav ul ul li a{
        font-size: 10px;
        color: red;
        padding-left: 40px;

      }

       nav ul li a span{
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        font-size: 22px;
        transition: transform 0.4s;

      }

      nav ul li a span.rotate{
        transform: translateY(-50%) rotate(-180deg);
      }

       nav ul li.active ul li a{
        color: red;

        background: white;
        border-left-color: transparent;
      }

       nav ul ul li a:hover{
        color: blue !important;
        background: white !important;
        
      }

      .ico_mimino_stock {
        font-size: 12px; /* Tamaño inicial del icono */
        animation: parpadeo_minimo 1s infinite alternate; /* Definimos la animación */
        }

        @keyframes parpadeo_minimo {
            0% {
                opacity: 2; /* Comienza completamente visible */

            }
            100% {
                opacity: 1; /* Termina completamente invisible */
                color: red;
            }
        }

      .ico_grande {
        font-size: 24px; /* Tamaño inicial del icono */
        animation: parpadeo 0.5s infinite alternate; /* Definimos la animación */
        }

        @keyframes parpadeo {
            0% {
                opacity: 1; /* Comienza completamente visible */

            }
            100% {
                opacity: 0; /* Termina completamente invisible */
                color: red;
            }
        }

        .color_menu{
          background: #F3F4E8;
        }
        .card{
          /*--bs-card-cap-bg: #EDFAED;*/
        }
        .table-primary {
          --bs-table-color: #000;
          --bs-table-bg: #F3F4E8;
          --bs-table-border-color: #bacbe6;
          --bs-table-striped-bg: #c5d7f2;
          --bs-table-striped-color: #000;
          --bs-table-active-bg: #bacbe6;
          --bs-table-active-color: #000;
          --bs-table-hover-bg: #bfd1ec;
          --bs-table-hover-color: #000;
          color: var(--bs-table-color);
          border-color: var(--bs-table-border-color);
    }
        .color_letra_menu{
          color: var(--azul);
        }

        .color_ventas{
          background: #7DAA92;
        }


        .rotate {
            transform: rotate(180deg);
            transition: transform 0.4s;
        }

      .feat-show {
            display: none;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out;
        }

        .feat-show.show {
            display: block;
            max-height: 1000px; /* Ajusta este valor según sea necesario */
        }


      /* Define la fuente con @font-face */
      
      @font-face {

          /*font-family: 'Roboto', sans-serif;
          font-family: 'Kalnia', serif;
          font-family: 'Inter', sans-serif;
          font-family: 'Ubuntu', sans-serif;
          font-family: 'Josefin Sans', sans-serif;
          font-family: 'Signika Negative', sans-serif;*/
          font-family: 'Montserrat', sans-serif;
     }

      /* Aplica la fuente a los elementos h1 */
      h1,h2,h3,h4,h5,h6,b,a,p {
          
           /*font-family: 'Roboto', sans-serif;
           font-family: 'Kalnia', serif;
           font-family: 'Inter', sans-serif;
         font-family: 'Ubuntu', sans-serif;
         font-family: 'Josefin Sans', sans-serif;
         font-family: 'Signika Negative', sans-serif;*/         
         font-family: 'Montserrat', sans-serif;
      }

      .tamano_font{
        font-size: 15px;
      }

      table td {
        font-size: 11px;
      }

      table th {
        font-size: 14px;
      }

      nav ul li a:hover h5 {
    color: var(--amarillo); /* Cambia 'tu_color_hover' por el color que desees para el efecto hover */
}
  

  </style>

  </head>
  <!--body style="padding: 3px; height: 100%;background-repeat: no-repeat;background: url(../img/logockmk1.png) no-repeat center center fixed; background-size: 100% 100%; "-->
  <body>
  
  <input type="hidden" id="txtcodusuario" value="<?php echo "$axcoduser";?>">
  <input type="hidden" id="txtid_py" value="<?php echo "$axid_py";?>">
  <br>
  <br>
  
  <nav class="navbar navbar-light fixed-top color_menu" style="padding: 0px">
    <div class="container">
    <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" id="bt_menu">
    <span class="navbar-toggler-icon"></span>
    </a>
    <!--a class="navbar-brand" href="../Form/Principal.php" ><i class="bi bi-shop" style="font-size: 30px;"></i></a-->
    <a class="navbar-brand" href="../Form/Principal.php" ><img src='../logo.png' style='width:160px; height: auto;'></a>

    <!------------------------------------------------------------------->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"  style="overflow: auto;border: 1px solid #ccc;">
    <div class="offcanvas-header">
    <h5 class="offcanvas-title text-danger" id="offcanvasExampleLabel">Menú</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" >
    
    <b id="txtusuarioactual" class="color_letra_menu"> <i class="bi bi-person-circle ico_grande"></i> <?php echo "$axnombreusuario" ?></b>
    <hr>

    <nav class="sidebar"> 

    <ul>      

      <li><a href="#" id='mnu_appvendedores'><h5 class="color_letra_menu"><i class="bi bi-person-badge-fill"></i> <b class="tamano_font">APP Vendedores</b></h5></a></li>      
      <li id='mnu_lina_mk'><hr></li> 

      <li>
        <a href="#" id='mnu_compras' class="feat-btn"><h5 class="color_letra_menu"><i class="bi bi-cart-check-fill"></i><b class="tamano_font">Compras</b> 
        <span id="flecha_1" class="bi bi-caret-down-fill first"></span>
        </h5></a>
        <ul class="feat-show" id="mnu_compras_sub"> 
        <li id='mnu_lina_mk'><hr></li>                               
          <li id='mnu_cotizaciones'><a href="../Form/cotizaciones.php?id='PROVEEDOR'"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-filetype-doc"></i> Cotizaciones</h5></a></li>                    
          <li id='mnu_ordenes'><a href="../Form/orden_compra.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-file-earmark-post-fill"></i> Ordenes de compra</h5></a></li>
          <li id='mnu_registro'><a href="../Form/egresos.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-file-post"></i> Registro de compras</h5></a></li>
          <li id='mnu_registro'><a href="../Form/egresos_rendicion.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-piggy-bank-fill"></i> Rendiciones</h5></a></li>

          <li id='mnu_lina_mk'><hr></li> 
        </ul>        
      </li>


      <li>
        <a href="#" id='mnu_produccion' class="feat-btn"><h5 class="color_letra_menu"><i class="bi bi-boxes"></i><b class="tamano_font"> Producción y Ventas</b> 
        <span id="flecha_1" class="bi bi-caret-down-fill first"></span>
        </h5></a>
        <ul class="feat-show" id="mnu_produccion_sub"> 
        <li id='mnu_lina_mk'><hr></li>                                         
          <li id='mnu_control_produccion'><a href="../Form/Mis_prospectos.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-ui-checks-grid"></i> Control de producción</h5></a></li>
          <li id='mnu_prospeccion'><a href=""> <h5 class="color_letra_menu tamano_font"><i class="bi bi-cash-coin"></i> Facturación y ventas</h5></a></li>                                         
          <li id='mnu_prospeccion'><a href=""> <h5 class="color_letra_menu tamano_font"><i class="bi bi-calendar-date-fill"></i> Program. despachos</h5></a></li>                            

        </ul>        
      </li>     

      <li><hr></li>  

       <li>
        <a href="#" id='mnu_mantenimiento' class="feat-btn"><h5 class="color_letra_menu"><i class="fa-solid fa-gears"></i> <b class="tamano_font">Configuraciones</b>
        <span id="flecha_2" class="bi bi-caret-down-fill first"></span>  
        </h5></a>
        <ul  class="feat-show" id="mnu_mantenimiento_sub">  
        <li id="mnu_manto_8"><hr></li>                              
        <li id="mnu_manto_1"><a href="../Form/almacenes.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-buildings-fill"></i> Empresas</h5></a></li>
          <li id="mnu_manto_1"><a href="../Form/beneficiarios.php?id=CLIENTE"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-person-vcard-fill"></i> Clientes</h5></a></li>
          <li id="mnu_manto_1"><a href="../Form/beneficiarios.php?id=PROVEEDOR"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-person-square"></i> Proveedores</h5></a></li>
          <li id='mnu_lina_mk'><hr></li> 
          <li id="mnu_manto_2"><a href="../Form/productos.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-ui-checks"></i> Productos</h5></a></li>
          <li id="mnu_manto_3"><a href="../Form/categorias.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-list-ol"></i> Categorias</h5></a></li>
          <li id='mnu_lina_mk'><hr></li> 
          <li id="mnu_manto_4"><a href=""> <h5 class="color_letra_menu tamano_font"><i class="bi bi-bank2"></i> Cuentas bancarias</h5></a></li>
          <li id="mnu_manto_5"><a href=""> <h5 class="color_letra_menu tamano_font"><i class="bi bi-123"></i> Correlativos</h5></a></li>
          
          <li id="mnu_manto_6"><a href=""> <h5 class="color_letra_menu tamano_font"><i class="bi bi-truck"></i> Transportes</h5></a></li>
          <li id="mnu_manto_7"><a href="../Form/usuarios_listado.php"> <h5 class="color_letra_menu tamano_font"><i class="bi bi-people-fill"></i> Perfil de usuarios </h5></a></li>         
          <li id="mnu_manto_8"><hr></li>          
        </ul>        
      </li>

      
      <li><a href="../Form/Salir.php"><h5 class="color_letra_menu"><i class="bi bi-door-closed-fill"></i> <b class="tamano_font">Salir de app</b></h5></a></li>

    </ul>

    </nav>
    
    
    </div>
    </div>  
  <!------------------------------------------------------------------->
    <div class="btn-group">        
    <b id="txtusuarioactual" class="color_letra_menu"> <i class="bi bi-person-circle"></i> <?php echo "$axnombreusuario" ?></b>
    </div>
    </div>
  </nav>
  

<br>  
<!---------------------------------------------------------->
  
  <!--script src="../js/jquery-3.1.1.min.js"></script-->
  <script src="../js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
  

    <!--script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script--> 

  </body>
</html>

<script type="text/javascript">


$(document).on("click", ".feat-btn", function () {
    // Identificador del menú clicado
    const menuId = $(this).attr('id');
    // Identificador del submenú correspondiente
    const subMenuId = `#${menuId}_sub`;

    // Recorre todos los menús y submenús
    $('.feat-btn').each(function () {
        const currentMenuId = $(this).attr('id');
        const currentSubMenuId = `#${currentMenuId}_sub`;
        const currentFlechaId = `#flecha_${currentMenuId.slice(-1)}`;

        // Verifica si el menú actual es el clicado
        const isClickedMenu = currentMenuId === menuId;

        // Verifica la clase actual de feat-show
        const tieneClaseShow = $(currentSubMenuId).hasClass('show');

        // Toggle de la clase show para el menú actual
        $(currentSubMenuId).toggleClass('show', isClickedMenu);

        // Toggle de la clase rotate para la flecha del menú actual
        $(currentFlechaId).toggleClass('rotate', isClickedMenu);

        // Si no es el menú clicado, oculta el submenú
        if (!isClickedMenu) {
            $(currentSubMenuId).removeClass('show');
            $(currentFlechaId).removeClass('rotate');
        }
    });
});





</script>


