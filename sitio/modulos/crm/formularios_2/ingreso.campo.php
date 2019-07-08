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
	<td>Nombre del campo</td>

	<td>
	<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
	<input type="text" name="dsm" size="60" maxlength="255" placeholder="<? echo $dsm?>" class="text1" onKeyPress="ocultar('capa_dsm')"
	value="" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

		<?
		$nombre_capa="capa_dsm";
		$mensaje_capa="Debe ingresar el titulo de la red";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>



<tr valign="top" bgcolor="#FFFFFF">
	<td>Descripci&oacute;n del campo</td>
	<td>
		<textarea name="dsdes" onKeyPress="ocultar('capa_dsdes')"></textarea>
		<?
		$nombre_capa="capa_dsdes";
		$mensaje_capa="Debe ingresar descripci$oacute;n";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>

<tr valign="top" bgcolor="#FFFFFF">
	<td>Texto descripci&oacute;n campo obligatorio</td>
	<td>
		<textarea name="dsmensaje"></textarea>
	</td>
</tr>

<tr valign="top" bgcolor="#FFFFFF">
	<td>Tipo de campo</td>

	<td>
		<select name="idtipo" class="text1">
			  <option value="1">Texto (255 caracteres)</option>
			  <option value="2">Texto Grande (500 caracteres)</option>
			  <option value="3">Password o Clave(255 caracteres)</option>
			  <option value="4">Seleccion Unica</option>
			  <option value="5">Tipo email</option>
			   <option value="6">Tipo Pa&iacute;s</option>
			    <option value="7">Tipo Despartamento</option>
			    <option value="8">Tipo Ciudad</option>
			     <option value="12">Tipo Zonas</option>
			     <option value="11">Tipo Barrio</option>
			    <option value="9">Tipo Checkbox</option>
			    <option value="10">Tipo RadioButtom</option>
			    <option value="13">Tipo Direcci&oacute;n</option>
		</select>
	</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
	<td>Posici&oacute;n</td>

	<td>
		<input type=text name=idposn size=1 maxlength="8" class=text1
		onKeyPress="ocultar('capa_idposn');return numero(event);" value="<? echo $idposn?>">
			<?
			$nombre_capa="capa_idposn";
			$mensaje_capa="Debe digitar la posici&oacute;n";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			?>
	</td>
</tr>

<tr valign="top" bgcolor="#FFFFFF">
	<td>Obligatorio?</td>

	<td>
		<select name="idoblig" class="text1">
			<option value="2">NO</option>
			 <option value="1">SI</option>
		</select>
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


<tr valign="top" bgcolor="#FFFFFF">
	<td>Aplica para buscador?</td>

	<td>
		<select name="idbuscador" class="text1">
				<option value="2">NO</option>
			  <option value="1">Superior</option>

			  <option value="3">Lateral</option>
			  <option value="4">Ambos</option>

		</select>
	</td>
</tr>

<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">

<tr bgcolor="#FFFFFF" >
  <td colspan=2>
    <?
    $forma="u";
   $param="dsm,dsdes";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
  </td>
</tr>

</form>
</table>




</td>
</tr>
</table>


