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
// Tabla central de datos cuando se hacen los listados
include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");

?>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=ubicaciones enctype="multipart/form-data">

<tr valign=top bgcolor="#FFFFFF">
<td>Oficina</td>
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
<td>Longitud:</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dslongitud";?>
<input type=text name=dslongitud size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dslongitud')" value="<? echo $dslongitud?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dslongitud";
$mensaje_capa="Debe ingresar la Longitud";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Latitud:</td>
<td><input type=text name=dslatitud size=1 maxlength="20" class=text1 onKeyPress="ocultar('capa_dslatitud')" value="<? echo $dslatitud?>">
<?
$nombre_capa="capa_dslatitud";
$mensaje_capa="Debe digitar la Latitud";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Zoom</td>
<td><input type=text name=dszoom size=1 maxlength="20" class=text1 onKeyPress="ocultar('capa_dszoom')" value="<? echo $dszoom?>">
<?
$nombre_capa="capa_dszoom";
$mensaje_capa="Debe digitar el zoom";
include($rutxx."../../incluidos_modulos/control.capa.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">

<td colspan="2" align="center" style="width: 500px; height: 400px">
	<div id="capa_mapa" style="width: 500px; height: 400px"></div>
</td>

</tr>





<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="ubicaciones";
$param="dslongitud,dslatitud";
$rr="default.php";
include($rutxx."../../incluidos_modulos/botones.modificar.php");
?>
</td>
<input type="hidden" name="idc" value="<? echo $idc?>">
<input type="hidden" name="paso" value="1">
</tr>
</form>
</table>
<br>

</td>
</tr>
</table>




















