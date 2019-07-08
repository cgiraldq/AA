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
?>
<br>
<?include($rutxx."../../incluidos_modulos/encabezado.ingreso.php");?>

<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u>

<tr valign=top bgcolor="#FFFFFF">
<td>Nombre Bodega</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el pais";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Pais</td>
<td>
<? $contadorx="dspais_counter";$valorx="255";$formax="u";$campox="dspais";?>
<input type=text name=dspais size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dspais')" value="<? echo $dspais?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dspais";
$mensaje_capa="Debe ingresar el pais";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">
<td>Departamento</td>
<td>
<? $contadorx="dsdep_counter";$valorx="255";$formax="u";$campox="dsdep";?>
<input type=text name=dsdep size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsdep')" value="<? echo $dsdep?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>
<?
$nombre_capa="capa_dsdep";
$mensaje_capa="Debe ingresar el Departamento";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>Ciudad</td>
<td>
<? $contadorx="dsciudad_counter";$valorx="255";$formax="u";$campox="dsciudad";?>
<input type=text name=dsciudad size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsciudad)" value="<? echo $dsciudad?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsciudad";
$mensaje_capa="Debe ingresar la ciudad";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Telefono</td>
<td>
<? $contadorx="dstel_counter";$valorx="255";$formax="u";$campox="dstel";?>
<input type=text name=dstel size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dstel)" value="<? echo $dstel?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dstel";
$mensaje_capa="Debe ingresar la ciudad";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>


<tr valign=top bgcolor="#FFFFFF">

<td>Direcci&oacute;n</td>
<td>
<? $contadorx="dsdir_counter";$valorx="255";$formax="u";$campox="dsdir";?>
<input type=text name=dsdir size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsdir')" value="<? echo $dsdir?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsdir";
$mensaje_capa="Debe ingresar el valor del flete";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>




<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dspais,dsdep,dsciudad";	
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>