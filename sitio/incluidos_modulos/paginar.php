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
Recorrer el recordset para pagina
*/
?>
<br />


  <table width="100%" cellspacing="0" cellpadding="0" align="center" style="padding: 10px 2px;">
                <tr>
                  <td align="center" valign="middle" background="../../img_modulos/fondo3.jpg" class="text1" height="25">
				  <? if ($pagina_actual > 1){?>
	<a href="<? echo $pagina?>?<? echo $rutaPaginacion?>&maxregistros=<? echo $maxregistros?>&pagina=<? echo ($pagina_actual-1)?>" class="numeracion" title="Anterior">[ << ]</a>
<? }
for ($i=1;($i<$cant_paginas);$i++) {
	if ($i==$pagina_actual) {
	echo $i."&nbsp;";
	} else {
	?><a href="<? echo $pagina?>?<? echo $rutaPaginacion?>&maxregistros=<? echo $maxregistros?>&pagina=<? echo $i;?>" class="numeracion" title="Ver p&aacute;gina <? echo $i?>"><? echo $i;?></a>&nbsp;<?
	}  // fin si
} // foin for
if ($pagina_actual<$cant_paginas) {?>
	<a href="<? echo $pagina?>?<? echo $rutaPaginacion?>&maxregistros=<? echo $maxregistros?>&pagina=<? echo ($pagina_actual + 1) ?>" class="numeracion" title="Siguiente">[>>]</a>
<? }?>
				  </td>
				  <form method="post" name="cambiarpaginacion" action="<? echo $pagina?>?<? echo $rutaPaginacion?>">
  				  <td class="text" background="../../img_modulos/fondo3.jpg" class="text1" height="25" align="right">
				  <input type="text" name="maxregistros" value="<? echo $maxregistros?>" size="4" maxlength="4" class="text">
				  <input type="submit" name="enviar" value="Cambiar" class="btn_inferior">
				  <input type="hidden" name="idcliente" value="<? echo $idcliente?>">
					<input type="hidden" name="dscliente" value="<? echo $dscliente?>">

					<input type="hidden" name="idprograma" value="<? echo $idprograma?>">
					<input type="hidden" name="dsprograma" value="<? echo $dsprograma?>">

				  </td>

				   </form>
				  <td  background="../../img_modulos/fondo3.jpg" height="25" align="right" class="text">
				  Pagina <? echo $pagina_actual?>  de <? echo $cant_paginas?>
				  </td>
                </tr>
              </table>

