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
$nombrecampos="Id,Codigo,Titulo,Web service,Activo";
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

	<td  align="center">
		<?
			$sqlx="SELECT *FROM crmtblwebservices WHERE idactivo=1";
			$resultx=$db->Execute($sqlx);
			if (!$resultx->EOF) {
		?>
		<select name="idweb_[]" class="text1">
				<? while (!$resultx->EOF) {
					$idx=$resultx->fields[0];
					$dsmx=$resultx->fields[1];
				?>
			  <option <? if ($result->fields[8]==$idx) echo "selected";?> value="<? echo $idx;?>"><? echo $dsmx;?></option>
			  	<?
			  	$resultx->MoveNext();
			  }
			  	?>
		</select>
		<?
			}
				$resultx->Close();
		?>
	</td>


			<!--td align="center">
		  <input type="text" name="dsvalor_[]" value="<? echo $result->fields[4]?>" size="20" class="textnegro" maxlength="100">
			</td-->
		  <!--td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" onkeypress="return numero(event);"  size="2" class="textnegro" maxlength="8">
			</td-->


		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
					<option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
					<option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
			  </select>
		  </td>


		  <td align="center">
		  		  <?
		  $rutax=$pagina."?idy=".$result->fields[0]."&idx2=".$result->fields[5]."&idx=".$_REQUEST['idx']."&idx3=".$_REQUEST['idx3']."&idx4=".$_REQUEST['idx4'];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>
			<input type="hidden" name="idx2" value="<?echo $result->fields[5];?>">
			<input type="hidden" name="idx" value="<?echo $_REQUEST['idx'];?>">
			<input type="hidden" name="idx3" value="<?echo $_REQUEST['idx3'];?>">
			<input type="hidden" name="idx4" value="<?echo $_REQUEST['idx4'];?>">
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