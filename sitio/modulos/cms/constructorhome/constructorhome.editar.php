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
$injection="no";
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuracion de Home";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblconstructorhome";
$rutaImagen="../../../../contenidos/images/entorno_sitio/";

			$nombre="dsimg";
			$nombreant="archivoanterior";
			$borrar=$_REQUEST['borrar'];
			$valimg=$_REQUEST['img'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

			$nombre="dsimg2";
			$nombreant="archivoanterior2";
			$borrar=$_REQUEST['borrar2'];
			$valimg=$_REQUEST['img2'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");

					
			$dsm=$_REQUEST['dsm'];
			$dsd=$_REQUEST['dsd'];
			$dsd=str_replace("../",$dirredesx,$dsd); // cambio de datos

			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$dsruta=$_REQUEST['dsruta'];
			$dsvideo=$_REQUEST['dsvideo'];
			
			$paso=$_REQUEST['paso'];
			if ($paso=="1") { 
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsvideo='$dsvideo'";
					$sql.=",dsimg='".$imgvec[0]."'";
					$sql.=",dsimg2='".$imgvec[1]."'";

					$sql.=",dsruta='".$dsruta."'";				


					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					
					if ($db->Execute($sql))  { 
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../constructorhome/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");	
					}	else { 
						$mensajes=$men[7];
					}
			}
			
			

?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >
<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.dsimg,a.idpos,a.dsruta,a.idactivo,a.dsimg2,dsvideo";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

$dsm=$result->fields[0];
$dsd=$result->fields[1];
$dsimg=$result->fields[2];
$idpos=$result->fields[3];
$dsruta=$result->fields[4];
$idactivo=$result->fields[5];
$dsimg2=$result->fields[6];
$dsvideo=$result->fields[7];

?>
<br>

<table width="100%" cellpadding="0" cellspacing="0" align="center"  class="cont_general">
  <tr>
    <td align="center" valign="top" style=" padding: 30px 0 0 0;">


<table width="70%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td width="615" align="left" valign="middle">
        		<img src="../../../img_modulos/modulos/edicion.png">
         		<h1>Edicion del registro seleccionado</h1>
         	</td>
        </tr>
</table>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="dsm";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
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

<? if ($idactivo<>4) {?>


		<? if ($idactivo<>2 && $idactivo<>3) {?>


		<tr valign=top bgcolor="#FFFFFF">
		<td>Imagen</td>
		<td><input type=file name=dsimg class=text1 onKeyPress="ocultar('capa_dsimg')" onClick="ocultar('capa_dsimg')">
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
		<? } ?>
		<? if ($idactivo<>2 && $idactivo<>1) {?>

		<tr valign=top bgcolor="#FFFFFF">
		<td>Imagen 2</td>
		<td><input type=file name=dsimg2 class=text1 onKeyPress="ocultar('capa_dsimg2')" onClick="ocultar('capa_dsimg2')">
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
		<td>Descripcion</td>
		<td>
		<? $contadorx="dsd_counter";$valorx="7500";$campox="dsd";?>
		<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
		<?
		$nombre_capa="capa_dsd";
		$mensaje_capa="Debe ingresar la descripci&oacute;n";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");?>

		</td>
		</tr>
		<? } ?>


		<tr valign=top bgcolor="#FFFFFF">
		<td>Ruta hacia donde se redireccionar. Incluya el http</td>
		<td>
		<? $contadorx="dsruta_counter";$valorx="255";$formax="u";$campox="dsruta";?>
		<input type=text name=dsruta size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsruta')" value="<? echo $dsruta?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
		<?
		$nombre_capa="capa_dsruta";
		$mensaje_capa="Debe ingresar la ruta";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");?>
		</td>
		</tr>
		<tr valign=top bgcolor="#FFFFFF">
		<td>Video </td>
		<td>
		<? $contadorx="dsvideo_counter";$valorx="7500";$campox="dsvideo";?>
		<textarea name=dsvideo cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsvideo2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
		<?
		$nombre_capa="capa_dsvideo";
		$mensaje_capa="Debe ingresar la descripci&oacute;n";
		include($rutxx."../../incluidos_modulos/control.capa.php");
		include($rutxx."../../incluidos_modulos/control.letras.php");?>

		</td>
		</tr>
<? } ?>

<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>Imagen</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>Contenido</option>
		  <option value="4" <? if ($idactivo==4) echo "selected";?>>DestacadoIndex</option>
		  <option value="5" <? if ($idactivo==5) echo "selected";?>>Video</option>
	</select>

</td>
</tr>
<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="dsm";
	include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
	<input type="hidden" name="idx" value="<? echo $idx?>">
	</td>
</tr>
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
include($rutxx."../../incluidos_modulos/modulos.remate.php")
?>


</body>
</html>
<script language="javascript">
    function mostrarcapa(){
                   var contenedor1=document.getElementById('video2');// se utiliza de esta manera para poder q los botones de solicitar y recomendar funcionen en mozila
                                   contenedor1.style.display = "";
    }
</script>
