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
<form action="<? echo $pagina;?>" method=post name=u>
<tr valign=top bgcolor="#FFFFFF">
<td>Titulo</td>
<td>
<? $contadorx="dsm_counter";$valorx="300";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=30 maxlength="300" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el titulo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Asunto del correo</td>
<td>
<? $contadorx="dsd2_counter";$valorx="3500";$formax="u";$campox="dsd2";?>
<textarea name="dsd2" cols=60 rows="4" class="text1" onKeyPress="ocultar('capa_dsd2')"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsd2;?></textarea>

<?
$nombre_capa="capa_dsrespu";
$mensaje_capa="Debe ingresar texto del correo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Texto del correo</td>
<td>
<? $contadorx="dsrespu_counter";$valorx="3500";$formax="u";$campox="dsrespu";?>
<textarea name="dsrespu" cols=60 rows="4" class="text1" onKeyPress="ocultar('capa_dsrespu')" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>><? echo $dsrespu?></textarea>

<?
$nombre_capa="capa_dsrespu";
$mensaje_capa="Debe ingresar texto del correo";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Categoria</td>
<td>
<select name="idcategoria" class=text1>
	<option value="1">Contacto</option>
  <option value="2">Solicitud de servicio</option>
</select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n de la pregunta";
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

<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm,dsrespu,idpos";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>