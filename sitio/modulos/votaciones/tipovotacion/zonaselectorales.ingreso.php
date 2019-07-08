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
<form action="<? echo $pagina;?>" method=post name=u>
<tr valign=top bgcolor="#FFFFFF">
<td>Ubicacion</td>
<td>
<? $contadorx="dsm_counter";$valorx="100";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=60 maxlength="100" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar la ubicacion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Centro de Atencion</td>
<td>
<? $contadorx="centroatencion_counter";$valorx="100";$formax="u";$campox="centroatencion";?>
<input type=text name=centroatencion size=60 maxlength="100" class=text1 onKeyPress="ocultar('capa_centroatencion')" value="<? echo $centroatencion?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_centroatencion";
$mensaje_capa="Debe ingresar el centro de atencion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Zona Electoral</td>
<td>
<? $contadorx="zona_counter";$valorx="100";$formax="u";$campox="zona";?>
<input type=text name=zona size=60 maxlength="100" class=text1 onKeyPress="ocultar('capa_zona')" value="<? echo $zona?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_zonan";
$mensaje_capa="Debe ingresar la zona electoral";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Maximo de votos</td>
<td><input type=text name=votos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_votos')" value="<? echo $votos?>">
<?
$nombre_capa="capa_votos";
$mensaje_capa="Debe digitar el maximo de votos y debe ser mayor de cero";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Maximo de ganadores</td>
<td><input type=text name=ganadores size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_ganadores')" value="<? echo $ganadores?>">
<?
$nombre_capa="capa_ganadores";
$mensaje_capa="Debe digitar el maximo de ganadores y debe ser mayor de cero";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
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
$param="dsm,votos,ganadores";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>