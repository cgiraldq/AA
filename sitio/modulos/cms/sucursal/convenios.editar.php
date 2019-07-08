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

$titulomodulo="Configuracion de sucursales";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblconvenios";
$rutaImagen=$rutxx."../../../contenidos/images/qsomos/";
// rutas repro
//$rutaRepro=$rutaAbs."/contenidos/images/qsomos/";
//$rutaPlayer="../"; // uso desde el admon
//$carpeta="qsomos";
//echo $carpetaBase;
//$include="include('../../beta/qsomos.php')";


			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$dsm=$_REQUEST['dsm'];
			$dstitulo=$_REQUEST['dstitulo'];
			$ruta=limpieza(strtolower($dsm));
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dsvideo=$_REQUEST['dsvideo'];


			$paso=$_REQUEST['paso'];
			if ($paso=="1") {

					/*$dsarchivo=limpieza(strtolower($dsm)).".php";
					$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$dsm,$idx,$include);*/

					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=" ,dstitulo='$dstitulo'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg='".$imgvec[0]."'";
						$sql.=",dsvideo='$dsvideo'";
					$sql.=",dsruta='$ruta'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/convenios/default.php";
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
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,dsvideo,dstitulo";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsimg=$result->fields[2];
$idpos=$result->fields[3];
$dsruta=$result->fields[4];
$idactivo=$result->fields[5];
$dsvideo=$result->fields[6];
$dstitulo=$result->fields[7];

//if($dstitulo=="") $dstitulo=$dsm;
?>
<br>
	<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


	<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">

<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,dstitulo,dsd,idpos";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Titulo</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=85 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Titulo en el men&uacute;</td>
<td>
<? $contadorx="dstitulo_counter";$valorx="255";$formax="u";$campox="dstitulo";?>
<input type=text name=dstitulo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstitulo')"
value="<? echo $dstitulo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstitulo";
$mensaje_capa="Debe ingresar el titulo del menu";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n</td>
<td>
<? $contadorx="dsd_counter";$valorx="12000";$campox="dsd";?>
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

<tr valign=top bgcolor="#FFFFFF">
<td>Codigo video Youtube</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="12000";$campox="dsvideo";?>
<textarea name=dsvideo cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo;?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="return numero(event);ocultar('capa_idpos')" value="<? echo $idpos?>">
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
		   <!--option value="3" <? if ($idactivo==3) echo "selected";?>>MEN&Uacute; HORIZONTAL</option>
		   <option value="4" <? if ($idactivo==4) echo "selected";?>>MEN&uacute; VERTICAL</option-->
	</select>

</td>
</tr>
<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,dstitulo,dsd,idpos";
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
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
