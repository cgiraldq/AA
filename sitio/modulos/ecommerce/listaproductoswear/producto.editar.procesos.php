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
// procesos de edicion del producto

$tablarelaciones="ecommerce_tblsubcategoriaxtblproducto";
$tablaorigen="ecommerce_tblsubcategoriasxcategoria";
$tablarelaciones2="ecommerce_tblempresaxtblproducto";
$tablaorigen2="tblempresa";
$tablarelaciones3="ecommerce_tblcoloresxtblproducto";
$tablaorigen3="ecommerce_tblcolores";
$tablarelaciones4="ecommerce_tbltallasxtblproducto";
$tablaorigen4="ecommerce_tbltallas";
$tablarelacionesx="tbltblproductoxcategoria";
$tabla="ecommerce_tblproductos";
$carpeta="producto";
$rutaImagen="../../../../contenidos/images/ecommerce_productos/";
$paso=$_REQUEST['paso'];
$idtipo=$_REQUEST['idtipo'];
$paginax=$_REQUEST['paginax'];
$idtipoprod=$_REQUEST['idtipoprod'];
if ($idtipoprod=="") $idtipoprod=1;
$cargar=$_REQUEST['cargarimg'];
$titulomodulo="Configuracion de Producto";
if ($idtipoprod=="2") $titulomodulo="Configuracion de Servicio";





	//****************************inicio config  img********************************************//
			$imgx=$_REQUEST['idimg'];
			if($imgx<>""){
			$sql="delete from ecommerce_tblproductoximg where id=".$imgx."";
			$db->Execute($sql);
			$paso=2;
			$error=0;
			$mensajes="Imagen Eliminada Con exito";
			}
			$cargar=$_REQUEST['cargar'];
			if($cargar<>""){
			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			//********************************//
			$archivobaseimagen="";
			if($contImg=="")$contImg=1;
			if ($_FILES[$nombre]['name']<>"") {
			// borrar anterior
			$archivoanterior=$_REQUEST[$nombreant];
			if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
			$temp_name = $_FILES[$nombre]['tmp_name'];
			$imgnom=explode(".",$_FILES[$nombre]['name']);
			$nombreimg=strtolower(limpieza($imgnom[0]));
			$nombre1=$nombreimg.".".substr($_FILES[$nombre]['name'],-3);
			 $s_ext = pathinfo($_FILES[$nombre]['name'], PATHINFO_EXTENSION);
	        $valido=permitir($s_ext);
	        if ($valido==0) move_uploaded_file($temp_name,$rutaImagen.$nombre1);
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
			include($rutxx."../relaciones/relaciones.imagenes.php");
			$paso=2;
			//$error=1;
			//$mensajes="Imagen Actualizada con exito";
			}
			//**********************************//

			$contarx=count($_REQUEST['id_']);
			$h=0;
			for ($j=0;$j<$contarx;$j++){
				if ($_REQUEST['id_'][$j]<>""){
					$sql=" update ecommerce_tblproductoximg set ";
					$sql.= "idactivo=".$_REQUEST['estadoimg_'][$j];
					$sql.= " where id=".$_REQUEST['id_'][$j];
					//echo $sql."<br>";
					if ($db->Execute($sql)) $h++;
				} // fin si
			} // fin for
			//********************fin config imagen***************************************//

			$dsm=$_REQUEST['dsm'];
			$dsruta=limpieza(strtolower($dsm));
			$dsm=utf8_encode($dsm);



			$dsd=utf8_encode($_REQUEST['dsd']);
			$dsd=str_replace(chr(34),"&quot;",$dsd);
			$dsd=str_replace(chr(39),"&#39;",$dsd);
			$dsd=htmlspecialchars($dsd);
			
			$dsd2=utf8_encode($_REQUEST['dsd2']);
			$dsd2=htmlspecialchars($dsd2);
			$dsd2=str_replace(chr(34),"&quot;",$dsd2);
			$dsd2=str_replace(chr(39),"&#39;",$dsd2);

			$dscarac=utf8_encode($_REQUEST['dscarac']);
			$dscarac=str_replace(chr(34),"&quot;",$dscarac);
			$dscarac=str_replace(chr(39),"&#39;",$dscarac);
			$dscarac=htmlspecialchars($dscarac);

			$dscondiciones=utf8_encode($_REQUEST['dscondiciones']);
			$dscondiciones=str_replace(chr(34),"&quot;",$dscondiciones);
			$dscondiciones=str_replace(chr(39),"&#39;",$dscondiciones);
			$dscondiciones=htmlspecialchars($dscondiciones);


			$dsfechainicial=$_REQUEST['dsfechainicial'];
			$dsfechafinal=$_REQUEST['dsfechafinal'];
			//**********hora***************//
			$dshorai=$_REQUEST['dshorai'];
			$dsminutoi=$_REQUEST['dsminutoi'];
			$dshoraf=$_REQUEST['dshoraf'];
			$dsminutof=$_REQUEST['dsminutof'];
			if($dshorai=="")$dshorai=00;
			if($dshoraf=="")$dshoraf=00;
			if($dsminutoi=="")$dsminutoi=00;
			if($dsminutof=="")$dsminutof=00;
			$dshorasi=$dshorai.":".$dsminutoi;
			$dshorasf=$dshoraf.":".$dsminutof;
			$idfechai=str_replace("/","",$dsfechainicial.$dshorai.$dsminutoi);
			$idfechaf=str_replace("/","",$dsfechafinal.$dshoraf.$dsminutof);
			//**********hora  fin ***************//

			$dscaractxt=$_REQUEST['dscaractxt'];
			$dsvideo=$_REQUEST['dsvideo'];
			$preciocompra=$_REQUEST['preciocompra'];
			$descuento=$_REQUEST['descuento'];
			$preciodescuento=$_REQUEST['preciodescuento'];
			$dsunidadesdispo=$_REQUEST['dsunidadesdispo'];
			$dsunidad=$_REQUEST['dsunidad'];
			$iva=$_REQUEST['iva'];
			$volumen=$_REQUEST['volumen'];
			$peso=$_REQUEST['peso'];
			$ancho=$_REQUEST['ancho'];
			$alto=$_REQUEST['alto'];
			$largo=$_REQUEST['largo'];
			$dsmarca=$_REQUEST['dsmarca'];
			$dsflete=$_REQUEST['dsflete'];
			$dsreferencia=$_REQUEST['dsreferencia'];
			$dsreferenciaasoc=$_REQUEST['dsreferenciaasoc'];
			$dsdisponible=$_REQUEST['dsdisponible'];
			if ($dsdisponible=="") $dsdisponible=0;
			$dsentrega=$_REQUEST['dsentrega'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idproveedor=$_REQUEST['idproveedor'];
			if ($idproveedor=="") $idproveedor=0;
			$idmasvendido=$_REQUEST['idmasvendido'];
			if ($idtipo=="") $idtipo=0;
			$dsproveedor=$_REQUEST['dsproveedor'];
			$dsurl=$_REQUEST['dsurl'];
			$dsaltura=$_REQUEST['dsaltura'];

			$preciodistribuidor=$_REQUEST['preciodistribuidor'];
			$idnat=$_REQUEST['idnat'];
			$idorigen=$_REQUEST['idorigen'];
			$dsd2txt=$_REQUEST['dsd2txt'];
			$dsdcondicionestxt=$_REQUEST['dsdcondicionestxt'];
			$idmarca=$_REQUEST['idmarca'];
			if ($idmarca<>"") {
					$sql="select dsm from ecommerce_tblmarcas where id=$idmarca ";
				$resultx = $db->Execute($sql);
					 if (!$resultx->EOF) {
					 	$dsmarca=$resultx->fields[0];
					 }
					 $resultx->Close();
			}
			if ($paso=="1") {

					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsd2='$dsd2'";
					$sql.=",dsfechainicial='$dsfechainicial'";
					$sql.=",idfechainicial='".preg_replace("/\//","",$dsfechainicial)."'";
					$sql.=",dsfechafinal='$dsfechafinal'";
					$sql.=",idfechafinal='".preg_replace("/\//","",$dsfechafinal)."'";
					$sql.=",dsvideo='$dsvideo'";
					$sql.=",preciocompra='$preciocompra'";
					/*
					$sql.=",precio1='$precio1'";
					$sql.=",precio2='$precio2'";
					$sql.=",precio3='$precio3'";
					$sql.=",precio4='$precio4'";
					$sql.=",precio5='$precio5'";
					*/
					$sql.=",dsflete='$dsflete'";
					$sql.=",idorigen='$idorigen'";
					$sql.=",iva='$iva'";
					$sql.=",volumen='$volumen'";
					$sql.=",peso='$peso'";
					$sql.=",ancho='$ancho'";
					$sql.=",alto='$alto'";
					$sql.=",largo='$largo'";
					$sql.=",dsmarca='$dsmarca'";
					$sql.=",idmarca='$idmarca'";
					$sql.=",dsreferencia='$dsreferencia'";
					$sql.=",dsunidadesdispo='$dsunidadesdispo'";
					$sql.=",dsunidad='$dsunidad'";
					$sql.=",dsdisponible='$dsdisponible'";
					$sql.=",dsentrega='$dsentrega'";
					$sql.=",dscaractxt='$dscaractxt'";
					$sql.=",dscarac='$dscarac'";
					$sql.=",idpos='$idpos'";
					$sql.=",idtipo='$idtipo'";
					$sql.=",idproveedor='$idproveedor'";
					$sql.=",dscondiciones='$dscondiciones'";
					$sql.=",idmasvendido='$idmasvendido'";
					$sql.=",dsurl='$dsurl'";
					$sql.=",dsproveedor='$dsproveedor'";
					$sql.=",dsaltura='$dsaltura'";
					$sql.=",idactivo='$idactivo'";
					$sql.=",idnat='$idnat'";
					$sql.=",preciodistribuidor='$preciodistribuidor'";
					$sql.=",dsruta='$dsruta'";
					$sql.=",dsd2txt='$dsd2txt'";
					$sql.=",dsdcondicionestxt='$dsdcondicionestxt'";
					$sql.=",idtipoprod='$idtipoprod'";
					$sql.=" where id=".$idx;
					//echo $sql;
					if ($db->Execute($sql))  {
						//$error=0;
						$mensajes=$men[6];

						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../productos/default.php?idtipoprod=$idtipoprod";
						include($rutxx."../../incluidos_modulos/logs.php");
						include($rutxx."../relaciones/relaciones.operaciones.ecommerce.categorias.php");
						include($rutxx."../relaciones/relaciones.operaciones.php");
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");
						include($rutxx."../relaciones/relaciones.operaciones.colores.php");
						include($rutxx."../relaciones/relaciones.operaciones.tallas.php");


					}	else {
						$error=1;
						$mensajes=$men[7].$sql;
					}
			}
// $db->debug=true;
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsimg1,a.dsimg2,a.dsimg3,a.dsimg4,a.dsimg5,a.dsimg6,a.dsimg7,a.dsimg8,a.dsimg9,a.idcategoria,a.idpos,";//12
$sql.="a.idactivo,a.dsvideo,a.dsd2,a.precio1,a.dsmarca,a.dsreferencia,a.iva,a.descuento,a.precio2,a.precio3,a.dsfechainicial,a.dsfechafinal,";//24
$sql.="a.volumen,a.peso,a.ancho,a.alto,a.largo,a.dsentrega,a.dsdisponible,a.dsimg10,a.dscondiciones";//33
$sql.=",a.preciocompra,a.preciodescuento,a.dsimgcarrito,a.idmasvendido";//37
$sql.=",a.dsurl,a.dsproveedor,a.idtipo,a.dsaltura,a.dsimgdestacada,a.idnat,a.idproveedor,a.dsruta,a.preciodistribuidor,a.dsunidadesdispo,a.dsunidad";
$sql.=",a.dsmayorista,a.dsd2txt,a.dsdcondicionestxt,a.idmarca,a.precio4,a.precio5,a.dsflete,a.dscaractxt,a.dscarac,a.idorigen";

$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();

$dsm=$result->fields[0];
$dsm=utf8_decode($dsm);
$dsm=html_entity_decode($dsm);

$dsd=$result->fields[1];
$dsd=utf8_decode($dsd);
$dsd=html_entity_decode($dsd);

$dsimg1=$result->fields[2];
$dsimg2=$result->fields[3];
$dsimg3=$result->fields[4];
$dsimg4=$result->fields[5];
$dsimg5=$result->fields[6];
$dsimg6=$result->fields[7];
$dsimg7=$result->fields[8];
$dsimg8=$result->fields[9];
$dsimg9=$result->fields[10];
$idcategoria=$result->fields[11];
$idpos=$result->fields[12];
$idactivo=$result->fields[13];
$dsvideo=$result->fields[14];
$dsd2=$result->fields[15];
$dsd2=utf8_decode($dsd2);
$dsd2=html_entity_decode($dsd2);


$precio1=$result->fields[16];
$dsmarca=$result->fields[17];
$dsreferencia=$result->fields[18];
$iva=$result->fields[19];
$descuento=$result->fields[20];
$precio2=$result->fields[21];
$precio3=$result->fields[22];
$dsfechainicial=$result->fields[23];
$dsfechafinal=$result->fields[24];
$volumen=$result->fields[25];
$peso=$result->fields[26];
$ancho=$result->fields[27];
$alto=$result->fields[28];
$largo=$result->fields[29];
$dsdisponible=$result->fields[31];
$dsentrega=$result->fields[30];
$dsimg10=$result->fields[32];
$dscondiciones=$result->fields[33];
$dscondiciones=utf8_decode($dscondiciones);
$dscondiciones=html_entity_decode($dscondiciones);


$preciocompra=$result->fields[34];
$preciodescuento=$result->fields[35];
$dsimgcarrito=$result->fields[36];
$idmasvendido=$result->fields[37];
$dsurl=$result->fields[38];
$dsproveedor=$result->fields[39];
$idtipo=$result->fields[40];
$dsaltura=$result->fields[41];
$dsimgdestacada=$result->fields[42];
$idnat=$result->fields[43];
$idproveedor=$result->fields[44];
$preciodistribuidor=$result->fields[46];
$dsunidadesdispo=$result->fields[47];
$dsunidad=$result->fields[48];
// nuevos campos
$dsmayorista=$result->fields[49];
$dsd2txt=$result->fields[50];
if ($dsd2txt=="") $dsd2txt="Descripci&oacute;n";
$dsdcondicionestxt=$result->fields[51];
if ($dsdcondicionestxt=="") $dsdcondicionestxt="Garant&iacute;as";
$dscaractxt=$result->fields[56];
if ($dscaractxt=="") $dscaractxt="Caracteristicas";
$dscarac=$result->fields[57];
$dscarac=utf8_decode($dscarac);
$dscarac=html_entity_decode($dscarac);


$idmarca=$result->fields[52];
$precio4=$result->fields[53];
$precio5=$result->fields[54];
$dsflete=$result->fields[55];
$idorigen=$result->fields[58];
}
// fin si

$result->Close();


$txt="155 x 155";
if ($idtipo==5) $txt="205 x 205";


?>
