<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores:
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// edicion de datos
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include("../../incluidos_modulos/class.rc4crypt.php");
include("../../incluidos_modulos/bloqueo.ip.php");

$titulomodulo="Posicionamiento de Noticias";
$rr="default.php";
$idpo=$_REQUEST['idpo'];
$tabla=$prefix."tblnoticias";
$rutaPlayer="../"; // uso desde el admon


			if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla.$idpo."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);	move_uploaded_file($temp_name,$rutaImagen.$nombre1);
} elseif ($_REQUEST['img1']<>"") {
$nombre1=$_REQUEST['img1'];
}
if ($_REQUEST['borrar1']==1) $nombre1="";
			if ($_FILES['dsimg2']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior2'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg2']['tmp_name'];
				$nombre2=$tabla.$idpo."-2.".substr($_FILES['dsimg2']['name'],-3);

move_uploaded_file($temp_name,$rutaImagen.$nombre2);
			}elseif ($_REQUEST['img2']<>"") {
$nombre2=$_REQUEST['img2'];
}
			if ($_REQUEST['borrar2']==1) $nombre2="";



			if ($_FILES['dsvideo']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior3'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsvideo']['tmp_name'];
				$video=$tabla.$idpo."-".date("his").".".substr($_FILES['dsvideo']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$video);
			}elseif ($_REQUEST['video']<>"") {  // nombre del video
				$video=$_REQUEST['video'];
			}elseif ($_REQUEST['video1']) {
				$video=$_REQUEST['video1'];
			}
			if ($_REQUEST['borrar3']==1) $video="";


			$dsruta=$_REQUEST['dsruta'];
			$dsdp=$_REQUEST['dsdp'];
			$dskw=$_REQUEST['dskw'];
			//$iddia=$_REQUEST['iddia'];
			$dsm=$_REQUEST['dsm'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.="dsruta='$dsruta'";
					$sql.=",dsdp='$dsdp'";
					$sql.=",dsm='$dsm'";
					$sql.=",dskw='$dskw'";
					//$sql.=",iddia='$iddia'";

				//echo $sql;
					$sql.=" where id=".$idpo;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  pagina del sitio";
						$dsruta="../cms/categoriasconvenios/default.php";
						include("../../incluidos_modulos/logs.php");
					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
<head>
	<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>

<link rel="stylesheet" href="../../css_modulos/js_color_picker_v2.css" media="screen">
<script src="../../js_modulos/color_functions.js"></script>
<script type="text/javascript" src="../../js_modulos/js_color_picker_v2.js"></script>


</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsruta,a.dsm,a.dsdp,a.dskw";
$sql.=" from $tabla a where a.id=$idpo ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink'>Principal</a>  / <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Posicionamiento</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
$dsruta=$result->fields[0];
$dsm=$result->fields[1];
$dsdp=$result->fields[2];
$dskw=$result->fields[3];
?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" valign="top" bgcolor="#CACAD0"><br />


<table width="70%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="6" align="left" valign="top"><img src="../../img_modulos/modulos/titulo_r1_c1.jpg" width="6" height="22" /></td>
          <td width="615" align="left" valign="middle" background="../../img_modulos/modulos/franja_grisoscuro_r1_c2.jpg" class="titulo_negro">Edicion del registro seleccionado</td>
        </tr></table>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="text1" bgcolor="#CCCCCC"
width=70% class="text1" bgcolor="#CCCCCC"
width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Pagina</td>
<td>
<? $contadorx="dsruta_counter";$valorx="255";$formax="u";$campox="dsruta";?>
<input type=text name=dsruta size=45 maxlength="255" readonly class=text1 onKeyPress="ocultar('capa_dsruta')" value="<? echo $dsruta?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsruta";
$mensaje_capa="Debe ingresar el nombre de la categoria";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>



</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Titulo de pagina (title)</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" readonly class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo de la pagina";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripción (description)</td>
<td>
<? $contadorx="dsdp_counter";$valorx="400";$campox="dsdp";?>
<textarea name=dsdp cols=70  rows="5" class=text1 onKeyPress="ocultar('capa_dsdp')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsdp?></textarea>
<?
$nombre_capa="capa_dsdp";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Titulo</td>
<td>
<? //$contadorx="dstitulo_counter";$valorx="255";$formax="u";$campox="dstitulo";?>
<input type=text name=dstitulo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstitulo')" value="<? //echo $dstitulo?>" <? //include("../../incluidos_modulos/control.evento.php");?>>
<?
/*$nombre_capa="capa_dstitulo";
$mensaje_capa="Debe ingresar el titulo";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");*/?>
</td>
</tr-->

<tr valign=top bgcolor="#FFFFFF">
<td>Palabras claves de ubicacion (keywords)</td>
<td>
<? $contadorx="dskw_counter";$valorx="255";$campox="dskwin";?>
<textarea name=dskw cols=50  rows="5" class=text1 onKeyPress="ocultar('capa_dskw')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dskw?></textarea>
<?
$nombre_capa="capa_dskw";
$mensaje_capa="Debe ingresar las palabras claves de la pagina";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--  <tr valign=top bgcolor="#FFFFFF">
<td>Revisar esta pagina en </td>
<td><input type=text name=iddia size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_iddia ')" value="<? echo $iddia?>">
<?
$nombre_capa="capa_iddia";
$mensaje_capa="Debe digitar el numero de dias";
include("../../incluidos_modulos/control.capa.php");

?>
dias</td>
</tr>
-->

<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsruta,dsdp,dsm,dskw";
include("../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idpo" value="<? echo $idpo?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<a name="video"></a>
<? include("../reproductores/default.php");
} // fin si
$result->Close();
?>
<br>
<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>