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
$rr="idx=".$_REQUEST['idx']."&idy=".$_REQUEST['idy']."&abrirgaleria=".$_REQUEST['abrirgaleria']."&idgaleria=".$_REQUEST['galeria'];
$rr.="&paginaatras=".$_SERVER['PHP_SELF'];
$rr.="&tablabase=".$tabla;
?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<tr valign=top bgcolor="#FFFFFF">
<td><input type=button name=enviar value="Cargar imagenes"  class="botones" onClick="irAPaginaD('../../gestor/editorimagen3/index.php?<? echo $rr?>')">
</td>
</table>
<br>

</td>
</tr>
</table>