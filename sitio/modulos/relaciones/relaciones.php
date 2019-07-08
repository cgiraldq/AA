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
$sql="select id,dsm from $tablaorigen order by dsm asc ";
//echo $sql;
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
?>
<table width="100%">
<?
	while (!$resultx->EOF) {
		?>
		<tr>
		<td align="left">
		<input type="checkbox" name="sel[]" value="<? echo $resultx->fields[0];?>" style="width: 16px; height: 16px"><? echo reemplazar($resultx->fields[1]);?>
		</td>
		<?
		$resultx->MoveNext();
		 if (!$resultx->EOF) {
			?>
			<td align="left">
			<input type="checkbox" name="sel[]" value="<? echo $resultx->fields[0];?>" style="width: 16px; height: 16px"><? echo reemplazar($resultx->fields[1]);?>
			</td>
			<?
			$resultx->MoveNext();
		 }
		 if (!$resultx->EOF) {
			?>
			<td align="left">
			<input type="checkbox" name="sel[]" value="<? echo $resultx->fields[0];?>" style="width: 16px; height: 16px"><? echo reemplazar($resultx->fields[1]);?>
			</td>
			<?

			$resultx->MoveNext();
		 }
		 		 
	} // fin while 
	?>
	</table>
	<?
}
$resultx->Close();
?>












