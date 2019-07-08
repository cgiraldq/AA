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

$titulomodulo="listado de p&aacute;ginas para vista móvil";
$rr="vista.paginas.php";
$idx=$_REQUEST['idx'];
$tabla=$prefix."tblpaginas";
$rutaImagen=$rutxx."../../../contenidos/images/paginas/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/paginas/";
$rutaPlayer="../"; // uso desde el admon


			if ($_FILES['dsimg1']['name']<>"") {
			// borrar anterior
			$archivoanterior=$_REQUEST['archivoanterior1'];
			if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
			$temp_name = $_FILES['dsimg1']['tmp_name'];
			$nombre1=$tabla.$idx."-".date("his")."-1.".substr($_FILES['dsimg1']['name'],-3);	move_uploaded_file($temp_name,$rutaImagen.$nombre1);
			} elseif ($_REQUEST['img1']<>"") {
			$nombre1=$_REQUEST['archivoanterior1'];
			}

			if ($_REQUEST['borrar1']==1) $nombre1="";

			if ($_FILES['dsimg2']['name']<>"") {
			// borrar anterior
			$archivoanterior=$_REQUEST['archivoanterior2'];
			if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
			$temp_name = $_FILES['dsimg2']['tmp_name'];
			$nombre2=$tabla.$idx."-2.".substr($_FILES['dsimg2']['name'],-3);

			move_uploaded_file($temp_name,$rutaImagen.$nombre2);
			}elseif ($_REQUEST['img2']<>"") {
			$nombre2=$_REQUEST['archivoanterior2'];
			}
			if ($_REQUEST['borrar2']==1) $nombre2="";




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


			if ($paso=="1") {
					$sql=" update $tabla set ";
					//$sql.=" dsm='$dsm'";
					//$sql.=",dsd='$dsd'";
					$sql.="dsd2='$dsd2'";
					//$sql.=",dstit='$dstit'";
					$sql.=",dstitulo='$dstitulo'";
					//$sql.=",dskw='$dskw'";
					$sql.=",dsimg1='$nombre1'";
					$sql.=",dsvideo='$dsvideo'";
					//$sql.=",idtienda='$idtienda'";
					$sql.=",idactivo='$idactivo'";
					//$sql.=",rutadetalle='$rutadetalle'";
					//$sql.=",dstabla='$dstabla'";
					$sql.=" where id=".$idx;
//				echo $sql;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  pagina del sitio";
						$dsruta="../cms/paginas/default.php";
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
$sql="select a.dsm,a.idpos,a.idactivo,a.dstit,a.dsd,a.dsimg1,a.dsd2,a.dskw,a.dstitulo,dstitulovista,dsdvista ";
$sql.=" from $tabla a where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' target='_top' class='textlink'>Principal</a>  / <a href='vista.paginas.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dstit=$result->fields[3];
$dsd=$result->fields[4];
$dsimg1=$result->fields[5];
$dsd2=$result->fields[6];
$dskw=$result->fields[7];
$dstitulo=$result->fields[8];
$dstitulovista=$result->fields[9];
$dsdvista=$result->fields[10];



?>
<br>

	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dstitulo";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>

</td></tr>


<!--tr valign=top bgcolor="#FFFFFF">
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
</tr-->

<tr valign=top bgcolor="#FFFFFF">
<td>T&iacute;tulo</td>
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

<!--tr valign=top bgcolor="#FFFFFF">
<td>T&iacute;tulo vista m&oacute;vil.</td>
<td>
<? $contadorx="dstitulovista_counter";$valorx="255";$formax="u";$campox="dstitulovista";?>
<input type=text name=dstitulovista size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstitulovista')" value="<? echo $dstitulovista?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstitulovista";
$mensaje_capa="Debe ingresar el titulo vista m&oacute;vil";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr-->

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n P&aacute;gina vista m&oacute;vil</td>
<td>
<? $contadorx="dsd2_counter";$valorx="2000";$campox="dsd2";?>
<textarea name=dsd2 cols=70  rows="10" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n larga";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n P&aacute;gina vista m&oacute;vil.</td>
<td>
<? $contadorx="dsdvista_counter";$valorx="2000";$campox="dsdvista";?>
<textarea name=dsdvista cols=70  rows="10" class=text1 onKeyPress="ocultar('capa_dsdvista')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsdvista?></textarea>
<?
$nombre_capa="capa_dsdvista";
$mensaje_capa="Debe ingresar la descripci&oacute;n larga";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr-->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Codigo de Video para ver en la pagina</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="2000";$campox="dsvideo";?>
<textarea name=dsvideo cols=70  rows="10" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar el video";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr-->


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen P&aacute;gina</td>
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



<tr>
	<td align="center" colspan="2">
		<?
			$forma="u";
			$param="dstitulo";
			include($rutxx."../../incluidos_modulos/botones.modificar.php");
		?>
		<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>

</form>

</table>


</td>
</tr>
</table>
<a name="video"></a>
<? //include("../reproductores/default.php");
} // fin si
$result->Close();
?>
<br>
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>


