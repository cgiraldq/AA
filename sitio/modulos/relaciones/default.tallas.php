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
$sql="select id,dsm from $tablaorigen4 where id>1 order by dsm asc ";
$resultx = $db->Execute($sql);
if (!$resultx->EOF) {
?>
<table width="100%" border="0" cellpadding="2" cellspacing="0" class="text1">
<tr><td><input type="checkbox" name="Adjuntar4" value="1" onclick="ActivarTodoGeneral('u','Adjuntar4','sel4[]')" /><strong>Seleccionar todo</strong></td></tr>
</table>
<table width="100%" border="0" cellpadding="2" cellspacing="0" class="text1">
<?
	while (!$resultx->EOF) {
	?>
	
	<?
		include($rutxx."../relaciones/relaciones.datos.tallas.php");//2
		$resultx->MoveNext();
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.tallas.php");//2
			$resultx->MoveNext();
		 }
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.tallas.php");//2
			$resultx->MoveNext();
		 }
		 
		 if (!$resultx->EOF) {
			include($rutxx."../relaciones/relaciones.datos.tallas.php");//2
			$resultx->MoveNext();
		 }
		 
	} // fin while 
?>
	
</table>	
<?
}
$resultx->Close();
?>












