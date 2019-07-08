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
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Listado de p&aacute;ginas del sitio";
$rr="default.php?idtiendax=".$_REQUEST['idtiendax'];
$idx=$_REQUEST['idx'];
$tabla=$prefix."tblpaginas";
$rutaImagen="../../../../contenidos/images/paginas/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/paginas/";
$rutaPlayer="../"; // uso desde el admon


			 $nombre="dsimg1";
             $nombreant="archivoanterior1";
             $borrar=$_REQUEST['borrar1'];
             $valimg=$_REQUEST['img1'];
             include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

             $nombre="dsimg2";
             $nombreant="archivoanterior2";
             $borrar=$_REQUEST['borrar2'];
             $valimg=$_REQUEST['img2'];
             include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");



			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsd2=$_REQUEST['dsd2'];
			$dstitulo=$_REQUEST['dstitulo'];
			$dskw=$_REQUEST['dskw'];
			$dskwin=$_REQUEST['dskwin'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dstit=$_REQUEST['dstit'];
			$paso=$_REQUEST['paso'];
			$idtienda=$_REQUEST['idtienda'];
			$dsvideo=$_REQUEST['dsvideo'];
			$dstabla=$_REQUEST['dstabla'];
			$rutadetalle=$_REQUEST['rutadetalle'];
			$bgcolor=$_REQUEST['bgcolor'];

			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					//$sql.=",dsd='$dsd'";
					$sql.=",dsd2='$dsd2'";
					//$sql.=",dstit='$dstit'";
					$sql.=",dstitulo='$dstitulo'";
					//$sql.=",dskw='$dskw'";
					$sql.=",dsimg1='$nombre1'";
					$sql.=",dsvideo='$dsvideo'";
					$sql.=",idtienda='$idtienda'";
					$sql.=",dsimg1='".$imgvec[0]."'";
					if ($_SESSION['i_idperfil']== "-1"){
					$sql.=",bg_color='$bgcolor'";
					$sql.=",bg_img='".$imgvec[1]."'";
					}	
					$sql.=",rutadetalle='$rutadetalle'";
					$sql.=",dstabla='$dstabla'";
					$sql.=" where id=".$idx;
//				echo $sql;
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
$sql="select a.dsm,a.idpos,a.idactivo,a.dstit,a.dsd,a.dsimg1,a.dsd2,a.dskw";
$sql.=",a.dsvideo,a.dstitulo,a.idtienda,a.rutadetalle,a.dstabla,a.bg_color,a.bg_img ";
$sql.=" from $tabla a where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="/ <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dstit=$result->fields[3];
$dsd=$result->fields[4];
$dsimg1=$result->fields[5];
$dsd2=$result->fields[6];
$dskw=$result->fields[7];
$dsvideo=$result->fields[8];
$dstitulo=$result->fields[9];
$idtienda=$result->fields[10];
$rutadetalle=$result->fields[11];
$dstabla=$result->fields[12];
$bgcolor=$result->fields[13];
$dsimg2=$result->fields[14];
?>
<br>

	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>

</td></tr>


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
<td>Titulo</td>
<td>
<? $contadorx="dstitulo_counter";$valorx="255";$formax="u";$campox="dstitulo";?>
<input type=text name=dstitulo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstitulo')" value="<? echo $dstitulo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstitulo";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n Pagina</td>
<td>
<? $contadorx="dsd2_counter";$valorx="20000";$campox="dsd2";?>
<textarea name=dsd2 cols=70  rows="10" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n larga";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Codigo de Video para ver en la pagina</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="20000";$campox="dsvideo";?>
<textarea name=dsvideo cols=70  rows="10" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar el video";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen Pagina</td>
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
</tr>
<? if ($_SESSION['i_idperfil']=="-1") { ?>
<tr valign=top bgcolor="#FFFFFF">
<td>Imagen Fondo</td>
<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimg2?>">
<? if (is_file($rutaImagen.$dsimg2)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg2;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar2" value="1"> Borrar Esta imagen
<input type="hidden" name="img2" value="<? echo $dsimg2?>">

<? } ?>

</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Color De la Pagina</td>
<td>
<? $contadorx="bgcolor_counter";$valorx="255";$formax="u";$campox="bgcolor";?>
<input type=color name=bgcolor size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_bgcolor')" value="<? echo $bgcolor?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_bgcolor";
$mensaje_capa="Debe ingresar el titulo";
//include($rutxx."../../incluidos_modulos/control.capa.php");
//include($rutxx."../../incluidos_modulos/control.letras.php");?>
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

</td>
</tr>
<? } ?>

<tr valign=top bgcolor="#FFFFFF">
<td>Tabla asociada</td>
<td>
<? $contadorx="dstabla_counter";$valorx="255";$formax="u";$campox="dstabla";?>
<input type=text name=dstabla size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstabla')" value="<? echo $dstabla?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstabla";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ruta pagina </td>
<td>
<? $contadorx="rutadetalle_counter";$valorx="255";$formax="u";$campox="rutadetalle";?>
<input type=text name=rutadetalle size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_rutadetalle')" value="<? echo $rutadetalle?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_rutadetalle";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
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


