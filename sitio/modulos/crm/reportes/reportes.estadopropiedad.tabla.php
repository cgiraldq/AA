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
if ($exportardatos<>1){
	include($rutxx."../../incluidos_modulos/modulos.buscador.php");
	include($rutxx."../../incluidos_modulos/paginar.variables.php");
	include($rutxx."../../incluidos_modulos/modulos.subencabezado.php");
}
	//$tablax=$prefix."tbltiposformularios";
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

<form action="<? echo $paginarpag;?>" method=post name=p>

<? if ($exportardatos<>1){?>


<?}
// encabezado generico basado
//echo $sql;

//
if($_REQUEST['idxx']==1)$exportardatos=1;
 if($_REQUEST['idxx']==104)$user=",Estado Propiedad,Usuario asociado,Arrendatario,Disponibilidad,Tipo de Propiedad";
$nombrecampos.="Fecha,Fecha modificaci&oacute;n,Activo $user";
 $nombrecampos=trim($nombrecampos,',');
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");

$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		$idcampo=$result->fields[3];
		?>

 		<tr bgcolor="<? echo $fondo?>"onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');">

 		<td  align="center"> <? echo str_pad($result->fields[4],4,"0", STR_PAD_LEFT);?>
<?
// validaciones adiiconales
			$sqlimg="SELECT idgaleria,idgaleriaoblig,dscantimagenes FROM  framecf_tbltiposformularios WHERE id='$idxx' AND idgaleria=1 AND idgaleriaoblig=1 ";
			//echo $sqlimg;
			$resultimg=$db->Execute($sqlimg);
				if(!$resultimg->EOF){
					$cantimg=$resultimg->fields[2];

					$sqlcant=" SELECT id FROM  framecf_tbltiposformulariosxgalerias WHERE idregistro='".$result->fields[3]."' ";
					//echo $sqlcant;
					$textoimagenes="";
					$resultcant=$db->Execute($sqlcant);
					$totalimagenes=0;
					if(!$resultcant->EOF){
						 $totalimagenes= $resultcant->RecordCount();
						 $textoimagenes=" (".$totalimagenes.")";
					}
					 if($totalimagenes<$cantimg){
					echo "<img src='../../../images/no_img.gif' align='absmiddle' title='Debe cargar al menos $totalimagenes por cada registro'>";
					 }

				$resultcant->Close();

			}
			$resultimg->Close();

			// validar que tengan caracteristicas > 150
			$sql=" select caracteristicas_a_destacar from crm_propiedades where id=".$result->fields[3];
			$sql.=" and length(caracteristicas_a_destacar)<150 ";
			$resultcant=$db->Execute($sql);
				if(!$resultcant->EOF){
					echo "<img src='../../../images/no_doc.gif' align='absmiddle' title='Las caracteristicas tienen menos de 150 caracteres'>";

	
				}
			$resultcant->Close();

?>

		  <input type="hidden" name="id_[]" value="<? echo $result->fields[3];?>" size="2" readonly class="textnegro">
 		</td>
 		<td  align="center"> <? echo $result->fields[5];?></td>
 		<td  align="center"> <? echo $result->fields[6];?></td>


 		<td  align="center">
			  <select name="idactivo_[]" class="textnegro">
				  <option value="1" <? if ($result->fields[0]==1) echo "selected";?>>SI</option>
				  <option value="2" <? if ($result->fields[0]==2) echo "selected";?>>NO</option>
				  <option value="3" <? if ($result->fields[0]==3) echo "selected";?>>Destacado Home</option>
				  <option value="4" <? if ($result->fields[0]==4) echo "selected";?>>Destacado Lateral</option>
			  </select>

 		</td>

 		<td  align="center">
	<select name="estado_propiedad_[]">
		<option value=""> -- Seleccionar -- </option>

				<?
$sqlx="select a.id,a.dsm from framecf_tbltiposformulariosxcampos a where idcampo=890";

					//echo $sqlx;
					$resultx=$db->Execute($sqlx);
					if (!$resultx->EOF) {
						while(!$resultx->EOF) {
				?>
					<option <? if($result->fields[1]==$resultx->fields[0]){echo "selected";}?> value="<? echo $resultx->fields['0']?>"><? echo $resultx->fields['1'];?></option>

				<?
				$resultx->MoveNext();
			}
			}$resultx->Close();?>


	</select>


 		</td>

<?
$sqle="select idusuario ";
$sqle.=" from $dsmform a where id=".$result->fields[3];
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$iduser=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("dsm","id","tblusuarios",$resulte->fields[0],2);?>
</td>

<?
}
$resulte->close();
?>






<?
if($_REQUEST['idxx']==104){
$sqle="select idarrendatario ";
$sqle.=" from $dsmform a where id=".$result->fields[3]." ";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idarrendatario=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("primer_nombre","id","crm_clientes",$resulte->fields[0],2);
	   echo " ".seldato("primer_apellido","id","framecf_tblregistro_formularios",$resulte->fields[0],2);
	?>
</td>

<?
} else {
	?>
	<td>NO</td>
	<?
}
$resulte->close();

}
?>

<?
$sqle="select disponibilidad ";
$sqle.=" from $dsmform a where id=".$result->fields[3];
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$disponibilidad=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("dsm","id"," framecf_tbltiposformulariosxcampos",$disponibilidad,2);?>
</td>

<?
}
$resulte->close();
?>


<?
$sqle="select idagrupamiento ";
$sqle.=" from $dsmform a where id=".$result->fields[3];
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idagrupamiento=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("dsm","id","framecf_tbltiposformulariosxcamposxagrupamiento",$idagrupamiento,2);?>
</td>

<?
}
$resulte->close();
?>




		  <td align="center">

<a class="botones" href="javascript:irAPaginaDN('../../../detalle.php?id=<? echo $idcampo?>')" type="imprimir" title="Click para ver la propiedad">Ver en sitio</a>
<a class="botones" href="javascript:irAPaginaDN('../registro/formulario.ver.detalle.php?id=<? echo $idcampo?>&tabla=crm_propiedades&tipo=104')" type="imprimir" title="Click para ver la propiedad">Ver propiedad</a>

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
		<input type=hidden name=idx value="<? echo $_REQUEST['idx']?>">
		<input type=hidden name=idxx value="<? echo $_REQUEST['idxx']?>">
		<input type=hidden name=r value="<? echo $_REQUEST['r']?>">
		<input type=hidden name=reporte value="<? echo $_REQUEST['reporte']?>">

	</td></tr>

</form>
</table>
<?
		include($rutxx."../../incluidos_modulos/paginar.php");

	}

	 // fin si
$result->Close();


?>

