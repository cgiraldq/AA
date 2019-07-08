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
Controladores de texto
*/
?>
 <? if($contador%2==0){  ?>  <tr valign=top bgcolor="#FFFFFF">  <?}?>
<td align="center" style="font-size:12"><? echo $titulocampo?> <?echo $tamano?></td>
<td>

<?
if ($tipocampo==1) {
?>
<input type=text name="<? echo $campo?>" size="<? echo $tam?>" <?if($campo=='dscampo3' && $idx==1){echo "autofocus";}?> maxlength="<? echo $valorx?>" class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')" value="<? echo $valorcampo?>"
<? include("../../../incluidos_modulos/control.evento.php");?>>
<? } elseif ($tipocampo==2) { ?>
<textarea name="<? echo $campo?>" cols=70  rows="10" class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')"
	<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $valorcampo?>
</textarea>
<? } elseif ($tipocampo==5) {?>

<input type=text name="<? echo $campo  ?>" size="<? echo $tam  ?>" maxlength="<? echo $valorx; ?>" class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')" value="<? echo $valorcampo?>" readonly
<? include("../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="<?echo $imgcalendario  ?>" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('<? echo $campo ?>', this);" language="javaScript">
<?
} ?>
<?
if ($tipocampo==3) {
?>
<select style="width:100%" name=<? echo $campo?> class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')">
	<option value=""> -- Seleccionar -- </option>
	<?

$total=explode(";",$valores);
for ($i=0;$i < (count($total));$i++) {
	if ($total[$i]<>"") {
		$partir=explode("-",$total[$i]);


		?>
		<option value="<? echo $partir[0]?>" <? if ($partir[0]==$valorcampo) echo "selected";?>><? echo $partir[1]?></option>
		<?
		}
	}
	?>
	</select>
<? } ?>


<?
if ($tipocampo==10) {
?>
<select style="width:100%" name="<? echo $campo?>" id="<? echo $campo?>" onchange="ocultar('<? echo $nombre_capa?>')">
	<option value=""> -- Seleccionar -- </option>
	<?

$total=explode(";",$valores);
for ($i=0;$i < (count($total));$i++) {
	if ($total[$i]<>"") {
		$partir=explode("-",$total[$i]);
		if($campo=='dscampo29' && $idx==1 && $valorcampo==''){?>
		<option value='Prospecto' selected >Prospecto</option>
		<?
	}else{
?>
		<option value='<? echo trim($partir[0]);?>'   <? if (trim($partir[0])==trim($valorcampo)) echo "selected";?>><? echo $partir[1]?></option>

<?
	}
		}
	}
	?>
	</select>

<? } ?>


<?
if ($tipocampo==11) {
?>
<select style="width:100%" name="<? echo $campo;?>" id="<? echo $campo;?>"   onchange="<? if($ajaxx<>"")echo $ajaxx;?>" onclick="ocultar('capa_<? echo $campo;?>')">
	<option value=""> -- Seleccionar -- </option>
	<?

$total=explode(";",$valores);
for ($i=0;$i < (count($total));$i++) {
	if ($total[$i]<>"") {
		$partir=explode("-",$total[$i]);
		?>
		<option value='<? echo trim($partir[0]);?>'   <? if (trim($partir[0])==trim($valorcampo)) echo "selected";?>><? echo $partir[1]?></option>
		<?
		}
	}
	?>
	</select>
<? } ?>


<?

// campo para listar barrios
if ($tipocampo==12) {
?>
<select name="<? echo $campo;?>" id="<? echo $campo;?>"  onchange="ocultar('<? echo $nombre_capa?>')" onclick="ocultar('capa_<? echo $campo;?>')" >
	<option value=""> -- Seleccionar -- </option>
	<?

$total=explode(";",$valores);
for ($i=0;$i < (count($total));$i++) {
	if ($total[$i]<>"") {
		$partir=explode("-",$total[$i]);
		?>
		<option value='<? echo trim($partir[0]);?>'   <? if (trim($partir[0])==trim($valorcampo)) echo "selected";?>><? echo $partir[1]?></option>
		<?
		}
	}
	?>
	</select>
<? } ?>

<?
if ($tipocampo==13) {
?>
<a href="#" class="open">Configurar</a>
<input class="btn_contactar iframe cboxElement" id="<? echo $campo?>" type=text name="<? echo $campo?>" size="<? echo $tam?>" maxlength="<? echo $valorx?>" class=text1 onblur="ocultar('<? echo $nombre_capa?>')" onKeyPress="ocultar('<? echo $nombre_capa?>')" value="<? echo $valorcampo?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<? }
?>


<?
if ($tipocampo==14) {
?>

<input onkeypress="return justNumbers(event);" class="btn_contactar iframe cboxElement" id="<? echo $campo?>" type=text name="<? echo $campo?>"
size="<? echo $tam?>" maxlength="<? echo $valorx?>" class=text1 onblur="ocultar('<? echo $nombre_capa?>')"
onKeyPress="ocultar('<? echo $nombre_capa?>')" value="<? echo $valorcampo?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<? }
?>

<?
if ($tipocampo==15) {
?>

	<input type='text' name='<? echo $campo?>' class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')" readonly
	value="<? echo $valorcampo?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

	<img align="absmiddle" SRC="<? echo $rutxx;?>../../img_modulos/modulos/calendario.gif" ALT="Calendario"
	name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0"
	onClick="displayDatePicker('<? echo $campo?>', this);" language="javaScript">





<? }
?>



<?
if ($tipocampo==4) {
?>
<input type=file name="<? echo $campo?>" class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')" Onclick="ocultar('<? echo $nombre_capa?>')">
<input type="hidden" name="<? echo $narchivoanterior?>" value="<? echo $valorcampo?>">

<? if (is_file($rutaImagen.$valorcampo)) {?>
<? if ($tipoarchivo==1) {

$nombre_capa_video="capa_repr_video_1"; //abre la capa con el dato
	if (substr($valorcampo,-3)=="swf" || substr($valorcampo,-3)=="SWF"){
		$archivo=$valorcampo;
		$ruta=$rutaImagen;
		include("../reproductores/flasher.php");
	} elseif(substr($valorcampo,-3)=="flv" || substr($valorcampo,-3)=="FLV" ){
		?>
		&nbsp;<a href="#video" title="Click para ejecutar" onClick="document.getElementById('<? echo $nombre_capa_video;?>').style.display=''">Ejecutar Video</a>
		<?
	} else {
	?>
	&nbsp;<img src="<? echo $rutaImagen.$valorcampo;?>" align="absmiddle" border="0">
	<?
	}

	?>

<br>
<input type="checkbox" name="<? echo $borrararchivo?>" value="1"> Borrar Esta imagen
<input type="hidden" name="<? echo $carchivoanterior?>" value="<? echo $valorcampo?>">

<? }elseif ($tipoarchivo==2) {?>

<a href="descargar.php?path=<? echo $rutaImagen;?>&file=<? echo $valorcampo; ?>">Ver documento</a><br>
<input type="checkbox" name="<? echo $borrararchivo?>" value="1"> Borrar el documento
<input type="hidden" name="<? echo $carchivoanterior?>" value="<? echo $valorcampo?>">
<?} ?>

<? }
?>


<?
}?>


<?if ($tipocampo==6) {?>

<input type=password name="<? echo $campo?>" size="<? echo $tam?>" maxlength="<? echo $valorx?>" class=text1 onKeyPress="ocultar('<? echo $nombre_capa?>')" value="<? echo $valorcampo?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>(<? echo $valorcampo; ?>)


<?}

if ($tipocampo==1 || $tipocampo==2  || $tipocampo==4  || $tipocampo==6  || $tipocampo==10 || $tipocampo==11 || $tipocampo==12 || $tipocampo==13 || $tipocampo==14 ) {
include($rutxx."../../incluidos_modulos/control.capa.php");
if ($tipocampo==1 || $tipocampo==2 || $tipocampo==6) include($rutxx."../../incluidos_modulos/control.letras.php");
}



?>
</td>
<? if($contador%2<>0){?></tr><?}?>

<script type="text/javascript">
	//setCounter(<? echo $valorx?>,1,'<? echo $contadorx;?>','<? echo $campox;?>','<? echo $formax;?>');
</script>
