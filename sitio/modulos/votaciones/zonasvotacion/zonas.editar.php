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
include("../../incluidos_modulos/version.php");
include("../../incluidos_modulos/comunes.php");
include("../../incluidos_modulos/varconexion.php");
include("../../incluidos_modulos/modulos.funciones.php");
include("../../incluidos_modulos/sql.injection.php");
include("../../incluidos_modulos/sessiones.php");
include("../../incluidos_modulos/varmensajes.php");
include ("../../incluidos_modulos/modulos.calendario.php");

$titulomodulo="Configuracion de zonas de votaci&oacute;n";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblzonasdevotacion";
$tablarelaciones2="tblgruposxnoticias";
$tablaorigen2="tblgrupos";
$tablarelaciones="tblcatxnoticias";
$tablaorigen="tblcatnoticias";

$rutaImagen="../../../contenidos/images/zonasvotacion/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/zonasvotacion/";

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
			
			
			
			if ($_FILES['dsimg2']['name']<>"") {
				// borrar anterior
				$archivoanterior2=$_REQUEST['archivoanterior2'];
				if (is_file($rutaImagen.$archivoanterior2)) unlink($rutaImagen.$archivoanterior2);
				$temp_name = $_FILES['dsimg2']['tmp_name'];
				$nombre2=$tabla.$idx."-".date("his")."-3.".substr($_FILES['dsimg2']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre2);
			}
			if ($_REQUEST['img2']<>"") $nombre2=$_REQUEST['img2'];
			if ($_REQUEST['borrar2']==1) $nombre2="";
			
				if ($_FILES['dsdoc']['name']<>"") {
				// borrar anterior
				$archivoanterior4=$_REQUEST['archivoanterior4'];
				if (is_file($rutaImagen.$archivoanterior4)) unlink($rutaImagen.$archivoanterior4);
				$temp_name = $_FILES['dsdoc']['tmp_name'];
				$nombre4=$tabla.$idx."-".date("his")."-4.".substr($_FILES['dsdoc']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre4);
			}
			elseif($_REQUEST['dsnombredoc']<>"") $nombre4=$_REQUEST['dsnombredoc'];
			elseif ($_REQUEST['img4']<>"") $nombre4=$_REQUEST['img4'];
			if ($_REQUEST['borrar4']==1) $nombre4="";
			
			if ($_FILES['dsdoc2']['name']<>"") {
				// borrar anterior
				$archivoanterior5=$_REQUEST['archivoanterior5'];
				if (is_file($rutaImagen.$archivoanterior5)) unlink($rutaImagen.$archivoanterior5);
				$temp_name = $_FILES['dsdoc2']['tmp_name'];
				$nombre5=$tabla.$idx."-".date("his")."-5.".substr($_FILES['dsdoc2']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre5);
			}
			elseif($_REQUEST['dsnombredoc1']<>"") $nombre5=$_REQUEST['dsnombredoc1'];
			elseif ($_REQUEST['img5']<>"") $nombre5=$_REQUEST['img5'];
			if ($_REQUEST['borrar5']==1) $nombre5="";
			
			if ($_FILES['dsdoc3']['name']<>"") {
				// borrar anterior
				$archivoanterior6=$_REQUEST['archivoanterior6'];
				if (is_file($rutaImagen.$archivoanterior6)) unlink($rutaImagen.$archivoanterior6);
				$temp_name = $_FILES['dsdoc3']['tmp_name'];
				$nombre6=$tabla.$idx."-".date("his")."-6.".substr($_FILES['dsdoc3']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre6);
			}
			elseif($_REQUEST['dsnombredoc2']<>"") $nombre6=$_REQUEST['dsnombredoc2'];
			elseif ($_REQUEST['img6']<>"") $nombre6=$_REQUEST['img6'];
			if ($_REQUEST['borrar6']==1) $nombre6="";
			
			
			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsd2=$_REQUEST['dsd2'];
			$dsfecha=$_REQUEST['dsfecha'];
			$dsfechaf=$_REQUEST['dsfechaf'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idtipo=$_REQUEST['idtipo'];
			$dsvideo=$_REQUEST['dsvideo'];
			
			
		/*	$paso=$_REQUEST['paso'];
			if ($paso=="1") {*/
			 
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsd2='$dsd2'";					
					$sql.=",idfecha='".preg_replace("/\//","",$dsfecha)."'";					
					$sql.=",dsfechainicial='$dsfecha'";
					$sql.=",dsfechafinal='$dsfechaf'";					
					$sql.=",dsimg1='$nombre1'";
					$sql.=",dsimg2='$nombre2'";
					$sql.=",dsvideo='$dsvideo'";
					$sql.=",dsdoc1='$nombre4'";
					$sql.=",dsdoc2='$nombre5'";
					$sql.=",dsdoc3='$nombre6'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;
					
			//exit;
					
					if ($db->Execute($sql)){ 
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificaci&oacute;n $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro en $titulomodulo";
						$dsruta="../zonasvotacion/default.php";
						include("../../incluidos_modulos/logs.php");
						include("../relaciones/relaciones.grupos.operaciones.php");
						include("../relaciones/relaciones.operaciones.php");
							
					}	else { 
						$mensajes=$men[7];
					}
			//}
			
			

?>
<html>
<head>
	<title><? echo $AppNombre;?></title>
<? include("../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include("../../incluidos_modulos/modulos.encabezado.php");
include("../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsd2,a.dsimg1,a.dsimg2,a.idpos,a.dsfechainicial,a.dsfechafinal,a.idactivo,a.idfecha,a.dsvideo,a.dsdoc1";
$sql.=",a.dsdoc2,a.dsdoc3";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="<a href='../admonvotaciones/default.php' class='textlink' title='Administrador de votaciones'>Administrador de votaciones</a>  /";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include("../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsd2=$result->fields[2];
$dsimg1=$result->fields[3];
$dsimg2=$result->fields[4];
$idpos=$result->fields[5];
$dsfecha=$result->fields[6];
$dsfechaf=$result->fields[7];
$idactivo=$result->fields[8];
$idfecha=$result->fields[9];
$dsvideo=$result->fields[10];
$dsdoc=$result->fields[11];
$dsdoc2=$result->fields[12];
$dsdoc3=$result->fields[13];
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

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="text1" bgcolor="#CCCCCC">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";$cantidad=strlen($dsm)?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n corta</td>
<td>
<? $contadorx="dsd_counter";$valorx="1000";$campox="dsd";$cantidad=strlen($dsd)?>
<textarea name=dsd cols=80  rows="5" class=text1 onKeyPress="ocultar('capa_dsd')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n larga</td>
<td>
<? $contadorx="dsd2_counter";$valorx="4000";$campox="dsd2";$cantidad=strlen($dsd2)?>
<textarea name=dsd2 cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n larga";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 1<br/></td>
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

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 2<br/></td>
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
<td>Video Youtube</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="255";$campox="dsvideo";$cantidad=strlen($dsvideo)?>
<textarea name=dsvideo cols=70  rows="10" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include("../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar el codigo del video en youtube";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Documento 1<br/></td>
<td><input type=file name=dsdoc class=text1 onKeyPress="ocultar('capa_dsdoc')" onClick="ocultar('capa_dsdoc')">
<?
$nombre_capa="capa_dsdoc";
$mensaje_capa="Debe cargar el documento";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior4" value="<? echo $dsdoc?>">
<? if (is_file($rutaImagen.$dsdoc)) {?>
&nbsp;<a href="descargar.php?path=<? echo $rutaImagen;?>&file=<? echo $dsdoc; ?>">Ver documento</a>
<br>
<input type="checkbox" name="borrar4" value="1"> Borrar Esta documento
<input type="hidden" name="img4" value="<? echo $dsdoc?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre del documento<br>
Si el documento es muy pesado ingrese el nombre aqui con la extencion (.pdf/.doc/.xls) y subalo via ftp en la 
carpeta ../../../contenidos/images/noticias/<br>
</td>
<td>
<? $contadorx="dsnombredoc_counter";$valorx="255";$formax="u";$campox="dsnombredoc";?>
<input type=text name=dsnombredoc size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombredoc')" value="" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsnombredoc";
$mensaje_capa="Debe ingresar lel nombre del documento";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Documento 2<br/></td>
<td><input type=file name=dsdoc2 class=text1 onKeyPress="ocultar('capa_dsdoc2')" onClick="ocultar('capa_dsdoc2')">
<?
$nombre_capa="capa_dsdoc2";
$mensaje_capa="Debe cargar el documento";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior5" value="<? echo $dsdoc2?>">
<? if (is_file($rutaImagen.$dsdoc2)) {?>
&nbsp;<a href="descargar.php?path=<? echo $rutaImagen;?>&file=<? echo $dsdoc2; ?>">Ver documento</a>
<br>
<input type="checkbox" name="borrar5" value="1"> Borrar Esta documento
<input type="hidden" name="img5" value="<? echo $dsdoc2?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Nombre del documento<br>
Si el documento es muy pesado ingrese el nombre aqui con la extencion (.pdf/.doc/.xls) y subalo via ftp en la 
carpeta ../../../contenidos/images/noticias/<br>
</td>
<td>
<? $contadorx="dsnombredoc1_counter";$valorx="255";$formax="u";$campox="dsnombredoc1";?>
<input type=text name=dsnombredoc1 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombredoc1')" value="" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsnombredoc1";
$mensaje_capa="Debe ingresar lel nombre del documento";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Documento 3<br/></td>
<td><input type=file name=dsdoc3 class=text1 onKeyPress="ocultar('capa_dsdoc3')" onClick="ocultar('capa_dsdoc3')">
<?
$nombre_capa="capa_dsdoc3";
$mensaje_capa="Debe cargar el documento";
include("../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior6" value="<? echo $dsdoc3?>">
<? if (is_file($rutaImagen.$dsdoc3)) {?>
&nbsp;<a href="descargar.php?path=<? echo $rutaImagen;?>&file=<? echo $dsdoc3; ?>">Ver documento</a>
<br>
<input type="checkbox" name="borrar6" value="1"> Borrar Esta documento
<input type="hidden" name="img6" value="<? echo $dsdoc3?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Nombre del documento<br>
Si el documento es muy pesado ingrese el nombre aqui con la extencion (.pdf/.doc/.xls) y subalo via ftp en la 
carpeta ../../../contenidos/images/noticias/<br>
</td>
<td>
<? $contadorx="dsnombredoc2_counter";$valorx="255";$formax="u";$campox="dsnombredoc2";?>
<input type=text name=dsnombredoc2 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsnombredoc2')" value="" <? include("../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsnombredoc2";
$mensaje_capa="Debe ingresar lel nombre del documento";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Fecha de publicaci&oacute;n</td>
<td>
<? $contadorx="dsfecha_counter";$valorx="10";$formax="u";$campox="dsfecha";?>
<input type=text name=dsfecha size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfecha')" readonly  value="<? echo $dsfecha?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfecha', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfecha";
$mensaje_capa="Debe ingresar la fecha de publicacion";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha Final de publicaci&oacute;n</td>
<td>
<? $contadorx="dsfechaf_counter";$valorx="10";$formax="u";$campox="dsfechaf";?>
<input type=text name=dsfechaf size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechaf')" readonly  value="<? echo $dsfechaf?>" <? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf', this);" language="javaScript">	
<?
$nombre_capa="capa_dsfechaf";
$mensaje_capa="Debe ingresar la fecha final";
include("../../incluidos_modulos/control.capa.php");
include("../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



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
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>DESTACADA</option>		  
	</select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES.</strong> Asocie las categorias de noticias
<br>
<? include("../relaciones/relaciones.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES.</strong> Asocie los grupos de inter&eacute;s
<br>
<? include("../relaciones/grupos.php");?>
</td>
</tr>



<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsm,dsd,dsd2,idpos";	
include("../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<a name="video"></a>
<?
include("../reproductores/default.php"); 
?>
<? 
} // fin si 
$result->Close();
?>
<br>
<? include("../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
