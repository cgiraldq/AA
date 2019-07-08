<?
/*
| ----------------------------------------------------------------- |
CF-informer
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c) 2000 - 2013
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


$titulomodulo="Configuraci&oacute;n de banners";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblbanners";

$tablarelaciones="tblbannersxtblpaginas";
$tablaorigen="tblpaginas";

$tablarelaciones2="tblbannersxtblempresa";
$tablaorigen2="tblempresa";

$tablarelacionesx="tblbannerxcategorias";



$rutaImagen=$rutxx."../../../contenidos/images/banners/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/banners/";
$rutaPlayer="../"; // uso desde el admon

			 $nombre="dsimg1";
             $nombreant="archivoanterior1";
             $borrar=$_REQUEST['borrar1'];
             $valimg=$_REQUEST['img1'];
             include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");


			$dsm=$_REQUEST['dsm'];
			$dsruta=$_REQUEST['dsruta'];
			$dsflash=$_REQUEST['dsflash'];
			$dsancho=$_REQUEST['dsancho'];
			$dsalto=$_REQUEST['dsalto'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idtipo=$_REQUEST['idtipo'];
			$dsmodo=$_REQUEST['dsmodo'];
			$dsd=$_REQUEST['dsd'];
			$paso=$_REQUEST['paso'];
			$dsfechai=$_REQUEST['dsfechai'];
			if ($dsfechai<>"") $idfechai=str_replace("/","",$dsfechai);
			$dsfechaf=$_REQUEST['dsfechaf'];
			if ($dsfechaf<>"") $idfechaf=str_replace("/","",$dsfechaf);

			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsruta='$dsruta'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsancho='$dsancho'";
					$sql.=",dsalto='$dsalto'";
					$sql.=",idtipo=$idtipo";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsflash='$dsflash'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=",dsfechai='$dsfechai'";
					$sql.=",idfechai='$idfechai'";

					$sql.=",dsfechaf='$dsfechaf'";
					$sql.=",idfechaf='$idfechaf'";


					$sql.=",dsmodo='$dsmodo'";

					$sql.=" where id=".$idx;

					 //echo $sql;
					 //exit();

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de banner";
						$dsruta="../cms/banners/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						// relaciones
						include($rutxx."../relaciones/relaciones.operaciones.php");
						//
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");
						include($rutxx."../relaciones/relaciones.operaciones.ecommerce.categorias.php");
						//$error=0;
					}	else {
						$mensajes=$men[7];
						$error=1;

					}
			}



?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?

// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsimg,a.dsruta,a.dsalto,a.dsancho,a.dsflash,a.idtipo,a.dsmodo,a.dsd";
$sql.=",a.dsfechai,a.dsfechaf ";

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
$idtipo=$result->fields[8];
$dsmodo=$result->fields[9];
$dsd=$result->fields[10];
$dsfechai=$result->fields[11];
$dsfechaf=$result->fields[12];

?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="idpos";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>

<tr valign=top>
	<td class="txt"><p>Nombre</p></td>

	<td>
		<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";$cantidad=strlen($dsm)?>
		<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
		<?
		$nombre_capa="capa_dsm";
		$mensaje_capa="Debe ingresar el titulo";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");?>

	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Fecha Inicial</p></td>

	<td>
	<? $contadorx="dsfechai_counter";$valorx="10";$formax="u";$campox="dsfechai";$cantidad=strlen($dsfechai)?>
	<input type=text name=dsfechai size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechai')" readonly  value="<? echo $dsfechai?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
	<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechai', this);" language="javaScript">
	<?
	$nombre_capa="capa_dsfechai";
	$mensaje_capa="Debe ingresar la fecha inicial";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Fecha Final</p></td>

	<td>
	<? $contadorx="dsfechaf_counter";$valorx="10";$formax="u";$campox="dsfechaf";$cantidad=strlen($dsfechaf)?>
	<input type=text name=dsfechaf size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechaf')" readonly  value="<? echo $dsfechaf?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
	<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechaf', this);" language="javaScript">
	<?
	$nombre_capa="capa_dsfechaf";
	$mensaje_capa="Debe ingresar la fecha final";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Tipo?</p></td>
	<td>
		<select name=idtipo class=text1>
			  <option value="1" <? if ($idtipo==1) echo "selected";?>>Imagen</option>
			  <option value="2" <? if ($idtipo==2) echo "selected";?>>Animacion Flash</option>
			  <option value="3" <? if ($idtipo==3) echo "selected";?>>Video FLV</option>
			  <option value="4" <? if ($idtipo==4) echo "selected";?>>Silverlight</option>
		</select>
	</td>
</tr>


<tr valign=top >
	<td class="txt">
		<p>Si el tipo de banner es imagen, digite la ruta a la cual se envia cuando se da click.</p>

		<p><strong>(Ejemplo http://www.midominio.com/)</strong></p>
	</td>

	<td>
	<? $contadorx="dsruta_counter";$valorx="255";$campox="dsruta";$cantidad=strlen($dsruta)?>
	<textarea name=dsruta cols=80  rows="3" class=text1 onKeyPress="ocultar('capa_dsruta')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsruta?></textarea>
	<?
	$nombre_capa="capa_dsruta";
	$mensaje_capa="Debe ingresar la ruta";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>

<tr valign=top >
	<td class="txt"><p>Al dar click sobre el banner montado, se abre (Aplica solo para tipo imagen): </p></td>
	<td>
		<select name=dsmodo class=text1>
			  <option value="_self" <? if ($dsmodo=="_self") echo "selected";?>>Misma ventana</option>
			  <option value="_blank" <? if ($dsmodo=="_blank") echo "selected";?>>Nueva ventana</option>
		</select>
	</td>
</tr>


<tr valign=top >
	<td class="txt"><p>Archivo</p></td>

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
	</td>
</tr>

<!--<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Video Youtube</p></td>
	<td>
	<? $contadorx="dsd_counter";$valorx="255";$campox="dsd";?>
	<textarea name=dsd  cols=80  rows="3" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
	<?
	$nombre_capa="capa_dsd";
	$mensaje_capa="Debe ingresar el video youtube";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	include($rutxx."../../incluidos_modulos/control.letras.php");?>
	</td>
</tr>-->

<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Ancho del archivo si es tipo Flash</p></td>

	<td>
		<input type=text name=dsancho size=1 maxlength="8" class=text1 value="<? echo $dsancho?>">
	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Alto del archivo si es tipo Flash</p></td>

	<td><input type=text name=dsalto size=1 maxlength="8" class=text1 value="<? echo $dsalto?>">

	</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
	<td class="txt"><p>Posici&oacute;n</p></td>

	<td>
		<input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos?>">
	<?
	$nombre_capa="capa_idpos";
	$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
	include($rutxx."../../incluidos_modulos/control.capa.php");
	?>
	</td>
</tr>

<tr valign=top >
	<td class="txt"><p>Activar?</p></td>

	<td>
		<select name=idactivo class=text1>
		    <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		    <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		    <option value="3" <? if ($idactivo==3) echo "selected";?>>LATERAL TOP</option>
		    <!--option value="4" <? if ($idactivo==4) echo "selected";?>>LATERAL MEDIA</option-->
		    <option value="5" <? if ($idactivo==5) echo "selected";?>>BANNER INFERIOR</option>
		    <option value="6" <? if ($idactivo==6) echo "selected";?>>DEBAJO DEL MEN&Uacute;</option>
		     <option value="7" <? if ($idactivo==7) echo "selected";?>>PAGINAS INTERNAS</option>
		</select>
	</td>
</tr>

<tr valign=top >
	<td colspan="2">
		<p style="text-align: left;"><strong>RELACIONES.</strong> Asocie en que pagina desea ver este item</p>
	<br>
	<? include($rutxx."../relaciones/default.php");?>
	</td>
</tr>

		<tr valign=top bgcolor="#FFFFFF">
			<td colspan="2">
			<strong>RELACIONES.</strong> Asocie en que categoria desea ver este item
			<br>
			<?
			//$db->debug=true;

			$datasqladd=" and idactivo not in (2,9)";
			$tablaorigen="ecommerce_tblcategoria";
			include($rutxx."../relaciones/default.ecommerce.categoria.php");?>
			</td>
		</tr>

<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="idpos";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
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

	<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");
	?>

</body>
</html>