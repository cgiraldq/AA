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
<td>Nombre</td>
<td>
<? $contadorx="dsm_counter";$valorx="255";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=30 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
 <? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsm";
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
$mensaje_capa="Debe digitar la posici&oacute;n del modulo";
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
		<option value="3" <? if ($idactivo==3) echo "selected";?>>Asociado a Modulo</option>
		<option value="4" <? if ($idactivo==4) echo "selected";?>>Asociado a SubModulo</option>


	</select>

</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Modulo asociado</td>
<td>
	<select name=idmodulo class=text1>
		<option value="0" <? if ($idmodulo==0) echo "selected";?>>--</option>
		<? modulos("tblmodulos",$idmodulo); ?>
	</select>

</td>
</tr>



<tr valign=top bgcolor="#FFFFFF">
<td>SubModulo asociado</td>
<td>
	<select name=idsubmodulo class=text1>
		<option value="0" <? if ($idsubmodulo==0) echo "selected";?>>--</option>
		<? modulos("tblmodulos",$idsubmodulo); ?>
	</select>

</td>
</tr>



<tr bgcolor="#FFFFFF" ><td colspan=2>
<input type=button name=enviar value="Ingresar"  onClick="valU();" class="botones">
</td></tr>
</form>
</table>
<br>

</td>
</tr>
</table>
<br>

<br>
<script language="JavaScript">
<!--
function valU(){
	if (document.u.dsm.value==""){
		document.getElementById('capa_dsm').style.display="";
		document.u.dsm.focus();
		return;
	}

	if (document.u.idpos.value==""){
		document.getElementById('capa_idpos').style.display="";
		document.u.idpos.focus();
		return;
	}
	document.u.submit();
}
function ocultar(capa) {
	var base=document.getElementById(capa);
	if (base) base.style.display="none";
}

//-->
</script>
