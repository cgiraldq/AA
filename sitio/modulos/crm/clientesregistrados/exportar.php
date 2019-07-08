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
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$rc4 = new rc4crypt();

$titulomodulo="Listado de clientes registrados en el sitio";
$tabla="tblclientes";
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.id,a.dscodigousa,a.dscodigouk,a.dsnombres,a.dsapellidos";
$sql.=",a.dstelefono,a.dstelefono2,a.dsdireccion,a.dsmovil,a.dsciudad,a.dsdepartamento,a.dspais,a.dscorreocliente";
$sql.=",dstipoidentificacion,a.dsidentificacion,a.dsfechanacimiento,a.dsfecha,a.dsclave,a.idtienda,a.idtiporegistro,a.dsfecharegistro,a.idactivo ";
$sql.=" from $tabla a where id>0  ORDER by id desc";



	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=9999999; // maximo de registros
		include("contacto.tabla.php");
		echo "<br>";
	} // fin si
$result->Close();
?>