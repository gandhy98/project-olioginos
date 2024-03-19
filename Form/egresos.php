<?php require_once '../includes/header.php'; 
$tipo = $_GET['id'];

?>

<!DOCTYPE html>
<html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>

<input type="hidden" name="txtparametros" id="txtparametros">
<input type="hidden" name="txtcodusuario" id="txtcodusuario" value="<?php echo "$axiduser";?>">
<input type="hidden" name="txtid_empresa" id="txtid_empresa" value="<?php echo "$axidempresa";?>">
<input type="hidden" class="form-control text-danger" id="txtcod_mov">
<input type="hidden" class="form-control text-danger" id="txtvalor" value="POSITIVO">
<input type="hidden" class="form-control text-danger" id="txttipo_excel">

<body  onload="mueveReloj()">
<br>
<div class="col-12 border border-danger" style="padding: 10px; margin: 0;">	  	
<div class="card">
<div class="card-header"><h5 id="titulo_formulario"></h5></div>
<div class="card-body">

	<div class="row g-3" id="div_cabecera">
		<div class="col-md-4">
		<div class="form-floating">		
		<select class="form-select" id="txtid_local" aria-label="Floating label select example">
		<option selected>Seleccionar</option>
		<?php while($fila=odbc_fetch_array($rslocales)) {?>
		<option value="<?php echo $fila['ID_LOCAL'];?>"><?php echo $fila['RAZON_SOCIAL'];?></option><?php } ?>
		</select>
		<label for="txtid_local"><i class="bi bi-buildings-fill"></i> Almacenes</label>		
		</div>
		</div>

		<div class="col-md-4">
		<div class="form-floating">
		<input type="text" class="form-control" id="txtbuscar" placeholder="Buscar ">
		<label for="txtbuscar"><b><i class="bi bi-search"></i> Buscar</b></label>
		</div>
		</div>

		<div class="col-md-2">
		<div class="form-floating">
		<input type="date" class="form-control" id="txtfecha_actual" placeholder="Fec. Actual" value="<?php echo "$diaactual";?>" >
		<label  for="txtfecha_actual"><b><i class="bi bi-calendar-date-fill"></i> Fec. Actual</b></label>
		</div>					  
		</div>	

		<div class="col-md-2">
		<form name="form_reloj">
		<div class="form-floating">
		<input type="text" class="form-control text-danger" id="reloj" name="reloj" placeholder="Hora">
		<label  for="reloj"><b><i class="bi bi-clock-fill"></i> Hora</b></label>
		</div>
		</form>					  
		</div>
	</div>
	<br>
	<div  id="lista1"></div>

	<div id="formulario_egresos_cz" hidden>

		<h4 class="text-primary" id='nom_local' hidden></h4>			
		<div class="bg-danger" style="padding: 5px; text-align: center; color: white;">		
	    <h4>Registro de Compras y Gastos</h4>		
	    </div>
		<p><hr></p>	 

		<div class="row">
		  <div class="col-sm-4 mb-3 mb-sm-0">
		    <div class="card">
		      <div class="card-body">
		        
		        <div class="row g-3">

		        	<input type="hidden" class="form-control text-danger" id="txttipo_mov" value="EGRESO">		
					<input type="hidden" class="form-control" id="txtglosa" value="COMPRA DE MATERIA PRIMA">
					<input type="hidden" class="form-control" id="txtdetalle_ingreso"  value="MATERIA PRIMA" >

		        	<div class="col-md-6">
						<div class="form-floating">
						<select class="form-select" id="txtdetalle_movimiento" aria-label="Floating label select example" disabled>			
						<option value="COMPRA">COMPRA</option>
						<option value="GASTO">GASTO</option>				    
						</select>
						<label for="txtdetalle_movimiento"><i class="bi bi-cart-dash-fill"></i> Tipo mov</label>
						</div>
			    	</div>			    	

			    	<div class="col-md-6">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtnum_programacion" placeholder="Responsable" disabled>						
						<label for="txtnum_programacion"><i class="bi bi-person-fill-check"></i> Responsable</label>											
						</div>
						<div id="listar_programaciones"></div>						
			    	</div>

			    	<div class="col-md-6">
						<div class="form-floating">
						<input type="date" class="form-control" id="txtfecha_emision" placeholder="Fec. Emisión" value="<?php echo $diaactual;?>" >
						<label for="txtfecha_emision"><b><i class="bi bi-calendar-date-fill"></i> Fec. Emisión</b></label>
						</div>					  
					</div>
					<div class="col-md-6" >
						<div class="form-floating">						
						<select class="form-select" id="txtid_td" aria-label="Floating label select example">
						<option selected>Seleccionar</option>
						<?php while($fila=odbc_fetch_array($RStipo_doc_egresos)) {?>
						<option value="<?php echo $fila['ID_TD'];?>"><?php echo $fila['DETALLE_DOC'];?></option><?php } ?>
						</select>
						<label for="txtid_td"><b><i class="bi bi-file-earmark-text"></i> Tipo documento</b></label>						
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtporc_igv"  onKeypress="if (event.keyCode < 45 || event.keyCode >57) event.returnValue = false;" value="0.00">
						<label for="txtporc_igv"><b><i class="bi bi-percent"></i> Impuesto</b></label>
						</div>					  
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtn_serie" placeholder="0000" >
						<label for="txtn_serie"><b><i class="bi bi-123"></i> Serie</b></label>
						</div>					  
					</div>
					<div class="col-md-4">
						<div class="form-floating">
						<input type="text" class="form-control" id="txtdocumento" placeholder="00000000" >
						<label for="txtdocumento"><b><i class="bi bi-123"></i> Número</b></label>
						</div>					  
					</div>


		        </div>

		      </div>
		    </div>
		  </div>
		  <div class="col-sm-8">
		    <div class="card">
		      <div class="card-body">
		        	
		        	<div class="row g-3">

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
							<input type="text" class="form-control" id="txttipo_cambio" placeholder="Tipo de cambio">
							<label for="txttipo_cambio"><b><i class="bi bi-calendar-date-fill"></i> Tipo de cambio</b></label>
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

						<div class="col-md-4">
							<div class="form-floating">
							<select class="form-select" id="txtestado_forma_pago" aria-label="Floating label select example">				        
							<option value="CANCELADO">CANCELADO</option>						
							<option value="PENDIENTE">PENDIENTE</option>											
							</select>
							<label for="txtestado_forma_pago"><b>Estado de pago</b></label>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-floating">
							<select class="form-select" id="txtforma_pago" aria-label="Floating label select example">				        
							<option value="CONTADO">CONTADO</option>						
							<option value="CREDITO">CREDITO</option>											
							</select>
							<label for="txtforma_pago"><b>Forma de pago</b></label>
							</div>
						</div>
						<div class="col-md-4">
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

						<div class="col-md-3">
							<div class="form-floating">
							<select class="form-select" id="txtid_cta" aria-label="Floating label select example">
							<option value="">Seleccionar</option>
							<?php while($fila=odbc_fetch_array($RSCtas)) {?>
							<option value="<?php echo $fila['ID_CTA'];?>"><?php echo $fila['NUM_CUENTA'];?></option><?php } ?>
							</select>
							<label for="txtid_cta"><b><i class="bi bi-hash"></i>Cta Bancaria</b></label>
							</div>
						</div>

						<div class="col-md-3" >
				    		<div class="form-floating">	
				   		    <input type="text" class="form-control" id="txtnum_transf" placeholder="# Mov. Banco" value="0">
							<label for="txtnum_transf"><b><i class="bi bi-hash"></i>Mov. Banco </b></label>
							</div>
					    </div>
						<div class="col-md-3" >
							<div class="form-floating">
							<input type="date" class="form-control" id="txtfecha_transf" placeholder="Fec. Transf." value="<?php echo $diaactual;?>" >
							<label for="txtfecha_transf"><b><i class="bi bi-calendar-date-fill"></i>Fec. Transf.</b></label>
							</div>					  
						</div>

						


						

						<div class="col-md-3" style="text-align: right;" id="div_btn_cabecera" >
							<button type="button" class="btn btn-outline-success"  id="btn_detallar_compra"><i class="fas fa-save"></i> Guardar</button>
							<button type="button" class="btn btn-outline-danger " id="btn_cerrar_cabec_compra"><i class="fas fa-door-closed" ></i> Cerrar</button>
						</div>

					</div>


		      </div>
		    </div>
		  </div>
		 
		</div>


		<div class="row g-3" hidden>

		<div class="col-md-3" id='div_tipo_nc'>
			<div class="form-floating">			
			<select id="txtcod_tip_nc_nd_ref" class="form-control custom-select mr-sm-2">
			<option value="">Seleccionar</option>
			<option value="01">Anulación de la operación</option>			
			<option value="05">Descuento por item</option>
			<option value="07">Devolución por item</option>
			</select>
			<label for="txtcod_tip_nc_nd_ref"><i class="bi bi-bookmarks-fill"></i> Tipo de Nota Crédito</label>			
			</div>
		</div>
	

		<div class="col-md-3" id='div_tipo_nd'>
			<div class="form-floating">			
			<select id="txttipo_nota_debito" class="form-control custom-select mr-sm-2">
			<option value="00">Seleccionar</option>
			<option value="01">AJUSTE INVENTARIO</option>			
			<option value="02">AJUSTE MONTOS</option>
			
			</select>
			<label for="txtcod_tip_nc_nd_ref"><i class="bi bi-bookmarks-fill"></i> Tipo de Nota Débito</label>			
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-floating">
			<input type="date" class="form-control" id="txtfecha_llegada_mercaderia" placeholder="Fec. Ingreso Merc" value="<?php echo $diaactual;?>" >
			<label for="txtfecha_llegada_mercaderia"><b><i class="bi bi-calendar-date-fill"></i> Fec. Ingreso Merc.</b></label>
			</div>					  
		</div>

		<div class="col-md-3">
			<div class="form-floating">
			<input type="text" class="form-control" id="txtdoc_ingreso_mercaderia" placeholder="Fec. Ingreso Merc" >
			<label for="txtdoc_ingreso_mercaderia"><b><i class="bi bi-calendar-date-fill"></i> Doc. Ingreso Mercadería</b></label>
			</div>					  
		</div>
		
		</div>



	</div><!--div id="formulario_egresos_cz" hidden-->			
	<div id="formulario_egresos_dt" hidden>
		
		<div class="bg-success" style="padding: 5px; text-align: center; color: white;">
	    <h4>Detalle de Compra (Ingreso de Mercaderías)</h4>		
	    </div>
		<p><hr></p>	
		<input type="hidden" class="form-control" id="txtcod_mov_dt">
		<input type="hidden" class="form-control" id="txtid_producto">
		<input type="hidden" class="form-control" id="txtdsctos_ingreso" value="0">
		<input type="hidden" class="form-control" id="txtcant_salida" value="0">
		<input type="hidden" class="form-control" id="txtprs_mayor" value="0">
		<input type="hidden" class="form-control" id="txtprs_premiun" value="0">
		<input type="hidden" class="form-control" id="txtprs_menor" value="0">
		<input type="hidden" class="form-control" id="txtdsctos_salida" value="0">
		<input type="hidden" class="form-control" id="txtvalor_salida" value="0">
		<input type="hidden" class="form-control" id="txtigv_salida" value="0">
		<input type="hidden" class="form-control" id="txtgravadas_salida" value="0">
		<input type="hidden" class="form-control" id="txtinafecto_salida" value="0">
		<input type="hidden" class="form-control" id="txtexonerado_salida" value="0">
		<input type="hidden" class="form-control" id="txttotal_salida" value="0">
		<input type="hidden" class="form-control" id="txtobservar">		
		<input type="hidden" class="form-control" id="txtperiodo_transf">		
		<input type="hidden" class="form-control" id="txtdias_pago">
		<input type="text" class="form-control" id="txtafectacion">

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

   		<div class="col-md-3" hidden>
			<div class="form-floating">
			<select class="form-select" id="txtestado_producto" aria-label="Floating label select example">
			<option value="ACTIVO">ACTIVO</option>						
			<option value="INACTIVO">INACTIVO</option>											
			</select>
			<label for="txtestado_producto"><b>Estado</b></label>
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
			<label for="txtinafecto_ingresos"><b><i class="bi bi-hash"></i>  Inafectos </b></label>
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

	    <div class="col-md-3" style=" display: flex;  justify-content: left;  align-items:center;" id="div_cuadres" hidden	>
		<div class="form-check form-check-inline">
	 		 <input class="form-check-input" type="radio" name="txtcuadre_monto" id="txtpositivo" value="POSITIVO" checked>
	  		<label class="form-check-label " for="txtpositivo"><b class="text-primary"> Positivo</b></label>
			</div>
			<div class="form-check form-check-inline">
	  		<input class="form-check-input" type="radio" name="txtcuadre_monto" id="txtnegativo" value="NEGATIVO">
	  		<label class="form-check-label" for="txtnegativo"><b class="text-danger"> Negativo</b></label>
			</div>	
		</div>




	    <div class="col-md-12" style="text-align: right; padding: 	5px;">
			<button type="button" class="btn btn-outline-success btn-lg"  id="btn_agregar_detallar_compra"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
			<!--button type="button" class="btn btn-outline-danger btn-lg" id="btn_subir_inventario" disabled><i class="bi bi-cloud-upload-fill"></i> Subir Inventario</button>
			<button type="button" class="btn btn-outline-warning btn-lg" id="btn_actualizar_precios"><i class="bi bi-arrow-clockwise"></i> Actualizar Precios</button-->
			<button type="button" class="btn btn-outline-danger btn-lg" id="btn_cerrar_compra_dt"><i class="fas fa-door-closed" ></i> Cerrar</button>
		</div>
	    </div>

	    <br>
	    	<div class="row g-3" id="div_detracciones" hidden>

	    		<div class="col-md-3">
	    		<div class="form-floating">	
	    		  <input type="text" class="form-control" id="txtpor_detraccion" placeholder="Porc. Detracción"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
				  <label for="txtpor_detraccion"><b><i class="bi bi-hash"></i>  Porc. Detracción </b></label>
				</div>
	    		</div>

	    		<div class="col-md-3">
	    		<div class="form-floating">	
	    		  <input type="text" class="form-control" id="txtmonto_detraccion" placeholder="Detracción"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
				  <label for="txtmonto_detraccion"><b><i class="bi bi-hash"></i>  Detracción </b></label>
				</div>
	    		</div>

	    		<div class="col-md-3">
	    		<div class="form-floating">	
	    		  <input type="text" class="form-control" id="txtnum_detraccion" placeholder="Num. Constancia"onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="0.00">
				  <label for="txtnum_detraccion"><b><i class="bi bi-hash"></i>  Num. Constancia </b></label>
				</div>
	    		</div>

	    		<div class="col-md-3">
	    		<div class="form-floating">	
	    		  <input type="date" class="form-control" id="txtfecha_detraccion" value="<?php echo "$diaactual";?>">
				  <label for="txtfecha_detraccion"><b><i class="bi bi-hash"></i>  Fecha Pago Detr. </b></label>
				</div>
	    		</div>


	    	</div>

	    	<div  id="lista_detalle_compra_dt" ></div>	




	</div><!--div id="formulario_egresos_dt" hidden-->

	<div id="divsubirdocumentos" style="padding: 2px; font-size:10pt;" hidden>
		<div class="form-row">		
		<div class="principal">
		<form id="form_subir" action="">
		<div class="form-1-2">
		<label form="" >Subir archivo</label>
		<input type="file" accept="" id="txtvoucherdigital" name="archivo" runat="server" /> 
		<input type="hidden" name="txtcod_mov_carga" id="txtcod_mov_carga">
		<input type="hidden" name="txtnomexcel" id="txtnomexcel">
		<input type="hidden" name="txtid_local_carga" id="txtid_local_carga">
		<input type="hidden" name="txtipo_archivo" id="txtipo_archivo">
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
		<a href="#" class='btn btn-outline-danger btn-sm'  id="btn_procesar_excel_inventario" hidden>Procesar</a>		
		<a href="#" class='btn btn-outline-danger btn-sm'  id="btn_procesar_excel_precios" hidden>Procesar</a>		
		<a href="#" class='btn btn-outline-danger btn-sm'  id="btcerrar">Cerrar</a>
		</div>
	 	</div>
		</form>	
		</div>	
		</div>
	</div><!--div id="divsubirdocumentos" style="padding: 2px; font-size:10pt;" hidden-->



	
</div><!--div class="card-body"-->
</div><!--div class="card"-->
</div><!--div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"-->	  	

<!-- Modal -->
<div class="modal fade" id="modal_ver_imagen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Visualizar Sustento</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="divvisorvouchers" style='display:none;'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="mdl_nuevo_servicios" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Registra Servicio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      	<div class="row g-3" >

			<div class="col-md-12">
			<div class="form-floating">		
			<select class="form-select" id="txtid_categoria" aria-label="Floating label select example">
			<option selected>Seleccionar</option>
			<?php while($fila=odbc_fetch_array($RSQLCategorias)) {?>
			<option value="<?php echo $fila['ID_CATEGORIA'];?>"><?php echo $fila['NOM_CATEGORIA'];?></option><?php } ?>
			</select>
			<label for="txtid_categoria"><i class="bi bi-buildings-fill"></i> Categoria</label>		
			</div>
			</div>

			<div class="col-md-12">
	    		<div class="form-floating">	
	    		  <input type="text" class="form-control" id="txtnuevo_servicios" placeholder="Nuevo servicio" oninput="convertirAMayusculas(this)">
				  <label for="txtnuevo_servicios"><b> Nuevo servicio </b></label>
				</div>
	    	</div>

		</div>


      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-outline-success"  data-bs-dismiss="modal" id="btn_agregar_nuevo_servicio"><i class="bi bi-plus-circle-fill"></i> Agregar</button>
      	<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-door-closed" ></i> Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="mdl_rendicion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detalle de Rendición</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="div_listar_rendicion"></div>
      <div class="modal-footer">      	
      	<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class="fas fa-door-closed" ></i> Cerrar</button>                
      </div>
    </div>
  </div>
</div>

</body>
</html>
<script type="text/javascript">

$(document).ready(function() {	
	
	
	//$("#txtfecha_emision").mask("00-00-0000");  
	//$("#txtperiodo_emision").mask("00-0000");  
	Verifica_permiso()
	listar_egresos();
	//traer_tipo_cambio()
});	
/**********************************************/

function traer_medios(){

	var axnum_programacion = $("#txtnum_programacion").val();
	var axid_local = $("#txtid_local").val()

	$.ajax({
		url:"egresos_funciones.php",
		method: "POST",
		data: {param:181,txtnum_programacion:axnum_programacion,txtid_local:axid_local},				
		success : function(data){	      	
			var json = JSON.parse(data);
				if (json.status == 200){	

					$("#txtestado_forma_pago").val(json.ESTADO_FORMA_PAGO)
					$("#txtforma_pago").val(json.FORMA_PAGO)
					$("#txtmedio_pago").val(json.MEDIO_PAGO)
					$("#txtid_cta").val(json.ID_CTA)
					$("#txtnum_transf").val(json.NUM_TRANSF)
					$("#txtfecha_transf").val(json.FECHA_TRANSF)
			

				}
		}
	});


}

$(document).on("click","#btn_listar_programaciones",function(event){

	var cadena = $(this).text();
	var nuevaCadena = cadena.trim();

	$("#txtnum_programacion").val(nuevaCadena);
	$("#listar_programaciones").fadeOut();

	traer_medios()


})

$('#txtnum_programacion').keyup(function(){

	  var axbuscar_dato = $("#txtnum_programacion").val();
	  var axid_local = $("#txtid_local").val()
	  	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"egresos_funciones.php",
	      method: "POST",
	      data: {param:180,
	      	txtnum_programacion:axbuscar_dato,
	      	txtid_local:axid_local
	      },
	      success : function(data){
	      	$('#listar_programaciones').fadeIn();
	        $('#listar_programaciones').html(data);
	      }
	    });

	  }else{
	  	$("#listar_programaciones").fadeOut();
	  } 
});



function  traer_rendicion() {
	
	var axnum_programacion = $("#txtnum_programacion").val()
	var axid_local = $("#txtid_local").val()

	$.ajax({

		url:"egresos_funciones.php",
		method: "POST",
		data: {param:179,
				txtnum_programacion:axnum_programacion,
				txtid_local:axid_local
				},
			success : function(data){
				$("#div_listar_rendicion").html(data)
			}
	})
}


$(document).on("click","#btn_ver_rendicion",function(event){

	$("#txtnum_programacion").val($(this).data('numrend'))
	traer_rendicion()

})

$(document).on("change","#txtdetalle_movimiento",function(event){

	var axdetalle_movimiento = $("#txtdetalle_movimiento").val()

	if(axdetalle_movimiento=='COMPRA'){
		$("#txtdetalle_ingreso").val('MATERIA PRIMA')
		$("#txtnum_programacion").prop('disabled',true)
		$("#txtglosa").val('COMPRA DE MATERIA PRIMA')
	}else{ 
		$("#txtdetalle_ingreso").val('SERVICIOS')
		$("#txtnum_programacion").prop('disabled',false)
		$("#txtglosa").val('GASTOS DE SERVICIOS')
		
	}

})



$(document).on("change","#txtfecha_emision",function(event){

	traer_tipo_cambio()
})


function traer_tipo_cambio(){

	var axfecha_actual = $("#txtfecha_emision").val()

	$.ajax({

		url:"apis.php",
		method: "POST",
		data: {param:0,txtfecha_actual:axfecha_actual},
			success : function(data){
				var json = JSON.parse(data);
				$("#txttipo_cambio").val(json.precioVenta);	
			}
		})

}


$('input[type="radio"]').click(function() {
   if($(this).is(':checked')) {
      var valorSeleccionado = $(this).val();
      
      $("#txtvalor").val(valorSeleccionado)
      //console.log('Ha seleccionado el input radio con valor: ' + valorSeleccionado);
   }
});




$(document).on("change","#txtdetalle_ingreso",function(event){

	var axdetalle_ingreso = $("#txtdetalle_ingreso").val()

	if(axdetalle_ingreso=='CUADRE'){

		$("#txtid_td").val(26)
		$("#txtporc_igv").prop('disabled',true)
		$("#txtn_serie").prop('disabled',true)
		$("#txtdocumento").prop('disabled',true)
		$("#txtid_td").prop('disabled',true)

	}else if(axdetalle_ingreso=='MERMA'){

		$("#txtid_td").val(11)
		$("#txtporc_igv").prop('disabled',true)
		$("#txtn_serie").prop('disabled',true)
		$("#txtdocumento").prop('disabled',true)
		$("#txtid_td").prop('disabled',true)


	}else{

		$("#txtporc_igv").prop('disabled',false)
		$("#txtn_serie").prop('disabled',false)
		$("#txtdocumento").prop('disabled',false)
		$("#txtid_td").prop('disabled',false)
	}

		var axid_td = $("#txtid_td").val()
		var axid_local = $("#txtid_local").val();


	$.ajax({
			url:"egresos_funciones.php",
			method: "POST",
			data: {param:177,txtid_td:axid_td,txtid_local:axid_local},				
			success : function(data){	      	
				var json = JSON.parse(data);
					if (json.status == 200){	
						$("#txtporc_igv").val(json.POR_IMPUESTO);
						$("#txtn_serie").val(json.N_SERIE);

						var num = json.N_CORRELATIVO+1;
						var numstring = num.toString().padStart(8, '0');

						$("#txtdocumento").val(numstring);				

					}
			}
			});




})





$(document).on("keydown","#btn_cambiar_precio",function(event){

if (event.keyCode == 13){

var axcant_ingreso_m = $(this).data('cantidad')
var axcosto_producto_1 = $(this).text()
var axid_producto_1 = $(this).data('idprod')
var axcod_mov_dt_1 = $(this).data('id_dt')

//alert(axcod_mov_dt_1)

$("#txtcant_ingreso").val(axcant_ingreso_m)
$("#txtcosto_producto").val(axcosto_producto_1)
$("#txtid_producto").val(axid_producto_1)
$("#txtcod_mov_dt").val(axcod_mov_dt_1)

var axid_local= $("#txtid_local").val()
var axcod_mov_cz= $("#txtcod_mov").val()
var axcant_ingreso= $("#txtcant_ingreso").val()
var axcosto_producto= $("#txtcosto_producto").val()
var axcod_mov_dt= $("#txtcod_mov_dt").val()
var axid_producto= $("#txtid_producto").val()

if(!isNaN(axcant_ingreso_m)){	

	$.ajax({
			url:"egresos_funciones.php",
			method: "POST",
			data: {param:132,
					txtid_local:axid_local,					
					txtcant_ingreso:axcant_ingreso,
					txtcosto_producto:axcosto_producto,
					txtcod_mov_dt:axcod_mov_dt,
					txtid_producto:axid_producto,
					txtcod_mov:axcod_mov_cz
				},
				success : function(data){

					if(data==0){
						listar_detalle_compra()
					}else{
						Swal.fire('Aviso!','No se grabo el registro...','error')	
					}

				}
			})


}else{
		

		Swal.fire({
			  position: 'center',
			  icon: 'warning',
			  title: 'No es un número....',
			  showConfirmButton: false,
			  timer: 2000
			})

		listar_pedidos_dt();
		//document.getElementById(this).focus();
}

}

})


$(document).on("keydown","#btn_cambiar_cantidad",function(event){

if (event.keyCode == 13){

var axcant_ingreso_m = $(this).text()
var axcosto_producto_1 = $(this).data('precio')
var axid_producto_1 = $(this).data('idprod')
var axcod_mov_dt_1 = $(this).data('id_dt')

//alert(axcod_mov_dt_1)

$("#txtcant_ingreso").val(axcant_ingreso_m)
$("#txtcosto_producto").val(axcosto_producto_1)
$("#txtid_producto").val(axid_producto_1)
$("#txtcod_mov_dt").val(axcod_mov_dt_1)

var axid_local= $("#txtid_local").val()
var axcod_mov_cz= $("#txtcod_mov").val()
var axcant_ingreso= $("#txtcant_ingreso").val()
var axcosto_producto= $("#txtcosto_producto").val()
var axcod_mov_dt= $("#txtcod_mov_dt").val()
var axid_producto= $("#txtid_producto").val()

if(!isNaN(axcant_ingreso_m)){	

	$.ajax({
			url:"egresos_funciones.php",
			method: "POST",
			data: {param:131,
					txtid_local:axid_local,					
					txtcant_ingreso:axcant_ingreso,
					txtcosto_producto:axcosto_producto,
					txtcod_mov_dt:axcod_mov_dt,
					txtid_producto:axid_producto,
					txtcod_mov:axcod_mov_cz
				},
				success : function(data){

					if(data==0){
						listar_detalle_compra()
					}else{
						Swal.fire('Aviso!','No se grabo el registro...','error')	
					}

				}
			})


}else{
		

		Swal.fire({
			  position: 'center',
			  icon: 'warning',
			  title: 'No es un número....',
			  showConfirmButton: false,
			  timer: 2000
			})

		listar_pedidos_dt();
		//document.getElementById(this).focus();
}

}

})


$(document).on("click","#btn_eliminar_egreso_dt",function(){

var axcod_mov_dt_1 = $(this).data('id')
$("#txtcod_mov_dt").val(axcod_mov_dt_1)

var axcod_mov_dt  = $("#txtcod_mov_dt").val();
var axcod_mov_cz  = $("#txtcod_mov").val();
var axid_local = $("#txtid_local").val();


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

		url:"egresos_funciones.php",
		method: "POST",
		data: {param:34,txtcod_mov_dt:axcod_mov_dt,txtid_local:axid_local,txtcod_mov:axcod_mov_cz},
			success : function(data){

				if(data==0){
					
					Swal.fire({
					  position: 'center',
					  icon: 'success',
					  title: 'Registro eliminado...',
					  showConfirmButton: false,
					  timer: 500
					})
					listar_detalle_compra()
				}else{
					Swal.fire('Aviso!','El registro No se elimino','error')
				}

			}
		})

  }
})

})



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
	var axporc_igv = $("#txtporc_igv").val();

	console.log({axcant_ingreso,axcosto_producto,axafectacion,axporc_igv})

	if(axafectacion==''){

		Swal.fire("Aviso", "Ingrese el nombre del producto", "warning");						
		document.getElementById('txtnom_producto').focus();

	}else{

		if(axporc_igv==0 || axporc_igv==""){
			traer_porc_igv();
		}


		if(axafectacion=='GRAVADA'){

			var axvalor_ingreso  = (parseFloat(axcant_ingreso)*parseFloat(axcosto_producto)).toFixed(2);
			var axigv_ingreso = parseFloat(axvalor_ingreso)*parseFloat(axporc_igv)
			//console.log(axigv_ingreso+'|'+axporc_igv)

			var axgravadas_ingreso = axvalor_ingreso;
			var axinafecto_ingresos = 0;
			var axexonerado_ingreso = 0;
			var axtotal_ingreso = (parseFloat(axvalor_ingreso)+parseFloat(axigv_ingreso)).toFixed(2);

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




$(document).on("change","#txtid_td",function(){

var axid_td = $("#txtid_td").val()
//alert(axid_td)

if(axid_td=='6'){
	$("#div_tipo_nc").prop('hidden',false)	
	$("#div_tipo_nd").prop('hidden',true)	
}else if(axid_td=='7'){
	$("#div_tipo_nd").prop('hidden',false)	
	$("#div_tipo_nc").prop('hidden',true)	
}else{
	$("#div_tipo_nc").prop('hidden',true)
	$("#div_tipo_nd").prop('hidden',true)	
}


traer_porc_igv()

})


$(document).on("keyup","#txtbuscar",function(){
listar_egresos()

})

$(document).on("keyup","#txtbuscar_dt",function(){
listar_detalle_compra()

})




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


$(document).on("click","#btn_agregar_nuevo_servicio",function(){

	// console prueba ejecutar
	console.log("btn_agregar_nuevo_servicio")

	var axid_empresa = $("#txtid_empresa").val();
	var axid_categoria = $("#txtid_categoria").val()
	var axnuevo_servicios = $("#txtnuevo_servicios").val()


 $.ajax({
	      url:"egresos_funciones.php",
	      method: "POST",
	      data: {param:178,
	      	txtnuevo_servicios:axnuevo_servicios,
			txtid_empresa:axid_empresa,
			txtid_categoria:axid_categoria

	      },
	      success : function(data){
	      
	      	if(data==1){
	      		Swal.fire('Aviso!','El registro No se guardo...','error')
	      	}else{

	      		var json = JSON.parse(data);
				if (json.status == 200){	
					
					$("#txtid_producto").val(json.ID_PRODUCTO);		
					$("#txtnom_producto").val(json.NOM_PRODUCTO);
					$("#txtafectacion").val(json.ABREV_AFECTACION);
					$("#txtcosto_producto").val(json.PRECIO_COMPRA_SIGV);					
					//$("#txtafectacion").val(json.ID_AFECTACION)
					document.getElementById('txtcant_ingreso').focus();

															
				}else{
					Swal.fire("Aviso", "El nombre registrado no existe...", "warning");						
				
				}

	      	}

	      }
	    });


})

$(document).on("click","#btn_listar_productos_egresos_nuevo",function(){

var cadena = $(this).text()
var axnuevo_servicio = cadena.replace("(Nuevo)", "").trim();
$("#listar_productos_servicios").fadeOut();


$("#txtnuevo_servicios").val(axnuevo_servicio)


})

$(document).on("click","#btn_listar_productos_egresos",function(){

	// console prueba ejecutar
	console.log("btn_listar_productos_egresos")

	var axid_producto_1 = $(this).data('id')
	var axnom_producto = $(this).text()

	$("#txtid_producto").val(axid_producto_1);
	var axid_producto = $("#txtid_producto").val();

	$.ajax({
		url:"egresos_funciones.php",
		method: "POST",
		data: {param:32,txtid_producto:axid_producto},		
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

$(document).on("change focusout",'#txtnom_producto',function(){
	let axbuscar_dato = $("#txtnom_producto").val();
	if(axbuscar_dato == ""){
		Swal.fire('Aviso!','Ingrese el producto...','warning')
		$("#txtafectacion").val('');
	}
})

$('#txtnom_producto').keyup(function(){

	  var axbuscar_dato = $("#txtnom_producto").val();
	  var axdetalle_movimiento = $("#txtdetalle_movimiento").val();
	  var axdetalle_ingreso = $("#txtdetalle_ingreso").val();
	  
	  
	  if (axbuscar_dato != '') {

	    $.ajax({
	      url:"egresos_funciones.php",
	      method: "POST",
	      data: {param:30,
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
		Swal.fire('Aviso!','Ingrese el producto...kyeup','warning')
	  	$("#listar_productos_servicios").fadeOut();
	  } 
});

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

			url:"egresos_funciones.php",
			method: "POST",
			data: {param:29,

				txtcod_mov:axcod_mov,
				txtcod_mov_dt:axcod_mov_dt,
				txtid_producto:axid_producto,
				txtcant_ingreso:axcant_ingreso,
				txtcosto_producto:axcosto_producto,
				txtdsctos_ingreso:axdsctos_ingreso,
				txtvalor_ingreso:axvalor_ingreso,
				txtigv_ingreso:axigv_ingreso,
				txtgravadas_ingreso:axgravadas_ingreso,
				txtinafecto_ingresos:axinafecto_ingresos,
				txtexonerado_ingreso:axexonerado_ingreso,
				txttotal_ingreso:axtotal_ingreso,
				txtcant_salida:axcant_salida,
				txtprs_mayor:axprs_mayor,
				txtprs_premiun:axprs_premiun,
				txtprs_menor:axprs_menor,
				txtdsctos_salida:axdsctos_salida,
				txtvalor_salida:axvalor_salida,
				txtigv_salida:axigv_salida,
				txtgravadas_salida:axgravadas_salida,
				txtinafecto_salida:axinafecto_salida,
				txtexonerado_salida:axexonerado_salida,
				txttotal_salida:axtotal_salida,
				txtforma_pago:axforma_pago,
				txtdias_pago:axdias_pago,			
				txtestado_forma_pago:axestado_forma_pago,
				txtmedio_pago:axmedio_pago,
				txtnum_transf:axnum_transf,
				txtpor_detraccion:axpor_detraccion,
				txtmonto_detraccion:axmonto_detraccion,
				txtnum_detraccion:axnum_detraccion,
				txtfecha_detraccion:axfecha_detraccion,
				txtestado_producto:axestado_producto,
				txtobservar:axobservar,
				txtfecha_transf:axfecha_transf,
				txtid_cta:axid_cta,
				txtperiodo_transf:axperiodo_transf,
				txtid_local:axid_local,
				txtvalor:axvalor,
				txtparametros:axparametros
			},			
			success : function(data){

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

$(document).on("change","#txtmedio_pago",function(){
/*
var axmedio_pago = $("#txtmedio_pago").val();

if(axmedio_pago !== 'EFECTIVO'){

	//$("#div_forma_pagos").prop('hidden',false)
	$("#div_id_cta").prop('hidden',false)
	$("#div_num_transf").prop('hidden',false)
	$("#div_fecha_transf").prop('hidden',false)

	$("#div_btn_cabecera").removeClass('col-md-12')
	$("#div_btn_cabecera").addClass('col-md-3')

}else{

	//$("#div_forma_pagos").prop('hidden',true)
	$("#div_id_cta").prop('hidden',true)
	$("#div_num_transf").prop('hidden',true)
	$("#div_fecha_transf").prop('hidden',true)

	$("#div_btn_cabecera").addClass('col-md-12')
	$("#div_btn_cabecera").removeClass('col-md-3')

}
*/

})


$(document).on("change","#txtforma_pago",function(){

var axforma_pago = $("#txtforma_pago").val();

if(axforma_pago == 'CREDITO'){
	$("#txtestado_forma_pago").val('PENDIENTE');		
}else{
	$("#txtestado_forma_pago").val('CANCELADO');		
}


})


$(document).on("click","#ver_vouchers_img",function(){



	var axcodmovcz = $(this).data("id");
	var archivoinput = $(this).data("nomarchivo");
	$("#divvisorvouchers").css({'display':'block'});
	var archivoruta = '../Archivos/'+archivoinput;
	//alert(axcodmovcz+'|'+archivoinput)
	
	document.getElementById('divvisorvouchers').innerHTML='<img src="'+archivoruta+'" id="imgvoucher" class="img-fluid" alt="Responsive image">';
														
 
})


$(document).on("click","#btn_descargar_sustento",function(){

var axcodmovcz = $(this).data("id");
var archivoinput = $(this).data("nomarchivo");
var archivoruta = '../Archivos/'+archivoinput;

window.open("visor.php?id="+axcodmovcz+"&py="+archivoruta);	


})


$(document).on("click","#btcerrar",function(){

	$("#divsubirdocumentos").prop('hidden',true)
	$("#btn_nuevo").prop('hidden',false)
	$("#lista1").prop('hidden',false)
	$("#div_cabecera").prop('hidden',false)
	$("#formulario_egresos_cz").prop('hidden',true)
	listar_egresos();

})

$(document).on("click","#btsubevoucher",function(){

	 var input = document.getElementById ("txtvoucherdigital");
     var axnarc= input.value;
     var contar = axnarc.length;
     var nameexcel = axnarc.substr(12,(contar-12));    
     $("#txtnomexcel").val(nameexcel);
     //alert(nameexcel);

    
})




$(document).on("click","#btn_procesar_excel_precios",function(){

	var axcod_mov  = $("#txtcod_mov").val()
	var axid_local = $("#txtid_local").val()
	var nombrearchivo = $("#txtnomexcel").val();
	
	$("#txttipo_excel").val('PRECIOS')
	var axtipo_excel = $("#txttipo_excel").val()


	$.ajax({
	url:"egresos_funciones.php",
	method: "POST",
	data: {param:126,
			txtnomexcel:nombrearchivo,
			txtcod_mov:axcod_mov,
			txttipo_excel:axtipo_excel
		},
		success : function(Excel){
			if(Excel==1){
				Swal.fire('Información!','El archivo no es valido...','error');	
			}else{
				
				$("#btn_nuevo").prop('hidden',true)
				$("#lista1").prop('hidden',true)
				$("#div_cabecera").prop('hidden',true)
				$("#formulario_egresos_cz").prop('hidden',true)
				$("#formulario_egresos_dt").prop('hidden',false)
				$('#lista_detalle_compra_dt').prop('hidden',false);
				$('#divsubirdocumentos').prop('hidden',true);
				
				listar_detalle_compra()
		}
			
			
		}
	})

})

$(document).on("click","#btn_procesar_excel_inventario",function(){

	var axcod_mov  = $("#txtcod_mov").val()
	var axid_local = $("#txtid_local").val()
	var nombrearchivo = $("#txtnomexcel").val();

	$("#txttipo_excel").val('INVENTARIO')
	var axtipo_excel = $("#txttipo_excel").val()

	$.ajax({
	url:"egresos_funciones.php",
	method: "POST",
	data: {param:126,
			txtnomexcel:nombrearchivo,
			txtcod_mov:axcod_mov,
			txttipo_excel:axtipo_excel
		},
		success : function(Excel){
			if(Excel==1){
				Swal.fire('Información!','El archivo no es valido...','error');	
			}else{
				
				$("#btn_nuevo").prop('hidden',true)
				$("#lista1").prop('hidden',true)
				$("#div_cabecera").prop('hidden',true)
				$("#formulario_egresos_cz").prop('hidden',true)
				$("#formulario_egresos_dt").prop('hidden',false)
				$('#lista_detalle_compra_dt').prop('hidden',false);
				$('#divsubirdocumentos').prop('hidden',true);
				
				listar_detalle_compra()
		}
			
			
		}
	})

})



$(document).on("click","#btn_actualizar_precios",function(){


	var axcod_mov  = $("#txtcod_mov").val();
	var axid_local = $("#txtid_local").val();

	$("#txtcod_mov_carga").val(axcod_mov)
	$("#txtid_local_carga").val(axid_local)

	$("#txtipo_archivo").val('EXCEL')

	$("#divsubirdocumentos").prop('hidden',false)
	$("#btn_nuevo").prop('hidden',true)
	$("#lista1").prop('hidden',true)
	$("#div_cabecera").prop('hidden',true)
	$("#formulario_egresos_cz").prop('hidden',true)
	$("#lista_detalle_compra_dt").prop('hidden',true)

	$("#btn_procesar_excel_inventario").prop('hidden',true)
	$("#btn_procesar_excel_precios").prop('hidden',false)



})


$(document).on("click","#btn_subir_inventario",function(){


var axcod_mov  = $("#txtcod_mov").val();
var axid_local = $("#txtid_local").val();

$("#txtcod_mov_carga").val(axcod_mov)
$("#txtid_local_carga").val(axid_local)

$("#txtipo_archivo").val('EXCEL')

$("#divsubirdocumentos").prop('hidden',false)
$("#btn_nuevo").prop('hidden',true)
$("#lista1").prop('hidden',true)
$("#div_cabecera").prop('hidden',true)
$("#formulario_egresos_cz").prop('hidden',true)
$("#lista_detalle_compra_dt").prop('hidden',true)

$("#btn_procesar_excel_inventario").prop('hidden',false)
$("#btn_procesar_excel_precios").prop('hidden',true)



})



$(document).on("click","#btn_sustento_egreso",function(){

var axcod_mov_1 = $(this).data('id')
$("#txtcod_mov").val(axcod_mov_1)

var axcod_mov  = $("#txtcod_mov").val();
var axid_local = $("#txtid_local").val();


$("#txtcod_mov_carga").val(axcod_mov)
$("#txtid_local_carga").val(axid_local)

$("#divsubirdocumentos").prop('hidden',false)
$("#btn_nuevo").prop('hidden',true)
$("#lista1").prop('hidden',true)
$("#div_cabecera").prop('hidden',true)
$("#formulario_egresos_cz").prop('hidden',true)

$("#btn_procesar_excel_inventario").prop('hidden',true)
$("#btn_procesar_excel_precios").prop('hidden',true)


})

$(document).on("click","#btn_eliminar_egreso",function(){
var axcod_mov_1 = $(this).data('id')
$("#txtcod_mov").val(axcod_mov_1)

var axcod_mov  = $("#txtcod_mov").val();
var axid_local = $("#txtid_local").val();


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

		url:"egresos_funciones.php",
		method: "POST",
		data: {param:28,txtcod_mov:axcod_mov,txtid_local:axid_local},
			success : function(data){

				if(data==0){
				
					Swal.fire({
					  position: 'center',
					  icon: 'success',
					  title: 'El registro fue eliminado',
					  showConfirmButton: false,
					  timer: 500
					})

					listar_egresos();
				}else{
					Swal.fire('Aviso!','El registro No se elimino, primero debe eliminar los Detalles','error')
				}

			}
		})

  }
})

})


$(document).on("click","#btn_revertir_egreso",function(){

var axcod_mov_1 = $(this).data('id')
$("#txtcod_mov").val(axcod_mov_1)

var axcod_mov  = $("#txtcod_mov").val();
var axid_local = $("#txtid_local").val();

$.ajax({

		url:"egresos_funciones.php",
		method: "POST",
		data: {param:182,txtcod_mov:axcod_mov,txtid_local:axid_local},
			success : function(data){
				listar_egresos()
			}
		})


})



$(document).on("click","#btn_editar_egreso",function(){

var axcod_mov_1 = $(this).data('id')
$("#txtcod_mov").val(axcod_mov_1)

var axcod_mov  = $("#txtcod_mov").val();
var axid_local = $("#txtid_local").val();

var axnom_local=($("#txtid_local option:selected").text());
$("#nom_local").html(axnom_local)

//alert(axnom_local)

$("#btn_nuevo").prop('hidden',true)
$("#lista1").prop('hidden',true)
$("#div_cabecera").prop('hidden',true)
$("#formulario_egresos_cz").prop('hidden',false)
$("#txtparametros").val(2);

$.ajax({

	url:"egresos_funciones.php",
	method: "POST",
	data: {param:27,txtcod_mov:axcod_mov,txtid_local:axid_local},	
	success : function(data){
		var json = JSON.parse(data);
		  	if (json.status == 200){

			  
			  $("#txtcod_mov").val(json.COD_MOV);
			  $("#txttipo_mov").val(json.TIPO_MOV);
			  $("#txtdetalle_movimiento").val(json.DETALLE_MOVIMIENTO);
			  $("#txtfecha_emision").val(json.FECHA_EMISION);
			  $("#txtid_td").val(json.ID_TD);			  
			  $("#txtn_serie").val(json.TXT_SERIE);
			  $("#txtdocumento").val(json.DOCUMENTO);
			  $("#txtid_beneficiario").val(json.ID_BENEFICIARIO);
			  $("#txtid_local").val(json.ID_LOCAL);
			  $("#txtglosa").val(json.GLOSA);
			  $("#txtmoneda").val(json.MONEDA);
			  $("#txttipo_cambio").val(json.TIPO_CAMBIO);
			  $("#txtfecha_llegada_mercaderia").val(json.FECHA_LLEGADA)
			  $("#txtdoc_ingreso_mercaderia").val(json.DOC_INGRESO)
			  

			  $("#txtdetalle_ingreso").val(json.DETALLE_INGRESO)
			  $("#txtnum_programacion").val(json.NUM_PROGRAMACION)


			  $("#txtforma_pago").val(json.FORMA_PAGO)
			  $("#txtmedio_pago").val(json.MEDIO_PAGO)
			  $("#txtid_cta").val(json.ID_CTA)
			  $("#txtnum_transf").val(json.NUM_TRANSF)
			  $("#txtfecha_transf").val(json.FECHA_TRANSF)


			  

			  
			
			}

	}
})

})

$(document).on("click","#btn_detallar_compra",function(){

	var axcodusuario = $("#txtcodusuario").val();
	var axid_empresa = $("#txtid_empresa").val();
	var axcod_mov=  $("#txtcod_mov").val();
	var axtxttipo_mov	=$("#txttipo_mov").val();
	var axdetalle_movimiento=  $("#txtdetalle_movimiento").val();
	var axfecha_emision=  $("#txtfecha_emision").val();
	var axid_td=  $("#txtid_td").val();
	var axporc_igv=  $("#txtporc_igv").val();
	var axn_serie=  $("#txtn_serie").val();
	var axdocumento=  $("#txtdocumento").val();
	var axid_beneficiario=  $("#txtid_beneficiario").val();
	var axid_local=  $("#txtid_local").val();
	var axglosa=  $("#txtglosa").val();
	var axmoneda=  $("#txtmoneda").val();
	var axtipo_cambio=  $("#txttipo_cambio").val();
	var	axfecha_llegada_mercaderia = $("#txtfecha_llegada_mercaderia").val()
	var axdoc_ingreso_mercaderia =$("#txtdoc_ingreso_mercaderia").val()
	var axcod_tip_nc_nd_ref = $("#txtcod_tip_nc_nd_ref").val()
	var axtipo_nota_debito = $("#txttipo_nota_debito").val()

	var axdetalle_ingreso = $("#txtdetalle_ingreso").val()
	var axnum_programacion = $("#txtnum_programacion").val()

	var axparametros=  $("#txtparametros").val();

	var axestado_forma_pago  =$("#txtestado_forma_pago").val();
	var axforma_pago  =$("#txtforma_pago").val();
	var axmedio_pago  =$("#txtmedio_pago").val();
	var axid_cta  =$("#txtid_cta").val();
	var axnum_transf  =$("#txtnum_transf").val();
	var axfecha_transf  =$("#txtfecha_transf").val();



	if(axid_td=='' || axid_td=='Seleccionar'){

		Swal.fire('Aviso!','Seleccionar el tipo de documento','warning')
	
	}else if(axid_beneficiario=='' || axid_beneficiario=='Seleccionar'){

		Swal.fire('Aviso!','Seleccionar el proveedor','warning')

	}else if(axn_serie=='' || axn_serie=='Seleccionar'){

		Swal.fire('Aviso!','Ingrese la serie del comprobante','warning')

	}else if(axdocumento=='' || axdocumento=='Seleccionar'){

		Swal.fire('Aviso!','Ingrese el número de comprobante','warning')

	}else{

	$.ajax({
		url:"egresos_funciones.php",
		method: "POST",
		data: {param:26,

			txtcodusuario:axcodusuario,
			txtid_empresa:axid_empresa,
			txtcod_mov:axcod_mov,
			txttipo_mov:axtxttipo_mov,
			txtdetalle_movimiento:axdetalle_movimiento,
			txtfecha_emision:axfecha_emision,
			txtid_td:axid_td,
			txtporc_igv:axporc_igv,
			txtn_serie:axn_serie,
			txtdocumento:axdocumento,
			txtid_beneficiario:axid_beneficiario,
			txtid_local:axid_local,
			txtglosa:axglosa,
			txtmoneda:axmoneda,
			txttipo_cambio:axtipo_cambio,
			txtfecha_llegada_mercaderia:axfecha_llegada_mercaderia,
			txtdoc_ingreso_mercaderia:axdoc_ingreso_mercaderia,
			txtdetalle_ingreso:axdetalle_ingreso,
			txtcod_tip_nc_nd_ref:axcod_tip_nc_nd_ref,
			txttipo_nota_debito:axtipo_nota_debito,
			txtnum_programacion:axnum_programacion,

			txtestado_forma_pago:axestado_forma_pago,
			txtforma_pago:axforma_pago,
			txtmedio_pago:axmedio_pago,
			txtid_cta:axid_cta,
			txtnum_transf:axnum_transf,
			txtfecha_transf:axfecha_transf,


			txtparametros:axparametros
					
		},
		success : function(data){

				if(data==1){
					Swal.fire('Aviso!','El registro No se grabo','error')
				}else{
					
					Swal.fire({
					  position: 'center',
					  icon: 'success',
					  title: 'El proceso se registro correctamente',
					  showConfirmButton: false,
					  timer: 500
					})				

					$("#btn_nuevo").prop('hidden',true)
					$("#lista1").prop('hidden',true)
					$("#div_cabecera").prop('hidden',true)
					$("#formulario_egresos_cz").prop('hidden',true)
					$("#formulario_egresos_dt").prop('hidden',false)
					listar_detalle_compra()
				}

		}
	})

}

})



$(document).on("click","#btn_cerrar_compra_dt",function(){

	$("#btn_nuevo").prop('hidden',false)
	$("#lista1").prop('hidden',false)
	$("#div_cabecera").prop('hidden',false)
	$("#formulario_egresos_cz").prop('hidden',true)
	$("#formulario_egresos_dt").prop('hidden',true)
	listar_egresos();

})



$(document).on("click","#btn_cerrar_cabec_compra",function(){

	$("#btn_nuevo").prop('hidden',false)
	$("#lista1").prop('hidden',false)
	$("#div_cabecera").prop('hidden',false)
	$("#formulario_egresos_cz").prop('hidden',true)
	listar_egresos();

})

function limpiar_cz() {

  	
	//$("#txttipo_mov").val('');
	//$("#txtdetalle_movimiento").val('');
	//$("#txtfecha_emision").val('');
	$("#txtid_td").val('');			  
	$("#txtn_serie").val('');
	$("#txtdocumento").val('');
	$("#txtid_beneficiario").val('');
	//$("#txtid_local").val('');
	//$("#txtglosa").val('');
	//$("#txtmoneda").val('');
	$("#txttipo_cambio").val('0.00');
	$("#txtid_cta").val('');
	$("#txtnum_transf").val('');
	


}


$(document).on("click","#btn_nuevo",function(){

var axcodusuario = $("#txtcodusuario").val();	
var axid_local = $("#txtid_local").val();	


var axnom_local=($("#txtid_local option:selected").text());
$("#nom_local").html(axnom_local)

if(axid_local=='' || axid_local=='Seleccionar'){

	Swal.fire('Aviso','Seleccionar el Almacén','warning')

}else{

	$.ajax({

			url:"egresos_funciones.php",
			method: "POST",
			data: {param:35,
				txtcodusuario:axcodusuario,
				txtid_local:axid_local				
				},
				
				success : function(data){

					$("#txtcod_mov").val(data.trim())
					traer_tipo_cambio()
					limpiar_cz()

					$("#btn_nuevo").prop('hidden',true)
					$("#lista1").prop('hidden',true)
					$("#div_cabecera").prop('hidden',true)
					$("#formulario_egresos_cz").prop('hidden',false)
					$("#txtparametros").val(1);

			}
		})

	
	
	

}




})

$(document).on("change","#txtid_local",function(){
	listar_egresos();
})

function listar_egresos(){

	var axbuscaregistro = $("#txtbuscar").val();		
	var axid_local = $("#txtid_local").val();	


		$.ajax({

			url:"egresos_funciones.php",
			method: "POST",
			data: {param:25,
				txtbuscar:axbuscaregistro,
				txtid_local:axid_local				
				},
				
				success : function(data){

					$("#lista1").html(data);
			}
		})
	}


function Verifica_permiso(){

	var axiduser =$("#txtcodusuario").val();
	var axtipo_beneficiario =$("#txttipo_beneficiario").val();
	//alert(axtipo_beneficiario)
	var axpermiso = 'COMPRAS Y GASTOS';

	$("#titulo_formulario").html("<i class='bi bi-cart-dash-fill'></i> "+axpermiso +" <button type='button' id='btn_nuevo'  class='btn btn-outline-danger btn-sm' ><i class='fa-solid fa-circle-plus'></i> Nuevo</button>")
	
	$.ajax({
		url:"egresos_funciones.php",
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

function zeros( number, width )
{
  width -= number.toString().length;
  if ( width > 0 )
  {
    return new Array( width + (/\./.test( number ) ? 2 : 1) ).join( '0' ) + number;
  }
  return number + ""; // siempre devuelve tipo cadena
}

function convertirAMayusculas(input) {
  input.value = input.value.toUpperCase();
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

function decimales(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}


</script>