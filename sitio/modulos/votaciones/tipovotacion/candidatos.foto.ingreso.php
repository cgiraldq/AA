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
<form action="<? echo $pagina;?>" method=post name=u enctype="multipart/form-data" >

<tr  align="center" bgcolor="#FFFFFF">
<td>Subir Foto</td>
<td>
	<input name="userfile" type="file" class="forma">
  <?
	if (is_file($rutaImagen.$foto)){
	?>
	<img src="<? echo $rutaImagen.$foto?>" width="%100" >
	<?
	}
  ?>


 </td>
</tr>




<tr bgcolor="#FFFFFF" >
	<td colspan="2">

		<input type="hidden" name="idtv" value="<? echo $idtv?>">
		<input type="hidden" name="idasociado" value="<? echo $idasociado?>">
		<input type=submit name=enviar value="Ingresar" class="botones">

<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('candidatos.php?idtv=<? echo $idtv;?>')">

	</td>
</tr>

</form>
</table>
<br>

</td>
</tr>
</table>