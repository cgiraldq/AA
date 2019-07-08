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
<?
$p=$_REQUEST['pagina'];
if ($rutapaginador<>"") $pagina="/".$rutapaginador;
?>

<article class="paginador">
            <ul>

				  <? if ($pagina_actual > 1){?>
	<li><a href="<? echo $dsnombre?>&maxregistros=<? echo $maxregistros?>&pagina=<? echo ($pagina_actual-1)?>" title="Anterior" class="fl_pag"><</a></li>
<? }
for ($i=1;($i<$cant_paginas);$i++) {
	?><li><a href="<? echo $dsnombre?>&maxregistros=<? echo $maxregistros?>&pagina=<? echo $i;?>" title="Ver p&aacute;gina <? echo $i?>" <?if ($i == $p) {?>class="activo"<?}?>><? echo $i;?></a>&nbsp;</li><?
} // foin for
if ($pagina_actual<$cant_paginas) {?>
	<li><a href="&dsnombre=<? echo $dsnombre?>&maxregistros=<? echo $maxregistros?>&pagina=<? echo ($pagina_actual + 1) ?>" title="Siguiente" class="fl_pag">></a></li>
<? }?>
</ul>

</article>