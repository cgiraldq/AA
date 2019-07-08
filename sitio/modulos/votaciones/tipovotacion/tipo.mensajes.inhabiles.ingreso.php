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
<td>Mensaje</td>
<td>
<? $contadorx="dsmensaje_counter";$valorx="2000";$campox="dsmensaje";$cantidad=strlen($dsmensaje)?>
<textarea name=dsmensaje cols="50"  rows="5" class=text1 onKeyPress="ocultar('capa_dsmensaje')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsmensaje?></textarea>
<?
$nombre_capa="capa_dsmensaje";
$mensaje_capa="Debe ingresar el mensaje";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=txtnegro>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>

<input type="hidden" name="idtv" value="<? echo $idtv?>">

<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsmensaje";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>