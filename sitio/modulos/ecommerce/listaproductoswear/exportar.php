<?
//header('Content-Type: text/html; charset=UTF-8');
$nombre="exportar-".date("ymdhis").".xls";
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$nombre);
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
header("Pragma: no-cache");
header("Expires: 0");
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

$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
// $db->debug=true;
$titulomodulo="Listado De  Poductos ".$autorizado;
$tabla="ecommerce_tblproductos";
		$sql="select dsm,dsreferencia,dsd,dsd2,preciocompra,precio1,precio2,precio3,precio4,precio5,dsflete,iva,";//11
		$sql.="volumen,peso,ancho,alto,largo,dsfechainicial,idfechainicial,dsfechafinal";//19
		$sql.=",idproveedor,";//20
		$sql.="dsunidadesdispo,id,dsunidad,idpos,dscarac,dscondiciones,dsmarca";//27
		$sql.=" from $tabla  ";
		$sql.=" where id>0 order by  dsm asc  ";
//exit;
	 $result = $db->Execute($sql);
	if (!$result->EOF) {
		$exportardatos=1; // bloquea controles no necesarios
		$maxregistros=999999; // maximo de registros
		include("producto.exportar.tabla.php");
		echo "<br>";
	} // fin si
$result->Close();
?>