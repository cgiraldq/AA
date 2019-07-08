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


$titulomodulo="Configuracion de ciudades";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblciudades";

$tablarelaciones="tblbannersxtblpaginas";
$tablaorigen="tblpaginas";

$tablarelaciones2="tblbannersxtblempresa";
$tablaorigen2="tblempresa";



$rutaImagen=$rutxx."../../../contenidos/images/banners/";
// rutas repro
$rutaRepro=$rutaAbs."/contenidos/images/banners/";
$rutaPlayer="../"; // uso desde el admon

			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
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
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					 //echo $sql;
					 //exit();
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro de banner";
						$dsruta="../cms/ciudades/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						// relaciones
						include($rutxx."../relaciones/relaciones.operaciones.php");
						//
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");
						$error=0;
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
$sql="select a.id,a.dsm,a.idactivo,a.idpos,a.dsimg,a.dsd";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$id=$result->fields[0];
$dsm=$result->fields[1];
$idactivo=$result->fields[2];
$idpos=$result->fields[3];
$dsimg=$result->fields[4];
$dsd=$result->fields[5];


?>
<br>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


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
<td>Descripci&oacute;n</td>
<td>
<? $contadorx="dsd_counter";$valorx="250";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
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

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen <br><br/></td>
<td><input type=file name=dsimg class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg')">
<?
$nombre_capa="capa_dsimg";
$mensaje_capa="Debe cargar la imagen ";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior" value="<? echo $dsimg?>">
<? if (is_file($rutaImagen.$dsimg)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar" value="1"> Borrar Esta imagen
<input type="hidden" name="img" value="<? echo $dsimg?>">

<? } ?>

</td>
</tr>

<tr valign=top >
	<td class="txt"><p>Activar?</p></td>

	<td>
		<select name=idactivo class=text1>
		    <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		    <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		    <option value="3" <? if ($idactivo==3) echo "selected";?>>LATERAL TOP</option>
		    <!--option value="4" <? if ($idactivo==4) echo "selected";?>>LATERAL MEDIA</option>
		    <option value="5" <? if ($idactivo==5) echo "selected";?>>LATERAL INFERIOR</option-->
		    <option value="6" <? if ($idactivo==6) echo "selected";?>>DEBAJO DEL MEN&Uacute;</option>
		</select>
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