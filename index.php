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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>APW | Gestión Comercial</title>
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body>


    <div class="container-form">

        <div class="information">
            <div class="info-childs">
                
                <img src="logo2.png" style="width: 240px;">
                <br>
                <br>
                <div><h3>Bienvenido de vuelta</h3></div>

                <div id="imagenes" style="padding: 15px;">

                    <a href="https://www.facebook.com/oleaginoperu?mibextid=LQQJ4d" target="_blank"><i class="bi bi-facebook" style="font-size:35px; color: #F49818; padding: 15px;"></i></a>
                    <a href="https://www.instagram.com/oleaginos?igshid=YzVkODRmOTdmMw==" target="_blank"><i class="bi bi-instagram" style="font-size:35px; color: #F49818; padding: 15px;"></i></a>

                </div>

                <div><p style="font-size:11px;">Para unirte a nuestra comunidad por favor Inicia Sesión con tus datos</p></div>
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <form class="form" method="POST" action="form/login.php">
                    <br>
                    <!--label >                        
                        <i class="bi bi-building-fill-lock"></i>
                        <input type="text" id='txtRuc' name='txtRuc'placeholder="Ruc Empresa" value="20604484805" disabled>
                    </label-->
                    <label >                        
                        <i class="bi bi-person-square"></i>
                        <input type="text" id='txtUsuario' name='txtUsuario' placeholder="Usuario">
                    </label>
                    <label>
                        <i class='bx bx-lock-alt' ></i>
                        <input type="password" id='txtContrasena' name='txtContrasena' placeholder="Contraseña">
                    </label>
                    <div style="text-align: left;"><p style="font-size: 12px;"><a href="#" id="btn_cambiar_clave" style="text-decoration: none; color: white;">¿Olvidaste la contraseña?</a></p></div>
                    <br>                    
                    <input type="submit" value="Iniciar sesión">
                    <br>
                    <br>
                    <br>              
                </form>
                <div id="aviso">
                <p style="font-size: 9px; color: white;" ><i class="bi bi-cc-circle"></i> 2024 Oleaginos. Todos los derechos reservados</p>    
                </div>            
            </div>
            

        </div>        
    </div>
    <script src="js/script_login.js"></script>
</body>
</html>

<script type="text/javascript">
    
$(document).on("click","#btn_cambiar_clave",function(){
    
    
    var axRuc = $("#txtRuc").val();
    var axUsuario = $("#txtUsuario").val();
    var verdeclado="#2DED1C";

    if(axUsuario==''){

        Swal.fire({
          title: "Aviso",
          text: "Ingrese el nombre de su USUARIO",
          icon: "warning"
        });

    }else{

        $.ajax({

          url:"funciones.php",
          method: "POST",
          data: {param:2,txtRuc:axRuc,txtUsuario:axUsuario },
          success : function(data){

            if(data==0){
                
                 $.ajax({
                  url:"Enviar_correos_usuarios.php",
                  method: "POST",
                  data: {
                    txtRuc:axRuc,
                    txtUsuario:axUsuario
                  },
                    success : function(data){

                            Swal.fire({
                            title: "Aviso",
                            text: "Se a enviado un link a su correo para el restablecimiento de su clave",
                            icon: "success"
                            });
                       
                    }    
                });

            }else if(data==6){

                Swal.fire({
                title: "Aviso",
                text: "El usuario se encuentra INACTIVO",
                icon: "warning"
                });


            }else if(data==7){

                Swal.fire({
                title: "Aviso",
                text: "El usuario fue dado de BAJA",
                icon: "error"
                });



            }else if(data==1){

                Swal.fire({
                title: "Aviso",
                text: "El usuario NO EXISTE",
                icon: "error"
                });
            }

            
        }    
        });

    }

})


</script>