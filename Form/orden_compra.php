<?php require_once '../includes/header.php'; 
$tipo = $_GET['id'];

?>

<!DOCTYPE html>
	<html>
	<head>
	</head>

<style type="text/css">
	.cabecera{
		
	margin-bottom: 5px;

    margin-left: 3px;
    margin-right: 3px;

    height: 25px;
    color: white;
    background: #0CB53B;

	}
	.cerrar{
		
		padding-left: 5px;
		padding-right: 5px;
		height: 25px;
		background: #b50c0c;
		font-weight: 900;
		color: white;
		border-color: white;


	}
	.ul{
    background-color: #000;
    cursor: pointer;;
    }

  .li{
    /*padding: 10px;*/
      display:block; 
      width:100%;
      padding: 3px 0px;
      color:#000;
      background-color:#DBEBF6;
      text-decoration:none;
  }

  .li:hover{
    /*padding: 10px;*/
      display:block; 
      width:100%;
      padding: 3px 0px;
      color:#000;
      background-color:#DBEBF6;
      text-decoration:none;
  }
		
		#ulproductos{
	    background-color: #000;
	    cursor: pointer;
	    }

		#liproductos{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#liproductos:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


		#linuevoregistro{

		 
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }

		#linuevoregistro:hover{
		 
		  display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;

		  }
			
		  #libeneficiarios{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#libeneficiarios:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }


		   #litransportista{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#DBEBF6;
		  text-decoration:none;
		  }


		#litransportista:hover{
		   /* padding: 10px;*/
		    display:block; 
		  width:100%;
		  padding: 3px 0px;
		  color:#000;
		  background-color:#356AA0;
		  text-decoration:none;
		  }

.table-danger{
	--bs-table-bg: #F3F4E8;
}	  

</style>


<body onload="mueveReloj()">
<br>

<div class="container-fluid" id="divcontenedor1" >
      
      	<input type="hidden" name="txtidempresa" id="txtidempresa" value="<?php echo "$axidempresa";?>">
      	<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
      	<input type="hidden" name="txtrucempresa" id="txtrucempresa" value="<?php echo "$axrucempresa";?>">
      	<input type="hidden" name="txtid_usuario" id="txtid_usuario" value="<?php echo "$axcoduser";?>">  
      	<input type="hidden" name="txtobservado" id="txtobservado" value="NORMAL">  
      	<input type="hidden" name="txtcomprobante_electronico" id="txtcomprobante_electronico" value="<?php echo "$axcomprobante_electro";?>">

      	<input type="hidden" name="txtruta_ap" id="txtruta_ap" value="<?php echo "$axruta_api";?>">
      	<input type="hidden" name="txttoken" id="txttoken" value="<?php echo "$axtoken";?>">


      	
      	<input type="hidden" name="txtruta" id="txtruta" value="<?php echo "$axruta";?>">
      	<input type="hidden" name="txtruta_exc" id="txtruta_exc" value="<?php echo "$axruta_exc";?>">
      	<input type="hidden" name="txtruta_obs" id="txtruta_obs" value="<?php echo "$axruta_obs";?>">
      	<input type="hidden" name="txtruta_proc" id="txtruta_proc" value="<?php echo "$axruta_proc";?>">

      	<input type="hidden" name="txtruta_comprobantes_pdf" id="txtruta_comprobantes_pdf" value="<?php echo "$axruta_comprobantes";?>">

		
      	 
      	<input type="hidden" name="txttipocambio" id="txttipocambio">
		<input type="hidden" name="txthoraemision" id="txthoraemision">


		<input type="hidden" name="txtdestino_contable" id="txtdestino_contable" value="ABONO">
		<input type="hidden" name="txtestado_cierre" id="txtestado_cierre" value="ABIERTA">
		<input type="hidden" name="txtmotivo_devolucion" id="txtmotivo_devolucion" value="0">
		<input type="hidden" name="txtglosa" id="txtglosa" value="VENTA DE MERCADERIA Y PRODUCTOS">
		<input type="hidden" name="txtpermiso_nc" id="txtpermiso_nc" value="SI">

	
		
		<input type="hidden" name="txtcodmovcz" id="txtcodmovcz">
		
		<input type="hidden" name="txttipo_ORDEN_COMPRA" id="txttipo_ORDEN_COMPRA"  value="<?php echo "$tipo";?>">
		


		<input type="hidden" name="txtcod_contable" id="txtcod_contable" value="0">
		

		<input type="hidden" name="txttipomov" id="txttipomov" value="SALIDA">
		<input type="hidden" name="txtdetallemov" id="txtdetallemov" value="VENTA">
		
		
		<input type="hidden" name="txtparametros" id="txtparametros">
		<input type="hidden" class="form-control" id="txtdireccion">
		<input type="hidden" class="form-control" id="txtanoactual">
		
		<!-- <input type="hidden" name="txtporc_igv" id="txtporc_igv" value="<?php echo "0.18";?>"> -->
		<input type="hidden" name="txtporc_igv" id="txtporc_igv" value="<?php echo "$axigvgeneral";?>">

	
		<input type="hidden" class="form-control" id="txtprecio_venta">
		<input type="hidden" class="form-control" id="txtprecio_compra">
		<input type="hidden" class="form-control" id="txtdscto_Venta" value="0">
		<input type="hidden" class="form-control" id="txtvalor_venta">
		<input type="hidden" class="form-control" id="txtigv_venta">
		<input type="hidden" class="form-control" id="txtgravadas_venta" >
		<input type="hidden" class="form-control" id="txtinafectas_venta" >		
		<input type="hidden" class="form-control" id="txtexonerada_venta" >
		<input type="hidden" class="form-control" id="txttotal_venta">			
		
		
		<input type="hidden" class="form-control" id="txtnomsubcategoria">
		<input type="hidden" class="form-control" id="txtidinsumo">
		<input type="hidden" class="form-control" id="txttipocondicion">
		<input type="hidden" name="txtperiodotranf" id="txtperiodotranf">		
		<input type="hidden" name="txtfiltro_busca_fecha" id="txtfiltro_busca_fecha" >		

		<input type="text" class="form-control" id="txtid_orden_cz">

		<input type="hidden" name="txtid_ORDEN_COMPRA_cz" id="txtid_ORDEN_COMPRA_cz">		
				
<input type="hidden" id="txtcodmovprof">


		<div id="divcabecera" >
			<div class="row">
			<div class="col-12" >

			<!--div class="card-header"-->
			<div class="card-header text-white bg-danger">
		  	
		  		<ul class="nav nav-tabs card-header-tabs"style="background: #ABEBC6;">
					<li class="nav-item">
					<a class="nav-link active" id="pnlistado" href="#"><b>Listado</b></a>
					</li>

					<li class="nav-item" id="lstdocumentos" style="display: none;">
					<a class="nav-link" id="pndocumentos" href="#"><b>Documentos</b></a>
					</li>

				</ul>
			</div>
			</div>
			</div>
		</div><!--div id="divcabecera"-->

		<div id="divlistado">
			<div class="row">
	        <div class="col-12">
	            <div class="card">
	              <div class="card-header">

				  	<img src="../icon/pedidos_gestion.png" style="width: 50px; height: 50px;"> 
	               <h5 class="d-inline" id="titulo_formulario">  	
					</h5>
	               		
					<!--
					###########################
					## MODIFICANDO GANDHY INICIO
					# hacer boton de nuevo
					#mdl_registrar_orden_compra
					###########################
					-->
					<!-- Modal -->
					<div class="modal fade" id="mdl_registrar_orden_compra" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-xl">
						<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="staticBackdropLabel">Registrar Orden de compra</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
								
							<div class="row g-3">

								

                                   <!--------------------------------->	
									
									
									<div class="col-md-4">
										<div class="form-floating">
										<input type="date" class="form-control" id="txtfecha_orden" style="text-align: center;" value="<?php echo "$diaactual";?>">				   	
										<label for="txtfecha_entrega"><b>Fecha orden</b></label>
										</div>
									</div>

									<div class="col-md-4">
										<div class="form-floating">
										<input type="text" class="form-control" id="txtnum_orden" placeholder="Num. orden">
										<label for="txtnum_orden"><b>Num. orden</b></label>
										</div>
									</div>
										

										
									<div class="col-md-4">
										<div class="form-floating">
										<select class="form-select" id="txtestado_orden_compra" aria-label="Floating label select example">			        
											<option value="PENDIENTE">PENDIENTE</option>						
											<option value="EJECUTADA">EJECUTADA</option>					
										</select>
										<label for="txtestado_orden_compra"><b>Estado <s></s></b></label>
										</div>
									</div>

									

									<div class="col-md-6">
										<div class="form-floating">
										<select class="form-select" id="txtid_beneficiario" aria-label="Floating label select example">
										<option value="">Seleccionar</option>
										<?php while($fila=odbc_fetch_array($RSProveedores)) {?>
										<option value="<?php echo $fila['ID_BENEFICIARIO'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
										</select>
										<label for="txtid_beneficiario"><b><i class="bi bi-person-square"></i> Proveedores</b></label>
										</div>			
									</div>

									<div class="col-md-3">
										<div class="form-floating">			
										<select id="txtmoneda" class="form-control custom-select mr-sm-2">			
										<option value="SOLES">SOLES</option>			
										<option value="DOLARES">DOLARES</option>			
										</select>
										<label for="txtmoneda"><i class="bi bi-bookmarks-fill"></i> Moneda</label>			
										</div>
									</div>


									
									<div class="col-md-3">
										<div class="form-floating">
										<select class="form-select" id="txtmedio_pago" aria-label="Floating label select example">				        
											<option value="EFECTIVO">EFECTIVO</option>						
											<option value="TRANSFERENCIA">TRANSFERENCIA</option>											
											<option value="DEPOSITO">DEPOSITO</option>											
											<option value="OTROS">OTROS</option>											
										</select>
										<label for="txtmedio_pago"><b>Medio pago</b></label>
										</div>
									</div>

																		<!--------------------------------->


									<div class="col-md-4">
										<div class="form-floating">
										<select class="form-select" id="txtid_cta" aria-label="Floating label select example">
										<option value="">Seleccionar</option>
										<?php while($fila=odbc_fetch_array($RSCtas)) {?>
										<option value="<?php echo $fila['ID_CTA'];?>"><?php echo $fila['NUM_CUENTA'];?></option><?php } ?>
										</select>
										<label for="txtid_cta"><b><i class="bi bi-hash"></i>Cta Bancaria</b></label>
										</div>
									</div>
								
									<div class="col-md-8 text-end" style="margin-top: 10px;">
										<button type="button" class="btn btn-outline-success "  id="btn_guardar_orden" data-bs-dismiss="modal"><i class="fas fa-save"></i> Guardar</button>
										<button type="button" class="btn btn-outline-danger " data-bs-dismiss="modal"><i class="fas fa-door-closed" ></i> Cerrar</button>
						
									</div>

							
									
									
							</div>

						</div>
						
						</div>
					</div>
					</div>



					<!-- Modal -->
					<!--
					###########################
					## MODIFICANDO GANDHY FIN
					# hacer boton de nuevo
					###########################
					-->

					<button type="button" id="btn_importar_cotizacion"  class="btn btn-outline-success btn-sm">Importar <i class="far fa-file"></i></button>	               		
	               	


	              <div class="row">

								<div class="form-group col-md-3">
						    <label for="txtidlocal"><b>Local</b></label>
								<select class="form-control form-control-sm custom-select mr-sm-2" id="txtidlocal">
								<!--option value="">Seleccionar </option-->
								<?php while($fila=odbc_fetch_array($rslocales)) {?>
		    				<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
		    				</select>
								</div>

								<div class="form-group col-md-3">								
								<label for="txtbuscar"><b>Buscar</b></label>
								<div class="input-group mb-3">
								<input type="text" class="form-control" id="txtbuscar" name="txtbuscar" aria-describedby="basic-addon3" placeholder="Buscar Orden">	
								<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><a href="#" id="btn_buscar"><i class="fas fa-search"></i></a></span>
								</div>
								</div>
								</div>
							
								<div class="form-group col-md-2">
								<label for="txtbuscar"><b>Fecha</b></label>
								<div class="input-group mb-3">								
								<input type="date" class="form-control" id="txtfecharegistro" style="text-align: center;" value="<?php echo "$diaactual";?>">
								<div class="input-group-append">
								<span class="input-group-text" id="basic-addon2"><a href="#" id="btbuscar_fechas"><i class="fas fa-search"></i></a></span>
								</div>
								</div>
								</div>

								<div class="form-group col-md-2">
								<label for="txtbuscar"><b>Hora</b></label>							
								<form name="form_reloj">
								<b><input type="text" style="text-align: center; color: red;" class="form-control" id="reloj" name="reloj" aria-describedby="basic-addon3"></b>
								<!--button class="btn btn-outline-success" onclick="exportTableToExcel('tblistagastos')">Excel</button-->
								</form>
								</div>						

								<div class="form-group col-md-2">
					    	<label for="txtperiodo"><b>Periodo</b></label>
					    	<input type="text" class="form-control" id="txtperiodocontable" style="text-align: center;" placeholder="mm-aaaa">	
					    	<input type="hidden" class="form-control" id="txtperiodo" value="ORDEN_COMPRA">									
				    		</div>
								
								</div>

			

					</div>
	  		
<div class="card-body">

	                	<div class="text-center" id="ajaxgif_3" hidden>
										  <div class="spinner-border" role="status">
										    <span class="sr-only">Loading...</span>
										  </div>
										</div>

<div id="lista1" style="font-size:10pt;"></div>	  
							<!------------------>
	<div id="formulario_egresos_dt" hidden>
		
		<div class="bg-success" style="padding: 5px; text-align: center; color: white;">
	    <h4>Detalle de Compra (Ingreso de Mercaderías)</h4>		
	    </div>
		<p><hr></p>	
		<input type="hidden" class="form-control" id="txtcod_mov_dt">
		<input type="hidden" class="form-control" id="txtid_producto">
		<input type="hidden" class="form-control" id="txtafectacion">

		<div class="row g-3">
		<div class="col-md-3">
	    	<div class="form-floating">	
	        <input type="text" class="form-control" id="txtnom_producto" placeholder="Productos" oninput="convertirAMayusculas(this)">			  
			<label for="txtnom_producto"><b><i class="bi bi-box-seam"></i>  Productos</b></label>
			</div>
			<div id="listar_productos_servicios"></div>
	    </div>

	    <div class="col-md-3">
	   		<div class="form-floating">	
			<input type="text" class="form-control" id="txtcant_ingreso" placeholder="Tipo de cambio" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txtcant_ingreso"><b><i class="bi bi-hash"></i> Cantidad</b></label>
			</div>
	    </div>

   		    		
    	<div class="col-md-3">
    		<div class="form-floating">	
    		<input type="text" class="form-control" id="txtcosto_producto" placeholder="Costo sin IGV" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txtcosto_producto"><b><i class="bi bi-hash"></i>  Costo sin IGV </b></label>
			</div>
    	</div>
   		<div class="col-md-3">
    		<div class="form-floating">	
    		<input type="text" class="form-control" id="txtvalor_ingreso" placeholder="Valor de Compra" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
		    <label for="txtvalor_ingreso"><b><i class="bi bi-hash"></i>  Valor de Compra </b></label>
			</div>
	    </div>
  		<div class="col-md-3">
    		<div class="form-floating">	
     		<input type="text" class="form-control" id="txtigv_ingreso" placeholder="IGV" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txtigv_ingreso"><b><i class="bi bi-hash"></i>  IGV </b></label>
			</div>
	    </div>
	    <div class="col-md-3" hidden>
	    	<div class="form-floating">	
	    	<input type="text" class="form-control" id="txtgravadas_ingreso" placeholder="Gravadas" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txtgravadas_ingreso"><b><i class="bi bi-hash"></i>  Gravadas </b></label>
			</div>
	    </div>
   		<div class="col-md-3" hidden>
    		<div class="form-floating">	
   		    <input type="text" class="form-control" id="txtinafecto_ingresos" placeholder="Inafectos" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txtinafecto_ingresos"><b><i class="bi bi-hash"></i>  Inafectos</b></label>
			</div>
	    </div>
	    <div class="col-md-3" hidden>
	    	<div class="form-floating">	
	    	<input type="text" class="form-control" id="txtexonerado_ingreso" placeholder="Exoneradas" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txtexonerado_ingreso"><b><i class="bi bi-hash"></i>  Exoneradas </b></label>
			</div>
	    </div>	
	
	    <div class="col-md-3">
	    	<div class="form-floating">	
	    	<input type="text" class="form-control" id="txttotal_ingreso" placeholder="Total Compra" style="text-align: right;" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
			<label for="txttotal_ingreso"><b><i class="bi bi-hash"></i>  Total Compra </b></label>
			</div>
	    </div>
		<div class="col-md-12" style="text-align: right; padding: 	5px;">
			<button type="button" class="btn btn-outline-success btn-lg"  id="btn_agregar_detallar_compra"><i class="bi bi-plus-circle-fill"></i> Agregar</button>			
			<button type="button" class="btn btn-outline-danger btn-lg" id="btn_cerrar_compra_dt"><i class="fas fa-door-closed" ></i> Cerrar</button>
		</div>

	    <br>
	    	
		<div  id="lista_detalle_compra_dt" ></div>	




	</div><!--div id="formulario_egresos_dt" hidden-->		




							<!----------------------------->






	                
	                
	                </div>
	                
	            </div>    
	          	
	          			
	        </div>
	       </div>
		</div><!--div id="divlistado"-->

</div><!--div class="container-fluid" id="divcontenedor1"-->

<div class="container-fluid" id="divcontenedor2" style="display: none;" >

<div class="card" id="divcontenedor3">
	
		


<div class="card-body border border-primary">



<br>

</div>
</div>
</div>
<!------------------------------------------------------------------------------------------------->



<!------------------------------------------------------------------------------------------------->
</body>
</html>	

<script type="text/javascript">

$(document).ready(function() {	
	Verifica_permiso();	
	listar_orden_cz()

});
/*************************************/ 






/*
###########################
## MODIFICANDO GANDHY INICIO
+ evento se activa cuando ponemos cantidad
+
###########################
**/

// genera tabla 
function listar_detalle_compra() {

var axcod_mov  = $("#txtcod_mov").val()
var axid_local = $("#txtid_local").val();
var axbuscar_dt = $("#txtbuscar_dt").val();

$.ajax({
	  url:"egresos_funciones.php",
	  method: "POST",
	  data: {param:31,
		  txtcod_mov:axcod_mov,
		txtid_local:axid_local,
		txtbuscar_dt:axbuscar_dt
	  },
	  success : function(data){	      	
		$('#lista_detalle_compra_dt').html(data);
	  }
	});
}
// meter e ntro de unpreloadrer
listar_detalle_compra() 

$(document).on("click","#btn_agregar_detallar_compra",function(){

	$("#txtparametros").val(1);

	var axcod_mov  = $("#txtcod_mov").val()
	var axcod_mov_dt  = $("#txtcod_mov_dt").val()
	var axid_local  = $("#txtid_local").val()

	var axid_producto  = $("#txtid_producto").val()
	var axcant_ingreso  = $("#txtcant_ingreso").val()
	var axcosto_producto  = $("#txtcosto_producto").val()
	var axdsctos_ingreso  = $("#txtdsctos_ingreso").val()
	var axvalor_ingreso  = $("#txtvalor_ingreso").val()
	var axigv_ingreso  = $("#txtigv_ingreso").val()
	var axgravadas_ingreso  = $("#txtgravadas_ingreso").val()
	var axinafecto_ingresos  = $("#txtinafecto_ingresos").val()
	var axexonerado_ingreso  = $("#txtexonerado_ingreso").val()
	var axtotal_ingreso  = $("#txttotal_ingreso").val()

	var axcant_salida= $("#txtcant_salida").val()
	var axprs_mayor= $("#txtprs_mayor").val()
	var axprs_premiun= $("#txtprs_premiun").val()
	var axprs_menor= $("#txtprs_menor").val()
	var axdsctos_salida= $("#txtdsctos_salida").val()
	var axvalor_salida= $("#txtvalor_salida").val()
	var axigv_salida= $("#txtigv_salida").val()
	var axgravadas_salida= $("#txtgravadas_salida").val()
	var axinafecto_salida= $("#txtinafecto_salida").val()
	var axexonerado_salida= $("#txtexonerado_salida").val()
	var axtotal_salida= $("#txttotal_salida").val()

	var axforma_pago = $("#txtforma_pago").val();
	var axdias_pago = $("#txtdias_pago").val();

	var axestado_forma_pago = $("#txtestado_forma_pago").val();		
	var axmedio_pago = $("#txtmedio_pago").val();
	var axnum_transf = $("#txtnum_transf").val();
	var axpor_detraccion = $("#txtpor_detraccion").val();
	var axmonto_detraccion = $("#txtmonto_detraccion").val();
	var axnum_detraccion = $("#txtnum_detraccion").val();

	var axfecha_detraccion = $("#txtfecha_detraccion").val();
	var axestado_producto = $("#txtestado_producto").val();
	var axobservar = $("#txtobservar").val();
	var axfecha_transf = $("#txtfecha_transf").val();
	var axid_cta = $("#txtid_cta").val();
	var axperiodo_transf = $("#txtperiodo_transf").val();
	var axparametros = $("#txtparametros").val();
	var axdetalle_ingreso = $("#txtdetalle_ingreso").val()
	var axvalor = $("#txtvalor").val()

	if(axid_producto==''){
		Swal.fire('Aviso!','Ingrese el producto...','warning')
		document.getElementById('txtnom_producto').focus();


	}else{

		$.ajax({

		url:"orden_compra_funciones.php",
		method: "POST",
		data: {param:7,

			txtcod_mov:0,
			txtcod_mov_dt:axcod_mov_dt,
			txtid_producto:axid_producto,
			txtcant_ingreso:axcant_ingreso,
			txtcosto_producto:axcosto_producto,
			txtdsctos_ingreso:0,
			txtvalor_ingreso:axvalor_ingreso,
			txtigv_ingreso:axigv_ingreso,
			txtgravadas_ingreso:axgravadas_ingreso,
			txtinafecto_ingresos:axinafecto_ingresos,
			txtexonerado_ingreso:axexonerado_ingreso,
			txttotal_ingreso:axtotal_ingreso,
			txtcant_salida:0,
			txtprs_mayor:0,
			txtprs_premiun:0,
			txtprs_menor:0,
			txtdsctos_salida:0,
			txtvalor_salida:0,
			txtigv_salida:0,
			txtgravadas_salida:0,
			txtinafecto_salida:0,
			txtexonerado_salida:0,
			txttotal_salida:0,
			txtforma_pago:0,
			txtdias_pago:0,			
			txtestado_forma_pago:0,
			txtmedio_pago:axmedio_pago,
			txtnum_transf:0,
			txtpor_detraccion:0,
			txtmonto_detraccion:0,
			txtnum_detraccion:0,
			txtfecha_detraccion:0,
			txtestado_producto:0,
			txtobservar:0,
			txtfecha_transf:0,
			txtid_cta:axid_cta,
			txtperiodo_transf:0,
			txtid_local:0,
			txtvalor:0,
			txtparametros:axparametros
		},			
		success : function(data){

			console.log(data);
			// break;
			if(data==0){
				Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Registro guardado...',
				showConfirmButton: false,
				timer: 500
				})

				$("#txtnom_producto").val('')
				$("#txtcant_ingreso").val('0.00')
				$("#txtcosto_producto").val('0.00')
				$("#txtdsctos_ingreso").val('0.00')
				$("#txtvalor_ingreso").val('0.00')
				$("#txtigv_ingreso").val('0.00')
				$("#txtgravadas_ingreso").val('0.00')
				$("#txtinafecto_ingresos").val('0.00')
				$("#txtexonerado_ingreso").val('0.00')
				$("#txttotal_ingreso").val('0.00')
				$("#txtvalor").val('POSITIVO')

				listar_detalle_compra();
				document.getElementById('txtnom_producto').focus();
			}else{
				Swal.fire('Aviso!','El registro No se guardo...','error')
			}

		}
	})

	}


})


// boton genera total, pone igv

document.getElementById('txtcant_ingreso').addEventListener('keydown', inputcant);
function inputcant(event) {
  if (event.keyCode == 13) {
    document.getElementById('txtcosto_producto').focus();
  }
}


document.getElementById('txtcosto_producto').addEventListener('keydown', inputprecio);
function inputprecio(event) {
  if (event.keyCode == 13) {
    document.getElementById('txttotal_ingreso').focus();
  }
}



$(document).on("change","#txtcant_ingreso,#txtcosto_producto",function(){

	operaciones()
})

function operaciones(){

	// console prueba ejecutar
	console.log("operaciones")

	var axcant_ingreso  = $("#txtcant_ingreso").val()
	var axcosto_producto  = $("#txtcosto_producto").val()
	var axafectacion = $("#txtafectacion").val()
	// var axporc_igv = $("#txtporc_igv").val();
	var axporc_igv = 0.18;

	// probando!!
	console.log("operaciones", {axcant_ingreso,axcosto_producto,axafectacion,axporc_igv})

	if(axafectacion==''){

		Swal.fire("Aviso", "Ingrese el nombre del producto", "warning");						
		document.getElementById('txtnom_producto').focus();

	}else{

		if(axporc_igv==0 || axporc_igv==""){

			// traer_porc_igv();
		}


		if(axafectacion=='GRAVADA'){

			var axvalor_ingreso  = (parseFloat(axcant_ingreso)*parseFloat(axcosto_producto)).toFixed(2);
			var axigv_ingreso = parseFloat(axvalor_ingreso) * parseFloat(axporc_igv)
			//console.log(axigv_ingreso+'|'+axporc_igv)

			var axgravadas_ingreso = axvalor_ingreso;
			var axinafecto_ingresos = 0;
			var axexonerado_ingreso = 0;
			var axtotal_ingreso = (parseFloat(axvalor_ingreso) + parseFloat(axigv_ingreso)).toFixed(2);

		}else if(axafectacion=='EXONERADA'){

			var axvalor_ingreso  = (parseFloat(axcant_ingreso)*parseFloat(axcosto_producto)).toFixed(2);
			var axigv_ingreso = 0;
			var axgravadas_ingreso = 0
			var axinafecto_ingresos = axvalor_ingreso;;
			var axexonerado_ingreso = 0;
			var axtotal_ingreso = (parseFloat(axvalor_ingreso)+parseFloat(axigv_ingreso)).toFixed(2);

		}else if(axafectacion=='INAFECTO'){

			var axvalor_ingreso  = (parseFloat(axcant_ingreso)*parseFloat(axcosto_producto)).toFixed(2);
			var axigv_ingreso = 0
			var axgravadas_ingreso = 0;
			var axinafecto_ingresos = 0;
			var axexonerado_ingreso = axvalor_ingreso;;
			var axtotal_ingreso = (parseFloat(axvalor_ingreso)+parseFloat(axigv_ingreso)).toFixed(2);
		}


		$("#txtvalor_ingreso").val(parseFloat(axvalor_ingreso).toFixed(2));

		$("#txtigv_ingreso").val(parseFloat(axigv_ingreso).toFixed(2));
		// $("#txtigv_ingreso").val('0.18');

		$("#txtgravadas_ingreso").val(parseFloat(axgravadas_ingreso).toFixed(2));
		$("#txtinafecto_ingresos").val(parseFloat(axinafecto_ingresos).toFixed(2));
		$("#txtexonerado_ingreso").val(parseFloat(axexonerado_ingreso).toFixed(2));
		$("#txttotal_ingreso").val(parseFloat(axtotal_ingreso).toFixed(2));


	}

}

function traer_porc_igv() {
	var axid_td = $("#txtid_td").val()

	$.ajax({
	    url:"egresos_funciones.php",
		method: "POST",
	    data: {param:33,txtid_td:axid_td},
	      success : function(data){	      	
	        var json = JSON.parse(data);
				if (json.status == 200){	
					$("#txtporc_igv").val(json.POR_IMPUESTO);
				}
	      }
	    });
}


/*
###########################
## MODIFICANDO GANDHY FIN
###########################
**/




$(document).on("click","#btn_listar_productos_egresos",function(){

var axid_producto_1 = $(this).data('id')
var axnom_producto = $(this).text()

$("#txtid_producto").val(axid_producto_1);
var axid_producto = $("#txtid_producto").val();

$.ajax({
	url:"orden_compra_funciones.php",
	method: "POST",
	data: {param:6,txtid_producto:axid_producto},		
	//dataType:'JSON',
	success : function(data){
	var json = JSON.parse(data);
		if (json.status == 200){	
					
			$("#txtnom_producto").val(json.NOM_PRODUCTO);
			$("#txtafectacion").val(json.ABREV_AFECTACION);
			$("#txtcosto_producto").val(json.PRECIO_COMPRA_SIGV);
			$("#listar_productos_servicios").fadeOut();
			document.getElementById('txtcant_ingreso').focus();
			
		}else{
			Swal.fire("Aviso", "El nombre registrado no existe...", "warning");						
		
		}
	}
})

})

$('#txtnom_producto').keyup(function(){

var axbuscar_dato = $("#txtnom_producto").val();
var axdetalle_movimiento = $("#txtdetalle_movimiento").val();
var axdetalle_ingreso = $("#txtdetalle_ingreso").val();


if (axbuscar_dato != '') {

  $.ajax({
	url:"orden_compra_funciones.php",
	method: "POST",
	data: {param:5,
		txtnom_producto:axbuscar_dato,
		txtdetalle_movimiento:axdetalle_movimiento,
		txtdetalle_ingreso:axdetalle_ingreso
	},
	success : function(data){
		$('#listar_productos_servicios').fadeIn();
	  $('#listar_productos_servicios').html(data);
	}
  });

}else{
	$("#listar_productos_servicios").fadeOut();
} 
});

$(document).on("click","#btn_editar_orden_cz",function(event){

	$("#txtid_orden_cz").val($(this).data('id'))
	$("#txtestado").val($(this).data('estado'))	
	$("#txtparametros").val(1) 


	var axtestado_orden_compra = $("#txtestado_orden_compra").val()
	var axid_orden_cz = $("#txtid_orden_cz").val()

	
	
	if(axtestado_orden_compra=='PENDIENTE'){

		$.ajax({
	    url:"orden_compra_funciones.php",
		method: "POST",
	    data: {param:4,txtid_orden_cz:axid_orden_cz},	

	      success : function(data){	      	
	        var json = JSON.parse(data);
				if (json.status == 200){	

					//$("#txtid_orden_cz").val(json.ESTADO_FORMA_PAGO)
					$("#txtnum_orden").val(json.NUM_ORDEN_COMPRA)
					$("#txtfecha_orden").val(json.FECHA_ORDEN)
					$("#txtmoneda").val(json.MONEDA)
					$("#txtid_beneficiario").val(json.ID_BENEFICIARIO)

					$("#txtestado_orden_compra").val(json.ESTADO_ORDEN_COMPRA)
					
					$("#txtid_cta").val(json.ID_CTA)
					$("#txtmedio_pago").val(json.MEDIO_PAGO)
					$("#txtid_usuario").val(json.ID_USUARIO)
					$("#txtidlocal").val(json.ID_LOCAL)


			

				}
	      }
	    });

	}
	
	


})




$(document).on("click","#btn_buscartxtbuscar",function(event){
	listar_orden_cz();

})

function listar_orden_cz(){

var axbuscaregistro = $("#txtbuscar").val();		
var axid_local = $("#txtidlocal").val();	

	$.ajax({

		url:"orden_compra_funciones.php",
		method: "POST",
		data: {param:3,
			txtbuscar:axbuscaregistro,
			txtidlocal:axid_local				
			},
			
			success : function(data){

				$("#lista1").html(data);
		}
	})
}

/*
###########################
## MODIFICANDO GANDHY INICIO
+
+
###########################
**/
$(document).on("click","#btn_nuevo",function(event){
   
	$("#txtparametros").val(0) 
})

$(document).on("click","#btn_guardar_orden",function(event){

	
var axid_orden_cz = $("#txtid_orden_cz").val()
var axtnum_orden = $("#txtnum_orden").val()
var axtfecha_orden = $("#txtfecha_orden").val()
var txtnum_transferencia = $("#txtnum_transferencia").val()
var axtfecha_transferencia = $("#txtfecha_transferencia").val()
var axtmoneda = $("#txtmoneda").val()
var axtid_beneficiario = $("#txtid_beneficiario").val()
var axtestado_orden_compra = $("#txtestado_orden_compra").val()
var axtestado_forma_pago = $("#txtestado_forma_pago").val()
var axtid_cta = $("#txtid_cta").val()
var axtmedio_pago = $("#txtmedio_pago").val()

var axparametros = $("#txtparametros").val() 
var axid_usuario = $("#txtid_usuario").val() 
var axid_local = $("#txtidlocal").val();	




$.ajax({
	      url:"orden_compra_funciones.php",
	      method: "POST",
	      data: {param:2,

			txtid_orden_cz:axid_orden_cz,
			txtnum_orden:axtnum_orden,
			txtfecha_orden:axtfecha_orden,
			txtnum_transferencia:txtnum_transferencia,
			txtfecha_transferencia:axtfecha_transferencia,
			txtmoneda:axtmoneda,
			txtid_beneficiario:axtid_beneficiario,
			txtestado_orden_compra:axtestado_orden_compra,
			txtestado_forma_pago:axtestado_forma_pago,
			txtid_cta:axtid_cta,
			txtmedio_pago:axtmedio_pago,
			txtid_usuario:axid_usuario,
			txtidlocal:axid_local,
			txtparametros:axparametros
	      },
	      success : function(data){
	      	console.log(data);
	      	if(data==0){

	      		Swal.fire({
				  position: 'center',
				  icon: 'success',
				  title: 'El registro se guardo satisfactoriamente',
				  showConfirmButton: false,
				  timer: 200
				})
				
				if(axparametros=='0'){
					
					$("#lista1").prop('hidden',true)
					$("#formulario_egresos_dt").prop('hidden',false)
				}else{
					$("#lista1").prop('hidden',false)
					listar_orden_cz()
				}

				

	      	}else{

	      		Swal.fire('Aviso!','No se grabo el registro...','error')

	      	}

	      }
	    });


})



function Verifica_permiso(){

var axiduser =$("#txtid_usuario").val();
var axpermiso ="ORDEN_COMPRA";

$("#titulo_formulario").html("<i class='bi bi-0-square-fill'></i>"+axpermiso +" <button type='button' id='btn_nuevo'  class='btn btn-outline-danger btn-sm' data-bs-toggle='modal' data-bs-target='#mdl_registrar_orden_compra'><i class='fa-solid fa-circle-plus'></i> Nuevo</button>")

$.ajax({
	url:"orden_compra_funciones.php",
	method: "POST",
	data: {param:1,txtid_usuario:axiduser,axpermiso:axpermiso},
	success : function(permiso){

		console.log(permiso)
		if (permiso==1){

			Swal.fire({
			  title: 'Acceso Denegado',
			  text: "Ustede no tiene acceso a este modulo¡",
			  type: 'warning',
			  showCancelButton: false,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Modulo se cerrara!'
			}).then((result) => {
			 	  window.location="principal.php";
			})	

		} 
	}
	})

}


/*
###########################
## MODIFICANDO GANDHY FIN
###########################
**/


/***************************************************/


function zeros( number, width )
{
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // siempre devuelve tipo cadena
}


function mueveReloj(){ 
   	momentoActual = new Date() 
   	hora = addZero(momentoActual.getHours());
   	minuto = addZero(momentoActual.getMinutes()); 
   	segundo = addZero(momentoActual.getSeconds()); 

   	horaImprimible = hora + ":" + minuto + ":" + segundo 
   	//horaImprimible = hora + ":" + minuto 

   	document.form_reloj.reloj.value = horaImprimible 
   	setTimeout("mueveReloj()",1000)
} 


function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

$("input[type=text]").focus(function(){	   
  this.select();
});

function guardarexcel_conceptos(){
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'

        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

        var table = 'tblconceptos';
        var name = 'ListaConceptosVendidos';

        if (!table.nodeType) table = document.getElementById(table)
         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
         window.location.href = uri + base64(format(template, ctx))
}


function exportTableToExcel(tblistagastos, filename = 'listadogastos'){

    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tblistagastos);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}


</script>



