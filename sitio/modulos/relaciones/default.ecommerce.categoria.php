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
// script genercico que arma las relaciones dependiendo de los datos

tabla orgien: de donde se cargan los datos base
tabla detalle: donde curzan los datos
idbase: el id del objeto de relacion
*/
$datasqladd=" and idactivo not in (2,9)";
	$tablaorigen="ecommerce_tblcategoria";
$sql="select id,dsm";
if ($idtienda>1 && $tabla=="tblbanners") $sql.=",idtienda ";

$sql.=" from $tablaorigen where 1";
$sql.=" $datasqladd order by dsm asc ";
//echo $sql;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
?>
<table align="center"  cellspacing="1" cellpadding="5" border="0" width=100% class="campos_ingreso">
<tr>
	<td>
	<input type="checkbox" name="Adjuntarx" value="1" onclick="ActivarTodoGeneral('u','Adjuntarx','selx[]')" /><strong>Seleccionar todo</strong></td></tr>
</table>
<table align="center"  cellspacing="1" cellpadding="5" border="0" width=100% class="campos_ingreso">
<tr valign=top bgcolor="#FFFFFF">

<?
	while (!$resultx->EOF) {
	?>
	 <tr >
	<?
		include($rutxx."../relaciones/relaciones.datos.ecommerce.categoria.php");//2
		$resultx->MoveNext();
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.ecommerce.categoria.php");//2
			$resultx->MoveNext();
		 }
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.ecommerce.categoria.php");//2
			$resultx->MoveNext();
		 }

		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.ecommerce.categoria.php");//2
			$resultx->MoveNext();
		 }

	} // fin while
?>
	</tr>

</tr>
</table>
<?
}
$resultx->Close();
?>












