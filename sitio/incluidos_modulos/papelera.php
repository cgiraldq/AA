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
$border=0;
if ($exportardatos==1) $border=1;
?>
<br>
<? if ($exportardatos==1) { ?>
<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">
<tr>
	<td><? echo $titulomodulo?></td>
</tr>
</table>
<? } ?>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado 
$nombrecampos="Id,Nombre";
include("../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) { 
			$fondo=$fondo1;
		} else { 
			$fondo=$fondo2;		
		}
		?>
 <tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>
		  <td align="center"><? echo $result->fields[0];?></td>
		  <td align="center" width="50%"><? echo $result->fields[1];?></td>
		 <td align="center"> 
		 <?
		  $rutax=$pagina."?idr=".$result->fields[0]."&idtipo=".$idtipo."&idtipoprod=".$idtipoprod;
		  $trutax="Click para restaurar el registro";
		  $mrutax="Restaurar";
		  include("../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0]."&idtipo=".$idtipo."&idtipoprod=".$idtipoprod;
		  include("../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>
	</tr>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while 
?>
</form>
</table>
