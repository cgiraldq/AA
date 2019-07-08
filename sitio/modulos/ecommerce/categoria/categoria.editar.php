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
$rutxx="../";
include("../../../incluidos_modulos/modulos.globales.php");
$titulomodulo="Configuracion de Categoria de Producto";
$idx=$_REQUEST['idx'];
$idtipo=$_REQUEST['idtipo'];
$rr="default.php?idtipo=$idtipo";
if ($idtipo==2) $titulomodulo="Configuracion de Categoria de Servicios";
$tabla="ecommerce_tblcategoria";
$carpeta="categoria";
$rutaImagen="../../../../contenidos/images/ecommerce_categoria/";
$tablarelaciones2="ecommerce_tblempresaxtblcategoria";
$tablaorigen2="tblempresa";
			$nombre="dsimg1";
			$nombreant="archivoanterior1";
			$borrar=$_REQUEST['borrar1'];
			$valimg=$_REQUEST['img1'];
			include($rutxx."../../incluidos_modulos/modulos.cargar.imagen.php");
			$dsm=$_REQUEST['dsm'];
			$dsalias=$_REQUEST['dsalias'];
			$dsd=$_REQUEST['dsd'];
			$idpos=$_REQUEST['idpos'];
			$idactivo=$_REQUEST['idactivo'];
			$idnat=$_REQUEST['idnat'];
			$paso=$_REQUEST['paso'];
			if ($paso=="1") {
					/*$dsarchivo=limpieza(strtolower($dsm)).".php";
					$dsrutaPagina=generarPagina($dsarchivo,$carpeta,$dsm,$idx,$include);*/
					$dsruta=limpieza(strtolower($dsalias));
					$sql=" update $tabla set ";
					$sql.=" dsm='$dsm'";
					$sql.=",dsalias='$dsalias'";
					$sql.=",dsd='$dsd'";
					$sql.=",dsimg1='".$imgvec[0]."'";
					$sql.=" ,dsruta='".$dsruta."'";
					$sql.=",idpos=$idpos";
					$sql.=",idactivo=$idactivo";
					$sql.=",idnat=$idnat";
					$sql.=" where id=".$idx;
					if ($db->Execute($sql))  {
						$mensajes=$men[6];
						// cargar auditoria
						$dstitulo="Modificacion $titulomodulo, $dsm";
						$dsdesc=" El usuario ".$_SESSION['i_dslogin']." modifico un registro";
						$dsruta="../ecommerce/categoria/default.php";
						include($rutxx."../../incluidos_modulos/logs.php");
						include($rutxx."../relaciones/relaciones.operaciones.empresa.php");
					}	else {
						$mensajes=$men[7];
					}
			}



?>
<html>
	<?include($rutxx."../../incluidos_modulos/head.php");?>
<body >

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>
<?
// generacion del encabezado de acuerdo a los resultados encontrados
$sql="select a.dsm,a.dsd,a.idpos,a.idactivo,a.dsimg1,a.idnat,a.dsalias";
$sql.=" from $tabla a ";
$sql.=" where a.id=$idx ";

$result = $db->Execute($sql);
if (!$result->EOF) {
$totalregistros=$result->RecordCount();
$rutamodulo="<a href='../core/default.php' class='textlink' title='Principal'>Principal</a>  /  ";

$rutamodulo.="  <a href='default.php?idtipo=$idtipo' class='textlink'>$titulomodulo</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$dsm=$result->fields[0];
$dsd=$result->fields[1];
$idpos=$result->fields[2];
$idactivo=$result->fields[3];
$dsimg1=$result->fields[4];
$idnat=$result->fields[5];
$dsalias=$result->fields[6];


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
	$param="dsm,dsalias,idpos";
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

<tr valign=top bgcolor="#FFFFFF">
<td>Alias (Texto que se ve en la tienda)</td>
<td>
<? $contadorx="dsalias_counter";$valorx="255";$formax="u";$campox="dsalias";?>
<input type=text name=dsalias size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsalias')" value="<? echo $dsalias?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsalias";
$mensaje_capa="Debe ingresar el alias";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Descripci&oacute;n</td>
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
<td>Imagen<br> Tama&ntilde;o 300 x 300</td>
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
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>SOLO MENU SUPERIOR</option>
	</select>
</td>
</tr>



      <? if ($idtipo=="1") {?>

<tr valign=top bgcolor="#FFFFFF">
<td>Origen?</td>
<td>
  <select name=idnat class=text1>
      <option value="1" <? if ($idnat==1) echo "selected";?>>Nacional</option>
      <option value="2" <? if ($idnat==2) echo "selected";?>>Importado</option>
    </select>

</td>


</tr>


<? } else { ?>
<input type="hidden" name="idnat" value="<? echo $idnat?>">

<? } ?>

<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES CON TIENDAS.</strong> Asocie en que tienda desea ver este item
<br>
<?
$datasqladd=" and id>1 ";
include("../../relaciones/default.empresa.php");?>
</td>
</tr>


<tr>
	<td align="center" colspan="2" style="text-align: right;">
	<?
	$forma="u";
	$param="dsm,dsalias,idpos";
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
<?	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");
	include($rutxx."../../incluidos_modulos/modulos.remate.php");?>

</body>
</html>
