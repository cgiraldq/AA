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

$titulomodulo="Configuracion de destacados";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tbldestacados";


$tablarelaciones2="tbldestacadosxtblempresa";
$tablaorigen2="tblempresa";


//$tablarelaciones="tbldestacadosxtblpaginas";
//$tablaorigen="tblpaginas";

$rutaImagen=$rutxx."../../../contenidos/images/destacadoindex/";
/* rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/destacado/";
$rutaPlayer="../"; // uso desde el admon*/

			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


			$dsm=$_REQUEST['dsm'];
			$dsruta=$_REQUEST['dsruta'];
			$dsrutac=$_REQUEST['dsrutac'];

			$dsflash=$_REQUEST['dsflash'];
			$dsancho=$_REQUEST['dsancho'];
			$dsalto=$_REQUEST['dsalto'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dsmodo=$_REQUEST['dsmodo'];
			$dsfondo=$_REQUEST['dsfondo'];
			$dsd=$_REQUEST['dsd'];
			$dssubtitulo=$_REQUEST['dssubtitulo'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dssubtitulo='$dssubtitulo'";
					$sql.=",dsruta='$dsruta'";
					$sql.=",dsrutac='$dsrutac'";

					$sql.=",dsancho='$dsancho'";
					$sql.=",dsalto='$dsalto'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsflash='$dsflash'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=",dsmodo='$dsmodo'";
					$sql.=",dsfondo='$dsfondo'";
					$sql.=" where id=".$idx;

					//echo $sql;
					//exit();

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						$error=0;
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de destacado index";
						$dsruta="../cms/destacadoindex/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
									//
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");

					}	else {
						$mensajes=$men[7];
						$error=1;
					}
			}



?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>

<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsimg,a.dsruta,a.dsalto,a.dsancho,a.dsflash,a.dsmodo,a.dsd,a.dsfondo,a.dsrutac,a.dssubtitulo";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsimg1=$result->fields[3];
$dsruta=$result->fields[4];
$dsalto=$result->fields[5];
$dsancho=$result->fields[6];
$dsflash=$result->fields[7];
$dsmodo=$result->fields[8];
$dsd=$result->fields[9];
$dsfondo=$result->fields[10];
$dsrutac=$result->fields[11];
$dssubtitulo=$result->fields[12];

?>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="idpos";
	$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Sub-Titulo</td>
<td>
<? $contadorx="dssubtitulo_counter";$valorx="255";$formax="u";$campox="dssubtitulo";?>
<input type=text name=dssubtitulo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dssubtitulo')" value="<? echo $dssubtitulo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dssubtitulo";
$mensaje_capa="Debe ingresar el Sub-Titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ruta (Para el ver mas)</td>
<td>
<? $contadorx="dsruta_counter";$valorx="255";$campox="dsruta";?>
<textarea name=dsruta cols=80  rows="3" class=text1 onKeyPress="ocultar('capa_dsruta')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsruta?></textarea>
<?
$nombre_capa="capa_dsruta";
$mensaje_capa="Debe ingresar la ruta";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n</td>
<td>
<? $contadorx="dsd_counter";$valorx="600";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar una descripcion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<!--tr valign=top bgcolor="#FFFFFF">
<td>Como quiere que abra la ventana de la ruta </td>
<td>
	<select name=dsmodo class=text1>
		  <option value="_self" <? if ($dsmodo=="_self") echo "selected";?>>Misma ventana</option>
		  <option value="_blank" <? if ($dsmodo=="_blank") echo "selected";?>>Nueva ventana</option>
	</select>

</td>
</tr-->




<tr valign=top bgcolor="#FFFFFF">
<td>Imagen</td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior1" value="<? echo $dsimg1?>">
<? if (is_file($rutaImagen.$dsimg1)) {
	$nombre_capa_video="capa_repr_video_1"; //abre la capa con el dato
	if (substr($dsimg1,-3)=="swf" || substr($dsimg1,-3)=="SWF"){
		$archivo=$dsimg1;
		$ruta=$rutaImagen;
		include("../reproductores/flasher.php");
	} elseif(substr($dsimg1,-3)=="flv" || substr($dsimg1,-3)=="FLV" ){
		?>
		&nbsp;<a href="#video" title="Click para ejecutar" onClick="document.getElementById('<? echo $nombre_capa_video;?>').style.display=''">Ejecutar Video</a>
		<?
	} else {
	?>
	&nbsp;<img src="<? echo $rutaImagen.$dsimg1;?>" align="absmiddle" border="0">
	<?
	}
?>

<br>
<input type="checkbox" name="borrar1" value="1"> Borrar Esta imagen
<input type="hidden" name="img1" value="<? echo $dsimg1?>">
<? } ?>
<br/>
<br/>
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
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>Solo Imagen</option>

	</select>

</td>
</tr>






<tr><td align="center" colspan="2">
<?
$forma="u";
$param="idpos";
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
<? //include("../reproductores/default.php");
} // fin si
$result->Close();
?>

	<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>