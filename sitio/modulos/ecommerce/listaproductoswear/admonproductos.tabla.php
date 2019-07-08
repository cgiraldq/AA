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
// Tabla central de datos cuando se hacen los listados
?>
<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Secci&oacute;n";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
/*$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}*/

		  $dsm="Categorias";
		  $rutam="../categoria/default.php";
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>

		  <td align="center">
			<?
		   $rutax=$rutam;
		   include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		   </td>

		 </tr>
<?
		  $dsm="Tipos de productos";
		  $rutam="../tiposproductos/default.php";
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>

		  <td align="center">
			<?
		   $rutax=$rutam;
		   include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		   </td>

		 </tr>


<!--
		 <?
			  $dsm="Subcategoria del Productos";
		  $rutam="../subcategoria/default.php";

	  ?>
		   <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>

		  <td align="center">
			<?
		   $rutax=$rutam;
		   include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		   </td>

		 </tr>

		  <?
			  $dsm="Marcas del Productos";
		  $rutam="../marcas/default.php";

	  ?>
		   <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>

		  <td align="center">
			<?
		   $rutax=$rutam;
		   include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		   </td>

		 </tr>
-->

		  <?
			  $dsm="Productos";
		  $rutam="../listaproductos/default.producto.php";

	  ?>
		   <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>

		  <td align="center">
			<?
		   $rutax=$rutam;
		   include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		   </td>

		 </tr>


		 	  <?
			  $dsm="Subcategoria del producto";
		  $rutam="../subcategoriasxcategoria/default.php";

	  ?>
		   <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		    <td align="center">
		   <strong><? echo strtoupper($dsm)?></strong>
			</td>

		  <td align="center">
			<?
		   $rutax=$rutam;
		   include($rutxx."../../incluidos_modulos/enlace.detalles.php");?>
		   </td>

		 </tr>



		<?
		//$contar++;
		//$result->MoveNext();
	//} // fin while
?>
<!--<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
</td></tr>-->
</form>

</table>
