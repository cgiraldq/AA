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
	<td>T&iacute;tulo</td>

	<td>
	<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
	<input type=text name=dsm size=60 maxlength="255" placeholder="<? echo $dsm?>" class=text1 onKeyPress="ocultar('capa_dsm')"
	value="" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

		<?
		$nombre_capa="capa_dsm";
		$mensaje_capa="Debe ingresar el titulo de la red";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td>C&oacute;digo</td>

	<td>
	<? $contadorx="idcodigo_counter";$valorx="255";$formax="u";$campox="idcodigo";?>
	<input type=text name=idcodigo size=60 maxlength="255" placeholder="<? echo $idcodigo?>" class=text1 onKeyPress="ocultar('capa_idcodigo')"
	value="" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

		<?
		$nombre_capa="capa_idcodigo";
		$mensaje_capa="Debe ingresar el codigo";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
	<td>Posici&oacute;n</td>

	<td>
		<input type=text name=idpos size=1 maxlength="8" class=text1
		onKeyPress="ocultar('capa_idpos');return numero(event);" value="<? echo $idpos?>">
			<?
			$nombre_capa="capa_idpos";
			$mensaje_capa="Debe digitar la posici&oacute;n";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			?>
	</td>
</tr>





<tr valign="top" bgcolor="#FFFFFF">
	<td>Activar</td>

	<td>
		<select name="idactivo" class="text1">
			  <option value="1">SI</option>
			  <option value="2">NO</option>
		</select>
	</td>
</tr>
<input type="hidden" name="idx2" value="<? echo $_REQUEST["idx2"];?>">
<input type="hidden" name="idx" value="<? echo $_REQUEST["idx"];?>">




<tr bgcolor="#FFFFFF" >
  <td colspan=2>
    <?
   $forma="u";
$param="dsm,idpos";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");
    ?>
  </td>
</tr>

</form>
</table>
<br>

</td>
</tr>
</table>




