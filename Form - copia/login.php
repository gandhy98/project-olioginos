

<?php 

session_start();

if(isset($_SESSION['userId'])) {
  header('location: principal.php'); 
}

  date_default_timezone_set("America/Lima");
  $diaactual =date("Y-m-d");
  $horaactual =date("H:i:s");

if(isset($_POST['txtUsuario'])) {
  require_once('../Conexion/conexion.php');
  $ruc=$_POST['txtRuc'];
  $ausuario=$_POST['txtUsuario'];
  $apassword=$_POST['txtContrasena'];
  //$diaactual =$_SESSION["diaactual"];

  $query = "SELECT * FROM USUARIOS_C WHERE  USUARIO= '".$ausuario."' AND CLAVE = '".$apassword."' AND ESTADO_HABILITADO='ACTIVO'";
  //echo $query;

  $result=odbc_exec($con,$query);
  
  if(odbc_num_rows($result) == 1) {

        $value = odbc_fetch_array($result);
        $user_id = $value['USUARIO'];
        $_SESSION['userId'] = $user_id;
        $_SESSION['diaactual']= date('Y-m-d');

     

        header('location: principal.php');  





  }  else {

      //echo $query;
    
      header('location: ../index.php');  

  }

} 

?>
