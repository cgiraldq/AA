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
<td>Valor Negociado</td>
<td>

<? $contadorx="dsvalor_counter";$valorx="255";$formax="u";$campox="dsvalor";?>

  <input type=text name=dsvalor size=20 maxlength="30" class=text1 value="<? echo $dsvalor?>">
<?
$nombre_capa="capa_dsvalor";
$mensaje_capa="Debe ingresar el valor";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>


</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Ingrese algun comentario sobre la negociaci&oacute;n</td>
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


<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsvalor";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
<input type="hidden" name="idnegocio" value="<? echo $idnegocio;?>"> 
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>