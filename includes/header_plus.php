<?php
require_once '../includes/core.php'; 

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
   $axtiponegocio= $value['TIPO_NEGOCIO'];
   $axnom_user= $value['USUARIO'];
   $axarea_usuario= $value['NOM_AREA_USUARIO'];

   $sqltipo_caracteristica = "SELECT TIPO_CARACTERISTICA FROM MK_PROYECTOS_DT GROUP BY TIPO_CARACTERISTICA";
   $RSCaracteristicas=odbc_exec($con,$sqltipo_caracteristica);

}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Plus Inmobiliaria RA</title>

    <link rel="shortcut icon" href="../icon/favicon.ico"/>
    

    <!--font awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"

    />

    <!--css file-->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/estiloindex.css" />
  </head>
  <body>


    <div class="sidebar close">
      <div class="logo">
        <i class="fab fa-trade-federation"></i>
        <span class="logo-name">CRM Gestión</span>
      </div>

      <ul class="nav-list">
        <li>
          <div class="icon-link">
            <a href="#">
              <i class="fab fa-codepen"></i>
              <span class="link-name">Marketing</span>
            </a>
            <i class="fas fa-caret-down arrow"></i>
          </div>

          <ul class="sub-menu">
            <li><a href="#" class="link-name">Marketing</a></li>
            <li><a href="../Form/Prospecto.php">Prospectos</a></li>
            <li><a href="#">Campañas</a></li>
            <li><a href="#">Presupuestos</a></li>
          </ul>
        </li>

        <li>
          <div class="icon-link">
            <a href="#">
              <i class="fab fa-codepen"></i>
              <span class="link-name">Mantenimiento</span>
            </a>
            <i class="fas fa-caret-down arrow"></i>
          </div>

          <ul class="sub-menu">
            <li><a href="#" class="link-name">Mantenimiento</a></li>
            <li><a href="../Form/Proyectos.php">Proyectos</a></li>
            <li><a href="../Form/Captacion.php">Medio de captación</a></li>
            <li><a href="../Form/Canal.php">Canales</a></li>
          </ul>
        </li>

        <li>
          <div class="profile-details">
            <a href="../Form/Salir.php" style="text-decoration: none;">
            <div class="profile-content">
              <img src="../icon/proyectos.png" alt="" />
            </div>
            <div class="name-job">               
                <div class="name"><?php echo "$axnom_user" ?></div>
                <div class="job"><?php echo "$axarea_usuario" ?></div>
            </div>
            <i class="fas fa-right-to-bracket"></i>
         </a>
          </div>
        </li>
        

        
      </ul>
    </div>

    <div class="home-section">
      <div class="home-content">
        <i class="fas fa-bars"></i>
        <span class="text"> <?php echo "$axrazonsocial" ?></span>
        
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>
