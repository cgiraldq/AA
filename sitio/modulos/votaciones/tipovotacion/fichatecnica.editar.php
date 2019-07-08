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
$rutx=1;
if($rutx==1) $rutxx="../";
include($rutxx."../../incluidos_modulos/modulos.globales.php");

$titulomodulo="Ficha t&eacute;cnica";
$idtv=$_REQUEST['idtv'];
$idx=$_REQUEST['idx'];
$rr="fichatecnica.php?idtv=".$idtv;

$tabla="tblvotacionfichatecnica";
$rutaImagen=$rutxx."../../../contenidos/images/fichatecnica/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/fichatecnica/";
$rutaPlayer="../"; // uso desde el admon

			if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre1);
} elseif ($_REQUEST['img1']<>"") {
$nombre1=$_REQUEST['img1'];
}
if ($_REQUEST['borrar1']==1) $nombre1="";


			if ($_FILES['dsimg3']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior3'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg3']['tmp_name'];
				$nombre3=$tabla.$idx."-".date("his")."-3.".substr($_FILES['dsimg3']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre3);
			}
			if ($_REQUEST['img3']<>"") $nombre3=$_REQUEST['img3'];
			if ($_REQUEST['borrar3']==1) $nombre3="";

			if ($_FILES['dsdoc']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior4'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsdoc']['tmp_name'];
				$nombre4=$tabla.$idx."-".date("his")."-3.".substr($_FILES['dsdoc']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre4);
			}
			if ($_REQUEST['img4']<>"") $nombre4=$_REQUEST['img4'];
			if ($_REQUEST['borrar4']==1) $nombre4="";



			if ($_FILES['dsvideo']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior2'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsvideo']['tmp_name'];
				$video=$tabla.$idx."-".date("his")."-2.".substr($_FILES['dsvideo']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$video);
			}elseif ($_REQUEST['video']<>"") {  // nombre del video
				$video=$_REQUEST['video'];
			}elseif ($_REQUEST['video1']) {
				$video=$_REQUEST['video1'];
			}


			if ($_REQUEST['borrar2']==1) $video="";

			$dsm=$_REQUEST['dsm'];
			$idactivo=$_REQUEST['idactivo'];
			$dsdficha=$_REQUEST['dsdficha'];
			$dsdcertinscripcion=$_REQUEST['dsdcertinscripcion'];
			$dsdcertvotacion=$_REQUEST['dsdcertvotacion'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsimgenc='$nombre1'";
					$sql.=",dsimgpie='$nombre3'";
					$sql.=",dsdficha='$dsdficha'";
					$sql.=",dsdcertinscripcion='$dsdcertinscripcion'";
					$sql.=",dsdcertvotacion='$dsdcertvotacion'";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;

					if ($db->Execute($sql))  {
						$error=0;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../tipovotacion/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");

					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idactivo,a.dsimgenc,a.dsimgpie,dsdficha,dsdcertinscripcion,dsdcertvotacion";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="<a href='default.php' class='textlink' title='Tipo de votacion'>Tipo de votaci&oacute;n</a>  /  ";
$rutamodulo.="  <a href='$rr' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idactivo=$result->fields[1];
$dsimgenc=$result->fields[2];
$dsimgpie=$result->fields[3];
$dsdficha=$result->fields[4];
$dsdcertinscripcion=$result->fields[5];
$dsdcertvotacion=$result->fields[6];



?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">

<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
<tr>
	<td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsm,dsdficha";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idtv" value="<? echo $idtv?>">
</td>
</tr>

<input type="hidden" name="img3" value="<? echo $dsimg2?>">

<input type="hidden" name="archivoanterior3" value="<? echo $dsimg2?>">


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";$cantidad=strlen($dsm);?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen Encabezado<br><br><br/></td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen de encabezado";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimgenc?>">
<? if (is_file($rutaImagen.$dsimgenc)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimgenc;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar1" value="1"> Borrar Esta imagen
<input type="hidden" name="img1" value="<? echo $dsimgenc?>">

<? } ?>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen Pie<br><br><br/></td>
<td><input type=file name=dsimg3 class=text1 onKeyPress="ocultar('capa_dsimg3')" onClick="ocultar('capa_dsimg3')">
<?
$nombre_capa="capa_dsimg3";
$mensaje_capa="Debe cargar la imagen de pie";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior3" value="<? echo $dsimgpie?>">
<? if (is_file($rutaImagen.$dsimgpie)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimgpie;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar3" value="1"> Borrar Esta imagen
<input type="hidden" name="img3" value="<? echo $dsimgpie?>">

<? } ?>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n Ficha t&eacute;cnica</td>
<td>
<? $contadorx="dsdficha_counter";$valorx="3000";$campox="dsdficha";$cantidad=strlen($dsdficha)?>
<textarea name=dsdficha cols=80  rows="5" class=text1 onKeyPress="ocultar('capa_dsdficha')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsdficha?></textarea>
<?
$nombre_capa="capa_dsdficha";
$mensaje_capa="Debe ingresar la descripci&oacute;n de la ficha t&eacute;cnica";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n Certificado de inscripci&oacute;n</td>
<td>
<? $contadorx="dsdcertinscripcion_counter";$valorx="3000";$campox="dsdcertinscripcion";$cantidad=strlen($dsdcertinscripcion)?>
<textarea name=dsdcertinscripcion cols=80  rows="5" class=text1 onKeyPress="ocultar('capa_dsdcertinscripcion')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsdcertinscripcion?></textarea>
<?
$nombre_capa="capa_dsdcertinscripcion";
$mensaje_capa="Debe ingresar la descripci&oacute;n del certificado de inscripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n Certificado de votaci&oacute;n</td>
<td>
<? $contadorx="dsdcertvotacion_counter";$valorx="3000";$campox="dsdcertvotacion";$cantidad=strlen($dsdcertvotacion)?>
<textarea name=dsdcertvotacion cols=80  rows="5" class=text1 onKeyPress="ocultar('capa_dsdcertvotacion')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsdcertvotacion?></textarea>
<?
$nombre_capa="capa_dsdcertinscripcion";
$mensaje_capa="Debe ingresar la descripci&oacute;n del certificado de votaci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>

<tr>
	<td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsm,dsdficha";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idtv" value="<? echo $idtv?>">
</td>
</tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<a name="video"></a>
<?

?>
<?
} // fin si
$result->Close();
?>
<br>
<?include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
		include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>