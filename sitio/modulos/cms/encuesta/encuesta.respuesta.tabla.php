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
// Tabla central de datos cuando se hacen los listados
?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
	<form action="<? echo $pagina;?>" method=post name=p>
	<input type="hidden" value="<? echo $idencuesta;?>" name="idencuesta">
	<?
	// encabezado generico basado
	$nombrecampos="Id,Respuesta,Posicion,Activo";
	include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
	$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
	?>
	<tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >
		<td align="center" width="15%">
		<input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
		</td>
		<td align="center">
		<input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" class="textnegro" size="50" maxlength="100">
		</td>
		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[3]?>" size="2" class="textnegro" maxlength="8">
			</td>

		<td align="center">
		<select name="idactivo_[]" class="textnegro">
		<option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
		<option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>
		</select>
		</td>
		<? if ($exportardatos=="") { ?>
		<td align="center">
		<?
		$rutax=$pagina."?idx=".$result->fields[0].$camposadd_action;
		$formax="";
		include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		</td>
		<? } ?>
	</tr>
	<?
	$contar++;
	$result->MoveNext();
	} // fin while
	?>
	<tr>
		<td colspan=<? echo $total?> align="center">
		<input type=submit name=enviar value="Modificar datos"  class="botones">
		<input type=button name=enviar value="Regresar"  class="botones" onclick="irAPaginaD('default.php');">
		<input type="hidden" name="idc" value="<? echo $idc?>">
		</td>
	</tr>
</form>
</table>