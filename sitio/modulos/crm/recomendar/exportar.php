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
*/
// exportar
header("Content-type: application/octet-stream");
$nombre="exportar-".date("Ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/comunes.php");
include($rutxx."../../incluidos_modulos/varconexion.php");
include($rutxx."../../incluidos_modulos/modulos.funciones.php");
include($rutxx."../../incluidos_modulos/varmensajes.php");
$titulomodulo="Listado de recomendados en el sitio";
$tabla=" tblrecomendar";
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.nombredesde,a.desdecorreo,a.nombrehacia,haciacorreo,dscom,dsfecha";
$sql.=" from $tabla a where id>0 ";
$sql.=" order by a.id desc  ";
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
	// fin modulo buscador
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=9999999; // maximo de registros
		include("correos.tabla.php");
		echo "<br>";
	} // fin si
$result->Close();
?>