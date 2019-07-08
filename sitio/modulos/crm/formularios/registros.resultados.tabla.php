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
	$listartodos=1;
	if($idxx==1)$papelera=5;
	$dsrutap="../crm/formularios/registros.php";
	$nombreform = seldato("dsm","id","framecf_tbltiposformularios",$_REQUEST['idxx'],2);
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

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="texto_centro" >
        <tr>
         	<td align="left" valign="middle">
        		<img src="<? echo $rutxx;?>../../img_modulos/modulos/edicion.png">

                <h1>Registros del formulario <? echo $nombreform;?> para asociar</h1>

<input type="button" class="botones" title='Regresar' value="Regresar" onclick="irAPaginaD('registros.php?idx=<? echo $idxx;?>&idgaleria=<? echo $idgaleria;?>')">




         	</td>
        </tr>

</table>

<table width="100%" border="<? echo $border;?>" cellpadding="2" cellspacing="1" align="center" class="text1">

<form action="<? echo $pagina;?>" method=post name=p>


<?

 $nombrecampos.="Fecha<br>creaci&oacute;n,Fecha<br> modificaci&oacute;n,Asociar";
 $nombrecampos=trim($nombrecampos,',');
include($rutxx."../../incluidos_modulos/tabla.encabezado.php");
$contar=0;
	while (!$result->EOF && ($contar<$maxregistros)) {
		if ($contar%2==0) {
			$fondo=$fondo1;
		} else {
			$fondo=$fondo2;
		}
		?>

 		<tr bgcolor="<? echo $fondo?>" <? if ($exportardatos==1) { ?>onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');" <? } ?>>

 		<td  align="center"> <? echo str_pad($result->fields[5],4,"0", STR_PAD_LEFT);?>
 			<?
 		if($idxx==1){
 			$camposval="";
 			$sqlval=" select dscampo from framecf_tbltiposformulariosxcampo where idoblig=1 and idtipoformulario='1' ";

				$resultxxy=$db->Execute($sqlval);
				if(!$resultxxy->EOF){
					$cont_campos=$resultxxy->fields[0];
				while(!$resultxxy->EOF){
					// se crea array con los campos de referencia del formulario
					$camposval.=$resultxxy->fields[0].",";

					$sqlxy="select $camposval $camposval1 from framecf_tblregistro_formularios where idformulario='$idx' ";

				$resultxxy->MoveNext();
				}
			}
			$resultxxy->Close();

			if($cont_campos<>""){
					$camposval=trim($camposval,",");
					$partir=explode(",",$camposval);
					// funcion para contar el total del array
					$cont=count($partir);
					$sqlxy="select id,$camposval $camposval1 from framecf_tblregistro_formularios where id='".$result->fields[5]."'  ";

					for ($i=0; $i < $cont; $i++) {
					if($partir[$i]<>"dscampo31")	$sqlxy.=" and ".$partir[$i]."!='".$_REQUEST[$partir[$i]]."'  ";
					}
					//echo $sqlxy;
					$resultxy=$db->Execute($sqlxy);
						if(!$resultxy->EOF){
						$validar=$resultxy->fields[0];

					}else{
						echo "<img src='../../../images/no_doc.gif' align='absmiddle' title='Faltan campos obligatorios'>";
					}
				$resultxy->Close();

			}

		}// fin validar el formulario para pintar iconos de advertencia


		if($idxx==104){
			$sqlimg="SELECT idgaleria,idgaleriaoblig,dscantimagenes FROM  framecf_tbltiposformularios WHERE id='$idxx' AND idgaleria=1 AND idgaleriaoblig=1 ";
			//echo $sqlimg;
			$resultimg=$db->Execute($sqlimg);
				if(!$resultimg->EOF){
					$cantimg=$resultimg->fields[2];

					$sqlcant=" SELECT id FROM  framecf_tbltiposformulariosxgalerias WHERE idregistro='".$result->fields[3]."' ";
					//echo $sqlcant;
					$textoimagenes="";
					$resultcant=$db->Execute($sqlcant);
					if(!$resultcant->EOF){
						 $totalimagenes= $resultcant->RecordCount();
						 $textoimagenes=" (".$totalimagenes.")";
						 if($totalimagenes<$cantimg){
						echo "<img src='../../../images/no_img.gif' align='absmiddle' title='Debe cargar al menos $totalimagenes por cada registro'>";
						 }
					}
				$resultcant->Close();

			}
			$resultimg->Close();

		}// VALIDAR SI EL FORMULARIO ES DE PROPIEDADES
 			?>


 		</td>

 		<td> <? echo seldato("dsm","id"," framecf_tbltiposformulariosxcamposxagrupamiento",$result->fields[4],1);?></td>

 			<?
 				for ($i=6; $i < $cantidad+6; $i++) {
			?>
				<td align="center"><? echo ellistr($result->fields[$i],100);?></td>
			<?}?>

		<td align="center">

			  <select name="idactivo_[]" class="textnegro">
				  <option value="1" <? if ($result->fields[0]==1) echo "selected";?>>SI</option>
				  <option value="2" <? if ($result->fields[0]==2 || $result->fields[0]==0) echo "selected";?>>NO</option>

			  </select>
			  <input type="hidden" name="id_[]" value="<? echo $result->fields[3];?>">
		  </td>





<? if ($exportardatos=="") { ?>

		  <td align="center">
<input type=button name=enviar value="Ver registro"  class="botones2" onClick="irAPaginaDN('../../../detalle.php?id=<? echo $result->fields[3];?>');">

		  </td>
<? } ?>
		</tr>




		<?
		$contar++;
		$result->MoveNext();
	} // fin while
	if ($exportardatos<>1){
?>
<tr>
	<td colspan=10 align="center">
<input type=submit name=enviar value="Asociar datos"  class="botones">
<input type="hidden" name="idx" value="<? echo $_REQUEST['idx'];?>">
<input type="hidden" name="idxx" value="<? echo $_REQUEST['idxx'];?>">
<input type="hidden" name="idgaleria" value="<? echo $_REQUEST['idgaleria'];?>">
<input type=button name=enviar value="Regresar"  class="botones" onClick="irAPaginaD('listado.php')">

</td>
</tr>
</form>
</table>
<?}
	}
	 // fin si
$result->Close();


?>

