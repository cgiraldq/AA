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

include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $paginao;?>" method=post name=u enctype="multipart/form-data">
<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Referencia</td>
<td>
<? $contadorx="dsreferenciax_counter";$valorx="255";$formax="u";$campox="dsreferenciax";?>
<input type=text name=dsreferenciax size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsreferenciax')" value="<? echo $dsreferenciax?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsreferenciax";
$mensaje_capa="Debe ingresar el nombre";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>
<tr valign=top bgcolor="#FFFFFF">
<td>Posici&oacute;n</td>
<td><input type=text name=idpos size=1 maxlength="8" class=text1 onKeyPress="ocultar('capa_idpos')" value="<? echo $idpos?>">
<?
$nombre_capa="capa_idpos";
$mensaje_capa="Debe digitar la posici&oacute;n";
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
		  <option value="3" <? if ($idactivo==3) echo "selected";?>>OFERTA</option>
		  <option value="4" <? if ($idactivo==4) echo "selected";?>>RECOMENDADO</option>
      <option value="5" <? if ($idactivo==5) echo "selected";?>>INCOMPLETO</option>
      <option value="6" <? if ($idactivo==6) echo "selected";?>>NUEVA OFERTA</option>
      <option value="7" <? if ($idactivo==7) echo "selected";?>>NUEVO</option>

	</select>

</td>
</tr>
<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm,dsreferenciax,idpos";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>