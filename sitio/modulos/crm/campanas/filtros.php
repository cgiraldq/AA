<?
/*serror_reporting(E_ALL);
ini_set("display_errors", 1);*/
/*
| ----------------------------------------------------------------- |
Sistema integrado de gestion e informacion administrativa

Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com>
  Juan Felipe Sánchez <graficoweb@comprandofacil.com>
  José Fernando Peña <soporteweb@comprandofacil.com>
=====================================================================
| ----------------------------------------------------------------- |
*/
$rutx=1;

if($rutx==1) $rutxx="../";
$titulomodulo="Configurar filtros de la campaña";


include ($rutxx."../../incluidos_modulos/comunes.php");
include ($rutxx."../../incluidos_modulos/varconexion.php");
include ($rutxx."../../incluidos_modulos/modulos.funciones.php");
include ($rutxx."../../incluidos_modulos/sessiones.php");
include ($rutxx."../../incluidos_modulos/func.calendario_2.php"); // funcion nueva del calendario
$idcampana=$_REQUEST['idcampana'];

?>

<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
	  <link rel="stylesheet" href="http://www.comprandofacil.com/pide/corehome/css_modulos/style.core.css" type="text/css" media="all" rel="stylesheet" >
	  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.graficas.css">
	  <link rel="stylesheet" href="<? echo $rutxx;?>../../css_modulos/core.crm.css">

<script type="text/javascript">
function imprimir_filtros(){
	var opcion = document.getElementById('opcion_filtro').value;

	//opcion 1 = preferencias
	//opcion 2 = planes
	//opcion 3 = servicios

	if(opcion==1)
	{
		ruta="../../validaciones/consultar.preferencias.filtros.php";
		document.getElementById('cargar_filtros').innerHTML='';
	}
	if(opcion==2)
	{
		ruta="../../validaciones/consultar.planes.filtros.php";
		document.getElementById('cargar_filtros').innerHTML='';
	}
	if(opcion==3)
	{
		ruta="../../validaciones/consultar.servicios.filtros.php";
		document.getElementById('cargar_filtros').innerHTML='';
	}


    conexion1=AjaxObj();
    contenedor1="cargar_filtros";
    conexion1.open("POST",ruta,true);

    conexion1.onreadystatechange =function() {
    if (conexion1.readyState==4) {
        var _resultado = conexion1.responseText;
        if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
        if (contenedor1){
	        contenedor1=document.getElementById(contenedor1);
	        contenedor1.innerHTML = _resultado;
        	}
      	  }
        } // fin conexion1
      } // fin funcion conexion1 interna
      conexion1.send(null) // limpia conexion

}



function guardar_resultado(){

	var clientesx = document.getElementById("clientes").value;
	var idfiltros = document.getElementById("idfiltro").value;
	var campana = document.getElementById("idcampana").value;
	var tipofiltro = document.getElementById("tipofiltro").value;
	var partir = clientesx.split(',');
	var clientes='';

	var x=eval("document.xx1");

	for (var i=0;i<x.length;i++)
	{
		var e = x.elements[i];
		if(e.checked==true)
		{
			clientes+= e.value+',';
		}
	}

	conexion1=AjaxObj();
    contenedor1="cargar_msn";
    conexion1.open("POST","../../validaciones/guardar.resultado.campana.php?clientes="+clientes+"&idfiltros="+idfiltros+"&campana="+campana+"&tipofiltro="+tipofiltro,true);

    conexion1.onreadystatechange =function() {
    if (conexion1.readyState==4) {
        var _resultado = conexion1.responseText;
        if (_resultado !="0" && _resultado !="-1" && _resultado !="") {
        if (contenedor1){
	        contenedor1=document.getElementById(contenedor1);
	        contenedor1.innerHTML = _resultado;

	        document.getElementById("id_Mail").style.display='';
			document.getElementById("id_Down").style.display='';
			document.getElementById("id_CampTel").style.display='';

        	}
      	  }
        } // fin conexion1
      } // fin funcion conexion1 interna
      conexion1.send(null) // limpia conexion
 }

</script>
<body>


<?
$rutamodulo="  <a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.=" <span class='text1'>".$titulomodulo."</span>";

	include($rutxx."../../incluidos_modulos/navegador.principal.php");
	include($rutxx."../../incluidos_modulos/core.mensajes.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
	$contar=seldato('count(id)','campaa_asociada','crm_campa_por_cliente',$idcampana,1);
	$displa='none';
	if($contar>0)$displa='';

	?>
	<div id="cargar_msn"></div>
<?
	include("filtros.campanas.php");
?>
<table align='center' border='0' cellspacing='1'>
<tr>

<?
if($valno<>1){
?>
	<td>
		<input type="button" value="Guardar" onclick="guardar_resultado();" class="botones">
		<input type="hidden" name="clientes" id="clientes" value="<? echo $clientes; ?>">
		<input type="hidden" name="idfiltro" id="idfiltro" value="<? echo $idfiltro; ?>">
		<input type="hidden" name="idcampana" id="idcampana" value="<? echo $idcampana; ?>">
		<input type="hidden" name="tipofiltro" id="tipofiltro" value="<? echo $tipofiltro; ?>">
	</td>
	<td id="id_Mail" style="display:<? echo $displa; ?>">
		<input type="button" value="Mail" class="botones" onclick="irAPaginaDN('../../crm/campanas/filtros.enviar.mail.php?idcampana=<? echo $idcampana; ?>')" >
	</td>
	<td id="id_CampTel" style="display:<? echo $displa; ?>">
		<input type="button" value="Campa&ntilde;a telefonica" class="botones" onclick="irAPaginaD('../campanas/filtros.campana.telefonica.php?idcampana=<? echo $idcampana; ?>');" >
	</td>
	<td id="id_Down" style="display:<? echo $displa; ?>">
		<a href="../../validaciones/filtros.exportar.csv.php?idcampana=<? echo $idcampana; ?>" class="botones" target="_blank">Descargar Archivo</a>
	</td>
	<td>
		<a style="cursor:pointer" class="botones" onclick="javascript:alert('Por favor configurar propiedades.');" target="_blank">Redes Sociales</a>
	</td>
<?
}
?>
	<td>
		<input type="button" value="Regresar" class="botones" onclick="irAPaginaD('../../crm/formularios/registros.php?idxx=94&r=1')" >
	</td>
</tr>
</table>

<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>

</body>
</html>

