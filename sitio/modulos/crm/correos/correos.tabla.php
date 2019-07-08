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
$nombrecampos="Id,Nombre,Apellidos,Email,Identificacion,Telefono,Celular,Direccion,Pais,Ciudad,Comentarios,Fecha";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
 <tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>
		  <td align="center" ><? echo $result->fields[0];?></td>

		  <td align="center"><? echo $result->fields[1];?></td>
		  <td align="center"><? echo $result->fields[2];?></td>

		  <td align="center"><? echo $result->fields[7];?></td>

		  <td align="center"><? echo $result->fields[15];?></td>

		  <td align="center"><? echo $result->fields[3];?></td>

		  <td align="center"><? echo $result->fields[4];?></td>
		  <td align="center"><? echo $result->fields[10];?></td>

		  <td align="center"><? echo $result->fields[5];?></td>
		  <td align="center"><? echo $result->fields[6];?></td>

		  <td align="center"><? echo $result->fields[8];?></td>


		  <td align="center"><? echo $result->fields[9];?></td>


		  <? if ($exportardatos=="") { ?>
		  <td align="center">
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>
		  <? } ?>
			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
</form>
</table>
