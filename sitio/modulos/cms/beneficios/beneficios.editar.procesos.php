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
$tablarelaciones="tblsubcategoriaxtblproducto";
$tablaorigen="tblsubcategoriasxcategoria";
$tablarelaciones2="tblempresaxtblproducto";
$tablaorigen2="tblempresa";
$tablarelaciones3="tblcoloresxtblproducto";
$tablaorigen3="tblcolores";
$tablarelaciones4="tbltallasxtblproducto";
$tablaorigen4="tbltallas";

$tabla="tblbeneficiosn";
$carpeta="producto";
$rutaImagen=$rutxx."../../../contenidos/images/producto/";
$paso=$_REQUEST['paso'];
$idtipo=$_REQUEST['idtipo'];
$idtipoprod=$_REQUEST['idtipoprod'];

$titulomodulo="Configuracion de areas de practica";
if ($idtipoprod=="2") $titulomodulo="Configuracion de Servicio";

$rr="default.beneficios.php?idtipoprod=$idtipoprod";


// img1 + imagen lateral carrito
$cargarimg1=$_REQUEST['cargarimg1'];
if ($cargarimg1<>"") {
	// formatos imagenes
		$nombre="dsimg1";
		$nombreant="archivoanterior1";
		$borrar=$_REQUEST['borrar1'];
		$valimg=$_REQUEST['img1'];
		$gd=1;
		include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
		// con el archivo cargado proceder a colocar los otros
		// 1. 155 x 155
if ($idtipo==5) {
		$anchot="205";
		$altot="205";
} else {
		$anchot="155";
		$altot="155";
}

		$calidad="85";
		$nuevoNombreP="1-".$archivobaseimagen;
		$nuevoNombrePcarrito="c-".$archivobaseimagen;
		$imgvec[0]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;


		// 2. 155 x 155
		$anchot="328";
		$altot="328";
		$calidad="85";
		$nuevoNombreP="2-".$archivobaseimagen;
		$imgvec[1]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;
		// 3. 800 X 800
		// 1. 155 x 155
if ($idtipo==5) {
		$anchot="450";
		$altot="450";
} else {
		$anchot="800";
		$altot="800";
}
		$calidad="85";
		$nuevoNombreP="3-".$archivobaseimagen;
		$archivobaseimagencarrito=$archivobaseimagen;
		$archivobaseimagennovedad=$archivobaseimagen;

		$imgvec[2]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;
} else {
			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
			//
			$nombre="dsimg2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['borrar2'];
			$valimg=$_REQUEST['img2'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
			//
			$nombre="dsimg3";
			$nombreant="archivoanterior3";
			$borrar=$_REQUEST['borrar3'];
			$valimg=$_REQUEST['img3'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
			//
}

// imag2
$cargarimg2=$_REQUEST['cargarimg2'];
if ($cargarimg2<>"") {
		$nombre="dsimg4";
		$nombreant="archivoanterior4";
		$borrar=$_REQUEST['borrar4'];
		$valimg=$_REQUEST['img4'];
		$gd=1;
		include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
		// con el archivo cargado proceder a colocar los otros
		// 1. 155 x 155
if ($idtipo==5) {
		$anchot="205";
		$altot="205";
} else {
		$anchot="155";
		$altot="155";
}
		$calidad="85";
		$nuevoNombreP="21-".$archivobaseimagen;
		$nuevoNombrePcarrito="2c-".$archivobaseimagen;
		$imgvec[3]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;


		// 2. 155 x 155
		$anchot="328";
		$altot="328";
		$calidad="85";
		$nuevoNombreP="22-".$archivobaseimagen;
		$imgvec[4]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;
		// 3. 800 X 800
		// 1. 155 x 155
if ($idtipo==5) {
		$anchot="450";
		$altot="450";
} else {
		$anchot="800";
		$altot="800";
}
		$calidad="85";
		$nuevoNombreP="23-".$archivobaseimagen;
		$archivobaseimagencarrito=$archivobaseimagen;
		$imgvec[5]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;


} else {


			$nombre="dsimg4";
			$nombreant="archivoanterior4";
			$borrar=$_REQUEST['borrar4'];
			$valimg=$_REQUEST['img4'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg5";
			$nombreant="archivoanterior5";
			$borrar=$_REQUEST['borrar5'];
			$valimg=$_REQUEST['img5'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg6";
			$nombreant="archivoanterior6";
			$borrar=$_REQUEST['borrar6'];
			$valimg=$_REQUEST['img6'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

}
// imag3
$cargarimg3=$_REQUEST['cargarimg3'];
if ($cargarimg3<>"") {

		$nombre="dsimg7";
		$nombreant="archivoanterior7";
		$borrar=$_REQUEST['borrar7'];
		$valimg=$_REQUEST['img7'];
		$gd=1;
		include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
		// con el archivo cargado proceder a colocar los otros
		// 1. 155 x 155
if ($idtipo==5) {
		$anchot="205";
		$altot="205";
} else {
		$anchot="155";
		$altot="155";
}
		$calidad="85";
		$nuevoNombreP="31-".$archivobaseimagen;
		$nuevoNombrePcarrito="3c-".$archivobaseimagen;
		$imgvec[6]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;


		// 2. 155 x 155

		$anchot="328";
		$altot="328";
		$calidad="85";
		$nuevoNombreP="32-".$archivobaseimagen;
		$imgvec[7]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;
		// 3. 800 X 800
		// 1. 155 x 155
if ($idtipo==5) {
		$anchot="450";
		$altot="450";
} else {

		$anchot="800";
		$altot="800";
}
		$calidad="85";
		$nuevoNombreP="33-".$archivobaseimagen;
		$archivobaseimagencarrito=$archivobaseimagen;
		$imgvec[8]=makeimage($rutaImagen,$archivobaseimagen,$nuevoNombreP,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
		$contImg++;


} else {


			$nombre="dsimg7";
			$nombreant="archivoanterior7";
			$borrar=$_REQUEST['borrar7'];
			$valimg=$_REQUEST['img7'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg8";
			$nombreant="archivoanterior8";
			$borrar=$_REQUEST['borrar8'];
			$valimg=$_REQUEST['img8'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg9";
			$nombreant="archivoanterior9";
			$borrar=$_REQUEST['borrar9'];
			$valimg=$_REQUEST['img9'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

}


// novedades
if ($cargarimg1<>"") {

		$anchot="70";
		$altot="70";
		$calidad="85";

		$nuevoNombrePNovedad="N-".$archivobaseimagennovedad;
		$imgvec[9]=makeimage($rutaImagen,$archivobaseimagennovedad,$nuevoNombrePNovedad,$rutaImagen,$anchot,$altot,"mensaje",$calidad);

} else {
			$nombre="dsimg10";
			$nombreant="archivoanterior10";
			$borrar=$_REQUEST['borrar10'];
			$valimg=$_REQUEST['img10'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
}
// fin novedades


if ($cargarimg1<>"") {

		$anchot="70";
		$altot="70";
		$calidad="85";

		$nuevoNombrePcarrito="c-".$archivobaseimagencarrito;
		$imgvec[10]=makeimage($rutaImagen,$archivobaseimagencarrito,$nuevoNombrePcarrito,$rutaImagen,$anchot,$altot,"mensaje",$calidad);
} else {

			$nombre="dsimgcarrito";
			$nombreant="archivoanteriordsimgcarrito";
			$borrar=$_REQUEST['borrardsimgcarrito'];
			$valimg=$_REQUEST['imgdsimgcarrito'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
}
// imagen destacada
			$data=1;
			$nombre="dsimgdestacada";
			$nombreant="archivoanteriordsimgdestacada";
			$borrar=$_REQUEST['borrardsimgdestacada'];
			$valimg=$_REQUEST['imgdsimgdestacada'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
// fin imagen destacada


// img 4

			$nombre="dsimg11";
			$nombreant="archivoanterior11";
			$borrar=$_REQUEST['borrar11'];
			$valimg=$_REQUEST['img11'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg12";
			$nombreant="archivoanterior12";
			$borrar=$_REQUEST['borrar12'];
			$valimg=$_REQUEST['img12'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


// img 5

			$nombre="dsimg13";
			$nombreant="archivoanterior13";
			$borrar=$_REQUEST['borrar13'];
			$valimg=$_REQUEST['img13'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg14";
			$nombreant="archivoanterior14";
			$borrar=$_REQUEST['borrar14'];
			$valimg=$_REQUEST['img14'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


// im 6

			$nombre="dsimg15";
			$nombreant="archivoanterior15";
			$borrar=$_REQUEST['borrar15'];
			$valimg=$_REQUEST['img15'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg16";
			$nombreant="archivoanterior16";
			$borrar=$_REQUEST['borrar16'];
			$valimg=$_REQUEST['img16'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


// img 7

			$nombre="dsimg17";
			$nombreant="archivoanterior17";
			$borrar=$_REQUEST['borrar17'];
			$valimg=$_REQUEST['img17'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg18";
			$nombreant="archivoanterior18";
			$borrar=$_REQUEST['borrar18'];
			$valimg=$_REQUEST['img18'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


// img 8

			$nombre="dsimg19";
			$nombreant="archivoanterior19";
			$borrar=$_REQUEST['borrar19'];
			$valimg=$_REQUEST['img19'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg20";
			$nombreant="archivoanterior20";
			$borrar=$_REQUEST['borrar20'];
			$valimg=$_REQUEST['img20'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


// img 9

			$nombre="dsimg21";
			$nombreant="archivoanterior21";
			$borrar=$_REQUEST['borrar21'];
			$valimg=$_REQUEST['img21'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg22";
			$nombreant="archivoanterior22";
			$borrar=$_REQUEST['borrar22'];
			$valimg=$_REQUEST['img22'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


// img 10

			$nombre="dsimg23";
			$nombreant="archivoanterior23";
			$borrar=$_REQUEST['borrar23'];
			$valimg=$_REQUEST['img23'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg24";
			$nombreant="archivoanterior24";
			$borrar=$_REQUEST['borrar24'];
			$valimg=$_REQUEST['img24'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");



			$dsm=$_REQUEST['dsm'];
			$dsruta=limpieza(strtolower($dsm));

			$dsd=($_REQUEST['dsd']);
			$dsd=str_replace(chr(34),"&quot;",$dsd);
			$dsd=str_replace(chr(39),"&#39;",$dsd);

			$dsd2=($_REQUEST['dsd2']);
			$dsd2=str_replace(chr(34),"&quot;",$dsd2);

			$dsd2=str_replace(chr(39),"&#39;",$dsd2);

			$dsfechainicial=$_REQUEST['dsfechainicial'];
			$dsfechafinal=$_REQUEST['dsfechafinal'];
			$dsvideo=$_REQUEST['dsvideo'];
			$preciocompra=$_REQUEST['preciocompra'];
			$precio1=$_REQUEST['precio1'];
			$precio2=$_REQUEST['precio2'];
			$precio3=$_REQUEST['precio3'];
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
			$dsreferencia=$_REQUEST['dsreferencia'];
			$dsdisponible=$_REQUEST['dsdisponible'];
			if ($dsdisponible=="") $dsdisponible=0;
			$dsentrega=$_REQUEST['dsentrega'];

			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idproveedor=$_REQUEST['idproveedor'];
			if ($idproveedor=="") $idproveedor=0;
			$dscondiciones=$_REQUEST['dscondiciones'];
			$idmasvendido=$_REQUEST['idmasvendido'];
			if ($idtipo=="") $idtipo=0;

			$dsproveedor=$_REQUEST['dsproveedor'];
			$dsurl=$_REQUEST['dsurl'];
			$dsaltura=$_REQUEST['dsaltura'];
			$preciodistribuidor=$_REQUEST['preciodistribuidor'];

			$idnat=$_REQUEST['idnat'];


			$idequipo=$_REQUEST['idequipo'];
			if ($idequipo=="") $idequipo=0;

			if ($paso=="1") {

					/*$dsarchivo=limpieza(strtolower($dsm)).".php";
					$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$dsm,$idx,$include);*/

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

					$sql.=",precio1='$precio1'";
					$sql.=",precio2='$precio2'";
					$sql.=",precio3='$precio3'";
					$sql.=",descuento='$descuento'";
					$sql.=",preciodescuento='$preciodescuento'";

					$sql.=",iva='$iva'";
					$sql.=",volumen='$volumen'";
					$sql.=",peso='$peso'";
					$sql.=",ancho='$ancho'";
					$sql.=",alto='$alto'";
					$sql.=",largo='$largo'";
					$sql.=",dsmarca='$dsmarca'";
					$sql.=",dsreferencia='$dsreferencia'";
					$sql.=",dsunidadesdispo='$dsunidadesdispo'";
					//$sql.=",dsunidad='$dsunidad'";
					$sql.=",dsdisponible='$dsdisponible'";
					$sql.=",dsentrega='$dsentrega'";
					$sql.=",dsimg1='".$imgvec[0]."'";
					$sql.=",dsimg2='".$imgvec[1]."'";
					$sql.=",dsimg3='".$imgvec[2]."'";
					$sql.=",dsimg4='".$imgvec[3]."'";
					$sql.=",dsimg5='".$imgvec[4]."'";
					$sql.=",dsimg6='".$imgvec[5]."'";
					$sql.=",dsimg7='".$imgvec[6]."'";
					$sql.=",dsimg8='".$imgvec[7]."'";
					$sql.=",dsimg9='".$imgvec[8]."'";
					$sql.=",dsimg10='".$imgvec[9]."'";
					$sql.=",dsimgcarrito='".$imgvec[10]."'";
					$sql.=",dsimgdestacada='".$imgvec[11]."'";

					$sql.=",idpos='$idpos'";
					$sql.=",idactivo='$idactivo'";
					$sql.=",idtipo='$idtipo'";
					$sql.=",idproveedor='$idproveedor'";
					$sql.=",dscondiciones='$dscondiciones'";
					$sql.=",idmasvendido='$idmasvendido'";
					$sql.=",dsurl='$dsurl'";
					$sql.=",dsproveedor='$dsproveedor'";
					$sql.=",dsaltura='$dsaltura'";
					$sql.=",idnat='$idnat'";
					$sql.=",preciodistribuidor='$preciodistribuidor'";
					$sql.=",dsruta='$dsruta'";
					//$sql.=",idequipo='$idequipo'";

// otras imaganes




					//$sql.=",idcategoria=$idcategoria";
					$sql.=" where id=".$idx;
//					echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						//$error=0;
						$mensajes=$men[6];
						// cargar auditoria

						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/beneficios/default.php?idtipoprod=$idtipoprod";
						include($rutxx."../../incluidos_modulos/logs.php");
						include($rutxx."../relaciones/relaciones.operaciones.php");
						include($rutxx."../relaciones/relaciones.operaciones.categorias.php");
						//include($rutxx."../relaciones/relaciones.operaciones.empresa.php");
						//include($rutxx."../relaciones/relaciones.operaciones.colores.php");
						//include($rutxx."../relaciones/relaciones.operaciones.tallas.php");

					}	else {

						$mensajes=$men[7];
						$error=1;
					}
			}

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsimg1,a.dsimg2,a.dsimg3,a.dsimg4,a.dsimg5,a.dsimg6,a.dsimg7,a.dsimg8,a.dsimg9,a.idcategoria,a.idpos,";//12
$sql.="a.idactivo,a.dsvideo,a.dsd2,a.precio1,a.dsmarca,a.dsreferencia,a.iva,a.descuento,a.precio2,a.precio3,a.dsfechainicial,a.dsfechafinal,";//24
$sql.="a.volumen,a.peso,a.ancho,a.alto,a.largo,a.dsentrega,a.dsdisponible,a.dsimg10,a.dscondiciones";//33
$sql.=",a.preciocompra,a.preciodescuento,a.dsimgcarrito,a.idmasvendido";//37
$sql.=",a.dsurl,a.dsproveedor,a.idtipo,a.dsaltura,a.dsimgdestacada,a.idnat,a.idproveedor,a.dsruta,a.preciodistribuidor,a.dsunidadesdispo";
// imagenes
//$sql.=",a.dsimg11,a.dsimg12,a.dsimg13,a.dsimg14,a.dsimg15,a.dsimg16,a.dsimg17,a.dsimg18,a.dsimg19";
//$sql.=",a.dsimg20,a.dsimg21,a.dsimg22,a.dsimg23,a.dsimg24";


$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();

$dsm=$result->fields[0];
$dsd=$result->fields[1];
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
$idequipo=$result->fields[49];
// resto de imagens
$dsimg11=$result->fields[50];
$dsimg12=$result->fields[51];
$dsimg13=$result->fields[52];
$dsimg14=$result->fields[53];
$dsimg15=$result->fields[54];
$dsimg16=$result->fields[55];
$dsimg17=$result->fields[56];
$dsimg18=$result->fields[57];

$dsimg19=$result->fields[58];
$dsimg20=$result->fields[59];
$dsimg21=$result->fields[60];
$dsimg22=$result->fields[61];
$dsimg23=$result->fields[62];
$dsimg24=$result->fields[63];


} // fin si
$result->Close();


$txt="155 x 155";
if ($idtipo==5) $txt="205 x 205";


?>
