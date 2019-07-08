<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla de uso para el ingreso de datos

include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");
?>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u>

<tr valign=top bgcolor="#FFFFFF">
	<td>Nombre Departamento</td>

	<td>
	<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
	<input type=text name=dsm size=60 maxlength="255" placeholder="<? echo $dsm?>" class=text1 onKeyPress="ocultar('capa_dsm')"
	value="" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

		<?
		$nombre_capa="capa_dsm";
		$mensaje_capa="Debe ingresar el nombre del pa&iacute;s";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>


<input type="hidden" name="idx" value="<? echo $_REQUEST["idx"];?>">
<input type="hidden" name="idx2" value="<? echo $_REQUEST["idx2"];?>">


<tr valign="top" bgcolor="#FFFFFF">
	<td>Activar</td>

	<td>
		<select name="idactivo" class="text1">
			  <option value="1">SI</option>
			  <option value="2">NO</option>
		</select>
	</td>
</tr>


<input type="hidden" name="idx2" value="<? echo $_REQUEST['idx2'];?>">
<tr bgcolor="#FFFFFF" >
  <td colspan=2>
    <?
    $forma="u";
    $param="dsm";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
  </td>
</tr>

</form>
</table>
<br>

</td>
</tr>
</table>


