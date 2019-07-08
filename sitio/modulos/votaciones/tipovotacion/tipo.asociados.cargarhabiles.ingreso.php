<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2009
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe Sánchez <graficoweb@comprandofacil.com> - Diseño
  José Fernando Peña <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td>Cargar Archivo</td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen de encabezado";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<br>
El archivo debe ser conm extension xls<br>
<a href="Votaciones_Delegados.xls">Descargue el archivo de muestra delegados</a><br>
<a href="Votaciones_Delegados.xls">votaciones_centrosdeatencion.xls</a><br>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Tipo de carga de archivo</td>
<td>
	<select name=idtipoarchivo class=text1>
		  <option value="1" <? if ($idtipoarchivo==1) echo "selected";?>>Delegados</option>
		  <option value="2" <? if ($idtipoarchivo==2) echo "selected";?>>Centros de Votacion</option>
	</select>

</td>
</tr>


<input type="hidden" name="idtv" value="<? echo $idtv?>">
<input type="hidden" name="cargar" value="1">

<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsimg1";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>