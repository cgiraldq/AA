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

$idx=$_REQUEST['idx'];
include("beneficios.editar.procesos.php");
?>
<html>
		<?include($rutxx."../../incluidos_modulos/head.php");?>

<body>

	<? include($rutxx."../../incluidos_modulos/navegador.principal.php");?>

<br>
<?
$rutamodulo="<a href='$rutxx../core/default.php' class='textlink' target='_top' title='Principal'>Principal</a>  /  ";
$rutamodulo.="  <a href='default.beneficios.php' class='textlink'>Configuraci&oacute;n de Servicios</a>  /  <span class='text1'>Modificar</span>";
include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

include($rutxx."../../incluidos_modulos/encabezado.editar.php");


?>

<table align="center"  cellspacing="1" cellpadding="5" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">

<tr>
	<td align="center" colspan="2">

<?
$forma="u";
$param="dsm";
$activareditor=1; // incluye el botton de activar editor de texto cuando es igual a 1
include($rutxx."../../incluidos_modulos/botones.modificar.php");
//include("activartiny.php");
?>

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
<td>
<? if ($idtipo==5) {?>
	Detalle
<? } else { ?>
	Descripci&oacute;n

<? } ?>
</td>
<td>
<? $contadorx="dsd_counter";$valorx="3500";$campox="dsd";?>
<textarea name=dsd cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd?></textarea>
<?
$nombre_capa="capa_dsd";
$mensaje_capa="Debe ingresar la descripci&oacute;n";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>
<? if ($idtipo==5) {?>
	Complemento
<? } else { ?>
	Beneficios
<? } ?>

</td>
<td>
<? $contadorx="dsd2_counter";$valorx="3500";$campox="dsd2";?>
<textarea name=dsd2 cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsd2')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2?></textarea>
<?
$nombre_capa="capa_dsd2";
$mensaje_capa="Debe ingresar la descripci&oacute;n Larga";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<? /*if ($idtipo==5) {?>
<tr valign=top bgcolor="#FFFFFF">
<td>Altura</td>
<td>
<? $contadorx="dsaltura_counter";$valorx="255";$campox="dsaltura";?>
<input type=text name=dsaltura size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsaltura')" value="<? echo $dsaltura?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsaltura";
$mensaje_capa="Debe ingresar la altura";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>
<? } */?>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Proveedor</td>
<td>
<? $contadorx="dsproveedor_counter";$valorx="255";$campox="dsproveedor";?>
<input type=text name=dsproveedor size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsproveedor')" value="<? echo $dsproveedor?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsproveedor";
$mensaje_capa="Debe ingresar el proveedor";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->


<!--tr valign=top bgcolor="#FFFFFF">
<td>O seleccione Proveedor</td>
<td>
		<select name=idproveedor class=text1>
			<option value="0" <? if ($idproveedor=="0") echo "selected";?>>Seleccione...</option>
<? lista_proveedores("tblproveedores",$idproveedor) ?>



	</select>

</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Equipo Asociado</td>
<td>
		<select name=idequipo class=text1>
			<option value="0" <? if ($idequipo=="0") echo "selected";?>>Seleccione...</option>
<? categorias("tblequipo",$idequipo) ?>



	</select>

</td>
</tr -->


<!--tr valign=top bgcolor="#FFFFFF">
<td>URL</td>
<td>
<? $contadorx="dsurl_counter";$valorx="3500";$campox="dsurl";?>
<textarea name=dsurl cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsurl')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsurl?></textarea>
<?
$nombre_capa="capa_dsurl";
$mensaje_capa="Debe ingresar la dsurl";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
<? if ($dsurl<>"") {?>
<a href="<? echo $dsurl?>" target="_blank"><strong>Ver Enlace</strong></a>
<? } ?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Precio compra</td>
<td>
<? $contadorx="preciocompra_counter";$valorx="255";$campox="preciocompra";?>
<input type=text name=preciocompra size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_preciocompra')" value="<? echo $preciocompra?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_preciocompra";
$mensaje_capa="Debe ingresar el Precio de compra";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->


<tr valign=top bgcolor="#FFFFFF">
<td>Enlace URL</td>
<td>
<? $contadorx="dsurl_counter";$valorx="255";$campox="dsurl";?>
<input type=text name=dsurl size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsurl')" value="<? echo $dsurl?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsurl";
$mensaje_capa="Debe ingresar enlace";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Valor flete</td>
<td>
<? $contadorx="precio2_counter";$valorx="255";$campox="precio2";?>
<input type=text name=precio2 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio2')" value="<? echo $precio2?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_precio2";
$mensaje_capa="Debe ingresar el Precio2";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->


<!--tr valign=top bgcolor="#FFFFFF">
<td>% Descuento</td>
<td>
<? $contadorx="descuento_counter";$valorx="255";$campox="descuento";?>
<input type=text name=descuento size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_descuento')" value="<? echo $descuento?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_descuento";
$mensaje_capa="Debe ingresar el Descuento";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Precio descuento</td>
<td>
<? $contadorx="preciodescuento_counter";$valorx="255";$campox="preciodescuento";?>
<input type=text name=preciodescuento size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_preciodescuento')" value="<? echo $preciodescuento?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_preciodescuento";
$mensaje_capa="Debe ingresar el Precio de descuento";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->


<!--tr valign=top bgcolor="#FFFFFF">
<td>PRECIO DISTRIBUIDOR</td>
<td>
<? $contadorx="preciodistribuidor_counter";$valorx="255";$campox="preciodistribuidor";?>
<input type=text name=preciodistribuidor size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_preciodistribuidor')" value="<? echo $preciodistribuidor?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_preciodistribuidor";
$mensaje_capa="Debe ingresar el Precio de distribuidor";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Precio 3</td>
<td>
<? $contadorx="precio3_counter";$valorx="255";$campox="precio3";?>
<input type=text name=precio3 size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_precio3')" value="<? echo $precio3?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_precio3";
$mensaje_capa="Debe ingresar el Precio 3";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>% Impuestos</td>
<td>
<? $contadorx="iva_counter";$valorx="255";$campox="iva";?>
<input type=text name=iva size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_iva')" value="<? echo $iva?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_iva";
$mensaje_capa="Debe ingresar el Iva";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Volumen</td>
<td>
<? $contadorx="volumen_counter";$valorx="255";$campox="volumen";?>
<input type=text name=volumen size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_volumen')" value="<? echo $volumen?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_volumen";
$mensaje_capa="Debe ingresar el Volumen";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Peso</td>
<td>
<? $contadorx="peso_counter";$valorx="255";$campox="peso";?>
<input type=text name=peso size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_peso')" value="<? echo $peso?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_peso";
$mensaje_capa="Debe ingresar el Peso";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Ancho</td>
<td>
<? $contadorx="ancho_counter";$valorx="255";$campox="ancho";?>
<input type=text name=ancho size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_ancho')" value="<? echo $ancho?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_ancho";
$mensaje_capa="Debe ingresar el Ancho";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Alto</td>
<td>
<? $contadorx="alto_counter";$valorx="255";$campox="alto";?>
<input type=text name=alto size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_alto')" value="<? echo $alto?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_alto";
$mensaje_capa="Debe ingresar el Alto";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Largo</td>
<td>
<? $contadorx="largo_counter";$valorx="255";$campox="largo";?>
<input type=text name=largo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_largo')" value="<? echo $largo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_largo";
$mensaje_capa="Debe ingresar el Largo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Cantidad por Unidad</td>
<td>
<? $contadorx="dsunidad_counter";$valorx="255";$campox="dsunidad";?>
<input type=text name=dsunidad size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsunidad')" value="<? echo $dsunidad?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsunidad";
$mensaje_capa="Debe ingresar el Largo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Unidades disponibles</td>
<td>
<? $contadorx="dsunidadesdispo_counter";$valorx="255";$campox="dsunidadesdispo";?>
<input type=text name=dsunidadesdispo size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsunidadesdispo')" value="<? echo $dsunidadesdispo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsunidadesdispo";
$mensaje_capa="Debe ingresar el Largo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->


<!--tr valign=top bgcolor="#FFFFFF">
<td>Fecha Inicial</td>
<td>
<? $contadorx="dsfechainicial_counter";$valorx="10";$formax="u";$campox="dsfechainicial";$cantidad=strlen($dsfechainicial)?>
<input type=text name=dsfechainicial size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechainicial')" readonly  value="<? echo $dsfechainicial?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechainicial', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechainicial";
$mensaje_capa="Debe ingresar la fecha de publicacion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr-->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Fecha Final</td>
<td>
<? $contadorx="dsfechafinal_counter";$valorx="10";$formax="u";$campox="dsfechafinal";$cantidad=strlen($dsfechafinal)?>
<input type=text name=dsfechafinal size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechafinal')" readonly  value="<? echo $dsfechafinal?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechafinal', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechafinal";
$mensaje_capa="Debe ingresar la fecha de publicacion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr -->




<tr valign=top bgcolor="#FFFFFF">
<td>Imagen producto</td>
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
<!--br>
<br>
<input type=checkbox name="cargarimg1" value="1"> Activar para que esta imagen 1 se cargue y genere:<br>
- Imagen lateral carrito<br>
- Imagen peque&ntilde;a<br>
- Imagen mediana<br>
- Imagen grande<br>


</td -->
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen peque&ntilde;a<br> 200 X 167</td>
<td><input type=file name=dsimgcarrito class=text1 onKeyPress="ocultar('capa_dsimgcarrito')" onClick="ocultar('capa_dsimg1')">
<?
$nombre_capa="capa_dsimgcarrito";
$mensaje_capa="Debe cargar la imagen lateral carrito";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanteriordsimgcarrito" value="<? echo $dsimgcarrito?>">
<? if (is_file($rutaImagen.$dsimgcarrito)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimgcarrito;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrardsimgcarrito" value="1"> Borrar Esta imagen
<input type="hidden" name="imgdsimgcarrito" value="<? echo $dsimgcarrito?>">

<? } ?>

</td>
</tr -->


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana detalle<br></td>
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

<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 1<br> 800 X 800 </td>
<td><input type=file name=dsimg3 class=text1 onKeyPress="ocultar('capa_dsimg3')" onClick="ocultar('capa_dsimg3')">
<?
$nombre_capa="capa_dsimg3";
$mensaje_capa="Debe cargar la imagen 3";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior3" value="<? echo $dsimg3?>">
<? if (is_file($rutaImagen.$dsimg3)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg3;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar3" value="1"> Borrar Esta imagen
<input type="hidden" name="img3" value="<? echo $dsimg3?>">
<? } ?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen peque&ntilde;a 2<br><? echo $txt;?></td>
<td><input type=file name=dsimg4 class=text1 onKeyPress="ocultar('capa_dsimg4')" onClick="ocultar('capa_dsimg4')">
<?
$nombre_capa="capa_dsimg4";
$mensaje_capa="Debe cargar la imagen 4";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior4" value="<? echo $dsimg4?>">
<? if (is_file($rutaImagen.$dsimg4)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg4;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar4" value="1"> Borrar Esta imagen
<input type="hidden" name="img4" value="<? echo $dsimg4?>">
<? } ?>
<br>
<br>
<input type=checkbox name="cargarimg2" value="1"> Activar para que esta imagen 2 se cargue y genere:<br>
- Imagen peque&ntilde;a<br>
- Imagen mediana<br>
- Imagen grande<br>


</td>
</tr -->


<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 2<br>328 X 328</td>
<td><input type=file name=dsimg5 class=text1 onKeyPress="ocultar('capa_dsimg5')" onClick="ocultar('capa_dsimg5')">
<?
$nombre_capa="capa_dsimg5";
$mensaje_capa="Debe cargar la imagen 5";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior5" value="<? echo $dsimg5?>">
<? if (is_file($rutaImagen.$dsimg5)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg5;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar5" value="1"> Borrar Esta imagen
<input type="hidden" name="img5" value="<? echo $dsimg5?>">
<? } ?>
</td>
</tr -->

<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 2<br> 800 X 800</td>
<td><input type=file name=dsimg6 class=text1 onKeyPress="ocultar('capa_dsimg6')" onClick="ocultar('capa_dsimg6')">
<?
$nombre_capa="capa_dsimg6";
$mensaje_capa="Debe cargar la imagen 6";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior8" value="<? echo $dsimg6?>">
<? if (is_file($rutaImagen.$dsimg6)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg6;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar6" value="1"> Borrar Esta imagen
<input type="hidden" name="img6" value="<? echo $dsimg6?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen peque&ntilde;a 3<br><? echo $txt;?> </td>
<td><input type=file name=dsimg7 class=text1 onKeyPress="ocultar('capa_dsimg7')" onClick="ocultar('capa_dsimg7')">
<?
$nombre_capa="capa_dsimg7";
$mensaje_capa="Debe cargar la imagen 7";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior7" value="<? echo $dsimg7?>">
<? if (is_file($rutaImagen.$dsimg7)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg7;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar7" value="1"> Borrar Esta imagen
<input type="hidden" name="img7" value="<? echo $dsimg7?>">
<? } ?>

<br>
<br>
<input type=checkbox name="cargarimg3" value="1"> Activar para que esta imagen 3 se cargue y genere:<br>
- Imagen peque&ntilde;a<br>
- Imagen mediana<br>
- Imagen grande<br>


</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 3<br> 328 X 328</td>
<td><input type=file name=dsimg8 class=text1 onKeyPress="ocultar('capa_dsimg8')" onClick="ocultar('capa_dsimg8')">
<?
$nombre_capa="capa_dsimg8";
$mensaje_capa="Debe cargar la imagen 8";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior8" value="<? echo $dsimg8?>">
<? if (is_file($rutaImagen.$dsimg8)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg8;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar8" value="1"> Borrar Esta imagen
<input type="hidden" name="img8" value="<? echo $dsimg8?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 3<br> 800 X 800</td>
<td><input type=file name=dsimg9 class=text1 onKeyPress="ocultar('capa_dsimg9')" onClick="ocultar('capa_dsimg9')">
<?
$nombre_capa="capa_dsimg9";
$mensaje_capa="Debe cargar la imagen 9";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior9" value="<? echo $dsimg9?>">
<? if (is_file($rutaImagen.$dsimg9)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg9;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar9" value="1"> Borrar Esta imagen
<input type="hidden" name="img9" value="<? echo $dsimg9?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 4<br> 328 X 328</td>
<td><input type=file name=dsimg11 class=text1 onKeyPress="ocultar('capa_dsimg11')" onClick="ocultar('capa_dsimg11')">
<?
$nombre_capa="capa_dsimg11";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior11" value="<? echo $dsimg11?>">
<? if (is_file($rutaImagen.$dsimg11)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg11;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar11" value="1"> Borrar Esta imagen
<input type="hidden" name="img11" value="<? echo $dsimg11?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 4<br> 800 X 800</td>
<td><input type=file name=dsimg12 class=text1 onKeyPress="ocultar('capa_dsimg12')" onClick="ocultar('capa_dsimg12')">
<?
$nombre_capa="capa_dsimg12";
$mensaje_capa="Debe cargar la imagen 12";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior12" value="<? echo $dsimg12?>">
<? if (is_file($rutaImagen.$dsimg12)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg12;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar12" value="1"> Borrar Esta imagen
<input type="hidden" name="img12" value="<? echo $dsimg12?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 5<br> 328 X 328</td>
<td><input type=file name=dsimg13 class=text1 onKeyPress="ocultar('capa_dsimg13')" onClick="ocultar('capa_dsimg13')">
<?
$nombre_capa="capa_dsimg13";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior13" value="<? echo $dsimg13?>">
<? if (is_file($rutaImagen.$dsimg13)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg13;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar13" value="1"> Borrar Esta imagen
<input type="hidden" name="img13" value="<? echo $dsimg13?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 5<br> 800 X 800</td>
<td><input type=file name=dsimg14 class=text1 onKeyPress="ocultar('capa_dsimg14')" onClick="ocultar('capa_dsimg14')">
<?
$nombre_capa="capa_dsimg14";
$mensaje_capa="Debe cargar la imagen 14";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior14" value="<? echo $dsimg14?>">
<? if (is_file($rutaImagen.$dsimg14)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg14;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar14" value="1"> Borrar Esta imagen
<input type="hidden" name="img14" value="<? echo $dsimg14?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 6<br> 328 X 328</td>
<td><input type=file name=dsimg15 class=text1 onKeyPress="ocultar('capa_dsimg15')" onClick="ocultar('capa_dsimg15')">
<?
$nombre_capa="capa_dsimg15";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior15" value="<? echo $dsimg15?>">
<? if (is_file($rutaImagen.$dsimg15)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg15;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar15" value="1"> Borrar Esta imagen
<input type="hidden" name="img15" value="<? echo $dsimg15?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 6<br> 800 X 800</td>
<td><input type=file name=dsimg16 class=text1 onKeyPress="ocultar('capa_dsimg16')" onClick="ocultar('capa_dsimg16')">
<?
$nombre_capa="capa_dsimg16";
$mensaje_capa="Debe cargar la imagen 16";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior16" value="<? echo $dsimg16?>">
<? if (is_file($rutaImagen.$dsimg16)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg16;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar16" value="1"> Borrar Esta imagen
<input type="hidden" name="img16" value="<? echo $dsimg16?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 7<br> 328 X 328</td>
<td><input type=file name=dsimg17 class=text1 onKeyPress="ocultar('capa_dsimg17')" onClick="ocultar('capa_dsimg17')">
<?
$nombre_capa="capa_dsimg17";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior17" value="<? echo $dsimg17?>">
<? if (is_file($rutaImagen.$dsimg17)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg17;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar17" value="1"> Borrar Esta imagen
<input type="hidden" name="img17" value="<? echo $dsimg17?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 7<br> 800 X 800</td>
<td><input type=file name=dsimg18 class=text1 onKeyPress="ocultar('capa_dsimg18')" onClick="ocultar('capa_dsimg18')">
<?
$nombre_capa="capa_dsimg18";
$mensaje_capa="Debe cargar la imagen 18";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior18" value="<? echo $dsimg18?>">
<? if (is_file($rutaImagen.$dsimg18)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg18;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar18" value="1"> Borrar Esta imagen
<input type="hidden" name="img18" value="<? echo $dsimg18?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 8<br> 328 X 328</td>
<td><input type=file name=dsimg19 class=text1 onKeyPress="ocultar('capa_dsimg19')" onClick="ocultar('capa_dsimg19')">
<?
$nombre_capa="capa_dsimg19";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior19" value="<? echo $dsimg19?>">
<? if (is_file($rutaImagen.$dsimg19)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg19;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar19" value="1"> Borrar Esta imagen
<input type="hidden" name="img19" value="<? echo $dsimg19?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 8<br> 800 X 800</td>
<td><input type=file name=dsimg20 class=text1 onKeyPress="ocultar('capa_dsimg20')" onClick="ocultar('capa_dsimg20')">
<?
$nombre_capa="capa_dsimg20";
$mensaje_capa="Debe cargar la imagen 20";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior20" value="<? echo $dsimg20?>">
<? if (is_file($rutaImagen.$dsimg20)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg20;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar20" value="1"> Borrar Esta imagen
<input type="hidden" name="img20" value="<? echo $dsimg20?>">
<? } ?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 9<br> 328 X 328</td>
<td><input type=file name=dsimg21 class=text1 onKeyPress="ocultar('capa_dsimg21')" onClick="ocultar('capa_dsimg21')">
<?
$nombre_capa="capa_dsimg21";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior21" value="<? echo $dsimg21?>">
<? if (is_file($rutaImagen.$dsimg21)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg21;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar21" value="1"> Borrar Esta imagen
<input type="hidden" name="img21" value="<? echo $dsimg21?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 9<br> 800 X 800</td>
<td><input type=file name=dsimg22 class=text1 onKeyPress="ocultar('capa_dsimg22')" onClick="ocultar('capa_dsimg22')">
<?
$nombre_capa="capa_dsimg22";
$mensaje_capa="Debe cargar la imagen 22";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior22" value="<? echo $dsimg22?>">
<? if (is_file($rutaImagen.$dsimg22)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg22;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar22" value="1"> Borrar Esta imagen
<input type="hidden" name="img22" value="<? echo $dsimg22?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen mediana 10<br> 328 X 328</td>
<td><input type=file name=dsimg23 class=text1 onKeyPress="ocultar('capa_dsimg23')" onClick="ocultar('capa_dsimg23')">
<?
$nombre_capa="capa_dsimg23";
$mensaje_capa="Debe cargar la imagen";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior23" value="<? echo $dsimg23?>">
<? if (is_file($rutaImagen.$dsimg23)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg23;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar23" value="1"> Borrar Esta imagen
<input type="hidden" name="img23" value="<? echo $dsimg23?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen grande 10<br> 800 X 800</td>
<td><input type=file name=dsimg24 class=text1 onKeyPress="ocultar('capa_dsimg24')" onClick="ocultar('capa_dsimg24')">
<?
$nombre_capa="capa_dsimg24";
$mensaje_capa="Debe cargar la imagen 24";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior24" value="<? echo $dsimg24?>">
<? if (is_file($rutaImagen.$dsimg24)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg24;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar24" value="1"> Borrar Esta imagen
<input type="hidden" name="img24" value="<? echo $dsimg24?>">
<? } ?>
</td>
</tr -->



<!--tr valign=top bgcolor="#FFFFFF">
<td>Imagen novedades <br>180 X 105 </td>
<td><input type=file name=dsimg10 class=text1 onKeyPress="ocultar('capa_dsimg10')" onClick="ocultar('capa_dsimg10')">
<?
$nombre_capa="capa_dsimg10";
$mensaje_capa="Debe cargar la imagen de novedades";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanterior10" value="<? echo $dsimg10?>">
<? if (is_file($rutaImagen.$dsimg10)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimg10;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrar10" value="1"> Borrar Esta imagen
<input type="hidden" name="img10" value="<? echo $dsimg10?>">
<? } ?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Imagen Destacada<br> 490 X 415 </td>
<td><input type=file name=dsimgdestacada class=text1 onKeyPress="ocultar('capa_dsimgdestacada')" onClick="ocultar('capa_dsimgdestacada')">
<?
$nombre_capa="capa_dsimgdestacada";
$mensaje_capa="Debe cargar la imagen destacada";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
<input type="hidden" name="archivoanteriordsimgdestacada" value="<? echo $dsimgdestacada?>">
<? if (is_file($rutaImagen.$dsimgdestacada)) {?>
&nbsp;<img src="<? echo $rutaImagen.$dsimgdestacada;?>" align="absmiddle" border="0">
<br>
<input type="checkbox" name="borrardsimgdestacada" value="1"> Borrar Esta imagen
<input type="hidden" name="imgdsimgdestacada" value="<? echo $dsimgdestacada?>">
<? } ?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Tiempos de Entrega </td>
<td>
<? $contadorx="dsentrega_counter";$valorx="255";$campox="dsentrega";?>
<input type=text name=dsentrega size=45 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsentrega')" value="<? echo $dsentrega?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsentrega";
$mensaje_capa="Debe ingresar el Precio 1";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Condiciones de transporte y entrega y/o caracteristicas</td>
<td>
<? $contadorx="dscondiciones_counter";$valorx="3500";$campox="dscondiciones";?>
<textarea name=dscondiciones cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dscondiciones')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dscondiciones?></textarea>
<?
$nombre_capa="capa_dscondiciones";
$mensaje_capa="Debe ingresar las condiciones de transporte y entega";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Disponible</td>
<td>
	<select name=dsdisponible class=text1>
			<option value="" <? if ($dsdisponible=="0") echo "selected";?>>Seleccione...</option>

		  <option value="1" <? if ($dsdisponible==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($dsdisponible==2) echo "selected";?>>NO</option>

	</select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Producto mas vendido</td>
<td>
	<select name=idmasvendido class=text1>
			<option value="" <? if ($idmasvendido=="0") echo "selected";?>>Seleccione...</option>

		  <option value="1" <? if ($idmasvendido=="1") echo "selected";?>>SI</option>
		  <option value="2" <? if ($idmasvendido=="2") echo "selected";?>>NO</option>

	</select>

</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Naturaleza</td>
<td>
	<select name=idnat class=text1>
			<option value="" <? if ($idnat=="") echo "selected";?>>Seleccione...</option>

		  <option value="1" <? if ($idnat=="1") echo "selected";?>>Nacional</option>
		  <option value="2" <? if ($idnat=="2") echo "selected";?>>Importado</option>

	</select>

</td>
</tr-->




<tr valign=top bgcolor="#FFFFFF">
<td>Iframe Video de youtube</td>
<td>
<? $contadorx="dsvideo_counter";$valorx="3500";$campox="dsvideo";?>
<textarea name=dsvideo cols=80  rows="8" class=text1 onKeyPress="ocultar('capa_dsvideo')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsvideo?></textarea>
<?
$nombre_capa="capa_dsvideo";
$mensaje_capa="Debe ingresar el Video";
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

<!--tr valign=top bgcolor="#FFFFFF">
<td>Tipo de producto. Si lo deja vacio, se asume que es plantilla tipo producto</td>
<td>
            <select name="idtipo" class="textnegro">
              <option value="">Seleccione..</option>
            <? categorias("tbltiposproductos",$idtipo); ?>
          </select>

</td>
</tr -->



<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>DESTACADO</option>
		  <!--option value="4" <? if ($idactivo==4) echo "selected";?>>DESTACADO INDEX</option>
		  <option value="5" <? if ($idactivo==5) echo "selected";?>>INCOMPLETO</option>
		  <option value="6" <? if ($idactivo==6) echo "selected";?>>NUEVA OFERTA</option>
		  <option value="7" <? if ($idactivo==7) echo "selected";?>>NUEVO</option>
		  <option value="8" <? if ($idactivo==8) echo "selected";?>>USA HOME SUPERIOR</option>
		  <option value="9" <? if ($idactivo==9) echo "selected";?>>USA HOME LISTA</option>
		  <option value="10" <? if ($idactivo==10) echo "selected";?>>USA OFERTAS</option>
		  <option value="11" <? if ($idactivo==11) echo "selected";?>>OFERTAS DEL DÍA</option -->



	</select>

</td>
</tr>

<!--tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>RELACIONES.</strong> Asocie en que categoria desea ver este item
<br>
<?
$datasqladd=" and idactivo not in (2,9) and idtipo=$idtipoprod ";


include("../relaciones/default.php");?>
</td>
</tr>



<!--tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>COLORES.</strong> Asocie colores al producto
<br>
<?
$datasqladd=" and idactivo not in (2) and idtipo=$idtipoprod ";
include("../relaciones/default.colores.php");?>
</td>
</tr -->

<!--
<tr valign=top bgcolor="#FFFFFF">
<td colspan="2">
<strong>TALLAS.</strong> Asocie tallas al producto
<br>
<?
$datasqladd=" and idactivo not in (2) and idtipo=$idtipoprod ";
include("../relaciones/default.tallas.php");?>
</td>
</tr-->


	<? include($rutxx."../relaciones/default.subcategoria.php");?>

	<?include($rutxx."../relaciones/default.categoria.php");?>




<tr><td align="center" colspan="2">
<?
$forma="u";
$param="dsm";
include($rutxx."../../incluidos_modulos/botones.modificar.php");?>
<input type="hidden" name="idx" value="<? echo $idx?>">
<input type="hidden" name="idtipoprod" value="<? echo $idtipoprod?>">

</td></tr>
</form>

</table>
<br>

</td>
</tr>
</table>
<br>
<?
	include($rutxx."../../incluidos_modulos/navegador.principal.cerrar.php");

include($rutxx."../../incluidos_modulos/modulos.remate.php");?>


</body>
</html>
