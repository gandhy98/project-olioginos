<?php  
$tipo = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/style_login.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>CRM Gestión</title>
    <link rel="shortcut icon" href="favicon_1.ico"/>
</head>

<style type="text/css">
    

      /* Define la fuente con @font-face */
      
      @font-face {

          font-family: 'Montserrat', sans-serif;
     }

      /* Aplica la fuente a los elementos h1 */
      h1,h2,h3,h4,h5,h6,b,a,p {
         
         font-family: 'Montserrat', sans-serif;
      }


</style>

<body>


    <div class="container-form login">
        <div class="information">
            <div class="info-childs">
                <img src="img/logo.jpeg">
                <h2>Bienvenido de vuelta<br></h2>
                <br>                
                <h5 style="font-size:15px;">Restablecer la contraseña</h5>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <form class="form" method="POST" id="form_restablecer_clave">
                    <input type="hidden" id='txtRuc' name='txtRuc'placeholder="Ruc Empresa" value="20604484805" disabled>
                    <br>
                    <br>
                    <label >                        
                        <i class="bi bi-person-square"></i>
                        <input type="text" id='txtUsuario' name='txtUsuario' placeholder="Usuario"  value="<?php echo "$tipo";?>" disabled>
                    </label>
                    <label>
                        <i class='bx bx-lock-alt' ></i>
                        <input type="password" id='txtContrasena_nueva' name='txtContrasena_nueva' placeholder="Contraseña nueva">
                    </label>

                    <label>
                        <i class='bx bx-lock-alt' ></i>
                        <input type="password" id='txtContrasena_nueva_verificar' name='txtContrasena_nueva_verificar' placeholder="Contraseña nueva">
                    </label>
                    
                    <input type="button" id="btn_enviar_cambio" value="Crear contraseña">

                </form>
                <br>
                <br>
                <br>

                 <div id="aviso" >
                <p style="font-size: 10px; margin-top: 20px; color: white;" ><i class="bi bi-cc-circle"></i> 2019 - 2023 Plus Inmobiliaria RA. Todos los derechos reservados</p>    
            </div>  
            </div>

                     
        </div>
    </div>
    <script src="js/script_login.js"></script>
</body>
</html>

<script type="text/javascript">
    
$(document).on("click","#btn_enviar_cambio",function(){
    
         // Verificar campos vacíos
    if (verificar_campos_vacios()) {
        // Si hay campos vacíos, detener la ejecución
        return;
    } 


    var axRuc = $("#txtRuc").val();
    var axUsuario = $("#txtUsuario").val();
    var axContrasena_nueva = $("#txtContrasena_nueva").val();
    var axContrasena_nueva_verificar = $("#txtContrasena_nueva_verificar").val();

    if(axContrasena_nueva==axContrasena_nueva_verificar){

    $.ajax({

      url:"restablecer_clave_funciones.php",
      method: "POST",
      data: {
        txtRuc:axRuc,
        txtUsuario:axUsuario,
        txtContrasena_nueva:axContrasena_nueva,
        txtContrasena_nueva_verificar:axContrasena_nueva_verificar
      },
      success : function(data){

        if(data==0){

               window.open("index.php"); 

        }else{

            Swal.fire({
                title: "Aviso",
                text: "Error al intentar cambiar la contraseña",
                icon: "error"
            });
                
        }
                  

      }    
    });


    }else{

        Swal.fire({
          title: "Aviso",
          text: "Las contraseñas no coinciden",
          icon: "warning"
        });

    }

})


function verificar_campos_vacios() {
   var elementos = document.querySelectorAll('#form_restablecer_clave input, #form_restablecer_clave select');
    var camposVacios = false;

    for (var i = 0; i < elementos.length; i++) {
        if (elementos[i].value.trim() === '') {
            elementos[i].style.borderColor = 'red';
            camposVacios = true;
            Swal.fire({
                title: "Advertencia",
                text: "Éxisten campos en blanco...",
                icon: "warning"
            });
        } else {
            elementos[i].style.borderColor = '';
        }
    }

    return camposVacios;
}


</script>