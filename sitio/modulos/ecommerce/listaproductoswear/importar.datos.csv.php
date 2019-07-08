<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
//header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=iso-8859-1');
ini_set('memory_limit', '256M');
ini_set("max_execution_time", 999);
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
IMPORTAR DATOS CSV
*/
session_start();
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");
$db->debug=true;
$tabla="tblproductos";
// subiendo el archivo
   $rutaImagen="../../../contenidos/images/productos/";
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
		$sql="dsm,dsreferencia,dsd,preciocompra,precio1,precio2,preciodescuento,iva,";//7
		$sql.="preciodistribuidor,";
		$sql.="volumen,peso,ancho,alto,largo,dsfechainicial,idfechainicial,dsfechafinal,idfechafinal,";//16
		$sql.="dsimgcarrito,dsimg1,dsimg2,dsimg3,dsimg7,dsimg8,dsimg9,dsimg10,dsimg4,dsimg5,dsimg6,idproveedor,idactivo,idtipo,";//25
		$sql.="idmasvendido,idtipoprod,dsunidadesdispo,dsunidad,dsruta";//31
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
				$i =0;
				$sep=";";
				while ($objfila = fgetcsv ($file,1000,$sep)){
				if ($i>0) {
						# code...
							$dsm					=(($objfila[0]));
							$dsreferencia			=(($objfila[1]));
							$dsd					=trim(reemplazar($objfila[2]));
							$dsd2					=trim(reemplazar($objfila[3]));
							$preciocompra			=trim(reemplazar($objfila[4]));
							$precio1				=trim(reemplazar($objfila[5]));
							$preciodistribuidor		=trim(reemplazar($objfila[6]));


							$precio2				=trim(reemplazar($objfila[7]));
							//$descuento				=trim($objfila[7]);
							$preciodescuento		=trim(reemplazar($objfila[8]));
							//$precio3				=trim($objfila[9]);
							$iva					=trim(reemplazar($objfila[9]));
							
							$volumen				=trim(reemplazar($objfila[10]));
							$peso					=trim(reemplazar($objfila[11]));
							$ancho					=trim(reemplazar($objfila[12]));
							$alto					=trim(reemplazar($objfila[13]));
							$largo					=trim(reemplazar($objfila[14]));
							$dsfechainicial 	=   trim(reemplazar($objfila[15]));
							if ($dsfechainicial<>"") {
							$dsfechainicial			=explode("-",$dsfechainicial);
							$dsfechainicial			="20".$dsfechainicial[2]."/".$dsfechainicial[0]."/".$dsfechainicial[1];
								$idfechainicial    		= str_replace("/","",$dsfechainicial);
							}
							else
							{
								$idfechainicial=0;
							}
							$dsfechafinal			=trim(reemplazar($objfila[16]));
							if ($dsfechafinal<>"") {
								$dsfechafinal			=explode("-",$dsfechafinal);
								$dsfechafinal			="20".$dsfechafinal[2]."/".$dsfechafinal[0]."/".$dsfechafinal[1];
								$idfechafinal			=str_replace("/","",$dsfechafinal);
							}else{
								$idfechainicial=0;
							}
							$dsimg2 				=trim(reemplazar($objfila[17]));
							$dsimg3					=trim(reemplazar($objfila[18]));
							$dsimg5					=trim(reemplazar($objfila[19]));
							$dsimg6					=trim(reemplazar($objfila[20]));
							$dsimg8					=trim(reemplazar($objfila[21]));
							$dsimg9					=trim(reemplazar($objfila[22]));
							$idproveedor			=trim(reemplazar($objfila[23]));
							if ($idproveedor=="") $idproveedor=0;
							$nomcategoria			=trim(reemplazar($objfila[24]));
							$nomsubcategoria			=trim(reemplazar($objfila[25]));
							$dsunidadesdispo				=trim(reemplazar($objfila[26]));
							$dsunidad				=trim(reemplazar($objfila[27]));

							if ($dsunidadesdispo=="") $dsunidadesdispo=1; // cantidad minima disponible
							if ($dsunidad=="") $dsunidad=1; // cantidad por unidad

							$idactivo				=1;
							$idtipo					=1;
							$idpubcorreo			=0;
							$idmasvendido			=2;
							$dsrefinterna			=$dsreferencia."-".$idproveedor;
	if ($idoperacion==1) {
	}
	switch ($idoperacion) {
		case 1: //Modifica o guarda registros
							if ($dsm<>""){
							$sqlS="select a.id,a.dsunidadesdispo ";
							$sqlS.=" from $tabla a ";
							$sqlS.=" where a.id>0 ";
							$sqlS.=" and (";
							$sqlS.="dsm='$dsm'";
							if ($dsreferencia<>"") $sqlS.=" or a.dsreferencia='$dsreferencia'";  
							$sqlS.=")";
							//echo $sqlS;
							$result = $db->Execute($sqlS);
							
							if (!$result->EOF) {
									$cantidadbase=$result->fields[1];
									$idx=$result->fields[0];
									$sqlU=" update $tabla set ";
									$sqlU.="dsm 						='$dsm'";
									$sqlU.=",dsruta						='".limpieza(strtolower($dsm))."'";

									$sqlU.=",dsreferencia 				='$dsreferencia'";
									$sqlU.=",dsd 						='$dsd'";
									$sqlU.=",preciocompra 				='$preciocompra'";
									$sqlU.=",precio1 					='$precio1'";
									$sqlU.=",precio2 					='$precio2'";
									$sqlU.=",preciodescuento 			='$preciodescuento'";
									$sqlU.=",iva 						='$iva'";
									$sqlU.=",preciodistribuidor			='$preciodistribuidor'";

									$sqlU.=",volumen 					='$volumen'";
									$sqlU.=",peso 						='$peso'";
									$sqlU.=",ancho 						='$ancho'";
									$sqlU.=",alto 						='$alto'";
									$sqlU.=",largo 						='$largo'";
									$sqlU.=",dsfechainicial 			='$dsfechainicial'";
									$sqlU.=",idfechainicial 			=$idfechainicial";
									$sqlU.=",dsfechafinal 				='$dsfechafinal'";
									$sqlU.=",idfechafinal 				=$idfechafinal";
									$sqlU.=",dsimgcarrito 				='$dsimg2'";
									$sqlU.=",dsimg10 					='$dsimg2'";

									$sqlU.=",dsimg1 					='$dsimg2'";
									$sqlU.=",dsimg2 					='$dsimg2'";
									$sqlU.=",dsimg3 					='$dsimg3'";

									$sqlU.=",dsimg7 					='$dsimg8'";
									$sqlU.=",dsimg8 					='$dsimg8'";
									$sqlU.=",dsimg9 					='$dsimg9'";

									$sqlU.=",dsimg4 					='$dsimg5'";
									$sqlU.=",dsimg5 					='$dsimg5'";
									$sqlU.=",dsimg6 					='$dsimg6'";
									//$sqlU.=",idmarca 					='$idmarca'";
									$sqlU.=",idproveedor 				='$idproveedor'";
									$sqlU.=",idactivo 					=$idactivo";
									$sqlU.=",idtipo 					=$idtipo";
									$sqlU.=",idtipoprod 				=$idtipo";
									//$sqlU.=",idpubcorreo 				=$idpubcorreo";
									$sqlU.=",idmasvendido 				=$idmasvendido";
									if ($dsreferencia<>"") {
									//$sqlU.=",dsrefinterna  				='$dsrefinterna'";
									}
									if ($dsunidadesdispo>0) {
										 $sqlU.=",dsunidadesdispo=$dsunidadesdispo"; // validacion de existencia
										 // insercion en inventarios
				 						// INSERCION EN IVENTARIO
    									$dsproductoi=$dsreferencia;
										if ($dsproductoi=="") $dsproductoi=$dsm;
										$idproductoi=$idx;
										$dscomi="ACTUALIZACION CANTIDAD DESDE IMPORTAR PRODUCTO";
										$idtipoi=1; //entrada
										$idcanti=$dsunidadesdispo;
										include("../inventarios/insercion.php");
									}
									$sqlU.=",dsunidad 				=$dsunidad";

									$sqlU.=" where id=".$idx."";
//									echo $sqlU;
//									exit();
									if ($db->Execute($sqlU)){
										$id = $idx;

									include("proceso.importardatos.php");

								}
//								exit();
							}else{//else consulta


								$sqlinsert=" insert into $tabla ($sql) ";
								$sqlinsert.="values";
		
								$sqlinsert.=" ('".$dsm."','".$dsreferencia."','".$dsd."'";
								$sqlinsert.=",'".$preciocompra."','".$precio1."','".$precio2."'";
								$sqlinsert.=",'".$preciodescuento."','".$iva."'";
								$sqlinsert.=",'".$preciodistribuidor."'";
								$sqlinsert.=",'".$volumen."'";
								$sqlinsert.=",'".$peso."','".$ancho."','".$alto."','".$largo."','".$dsfechainicial."'";
								$sqlinsert.=",".$idfechainicial.",'".$dsfechafinal."',".$idfechafinal.",'".$dsimg2."'";
								$sqlinsert.=",'".$dsimg2."','".$dsimg2."','".$dsimg3."','".$dsimg8."','".$dsimg8."','".$dsimg9."','".$dsimg2."','".$dsimg5."','".$dsimg5."'";
								$sqlinsert.=",'".$dsimg6."',".$idproveedor.",".$idactivo.",".$idtipo.",".$idmasvendido;
								if ($dsreferencia<>"") {
								//$sqlinsert.=" ,'".$dsrefinterna."'";
								}
								$sqlinsert.=" ,".$idtipo."";
								$sqlinsert.=",".$dsunidadesdispo;

								$sqlinsert.=",".$dsunidad;
								$sqlinsert.=",'".limpieza(strtolower($dsm))."'";
								$sqlinsert.=")";
echo "Problemas no debe entrar por aca:<br>".$sqlS."<br>".$sqlinsert;
exit();
								if ($db->Execute($sqlinsert)){
									$sqlX="select a.id";
									$sqlX.=" from $tabla a ";
									$sqlX.=" where a.id>0 ";
									$sqlX.=" and (";
									$sqlX.=" dsm='$dsm'";
									if ($dsreferencia<>"") $sqlX.=" or dsreferencia='$dsreferencia'";

									$sqlX.=") order by id DESC LIMIT 0,1";
									$resultX = $db->Execute($sqlX);
									if (!$resultX->EOF) {
										$id = $resultX->fields[0];
										include("proceso.importardatos.php");
											// INSEERTANDO EN INVENTARIO
											if ($dsunidadesdispo>0) {
												$dsproductoi=$dsreferencia;
												if ($dsproductoi=="") $dsproductoi=$dsm;
												$idproductoi=$id;
												$dscomi="INGRESO CANTIDAD DESDE IMPORTAR PRODUCTO";
												$idtipoi=1; //entrada
												$idcanti=$dsunidadesdispo;
												include("../inventarios/insercion.php");
											}
									}
									$resultX->Close();
								}
							}
							$result->Close();
							}//fin verificar referencia
//					exit();		
break;
	case 2://Elimina registros
		if ($dsreferencia<>""){
			$sql="delete from $tabla where (dsreferencia ='".$dsreferencia."' or dsm='".$dsm."' )";
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
exit();
?>
<html>
<title>VALIDANDO....</title>
<head>
<link rel="stylesheet" type="text/css" href="../estilo.css">
`<meta http-equiv="REFRESH" content="3; URL=default.producto.php">
</head>
<body class="texto">
<table width="30%" border="0" align="center" cellpadding="0" cellspacing="0">
<!-- fwtable fwsrc="cargando.png" fwbase="cargando.gif" fwstyle="Dreamweaver" fwdocid = "818410090" fwnested="0" -->
  <tr class="texblanco">
       <td colspan="2">EL PROCESO HA SIDO REALIZADO.</td>
  </tr>
  <tr class="texblanco">
       <td colspan="2">Un momento la pagina se redireccionar&aacute; en 3 segundos.</td>
  </tr>
</table>

</body>
</html>