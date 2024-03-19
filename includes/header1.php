
<?php 

require_once '../includes/core.php'; 

date_default_timezone_set("America/Lima");


$axusuario =  $_SESSION['userId'];
$diaactual =date("Y-m-d");
$diaactual_1 =date("d-m-Y");
$horaactual = date("g");
$anoactual = date("Y");
$axperiodo_actual=date("m-Y");

$query = "SELECT top 1 * FROM usuarios_c WHERE usuario= '".$axusuario."'";
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

   $sqltipo_caracteristica = "SELECT TIPO_CARACTERISTICA FROM MK_PROYECTOS_DT GROUP BY TIPO_CARACTERISTICA";
   $RSCaracteristicas=odbc_exec($con,$sqltipo_caracteristica);

   $sqlareas = "SELECT ID_AREA,AREA_ENCARGADO,AREA_TRABAJO FROM AREAS_TRABAJO ORDER BY AREA_TRABAJO ASC";
   $rsareas=odbc_exec($con,$sqlareas);

   $sqlproyectos_1 = "SELECT ID_PROYECTO,NOMBRE_CORTO_PY FROM MK_PROYECTOS WHERE ESTADO_PY='ACTIVO' AND ID_EMPRESA='$axidempresa'";
   $rsproyectos_1=odbc_exec($con,$sqlproyectos_1);

   $sqlcanales_1 = "SELECT ID_CANAL,DESCRIPCION_CANAL FROM MK_CANALES ORDER BY DESCRIPCION_CANAL ASC";
   $rscanales_1=odbc_exec($con,$sqlcanales_1);

   $sqlmedios_1 = "SELECT ID_MEDIO_CAPTACION,DESCRIPCION_MEDIO FROM MK_MEDIO_CAPTACION ORDER BY DESCRIPCION_MEDIO ASC";
   $rsmedios_1=odbc_exec($con,$sqlmedios_1);

   $sqluser_coordinador = "SELECT ID_USUARIO,NOM_USUARIO FROM USUARIO ORDER BY NOM_USUARIO ASC";
   $rsuser_coordinador=odbc_exec($con,$sqluser_coordinador);

   $SQLTipo_doc_ident_1 = "SELECT ID_DOC,DOC_IDENTIDAD FROM TB2_DOCIDENTIDAD ORDER BY DOC_IDENTIDAD ASC";
   $RSTipo_doc_ident_1=odbc_exec($con,$SQLTipo_doc_ident_1);
 
   $sqlejecutivos_venta = "SELECT ID_USUARIO,NOM_USUARIO FROM USUARIOS_EJECUTIVOS ORDER BY NOM_USUARIO ASC";
   $rsejecutivos_venta=odbc_exec($con,$sqlejecutivos_venta);

   $sqlasig_desviacion = "SELECT TIPO_DESVIACION FROM MK_DESVIACIONES GROUP BY TIPO_DESVIACION ASC";
   $rsasig_desviacion=odbc_exec($con,$sqlasig_desviacion);

 }
 
?>




<!doctype html>
<html lang="es">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">     
    <link rel="stylesheet" href="../css/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/estiloindex.css">
    <script src="../js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script type="text/javascript" src="../js/loader.js"></script> <!--LIBRERIA PARA GRAFICOS--->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



    <!--link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins"--> 

    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">     
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script--> <!--LIBRERIA PARA GRAFICOS--->

    <title>APW | GestiónComercial360 </title>        
    <link rel="shortcut icon" href="../icon/favicon_1.ico"/> 
    
    
  </head>
  
  <style type="text/css">

    @import url('https://fonts.googleapis.com/css?family=Poppins');
    
/* Definir variables */
:root {
  --amarillo: #F49818; /* Amarillo */
  --azul: #2B5170; /* azul */
  --fondo_blanco:  #FFF;
  --amarillo_bajito:#FBF1D1;
  
}

    *{
      margin: 0;
      padding: 0;
     /* user-select: none;*/
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;

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
          background: #D8E2DC;
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
          font-family: 'Young Serif';
          src: url('../font/YoungSerif-Regular.ttf') format('truetype'); /* Reemplaza 'ruta/a/YoungSerif-Regular.ttf' con la ruta real de tu archivo de fuente */
      }

      /* Aplica la fuente a los elementos h1 */
      h1,h2,h3,h4,h5,h6,b,a,p {
          font-family: 'Young Serif', sans-serif; /* Usa la fuente 'Young Serif' y proporciona una fuente de respaldo en caso de que la fuente no se cargue correctamente */
          /* Otros estilos para tus elementos h1, como tamaño de fuente, color, etc. */
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
  
  <nav class="navbar navbar-light fixed-top color_menu">
    <div class="container">
    <a class="btn btn-light" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" id="bt_menu">
    <span class="navbar-toggler-icon"></span>
    </a>
    <!--a class="navbar-brand" href="../Form/Principal.php" ><i class="bi bi-shop" style="font-size: 30px;"></i></a-->
    <a class="navbar-brand" href="../Form/Principal.php" ><img src='../icon/logo_sin_fondo.png' style='width:60px; height: 40px;'></a>

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
      <li>
        <a href="#" id='mnu_marketing' class="feat-btn"><h5 class="color_letra_menu"><i class="bi bi-mastodon"></i>  Gestión Marketing
        <span id="flecha_1" class="bi bi-caret-down-fill first"></span>
        </h5></a>
        <ul class="feat-show" id="mnu_marketing_sub">                      
          <li id='mnu_prospeccion'><a href="../Form/Prospeccion.php"> <h5 class="color_letra_menu"><i class="fa-solid fa-users"></i> Prospección</h5></a></li>
          <li id='mnu_campana'><a href="../Form/locales.php"> <h5 class="color_letra_menu"><i class="fa-solid fa-bullhorn"></i> Campañas</h5></a></li>
          <li id='mnu_presupuestos'><a href="../Form/locales.php"> <h5 class="color_letra_menu"><i class="fa-solid fa-filter-circle-dollar"></i> Presupuestos</h5></a></li>
          <li id='mnu_lina_mk'><hr></li>          
        </ul>        
      </li>

      <li id='mnu_comercial'><a href="../Form/dashboard.php"><h5 class="color_letra_menu"><i class="bi bi-cash-coin"></i> Gestión Comercial</h5></a></li>

       <li>
        <a href="#" id='mnu_mantenimiento' class="feat-btn"><h5 class="color_letra_menu"><i class="fa-solid fa-gears"></i> Mantenimiento
        <span id="flecha_2" class="bi bi-caret-down-fill first"></span>  
        </h5></a>
        <ul  class="feat-show" id="mnu_mantenimiento_sub">                      
          <li id="mnu_manto_1"><a href="../Form/Proyectos.php"> <h5 class="color_letra_menu"><i class="bi bi-building-fill-gear"></i> Proyectos</h5></a></li>
          <li id="mnu_manto_2"><a href="../Form/Canales.php"> <h5 class="color_letra_menu"><i class="fa-solid fa-eye"></i> Canales</h5></a></li>
          <li id="mnu_manto_3"><a href="../Form/Medios_captacion.php"> <h5 class="color_letra_menu"><i class="fa-solid fa-icons"></i> Medios de captación</h5></a></li>
          <li id="mnu_manto_4"><hr></li>
          <li id="mnu_manto_5"><a href="#"> <h5 class="color_letra_menu"> Clientes</h5></a></li>
          <li id="mnu_manto_6"><a href="#"> <h5 class="color_letra_menu"> Proveedores</h5></a></li>
          <li id="mnu_manto_7"><a href="#"> <h5 class="color_letra_menu"> Conceptos y Actividades</h5></a></li>
          
          <li id="mnu_manto_8"><hr></li>          
          <li id="mnu_manto_9"><a href="#"><h5 class="color_letra_menu"> Cuentas bancarias</h5></a></li>          
          <li id="mnu_manto_10"><a href="#"><h5 class="color_letra_menu"> Campañas y Premios</h5></a></li>          
          <li id="mnu_manto_11"><hr></li>
          <li id="mnu_manto_12"><a href="../Form/perfil_usuarios.php"><h5 class="color_letra_menu"><i class="bi bi-person-fill-gear" style="font-size: 25px;"></i> Perfil Usuarios</h5></a></li>
          <li id="mnu_manto_13"><a href="#"><h5 class="color_letra_menu"> Areas de trabajo</h5></a></li>
        </ul>        
      </li>

      <li><hr></li>
      <li><a href="../Form/Salir.php"><h5 class="color_letra_menu"><i class="bi bi-door-closed-fill"></i> Salir</h5></a></li>

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
  
  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script> 

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


