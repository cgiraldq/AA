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
if($_REQUEST["idxx"]==104)$arrendatario=1;
if($_REQUEST["idxx"]==1)$tipoclientes=1;
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

<form action="<? echo $pagina;?>" method=post name=p>

<? if ($exportardatos<>1){?>


<?}
// encabezado generico basado

//
if($_REQUEST['idxx']==1)$exportardatos=1;
 if($_REQUEST['idxx']==104)$user=",Clasificado gratis,Usuario asociado,Arrendatario";
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
		?>

 		<tr bgcolor="<? echo $fondo?>"onMouseOut="mOut(this,'<? echo $fondo;?>');"
 			onMouseOver="mOvr(this,'<? echo $fondo3;?>');">

 		<td> <? echo $result->fields[5]?> </td>

 			<?
 				for ($i=6; $i < $cantidad+6; $i++) {
			?>
				<td align="center"><? echo ellistr($result->fields[$i],100);?></td>
			<?}?>

		<td align="center">

				<? if ($result->fields[0]==1) echo "SI";?>
				<? if ($result->fields[0]==2) echo "NO";?>
				<? if ($result->fields[0]==3) echo "Destacado Home";?>

			  <input type="hidden" name="id_[]" value="<? echo $result->fields[3];?>">
		  </td>

		  <? if($_REQUEST['idxx']==104){?>
		 <td align="center">

				 <? if ($result->fields[1]==1) echo "SI";?>
				 <? if ($result->fields[1]==2 OR $result->fields[1]=="") echo "NO";?>
		  </td>
		  <?}?>

<?
if($_REQUEST['idxx']==104){
$sqle="select idusuario ";
$sqle.=" from framecf_tblregistro_formularios a where id=".$result->fields[3]."  and idformulario='$idxx'";
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

}
?>



<?
if($_REQUEST['idxx']==104){
$sqle="select idarrendatario ";
$sqle.=" from framecf_tblregistro_formularios a where id=".$result->fields[3]."  and idformulario='$idxx'";
//echo $sqle;
$resulte=$db->Execute($sqle);
if (!$resulte->EOF) {
$idarrendatario=$resulte->fields[0];
?>
<td align="center">
	<? echo seldato("dscampo3","id","framecf_tblregistro_formularios",$resulte->fields[0],2);
	   echo " ".seldato("dscampo5","id","framecf_tblregistro_formularios",$resulte->fields[0],2);
	?>
</td>

<?
}
$resulte->close();

}
?>


<? if($_REQUEST['idxx']==104){?>

		  <td align="center">

		  		<?
			  $rutaeditar="registros.editar.php";
			  $idpropietario=seldato("idpropietario","id","framecf_tblregistro_formularios", $result->fields[5],2);
			  $rutax=$rutaeditar."?idx=1&idy=$idpropietario&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&idarrendador=".$_REQUEST['idarrendador']."&propietario=".$_REQUEST['propietario']."&reporte=".$_REQUEST['reporte']." ";
			  $formax="";
			  $mrutax="Propietario";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			  ?>
              |

			 <?
			  $rutaeditar="registros.editar.php";

			  $rutax=$rutaeditar."?idx=1&idy=".$resulte->fields[0]."&param=".$_REQUEST['param']."&campo=".$_REQUEST['campo']."&idarrendador=".$_REQUEST['idarrendador']."&propietario=".$_REQUEST['propietario']."&reporte=".$_REQUEST['reporte']."";
			  $formax="";
			  $mrutax="Arrendatario";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			  ?>

<br>
			 <?
			  $rutaeditar="registros.editar.php";
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[3]."&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  $mrutax="Estado cartera";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			  ?>
			  |

			 <?
			  $rutaeditar="registros.editar.php";
			  $rutax=$rutaeditar."?idx=".$idxx."&idy=".$result->fields[3]."&idgaleria=".$_REQUEST["idgaleria"];
			  $formax="";
			  $mrutax="Mantenimiento";
			  include($rutxx."../../incluidos_modulos/enlace.generico.php");
			  ?>

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
	}
	 // fin si
$result->Close();


?>

