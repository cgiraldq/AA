<?/*
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
	//include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");

     $result=$db->Execute($sql);
	if (!$result->EOF) {

?>

<br>

<table width="100%" border="0" cellpadding="2" cellspacing="1" align="center" class="text1">
<form action="<? echo $pagina;?>" method=post name=p>
<?
// encabezado generico basado
$nombrecampos="Nombre,Activo,Publicar en<br> la Web,Desplegable,Estilo del<br> formulario,Formulario<br> tipo cliente,Galeria<br> por Registro";

include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
$maxregistros=20;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$registros=0;
		$id=$result->fields[0];
	$dstabla=$result->fields[4];

	if ($dstabla=="") {
		$sqlx="select count(*) as total from framecf_tblregistro_formularios where idformulario=".$result->fields[0];
		//echo $sqlx;
		$resultx= $db->Execute($sqlx);
		if (!$resultx->EOF) {
		$registros=$resultx->fields[0];

		}
		$resultx->Close();
	}
$dsruta=$result->fields[5];

		?>

		 <tr bgcolor="<? echo $fondo?>" onMouseOut="mOut(this,'<? echo $fondo;?>');" onMouseOver="mOvr(this,'<? echo $fondo3;?>');" >

		  <input type="hidden" name="id_[]" value="<? echo $result->fields[0];?>" size="2" readonly class="textnegro">

			  <td align="center">
		  <input type="text" name="dsm_[]" value="<? echo $result->fields[1];?>" size="25" class="textnegro" maxlength="100">
			</td>

			  <!--td align="center">
		  <input type="text" name="idpos_[]" value="<? echo $result->fields[2];?>" size="3" class="textnegro" maxlength="100">
			</td-->

		  	  <td align="center">
		  <select name="idactivo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[3]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[3]==2) echo "selected";?>>NO</option>
		  </select>
			</td>


		 <td align="center">
		  <select name="idpublicar_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[7]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[7]==2) echo "selected";?>>NO</option>
		  </select>
		</td>

		 <td align="center">
		  <select name="iddesplegable_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[8]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[8]==2) echo "selected";?>>NO</option>
		  </select>
		</td>

		<td align="center">
		  <select name="idestilo_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[9]==1) echo "selected";?>>Estilo 1</option>
		  <option value="2" <? if ($result->fields[9]==2) echo "selected";?>>Estilo 2</option>
		  <option value="3" <? if ($result->fields[9]==3) echo "selected";?>>Estilo 3</option>
		   <option value="4" <? if ($result->fields[9]==4) echo "selected";?>>Estilo lateral</option>
		   <option value="5" <? if ($result->fields[9]==5) echo "selected";?>>Estilo placeholder</option>
		   <option value="7" <? if ($result->fields[9]==7) echo "selected";?>>Estilo remate</option>
		  </select>
		</td>

		 <td align="center">
		  <select name="idformclientes_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[10]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[10]==2) echo "selected";?>>NO</option>
		  </select>
		</td>
		<!--td align="center">
		  <select name="idtipo_[]" class="textnegro">
		  		  <option value="0" <? if ($result->fields[6]=="") //echo "selected";?>>----</option>
					<?
					//$funciones->categorias($prefix."tbltipos_formularios",$result->fields[6]);
				  ?>

		  </select>
		</td -->

		 <td align="center">
		  <select name="idgaleria_[]" class="textnegro">
		  <option value="1" <? if ($result->fields[11]==1) echo "selected";?>>SI</option>
		  <option value="2" <? if ($result->fields[11]==2) echo "selected";?>>NO</option>
		  </select>
		</td>


		  <td align="center">

<? if ($result->fields[3]==1){
		  $rutax="../../../vistaprevia2.php?idx=".$result->fields[0];
		  $trutax="Click para vista previa del formulario";
		  $mrutax="Vista previa";
		  $target="_blank";

		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
	}
?>

|
<?
		  $rutax="formularios.editar.php?idx=".$result->fields[0];
		  $trutax="Click para configurar correos, encabezados y remates de cada tipo de formulario";
		  $mrutax="Configurar";
		   $target="";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
?>

|

		  <?
		  $rutax="formularios.campos.configurar.php?idx=".$result->fields[0];
		  $trutax="Click para configurar los campos que se usaran en el formulario";
		  $mrutax="Campos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>

|
		  <?
		  $rutax="formularios.campos.agrupar.php?idxx=".$result->fields[0];
		  $trutax="Click para configurar los campos que se usaran en el formulario";
		  $mrutax="Agrupar Campos";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>

|
 <?
		  $rutax="formularios.campos.agrupar.temas.php?idxx=".$result->fields[0];
		  $trutax="Click para configurar los campos que se usaran en el formulario";
		  $mrutax="Agrupar temas";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");
		  ?>

|
		 <?
		  $rutax="default.php?idduplicar=".$result->fields[0];
		  $trutax="Click para duplicar el formulario";
		  $mrutax="Duplicar Formulario";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>

|
		  <?
		  if($dsruta=="")$dsruta="registros.php";
		  $rutax=$dsruta."?idxx=".$result->fields[0];
		  $trutax="Click para ver los registros realizados en el sitio";
		  $mrutax="Ver registros ($registros)";
		  include($rutxx."../../incluidos_modulos/enlace.generico.php");?>

|

		  <?
		  $rutax=$pagina."?idx=".$result->fields[0];
		  $formax="";
		  include($rutxx."../../incluidos_modulos/enlace.eliminar.php");
		  ?>


		  </td>
			</tr>
		<?
		$contar++;
		$result->MoveNext();
	} // fin while

?>
<tr>
	<td colspan="8" align="center">
		<input type=submit name=enviar value="Modificar datos"  class="botones">
		<input type=hidden name=idx value="<? echo $idx?>">
	</td></tr>
</form>

</table>

<?
	} // fin si
$result->Close();
?>