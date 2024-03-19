<?php require_once '../includes/header.php'; ?>


<!DOCTYPE html>
	<html>
	<head>
		    
	</head>
	
	<!--img src="../img/empresa.PNG" style="opacity: 0.2;"-->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<input type="hidden" name="txtparametros" id="txtparametros">
	<input type="hidden" name="txttipo_excel" id="txttipo_excel">
	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
	<!--input text="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>"-->

	
	

	<body>

	<br>
	<div class="card">
  	<div class="card-header">
	    <h5><i class="bi bi-box-seam"></i> Productos <button type="button" id="bnNuevo"  class="btn btn-outline-danger btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal'><i class="fa-solid fa-circle-plus"></i> Nuevo</button> 
		
		<!--button type="button" id="btn_categorias"  class="btn btn-outline-success btn-sm" data-bs-toggle='modal' data-bs-target='#exampleModal_1'><i class="fa-solid fa-circle-plus"></i> Categorias</button> <button type="button" id="btn_importar_excel_precios"  class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-arrow-up-fill"></i> Importar Lista Precios</button> <button type="button" id="btn_importar_excel_pesos"  class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-arrow-up-fill"></i> Importar Pesos </button> <button type="button" id="btn_importar_excel_precios_minimos"  class="btn btn-outline-success btn-sm"><i class="bi bi-file-earmark-arrow-up-fill"></i> Importar Precios Minimos </button-->
	</h5>	
  	</div>

  	<div class="card-body">

  		<div class="row g-3" id="div_campo_buscar">
			<div class="col-md-6">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar productos">
			<label for="txtbuscar"><b><i class="bi bi-search"></i> Buscar</b></label>
			</div>
			</div>
		</div>
		<br>
	    <div id="lista1"></div>

	    <div id="divsubirdocumentos" style="padding: 2px; font-size:10pt;" hidden>
		<div class="form-row">		
		<div class="principal">
		<form id="form_subir" action="">
		<div class="form-1-2">
		<label form="" >Subir archivo</label>
		<input type="file" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  id="txtvoucherdigital" name="archivo" runat="server" /> 
		<input type="hidden" name="txtcod_mov_carga" id="txtcod_mov_carga">
		<input type="hidden" name="txtnomexcel" id="txtnomexcel">
		<input type="hidden" name="txtipo_archivo" id="txtipo_archivo" value="EXCEL">
		<input type="hidden" name="txtid_local_carga" id="txtid_local_carga">
		</div>
		<div class="barra">
		<div class="barra_azul" id="barra_estado">
		<span ></span>
		</div>
		</div>
		<br>
		<div class="acciones">					
		<div id="div_btn_cacnelar_procesar">
		<input type="submit" class='btn btn-outline-success btn-sm' id="btsubevoucher" value="Subir">
		<a href="#" class='btn btn-outline-primary btn-sm'  id="btn_procesar_actualizacion">Procesar</a>
		<a href="#" class='btn btn-outline-danger btn-sm'  id="btcerrar">Cerrar</a>
		</div>
	 	</div>
		</form>	
		</div>	
		</div>
	</div><!--div id="divsubirdocumentos" style="padding: 2px; font-size:10pt;" hidden-->			

  	</div>
	</div>
	<!-------------------------------------->
		
	<div class="modal" id="exampleModal">
  	<div class="modal-dialog modal-xl">
    <div class="modal-content">
      			
      	<div class="modal-header">
		    <h5 class="modal-title" id="exampleModalLabel">Registrar producto</h5>		    
		    </div>
		    	<input type="hidden" class="form-control" id="txtid_producto" placeholder="IdProducto">

				<div class="modal-body">	

				
					<div class="row g-3">

						<div class="col-md-6">
						<div class="form-floating">
						<select class="form-select campo" id="txtid_categoria" onkeydown="siguienteCampo(event)" aria-label="Floating label select example">				        
						<option selected>Seleccionar</option>
						<?php while($fila=odbc_fetch_array($rscategorias)) {?>
				    	<option value="<?php echo $fila['ID_CATEGORIA'];?>"><?php echo $fila['NOM_CATEGORIA'];?></option><?php } ?>
						</select>
						<label for="txtid_categoria"><b>Categorias</b></label>
						</div>
						</div>

						<div class="col-md-3">
					  	<div class="form-floating">
					    	<input type="text" class="form-control campo" onkeydown="siguienteCampo(event)" id="txtcod_producto" placeholder="Cód Producto">
  							<label for="txtcod_producto"><b>Cód Producto</b></label>
					  	</div>
						</div>	

						<div class="col-md-3">
						<div class="form-floating">
						<select class="form-select campo" id="txtestado_producto" onkeydown="siguienteCampo(event)" aria-label="Floating label select example">				        
						<option value="ACTIVO">ACTIVO</option>						
						<option value="INACTIVO">INACTIVO</option>												
						</select>
						<label for="txtestado_producto"><b>Estado</b></label>
						</div>
						</div>

							

						
					</div>

					<br>
					<div class="row g-3">
			

						<div class="col-md-6">
					  	<div class="form-floating">
					    	<input type="text" class="form-control campo" id="txtnom_producto" onkeydown="siguienteCampo(event)" placeholder="Nombre del Producto">
  							<label for="txtnom_producto"><b>Nombre del Producto</b></label>
					  	</div>
						</div>
								
						<div class="col-md-3">
						<div class="form-floating">
						<input type="text" class="form-control campo" id="txtpresentacion" onkeydown="siguienteCampo(event)" placeholder="Unidad">
						<label for="txtpresentacion"><b>Unidad</b></label>
						</div>
						</div>


						<div class="col-md-3">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtpeso_producto" onkeydown="siguienteCampo(event)" placeholder="Peso"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtpeso_producto"><b>Peso</b></label>
					  	</div>
						</div>


						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtcosto_producto_sin" onkeydown="siguienteCampo(event)" placeholder="Costo sin IGV"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtcosto_producto_sin"><b>Costo sin IGV</b></label>
					  	</div>
						</div>	

						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtigv_costo" onkeydown="siguienteCampo(event)" placeholder="IGV Costo"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtigv_costo"><b>IGV Costo</b></label>
					  	</div>
						</div>	

						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtcosto_producto" onkeydown="siguienteCampo(event)" placeholder="Costo Producto Inc. IGV"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00" >
  							<label for="txtcosto_producto"><b>Costo Producto Inc. IGV</b></label>
					  	</div>
						</div>


						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtprecio_sin" onkeydown="siguienteCampo(event)" placeholder="Precios sin IGV"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtprecio_sin"><b>Precios sin IGV</b></label>
					  	</div>
						</div>	

						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtigv_prc_venta" onkeydown="siguienteCampo(event)" placeholder="IGV Precio"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtigv_prc_venta"><b>IGV Precio</b></label>
					  	</div>
						</div>	

						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtprecio_venta" onkeydown="siguienteCampo(event)" placeholder="Precio Venta"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtprecio_venta"><b>Precio Venta</b></label>
					  	</div>
						</div>	

						<div class="col-md-4">
						<div class="form-floating">
						<select class="form-select campo" id="txtid_afectacion" onkeydown="siguienteCampo(event)" aria-label="Floating label select example">				        
						<option selected>Seleccionar</option>
						<?php while($fila=odbc_fetch_array($RSAfectacion)) {?>
				    	<option value="<?php echo $fila['ID_AFECTACION'];?>"><?php echo $fila['ABREV_AFECTACION'];?></option><?php } ?>
						</select>
						<label for="txtid_afectacion"><b>Afectación Trib.</b></label>
						</div>
						</div>		
										

						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtstock_minimo" onkeydown="siguienteCampo(event)" placeholder="Stock Minimo"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtstock_minimo"><b>Stock Minimo</b></label>
					  	</div>
						</div>

						<div class="col-md-4">
					  	<div class="form-floating">					    	
					    	<input type="text" class="form-control campo" id="txtprecio_minimo" onkeydown="siguienteCampo(event)" placeholder="Precio Minimo"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
  							<label for="txtprecio_minimo"><b>Precio Minimo</b></label>
					  	</div>
						</div>						
		
											
					</div>
					<br>
					
				</div>
		    
		    <div class="modal-footer">
		    		<button type="button" class="btn btn-outline-success btn-sm campo" id="btn_grabar_productos" data-bs-dismiss="modal"><i class="fas fa-save"></i> Grabar</button>
					<button type="button" class="btn btn-outline-danger btn-sm campo" data-bs-dismiss="modal" id="btn_cerrar_modal"><i class="fas fa-door-closed" ></i> Cerrar</button>	
		    </div>

    		</div>
  			</div>
				</div>
	

</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	
	Verifica_permiso()
	listar_productos();
});
/****************************/

$(document).on("blur","#txtcosto_producto_sin",function(){
	regresamatrizjsonasync("select top 1 igv from parametros order by fecha desc","igvactual");
	console.log(igvactual[0].igv);
	$("#txtigv_costo").val(Math.round($(this).val()*igvactual[0].igv)/100);
	$("#txtcosto_producto").val(Math.round($(this).val()*(1+igvactual[0].igv/100)*100)/100);

})
$(document).on("blur","#txtigv_costo",function(){
	regresamatrizjsonasync("select top 1 igv from parametros order by fecha desc","igvactual");
	console.log(igvactual[0].igv);
	$("#txtcosto_producto_sin").val(Math.round($(this).val()/(igvactual[0].igv/100)*100)/100);
	$("#txtcosto_producto").val(Math.round($(this).val()*(1+igvactual[0].igv/100)/(igvactual[0].igv/100)*100)/100);

})
$(document).on("blur","#txtcosto_producto",function(){
	regresamatrizjsonasync("select top 1 igv from parametros order by fecha desc","igvactual");
	console.log(igvactual[0].igv);
	$("#txtigv_costo").val(Math.round($(this).val()*igvactual[0].igv/100/(1+igvactual[0].igv/100)*100)/100);
	$("#txtcosto_producto_sin").val(Math.round($(this).val()/(1+igvactual[0].igv/100)*100)/100);

})

$(document).on("blur","#txtprecio_sin",function(){
	regresamatrizjsonasync("select top 1 igv from parametros order by fecha desc","igvactual");
	console.log(igvactual[0].igv);
	$("#txtigv_prc_venta").val(Math.round($(this).val()*igvactual[0].igv/100*100)/100);
	$("#txtprecio_venta").val(Math.round($(this).val()*(1+igvactual[0].igv/100)*100)/100);

})
$(document).on("blur","#txtigv_prc_venta",function(){
	regresamatrizjsonasync("select top 1 igv from parametros order by fecha desc","igvactual");
	console.log(igvactual[0].igv);
	$("#txtprecio_sin").val(Math.round($(this).val()/(igvactual[0].igv/100)*100)/100);
	$("#txtprecio_venta").val(Math.round($(this).val()*(1+igvactual[0].igv/100)/(igvactual[0].igv/100)*100)/100);

})
$(document).on("blur","#txtprecio_venta",function(){
	regresamatrizjsonasync("select top 1 igv from parametros order by fecha desc","igvactual");
	console.log(igvactual[0].igv);
	$("#txtigv_prc_venta").val(Math.round($(this).val()*igvactual[0].igv/100/(1+igvactual[0].igv/100)*100)/100);
	$("#txtprecio_sin").val(Math.round($(this).val()/(1+igvactual[0].igv/100)*100)/100);

})

function siguienteCampo(event) {
            // Verifica si la tecla presionada es Enter
			console.log("entra aqui 1");
            if (event.key === 'Enter') {
				console.log("entra aqui 2");
                // Obtiene todos los campos de la clase 'campo'
                var campos = document.getElementsByClassName('campo');

                // Encuentra el índice del campo actual
                var indiceCampoActual = Array.from(campos).indexOf(document.activeElement);

                // Calcula el índice del siguiente campo
                var indiceSiguienteCampo = indiceCampoActual + 1;

                // Si el siguiente campo existe, asigna el foco a ese campo
                if (campos[indiceSiguienteCampo]) {
					console.log("entra aqui 3");
                    event.preventDefault(); // Evita que el formulario se envíe al presionar Enter
                    campos[indiceSiguienteCampo].focus();
                }
            }
        }

function regresamatrizjsonasync(sqljson,variable){//crea variables dinamicas en ejecucion
  //var variables;
  console.log("Entra aqui:");
  console.log(sqljson);
  var resultado;
  resultado=$.ajax({
      url: 'ejecutasqltabla.php',
      type: 'POST',
      data: {q: sqljson},
      async: false,

      beforeSend: function () {
                    //$("#mensajesis").html("Procesando, espere por favor...");
                    datosactualizado=0;
                    //$.ajaxblock();
                },
        success:function(response) {
			console.log(response);
          window[variable] = response.data.formulas;
          console.log("se procesa la variable: "+variable);
         
           
        }
    });
  
}

function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axpermiso ="PRODUCTOS";


	$.ajax({
	url:"productos_funciones.php",
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



$(document).on("keyup","#txtbuscar",function(){
	listar_productos();
})


$(document).on("click","#bnNuevo",function(){
	$("#txtparametros").val(1);
})

$(document).on("click","#btn_eliminar_producto",function(){

	var axid_producto_1 = $(this).data("id");
	$("#txtid_producto").val(axid_producto_1)

	var axid_producto = $("#txtid_producto").val()
	var axid_empresa = $("#txtid_empresa").val()


	Swal.fire({
	title: 'Estas seguro?',
	text: "No podrá revertir esto!",
	icon: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Si, Eliminar!'
	}).then((result) => {
	if (result.isConfirmed) {

		$.ajax({

			url:"productos_funciones.php",
			method: "POST",
			data: {param:16,txtid_producto:axid_producto,txtid_empresa:axid_empresa},
				success : function(data){
					console.log("este es el data:");
					console.log(data);
					//if(grabrempresa==0){
					if(data.substr(0,1)=='0'){ 	
						Swal.fire('Aviso!','El registro a sido eliminado','success')
						listar_productos();
					}else{
						Swal.fire('Aviso!','El registro No se elimino, primero debe eliminar los COMPLEMENTOS','error')
					}

				}
			})

	}
	})

	})


$(document).on("click","#btn_editar_producto",function(){

	var axid_producto_1 = $(this).data("id");
	$("#txtid_producto").val(axid_producto_1)

	var axid_producto = $("#txtid_producto").val()

	$("#txtparametros").val(2);

	$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:7,txtid_producto:axid_producto},	
		success : function(data){
			var json = JSON.parse(data);
				if (json.status == 200){

				$("#txtid_empresa").val(json.ID_EMPRESA);
				$("#txtid_producto").val(json.ID_PRODUCTO);
				$("#txtid_categoria").val(json.ID_CATEGORIA);
				$("#txtestado").val(json.ESTADO);
				$("#txtcod_producto").val(json.COD_PRODUCTO);
				$("#txtnom_producto").val(json.NOM_PRODUCTO);
				$("#txttipo").val(json.TIPO);
				$("#txtpresentacion").val(json.PRESENTACION);
				$("#txtprocedencia").val(json.PROCEDENCIA);
				$("#txtrotacion").val(json.ROTACION);
				$("#txtcant_caja").val(json.CANT_CAJA);
				$("#txtprs_menor").val(json.PRS_MENOR);
				$("#txtprecio_minimo").val(json.PRS_MINIMO);
				
				$("#txtprs_mayor").val(json.PRS_MAYOR);
				$("#txtprs_premium").val(json.PRS_PREMIUN);
				$("#txtcosto_producto").val(json.COSTO_PRODUCTO);
				$("#txtmargen_producto").val(json.MARGEN_PRODUCTO);
				$("#txtid_afectacion").val(json.ID_AFECTACION)
				$("#txtpeso_producto").val(json.PESO_PRODUCTO)
				$("#txtfactor_producto").val(json.FACTOR_PROD)


				$("#txtcosto_producto_sin").val(json.COSTO_PRODUCTO_SIN)
				$("#txtigv_costo").val(json.IGV_COSTO)
				$("#txtcosto_producto").val(json.COSTO_PRODUCTO)
				$("#txtprecio_sin").val(json.PRECIO_VENTA_SIN)
				$("#txtigv_prc_venta").val(json.IGV_PRC_VENTA)
				$("#txtprecio_venta").val(json.PRECIO_VENTA)
				$("#txtstock_minimo").val(json.STOCK_MINIMO)

				$("#txtestado_producto").val(json.ESTADO_PRODUCTO)


				
				
				}

		}
	})

	})


$(document).on("click","#btn_grabar_productos",function(){

	var axid_empresa = $("#txtid_empresa").val();
	var axid_producto = $("#txtid_producto").val();
	var axid_categoria = $("#txtid_categoria").val();
	var axestado = $("#txtestado_producto").val();
	var axcod_producto = $("#txtcod_producto").val();
	var axnom_producto = $("#txtnom_producto").val();
	var axtipo = $("#txttipo").val();
	var axpresentacion = $("#txtpresentacion").val();
	var axprocedencia = $("#txtprocedencia").val();
	var axrotacion = $("#txtrotacion").val();
	var axcant_caja = $("#txtcant_caja").val();
	var axprs_minimo = $("#txtprecio_minimo").val();
	var axprs_menor = $("#txtprs_menor").val();
	var axprs_mayor = $("#txtprs_mayor").val();
	var axprs_premium = $("#txtprs_premium").val();

	var axmargen_producto = $("#txtmargen_producto").val();
	var axid_afectacion =$("#txtid_afectacion").val()
	var axpeso_producto = $("#txtpeso_producto").val()
	var axfactor_producto = $("#txtfactor_producto").val()
	var axparamentro = $("#txtparametros").val();
	var axcosto_producto_sin = $("#txtcosto_producto_sin").val();
	var axigvcosto = $("#txtigv_costo").val();
	var axcosto_producto = $("#txtcosto_producto").val();
	var axprecio_sin = $("#txtprecio_sin").val();
	var axtigv_prc_venta = $("#txtigv_prc_venta").val();
	var axprecio_venta = $("#txtprecio_venta").val();
	var axstock_minimo = $("#txtstock_minimo").val();



	$.ajax({

		url:"productos_funciones.php",
		method: "POST",
		data: {param:8,
			
			txtid_empresa:axid_empresa,
			txtid_producto:axid_producto,
			txtid_categoria:axid_categoria,
			txtestado_producto:axestado,
			txtcod_producto:axcod_producto,
			txtnom_producto:axnom_producto,
			txttipo:axtipo,
			txtpresentacion:axpresentacion,
			txtprocedencia:axprocedencia,
			txtrotacion:axrotacion,
			txtcant_caja:axcant_caja,
			txtprs_menor:axprs_menor,
			txtprecio_minimo:axprs_minimo,
			txtprs_mayor:axprs_mayor,
			txtprs_premium:axprs_premium,
			txtcosto_producto:axcosto_producto,
			txtmargen_producto:axmargen_producto,
			txtid_afectacion:axid_afectacion,
			txtpeso_producto:axpeso_producto,
			txtfactor_producto:axfactor_producto,
			txtparametros:axparamentro,
			txtcosto_producto_sin:axcosto_producto_sin,
			txtigvcosto:axigvcosto,
			txtprecio_sin:axprecio_sin,
			txtigv_prc_venta:axtigv_prc_venta,
			txtprecio_venta:axprecio_venta,
			txtstock_minimo:axstock_minimo

			
		},
		
		success : function(grabrempresa){
			console.log("este es el grabrempresa:");
			console.log(grabrempresa);
			//if(grabrempresa==0){
			if(grabrempresa.substr(0,1)=='0'){ 	
				limpiar_modal()		
				listar_productos();
				
				Swal.fire({
				  position: "center",
				  icon: "success",
				  title: "El Registro de Grabo correctamente...",
				  showConfirmButton: false,
				  timer: 500
				});


			} else {
				
				Swal.fire('Aviso','No se grabo el regsitro...','error')

			}
		}
	})


	})


function limpiar_modal() {


	$("#txtid_empresa").val("");
	$("#txtid_producto").val("");
	$("#txtid_categoria").val("");
	$("#txtestado").val("");
	$("#txtcod_producto").val("");
	$("#txtnom_producto").val("");
	$("#txttipo").val("");
	$("#txtpresentacion").val("");
	$("#txtprocedencia").val("");
	$("#txtrotacion").val("");
	$("#txtcant_caja").val("");
	$("#txtprecio_minimo").val("");
	$("#txtprs_menor").val("");
	$("#txtprs_mayor").val("");
	$("#txtprs_premium").val("");

	$("#txtmargen_producto").val("");
	$("#txtid_afectacion").val("");
	$("#txtpeso_producto").val("");
	$("#txtfactor_producto").val("");
	$("#txtparametros").val("");
	$("#txtcosto_producto_sin").val("");
	$("#txtigv_costo").val("");
	$("#txtcosto_producto").val("");
	$("#txtprecio_sin").val("");
	$("#txtigv_prc_venta").val("");
	$("#txtprecio_venta").val("");
	$("#txtstock_minimo").val("");



	}

function listar_productos(){

	var axbuscaregistro = $("#txtbuscar").val();	
	var txtid_empresa = $("#txtid_empresa").val();	

		$.ajax({

			url:"productos_funciones.php",
			method: "POST",
			data: {param:6,txtbuscar:axbuscaregistro,txtid_empresa:txtid_empresa},
				
				success : function(data){

					$("#lista1").html(data);
			}
		})
	}


</script>