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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u>
<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar la pregunta ";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Tipo Pregunta?</td>
<td>
	<select name=idtipo class=text1>
 		<option value="0"  <? if ($idtipo=="0") echo "selected";?>>Seleccione..</option>
		<option value="1" <? if ($idtipo=="1") echo "selected";?>>Unica Respuesta</option>
		<option value="2" <? if ($idtipo=="2") echo "selected";?>>Multiple Respuesta</option>
		<option value="3" <? if ($idtipo=="3") echo "selected";?>>Texto</option>



	</select>

</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Obligatorio?</td>
<td>
	<select name=idoblig class=text1>
		  <option value="1" <? if ($idoblig==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idoblig==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>


<tr bgcolor="#FFFFFF" ><td colspan=2>


<?
$forma="u";
$param="dsm";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
<input type="hidden" name="idy" value="<? echo $idy?>"/>
<input type="hidden" name="idtv" value="<? echo $idtv?>"/>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>