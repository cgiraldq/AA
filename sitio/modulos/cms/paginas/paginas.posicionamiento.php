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
  Juan Fernando Fern�ndez <consultorweb@comprandofacil.com> - Proyectos
  Juan Felipe S�nchez <graficoweb@comprandofacil.com> - Dise�o
  Jos� Fernando Pe�a <soporteweb@comprandofacil.com> - Mercadeo
=====================================================================
| ----------------------------------------------------------------- | 
*/
// edicion de datos
$rutx=1;
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Listado de paginas";
$rr="default.php?idtiendax=".$_REQUEST['idtiendax'];
$idx=$_REQUEST['idx'];
$tabla=$prefix."tblpaginas";
$rutaImagen="../../../../imagenes/paginas/";
// rutas repro
$rutaRepro=$rutaAbs."/imagenes/paginas/";
$rutaPlayer="../"; // uso desde el admon


			if ($_FILES['dsimg1']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior1'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg1']['tmp_name'];
				$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);	move_uploaded_file($temp_name,$rutaImagen.$nombre1);
} elseif ($_REQUEST['img1']<>"") { 
$nombre1=$_REQUEST['img1'];
}
if ($_REQUEST['borrar1']==1) $nombre1="";
			if ($_FILES['dsimg2']['name']<>"") {
				// borrar anterior
-				$archivoanterior=$_REQUEST['archivoanterior2'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg2']['tmp_name'];
				$nombre2=$tabla.$idx."-2.".substr($_FILES['dsimg2']['name'],-3);
				
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
				$video=$tabla.$idx."-".date("his").".".substr($_FILES['dsvideo']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$video);
			}elseif ($_REQUEST['video']<>"") {  // nombre del video
				$video=$_REQUEST['video'];
			}elseif ($_REQUEST['video1']) {
				$video=$_REQUEST['video1'];
			} 
			if ($_REQUEST['borrar3']==1) $video="";
			
			
			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dskw=$_REQUEST['dskw'];
			$iddia=$_REQUEST['iddia'];
			$dstit=$_REQUEST['dstit'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") { 
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dstit='$dstit'";
					$sql.=",dskw='$dskw'";
					$sql.=",iddia='$iddia'";
					
				//echo $sql;
					$sql.=" where id=".$idx;
					if ($db->Execute($sql))  { 
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  pagina del sitio";
						$dsruta="../paginas/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");	
						$error=0;

					}	else { 
						$mensajes=$men[7];
						$error=1;

					}
			}
			
			

?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.iddia,a.dstit,a.dsd,a.dskw";
$sql.=" from $tabla a where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="/ <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Posicionamiento</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$iddia=$result->fields[1];
$dstit=$result->fields[2];
$dsd=$result->fields[3];
$dskw=$result->fields[4];
?>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Pagina</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre de la categoria";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>



</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Titulo de pagina (title)</td>
<td>
<? $contadorx="dstit_counter";$valorx="255";$formax="u";$campox="dstit";?>
<input type=text name=dstit size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstit')" value="<? echo $dstit?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstit";
$mensaje_capa="Debe ingresar el titulo de la pagina";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripci�n (description)</td>
<td>
<? $contadorx="dsd_counter";$valorx="400";$campox="dsd";?>
<textarea name=dsd cols=70  rows="5" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n corta";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Titulo</td>
<td>
<? //$contadorx="dstitulo_counter";$valorx="255";$formax="u";$campox="dstitulo";?>
<input type=text name=dstitulo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstitulo')" value="<? //echo $dstitulo?>" <? //include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
/*$nombre_capa="capa_dstitulo";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");*/?>
</td>
</tr-->

<tr valign=top bgcolor="#FFFFFF">
<td>Palabras claves de ubicacion (keywords)</td>
<td>
<? $contadorx="dskw_counter";$valorx="255";$campox="dskwin";?>
<textarea name=dskw cols=50  rows="5" class=text1 onKeyPress="ocultar('capa_dskw')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dskw?></textarea>
<?
$nombre_capa="capa_dskw";
$mensaje_capa="Debe ingresar las palabras claves de la pagina";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Revisar esta pagina en </td>
<td><input type=text name=iddia size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_iddia ')" value="<? echo $iddia?>">
<?
$nombre_capa="capa_iddia";
$mensaje_capa="Debe digitar el numero de dias";
include($rutxx."../../incluidos_modulos/control.capa.php");
 
?>
dias</td>
</tr>


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,dsd,dstit,dskw";	
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type=hidden name=idtiendax value="<? echo $_REQUEST['idtiendax']?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<a name="video"></a>
<? include($rutxx."../temporales/reproductores/default.php");
} // fin si 
$result->Close();
?>
<br>
<? 
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>