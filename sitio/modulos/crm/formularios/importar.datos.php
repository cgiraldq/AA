<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=iso-8859-1');
ini_set('memory_limit', '256M');
ini_set("max_execution_time", 9999);
ini_set("max_input_time", 999);
ini_set("session.cache_expire ", 999);
ini_set('session.gc_Maxlifetime',999);
/*
| ----------------------------------------------------------------- |
http://www.comprandofacil.com/
Copyright (c) 2000 - 2005
Medellin - Colombia
=====================================================================
  Autores:
  Juan Fernando Fernández <consultorweb@comprandofacil.net>
  Juan Felipe Sánchez <graficoweb@comprandofacil.net>
  José Fernando Peña <soporteweb@comprandofacil.net>
=====================================================================
| ----------------------------------------------------------------- |
 Cargar datos al servidor usando archivo de excel
 libreria generica de uso publico
*/
session_start();
$rutx=1;
$injection="no";
include("../../../incluidos_modulos/modulos.globales.php");
//$db->debug=true;
$tabla="tblproductos";
// subiendo el archivo
   $rutaImagen="../../../../contenidos/images/producto";
// modificacion version 2.1.1.
// subir imagen por aca
	$site_name = $_SERVER['HTTP_HOST'];
	$upload_dir = $rutaImagen."/";
	$upload_url = $url_dir.$rutaImagen;
	$message ="";
	$idoperacion = $_REQUEST['idoperacion'];
	// si la idoperacion es 1 se guardaran o modificaran registros
	// si la idoperacion es 2 se eliminaran registros
	//create upload_files directory if not exist
	//If it does not work, create on your own and change permission.
	if (!is_dir($upload_dir)) {
		die ("Primero debe esta la carpeta configurada $upload_dir");
	}
	$nombre="userfile1";
	if ($_FILES[$nombre]['name']<>"") {
		$archivobaseimagen="";
		if($contImg=="")$contImg=1;
		if ($_FILES[$nombre]['name']<>"") {
			$temp_name = $_FILES[$nombre]['tmp_name'];
			$imgnom=explode(".",$_FILES[$nombre]['name']);
			$nombreimg=strtolower(limpieza($imgnom[0]));
			$nombre1=$nombreimg."-".date("his")."-".$contImg.".".substr($_FILES[$nombre]['name'],-3);
			move_uploaded_file($temp_name,$rutaImagen.$nombre1);
		} elseif ($valimg<>"") {
		$nombre1=$valimg;
		}else $nombre1="";
		if ($borrar==1) $nombre1="";
		if ($gd==1) {
			$archivobaseimagen=$nombre1;
		} else {
		$imgvec[]=$nombre1;
		$contImg++;
		}
		// captura de datos
		$message = $imgvec[0];
	}else{
		$message = $_REQUEST['dsarchivo'];
	}
if($message<>""){
		// captura de los datos seleccionados en el vector campos
		$campos="dsm,dsd,dsd2,dsfechainicial,idfechainicial,dsfechafinal,idfechafinal,precio1,iva,idactivo,idpos,dsruta,dscategoria";//7
		$totalcampos=1;
		if ($totalcampos<=0 || $totalcampos==""){
			$message = "";
			$valido=="NO";
		} else {
			// leyendo los datos de cada linea del archivo  y concatenarlos
			if (!$file=fopen($rutaImagen.$message,"r+")){
				$valido=="NO";
			} else {
				// leyendo cada linea de datos
				$totaldatos=0;
				// cargando funcion de clase de lectura de excel
				require_once '../../../incluidos_modulos/phpexcel/PHPExcel/IOFactory.php';
				require_once '../../../incluidos_modulos/phpexcel/PHPExcel/IComparable.php';
				require_once '../../../incluidos_modulos/phpexcel/PHPExcel/Style/NumberFormat.php';
				$Objdata = PHPExcel_IOFactory::load($rutaImagen.$message);
				// abrir el archivo
				$data=$Objdata->getActiveSheet()->toArray();
				$i =0;
			foreach ($data as $iIndice => $objfila) {
				if ($i>1) {
					//echo $i."<br>";

							$nomcategoria			=trim(utf8_decode($objfila[0]));
							$nomcategoria 			=str_replace("_"," ",$nomcategoria);
							$nomsubcategoria		=trim(($objfila[1]));
							$nomsubcategoria		=str_replace("_"," ",$nomsubcategoria);
							$nombresubcate2			=trim(($objfila[2]));
							$nombresubcate2			=str_replace("_"," ",$nombresubcate2);
							$dsm					=trim(($objfila[3]));
							$dsm					=str_replace("_"," ",$dsm);
							$dsd					=trim(utf8_encode(htmlentities(htmlspecialchars($objfila[4]))));
							$dsd2					=trim(utf8_encode(htmlentities(htmlspecialchars($objfila[5]))));
							$fechai					=trim(($objfila[6]));
							$fechaf			     	=trim(($objfila[7]));
							$precio         		=trim(($objfila[8]));
							$iva					=trim(($objfila[9]));
							if($iva=="")$iva=0;
							if ($fechai<>"") {
							$dsfechainicial			=explode("-",$dsfechainicial);
							$dsfechainicial			="20".$dsfechainicial[2]."/".$dsfechainicial[0]."/".$dsfechainicial[1];
								$idfechainicial    		= str_replace("/","",$dsfechainicial);
							}
							else
							{
								$idfechainicial=0;
							}

							if ($fechaf<>"") {
								$dsfechafinal			=explode("-",$dsfechafinal);
								$dsfechafinal			="20".$dsfechafinal[2]."/".$dsfechafinal[0]."/".$dsfechafinal[1];
								$idfechafinal			=str_replace("/","",$dsfechafinal);
							}else{
								$idfechainicial=0;
							}
							if ($idproveedor=="") $idproveedor=0;
							$idactivo				=1;
							$idtipo					=1;
							$idpubcorreo			=0;
							$idmasvendido			=2;
							$dsrefinterna			=$dsreferencia."-".$idproveedor;
							$dsruta 				=$dsm."_".$nomcategoria;
							$dsruta					=strtolower(utf8_decode($dsruta));
				if ($idoperacion==1) {
							}
				switch ($idoperacion) {
					case 1: //Modifica o guarda registros
							if ($dsm<>""){
							$sqlS="select a.id,a.dsunidadesdispo ";
							$sqlS.=" from $tabla a ";
							$sqlS.=" where a.id>0 ";
							if ($idproductobase<>"" && $idproductobase>0) {
								$sqlS.=" id in  (";
								$sqlS.=$idproductobase;
								$sqlS.=")";
							} else {
								//$sqlS.=" and  dsd='".($dsd)."'";
								$sqlS.=" and  precio1='".($precio)."'";
								$sqlS.=" and  a.dscategoria='$nomcategoria'";
								$sqlS.=" and (";
								$sqlS.="dsm='".($dsm)."'";
								$sqlS.=")";
							}
							//echo $sqlS."<br>";
							$result = $db->Execute($sqlS);

							if (!$result->EOF) { // actualiza los productos
								//	echo "Acvtualizar";
									$cantidadbase=$result->fields[1];
									$idx=$result->fields[0];
									$sqlU=" update $tabla set ";
									$sqlU.="dsm='".($dsm)."'";
									$sqlU.=",dsruta						='".limpieza(strtolower($dsruta))."'";
									$sqlU.=",dscategoria 				='$nomcategoria'";
									$sqlU.=",dsd 						='$dsd'";
									$sqlU.=",dsd2 						='$dsd2'";
									$sqlU.=",precio1 					='$precio'";
									$sqlU.=",iva 						='$iva'";
									$sqlU.=",dsfechainicial 			='$dsfechainicial'";
									$sqlU.=",idfechainicial 			=$idfechainicial";
									$sqlU.=",dsfechafinal 				='$dsfechafinal'";
									$sqlU.=",idfechafinal 				='$idfechafinal'";
									$sqlU.=",idproveedor 				='$idproveedor'";
									$sqlU.=",idactivo 					=$idactivo";
									$sqlU.=",idtipo 					=$idtipo";
									$sqlU.=",idtipoprod 				=$idtipo";
									$sqlU.=",idmasvendido 				=$idmasvendido";
									$sqlU.=" where id=".$idx."";
									//echo $sqlU."<br>";
//									exit();
									if ($db->Execute($sqlU)){
										$id = $idx;
								}
								}else{//else consulta
								//echo "Ingresa";
								// inserta productos
								$sqlinsert=" insert into $tabla ($campos) ";
								$sqlinsert.="values";
								$sqlinsert.=" ('".$dsm."','".$dsd."','".$dsd2."'";
								$sqlinsert.=",'".$dsfechainicial."','".$idfechainicial."','".$dsfechafinal."'";
								$sqlinsert.=",'".$idfechafinal."','".$precio."'";
								$sqlinsert.=",'".$iva."',1,0";
								$sqlinsert.=",'".limpieza(strtolower($dsruta))."','".$nomcategoria."'";
								$sqlinsert.=")";
								if ($db->Execute($sqlinsert)){

								$sqlSx="select a.id,a.dsunidadesdispo ";
								$sqlSx.=" from $tabla a ";
								$sqlSx.=" where a.id>0 ";
								$sqlSx.=" and  precio1='".($precio)."'";
								$sqlSx.=" and  a.dscategoria='$nomcategoria'";
								$sqlSx.=" and (";
								$sqlSx.="dsm='".($dsm)."'";
								$sqlSx.=")";
								//echo $sqlSx."<br><br><br>";
								$result_in = $db->Execute($sqlSx);
								if (!$result_in->EOF) {
								$idx=$result_in->fields[0];
								}$result_in->Close();




								}
							}
							$result->Close();

							// manejo de categortia y subcategoria
							include("proceso.importardatos.php");


							}//fin verificar referencia
//					exit();
break;
	case 2://Elimina registros
		if ($dsreferencia<>""){
			$sql="delete from $tabla where";
			$sqlSx.=" precio1='".($precio)."' and dsm='".$dsm."'";
			$sqlSx.=" and  a.dscategoria='$nomcategoria'";
			if ($db->Execute($sql)){} ;
		}
		break;
}
			} // fin if
			$i++;


			// borrar archivo
			@unlink($rutaImagen.$message);
			$valido="SI";
			}
		} // fin de validacion de $totalcampos
	}
}
//exit();
?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<meta http-equiv="REFRESH" content="5; URL=registros.php">
<table width="100%" cellpadding="0" cellspacing="0" align="center"  border=1 class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


		<table width="70%"  cellpadding="0" cellspacing="0" class="texto_centro" >
		        <tr>
		         	<td width="615" align="left" valign="middle">
		        		<img src="../../../img_modulos/modulos/edicion.png">
		         		<h1>EL PROCESO HA SIDO REALIZADO.</h1>
		         	</td>
		        </tr>
		          <tr>
		        	<td width="615" align="left" valign="middle">
		        	  		<p>Un momento la pagina se redireccionar&aacute; en 5 segundos.</p>
		         	</td>
		        </tr>
		</table>

</td>
</tr>
</table>
<?include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");
?>
</body>
</html>