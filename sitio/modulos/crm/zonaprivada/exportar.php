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
$nombre="exportar_clientes-".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
$rc4 = new rc4crypt();
$titulomodulo="Listado de correos en el sitio";
$tabla="tblregistro_zonaprivada";
$sql="select a.id,a.dsm,a.idactivo,a.dstelefono,a.dscorreocliente,a.dscontrasena,a.dsfecha,";//6
$sql.=" a.dsapellidos,a.dspais,a.dsdireccion,a.dsciudad,a.dstipo from $tabla a where id>0 and idactivo<>9";
$sql.=" order by a.id desc  ";
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		include("tabla.exportar.php");
		echo "<br>";
	} // fin si
$result->Close();
?>