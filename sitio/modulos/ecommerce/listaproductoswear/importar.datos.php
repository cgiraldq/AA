<?
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
header('Content-Type: text/html; charset=UTF-8');
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
 Cargar datos al servidor usando archivo de excel
 libreria generica de uso publico
*/
session_start();
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$tabla="ecommerce_tblproductos";

// subiendo el archivo
   $rutaImagen="../../../../contenidos/images/ecommerce_productos/";
// modificacion version 2.1.1.
// subir imagen por aca
	$site_name = $_SERVER['HTTP_HOST'];
	$upload_dir = $rutaImagen."/";
	$upload_url = $url_dir.$rutaImagen;
	$message="";
	$idoperacion = $_REQUEST['idoperacion'];
	$idtipox=$_REQUEST['idtipo'];
	// si la idoperacion es 1 se guardaran o modificaran registros
	// si la idoperacion es 2 se eliminaran registros
	//create upload_files directory if not exist
	//If it does not work, create on your own and change permission.
	if (!is_dir($upload_dir)) {
		die ("Primero debe estar la carpeta configurada $upload_dir");
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
		$campos="dsm,dsreferencia,dsd,dsd2,preciocompra,precio1,precio2,precio3,precio4,precio5,dsflete,iva,";//11
		$campos.="volumen,peso,ancho,alto,largo,dsfechainicial,idfechainicial,dsfechafinal,idfechafinal,";//20
		$campos.="idproveedor,idactivo,idtipo,";//23
		$campos.="idmasvendido,idtipoprod,dsunidadesdispo,dsunidad,dsruta,idpos,dsdisponible,dscarac,dscondiciones,dscaractxt,dsdcondicionestxt,dsd2txt,dsmarca";//28
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
				require_once $rutxx.'../../incluidos_modulos/phpexcel/PHPExcel/IOFactory.php';
				require_once $rutxx.'../../incluidos_modulos/phpexcel/PHPExcel/IComparable.php';
				require_once $rutxx.'../../incluidos_modulos/phpexcel/PHPExcel/Style/NumberFormat.php';
				$Objdata = PHPExcel_IOFactory::load($rutaImagen.$message);
				// abrir el archivo
				$data=$Objdata->getActiveSheet()->toArray();
				$i =0;
				$contador=0;
				foreach ($data as $iIndice => $objfila) {
				//echo $i;
				if ($i>1) {
				//echo $i."<br>";
							
							$dsm					=trim(($objfila[0]));
							$dsm					=trim(reemplazar($dsm));
							
							$dsruta					=utf8_decode($dsruta);
							$dsruta					=html_entity_decode($dsm);

							$dsreferencia			=trim(($objfila[1]));
							$dsd					=trim(reemplazar($objfila[2]));
							$dsd2					=trim(reemplazar($objfila[3]));
							$preciocompra			=trim(reemplazar($objfila[4]));
							$precio1				=trim(reemplazar($objfila[5]));
							$precio2				=trim(reemplazar($objfila[6]));
							$precio3				=trim(reemplazar($objfila[7]));
							$precio4				=trim(reemplazar($objfila[8]));
							$precio5				=trim(reemplazar($objfila[9]));
							$dsflete				=trim(reemplazar($objfila[10]));
							$iva					=trim(reemplazar($objfila[11]));

							if($preciocompra=="")$preciocompra=0;
							if($precio1=="")$precio1=0;
							if($precio2=="")$precio2=0;
							if($precio3=="")$precio3=0;
							if($precio4=="")$precio4=0;
							if($precio5=="")$precio5=0;
							if($dsflete=="")$dsflete=0;
							if($iva=="")$iva=0;

							$volumen				=trim(reemplazar($objfila[12]));
							$peso					=trim(reemplazar($objfila[13]));
							if($peso<=0) $peso=1;

							$ancho					=trim(reemplazar($objfila[14]));
							$alto					=trim(reemplazar($objfila[15]));
							$largo					=trim(reemplazar($objfila[16]));
							
							$dsfechainicial			=trim(reemplazar($objfila[17]));
							if($dsfechainicial<>""){
							$idfechainicial=str_replace("/","",$dsfechainicial);	
							}else{
							$dsfechainicial=date("Y/m/d");
							$idfechainicial=date("Ymd");	
								
							}

							$dsfechafinal			=trim(reemplazar($objfila[18]));
							if($dsfechafinal<>""){
							$idfechafinal=str_replace("/","",$dsfechafinal);
							}else{
							$year=date("Y")+1;
							$dsfechafinal=$year.date("/m/d");
							$idfechafinal=$year.date("md");	
							}	



							$idproveedor			=trim(reemplazar($objfila[19]));
							$dsimgx					=trim(reemplazar($objfila[20]));
							$dsimg=trim($dsimg,"|");
							$partirm=explode("|",$dsimgx);

							$nomcategoria			=trim(reemplazar($objfila[21]));
							$nomcategoria=trim($nomcategoria,"|");
							$partirc=explode("|",$nomcategoria);	
							
							$nomsubcategoria		=trim(reemplazar($objfila[22]));
							$nomsubcategoria=trim($nomsubcategoria,"|");
							$partirs=explode("|",$nomsubcategoria);

							$dsunidadesdispo		=trim(reemplazar($objfila[23]));
							$dsunidad				=trim(reemplazar($objfila[24]));
							$dscarac				=trim(reemplazar($objfila[25]));
							$dscondiciones			=trim(reemplazar($objfila[26]));
							$dsmarca				=trim($objfila[27]);
							$idproducto				=trim(reemplazar($objfila[28]));
							if ($idtipox==1) {

								$dsd=utf8_decode($dsd);
								$dsd=html_entity_decode($dsd);
								$dsd=reemplazar($dsd);
								$dsd=strip_tags($dsd);

								$dsd2=html_entity_decode($dsd2);
								$dsd2=utf8_decode($dsd2);
								$dsd2=reemplazar($dsd2);
								$dsd2=strip_tags($dsd2);

								$dscarac=html_entity_decode($dscarac);
								$dscarac=utf8_decode($dscarac);
								$dscarac=reemplazar($dscarac);
								$dscarac=strip_tags($dscarac);

								$dscondiciones=html_entity_decode($dscondiciones);
								$dscondiciones=utf8_decode($dscondiciones);
								$dscondiciones=reemplazar($dscondiciones);
								$dscondiciones=strip_tags($dscondiciones);
							}
							//exit();
							if ($dsunidadesdispo=="") $dsunidadesdispo=1; // cantidad minima disponible
							if ($dsunidad=="") $dsunidad=1; // cantidad por unidad
							$idtipoprod				=1;
							$idactivo				=1;
							$idtipo					=1;
							$idpubcorreo			=0;
							$idmasvendido			=2;
							$dsdisponible			=1;
							$pos 					=0;
							$dsrefinterna			=$dsreferencia."-".$idproveedor;
							if ($idoperacion==1) {
							if ($dsreferencia<>""){
							$sqlS="select a.id,a.dsunidadesdispo ";
							$sqlS.=" from $tabla a ";
							$sqlS.=" where a.id>0 ";
							//$sqlS.=" and dsm='$dsm'";
							$sqlS.=" and  a.dsreferencia='$dsreferencia'";  
							
//							echo "VALIDANDO QUERY: ".$sqlS."<br>";
							$result = $db->Execute($sqlS);
							if (!$result->EOF) { // actualiza los productos
								//exit();
									$cantidadbase=$result->fields[1];
									$idx=$result->fields[0];
									$sqlU=" update $tabla set ";
									$sqlU.="dsm='".($dsm)."'";
									$sqlU.=",dsruta						='".limpieza(strtolower($dsruta))."'";
									$sqlU.=",dsreferencia 				='$dsreferencia'";
									$sqlU.=",dsd 						='$dsd'";
									$sqlU.=",dsd2 						='$dsd2'";
									$sqlU.=",preciocompra 				='$preciocompra'";
									$sqlU.=",precio1 					='$precio1'";
									$sqlU.=",precio2 					='$precio2'";
									$sqlU.=",precio3 					='$precio3'";
									$sqlU.=",precio4 					='$precio4'";
									$sqlU.=",precio5 					='$precio5'";
									$sqlU.=",iva 						='$iva'";
									$sqlU.=",volumen 					='$volumen'";
									$sqlU.=",peso 						='$peso'";
									$sqlU.=",ancho 						='$ancho'";
									$sqlU.=",alto 						='$alto'";
									$sqlU.=",largo 						='$largo'";
									$sqlU.=",dsmarca 					='$dsmarca'";
									$sqlU.=",dscarac 					='$dscarac'";
									$sqlU.=",dscondiciones 				='$dscondiciones'";
									$sqlU.=",dsfechainicial 			='$dsfechainicial'";
									$sqlU.=",idfechainicial 			='$idfechainicial'";
									$sqlU.=",dsfechafinal 				='$dsfechafinal'";
									$sqlU.=",idfechafinal 				='$idfechafinal'";
									$sqlU.=",idproveedor 				='$idproveedor'";
									$sqlU.=",idactivo 					=$idactivo";
									$sqlU.=",idtipo 					=$idtipo";
									$sqlU.=",idtipoprod 				=$idtipo";
									$sqlU.=",idmasvendido 				=$idmasvendido";
									$sqlU.=",idpos 						=$idx";
									$sqlU.=",dsdisponible 				=$dsdisponible";
									if ($dsunidadesdispo>0) {
								    $sqlU.=",dsunidadesdispo=$dsunidadesdispo"; // validacion de existencia
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
									//echo $sqlU."<br>";
									if ($db->Execute($sqlU)){
									//echo "MODIFICADOS: producto: $dsm<br>Descripcion: $dsd <br>Posicion: $contador<br>";		
									$id = $idx;
									include('relaciones.importacion.php');
									//exit();
									}
							}else{//else consulta

								// inserta productos	
								$sqlinsert=" insert into $tabla ($campos) ";
								$sqlinsert.="values";
								$sqlinsert.=" ('".$dsm."','".$dsreferencia."','".$dsd."','".$dsd2."'";
								$sqlinsert.=",'".$preciocompra."','".$precio1."','".$precio2."','".$precio3."'";
								$sqlinsert.=",'".$precio4."','".$precio5."'";	
								$sqlinsert.=",'".$dsflete."','".$iva."'";
								$sqlinsert.=",'".$volumen."'";
								$sqlinsert.=",'".$peso."','".$ancho."','".$alto."','".$largo."','".$dsfechainicial."'";//17
								$sqlinsert.=",'".$idfechainicial."','".$dsfechafinal."','".$idfechafinal."'";
								$sqlinsert.=",'".$idproveedor."',".$idactivo.",".$idtipo.",".$idmasvendido."";
								$sqlinsert.=" ,".$idtipo."";
								$sqlinsert.=",".$dsunidadesdispo;
								$sqlinsert.=",".$dsunidad;
								$sqlinsert.=",'".limpieza(strtolower($dsruta))."','$i',$dsdisponible,'$dscarac','$dscondiciones','Caracteristicas','Garantias','Descripci&oacute;n','$dsmarca'";
								$sqlinsert.=")";
								//echo $sqlinsert."<br>";
								if ($db->Execute($sqlinsert)){
								
								//echo "INSERTANDO: Producto: $dsm<br>Descripcion: $dsd <br>Posicion: $contador<br>";	

									$sqlX="select a.id";
									$sqlX.=" from $tabla a ";
									$sqlX.=" where a.id>0 ";
									$sqlX.=" and (";
									$sqlX.=" dsm='$dsm'";
									if ($dsreferencia<>"") $sqlX.=" or dsreferencia='$dsreferencia'";
									$sqlX.=") order by id DESC LIMIT 0,1";
									$resultX = $db->Execute($sqlX);
									if (!$resultX->EOF) {
										$idx = $resultX->fields[0];
										// INSEERTANDO EN INVENTARIO
										if ($dsunidadesdispo>0) {
										$dsproductoi=$dsreferencia;
										if ($dsproductoi=="") $dsproductoi=$dsm;
										$idproductoi=$idx;
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
							//***************** inicio de  relaciones  en subcategorias,categorias,imagenes **********//		
							include('relaciones.importacion.php');
							//***************** fin de  relaciones  en subcategorias,categorias,imagenes **********//
								

							// manejo de categortia y subcategoria
							//include("proceso.importardatos.php");


							}//fin verificar referencia
//					exit();		
					}
			$contador++;
			} // fin if
			//echo "<br>f".$i."<br>";
			$i++;
			

				// borrar archivo
			@unlink($rutaImagen.$message);
			//echo $rutaImagen.$message;
			//exit();
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
<meta http-equiv="REFRESH" content="5; URL=default.producto.php">
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
		        		      		<p>REGISTRO  MODIFICADOS <?echo  $contador?></p>
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