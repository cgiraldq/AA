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
		$maxregistros=300;
$result=$db->PageExecute($sql,$maxregistros,$pagina_actual);
	if (!$result->EOF) {


?>
<br>
<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Id,C&oacute;digo,Titulo,Activo";
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

		 <td align="center">
		  <input type="text" name="idcodigo_[]" value="<? echo $result->fields[5]?>" size="10" class="textnegro" maxlength="15">
		</td>

		<td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1]?>" size="50" class="textnegro" maxlength="100">
		</td>
			<!--td align="center">
		  <input type="text" name="dsvalor_[]" value="<? echo $result->fields[4]?>" size="20" class="textnegro" maxlength="100">
			</td-->
		  <!--td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2]?>" onkeypress="return numero(event);"  size="2" class="textnegro" maxlength="8">
			</td-->


		  <td align="center">
			  <select name="idactivo_[]" class="textnegro">
					<option value="1" <? if ($result->fields[2]==1) echo "selected";?>>SI</option>
					<option value="2" <? if ($result->fields[2]==2) echo "selected";?>>NO</option>
					<option value="3" <? if ($result->fields[2]==3) echo "selected";?>>ZONAS</option>
			  </select>
		  </td>


		  <td align="center">

		  	<?

		  	$rutax="tipo.equivalenciasxciudades.php?idx=".$_REQUEST['idx']."&idx2=".$_REQUEST['idx2']."&idx3=".$result->fields[0];
		  $trutax="Click para configurar";
		  $mrutax="Equivalencias ";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  echo "| ";

		  	if ($result->fields[2]==3){
		  		 $rutax="tipo.ciudadxzonas.php?idxx=".$result->fields[3]."&idxyy=".$idx2."&idxyz=".$result->fields[0]."&dsm1=".$result->fields[1];
				  $trutax="Click para agregrar barrios";
				  $mrutax=" Agregar Zonas";
				  include($rutxx."../../incluidos_modulos/enlace.generico.php");
				 echo "|";
			}

		if ($result->fields[2]<>3 && $result->fields[2]<>2){
		  $rutax="tipo.ciudadxbarrios.php?idxx=".$result->fields[3]."&idxyy=".$idx2."&idxyz=".$result->fields[0]."&dsm1=".$result->fields[1];
		  $trutax="Click para agregrar barrios";
		  $mrutax=" Agregar Barrios";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  echo "|";
		}
		?>

		<?

		  $rutax=$pagina."?idy=".$result->fields[0]."&idx=".$result->fields[3]."&idx2=".$result->fields[4];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");?>
		  </td>

			</tr>

		<?
		$contar++;
		$result->MoveNext();
	} // fin while
?>
<tr><td colspan=<? echo $total?> align="center">
<input type=submit name=enviar value="Modificar datos"  class="botones">
<input type="hidden" name="idx" value="<? echo $_REQUEST["idx"];?>">
<input type="hidden" name="idx2" value="<? echo $_REQUEST["idx2"];?>">
</td></tr>
</form>

</table>
<?
	} // fin si
$result->Close();
?>