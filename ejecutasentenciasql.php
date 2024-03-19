<script src="/c-obra/jquery/jquery-3.3.1.min.js"></script>
  <!-- jquery ui -->
  <!--<link rel="stylesheet" href="/c-obra/assests/jquery-ui/jquery-ui.min.css">-->
  <link rel="stylesheet" href="/c-obra/assests/jquery-ui-1.12.1/jquery-ui.min.css">
  <!--<script src="/c-obra/assests/jquery-ui/jquery-ui.min.js"></script>-->
  <script src="/c-obra/assests/jquery-ui-1.12.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<html>
    <textarea name="sentencia" id="sentencia" cols="160" rows=4; ></textarea>
    <input type="button" onclick=ejecutasql(); value="ejecutar"/>
    <input type="button" onclick=guardarexcel("atabla","tabla"); value="excel"/>
</html>
<div id="atabla"></div>
<script>
//columnassql="select * from tbl_columnas where condicion = 1";
//regresamatrizjsonasync(columnassql,"atbl_columnas");
 function ejecutasql(){
        asentencia=document.getElementById("sentencia").value;
        $.ajax({
			url: 'ejecutasqltablaPRUEBA.php',
			type: 'GET',
			data: {q:asentencia},
			//dataType:"text",
			beforeSend: function () {
                        $("#mensajesis").html("Procesando, espere por favor3...");
                },
				success:function(response) {
                    adatos=response.data.formulas;
                    thtml="";
                    thtml+="<table class='table table-striped'>";
                    thtml+="<tr>";
                    
                    nregcab=Object.keys(adatos[0]).length;
                    //poner los encabezados
                    for(iii=0;iii<nregcab;iii++){
                        thtml+="<th>"+acolumnatitulo(Object.keys(adatos[0])[iii])+" ("+Object.keys(adatos[0])[iii]+")</th>";
                    }
                    thtml+="</tr>";

                    
                    nreg=Object.keys(adatos).length;
                    //poner los encabezados
                    for(jjj=0;jjj<nreg;jjj++){
                        thtml+="<tr>";
                        for(iii=0;iii<nregcab;iii++){
                            thtml+="<td>"+Object.values(adatos[jjj])[iii]+"</td>";
                            
                        }
                        thtml+="</tr>";
                    }
                    thtml+="</tr>";

                    thtml+="</table>";

                    document.getElementById("atabla").innerHTML=thtml;



					//$("#atabla").html(response);
                    console.log(response);
					
					
						//$("#vistamodal").html(response);
						
						//console.log(document.getElementById("modalvista").offsetWidth);
				}
		});
}

function acolumnatitulo(acol){
    //console.log(atbl_columnas);
    console.log("este es la ubicacion del _:");
    console.log(acol.indexOf("_"));
    console.log("este es la ubicacion del _ 2:");
    console.log(acol.lastIndexOf("_"));
    if(acol.indexOf("_")>0){
        atabla=acol.substring(acol.indexOf("_")+1,acol.lastIndexOf("_"));
        acolumna=parseInt(acol.substring(acol.lastIndexOf("_")+1));
        console.log("la tabla y la columan son: "+atabla+" : "+acolumna);
        
        console.log("esta es la columna:");
        console.log(acolumna);
        //var ax= Object.values(atbl_columnas).filter(x => x.codigo == acolumna);
        //console.log(ax);
        //if(ax.length>0){
         //   return ax[0].titulo;
        //}else{
         //   return "no encontrado";
        //}
        
    }else{
        return acol;
    }
    
}
function regresamatrizjsonasync(sqljson,variable){//crea variables dinamicas en ejecucion
  //var variables;
  var resultado;
  resultado=$.ajax({
      url: 'ejecutasqltabla.php',
      type: 'POST',
      data: {q: sqljson},
      async: false,

      beforeSend: function () {
                    $("#mensajesis").html("Procesando, espere por favor...");
                    datosactualizado=0;
                    //$.ajaxblock();
                },
        success:function(response) {
          window[variable] = response.data.formulas;
          console.log("se procesa la variable: "+variable);
         
           
        }
    });
  
}
function guardarexcel(nombretabla,nombrehoja){//application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","fileExtension":".xlsx"
        var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }

        var table = nombretabla;
        var name = nombrehoja;

        if (!table.nodeType) table = document.getElementById(table)
         var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
         window.location.href = uri + base64(format(template, ctx))
}
</script>