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

$titulomodulo="Configuraci&oacute;n de subcategoria de contenido";
$idx=$_REQUEST['idx'];
$idpo=$_REQUEST['idpo'];
$rr="default.php?idpo=$idpo";



$tabla="tblcategoriacontenido";
$carpeta="categoriacontenido";
$rutaImagen=$rutxx."../../../contenidos/images/categoriacontenido/";

$tablarelaciones2="tblempresaxtblcategoria";
$tablaorigen2="tblempresa";



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
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idcat=$_REQUEST['idcat'];
			$dsvideo=$_REQUEST['dsvideo'];
		    $dsdp=$_REQUEST['dsdp'];
		    $dsenlace=$_REQUEST['dsenlace'];



			$paso=$_REQUEST['paso'];
			if ($paso=="1") {

					/*$dsarchivo=limpieza(strtolower($dsm)).".php";
					$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$dsm,$idx,$include);*/
					$dsruta=limpieza(strtolower($dsm));
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg1='".$imgvec[0]."'";
					$sql.=",dsimg2='".$imgvec[1]."'";
					$sql.=" ,dsruta='".$dsruta."'";
					$sql.=",idpos=$idpos";
					$sql.=",dsenlace='$dsenlace'";
					$sql.=",idactivo='$idactivo'";
					$sql.=",idcat='$idpo'";
					$sql.=",dsvideo='$dsvideo'";
					$sql.=",dsdp='$dsdp'";

					$sql.=" where id=".$idx;

			//echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						$error=0;
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/categoriacontenidos/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
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

<? include($rutxx."../../incluidos_modulos/navegador.principal.php");
	// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.idpos,a.idactivo,a.dsimg1,a.idcat,dsvideo,dsdp,dsenlace,dsimg2";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";

$rutamodulo.="  <a href='default.php?idtipo=$idtipo' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$idpos=$result->fields[2];
$idactivo=$result->fields[3];
$dsimg1=$result->fields[4];
$cat=$result->fields[5];
$dsvideo=$result->fields[6];
$dsdp=$result->fields[7];
$dsenlace=$result->fields[8];
$dsimg2=$result->fields[9];

?>
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
<td>Titulo</td>
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
<td>Ruta Enlace</td>
<td>
<? $contadorx="dsenlace_counter";$valorx="255";$formax="u";$campox="dsenlace";?>
<input type=text name=dsenlace size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsenlace')" value="<? echo $dsenlace?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsenlace";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n corta</td>
<td>
<? $contadorx="dsd_counter";$valorx="3500";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n larga</td>
<td>
<? $contadorx="dsdp_counter";$valorx="3500";$campox="dsdp";?>
<textarea name=dsdp cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsdp')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsdp?></textarea>
<?
$nombre_capa="capa_dsdp";
$mensaje_capa="Debe ingresar los beneficios";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Codigo youtube para video</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="3500";$campox="dsd";?>
<textarea name=dsvideo cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsvideo')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar codigo del video";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Imagen pequeña</td>
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
<td>Imagen detalle</td>
<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
<?
$nombre_capa="capa_dsimg2";
$mensaje_capa="Debe cargar la imagen 1";
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
	</select>

</td>
</tr>







<!--tr valign=top bgcolor="#FFFFFF">
<td>Servicio asociado?</td>
<td>
  <select name=idcat class=text1>
 <option value="0"> -- Seleccionar --</option>
     <? $cat=$result->fields[5];?>
      		<?$sql="select a.id,a.dsm from tblservicios a where idactivo=1 order by dsm asc ";

			$resultx = $db->Execute($sql);
			if (!$resultx->EOF) {
		 //echo "<option value='0'>--</option>";
			while (!$resultx->EOF) {
			$idm=$resultx->fields[0];
			$dsm=$resultx->fields[1];
			echo "<option value='".$idm."'"; if ($idm==$cat) echo "selected"; echo ">".$dsm."</option>";
			$resultx->MoveNext();
				} // fin while
			 }
			 $resultx->Close();?>
    </select>

</td>


</tr-->




<!--tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES CON TIENDAS.</strong> Asocie en que tienda desea ver este item
<br>
<?
$datasqladd=" and id>1 ";
include("../relaciones/default.empresa.php");?>
</td>
</tr -->


<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idpo" value="<? echo $idpo?>">
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
