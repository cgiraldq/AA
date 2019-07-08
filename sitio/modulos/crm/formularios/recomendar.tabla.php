<?
/*
| ----------------------------------------------------------------- |
FrameWork Cf Para CMS CRM ECOMMERCE
Desarrollado por Comprandofacil
http://www.comprandofacil.com/
Copyright (c)
Medellin - Colombia
=====================================================================
  Autores: 
  Area Investigacion y Desarrollo
  Area Diseno y Maquetacion
  Area Mercadeo
=====================================================================
| ----------------------------------------------------------------- |
*/
// Tabla central de datos cuando se hacen los listados
	include("../../incluidos_modulos/modulos.buscador.php");
	include("../../incluidos_modulos/paginar.variables.php");
		include("../../incluidos_modulos/modulos.subencabezado.php");
     $result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {


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

//
$nombrecampos="Id,Nombre Desde ,Email Desde,Nombre Hacia,Email Hacia,Comentarios,Recomendado,Fecha registro";
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
			<td align="center" ><? echo $result->fields[0];?></td>
			<td align="center"><? echo $result->fields[1];?></td>
			<td align="center"><? echo $result->fields[2];?></td>
			<td align="center"><? echo $result->fields[3];?></td>
			<td align="center"><? echo $result->fields[4];?></td>
			<td align="center"><? echo $result->fields[5];?></td>
			<td align="center"><? echo $result->fields[6];?></td>
			<td align="center"><? echo $result->fields[7];?></td>

	  <? if ($exportardatos=="") { ?>
		  <td align="center">
		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include("../../incluidos_modulos/enlace.eliminar.php");?>
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
<?
	} // fin si
$result->Close();
?>
