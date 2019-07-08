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
	<td>Nombre del reporte</td>

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



<tr valign="top" bgcolor="#FFFFFF">
	<td>Tipo de Reporte</td>

	<td>
		<select name="idactivo" class="text1">
			  <option value="1">Listado</option>
			  <option value="2">Inactivo</option>
			  <option value="3">Personalizado</option>

		</select>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td>Si su reporte es tipo listado, seleccione la fuente de datos de los formularios</td>

	<td>
		<select name="dstabla" class="text1">
<?
$sql="select id, dsm from  framecf_tbltiposformularios where idactivo not in (9) order by dsm asc ";
     $result = $db->Execute($sql);
     if (!$result->EOF) {
     	  while(!$result->EOF) {
    $id=$result->fields[0];
    $dsm=$result->fields[1];

?>
			  <option value="<? echo $id?>"><? echo $dsm?></option>

<? 
  $result->Movenext();
} 
}
$result->Close();
?>

		</select>
	
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td>Si su reportes personalizado, digite la ruta</td>

	<td>
	<? $contadorx="dsruta_counter";$valorx="255";$formax="u";$campox="dsruta";?>
	<input type=text name=dsruta size=60 maxlength="255" placeholder="<? echo $dsruta?>" class=text1 onKeyPress="ocultar('capa_dsruta')"
	value="" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

		<?
		$nombre_capa="capa_dsruta";
		$mensaje_capa="Debe ingresar el titulo de la red";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");
		?>
	</td>
</tr>


<tr valign="top" bgcolor="#FFFFFF">
	<td>Agregar Filtro por fecha</td>

	<td>
		<select name="idfecha" class="text1">
			  <option value="1">SI</option>
			  <option value="2">NO</option>
		</select>
	</td>
</tr>

<tr valign="top" bgcolor="#FFFFFF">
	<td>Agregar Filtro por usuario</td>
	<td>
		<select name="idusuario" class="text1">
			  <option value="1">SI</option>
			  <option value="2">NO</option>
		</select>
	</td>
</tr>


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