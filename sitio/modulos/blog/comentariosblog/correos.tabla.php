<?
/*
| ----------------------------------------------------------------- |
CF-informer
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
$nombrecampos="Id,Blog,Nombre,Email,Fecha registro,comentario,Activar?";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}

		$com="";




		$sql="select count(*) as total from blogtblcomentarios  a,blogtblrespuestas b where a.id=".$result->fields[0]." and b.idc=a.id;";
		//echo $sql;
			$resultx=$db->Execute($sql);
			if(!$resultx->EOF){
				$com="(".$resultx->fields[0].")";
				if ($resultx->fields[0]=="") $com="";
			}
			$resultx->Close();


		?>
 <tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>
			<td align="center" ><? echo $result->fields[0];?></td>
			<td align="center"><? echo $nombreb=reemplazar(seldato("dsm","id","tblblog", $result->fields[6],1));
 ?></td>

			<td align="center"><? echo $result->fields[1];?></td>
			<td align="center"><? echo $result->fields[2];?></td>
			<td align="center"><? echo $result->fields[4];?></td>

			<td>
			<? echo $result->fields[3];?>
			</td>


		  <? if ($exportardatos=="") { ?>

		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
					<option value="1" <? if ($result->fields[7]==1) echo "selected";?>>SI</option>
					<option value="2" <? if ($result->fields[7]==2) echo "selected";?>>NO</option>
			</select>
		  </td>


		  <td align="center">
		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0]?>">

		  <?  if($com<>""){?>
		  <?
		  $rutax="../comentarios_blog_respuestas/default.php?idrespuesta=".$result->fields[0]."&idtema=".$_REQUEST['idtema'];
		  $trutax="Click para ver comentarios asociados";
		  $mrutax=" RESPUESTAS $com";

		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>
		  |
		  <?}?>

		  <?
		  $rutax=$pagina."?idx=".$result->fields[0]."&idtema=".$_REQUEST['idtema'];
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
		  <? if ($exportardatos=="") { ?>

<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type="hidden" name="idtema" value="<? echo $_REQUEST['idtema'];?>">
</td></tr>
<? } ?>

</form>
</table>
