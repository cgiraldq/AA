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
//$db->debug=true;
$titulomodulo="Configuracion de galeria de hotel";
$idc=$_REQUEST['idc'];
$rr="hoteles.galeria.php?idc=$idc";
$idx=$_REQUEST['idx'];
$tabla="tblgaleriahoteles";
$rutaImagen="../../../../../contenidos/images/hoteles/";

			//imagen 1
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

		//imagen 2
		if ($_FILES['dsimg2']['name']<>"") {
			// borrar anterior
			$archivoanterior=$_REQUEST['archivoanterior2'];
			if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
			$temp_name = $_FILES['dsimg2']['tmp_name'];
			$nombre2=$tabla.$idx."-".date("his")."-2.".substr($_FILES['dsimg2']['name'],-3);
			move_uploaded_file($temp_name,$rutaImagen.$nombre2);
		}
		elseif ($_REQUEST['img2']<>"") $nombre2=$_REQUEST['img2'];
		if ($_REQUEST['borrar2']==1) $nombre2="";

			//imagen 3
			if ($_FILES['dsimg3']['name']<>"") {
				// borrar anterior
				$archivoanterior=$_REQUEST['archivoanterior3'];
				if (is_file($rutaImagen.$archivoanterior)) unlink($rutaImagen.$archivoanterior);
				$temp_name = $_FILES['dsimg3']['tmp_name'];
				$nombre3=$tabla.$idx."-".date("his")."-3.".substr($_FILES['dsimg3']['name'],-3);
				move_uploaded_file($temp_name,$rutaImagen.$nombre3);
			}
			elseif ($_REQUEST['img3']<>"") $nombre3=$_REQUEST['img3'];
			if ($_REQUEST['borrar3']==1) $nombre3="";


			$dsm=$_REQUEST['dsm'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];

			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					$sql=" update $tabla set ";
					$sql.=" seccion='$dsm'";
					$sql.=",dsimg='$nombre1'";
					//$sql.=",campo3='$nombre2'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=",idorigen=$idc";

					$sql.=" where tipo=12 and id=".$idx;
					//echo $sql;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico  registro";
						$dsruta="../sitios/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>
<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php"); ?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.seccion,a.idpos,a.idactivo,a.dsimg";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx and tipo=12";
//echo $sql;
$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>Configuracion de sitios disponibles</a>  /  <a href='productos.galeria.php?idc=$idc' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$idpos=$result->fields[1];
$idactivo=$result->fields[2];
$dsimg1=$result->fields[3];
/*$dsimg2=$result->fields[4];
$dsimg3=$result->fields[5];*/
?>
<br>

<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">





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
<td>Imagen</td>
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
  		  <option value="3" <? if ($idactivo==3) echo "selected";?>>DESTACADO HOME</option>
  		  <option value="4" <? if ($idactivo==4) echo "selected";?>>DETALLE</option>

	</select>

</td>
</tr>
<tr><td align="center" colspan="2" background="../../img_modulos/cf_diseno_r2_c2.jpg">
<?
$forma="u";
$param="dsm,idpos";
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
<? include("../reproductores/default.php");
} // fin si
$result->Close();
?>
<br>
<? 	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>