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
// exportar
header("Content-type: application/octet-stream");
$nombre="exportar-".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varmensajes.php");
$titulomodulo="Listado de correos en el sitio";
$tabla="tblregistro_zonaprivada";
// generacion del encabezado de acuerdo a los resultados encontrados

$sql="select a.dsm,a.idpos,a.idactivo,a.dstelefono,a.dscorreo,dsdireccion,a.dsciudad,a.dspais,a.dsapellido,a.dscontrasena";
$sql.=" from $tabla a where idactivo not in (9) ";
$sql.=" order by a.id desc  ";

//echo $sql;
	// modulo buscador
		// 1. por cual campo se lista cuando se usa letra
		$campoletra="dsnombre";
		// 2. los tipo de busqueda
	// fin modulo buscador
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=9999999; // maximo de registros
		include("tabla.php");
		echo "<br>";
	} // fin si
$result->Close();
?>