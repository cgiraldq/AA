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
// script genercico que arma las relaciones dependiendo de los datos

tabla orgien: de donde se cargan los datos base
tabla detalle: donde curzan los datos
idbase: el id del objeto de relacion
*/
$datasqladd=" and idactivo not in (2,9)";
	$tablaorigen="tblcategoria";
$sql="select id,dsm";
if ($idtienda>1 && $tabla=="tblbanners") $sql.=",idtienda ";

$sql.=" from $tablaorigen where 1";
$sql.=" $datasqladd order by dsm asc ";
//echo $sql;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
?>
<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<tr><td><input type="checkbox" name="Adjuntarx" value="1" onclick="ActivarTodoGeneral('u','Adjuntarx','selx[]')" /><strong>Seleccionar todo</strong></td></tr>
</table>
<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<tr valign=top bgcolor="#FFFFFF">
	<td colspan="2">
		<strong>RELACIONES.</strong> Asocie en que categor&iacute;a desea ver este producto
	<br>
<?
	while (!$resultx->EOF) {
	?>
	 <tr >
	<?
		include($rutxx."../relaciones/relaciones.datos.categoria.php");//2
		$resultx->MoveNext();
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.categoria.php");//2
			$resultx->MoveNext();
		 }
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.categoria.php");//2
			$resultx->MoveNext();
		 }

		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.categoria.php");//2
			$resultx->MoveNext();
		 }

	} // fin while
?>
	</tr>
	</td>
</tr>
</table>
<?
}
$resultx->Close();
?>












