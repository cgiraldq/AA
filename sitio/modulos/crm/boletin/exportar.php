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
$nombre="exportar-".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varmensajes.php");
$titulomodulo="Listado de correos en el sitio";
$idtiendax=$_REQUEST['idtiendax'];
$letra=$_REQUEST['letra'];
$tabla="tblcontacto";
// generacion del encabezado de acuerdo a los resultados encontrados

$sql="select a.id,a.dscorreocliente,a.idtienda";
$sql.=" from $tabla a where id>0 and dstipo =3";
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