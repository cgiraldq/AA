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
// exportar pero con formato de importacion para verificacion de cargas
header("Content-type: application/octet-stream");
$nombre="exportar-".date("ymdhis").".xls";
header("Content-Disposition: attachment; filename=$nombre");
header("Pragma: no-cache");
header("Expires: 0");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");
$rc4 = new rc4crypt();
$titulomodulo="Listado de clientes registrados en el sitio";
$tabla="tblbeneficiosn";
// generacion del encabezado de acuerdo a los resultados encontrados
		$sql="select dsm,dsreferencia,dsd,dsd2,preciocompra,precio1,precio2,preciodescuento,iva,";//7
		$sql.="volumen,peso,ancho,alto,largo,dsfechainicial,idfechainicial,dsfechafinal";//17
		$sql.=",dsimg2,dsimg3,dsimg5,dsimg6,dsimg8,dsimg9,idproveedor,";
		$sql.="dsunidadesdispo,id,dsunidad,preciodistribuidor,idpos";
		$sql.=" from $tabla  ";
		$sql.=" where idactivo not in (2,9) order by  dsm asc  ";
//exit;
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=9999999; // maximo de registros
		include("beneficios.exportar.tabla.php");
		echo "<br>";
	} // fin si
$result->Close();
?>