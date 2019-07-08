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
$rutxx="../";

include($rutxx."../../incluidos_modulos/version.php");
include($rutxx."../../incluidos_modulos/comunes.php");
include($rutxx."../../incluidos_modulos/varconexion.php");
include($rutxx."../../incluidos_modulos/modulos.funciones.php");
include($rutxx."../../incluidos_modulos/sql.injection.php");
include($rutxx."../../incluidos_modulos/sessiones.php");
include($rutxx."../../incluidos_modulos/varmensajes.php");
include($rutxx."../../incluidos_modulos/modulos.calendario.php");

$titulomodulo="Configuracion de candidatos";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblfuncionarios";
$carpeta="funcionarios";
$tablarelaciones2="tblgruposxfuncionarios";
$tablaorigen2="tblgrupos";

//$rutaImagen="../../../contenidos/images/talentohumano/";
// rutas repro
//$rutaRepro=$rutaAbs."/contenidos/images/talentohumano/";
$rutaPlayer="../"; // uso desde el admon

			/*if ($_FILES['dsimg1']['name']<>"") {
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
				$nombre3=$tabla.$idx."-".date("his")."-2.".substr($_FILES['dsimg3']['name'],-3);
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
			
			
			if ($_REQUEST['borrar2']==1) $video="";*/
			
			$dsm=$_REQUEST['dsm'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$telefono=$_REQUEST['dstelefono'];
			$correo=$_REQUEST['dscorreo'];
			$empresa=$_REQUEST['dsempresa'];
			$sede=$_REQUEST['dssede'];
			$cate=$_REQUEST['idcat'];
			$paso=$_REQUEST['paso'];
			
			if ($paso=="1") { 
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";	
					$sql.=",dsempresa='$empresa'";					
					//$sql.=",dsimg='$nombre1'";
					$sql.=",dstelefono='$telefono'";
					$sql.=",dscorreo='$correo'";
					$sql.=",dssede='$sede'";
					$sql.=",idpos=$idpos";
					$sql.=",idcat=$cate";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;
					
					if ($db->Execute($sql))  { 
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro en $titulomodulo";
						$dsruta="../funcionarios/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						include("../relaciones/relaciones.grupos.operaciones.php");
						
						}	else { 
						$mensajes=$men[7];
					}
			}
			
			

?>
<html>
<head>
	<title><? echo $AppNombre;?></title>
<? include($rutxx."../../incluidos_modulos/sub.encabezado.php");?>
</head>
<body color=#ffffff  topmargin=0 leftmargin=0>
<?
include($rutxx."../../incluidos_modulos/modulos.encabezado.php");
include($rutxx."../../incluidos_modulos/modulos.mensajes.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsempresa,dscorreo,dstelefono,dssede,idcat";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
//$dsimg1=$result->fields[3];
$dsempresa=$result->fields[3];
$dscorreo=$result->fields[4];
$dstelefono=$result->fields[5];
$dssede=$result->fields[6];
$idcat=$result->fields[7];
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
<td>Categoria</td>
<td>
	<select name=idcat class=text1>
		 <? categorias("tblcatfuncionarios",$idcat)?>
	</select>

</td>
</tr>


<!--<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n corta</td>
<td>
<? $contadorx="dsd_counter";$valorx="500";$campox="dsd";?>
<textarea name=dsd cols=80  rows="5" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>-->

<!--<tr valign=top bgcolor="#FFFFFF">
<td>Imagen <br><br><br/></td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimg1?>">
<? if (is_file($rutaImagen.$dsimg1)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg1;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar1" value="1"> Borrar Esta imagen
<input type="hidden" name="img1" value="<? echo $dsimg1?>">

<? } ?>

</td>
</tr>-->

<tr valign=top bgcolor="#FFFFFF">
<td>Tel&eacute;fono</td>
<td>
<? $contadorx="dstelefono_counter";$valorx="20";$formax="u";$campox="dstelefono";$cantidad=strlen($dstelefono);?>
<input type=text name=dstelefono size=45 maxlength="20" class=text1 onKeyPress="ocultar('capa_dstelefono')" value="<? echo $dstelefono?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstelefono";
$mensaje_capa="Debe ingresar el telefono";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Correo</td>
<td>
<? $contadorx="dscorreo_counter";$valorx="255";$formax="u";$campox="dscorreo";$cantidad=strlen($dscorreo);?>
<input type=text name=dscorreo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dscorreo')" value="<? echo $dscorreo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dscorreo";
$mensaje_capa="Debe ingresar el correo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Empresa</td>
<td>
<? $contadorx="dsempresa_counter";$valorx="255";$formax="u";$campox="dsempresa";$cantidad=strlen($dsempresa);?>
<input type=text name=dsempresa size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsempresa')" value="<? echo $dsempresa?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsempresa";
$mensaje_capa="Debe ingresar la empresa";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Sede</td>
<td>
<? $contadorx="dssede_counter";$valorx="255";$formax="u";$campox="dssede";$cantidad=strlen($dssede);?>
<input type=text name=dssede size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dssede')" value="<? echo $dssede?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dssede";
$mensaje_capa="Debe ingresar la sede";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
 
?>
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
$param="dsm,idpos";	
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
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
// 
?>
<? 
} // fin si 
$result->Close();
?>
<br>
<? include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>