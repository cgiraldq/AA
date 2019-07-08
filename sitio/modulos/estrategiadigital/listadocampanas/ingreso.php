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
include("../../../incluidos_modulos/encabezado.ingreso.php");?>
<table align="center"  cellspacing="1" cellpadding="1" border="0" width=70% class="campos_ingreso">
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
<tr valign=top bgcolor="#FFFFFF">
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>" <? include("../../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar el nombre";
include("../../../incluidos_modulos/control.capa.php");
include("../../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Estado?</td>
<td>
  <select name=idactivo class=text1>
    <option value="1" <? if ($idactivo==1) echo "selected";?>>En proceso</option>
    <option value="2" <? if ($idactivo==2) echo "selected";?>>Inactiva</option>
    <option value="3" <? if ($idactivo==3) echo "selected";?>>Finalizada</option>

  </select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Tipo?</td>
<td>
  <select name=idtipo class=text1>
    <option value="1" <? if ($idtipo==1) echo "selected";?>>Mailing</option>
    <option value="2" <? if ($idtipo==2) echo "selected";?>>Landingpage</option>
    <option value="3" <? if ($idtipo==3) echo "selected";?>>Publicidad redes sociales</option>

  </select>

</td>
</tr>


<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm";
include("../../../incluidos_modulos/botones.ingresar.php");?>

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>