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
<form action="<? echo $pagina;?>" method=post name='obs'>



<tr valign=top bgcolor="#FFFFFF">
	<td>Nueva<br> observaci&oacute;n</td>

	<td>
		<textarea class=text1 rows="10" cols="100" name='dsd' value="<? echo $dsd?>" onKeyPress="ocultar('capa_dsd');"></textarea>
		<!--input type=text name=idpos size=1 maxlength="8" class=text1
		onKeyPress="ocultar('capa_idpos');return numero(event);" value="<? echo $idpos?>"-->
			<?
			$nombre_capa="capa_dsd";
			$mensaje_capa="Debe digitar la observaci&oacute;n";
			include($rutxx."../../incluidos_modulos/control.capa.php");
			?>
	</td>
</tr>


<tr bgcolor="#FFFFFF" >
  <td align="left" colspan=2>
    <?
    $forma="obs";
    $param="dsd";
    include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
  </td>
</tr>
<input type="hidden" name="idy" value="<? echo $_REQUEST['idy'];?>">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="idgaleria" value="<? echo $_REQUEST['idgaleria'];?>">
<input type="hidden" name="observaciones" value="observaciones">
</form>
</table>
<br>

</td>
</tr>
</table>