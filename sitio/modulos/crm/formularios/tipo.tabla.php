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
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
		include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {


?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,Codigo,Titulo,Posici&oacute;n,Activo";
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>
		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		<td align="center" width="10%">
		  <input type="text" name="id_[]" value="<? echo $result->fields[0]?>" size="2" readonly class="textnegro">
		</td>

		<td align="center" width="10%">
		  <input type="text" name="idcodigo_[]" value="<? echo $result->fields[7]?>" size="10" maxlength="15" class="textnegro">
		</td>

			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="50" class="textnegro" maxlength="100">
			</td>
			<!--td align="center">
		  <input type="text" name="dsvalor_[]" value="<? echo $result->fields[4]?>" size="20" class="textnegro" maxlength="100">
			</td-->
		  <td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" onkeypress="return numero(event);"  size="2" class="textnegro" maxlength="8">
			</td>


		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
					<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
					<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			  </select>
		  </td>


		  <td align="center">
		  <?

		   $rutax="tipo.equivalenciasxsubcampos.php?idx=".$_REQUEST['idx']."&idx2=".$_REQUEST['idx2']."&idx3=".$result->fields[0];
		  $trutax="Click para configurar";
		  $mrutax="Equivalencias ";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  echo "| ";

		  $rutax=$pagina."?idy=".$result->fields[0]."&idx2=".$result->fields[5]."&idx=".$_REQUEST['idx'];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>
			<input type="hidden" name="idx2" value="<?echo $result->fields[5];?>">
			<input type="hidden" name="idx" value="<?echo $_REQUEST['idx'];?>">
			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
</td></tr>
</form>

</table>
<?
	} // fin si
$result->Close();
?>