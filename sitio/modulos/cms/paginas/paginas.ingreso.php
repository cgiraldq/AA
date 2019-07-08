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
<td>Pagina</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=30 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre de la categoria ";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Pagina Alterna</td>
<td>
<? $contadorx="dsmalterna_counter";$valorx="255";$formax="u";$campox="dsmalterna";?>
<input type=text name=dsmalterna size=30 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsmalterna')" value="<? echo $dsmalterna?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsmalterna";
$mensaje_capa="";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Titulo de la pagina</td>
<td>
<? $contadorx="dstit_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dstit size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstit')" value="<? echo $dstit?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dstit";
$mensaje_capa="Debe ingresar el titulo de la pagina";
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
$mensaje_capa="Debe digitar la posici&oacute;n de la categoria del cliente";
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
<tr valign=top bgcolor="#FFFFFF">
<td>Activar en el mapa del sitio?</td>
<td>
  <select name=idactivo class=text1>
    <option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
     <option value="3" <? if ($idactivo==2) echo "selected";?>>Principal</option>
    <option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
  </select>

</td>
</tr>
<!--tr valign=top bgcolor="#FFFFFF">
<td>Tienda asociada</td>
<td>
        <select name="idtienda" class="textnegro">
<? lista_tiendas("tblempresa",$idtienda);?>
      </select>

</td>
</tr -->


<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm,dstit,idpos";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>