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
// edicion de datos
include("../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Configuraci&oacute;n de Contenidos Inferiores";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblcontenidos";
$carpeta="servicios";
$rutaImagen="../../../contenidos/images/contenidoinferios/";


			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['borrar2'];
			$valimg=$_REQUEST['img2'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg3";
			$nombreant="archivoanterior3";
			$borrar=$_REQUEST['borrar3'];
			$valimg=$_REQUEST['img3'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg4";
			$nombreant="archivoanterior4";
			$borrar=$_REQUEST['borrar4'];
			$valimg=$_REQUEST['img4'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg5";
			$nombreant="archivoanterior5";
			$borrar=$_REQUEST['borrar5'];
			$valimg=$_REQUEST['img5'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg6";
			$nombreant="archivoanterior6";
			$borrar=$_REQUEST['borrar6'];
			$valimg=$_REQUEST['img6'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg7";
			$nombreant="archivoanterior7";
			$borrar=$_REQUEST['borrar7'];
			$valimg=$_REQUEST['img7'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg8";
			$nombreant="archivoanterior8";
			$borrar=$_REQUEST['borrar8'];
			$valimg=$_REQUEST['img8'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg9";
			$nombreant="archivoanterior9";
			$borrar=$_REQUEST['borrar9'];
			$valimg=$_REQUEST['img9'];
			include("../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsd2=$_REQUEST['dsd2'];
			$dsfechainicial=$_REQUEST['dsfechainicial'];
			$dsfechafinal=$_REQUEST['dsfechafinal'];
			$dsvideo=$_REQUEST['dsvideo'];

			$precio1=$_REQUEST['precio1'];
			$precio2=$_REQUEST['precio2'];
			$precio3=$_REQUEST['precio3'];
			$descuento=$_REQUEST['descuento'];
			$iva=$_REQUEST['iva'];

			$volumen=$_REQUEST['volumen'];
			$peso=$_REQUEST['peso'];
			$ancho=$_REQUEST['ancho'];
			$alto=$_REQUEST['alto'];
			$largo=$_REQUEST['largo'];

			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idcategoria=$_REQUEST['idcategoria'];




			$paso=$_REQUEST['paso'];
			if ($paso=="1") {

					/*$dsarchivo=limpieza(strtolower($dsm)).".php";
					$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$dsm,$idx,$include);*/

					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					//$sql.=",dsd='$dsd'";
					//$sql.=",dsd2='$dsd2'";
					//$sql.=",dsfechainicial='$dsfechainicial'";
					//$sql.=",idfechainicial='".preg_replace("/\//","",$dsfechainicial)."'";
					//$sql.=",dsfechafinal='$dsfechafinal'";
					//$sql.=",idfechafinal='".preg_replace("/\//","",$dsfechafinal)."'";
					//$sql.=",dsvideo='$dsvideo'";
					//$sql.=",precio1='$precio1'";
					//$sql.=",precio2='$precio2'";
					//$sql.=",precio3='$precio3'";
					//$sql.=",descuento='$descuento'";
					//$sql.=",iva='$iva'";
					//$sql.=",volumen='$volumen'";
					//$sql.=",peso='$peso'";
					//$sql.=",ancho='$ancho'";
					//$sql.=",alto='$alto'";
					//$sql.=",largo='$largo'";
					$sql.=",dsimg1='".$imgvec[0]."'";
					//$sql.=",dsimg2='".$imgvec[1]."'";
					//$sql.=",dsimg3='".$imgvec[2]."'";
					//$sql.=",dsimg4='".$imgvec[3]."'";
					//$sql.=",dsimg5='".$imgvec[4]."'";
					//$sql.=",dsimg6='".$imgvec[5]."'";
					//$sql.=",dsimg7='".$imgvec[6]."'";
					//$sql.=",dsimg8='".$imgvec[7]."'";
					//$sql.=",dsimg9='".$imgvec[8]."'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					//$sql.=",idcategoria=$idcategoria";
					$sql.=" where id=".$idx;
					//echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						$error=0;
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/contenidoinferior/default.php";
						include("../../incluidos_modulos/logs.php");
					}	else {
						$error=1;
						$mensajes=$men[7];
					}
			}



?>
<html>
		<?include("../../incluidos_modulos/head.php");?>
<body>

	<? include("../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsimg1,a.dsimg2,a.dsimg3,a.dsimg4,a.dsimg5,a.dsimg6,a.dsimg7,a.dsimg8,a.dsimg9,a.idcategoria,a.idpos,a.idactivo,a.dsvideo,a.dsd2";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");

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
?>
<? include("../../incluidos_modulos/encabezado.editar.php");?>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n</td>
<td>
<? $contadorx="dsd_counter";$valorx="3500";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n Larga</td>
<td>
<? $contadorx="dsd2_counter";$valorx="3500";$campox="dsd2";?>
<textarea name=dsd2 cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Precio 1</td>
<td>
<? $contadorx="precio1_counter";$valorx="255";$campox="precio1";?>
<input type=text name=precio1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio1')" value="<? echo $precio1?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_precio1";
$mensaje_capa="Debe ingresar el Precio 1";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Precio 2</td>
<td>
<? $contadorx="precio2_counter";$valorx="255";$campox="precio2";?>
<input type=text name=precio2 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio2')" value="<? echo $precio2?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_precio2";
$mensaje_capa="Debe ingresar el Precio2";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Precio 3</td>
<td>
<? $contadorx="precio3_counter";$valorx="255";$campox="precio3";?>
<input type=text name=precio3 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio3')" value="<? echo $precio3?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_precio3";
$mensaje_capa="Debe ingresar el Precio 3";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descuento</td>
<td>
<? $contadorx="descuento_counter";$valorx="255";$campox="descuento";?>
<input type=text name=descuento size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_descuento')" value="<? echo $descuento?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_descuento";
$mensaje_capa="Debe ingresar el Descuento";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Iva</td>
<td>
<? $contadorx="iva_counter";$valorx="255";$campox="iva";?>
<input type=text name=iva size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_iva')" value="<? echo $iva?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_iva";
$mensaje_capa="Debe ingresar el Iva";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Volumen</td>
<td>
<? $contadorx="volumen_counter";$valorx="255";$campox="volumen";?>
<input type=text name=volumen size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_volumen')" value="<? echo $volumen?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_volumen";
$mensaje_capa="Debe ingresar el Volumen";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Peso</td>
<td>
<? $contadorx="peso_counter";$valorx="255";$campox="peso";?>
<input type=text name=peso size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_peso')" value="<? echo $peso?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_peso";
$mensaje_capa="Debe ingresar el Peso";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ancho</td>
<td>
<? $contadorx="ancho_counter";$valorx="255";$campox="ancho";?>
<input type=text name=ancho size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_ancho')" value="<? echo $ancho?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_ancho";
$mensaje_capa="Debe ingresar el Ancho";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Alto</td>
<td>
<? $contadorx="alto_counter";$valorx="255";$campox="alto";?>
<input type=text name=alto size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_alto')" value="<? echo $alto?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_alto";
$mensaje_capa="Debe ingresar el Alto";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Largo</td>
<td>
<? $contadorx="largo_counter";$valorx="255";$campox="largo";?>
<input type=text name=largo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_largo')" value="<? echo $largo?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_largo";
$mensaje_capa="Debe ingresar el Largo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha Inicial</td>
<td>
<? $contadorx="dsfechainicial_counter";$valorx="10";$formax="u";$campox="dsfechainicial";$cantidad=strlen($dsfechainicial)?>
<input type=text name=dsfechainicial size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechainicial')" readonly  value="<? echo $dsfechainicial?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechainicial', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechainicial";
$mensaje_capa="Debe ingresar la fecha de publicacion";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha Final</td>
<td>
<? $contadorx="dsfechafinal_counter";$valorx="10";$formax="u";$campox="dsfechafinal";$cantidad=strlen($dsfechafinal)?>
<input type=text name=dsfechafinal size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechafinal')" readonly  value="<? echo $dsfechafinal?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechafinal', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechafinal";
$mensaje_capa="Debe ingresar la fecha de publicacion";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 1</td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen 1";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimg1?>">
<? if (is_file($rutaImagen.$dsimg1)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg1;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar1" value="1"> Borrar Esta imagen
<input type="hidden" name="img1" value="<? echo $dsimg1?>">

<? } ?>

</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen 2</td>
<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen 2";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior2" value="<? echo $dsimg2?>">
<? if (is_file($rutaImagen.$dsimg2)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg2;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar2" value="1"> Borrar Esta imagen
<input type="hidden" name="img2" value="<? echo $dsimg2?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 3</td>
<td><input type=file name=dsimg3 class=text1 onKeyPress="ocultar('capa_dsimg3')" onClick="ocultar('capa_dsimg3')">
<?
$nombre_capa="capa_dsimg3";
$mensaje_capa="Debe cargar la imagen 3";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior3" value="<? echo $dsimg3?>">
<? if (is_file($rutaImagen.$dsimg3)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg3;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar3" value="1"> Borrar Esta imagen
<input type="hidden" name="img3" value="<? echo $dsimg3?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 4</td>
<td><input type=file name=dsimg4 class=text1 onKeyPress="ocultar('capa_dsimg4')" onClick="ocultar('capa_dsimg4')">
<?
$nombre_capa="capa_dsimg4";
$mensaje_capa="Debe cargar la imagen 4";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior4" value="<? echo $dsimg4?>">
<? if (is_file($rutaImagen.$dsimg4)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg4;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar4" value="1"> Borrar Esta imagen
<input type="hidden" name="img4" value="<? echo $dsimg4?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 5</td>
<td><input type=file name=dsimg7 class=text1 onKeyPress="ocultar('capa_dsimg7')" onClick="ocultar('capa_dsimg7')">
<?
$nombre_capa="capa_dsimg7";
$mensaje_capa="Debe cargar la imagen 5";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior7" value="<? echo $dsimg7?>">
<? if (is_file($rutaImagen.$dsimg7)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg7;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar7" value="1"> Borrar Esta imagen
<input type="hidden" name="img7" value="<? echo $dsimg7?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 6</td>
<td><input type=file name=dsimg8 class=text1 onKeyPress="ocultar('capa_dsimg8')" onClick="ocultar('capa_dsimg8')">
<?
$nombre_capa="capa_dsimg8";
$mensaje_capa="Debe cargar la imagen 8";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior8" value="<? echo $dsimg8?>">
<? if (is_file($rutaImagen.$dsimg8)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg8;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar8" value="1"> Borrar Esta imagen
<input type="hidden" name="img8" value="<? echo $dsimg8?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 7</td>
<td><input type=file name=dsimg9 class=text1 onKeyPress="ocultar('capa_dsimg9')" onClick="ocultar('capa_dsimg9')">
<?
$nombre_capa="capa_dsimg9";
$mensaje_capa="Debe cargar la imagen 9";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior9" value="<? echo $dsimg9?>">
<? if (is_file($rutaImagen.$dsimg9)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg9;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar9" value="1"> Borrar Esta imagen
<input type="hidden" name="img9" value="<? echo $dsimg9?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 8</td>
<td><input type=file name=dsimg5 class=text1 onKeyPress="ocultar('capa_dsimg5')" onClick="ocultar('capa_dsimg5')">
<?
$nombre_capa="capa_dsimg5";
$mensaje_capa="Debe cargar la imagen 5";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior5" value="<? echo $dsimg5?>">
<? if (is_file($rutaImagen.$dsimg5)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg5;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar5" value="1"> Borrar Esta imagen
<input type="hidden" name="img5" value="<? echo $dsimg5?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 9</td>
<td><input type=file name=dsimg6 class=text1 onKeyPress="ocultar('capa_dsimg6')" onClick="ocultar('capa_dsimg6')">
<?
$nombre_capa="capa_dsimg6";
$mensaje_capa="Debe cargar la imagen 6";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior6" value="<? echo $dsimg6?>">
<? if (is_file($rutaImagen.$dsimg6)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg6;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar6" value="1"> Borrar Esta imagen
<input type="hidden" name="img6" value="<? echo $dsimg6?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Video</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="3500";$campox="dsvideo";?>
<textarea name=dsvideo cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar el Video";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Categorias</td>

<td>
			<select name="idcategoria" class="text1">
			  <? listar_categorias("tblcategoria",$result->fields[11]); ?>
		  	</select>
</td>
</tr -->

<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include("../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <!--option value="3" <? if ($idactivo==3) echo "selected";?>>DESTACADO INDEX</option -->

	</select>

</td>
</tr>




<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
include("../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<?
} // fin si
$result->Close();
?>
<br>
<?
	include("../../incluidos_modulos/navegador.principal.cerrar.php");

include("../../incluidos_modulos/modulos.remate.php");?>


</body>
</html>
