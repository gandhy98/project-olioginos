<?php require_once '../includes/header.php'; 
$tipo = $_GET['id'];

?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">
	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axcoduser";?>">


	<body>

	<br>
	<div class="card">
  	<div class="card-header">
	    <h5 id="titulo_formulario"></h5>	
  	</div>

  	<div class="card-body">

  		<div class="row g-3">
      	<div class="col-md-6">
				 	<div class="form-floating">
				   	<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar">
  					<label for="txtbuscar"><b>Buscar</b></label>
				 	</div>
				</div>
			</div>
			<p><br></p>
	    <div class="table-responsive" id="div_listar_categorias"></div>			

  	</div>
	</div>
<!--------------------------------------------->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Categorias</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      	<div class="row g-3">
      			<input type="hidden" class="form-control" id="txtid_categoria">


						<div class="col-md-6">
						<div class="form-floating">
						<select class="form-select" id="txtitipo_categoria" aria-label="Floating label select example">			        
						<option value="MATERIA PRIMA">MATERIA PRIMA</option>						
						<option value="PRODUCTO TERMINADO">PRODUCTO TERMINADO</option>												
						<option value="SERVICIOS">SERVICIOS</option>												
						</select>
						<label for="txtitipo_categoria"><b>Tipo de categoria</b></label>
						</div>
						</div>
			
				<div class="col-md-6">
				 	<div class="form-floating">
				   	<input type="text" class="form-control" id="txtnom_categoria" placeholder="Categoría">
  					<label for="txtnom_categoria"><b>Categoría</b></label>
				 	</div>
				</div>

				
		</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success"data-bs-dismiss="modal" id="btn_grabar" >Grabar</button>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>


		
<!--------------------------------------------->

</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso()
	listar_categorias();
});
/****************************/


$(document).on("click","#btn_editar_corr",function(){
	
var axid_categoria_1 = $(this).data('id')
$("#txtid_categoria").val(axid_categoria_1);

//alert(axid_corr_1)

var axid_categoria = $("#txtid_categoria").val();
$("#txtparametros").val(1);

$.ajax({
	url:"categorias_funciones.php",
	method: "POST",
	data: {param:199,txtid_categoria:axid_categoria},
		success : function(data){
		var json = JSON.parse(data);
			if (json.status == 200){
				
			$("#txtid_categoria").val(json.ID_CATEGORIA)
			$("#txtnom_categoria").val(json.NOM_CATEGORIA)
			$("#txtitipo_categoria").val(json.TIPO_CATEGORIA)
			$("#txtfamilia").val(json.FAMILIA)
			}
		}
	})

})



$(document).on("keyup","#txtbuscar",function(){
	listar_categorias()
})

$(document).on("click","#bnNuevo",function(){

	$("#txtparametros").val(0);	
})


$(document).on("click","#btn_grabar",function(){

var axid_categoria = $("#txtid_categoria").val();
var axnom_categoria = $("#txtnom_categoria").val();
var axitipo_categoria = $("#txtitipo_categoria").val();
var axfamilia = $("#txtfamilia").val();
var axparametros = $("#txtparametros").val();	


$.ajax({
			url:"categorias_funciones.php",
			method: "POST",
			data: {param:200,
			txtid_categoria:axid_categoria,
			txtnom_categoria:axnom_categoria,
			txtitipo_categoria:axitipo_categoria,
			txtfamilia:axfamilia,
			txtparametros:axparametros
			},
			success : function(data){

				if(data==0){
						listar_categorias();
				}else{
						Swal.fire('Aviso!','No se grabo el regsitro','error')
				}
			}
		})



})

function listar_categorias(){

	var axbuscaregistro = $("#txtbuscar").val();		
		$.ajax({

			url:"categorias_funciones.php",
			method: "POST",
			data: {param:198,txtbuscar:axbuscaregistro},
				
				success : function(data){

					$("#div_listar_categorias").html(data);
			}
		})
	}


function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();
	//alert(axtipo_beneficiario)
	var axpermiso = 'Categorias';

	$("#titulo_formulario").html("<i class='bi bi-list-task'></i> "+axpermiso +" <button type='button' id='bnNuevo'  class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal'><i class='fa-solid fa-circle-plus'></i> Nuevo</button>")
	
	$.ajax({
		url:"categorias_funciones.php",
		method: "POST",
		data: {param:0,txtcodusuario:axiduser,axpermiso:axpermiso},
		success : function(permiso){

			if (permiso==1){

				

				Swal.fire({
				  title: 'Acceso denegado',
				  text: "¡No tienes acceso a este módulo!",
				  icon: 'warning',
				  showCancelButton: false,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: '¡El módulo se cerrará!'
				}).then((result) => {
				  if (result.isConfirmed) {
				     window.location="principal.php";
				  }
				})
			

			} 
		}
		})

}

/************************************/










</script>