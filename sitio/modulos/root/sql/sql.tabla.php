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
// Tabla central 
?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<tr bgcolor="<? echo $fondo?>"  valign="top" >
<td align="center" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');">
  <textarea type="text" name="dsm" class="textnegro" cols="70" rows="15"><? echo $dsm?></textarea>
  </td>
</tr>
<tr><td colspan=2 align="center">
<input type=submit name=enviar value="Ejecutar SQL"  class="botones">
</td></tr>
</form>

</table>
