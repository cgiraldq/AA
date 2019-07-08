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
// Tabla de uso para el ingreso de datos
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
        <tr>
<form action="<? echo $pagina;?>" method=post name=u>

<tr valign=top bgcolor="#FFFFFF">
<td>Fecha Inicial</td>
<td>
<? $contadorx="dsfechainicial_counter";$valorx="10";$formax="u";$campox="dsfechainicial";?>
<input type=text name=dsfechainicial size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechainicial')" readonly  value="<? echo $dsfechainicial?>"
 <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechainicial', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechainicial";
$mensaje_capa="Debe ingresar la fecha de inicial";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Hora Inicial</td>
<td>
   	<select name=dshorainicial class="txtnegro">
		<? for ($j=1;$j<=24;$j++) {

		   				if ($j>12) {
						$j1=$j-12;
						$x="p.m.";
					} else {
						$j1=$j;
						$x="a.m.";
				}

				?>
				<option value="<? echo $j; ?>" <? if ($dshorainicial=="$j"){ echo "selected";}?>><? echo $j1." ".$x; ?></option>
					<?

				} ?>
				</select>
	<select name=minutosini class=txtnegro>
	<option value="0" <? if ($idminf=="0"){ echo "selected";}?>>0</option>

		<? for ($k=1;$k<=60;$k++) { ?>
		<option value="<? echo $k; ?>" <? if ($minutosini=="$k"){ echo "selected";}?>><? echo $k; ?></option>
		<? } ?>
	</select>


				</td>
		</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Fecha Final</td>
<td>
<? $contadorx="dsfechafinal_counter";$valorx="10";$formax="u";$campox="dsfechafinal";?>
<input type=text name=dsfechafinal size=10 maxlength="10" class=text1 onKeyPress="ocultar('capa_dsfechafinal')" readonly  value="<? echo $dsfechafinal?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<img align="absmiddle" SRC="../../../img_modulos/modulos/calendario.gif" ALT="Calendario" name="imgFecha" ID="imgFecha" STYLE="cursor:hand;position:relative" BORDER="0" onClick="displayDatePicker('dsfechafinal', this);" language="javaScript">
<?
$nombre_capa="capa_dsfechafinal";
$mensaje_capa="Debe ingresar la fecha final";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Hora Final</td>
<td>
   	<select name=dshorafinal class="txtnegro">
		<? for ($j=1;$j<=24;$j++) {

		   				if ($j>12) {
						$j1=$j-12;
						$x="p.m.";
					} else {
						$j1=$j;
						$x="a.m.";
				}

				?>
				<option value="<? echo $j; ?>" <? if ($dshorafinal=="$j"){ echo "selected";}?>><? echo $j1." ".$x; ?></option>
					<?

				} ?>
				</select>
<select name=minutosfin class=txtnegro>
<option value="0" <? if ($idminf=="0"){ echo "selected";}?>>0</option>

		<? for ($t=1;$t<=60;$t++) { ?>
		<option value="<? echo $t; ?>" <? if ($minutosfin=="$t"){ echo "selected";}?>><? echo $t; ?></option>
		<? } ?>
	</select>
	</td>
		</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Requisitos</td>
<td>
<? $contadorx="dsrequisitos_counter";$valorx="2000";$campox="dsrequisitos";$cantidad=strlen($dsrequisitos)?>
<textarea name=dsrequisitos cols="50"  rows="5" class=text1 onKeyPress="ocultar('capa_dsrequisitos')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsrequisitos?></textarea>
<?
$nombre_capa="capa_dsrequisitos";
$mensaje_capa="Debe ingresar los requisitos";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");?>
</td>
</tr>




<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=txtnegro>
		  <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
	</select>

</td>
</tr>

<input type="hidden" name="idtv" value="<? echo $idtv?>">

<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsrequisitos";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>