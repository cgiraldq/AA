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
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="<a href='modulos.php' class='textlink'>Configuraci&oacute;n de m&oacute;dulos</a>  / Modificaci&oacute;n ";
$rr="modulos.php";
$idx=$_REQUEST['idx'];
$tabla=$prefix."tblmodulos";
$rutaImagen="../../../../contenidos/images/iconos/";

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
				$archivoanterior=$_REQUEST['archivoanterior2'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg2']['tmp_name'];
				$nombre2=$tabla.$idx."-2.".substr($_FILES['dsimg2']['name'],-3);

move_uploaded_file($temp_name,$rutaImagen.$nombre2);
			}elseif ($_REQUEST['img2']<>"") {
$nombre2=$_REQUEST['img2'];
}
			if ($_REQUEST['borrar2']==1) $nombre2="";
			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsr=$_REQUEST['dsr'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dstabla=$_REQUEST['dstabla'];

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsr='$dsr'";
					$sql.=",dsimg1='$nombre1'";
					$sql.=",dsimg2='$nombre2'";
					$sql.=",dstabla='$dstabla'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";

					$sql.=" where id=".$idx;
					if ($db->Execute($sql)) $mensajes=$men[6];
			}



?>
<html>
<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.idpos,a.idactivo,a.dsr,a.dsd,a.dsimg1,a.dsimg2,a.dstabla from $tabla a ";
$sql.=" where a.id=$idx ";


$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
echo "<br>";
$rutamodulo="<a href='$rutxx../root/default.php' class='textlink'>Principal</a>  /  <span class='text1'>".$titulomodulo."</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsr=$result->fields[3];
$dsd=$result->fields[4];
$dsimg1=$result->fields[5];
$dsimg2=$result->fields[6];
$dstabla=$result->fields[7];
?>
<br>

<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>



</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n</td>
<td>
<? $contadorx="dsd_counter";$valorx="255";$campox="dsd";?>
<textarea name=dsd cols=50  rows="5" class=text1 onKeyPress="ocultar('capa_dsd')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ruta</td>
<td>
<? $contadorx="dsr_counter";$valorx="50";$campox="dsr";?>
<input type=text name=dsr size=45 maxlength="50" class=text1 onKeyPress="ocultar('capa_dsr')" value="<? echo $dsr?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsr";
$mensaje_capa="Debe ingresar la ruta";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 1</td>
<td bgcolor="#f3f3f3"><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
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
<td>Imagen 2</td>
<td bgcolor="#f3f3f3"><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen 2";
include($rutxx."../../incluidos_modulos/control.capa.php");
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
<td>Tabla</td>
<td>
<? $contadorx="dstabla_counter";$valorx="45";$campox="dstabla";?>
<input type=text name=dstabla size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstabla')" value="<? echo $dstabla?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstabla";
$mensaje_capa="Digitela tabla asociada a este modulo";
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
		<option value="3" <? if ($idactivo==3) echo "selected";?>>SUBMODULO</option>

	</select>

</td>
</tr>
<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,dsd,dsr,dstabla,idpos";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>

<?

} // fin si
$result->Close();
?>
<br>
<?include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>