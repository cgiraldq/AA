<?
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0
//header('Content-Type: text/html; charset=iso-8859-1');
ini_set('memory_limit', '256M');
ini_set("max_execution_time", 999);
ini_set("max_input_time", 999);
ini_set("session.cache_expire ", 999);
ini_set('session.gc_Maxlifetime',999);
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
// NUEVO METODO DE EXPORTAR DATOS USANDO LA CLASE PHPEXCEL
// constructor de los datos
$rutx=1;
include("../../../incluidos_modulos/comunes.php");
include("../../../incluidos_modulos/varconexion.php");
include("../../../incluidos_modulos/modulos.funciones.php");

$tabla="tblproductos";
		$sql="select dsm,dsreferencia,dsd,dsd2,preciocompra,precio1,precio2,precio3,precio4,precio5,dsflete,iva,";//11
		$sql.="volumen,peso,ancho,alto,largo,dsfechainicial,idfechainicial,dsfechafinal";//19
		$sql.=",idproveedor,";//20
		$sql.="dsunidadesdispo,id,dsunidad,idpos,dscarac,dscondiciones,idmarca";//27
		$sql.=" from $tabla  ";
		$sql.=" where id>0 order by  dsm asc  ";
// vector de encabezado
$tmparray =array("Nombre","Referencia","Descripción corta","Descripción Larga",
	"Precio Compra","Precio 1","Precio 2","precio 3","Precio 4",
	"Precio 5","Valor flete","Procentaje Impuestos","Volumen",
	"Peso","Ancho","Alto","Largo","Fecha Inicial","Fecha Final",
	"Id Proveedor","Imagenes","Categoria","Subcategoria","Cantidad Disponible",
	" Cantidad x Unidad","Caracteristicas","Garantias","Marca","Idproducto");


	 $result = $db->Execute($sql);
	if (!$result->EOF) {
require_once '../../../incluidos_modulos/phpexcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("Plataforma Integrada Comprandofacil S.A")
							 ->setLastModifiedBy("Plataforma Integrada Comprandofacil S.A")
							 ->setTitle("Office 2007 XLSX")
							 ->setSubject("Office 2007 XLSX ")
							 ->setDescription("Office 2007 XLSX")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Listado productos");
$objPHPExcel->setActiveSheetIndex(0);
// armazon del lector de letras 
$columna="A";
$pos=1;
for ($i = 0; $i <count($tmparray); $i++){
		$objPHPExcel->getActiveSheet()->setCellValue($columna.$pos, utf8_encode($tmparray[$i]));
    	$columna++;            
}           
$pos=2; 
	while (!$result->EOF) {
		  $objPHPExcel->getActiveSheet()->setCellValue("A".$pos,utf8_encode(trim($result->fields[0])));//<!--nombre-->
		  $objPHPExcel->getActiveSheet()->setCellValue("B".$pos,utf8_encode(trim($result->fields[1])));//<!--ref-->
		  $objPHPExcel->getActiveSheet()->setCellValue("C".$pos,utf8_encode(strip_tags($result->fields[2])));//<!--desc corta-->
		  $objPHPExcel->getActiveSheet()->setCellValue("D".$pos,utf8_encode(strip_tags($result->fields[3])));//<!--desc larga-->

		  $objPHPExcel->getActiveSheet()->setCellValue("E".$pos,reemplazar(trim($result->fields[4])));//<!--precio compra-->
		  $objPHPExcel->getActiveSheet()->setCellValue("F".$pos,reemplazar(trim($result->fields[5])));//<!--precio 1-->
		  $objPHPExcel->getActiveSheet()->setCellValue("G".$pos,reemplazar(trim($result->fields[6])));//<!--precio 2-->
		  $objPHPExcel->getActiveSheet()->setCellValue("H".$pos,reemplazar(trim($result->fields[7])));//<!--precio 3-->
		  $objPHPExcel->getActiveSheet()->setCellValue("I".$pos,reemplazar(trim($result->fields[8])));//<!--precio 4-->
		  $objPHPExcel->getActiveSheet()->setCellValue("J".$pos,reemplazar(trim($result->fields[9])));//<!--precio 5-->
		  $objPHPExcel->getActiveSheet()->setCellValue("K".$pos,reemplazar(trim($result->fields[10])));//<!--precio flete-->

		  $objPHPExcel->getActiveSheet()->setCellValue("L".$pos,reemplazar(trim($result->fields[11])));//<!--% iva-->
		  $objPHPExcel->getActiveSheet()->setCellValue("M".$pos,reemplazar(trim($result->fields[12])));//<!-- volumen-->
		  $objPHPExcel->getActiveSheet()->setCellValue("N".$pos,reemplazar(trim($result->fields[13])));//<!-- peso-->
		  $objPHPExcel->getActiveSheet()->setCellValue("O".$pos,reemplazar(trim($result->fields[14])));//<!-- ancho -->
		  $objPHPExcel->getActiveSheet()->setCellValue("P".$pos,reemplazar(trim($result->fields[15])));//<!-- alto -->
		  $objPHPExcel->getActiveSheet()->setCellValue("Q".$pos,reemplazar(trim($result->fields[16])));//<!-- largo -->
			$objPHPExcel->getActiveSheet()->setCellValue("R".$pos,reemplazar(trim($result->fields[17])));//<!-- fecha inicial -->
			$objPHPExcel->getActiveSheet()->setCellValue("S".$pos,reemplazar(trim($result->fields[19])));//<!-- fecha final -->
			$objPHPExcel->getActiveSheet()->setCellValue("T".$pos,reemplazar(trim($result->fields[20])));
$id=$result->fields[22];
// nombre categortia

$sql="select iddestino from tblsubcategoriaxtblproducto where idorigen=$id";
$resultx= $db->Execute($sql);
$subcategoria="";
if (!$resultx->EOF) {
while (!$resultx->EOF){
$subcategoriax=$resultx->fields[0];
$subcategoriax=seldato('dsm','id','tblsubcategoriasxcategoria',$subcategoriax,1);
$subcategoria=$subcategoria."|".$subcategoriax;

$resultx->MoveNext();
}
}
$resultx->Close();

$sqlx="select iddestino from tbltblproductoxcategoria where idorigen=$id";
$resultxx= $db->Execute($sqlx);
$categoria="";
if (!$resultxx->EOF) {
while (!$resultxx->EOF){
$categoriax=$resultxx->fields[0];
$categoriax=seldato('dsm','id','tblcategoria',$categoriax,1);
$categoria=$categoria."|".$categoriax;

$resultxx->MoveNext();
}
}
$resultxx->Close();
$sqlm="select dsimg from ecommerce_tblproductoximg where iddestino=$id";
$resultm= $db->Execute($sqlm);
$dsimg="";
if (!$resultm->EOF) {
while (!$resultm->EOF){
$dsimgx=$resultm->fields[0];
$dsimg=$dsimg."|".$dsimgx;

$resultm->MoveNext();
}
}
$resultm->Close();
		$objPHPExcel->getActiveSheet()->setCellValue("U".$pos,$dsimg);		
		$objPHPExcel->getActiveSheet()->setCellValue("V".$pos,reemplazar($categoria));
		$objPHPExcel->getActiveSheet()->setCellValue("W".$pos,reemplazar($subcategoria));

		  $objPHPExcel->getActiveSheet()->setCellValue("X".$result->fields[21]);//unidades disponibles
		  $objPHPExcel->getActiveSheet()->setCellValue("Y".$result->fields[23]);//cantida por unidad
		  $objPHPExcel->getActiveSheet()->setCellValue("Z".reemplazar(strip_tags($result->fields[25])));//caracteristicas
		  $objPHPExcel->getActiveSheet()->setCellValue("AA".reemplazar(strip_tags($result->fields[26])));//garantia
		  $objPHPExcel->getActiveSheet()->setCellValue("AB".reemplazar(strip_tags(seldato('dsm','id','ecommerce_tblmarcas',$result->fields[27],1))));//idmarca
		  $objPHPExcel->getActiveSheet()->setCellValue("AC".$result->fields[22]); // idproducto

		// constructor de datos
		$result->MoveNext();
	$pos++;	
	} // fin while


	} // fin si
$result->Close();


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('productos');
$objPHPExcel->setActiveSheetIndex(0);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

exit;
?>