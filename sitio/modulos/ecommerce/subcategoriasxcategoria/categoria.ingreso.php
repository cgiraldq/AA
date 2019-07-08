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
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data">
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
<td>Alias (Texto que se ve en la tienda) </td>
<td>
<? $contadorx="dsalias_counter";$valorx="255";$formax="u";$campox="dsalias";?>
<input type=text name=dsalias size=60 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsalias')" value="<? echo $dsalias?>" <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsalias";
$mensaje_capa="Debe ingresar el alias";
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
		</select>

</td>


</tr>



      <? if ($idtipo=="1") {?>

<tr valign=top bgcolor="#FFFFFF">
<td>Origen?</td>
<td>
  <select name=idnat class=text1>
      <option value="1" <? if ($idnat==1) echo "selected";?>>Nacional</option>
      <option value="2" <? if ($idnat==2) echo "selected";?>>Importado</option>
    </select>

</td>


</tr>


<? } else { ?>
<input type="hidden" name="idnat" value="0">

<? } ?>

<tr valign=top bgcolor="#FFFFFF">
<td>Categoria</td>
<td>
 <select name="idcategoria" class="textnegro">
            <? categorias("ecommerce_tblcategoria",$result->fields[6]); ?>
          </select>

</td>


</tr>



<tr bgcolor="#FFFFFF" ><td colspan=2>
<?
$forma="u";
$param="dsm,idpos";
include($rutxx."../../incluidos_modulos/botones.ingresar.php");?>
<input type="hidden" name="idtipo" value="<? echo $idtipo?>">

</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>