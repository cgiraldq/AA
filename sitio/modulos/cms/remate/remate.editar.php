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

$titulomodulo="Configuracion de Remate";
$rr="default.php";
$idx=$_REQUEST['idx'];
$tabla="tblremate";
$rutaImagen=$rutxx."../../../contenidos/images/remate/";

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
			$dsdireccion=$_REQUEST['dsdireccion'];
			$dstelefono=$_REQUEST['dstelefono'];
			$dsemail=$_REQUEST['dsemail'];
			$dsciudad=$_REQUEST['dsciudad'];

			$dsfax=$_REQUEST['dsfax'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];


			$paso=$_REQUEST['paso'];
			if ($paso=="1") {

					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsemail='$dsemail'";
					$sql.=",dsciudad='$dsciudad'";

					$sql.=",dsdireccion='$dsdireccion'";
					$sql.=",dstelefono='$dstelefono'";
					$sql.=",dsfax='$dsfax'";
					$sql.=",dsimg1='".$imgvec[0]."'";
					//$sql.=",dsimg2='".$imgvec[1]."'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=" where id=".$idx;
					//echo $sql;

			//exit;

					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						$error=0;

						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../cms/remate/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
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
$sql="select a.dsm,a.dsdireccion,a.dstelefono,a.dsfax,a.dsimg1,a.dsimg2,a.idpos,a.idactivo,a.dsemail,a.dsciudad";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.php' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsdireccion=$result->fields[1];
$dstelefono=$result->fields[2];
$dsfax=$result->fields[3];
$dsimg1=$result->fields[4];
$dsimg2=$result->fields[5];
$idpos=$result->fields[6];
$idactivo=$result->fields[7];

$dsemail=$result->fields[8];
$dsciudad=$result->fields[9];


?>
<? include($rutxx."../../incluidos_modulos/encabezado.editar.php");?>


<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm,idpos";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
</td></tr>


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
<td>Direccion</td>
<td>
<input type=text name=dsdireccion size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsdireccion')" value="<? echo $dsdireccion?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsdireccion";
$mensaje_capa="Debe ingresar la Direccion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Telefono</td>
<td>
<input type=text name=dstelefono size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstelefono')" value="<? echo $dstelefono?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dstelefono";
$mensaje_capa="Debe ingresar el Telefono";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Email</td>
<td>
<input type=text name=dsemail size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsemail')" value="<? echo $dsemail?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsemail";
$mensaje_capa="Debe ingresar el email";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ciudad</td>
<td>
<input type=text name=dsciudad size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsciudad')" value="<? echo $dsciudad?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsciudad";
$mensaje_capa="Debe ingresar la ciudad";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Imagen 1</td>
<td><input type=file name=dsimg1 class=text1 onKeyPress="ocultar('capa_dsimg1')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimg1";
$mensaje_capa="Debe cargar la imagen 1 ";
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

<!--tr valign=top bgcolor="#FFFFFF">
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
</tr-->


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
<tr><td align="center" colspan="2">
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
