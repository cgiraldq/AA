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
<td>Direccion IP</td>
<td>
<? $contadorx="dsm_counter";$valorx="30";$formax="u";$campox="dsm";?>
<input type=text name=dsm size=30 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsm')" value="<? echo $dsm?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsm";
$mensaje_capa="Debe ingresar la direccion";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Autorizado</td>
<td>
<? $contadorx="dsautorizado_counter";$valorx="255";$formax="u";$campox="dsautorizado";?>
<input type=text name=dsautorizado size=30 maxlength="255" class=text1 onKeyPress="ocultar('capa_dsautorizado')" value="<? echo $dsautorizado?>"
<? include($rutxx."../../incluidos_modulos/control.evento.php");?>>

<?
$nombre_capa="capa_dsautorizado";
$mensaje_capa="Debe ingresar el nombre del autorizado";
include($rutxx."../../incluidos_modulos/control.capa.php");
include($rutxx."../../incluidos_modulos/control.letras.php");
?>
</td>
</tr>

<tr valign=top bgcolor="#FFFFFF">
<td>Activar?</td>
<td>
	<select name=idactivo class=text1>
		<option value="2" <? if ($idactivo==2) echo "selected";?>>NO</option>
		<option value="1" <? if ($idactivo==1) echo "selected";?>>SI</option>
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
	if (document.u.dsautorizado.value==""){
		document.getElementById('capa_dsautorizado').style.display="";
		document.u.dsautorizado.focus();
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
