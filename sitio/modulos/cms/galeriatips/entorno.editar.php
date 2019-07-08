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
$titulomodulo="Configuracion Carrousel de imagenes";
$idevento=$_REQUEST['idevento'];
$rr="default.php?idevento=".$idevento;
$idx=$_REQUEST['idx'];
$tabla="tblgaleriatips";
$rutaImagen=$rutxx."../../../contenidos/images/galeria/";
// rutas repro
//$rutaRepro=$rutaAbs."/contenidos/images/qsomos/";
//$rutaPlayer="../"; // uso desde el admon
//$carpeta="qsomos";
-//echo $carpetaBase;
//$include="include('../../beta/qsomos.php')";


			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre1="dsimg2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['borrar2'];
			$valimg=$_REQUEST['img2'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen2.php");

			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];


			$paso=$_REQUEST['paso'];
			$idevento=$_REQUEST['idevento'];

			if ($paso=="1") {

					/*$dsarchivo=limpieza(strtolower($dsm)).".php";
					$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$dsm,$idx,$include);*/

					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsimg2='".$imgvec2[0]."'";
					$sql.=",dsruta='$dsrutaPagina'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=",idevento=$idevento";
					$sql.=" where id=".$idx;
					//echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$error=0;
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/galeria/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						// relaciones
						include($rutxx."../relaciones/relaciones.operaciones.php");

					}	else {
						$mensajes=$men[7];
						$error=1;
					}
			}



?>
<?include($rutxx."../../incluidos_modulos/head.php");?>

<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,dsimg2,idevento";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsimg=$result->fields[2];
$idpos=$result->fields[3];
$dsruta=$result->fields[4];
$idactivo=$result->fields[5];
$dsimg2=$result->fields[6];
$idevento=$result->fields[7];
?>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>

<section class="cont_general">

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=80% class="campos_detalle">

<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr>
	<td align="center" colspan="2">
	<?
	$forma="u";
	$param="idpos";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td><p>T&iacute;tulo</p></td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<div><input type=text name=dsm  maxlength="255"  onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
</div><?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Descripci&oacute;n</p></td>
<td>
<? $contadorx="dsd_counter";$valorx="3500";$campox="dsd";?>
<div><textarea name=dsd rows="8"  onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
</div><?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Im&aacute;gen</td>
<td><input type=file name=dsimg  onKeyPress="ocultar('capa_dsimg')" onClick="ocultar('capa_dsimg')">
<?
$nombre_capa="capa_dsimg";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior" value="<? echo $dsimg?>">
<? if (is_file($rutaImagen.$dsimg)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar" value="1"> Borrar esta im&aacute;gen
<input type="hidden" name="img" value="<? echo $dsimg?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td><p>Im&aacute;gen grande</td>
<td><input type=file name=dsimg2  onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior2" value="<? echo $dsimg2;?>">
<? if (is_file($rutaImagen.$dsimg2)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg2;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar2" value="1"> Borrar Esta imagen
<input type="hidden" name="img2" value="<? echo $dsimg2?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td><p>Posici&oacute;n</p></td>
<td><input type=text name=idpos size=1 maxlength="8"  onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
include($rutxx."../../incluidos_modulos/control.capa.php");

?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td><p>Activar?</p></td>
<td>
	<select name=idactivo >
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <?if($_REQUEST['idevento']=="eso"){?><option value="4">SI</option><?}?>

	</select>

</td>
</tr>
<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,idpos";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idevento" value="<? echo $idevento?>">

</td></tr>
</form>

</table>

<?
} // fin si
$result->Close();
?>
</section>
<?include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
