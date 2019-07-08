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
$sql="select id,dsm";
if ($idtienda>1 && $tabla=="tblbanners") $sql.=",idtienda ";
if($validar=="")$validar="where 1";
$sql.=" from $tablaorigen ".$validar;
$sql.=" $datasqladd order by dsm asc ";
//echo $sql;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
?>

<table width="100%" border="0" cellpadding="2" cellspacing="0" class="text1">
<tr>
	<td>
		<input type="checkbox" name="Adjuntar" value="1" onclick="ActivarTodoGeneral('u','Adjuntar','sel[]')" />
		<strong>Seleccionar todo</strong>
	</td>
</tr>
</table>

<table width="100%" border="0" cellpadding="2" cellspacing="0" class="text1">
<?
	while (!$resultx->EOF) {
	?>
	 <tr >
	<?
		include($rutxx."../relaciones/relaciones.datos.php");//2
		$resultx->MoveNext();
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.php");//2
			$resultx->MoveNext();
		 }
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.php");//2
			$resultx->MoveNext();
		 }

		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.php");//2
			$resultx->MoveNext();
		 }

	} // fin while
?>
	</tr>
</table>
<?
}
$resultx->Close();
?>












