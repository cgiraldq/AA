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
encabezado generico de las tablas.
*/
?>
      <tr >

	<? if ($cambiarcampos=="1") { ?>
	<? if ($exportardatos=="") { ?>  <td align="center" background="../../img_modulos/fondo3.jpg" class="text1"><strong>OPCIONES</strong><? } ?></td>
	<? } ?>

	  <?
	  $partir=explode(",",$nombrecampos);
	  $total=count($partir);



	  for ($i=0;$i<$total;$i++) {
	  ?>
      <td align="center" background="../../img_modulos/fondo3.jpg" class="text1">
	  <? if ($partir[$i]=="Posici&oacute;n"){ ?>
		<a href="<? echo $pagina?>?<? echo $rutaPaginacion;?>&orderby=idpos" title="Ordenar por" class="textazullink"><? echo $partir[$i];?></a>
	  <? } else {
		echo $partir[$i];
	  }?>

		</td>
	<? } ?>
	<? if ($cambiarcampos=="") { ?>
	<? if ($exportardatos=="") { if($x!=3){?>  <td align="center" background="../../img_modulos/fondo3.jpg" class="text1"><strong>OPCIONES</strong><? } ?></td>
	<? }} ?>
		</tr>
